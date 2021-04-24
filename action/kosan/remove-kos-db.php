<?php
require_once("../../connection.php");

//id kos
$idKos = $_GET['id-kos'];

try {
    $sql = "DELETE FROM kosan WHERE id_kosan = :id_kosan";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_kosan', $idKos);
    $stmt->execute();

    echo "<script>
    alert('Berhasil Menghapus Kosan')
    window.location = '/kuliah/project/dashboard.php?p=profile';
    </script>";
} catch (PDOException $e) {
    echo "<script>
    alert('Gagal Menghapus Kosan')
    window.location = '/kuliah/project/dashboard.php?p=profile';
    </script>";
}
