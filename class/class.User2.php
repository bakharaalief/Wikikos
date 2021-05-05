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
    private $NIK;
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

    //create user
    public function createUser()
    {
        try {
            $sql = "INSERT INTO user(fullname, NIK, email, level, username, password) 
            VALUES ('$this->fullname', '$this->NIK', '$this->email', '$this->level', '$this->username', '$this->password')";
            $this->conn->exec($sql);

            return "berhasil daftar";
        } catch (PDOException $e) {
            return "gagal daftar";
        }
    }

    //login function
    public function login($username, $password)
    {
        try {
            $sql = "SELECT * FROM user WHERE username = :username AND password = :password";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $count = $stmt->rowCount(); ///menghitung row

            // jika rownya ada
            if ($count == 1) {

                $this->hasil = "berhasil login";

                $row   = $stmt->fetch(PDO::FETCH_ASSOC);

                $this->idUser = $row['id_user']; // set sesion dengan variabel username
                $this->username = $row['username'];
                $this->password = $row['password'];
                $this->email = $row['email'];
                $this->fullname = $row['fullname'];
                $this->NIK = $row['NIK'];
                $this->level = $row['level'];
            }

            //jika tidak
            else {
                $this->hasil = "tidak ditemukan";
            }
        } catch (PDOException $e) {
            $this->hasil = "gagal login";
        }
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
            $this->NIK = $result['NIK'];
            $this->level = $result['level'];
        }
    }

    //edit user data
    public function editUserData()
    {
        try {
            $sql = "UPDATE user SET username='$this->username', password='$this->password', email='$this->email', 
                    fullname='$this->fullname', NIK='$this->NIK', level='$this->level'
                    WHERE id_user=$this->idUser";
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

            echo $e;
        }
    }

    //get all kosan
    public function getAllKos()
    {
        $sql = "SELECT * FROM kosan WHERE id_user = :id_user";
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
        $lokasi_file,
        $folder
    ) {
        //berhasil membuat kosan
        try {
            //insert bio to kosan
            $sql = "INSERT INTO kosan(nama_kosan, tipe_kos, ukuran, harga, kapasitas, nama_jalan, kecamatan, kota, deskripsi, id_user) 
            VALUES ('$namaKos', '$tipeKos', '$ukuranKos', '$hargaKos', '$kapasitasKos', '$jalanKos', 
            '$kecamatanKos', '$kotaKos', '$deskripsiKos', '$this->idUser')";
            $this->conn->exec($sql);

            //last id insert
            $last_id = $this->conn->lastInsertId();

            //move photo to foto folder
            $succes_move = move_uploaded_file($lokasi_file, $folder . "P" . $last_id . ".png");
            $new_destination = $folder . "P" . $last_id . ".png";

            if ($succes_move) {
                //save photo location to db
                $sql = "INSERT INTO foto_kos(lokasi_foto, id_kosan) VALUES ('$new_destination', '$last_id')";
                $this->conn->exec($sql);
            }

            //insert multiple fasilitas
            $jumlah_fasilitas = count($_POST['hidden_fasilitas_nama']); //jumlah fasilitas
            $query = "INSERT INTO fasilitas_kos(id_fasilitas, nama_fasilitas, id_kosan) VALUES (:id_fasilitas, :nama_fasilitas, :id_kosan)";
            for ($count = 0; $count < $jumlah_fasilitas; $count++) {
                $data = array(
                    ':id_fasilitas' => 'K' . $last_id . 'F' . ($count + 1),
                    ':nama_fasilitas' => $_POST['hidden_fasilitas_nama'][$count],
                    ':id_kosan' => $last_id,
                );

                $statement = $this->conn->prepare($query);
                $statement->execute($data);
            }

            return "berhasil membuat";
        }

        //gagal membuat kosan
        catch (PDOException $e) {
            return "gagal membuat";
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
                $user->password = $result['password'];
                $user->email = $result['email'];
                $user->fullname = $result['fullname'];
                $user->NIK = $result['NIK'];
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
