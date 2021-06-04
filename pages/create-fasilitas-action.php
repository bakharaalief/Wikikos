<?php
require_once("./authAdmin.php");
require_once("./class/class.Fasilitas.php");

//get 
$nama =  $_POST['namaFasilitas'];

//is data empty
if (empty($nama)) {
    echo "<script>
    alert('Gagal Menambahkan Fasilitas')
    window.location = '?p=create-fasilitas';
    </script>";
}

//not empty
else {
    $fasilitas = new Fasilitas();
    $fasilitas->nama = $nama;
    $cek = $fasilitas->cekFasilitas();

    //sudah terdaftar
    if ($cek) {
        echo "<script>
        alert('Gagal Menambahkan Fasilitas, Sudah Terdaftar')
        window.location = '?p=create-fasilitas';
        </script>";
    }

    //belum
    else {
        $result = $fasilitas->createFasilitas();

        if ($result == "berhasil daftar") {
            echo "<script>
            alert('Berhasil Menambahkan Fasilitas')
            window.location = 'dashboard.php?p=admin';
            </script>";
        } else {
            echo "<script>
            alert('Gagal Menambahkan Fasilitas')
            window.location = '?p=create-fasilitas';
            </script>";
        }
    }
}
