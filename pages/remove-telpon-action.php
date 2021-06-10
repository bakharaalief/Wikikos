<?php
require_once("./authPemilik.php");
//get 
$id_telpon =  $_GET['id-telpon'];

//is data empty
if (empty($id_telpon)) {
    if ($level == 0) {
        echo "<script>
        alert('Gagal Menghapus Nomor Telpon')
        window.location = 'dashboard.php?p=admin';
        </script>";
    }
    //else
    else {
        echo "<script>
        alert('Gagal Menghapus Nomor Telpon')
        window.location = 'dashboard.php?p=profile';
        </script>";
    }
}

//not empty
else {
    $telponUser = new Telp_User();
    $telponUser->idNoTelp = $id_telpon;
    $status = $telponUser->removeTelpon();

    if ($status == "berhasil menghapus") {
        if ($level == 0) {
            echo "<script>
            alert('Berhasil Menghapus Nomor Telpon')
            window.location = 'dashboard.php?p=admin';
            </script>";
        } else {
            echo "<script>
            alert('Berhasil Menghapus Nomor Telpon')
            window.location = 'dashboard.php?p=profile';
            </script>";
        }
    } else {
        if ($level == 0) {
            echo "<script>
            alert('Gagal Menghapus Nomor Telpon')
            window.location = 'dashboard.php?p=admin';
            </script>";
        } else {
            echo "<script>
            alert('Gagal Menghapus Nomor Telpon')
            window.location = 'dashboard.php?p=profile';
            </script>";
        }
    }
}
