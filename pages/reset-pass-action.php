<?php
require_once('./class/class.Mail.php');
require_once('./class/class.User2.php');

$email = $_POST['email'];

//is data empty
if (empty($email)) {
    echo "<script>
    alert('Gagal Mendapatkan email, Pastikan semua data benar')
    window.location = '?p=reset-pass';
    </script>";
}

//not empty
else {
    $user2 = new User2();

    $user2->email = $email;

    $hasil = $user2->cekEmail();

    if ($hasil) {
        // include("./reset-mail.php");
        $mail = new Mail();
        $mail->resetMail();
        echo "<script>
        alert('Berhasil reset email user, silahkan cek email anda untuk reset link anda')
        window.location = '?p=login';
        </script>";
    } else {
        echo "<script>
        alert('Gagal reset user, Pastikan semua data benar')
        window.location = '?p=reset-pass';
        </script>";
    }
}

// if (isset($_POST['Submit'])) {
//     $email = $_POST['email'];
//     $objUser = new 
//     $subject = "Informasi Reset Account";
//     $header = "Reset Berhasi";
//     $body = '<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
// 			  Selamat <b>' . $name . '</b>, berhasil reset pass pada sistem kami.<br>
// 			  Berikut ini informasi account Anda:<br>


// 			</span>';

//     $footer = 'Silakan login untuk mengakses sistem';

// }
