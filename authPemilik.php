<?php
if (!ISSET($_SESSION)) {
    session_start();
}

//not logged in
if (!ISSET($_SESSION['id_user'])) {
    echo "<script>
    ALERT('Silahkan Login Terlebih Dahulu')
    window.location= 'index.php?p=login';
    </script>";
}

?>

