<?php
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

//photo kos
$lokasi_file = @$_FILES['gambar-input']['tmp_name'];
$ukuran_file = @$_FILES['gambar-input']['size'];
$type_file = @$_FILES['gambar-input']['type'];
$folder = './upload/';

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

//image not compatible
else if ($type_file != "image/gif" and $type_file != "image/jpeg" and $type_file != "image/png") {
    echo "<script>
    alert('Gagal Mendaftarkan kosan, Pastikan yang dimasukkan gambar')
    window.location = 'dashboard.php?p=create-kos&id_user=$idUser';
    </script>";
}

//fasilitas kosong
else if (!isset($_POST['hidden_fasilitas_nama'])) {
    echo "<script>
    alert('Gagal Mendaftarkan kosan, Pastikan fasilitas diisi');
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
        $lokasi_file,
        $folder
    );

    //berhasil membuat
    if ($hasil == "berhasil membuat") {
        echo "<script>
        alert('Berhasil Mendaftarkan Kosan')
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
