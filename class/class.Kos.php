<?php
require_once("class.User2.php");

class Kos extends Connection2
{
    //kosan
    private $idKos;
    private $namaKos;
    private $tipe;
    private $ukuran;
    private $harga;
    private $kapasitas;
    private $detail;
    private $namaJalan;
    private $kecamatan;
    private $kota;
    private $status;

    //pemilik
    private $user;

    //construct
    function __construct()
    {
        parent::__construct();
        $this->user = new User2();
    }

    //automatic create get
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

    //get one kosan
    public function getKosanData()
    {
        $sql = "SELECT * FROM kosan ks INNER JOIN kota k ON ks.kota = k.id_kota WHERE ks.id_kosan = :id_kosan";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_kosan', $this->idKos);
        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count == 1) {
            $result   = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idKos = $result['id_kosan'];
            $this->namaKos = $result['nama_kosan'];
            $this->tipe = $result['tipe_kos'];
            $this->ukuran = $result['ukuran'];
            $this->harga = $result['harga'];
            $this->kapasitas = $result['kapasitas'];
            $this->namaJalan = $result['nama_jalan'];
            $this->kecamatan = $result['kecamatan'];
            $this->kota = $result['nama_kota'];
            $this->detail = $result['deskripsi'];
            $this->user->idUser = $result['id_user'];
        }
    }

    //get all kos
    public function getAllKos()
    {
        $sql = "SELECT * FROM kosan k INNER JOIN user u ON k.id_user=u.id_user Inner JOIN kota kt ON k.kota=kt.id_kota 
                ORDER BY k.nama_kosan ASC";
        $stmt = $this->conn->prepare($sql);
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
                $kosUser->kota = $result['nama_kota'];
                $kosUser->user->idUser = $result['id_user'];
                $kosUser->status = $result['status'];
                $kosUser->user->username = $result['username'];

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

    //delete kos
    public function deleteKos()
    {
        //berhasil hapus kos
        try {
            $sql = "DELETE FROM kosan WHERE id_kosan = :id_kosan";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_kosan', $this->idKos);
            $stmt->execute();

            return "berhasil menghapus";
        }

        //gagal hapus
        catch (PDOException $e) {
            return "gagal menghapus";
        }
    }

    //edit kos profile
    public function editKosProfile()
    {
        try {
            //insert bio to kosan
            $sql = "UPDATE kosan SET nama_kosan='$this->namaKos', tipe_kos='$this->tipe', ukuran='$this->ukuran', 
            harga='$this->harga', kapasitas='$this->kapasitas', nama_jalan='$this->namaJalan', 
            kecamatan='$this->kecamatan', kota='$this->kota', deskripsi='$this->detail', id_user=" . $this->user->idUser . "
            WHERE id_kosan=$this->idKos";
            $this->conn->exec($sql);

            return "berhasil mengedit";
        } catch (Exception $e) {
            return "gagal mengedit";
        }
    }

    //get status kos
    public function getStatusKos()
    {
        try {
            $sql = "SELECT k.status, u.email FROM kosan k INNER JOIN user u ON u.id_user = k.id_user WHERE K.id_kosan=$this->idKos";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->status = $result['status'];
            $this->user->email = $result['email'];

            return "Berhasil mengambil data";
        } catch (PDOException $e) {
            return "gagal mengambil data";
        }
    }

    //edit status kos
    public function editStatusKos()
    {
        try {
            $sql = "UPDATE kosan SET status='$this->status'
                    WHERE id_kosan=$this->idKos";
            $this->conn->exec($sql);

            return "berhasil mengedit";
        } catch (PDOException $e) {
            return "gagal mengedit";
        }
    }

    //get all foto Kosan
    public function getAllPhoto()
    {
        $sql = "SELECT * FROM foto_kos WHERE id_kosan = :id_kosan";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_kosan', $this->idKos);
        $stmt->execute();

        $count = $stmt->rowCount();
        $cnt = 0;

        require_once("class.Foto_Kosan.php");

        //ada
        if ($count > 0) {
            $arrResult  = array();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $fotoKos = new Foto_Kosan();
                $fotoKos->idFoto = $result['id_foto'];
                $fotoKos->Foto = $result['lokasi_foto'];
                $fotoKos->idKos = $result['id_kosan'];

                $arrResult[$cnt] = $fotoKos;
                $cnt++;
            }

            return $arrResult;
        }

        //tidak ada
        else {
            return $arrResult = "kosong";
        }
    }

    //get all anggota kosan
    public function getAllAnggota()
    {
        require_once("./class/class.Anggota_Kosan.php");

        $sql = "SELECT * FROM anggota_kos WHERE id_kosan = :id_kosan";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_kosan', $this->idKos);
        $stmt->execute();

        $count = $stmt->rowCount();
        $cnt = 0;

        //ada
        if ($count > 0) {
            $arrResult  = array();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $anggotaKos = new Anggota_Kosan();
                $anggotaKos->idAnggota = $result['id_anggota'];
                $anggotaKos->Nama = $result['nama_anggota'];
                $anggotaKos->idKosan = $result['id_kosan'];

                $arrResult[$cnt] = $anggotaKos;
                $cnt++;
            }

            return $arrResult;
        }

        //tidak ada
        else {
            return $arrResult = "kosong";
        }
    }

    //get all anggota kosan
    public function getAllFasilitas()
    {
        $sql = "SELECT fk.id_fasilitas_kosan, fk.id_fasilitas, fk.id_kosan, f.nama_fasilitas FROM fasilitas_kos fk INNER JOIN fasilitas f ON  fk.id_fasilitas= f.id_fasilitas WHERE id_kosan = :id_kosan";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_kosan', $this->idKos);
        $stmt->execute();

        $count = $stmt->rowCount();
        $cnt = 0;

        //ada
        if ($count > 0) {
            $arrResult  = array();
            require_once("class.Fasilitas_Kos.php");

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $fasilitas = new Fasilitas_Kos();
                $fasilitas->idFasilitasKos = $result['id_fasilitas_kosan'];
                $fasilitas->idFasilitas = $result['id_fasilitas'];
                $fasilitas->nama = $result['nama_fasilitas'];
                $fasilitas->idKosan = $result['id_kosan'];

                $arrResult[$cnt] = $fasilitas;
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
