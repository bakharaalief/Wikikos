<?php
require_once("./class/class.User2.php");

$fullName = $_POST['namaLengkap'];
$NIK = $_POST['NIK'];
$email = $_POST['email'];
$level = $_POST['level'];
$username = $_POST['username'];
$password = $_POST['password'];
$idUser = $_POST['id-user'];

//is data empty
if (empty($fullName) | empty($NIK) | empty($email) | empty($username) | empty($password)) {
    echo "<script>
    alert('Gagal Memperbaharui User, Pastikan semua data diiisi')
    window.location = 'dashboard.php?p=edit-user&id-user=$idUser';
    </script>";
}

//not empty
else {
    $user = new User2();
    $user->idUser = $idUser;
    $user->fullname = $fullName;
    $user->NIK = $NIK;
    $user->email = $email;
    $user->level = $level;
    $user->username = $username;
    $user->password = $password;
    $hasil = $user->editUserData();

    //berhasil edit
    if ($hasil == "berhasil mengedit") {
        echo "<script>
        alert('Berhasil memperbaharui User')
        window.location = 'dashboard.php?p=admin';
        </script>";
    }

    //gagal edit
    else {
        echo "<script>
        alert('Gagal Memperbaharui User, Pastikan semua data benar')
        window.location = 'dashboard.php?p=edit-user&id-user=$idUser';
        </script>";
    }
}
