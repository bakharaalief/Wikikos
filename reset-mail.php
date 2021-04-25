
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";
$link = "<a href='http://localhost/kuliah/project/?p=new-pass'>Klik untuk reset password akun wikikos anda</a>";
$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
//ganti dengan email dan password yang akan di gunakan sebagai email pengirim
$mail->Username = 'zhirosec@gmail.com';
$mail->Password = 'faizthunder13+';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
//ganti dengan email yg akan di gunakan sebagai email pengirim
$mail->setFrom('zhirosec@gmail.com', 'Admin Wikikos');
$mail->addAddress($_POST['email']);
$mail->isHTML(true);
$mail->Subject = "Reset Link Confirmation - wikikos";
$bodyContent = "Selamat, BERIKUT INI ADALAH LINK RESET PASS ANDA" . $link;
$bodyContent .= "<br>";
$bodyContent .= "feel free to reach us at +628000880880";
$mail->Body = $bodyContent;


$mail->send();
