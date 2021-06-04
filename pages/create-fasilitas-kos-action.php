<?php
require_once("./authPemilik.php");
require_once("./class/class.Fasilitas_Kos.php");

//get 
$idFasilitas =  $_POST['fasilitas'];
$idKos = $_POST['id-kos'];

//is data empty
if (empty($idFasilitas)) {
    echo "<script>
    alert('Gagal Menambahkan Fasilitas')
    window.location = 'dashboard.php?p=create-fasilitas-kos&id-kos=$idKos';
    </script>";
}

//not empty
else {
    $fasilitas = new Fasilitas_Kos();
    $fasilitas->idFasilitas = $idFasilitas;
    $fasilitas->idKosan = $idKos;
    $cek = $fasilitas->cekFasilitasKos();

    //sudah terdaftar
    if ($cek) {
        echo "<script>
        alert('Gagal Menambahkan Fasilitas, Fasilitas Sudah Tersimpan')
        window.location = 'dashboard.php?p=create-fasilitas-kos&id-kos=$idKos';
        </script>";
    }

    //belum terdaftar
    else {
        $result = $fasilitas->createKosFasilitas();

        if ($result == "berhasil daftar") {
            echo "<script>
        alert('Berhasil Menambahkan Fasilitas')
        window.location = 'dashboard.php?p=edit-kos&id-kos=$idKos';
        </script>";
        } else {
            echo "<script>
        alert('Gagal Menambahkan Fasilitas')
        window.location = 'dashboard.php?p=create-fasilitas-kos&id-kos=$idKos';
        </script>";
        }
    }
}
