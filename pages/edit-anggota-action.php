<?php
require_once("./class/class.Anggota_Kosan.php");

//anggota info
$idAnggota = $_POST['id-anggota'];
$NIK = $_POST['NIK'];
$namaAnggota = $_POST['nama'];
$idKos = $_POST['id-kos'];

//data empty
if (empty($idAnggota) | empty($NIK) | empty($namaAnggota) | empty($idKos)) {
    echo "<script>
    alert('Gagal Memperbaharui Anggita, Pastikan semua data benar')
    window.location = '/kuliah/project/dashboard.php?p=anggota-kos&id-kos=$idKos';
    </script>";
}

//not empty
else {
    $anggotaKos = new Anggota_Kosan();
    $anggotaKos->idAnggota = $idAnggota;
    $anggotaKos->NIK = $NIK;
    $anggotaKos->Nama = $namaAnggota;
    $anggotaKos->idKos = $idKos;

    $hasil = $anggotaKos->editAnggota();

    if ($hasil == "berhasil mengedit") {
        echo "<script>
        alert('Berhasil Memperbaharui Anggota')
        window.location = '/kuliah/project/dashboard.php?p=anggota-kos&id-kos=$idKos';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Memperbaharui Anggota, Pastikan semua data benar')
        window.location = '/kuliah/project/dashboard.php?p=anggota-kos&id-kos=$idKos';
        </script>";
    }
}
