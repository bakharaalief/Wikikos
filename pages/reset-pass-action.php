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
    $hasil = $user2->cekEmailData();

    //terdaftar
    if ($hasil) {
        $mail = new Mail();
        $mail->namaUser = $user2->fullname;
        $mail->mailUser = $email;
        $mail->linkKirim = "http://localhost/kuliah/project/?p=reset-pass-user&id-user=$user2->idUser";
        $mail->subject = "Reset Pass Akun";
        $mail->message = "Reset Pass Akun Kamu";
        $mail->resetPassTemplate();
        $mail->sendMailAction();

        echo "<script>
        alert('Berhasil reset email user, silahkan cek email anda untuk reset link anda')
        window.location = '?p=reset-pass';
        </script>";
    }

    //tidak
    else {
        echo "<script>
        alert('Gagal reset user, Pastikan email kamu terdatar :)')
        window.location = '?p=reset-pass';
        </script>";
    }
}
