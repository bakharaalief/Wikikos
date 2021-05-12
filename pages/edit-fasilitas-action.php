<?php
require_once("./class/class.Fasilitas.php");

//anggota info
$idFasilitas = $_POST['id-fasilitas'];
$nama_fasilitas = $_POST['namaFasilitas'];

//data empty
if (empty($idFasilitas) | empty($nama_fasilitas)) {
    echo "<script>
    alert('Gagal Memperbaharui Fasilitas, Pastikan semua data benar')
    window.location = 'dashboard.php?p=edit-fasilitass&id-fasilitas=$idFasilitas';
    </script>";
}

//not empty
else {
    $fasilitas = new Fasilitas();
    $fasilitas->idFasilitas = $idFasilitas;
    $fasilitas->nama = $nama_fasilitas;

    $hasil = $fasilitas->editFasilitas();

    if ($hasil == "berhasil mengedit") {
        echo "<script>
        alert('Berhasil Memperbaharui Fasilitas')
        window.location = 'dashboard.php?p=admin';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Memperbaharui Fasilitas, Pastikan semua data benar')
        window.location = 'dashboard.php?p=edit-fasilitass&id-fasilitas=$idFasilitas';
        </script>";
    }
}
