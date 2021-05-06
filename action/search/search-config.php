<?php
include("../../connection.php");
$keywords = $_POST['keywords'];
//is data email tidak ditemukan
if (empty($keywords)) {
    echo "<script>
        alert('Gagal Reset Password, Pastikan memasukkan email yang terdaftar')
        window.location = '/kuliah/project/?p=reset-pass';
        </script>";

    //jika data  ditemukan
} else {
    try {
        $sql = "SELECT * FROM user 
        WHERE username Like 'beneran' ";
        $conn->exec($sql);
        echo "<table>";
        echo "<tr><th>id</th><th>user</th><th>pass</th><th>email</th><th>fullname</th><th>NIK</th><th>level</th>";
        foreach ($conn->query($sql) as $row) {
            echo "<tr ><td>$row[id]</td><td>$row[user]</td><td>$row[pass]</td><td>$row[email]</td><td>$row[fullname]</td><td>$row[NIk]</td><td>$row[level]</td></tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "<br>";
    }
}
