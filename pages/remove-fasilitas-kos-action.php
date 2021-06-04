<?php
require_once("./authPemilik.php");
require_once("./class/class.Fasilitas_Kos.php");

//get 
$idKos =  $_GET['id-kos'];
$id_fasilitas_kos =  $_GET['id_fasilitas_kos'];

//is data empty
if (empty($id_fasilitas_kos)) {
    echo "<script>
    alert('Gagal Menghapus Fasilitas')
    window.location = '/kuliah/project/dashboard.php?p=edit-kos&id-kos=$idKos';
    </script>";
}

//not empty
else {
    $fasilitas = new Fasilitas_Kos();
    $fasilitas->idFasilitasKos = $id_fasilitas_kos;
    $status = $fasilitas->deleteKosFasilitas();

    if ($status == "berhasil menghapus") {
        echo "<script>
        alert('Berhasil Menghapus fasilitas')
        window.location = '/kuliah/project/dashboard.php?p=edit-kos&id-kos=$idKos';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Menghapus Fasilitas')
        window.location = '/kuliah/project/dashboard.php?p=edit-kos&id-kos=$idKos';
        </script>";
    }
}
