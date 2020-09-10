<?php
error_reporting(1);
//Online
//define('PATH', '/home/redche22/baseteste.redcheck.com.br/signer/'); //dirname(__FILE__));
// Offline
define('PATH', 'C:/wamp64/www/signer/'); //dirname(__FILE__));
/*
Wrong Arguments
usage: PortableSigner
-b Append signature block. Parameter:
cs|de|en|it|pl|es
-c Comment under signature block (text)
-e Position of Signature Block on last page: Vertical
Position,Left Margin,RightMargin
-f If this is set, the document is NOT finalized
-h Help (this page)
-i Image file for signature block
-l Contents of "Location" - field (text)
-n Without GUI
-o Outputfile (PDF)
-ownerpwd Owner password
-ownerpwdfile Owner password file
-p Signaturepassword
-pwdfile Password file
-r Contents of "Reason" - field (text)
-s Signaturefile (P12 or PFX)
-t Inputfile (PDF)
-z Signature on last page
*/
class Signer
{
    public static function signPdfFile($inputFile, $outputFile, $certificateFile, $password)
    {
        $signerJar = PATH . 'bin/PortableSigner.jar';
        //Image file for signature block
        $i= PATH . 'img/icp.jpg';
        // Comment under signature block (text)
        $c= 'Esse é um comentário';
        //Contents of "Location" - field (text)
        $l= 'Localização texto';
        //Contents of "Reason" - field (text)
        $r= 'Reason texto aqui';
        //exec("java -jar " . $signerJar . " -n -t {$inputFile} -o {$outputFile} -s {$certificateFile} -p {$password} 2>&1", $result);//ok
        
        $cmd = "java -jar " . $signerJar . " -n -t {$inputFile} -o {$outputFile} -s {$certificateFile} -p {$password}";//ok
        $cmd .= " -i {$i} ";//ok
        $cmd .= " -b en ";//ok
        exec($cmd . "2>&1", $result);
        //echo "Arquivo Gerado com sucesso!";
        foreach ($result as $k => $v) {
            echo "$v <br>";
        }
    }
}
// echo PATH;
$tempFile =PATH . 'pdf/source/teste.pdf';
$tempSignedFile =PATH . '/pdf/out/teste_sign.pdf';
$certificateFile =PATH . '/cert/ANDRELOPES.pfx';
$certificatePassword = 'gabriel3869';

Signer::signPdfFile($tempFile, $tempSignedFile, $certificateFile, $certificatePassword);
