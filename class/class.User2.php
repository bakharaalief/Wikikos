<?php
require_once("class.Telp_User.php");
require_once("class.Kos.php");

class User2 extends Connection2
{
    private $hasil;
    private $idUser;
    private $username;
    private $password;
    private $email;
    private $fullname;
    private $level;

    //auto get
    public function __get($atribute)
    {
        if (property_exists($this, $atribute)) {
            return $this->$atribute;
        }
    }

    //auto set
    public function __set($atribut, $value)
    {
        if (property_exists($this, $atribut)) {
            $this->$atribut = $value;
        }
    }

    //cek email
    public function cekEmail()
    {
        try {
            $sql = "SELECT * FROM user WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();

            $count = $stmt->rowCount(); ///menghitung row

            // jika rownya ada
            if ($count == 1) {
                return true;
            }

            //jika tidak
            else {
                return false;
            }
        } catch (PDOException $e) {
            return "Email tidak bisa di cek";
        }
    }

    //cek Email and get Data
    public function cekEmailData()
    {
        try {
            $sql = "SELECT * FROM user WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();

            $count = $stmt->rowCount(); ///menghitung row

            // jika rownya ada
            if ($count == 1) {
                $result   = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->idUser = $result['id_user']; // set sesion dengan variabel username
                $this->username = $result['username'];
                $this->password = $result['password'];
                $this->email = $result['email'];
                $this->fullname = $result['fullname'];
                $this->level = $result['level'];
                return true;
            }

            //jika tidak
            else {
                return false;
            }
        } catch (PDOException $e) {
            return "Email tidak bisa di cek";
        }
    }

    public function cekUsername()
    {
        try {
            $sql = "SELECT * FROM user WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $this->username);
            $stmt->execute();

            $count = $stmt->rowCount(); ///menghitung row

            // jika rownya ada
            if ($count == 1) {
                return true;
            }

            //jika tidak
            else {
                return false;
            }
        } catch (PDOException $e) {
            return "Username tidak bisa di cek";
        }
    }

    //create user
    public function createUser()
    {
        try {
            $sql = "INSERT INTO user(fullname, email, level, username, password) 
            VALUES ('$this->fullname', '$this->email', '$this->level', '$this->username', '$this->password')";
            $this->conn->exec($sql);

            return "berhasil daftar";
        } catch (PDOException $e) {
            return "gagal daftar";
        }
    }

    //reset pass user
    public function resetPass()
    {
        try {

            //if password null
            $newPass = password_hash($this->password, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET password='$newPass' WHERE id_user=$this->idUser";
            $this->conn->exec($sql);

            return "berhasil mengedit";
        } catch (PDOException $e) {
            return "gagal mengedit";
        }
    }

    //login function
    public function login($username, $password)
    {
        try {
            $sql = "SELECT * FROM user WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);

            //berhasil login
            if (!empty($row) && password_verify($password, $row['password'])) {
                $this->idUser = $row['id_user']; // set sesion dengan variabel username
                $this->username = $row['username'];
                $this->password = $row['password'];
                $this->email = $row['email'];
                $this->fullname = $row['fullname'];
                $this->level = $row['level'];

                $this->hasil = "berhasil login";
            }

            //jika tidak
            else {
                $this->hasil = "tidak ditemukan";
            }
        } catch (PDOException $e) {
            $this->hasil = "gagal login";
        }



        // try {
        //     $sql = "SELECT * FROM user WHERE username = :username AND password = :password";
        //     $stmt = $this->conn->prepare($sql);
        //     $stmt->bindParam(':username', $username);
        //     $stmt->bindParam(':password', $password);
        //     $stmt->execute();

        //     $count = $stmt->rowCount(); ///menghitung row

        //     // jika rownya ada
        //     if ($count == 1) {

        //         $this->hasil = "berhasil login";

        //         $row   = $stmt->fetch(PDO::FETCH_ASSOC);

        //         $this->idUser = $row['id_user']; // set sesion dengan variabel username
        //         $this->username = $row['username'];
        //         $this->password = $row['password'];
        //         $this->email = $row['email'];
        //         $this->fullname = $row['fullname'];
        //         $this->level = $row['level'];
        //     }

        //     //jika tidak
        //     else {
        //         $this->hasil = "tidak ditemukan";
        //     }
        // } catch (PDOException $e) {
        //     $this->hasil = "gagal login";
        // }
    }

    //get user data
    public function getUserData()
    {
        $sql = "SELECT * FROM user WHERE id_user = :id_user";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_user', $this->idUser);
        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count == 1) {
            $result   = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idUser = $result['id_user']; // set sesion dengan variabel username
            $this->username = $result['username'];
            $this->password = $result['password'];
            $this->email = $result['email'];
            $this->fullname = $result['fullname'];
            $this->level = $result['level'];
        }
    }

