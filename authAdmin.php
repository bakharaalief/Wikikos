<?php
if (!isset($_SESSION)) {
    session_start();
}

//jika belum login
if (!isset($_SESSION["id_user"])) {
    echo "<script>
        alert('Maaf Anda tidak punya hak mengakses halaman ini :)')
        window.location = 'index.php';
        </script>";
}

//jika level bukan admin
else if ($_SESSION["level"] != 0) {
    echo "<script>
        alert('Maaf Anda tidak punya hak mengakses halaman ini :)')
        window.location = 'dashboard.php';
        </script>";
}
