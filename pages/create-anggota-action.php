<?php
require_once("./class/class.Anggota_Kosan.php");

//anggota info
$namaAnggota = $_POST['nama'];
$idKos = $_POST['id_kos'];

// is data empty
if (empty($namaAnggota) | empty($idKos)) {
    echo "<script>
    alert('Gagal Mendaftarkan Anggota, Pastikan semua data benar')
    window.location = 'dashboard.php?p=create-kos&id_user=$idUser';
    </script>";
}

//not empty
else {

    $anggotaKos = new Anggota_Kosan();
    $anggotaKos->Nama = $namaAnggota;
    $anggotaKos->idKos = $idKos;

    $hasil = $anggotaKos->createAnggota();

    //berasil mendaftar
    if ($hasil == "berhasil mendaftar") {
        echo "<script>
        alert('Berhasil Mendaftarkan Anggota')
        window.location = 'dashboard.php?p=anggota-kos&id-kos=$idKos';
        </script>";
    }

    //gagal mendaftar
    else {
        echo "<script>
        alert('Gagal Mendaftarkan Anggota, Pastikan semua data benar')
        window.location = 'dashboard.php?p=anggota-kos&id-kos=$idKos';
        </script>";
    }
}
