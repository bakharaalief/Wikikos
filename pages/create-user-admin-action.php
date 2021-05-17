<?php
require_once("./class/class.User2.php");

$fullName = $_POST['namaLengkap'];
$email = $_POST['email'];
$level = $_POST['level'];
$username = $_POST['username'];
$password = $_POST['password'];

//is data empty
if (empty($fullName) | empty($email) | empty($username) | empty($password)) {
    echo "<script>
    alert('Gagal Mendaftarkan user, Pastikan semua data benar')
    window.location = '?p=create-user-admin';
    </script>";
}

//not empty
else {
    $user2 = new User2();
    $user2->fullname = $fullName;
    $user2->email = $email;
    $user2->username = $username;
    $user2->password = $password;
    $user2->level = $level;

    $hasil = $user2->createUser();

    if ($hasil == "berhasil daftar") {
        echo "<script>
        alert('Berhasil Mendaftarkan user')
        window.location = 'dashboard.php?p=admin';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Mendaftarkan user, Pastikan semua data benar')
        window.location = '?p=create-user-admin';
        </script>";
    }
}