    //edit user data
    public function editUserData()
    {
        try {
            //if password null
            if ($this->password == "") {
                $sql = "UPDATE user SET username='$this->username', email='$this->email', 
                    fullname='$this->fullname', level='$this->level'
                    WHERE id_user=$this->idUser";
            }

            //if password not null
            else {
                $newPass = password_hash($this->password, PASSWORD_DEFAULT);
                $sql = "UPDATE user SET username='$this->username', password='$newPass', email='$this->email', 
                    fullname='$this->fullname', level='$this->level'
                    WHERE id_user=$this->idUser";
            }

            $this->conn->exec($sql);

            return "berhasil mengedit";
        } catch (PDOException $e) {
            return "gagal mengedit";
        }
    }

    //edit user data
    public function deleteUserData()
    {
        try {
            $sql = "DELETE FROM user WHERE id_user = :id_user";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_user', $this->idUser);
            $stmt->execute();

            return "berhasil menghapus";
        } catch (PDOException $e) {
            return "gagal menghapus";
        }
    }

    //get all nomor telpon
    public function getAllTelpon()
    {
        $sql = "SELECT * FROM telpon WHERE id_user = :id_user";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_user', $this->idUser);
        $stmt->execute();

        $count = $stmt->rowCount();
        $cnt = 0;

        //ada
        if ($count > 0) {
            $arrResult  = array();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $telpUser = new Telp_User();
                $telpUser->idNoTelp = $result['id_telpon'];
                $telpUser->NoTelp = $result['nomor_telpon'];
                $telpUser->idUser = $result['id_user'];

                $arrResult[$cnt] = $telpUser;
                $cnt++;
            }

            return $arrResult;
        }

        //tidak ada
        else {
            return $arrResult = "kosong";
        }
    }

    //add nomor telpon
    public function addTelpon($nomor)
    {
        //berhasil nambah telpon
        try {
            $sql = "INSERT INTO telpon(nomor_telpon, id_user) 
            VALUES ('$nomor', '$this->idUser')";
            $this->conn->exec($sql);
            return "berhasil";
        }

        //gagal nambah nomor telpon
        catch (PDOException $e) {
            return "gagal";
        }
    }

    //get all kosan
    public function getAllKos()
    {
        // $sql = "SELECT * FROM kosan WHERE id_user = :id_user";
        $sql = "SELECT * FROM kosan ks Inner JOIN kota k ON ks.kota=k.id_kota WHERE id_user = :id_user ORDER BY ks.nama_kosan ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_user', $this->idUser);
        $stmt->execute();

        $count = $stmt->rowCount();
        $cnt = 0;

        //ada
        if ($count > 0) {
            $arrResult  = array();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $kosUser = new Kos();
                $kosUser->idKos = $result['id_kosan'];
                $kosUser->namaKos = $result['nama_kosan'];
                $kosUser->tipe = $result['tipe_kos'];
                $kosUser->harga = $result['harga'];
                $kosUser->kapasitas = $result['kapasitas'];
                $kosUser->idUser = $result['id_user'];
                $kosUser->kota = $result['nama_kota'];
                $kosUser->status = $result['status'];
                $arrResult[$cnt] = $kosUser;
                $cnt++;
            }

            return $arrResult;
        }

        //tidak ada
        else {
            return $arrResult = "kosong";
        }
    }

    //create kos
    public function createKos(
        $namaKos,
        $tipeKos,
        $ukuranKos,
        $hargaKos,
        $kapasitasKos,
        $jalanKos,
        $kecamatanKos,
        $kotaKos,
        $deskripsiKos,
    ) {
        //berhasil membuat kosan
        try {
            //insert bio to kosan
            $sql = "INSERT INTO kosan(nama_kosan, tipe_kos, ukuran, harga, kapasitas, nama_jalan, kecamatan, kota, deskripsi, id_user) 
            VALUES ('$namaKos', '$tipeKos', '$ukuranKos', '$hargaKos', '$kapasitasKos', '$jalanKos', 
            '$kecamatanKos', '$kotaKos', '$deskripsiKos', '$this->idUser')";
            $this->conn->exec($sql);

            return "berhasil membuat";
        }

        //gagal membuat kosan
        catch (PDOException $e) {
            // return "gagal membuat";
            echo $e;
        }
    }

    //get all user
    public function getAllUser()
    {
        $sql = "SELECT * FROM user";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $count = $stmt->rowCount();
        $cnt = 0;

        //ada
        if ($count > 0) {
            $arrResult  = array();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $user = new User2();
                $user->idUser = $result['id_user']; // set sesion dengan variabel username
                $user->username = $result['username'];
                $user->email = $result['email'];
                $user->fullname = $result['fullname'];
                $user->level = $result['level'];

                $arrResult[$cnt] = $user;
                $cnt++;
            }

            return $arrResult;
        }

        //tidak ada
        else {
            return $arrResult = "kosong";
        }
    }
}
