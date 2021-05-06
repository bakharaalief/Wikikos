<?php


// include("../../inc.connection2.php");
// $email = $_POST['email'];
// //is data email tidak ditemukan
// if (empty($email)) {
//     echo "<script>
//         alert('Gagal Reset Password, Pastikan memasukkan email yang terdaftar')
//         window.location = '/kuliah/project/?p=reset-pass';
//         </script>";

//     //jika data  ditemukan
// } else {
//     try {
//         $sql = "SELECT * FROM user
//         WHERE email LIKE ('$email')";
//         $conn->exec($sql);
//         include("../../reset-mail.php");
//         echo "<script>
//         alert('Berhasil mengirim link reset anda, silahkan cek email anda untuk reset password')
//         window.location = '/kuliah/project/?p=login';
//         </script>";
//     } catch (PDOException $e) {
//         echo "<script>
//         alert('Gagal Reset password user anda, Pastikan email anda benar')
//         window.location = '/kuliah/project/?p=reset-pass';
//         </script>";
//     }
// }
