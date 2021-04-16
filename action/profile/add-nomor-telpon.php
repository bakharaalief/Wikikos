<?php
include("../../connection.php");

//get 
$nomor =  $_POST['nomor'];
$id_user = $_POST['id_user'];

//is data empty
if (empty($nomor) | empty($id_user)) {
    echo "<script>
    alert('Gagal Menambahkan Nomor Telpon')
    window.location = '/kuliah/project/dashboard.php?p=profile';
    </script>";
}

//not empty
else {
    try {
        $sql = "INSERT INTO telpon(nomor_telpon, id_user) 
        VALUES ('$nomor', '$id_user')";
        $conn->exec($sql);

        echo "<script>
        alert('Berhasil Menambahkan Nomor Telpon')
        window.location = '/kuliah/project/dashboard.php?p=profile';
        </script>";
    } catch (PDOException $e) {
        echo "<script>
        alert('Gagal Menambahkan Nomor Telpon')
        window.location = '/kuliah/project/dashboard.php?p=profile';
        </script>";
    }
}
