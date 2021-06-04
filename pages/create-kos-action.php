<?php
require_once("./authPemilik.php");

//kos info
$namaKos = $_POST['nama-kos'];
$tipeKos = $_POST['tipe-kos'];
$ukuranKos = $_POST['ukuran-kos'];
$kapasitasKos = $_POST['kapasitas-kos'];
$hargaKos = $_POST['harga-kos'];
$jalanKos = $_POST['jalan-kos'];
$kecamatanKos = $_POST['kecamatan-kos'];
$kotaKos = $_POST['kota-kos'];
$deskripsiKos = $_POST['deskripsi-kos'];

// is data empty
if (
    empty($namaKos) | empty($tipeKos) | empty($ukuranKos) | empty($kapasitasKos) | empty($hargaKos) | empty($jalanKos)
    | empty($kecamatanKos) | empty($kotaKos) | empty($kotaKos) | empty($deskripsiKos)
) {
    echo "<script>
    alert('Gagal Mendaftarkan kosan, Pastikan semua data benar')
    window.location = 'dashboard.php?p=create-kos&id_user=$idUser';
    </script>";
}

//not empty
else {
    $hasil = $user2->createKos(
        $namaKos,
        $tipeKos,
        $ukuranKos,
        $hargaKos,
        $kapasitasKos,
        $jalanKos,
        $kecamatanKos,
        $kotaKos,
        $deskripsiKos,
    );

    //berhasil membuat
    if ($hasil == "berhasil membuat") {
        echo "<script>
        alert('Berhasil Mendaftarkan Kosan, Silahkan Menunggu Konfirmasi Admin')
        window.location = 'dashboard.php?p=profile';
        </script>";
    }

    //gagal membuat
    else {
        echo "<script>
        alert('Gagal Mendaftarkan kosan, Pastikan semua data benar')
        window.location = 'dashboard.php?p=create-kos&id_user=$idUser';
        </script>";
    }
}
