<?php
require_once("../../connection.php");

$username = $_POST['username'];
$password = $_POST['password'];

//is data empty
if (empty($username) | empty($password)) {
    echo "<script>
    alert('Gagal login, Pastikan semua data diisi dengan benar')
    window.location = '/kuliah/project/?p=login';
    </script>";
}

//not empty
else {
    try {
        $sql = "SELECT * FROM user WHERE username = :username AND password = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $count = $stmt->rowCount(); ///menghitung row

        // jika rownya ada
        if ($count == 1) {

            if (!isset($_SESSION)) {
                session_start();
            }

            $row   = $stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['id_user'] = $row['id_user']; // set sesion dengan variabel username
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['NIK'] = $row['NIK'];
            $_SESSION['level'] = $row['level'];

            // header("location : /kuliah/project/dashboard.php");

            // lempar variabel ke tampilan profile.php
            echo "<script>
            alert('Selamat Datang " . $_SESSION['username'] . "');
            window.location = '/kuliah/project/dashboard.php';
            </script>";
        }

        //jika tidak
        else {
            echo "<script>
            alert('Maaf Password anda salah')
            window.location = '/kuliah/project/?p=login';
            </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
        alert('Gagal Login')
        window.location = '/kuliah/project/?p=login';
        </script>";
    }
}
