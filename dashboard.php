<?php
require("./inc.connection2.php");
require_once("./class/class.User2.php");
require_once("./authPemilik.php");

if (!isset($_SESSION)) {
    session_start();
}

$idUser = $_SESSION['id_user'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$email = $_SESSION['email'];
$fullname = $_SESSION['fullname'];
$level = $_SESSION['level'];

//user object
$user2 = new User2();
$user2->idUser = $idUser;
$user2->level = $level;
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wikikos</title>

    <!-- bootsrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- google font -->
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- jquery cdn -->
    <script src="./js/jquerry.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="./dashboard.php">
                <img src="./image/logo.png" width="60" height="60" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item-login">
                        <a class="nav-link" href="?p=logout-action">logout</a>
                    </li>
                    <li class="nav-item-create">
                        <?php
                        if ($level == 0) {
                            echo '<a class="nav-link" href="?p=admin">' . $username .
                                '</a>';
                        } else {
                            echo '<a class="nav-link" href="?p=profile">' . $fullname .
                                '</a>';
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- content -->
    <?php
    $pages_dir = 'pages';
    if (!empty($_GET['p'])) {
        $pages = scandir($pages_dir, 0);
        unset($pages[0], $pages[1]);

        $p = $_GET['p'];

        if (in_array($p . '.php', $pages)) {
            include($pages_dir . '/' . $p .  '.php');
        } else {
            echo "Halaman Tidak Ditemukan";
        }
    } else {
        include "./pages/home.php";
    }
    ?>
</body>

</html>