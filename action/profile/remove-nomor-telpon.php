<?php
include("../../connection.php");

//get 
$id_telpon =  $_GET['id_telpon'];

//is data empty
if (empty($id_telpon)) {
    echo "<script>
    alert('Gagal Menghapus Nomor Telpon')
    window.location = '/kuliah/project/dashboard.php?p=profile';
    </script>";
}

//not empty
else {
    try {
        $sql = "DELETE FROM telpon WHERE id_telpon = :id_telpon";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_telpon', $id_telpon);
        $stmt->execute();

        echo "<script>
        alert('Berhasil Menghapus Nomor Telpon')
        window.location = '/kuliah/project/dashboard.php?p=profile';
        </script>";
    } catch (PDOException $e) {

        echo "<script>
        alert('Gagal Menghapus Nomor Telpon')
        window.location = '/kuliah/project/dashboard.php?p=profile';
        </script>";
    }
}
