<?php
require_once("../../connection.php");

//anggota info
$NIK = $_POST['NIK'];
$namaAnggota = $_POST['nama'];
$idKos = $_POST['id_kos'];

// is data empty
if (empty($NIK) | empty($namaAnggota) | empty($idKos)) {
    echo "<script>
    alert('Gagal Mendaftarkan Anggota, Pastikan semua data benar')
    window.location = '/kuliah/project/dashboard.php?p=create-kos&id_user=$idUser';
    </script>";
}

//not empty
else {
    try {
        //insert bio to kosan
        $sql = "INSERT INTO anggota_kos(NIK, nama_anggota, id_kosan) 
        VALUES ('$NIK', '$namaAnggota', '$idKos')";
        $conn->exec($sql);

        echo "<script>
        alert('Berhasil Mendaftarkan Anggota')
        window.location = '/kuliah/project/dashboard.php?p=anggota-kos&id-kos=$idKos';
        </script>";
    } catch (PDOException $e) {
        echo "<script>
        alert('Gagal Mendaftarkan Anggota, Pastikan semua data benar')
        window.location = '/kuliah/project/dashboard.php?p=anggota-kos&id-kos=$idKos';
        </script>";
    }
}
