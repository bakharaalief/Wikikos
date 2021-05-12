<?php
require_once("./class/class.Fasilitas.php");

//get 
$id_fasilitas =  $_GET['id_fasilitas'];

//is data empty
if (empty($id_fasilitas)) {
    echo "<script>
    alert('Gagal Menghapus Fasilitas')
    window.location = 'dashboard.php?p=admin';
    </script>";
}

//not empty
else {
    $fasilitas = new Fasilitas();
    $fasilitas->idFasilitas = $id_fasilitas;
    $status = $fasilitas->deleteFasilitas();

    if ($status == "berhasil menghapus") {
        echo "<script>
        alert('Berhasil Menghapus fasilitas')
        window.location = 'dashboard.php?p=admin';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Menghapus Fasilitas')
        window.location = 'dashboard.php?p=admin';
        </script>";
    }
}
