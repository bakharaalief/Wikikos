<?php
require_once("../../connection.php");

//kos info
$namaKos = $_POST['nama-kos'];
$tipeKos = $_POST['tipe-kos'];
$ukuranKos = $_POST['ukuran-kos'];
$kapasitasKos = $_POST['kapasitas-kos'];
$hargaKos = $_POST['harga-kos'];
$jalanKos = $_POST['jalan-kos'];
$kecamatanKos = $_POST['kecamatan-kos'];
$kotaKos = $_POST['kota-kos'];
$deskripsiKos = $_POST['kota-kos'];
$idUser = $_POST['id-user'];

//photo kos
$lokasi_file = @$_FILES['gambar-input']['tmp_name'];
$nama_file = @$_FILES['gambar-input']['name'];
$ukuran_file = @$_FILES['gambar-input']['size'];
$type_file = @$_FILES['gambar-input']['type'];
$folder = '../../upload/';


// is data empty
if (
    empty($namaKos) | empty($tipeKos) | empty($ukuranKos) | empty($kapasitasKos) | empty($hargaKos) | empty($jalanKos)
    | empty($kecamatanKos) | empty($kotaKos) | empty($kotaKos) | empty($deskripsiKos)
) {
    echo "<script>
    alert('Gagal Mendaftarkan kosan, Pastikan semua data benar')
    window.location = '/kuliah/project/dashboard.php?p=create-kos&id_user=$idUser';
    </script>";
}

//image not compatible
else if ($type_file != "image/gif" and $type_file != "image/jpeg" and $type_file != "image/png") {
    echo "<script>
    alert('Gagal Mendaftarkan kosan, Pastikan yang dimasukkan gambar')
    window.location = '/kuliah/project/dashboard.php?p=create-kos&id_user=$idUser';
    </script>";
}

//fasilitas kosong
else if (!isset($_POST['hidden_fasilitas_nama'])) {
    echo "<script>
    alert('Gagal Mendaftarkan kosan, Pastikan fasilitas diisi');
    window.location = '/kuliah/project/dashboard.php?p=create-kos&id_user=$idUser';
    </script>";
}

//not empty
else {
    try {
        //insert bio to kosan
        $sql = "INSERT INTO kosan(nama_kosan, tipe_kos, ukuran, harga, kapasitas, nama_jalan, kecamatan, kota, deskripsi, id_user) 
        VALUES ('$namaKos', '$tipeKos', '$ukuranKos', '$kapasitasKos', '$hargaKos', '$jalanKos', 
        '$kecamatanKos', '$kotaKos', '$deskripsiKos', '$idUser')";
        $conn->exec($sql);

        //last id insert
        $last_id = $conn->lastInsertId();

        //move photo to foto folder
        $succes_move = move_uploaded_file($lokasi_file, $folder . $nama_file);
        $new_destination = $folder . $nama_file;

        //save photo location to db
        $sql = "INSERT INTO foto_kos(lokasi_foto, id_kosan) 
        VALUES ('$new_destination', '$last_id')";
        $conn->exec($sql);

        //insert multiple fasilitas
        $jumlah_fasilitas = count($_POST['hidden_fasilitas_nama']); //jumlah fasilitas
        $query = "INSERT INTO fasilitas_kos(nama_fasilitas, id_kosan) VALUES (:nama_fasilitas, :id_kosan)";
        for ($count = 0; $count < $jumlah_fasilitas; $count++) {
            $data = array(
                ':nama_fasilitas' => $_POST['hidden_fasilitas_nama'][$count],
                ':id_kosan' => $last_id,
            );

            $statement = $conn->prepare($query);
            $statement->execute($data);
        }

        echo "<script>
        alert('Berhasil Mendaftarkan Kosan')
        window.location = '/kuliah/project/dashboard.php?p=profile';
        </script>";
    } catch (PDOException $e) {
        echo "<script>
        alert('Gagal Mendaftarkan kosan, Pastikan semua data benar')
        window.location = '/kuliah/project/dashboard.php?p=create-kos&id_user=$idUser';
        </script>";
    }
}
