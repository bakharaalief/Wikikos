<?php
require_once("../../connection.php");

//anggota info
$idAnggota = $_POST['id-anggota'];
$NIK = $_POST['NIK'];
$namaAnggota = $_POST['nama'];
$idKos = $_POST['id-kos'];

if (empty($idAnggota) | empty($NIK) | empty($namaAnggota) | empty($idKos)) {
    echo "<script>
    alert('Gagal Memperbaharui Anggita, Pastikan semua data benar')
    window.location = '/kuliah/project/dashboard.php?p=anggota-kos&id-kos=$idKos';
    </script>";
} else {
    try {
        //update to anggota
        $sql = "UPDATE anggota_kos SET NIK='$NIK', nama_anggota='$namaAnggota', id_kosan='$idKos'
        WHERE id_anggota=$idAnggota";
        $conn->exec($sql);

        echo "<script>
        alert('Berhasil Memperbaharui Anggota')
        window.location = '/kuliah/project/dashboard.php?p=anggota-kos&id-kos=$idKos';
        </script>";
    } catch (PDOException $e) {
        echo "<script>
        alert('Gagal Memperbaharui Anggota, Pastikan semua data benar')
        window.location = '/kuliah/project/dashboard.php?p=anggota-kos&id-kos=$idKos';
        </script>";
    }
}
