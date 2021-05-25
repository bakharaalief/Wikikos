<?php
require_once("./authAdmin.php");
require_once("./class/class.User2.php");

$idUser = $_GET['id-user'];

//is data empty
if (empty($idUser)) {
    echo "<script>
    alert('Gagal Menghapus User, Pastikan semua data diiisi')
    window.location = 'dashboard.php?p=admin';
    </script>";
}

//not empty
else {
    $user = new User2();
    $user->idUser = $idUser;
    $hasil = $user->deleteUserData();

    //berhasil edit
    if ($hasil == "berhasil menghapus") {
        echo "<script>
        alert('Berhasil menghapus User')
        window.location = 'dashboard.php?p=admin';
        </script>";
    }

    //gagal edit
    else {
        echo "<script>
        alert('Gagal menghapus User, Pastikan semua data benar')
        window.location = 'dashboard.php?p=admin';
        </script>";
    }
}
