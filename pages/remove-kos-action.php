<?php
//id kos
require_once("./authPemilik.php");
$idKos = $_GET['id-kos'];

//is data empty
if (empty($idKos)) {
    if ($level == 0) {
        echo "<script>
        alert('Gagal Menghapus Kosan');
        window.location = 'dashboard.php?p=admin';
        </script>";
    }
    //else
    else {
        echo "<script>
        alert('Gagal Menghapus Kosan')
        window.location = 'dashboard.php?p=profile';
        </script>";
    }
}

//not empty
else {
    $kos = new Kos();
    $kos->idKos = $idKos;
    $hasil = $kos->deleteKos();

    //berhasil menghapus
    if ($hasil == "berhasil menghapus") {
        //admin
        if ($level == 0) {
            echo "<script>
            alert('Berhasil Menghapus Kosan');
            window.location = 'dashboard.php?p=admin';
            </script>";
        }
        //else
        else {
            echo "<script>
            alert('Berhasil Menghapus Kosan')
            window.location = 'dashboard.php?p=profile';
            </script>";
        }
    }

    //gagal menghapus
    else {
        if ($level == 0) {
            echo "<script>
            alert('Gagal Menghapus Kosan');
            window.location = 'dashboard.php?p=admin';
            </script>";
        }
        //else
        else {
            echo "<script>
            alert('Gagal Menghapus Kosan')
            window.location = 'dashboard.php?p=profile';
            </script>";
        }
    }
}
