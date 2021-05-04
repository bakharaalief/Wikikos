<?php
// require_once("../../connection.php");
require_once("./class/class.Anggota_Kosan.php");

//anggota info
$idKos = $_GET['id-kos'];
$idAnggota = $_GET['id-anggota'];

//data empty
if (empty($idKos) | empty($idAnggota)) {
    echo "<script>
    alert('Gagal Menghapus Anggota, Pastikan semua data diisi')
    window.location = '/kuliah/project/dashboard.php?p=anggota-kos&id-kos=$idKos';
    </script>";
}

//not empty
else {
    $anggotaKos = new Anggota_Kosan();
    $anggotaKos->idAnggota = $idAnggota;
    $hasil = $anggotaKos->deleteAnggota();

    if ($hasil == "berhasil menghapus") {
        echo "<script>
        alert('Berhasil Menghapus Anggota')
        window.location = '/kuliah/project/dashboard.php?p=anggota-kos&id-kos=$idKos';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Menghapus Anggota, Pastikan semua data benar')
        window.location = '/kuliah/project/dashboard.php?p=anggota-kos&id-kos=$idKos';
        </script>";
    }
}
