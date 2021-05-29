<?php
require_once("./class/class.User2.php");

$fullName = $_POST['namaLengkap'];
$email = $_POST['email'];
$level = $_POST['level'];
$username = $_POST['username'];
$password = $_POST['password'];

//is data empty
if (empty($fullName) | empty($email) | empty($username) | empty($password)) {
    echo "<script>
    alert('Gagal Mendaftarkan user, Pastikan semua data benar')
    window.location = '?p=create-user';
    </script>";
}

//not empty
else {
    $user2 = new User2();
    $user2->username = $username;
    $user2->email = $email;

    //cek email dan username dulu
    $cekEmail = $user2->cekEmail();
    $cekUsername = $user2->cekUsername();

    //email dan username belum ada di DB
    if (!$cekEmail && !$cekUsername) {
        $user2->fullname = $fullName;
        $user2->password = password_hash($password, PASSWORD_DEFAULT);
        $user2->level = $level;

        $hasil = $user2->createUser();

        if ($hasil == "berhasil daftar") {
            echo "<script>
            alert('Berhasil Mendaftarkan user, silahkan Login')
            window.location = '?p=login';
            </script>";
        } else {
            echo "<script>
            alert('Gagal Mendaftarkan user, Pastikan semua data benar')
            window.location = '?p=create-user';
            </script>";
        }
    }

    //email sudah ada 
    else if ($cekEmail) {
        echo "<script>
            alert('Gagal Mendaftarkan user, Email sudah terdaftar')
            window.location = '?p=create-user';
            </script>";
    }

    //username sudah ada 
    else if ($cekUsername) {
        echo "<script>
            alert('Gagal Mendaftarkan user, Username sudah terdaftar')
            window.location = '?p=create-user';
            </script>";
    }

    //email tidak bisa di cek
    else if ($cekEmail == "Email tidak bisa di cek") {
        echo "<script>
            alert('Gagal Mendaftarkan user, Pengecekan email sedang bermasalah')
            window.location = '?p=create-user';
            </script>";
    }

    //username tidak bisa di cek
    else if ($cekEmail == "Username tidak bisa di cek") {
        echo "<script>
            alert('Gagal Mendaftarkan user, Pengecekan username sedang bermasalah')
            window.location = '?p=create-user';
            </script>";
    }
}
