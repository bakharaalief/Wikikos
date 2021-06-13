<?php
require_once("./authPemilik.php");
require_once("./class/class.Foto_Kosan.php");

//get 
$idKos =  $_GET['id-kos'];
$idFoto =  $_GET['id-foto'];
$lokasi = $_GET['lokasi'];

//is data empty
if (empty($idFoto)) {
    echo "<script>
    alert('Gagal Menghapus Foto')
    window.location = 'dashboard.php?p=edit-kos&id-kos=$idKos';
    </script>";
}

//not empty
else {
    $foto = new Foto_Kosan();
    $foto->idFoto = $idFoto;
    $status = $foto->deleteKosFoto();

    if ($status == "berhasil menghapus") {
        unlink($lokasi);
        echo "<script>
        alert('Berhasil Menghapus foto')
        window.location = 'dashboard.php?p=edit-kos&id-kos=$idKos';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Menghapus Foto')
        window.location = 'dashboard.php?p=edit-kos&id-kos=$idKos';
        </script>";
    }
}
