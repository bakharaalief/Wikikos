<?php
require_once("./class/class.User2.php");

$fullName = $_POST['namaLengkap'];
$NIK = $_POST['NIK'];
$email = $_POST['email'];
$level = $_POST['level'];
$username = $_POST['username'];
$password = $_POST['password'];

//is data empty
if (empty($fullName) | empty($NIK) | empty($email) | empty($username) | empty($password)) {
    echo "<script>
    alert('Gagal Mendaftarkan user, Pastikan semua data benar')
    window.location = '/kuliah/project/?p=create-user';
    </script>";
}

//not empty
else {
    $user2 = new User2();

    $user2->fullname = $fullName;
    $user2->email = $email;
    $user2->username = $username;
    $user2->password = $password;
    $user2->NIK = $NIK;
    $user2->level = $level;

    $hasil = $user2->createUser();

    if ($hasil == "berhasil daftar") {
        // include("../../register-mail.php");

        echo "<script>
        alert('Berhasil Mendaftarkan user, silahkan cek email anda untuk verifikasi')
        window.location = '/kuliah/project/?p=login';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Mendaftarkan user, Pastikan semua data benar')
        window.location = '/kuliah/project/?p=create-user';
        </script>";
    }
}
