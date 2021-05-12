<?php
require_once("./class/class.User2.php");

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

    $hasil = $user2->resetUser();

    if ($hasil == "berhasil reset email") {
        include("./reset-mail.php");

        echo "<script>
        alert('Berhasil reset email user, silahkan cek email anda untuk reset link anda')
        window.location = '/kuliah/project/?p=login';
        </script>";
    } else {
        echo "<script>
        alert('Gagal reset user, Pastikan semua data benar')
        window.location = '?p=reset-pass';
        </script>";
    }
}
