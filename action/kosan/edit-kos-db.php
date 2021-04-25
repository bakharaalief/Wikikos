<?php
require_once("../../connection.php");

//kos info
$idKos = $_POST['id-kos'];
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
$idFoto = $_POST['id-foto'];

// is data empty
if (
    empty($namaKos) | empty($tipeKos) | empty($ukuranKos) | empty($kapasitasKos) | empty($hargaKos) | empty($jalanKos)
    | empty($kecamatanKos) | empty($kotaKos) | empty($kotaKos) | empty($deskripsiKos)
) {
    echo "<script>
    alert('Gagal Memperbaharui kosan, Pastikan semua data benar')
    window.location = '/kuliah/project/dashboard.php?p=edit-kos&id-kos=$idKos';
    </script>";
}

//image not compatible
// else if ($type_file != "image/gif" and $type_file != "image/jpeg" and $type_file != "image/png") {
//     echo "<script>
//     alert('Gagal Memperbaharui kosan, Pastikan yang dimasukkan gambar')
//     window.location = '/kuliah/project/dashboard.php?p=edit-kos&id-kos=$idKos';
//     </script>";
// }

//fasilitas kosong
else if (!isset($_POST['hidden_fasilitas_nama'])) {
    echo "<script>
    alert('Gagal Memperbaharui kosan, Pastikan fasilitas diisi');
    window.location = '/kuliah/project/dashboard.php?p=edit-kos&id-kos=$idKos';
    </script>";
}

//not empty
else {
    try {
        //insert bio to kosan
        $sql = "UPDATE kosan SET nama_kosan='$namaKos', tipe_kos='$tipeKos', ukuran='$ukuranKos', 
        harga='$hargaKos', kapasitas='$kapasitasKos', nama_jalan='$jalanKos', 
        kecamatan='$kecamatanKos', kota='$kotaKos', deskripsi='$deskripsiKos', id_user='$idUser'
        WHERE id_kosan=$idKos";
        $conn->exec($sql);

        //move photo to foto folder
        $succes_move = move_uploaded_file($lokasi_file, $folder . $nama_file);
        $new_destination = $folder . $nama_file;

        //save photo location to db jika diperbaharui
        if ($lokasi_file != "") {
            $sql = "UPDATE foto_kos SET lokasi_foto='$new_destination', id_kosan='$idKos' 
        WHERE id_foto='$idFoto'";
            $conn->exec($sql);
        }

        //delete all fasilitas before
        $sql = "SELECT * FROM fasilitas_kos WHERE id_kosan = :id_kosan";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_kosan', $idKos);
        $stmt->execute();

        $sql = "DELETE FROM fasilitas_kos WHERE id_fasilitas = :id_fasilitas";
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $idFasilitas = $result['id_fasilitas'];
            $data = array(
                ':id_fasilitas' => $idFasilitas,
            );

            $statement = $conn->prepare($sql);
            $statement->execute($data);
        }

        $sql = "DELETE FROM fasilitas_kos WHERE id_fasilitas = :id_fasilitas";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_fasilitas', $idFasilitas);
        $stmt->execute();

        //insert multiple fasilitas
        $jumlah_fasilitas = count($_POST['hidden_fasilitas_nama']); //jumlah fasilitas
        $query = "INSERT INTO fasilitas_kos(id_fasilitas, nama_fasilitas, id_kosan) VALUES (:id_fasilitas, :nama_fasilitas, :id_kosan)";
        for ($count = 0; $count < $jumlah_fasilitas; $count++) {
            $data = array(
                ':id_fasilitas' => 'K' . $idKos . 'F' . ($count + 1),
                ':nama_fasilitas' => $_POST['hidden_fasilitas_nama'][$count],
                ':id_kosan' => $idKos,
            );

            $statement = $conn->prepare($query);
            $statement->execute($data);
        }

        echo "<script>
        alert('Berhasil Memperbaharui Kosan')
        window.location = '/kuliah/project/dashboard.php?p=profile';
        </script>";
    } catch (PDOException $e) {
        echo "<script>
        alert('Gagal Memperbaharui kosan, Pastikan semua data benar')
        window.location = '/kuliah/project/dashboard.php?p=edit-kos&id-kos=$idKos';
        </script>";
    }
}
