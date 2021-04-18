<?php
include("../../connection.php");

$fullName = $_POST['namaLengkap'];
$NIK = $_POST['NIK'];
$email = $_POST['email'];
$level = $_POST['level'];
$username = $_POST['username'];
$password = $_POST['password'];

//is data empty
if (empty($fullName) | empty($NIK) | empty($email) | empty($username) | empty($password)) {
    echo "<script>
    alert('Gagal Mendaftarkan user, Pastikan semua data benar')
    window.location = '/kuliah/project/?p=create-user';
    </script>";
}

//not empty
else {
    try {
        $sql = "INSERT INTO user(fullname, NIK, email, level, username, password) 
        VALUES ('$fullName', '$NIK', '$email', '$level', '$username', '$password')";
        $conn->exec($sql);

        echo "<script>
        alert('Berhasil Mendaftarkan user, silahkan login kembali')
        window.location = '/kuliah/project/?p=login';
        </script>";
    } catch (PDOException $e) {
        echo "<script>
        alert('Gagal Mendaftarkan user, Pastikan semua data benar')
        window.location = '/kuliah/project/?p=create-user';
        </script>";
    }
}
