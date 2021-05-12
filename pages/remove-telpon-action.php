<?php

//get 
$id_telpon =  $_GET['id_telpon'];

//is data empty
if (empty($id_telpon)) {
    echo "<script>
    alert('Gagal Menghapus Nomor Telpon')
    window.location = 'dashboard.php?p=profile';
    </script>";
}

//not empty
else {
    $telponUser = new Telp_User();
    $telponUser->idNoTelp = $id_telpon;
    $status = $telponUser->removeTelpon();

    if ($status == "berhasil menghapus") {
        echo "<script>
        alert('Berhasil Menghapus Nomor Telpon')
        window.location = 'dashboard.php?p=profile';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Menghapus Nomor Telpon')
        window.location = 'dashboard.php?p=profile';
        </script>";
    }
}
