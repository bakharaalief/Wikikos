<?php
require_once("./class/class.User2.php");

//get 
$nomor =  $_POST['nomor'];

//is data empty
if (empty($nomor)) {
    echo "<script>
    alert('Gagal Menambahkan Nomor Telpon')
    window.location = 'dashboard.php?p=profile';
    </script>";
}

//not empty
else {
    $result = $user2->addTelpon($nomor);

    if ($result == "berhasil") {
        echo "<script>
        alert('Berhasil Menambahkan Nomor Telpon')
        window.location = 'dashboard.php?p=profile';
        </script>";
    } else {
        echo "<script>
        alert('Gagal Menambahkan Nomor Telpon')
        window.location = 'dashboard.php?p=profile';
        </script>";
    }
}
