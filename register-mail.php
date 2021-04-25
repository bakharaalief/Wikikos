
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";

$link = "<a href='http://localhost/kuliah/project/?p=login'>Klik untuk aktivasi akun wikikos anda</a>";
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
$mail->addAddress($_POST['email'], $_POST['namaLengkap']);
$mail->isHTML(true);
$mail->Subject = "Aktivasi pendaftaran Member";
$bodyContent = "Selamat Datang, Anda berhasil membuat akun Wikikos";
$bodyContent .= "<br>";
$bodyContent .= "Silahkan login dengan Akun anda kembali melalui link ini untuk verifikasi" . $link;
$bodyContent .= "feel free to reach us at +628000880880.";
$mail->Body = $bodyContent;

$mail->send();
