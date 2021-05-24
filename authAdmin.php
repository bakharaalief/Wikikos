<?php
if (!isset($_SESSION)) {
    session_start();
}

//if not logged in
if (!isset($_SESSION['id_user'])) {
    echo "<script>
          alert('Maaf, Anda Tidak Mempunyai Akses Ke Halaman Ini')
          window.location = 'index.php';
          </script>";
}

//if level is not admin's level
else if ($_SESSION["level"] != 0) {
    echo "<script>
          alert('Maaf, Anda Tidak Mempunyai Akses Ke Halaman Ini')
          window.location = 'dashboard.php';
          </script>";
}
