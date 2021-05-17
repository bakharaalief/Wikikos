<?php
require_once("./class/class.User2.php");

$username = $_POST['username'];
$password = $_POST['password'];

//is data empty
if (empty($username) | empty($password)) {
    echo "<script>
    alert('Gagal login, Pastikan semua data diisi dengan benar')
    window.location = '?p=login';
    </script>";
}

//not empty
else {
    $user2 = new User2();

    //login
    $user2->login($username, $password);

    //berhasil login
    if ($user2->hasil == "berhasil login") {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['id_user'] = $user2->idUser; // set sesion dengan variabel username
        $_SESSION['username'] = $user2->username;
        $_SESSION['password'] = $user2->password;
        $_SESSION['email'] = $user2->email;
        $_SESSION['fullname'] = $user2->fullname;
        $_SESSION['level'] = $user2->level;

        // lempar variabel ke tampilan profile.php
        echo "<script>
                alert('Selamat Datang " . $user2->username . "');
                window.location = 'dashboard.php';
            </script>";
    }

    //user not found
    else if ($user2->hasil == "tidak ditemukan") {
        echo "<script>
            alert('Maaf Password anda salah')
            window.location = '?p=login';
            </script>";
    }

    //gagal login
    else if ($user2->hasil == "gagal login") {
        echo "<script>
            alert('Gagal Login')
            window.location = '?p=login';
            </script>";
    }
}
