<?php
require_once("./authPemilik.php");
require_once("./class/class.Foto_Kosan.php");

//get 
$idKos = $_POST['id-kos'];
$lokasi_file = @$_FILES['gambar-input']['tmp_name'];
$ukuran_file = @$_FILES['gambar-input']['size'];
$type_file = @$_FILES['gambar-input']['type'];
$folder = './upload/';

//is data empty
if ($lokasi_file == "") {
    echo "<script>
    alert('Gagal Menambahkan Foto')
    window.location = 'dashboard.php?p=create-foto-kos&id-kos=$idKos';
    </script>";
}

//image not compatible
else if ($type_file != "image/gif" and $type_file != "image/jpeg" and $type_file != "image/png") {
    echo "<script>
    alert('Gagal Menambahkan Foto')
    window.location = 'dashboard.php?p=create-foto-kos&id-kos=$idKos';
    </script>";
}

//not empty
else {
    //move photo to foto folder
    $uniquesavename = time() . uniqid(rand());
    $new_destination = $folder . $uniquesavename . ".png";
    $succes_move = move_uploaded_file($lokasi_file, $new_destination);

    if ($succes_move) {
        $foto = new Foto_Kosan();
        $foto->Foto = $new_destination;
        $foto->idKos = $idKos;
        $result = $foto->createKosFoto();

        //berhasil daftar foto
        if ($result == "berhasil daftar") {
            echo "<script>
            alert('Berhasil Menambahkan Foto')
            window.location = 'dashboard.php?p=edit-kos&id-kos=$idKos';
            </script>";
        }

        //gagal 
        else {
            echo "<script>
            alert('Gagal Menambahkan Foto')
            window.location = 'dashboard.php?p=create-foto-kos&id-kos=$idKos';
            </script>";
        }
    }

    //gagal pindah poto 
    else {
        echo "<script>
        alert('Gagal Menambahkan Foto, data tidak berhasil dipindahkan')
        window.location = 'dashboard.php?p=create-foto-kos&id-kos=$idKos';
        </script>";
    }
}
