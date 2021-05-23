<?php
require_once("./class/class.Kota.php");

//anggota info
$idKota = $_POST['id-kota'];
$nama_kota = $_POST['namaKota'];

//data empty
if (empty($idKota) | empty($nama_kota)) {
    echo "<script>
    alert('Gagal Memperbaharui Kota, Pastikan semua data benar')
    window.location = 'dashboard.php?p=edit-kota&id-kota=$idKota';
    </script>";
}

//not empty
else {
    $kota = new Kota();
    $kota->idKota = $idKota;
    $kota->nama = $nama_kota;
    $hasil = $kota->editKota();

    if ($hasil == "berhasil mengedit") {
        echo "<script>
        alert('Berhasil Memperbaharui Kota')
        window.location = 'dashboard.php?p=admin';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Memperbaharui Kota, Pastikan semua data benar')
        window.location = 'dashboard.php?p=edit-kota&id-fasilitas=$idKota';
        </script>";
    }
}
