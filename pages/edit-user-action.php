<?php
require_once("./authPemilik.php");
require_once("./class/class.User2.php");

$fullName = $_POST['namaLengkap'];
$email = $_POST['email'];
$level = $_POST['level'];
$username = $_POST['username'];
$password = $_POST['password'];
$idUser = $_POST['id-user'];

//is data empty
if (empty($fullName) | empty($email) | empty($username)) {
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
    $user->email = $email;
    $user->level = $level;
    $user->username = $username;
    $user->password = $password;
    $hasil = $user->editUserData();

    //berhasil edit
    if ($hasil == "berhasil mengedit") {

        $_SESSION['fullname'] = $user->fullname;
        $_SESSION['password'] = $user->password;

        echo "<script>
        alert('Berhasil memperbaharui User')
        window.location = 'dashboard.php?p=profile';
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
