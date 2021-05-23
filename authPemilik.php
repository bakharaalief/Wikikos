<?php
if (!isset($_SESSION)) {
    session_start();
}

//belum login
if (!isset($_SESSION['id_user'])) {
    echo "<script>
        alert('Silahkan Login Terlebih Dahulu')
        window.location = 'index.php?p=login';
        </script>";
}
