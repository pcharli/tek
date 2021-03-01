<?php 
// path du dossier PHPMailer % fichier d'envoi du mail
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


//print_r($_POST['favorite']);
if(isset($_POST['title'])) :
    //slug
    $string = $_POST['title'];
    $slug = \Transliterator::createFromRules(
        ':: Any-Latin;'
        . ':: NFD;'
        . ':: [:Nonspacing Mark:] Remove;'
        . ':: NFC;'
        . ':: [:Punctuation:] Remove;'
        . ':: Lower();'
        . '[:Separator:] > \'-\''
    )
        ->transliterate( $string );
    //echo $slug; // namnet-pa-bildtavlingen

    //end slug


    $_POST['lastModifiedDate'] = date("Y-m-d H:i:s");
    $_POST['favorite'] = ($_POST['favorite'] == "oui") ? true : false;
    $_POST['id'] = (isset($_POST['id'])) ? $_POST['id'] : "";
    
    if(isset($_POST['categories'])) :
        foreach($_POST['categories'] as $category) :
            $array[] = array('title'=> $category);
        endforeach;
        $_POST['categories'] = $array;
    endif;

    if(isset($_POST['tags'])) :
        foreach($_POST['tags'] as $tag) :
            $array2[] = array("title" => $tag);
        endforeach;
        $_POST['tags'] = $array2;
    endif;
    // retrait échappements
    $_POST['ingredients'] = str_replace("\r", "", $_POST['ingredients']);
    $_POST['instructions'] = str_replace("\r", "", $_POST['instructions']);
    $_POST['nutrition'] = str_replace("\r", "", $_POST['nutrition']);
    $_POST['cookware'] = str_replace("\r", "", $_POST['cookware']);
    $_POST['video'] = str_replace('\/', "/", $_POST['video']);
    $_POST['url'] = str_replace('\/', "/", $_POST['url']);
    $_POST['originalPicture'] = str_replace('\/', "/", $_POST['originalPicture']);
    
    $array = array($_POST);

    $json = json_encode($array);
    file_put_contents("recipes.json", $json);
    //zippage
 
$zip = new ZipArchive();
$zip->open("exports/".$slug.".rtk", ZipArchive::CREATE);
  
$zip->addFile('recipes.json');
//$zip->addFile('fonts/Monoton/OFL.txt', 'license.txt');
  
$zip->close();
unlink("recipes.json");
//unlink("recipes_0.json");
 //phpinfo(32);

    //endzippage
//print_r($json);

//envoi par email
// lance les classes de PHPMailer
//use PHPMailer\src\PHPMailer;
//use PHPMailer\src\Exception;



require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer;
//$mail->isSMTP(); 
//$mail->SMTPDebug = 2; 
//$mail->Host = "your_smtp_host"; 
//$mail->Port = "your_smtp_port"; // typically 587 
//$mail->SMTPSecure = 'tls'; // ssl is depracated
//$mail->SMTPAuth = true;
//$mail->Username = "your_mail_username";
//$mail->Password = "your_mail_password";
$mail->setFrom("pcepegra@gmail.com", "Pierre");
$mail->addAddress("lretlo@gmail.com", "send_to_Name");
$mail->Subject = 'Any_subject_of_your_choice';
$mail->msgHTML("test body"); // remove if you do not want to send HTML email
$mail->AltBody = 'HTML not supported';
$mail->addAttachment("exports/".$slug.".rtk"); //Attachment, can be skipped

$mail->send();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="./site.webmanifest">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#000000">
    <title>Recette Tek</title>
</head>
<body>
    <div class="page">
        <header class="hero is-primary">
            <div class="body-hero">
                <div class="container content">
                  <div class="header_content">
                  <h1 class="title"><a href="index.php"><img src="logo_white.svg" alt="" class="header_logo"></a> Recette Tek</h1>
                  <form action="update.php" method="post" enctype="multipart/form-data" class="form import">
                    <label for="" class="label show">Edition: </label>&nbsp;
                    <input type="file" name="editfile" class="input editfile">&nbsp;
                    <button class="button"><i class="fas fa-cloud-upload-alt"></i></button>
                  </form>
                  </div>
                </div>
            </div>
        </header>
        <main class="section container content">
            <h2>Récupérer la recette</h2>
<a href="exports/<?php echo $slug;?>.rkt" class="button">Télécharger</a><br/>
<p>Ou scannez le QRCode</p>
<div id="qrcode"></div>
<!--<div id="qrcode2"></div>-->
</main>
<footer class="footer">&copy; <a href="https://lr-et-lo.be" target="_blank">l'R & l'O.be</a> - 2021</footer>
    </div>
<script src="qrcode.min.js"></script>
<script>
    let url = "https://cepegra.yo.fr/tek/exports/"
var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: url+"<?php echo $slug;?>.rtk",
    width: 128,
    height: 128,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
});

//new QRCode(document.getElementById("qrcode2"), "http://jindo.dev.naver.com/collie");
</script>
<?php
endif;
?>