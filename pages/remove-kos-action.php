<?php
//id kos
$idKos = $_GET['id-kos'];

//is data empty
if (empty($idKos)) {
    echo "<script>
    alert('Gagal Menghapus Kos')
    window.location = '/kuliah/project/dashboard.php?p=profile';
    </script>";
}

//not empty
else {
    $kos = new Kos();
    $kos->idKos = $idKos;
    $hasil = $kos->deleteKos();

    //berhasil menghapus
    if ($hasil == "berhasil menghapus") {
        //admin
        if ($level == 0) {
            echo "<script>
            alert('Berhasil Menghapus Kosan');
            window.location = '/kuliah/project/dashboard.php?p=admin';
            </script>";
        }
        //else
        else {
            echo "<script>
            alert('Berhasil Menghapus Kosan')
            window.location = '/kuliah/project/dashboard.php?p=profile';
            </script>";
        }
    }

    //gagal menghapus
    else {
        echo "<script>
        alert('Gagal Menghapus Kosan')
        window.location = '/kuliah/project/dashboard.php?p=profile';
        </script>";
    }
}
