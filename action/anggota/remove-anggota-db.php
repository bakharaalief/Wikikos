<?php
require_once("../../connection.php");

//anggota info
$idKos = $_GET['id-kos'];
$idAnggota = $_GET['id-anggota'];

try {
    //remove anggota
    $sql = "DELETE FROM anggota_kos WHERE id_anggota = :id_anggota";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_anggota', $idAnggota);
    $stmt->execute();

    echo "<script>
    alert('Berhasil Menghapus Anggota')
    window.location = '/kuliah/project/dashboard.php?p=anggota-kos&id-kos=$idKos';
    </script>";
} catch (PDOException $e) {
    echo "<script>
    alert('Gagal Menghapus Anggota, Pastikan semua data benar')
    window.location = '/kuliah/project/dashboard.php?p=anggota-kos&id-kos=$idKos';
    </script>";
}
