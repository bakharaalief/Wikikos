<?php
require_once("./authAdmin.php");
require_once("./class/class.Kota.php");

//get 
$nama =  $_POST['namaKota'];

//is data empty
if (empty($nama)) {
    echo "<script>
    alert('Gagal Menambahkan Kota)
    window.location = '?p=create-kota';
    </script>";
}

//not empty
else {
    $kota = new Kota();
    $kota->nama = $nama;
    $cek = $kota->cekKota();

    //sudah terdaftar
    if ($cek) {
        echo "<script>
        alert('Gagal Menambahkan kota Sudah Terdaftar')
        window.location = '?p=create-kota';
        </script>";
    }

    //belum terdaftar
    else {
        $result = $kota->createKota();

        if ($result == "berhasil daftar") {
            echo "<script>
            alert('Berhasil Menambahkan kota')
            window.location = 'dashboard.php?p=admin';
            </script>";
        } else {
            echo "<script>
            alert('Gagal Menambahkan kota')
            window.location = '?p=create-kota';
            </script>";
        }
    }
}
