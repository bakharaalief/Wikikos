<?php
require_once("./class/class.Kota.php");

//get 
$id_Kota =  $_GET['id-kota'];

//is data empty
if (empty($id_Kota)) {
    echo "<script>
    alert('Gagal Menghapus Kota')
    window.location = 'dashboard.php?p=admin';
    </script>";
}

//not empty
else {
    $kota = new Kota();
    $kota->idKota = $id_Kota;
    $status = $kota->deleteKota();

    if ($status == "berhasil menghapus") {
        echo "<script>
        alert('Berhasil Menghapus Kota')
        window.location = 'dashboard.php?p=admin';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Menghapus Kota')
        window.location = 'dashboard.php?p=admin';
        </script>";
    }
}
