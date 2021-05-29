<?php
require_once("./class/class.User2.php");

$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$idUser = $_POST['id-user'];

//is data empty
if (empty($password1) | empty($password2) | empty($idUser)) {
    echo "<script>
    alert('Gagal Memperbaharui User, Pastikan semua data diiisi')
    window.location = 'dashboard.php?p=edit-user&id-user=$idUser';
    </script>";
}

//not empty
else {
    //password harus maching
    if ($password1 == $password2) {

        $user = new User2();
        $user->idUser = $idUser;
        $user->password = $password1;
        $hasil = $user->resetPass();

        //berhasil edit
        if ($hasil == "berhasil mengedit") {
            echo "<script>
        alert('Berhasil memperbaharui Password')
        window.location = 'index.php?p=login';
        </script>";
        }

        //gagal edit
        else {
            echo "<script>
        alert('Gagal Memperbaharui Password, Pastikan semua data benar')
        window.location = 'index.php?p=reset-pass-user&id-user=$idUser';
        </script>";
        }
    }

    //password tidak semua
    else {
        echo "<script>
        alert('Gagal Memperbaharui Password, Pastikan Password Sama')
        window.location = 'index.php?p=reset-pass-user&id-user=$idUser';
        </script>";
    }
}
