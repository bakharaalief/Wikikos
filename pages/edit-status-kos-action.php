<?php
require_once("./class/class.Kos.php");

//anggota info
$idKos = $_POST['id-kos'];
$status = $_POST['status'];
$emailPemilik = $_POST['email-kos'];

//data empty
if (empty($idKos) | empty($status) | empty($emailPemilik)) {
    echo "<script>
    alert('Gagal Memperbaharui status, Pastikan semua data benar')
    window.location = 'dashboard.php?p=edit-status-kos&id-kos=$idKos';
    </script>";
}

//not empty
else {
    $kos = new Kos();
    $kos->idKos = $idKos;
    $kos->status = $status;

    $hasil = $kos->editStatusKos();

    if ($hasil == "berhasil mengedit") {

        //ini buat ngirim email
        //jadi aktif
        if ($status == 1) {
        }
        //ditolak
        if ($status == 2) {
        }
        echo "<script>
        alert('Berhasil Memperbaharui status')
        window.location = 'dashboard.php?p=admin';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Memperbaharui status, Pastikan semua data benar')
        window.location = 'dashboard.php?p=edit-status-kos&id-kos=$idKos';
        </script>";
    }
}
