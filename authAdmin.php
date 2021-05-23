<?php
if(!ISSET($_SESSION)) {
    session_start();
}

//if not logged in
if(!ISSET($_SESSION['id_user'])) {
    echo "<script>
          ALERT('Maaf, Anda Tidak Mempunyai Akses Ke Halaman Ini')
          window.location = 'index.php';
          </script>";
}

//if level is not admin's level
else if(!ISSET($_SESSION["level"] != 0)) {
    echo "<script>
          ALERT('Maaf, Anda Tidak Mempunyai Akses Ke Halaman Ini')
          window.location = 'index.php';
          </script>";
}
?>

