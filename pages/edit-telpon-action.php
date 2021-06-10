<?php
require_once("./authPemilik.php");
require_once("./class/class.Telp_User.php");

//anggota info
$idTelpon = $_POST['id-telpon'];
$nomor_telpon = $_POST['noTelp'];

//data empty
if (empty($idTelpon) | empty($nomor_telpon)) {
    echo "<script>
    alert('Gagal Memperbaharui Nomor Telpon, Pastikan semua data benar')
    window.location = 'dashboard.php?p=edit-telpon&id-telpon=$idTelpon';
    </script>";
}

//not empty
else {
    $telpon = new Telp_User();
    $telpon->idNoTelp = $idTelpon;
    $telpon->NoTelp = $nomor_telpon;
    $hasil = $telpon->editTelpon();

    if ($hasil == "berhasil mengedit") {
        if ($level == 0) {
            echo "<script>
            alert('Berhasil Memperbaharui Nomor Telpon')
            window.location = 'dashboard.php?p=admin';
            </script>";
        } else {
            echo "<script>
            alert('Berhasil Memperbaharui Nomor Telpon')
            window.location = 'dashboard.php?p=profile';
            </script>";
        }
    } else {
        echo "<script>
        alert('Gagal Memperbaharui Nomor Telpon')
        window.location = 'dashboard.php?p=edit-telpon&id-telpon=$idTelpon';
        </script>";
    }
}
