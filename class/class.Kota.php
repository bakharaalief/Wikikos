<?php

class Kota extends Connection2
{
    //kosan
    private $idKota;
    private $nama;

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

    //get all fasilitas
    public function getAllKota()
    {
        $sql = "SELECT * FROM kota";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $count = $stmt->rowCount();
        $cnt = 0;

        //ada
        if ($count > 0) {
            $arrResult  = array();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $kota = new Kota();
                $kota->idKota = $result['id_kota'];
                $kota->nama = $result['nama_kota'];

                $arrResult[$cnt] = $kota;
                $cnt++;
            }

            return $arrResult;
        }

        //tidak ada
        else {
            return $arrResult = "kosong";
        }
    }

    //get kota data
    public function getKota()
    {
        $sql = "SELECT * FROM kota WHERE id_kota = :id_kota";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_kota', $this->idKota);
        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count == 1) {
            $result   = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idKota = $result['id_kota']; // set sesion dengan variabel username
            $this->nama = $result['nama_kota'];
        }
    }

    //create kota
    public function createKota()
    {
        try {
            $sql = "INSERT INTO kota(nama_kota) 
            VALUES ('$this->nama')";
            $this->conn->exec($sql);

            return "berhasil daftar";
        } catch (PDOException $e) {
            return "gagal daftar";
        }
    }

    //edit delete kota
    public function deleteKota()
    {
        try {
            $sql = "DELETE FROM kota WHERE id_kota = :id_kota";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_kota', $this->idKota);
            $stmt->execute();

            return "berhasil menghapus";
        } catch (PDOException $e) {
            return "gagal menghapus";
        }
    }

    //edit fasilitas
    public function editKota()
    {
        try {
            $sql = "UPDATE kota SET nama_kota='$this->nama'
                    WHERE id_kota=$this->idKota";
            $this->conn->exec($sql);

            return "berhasil mengedit";
        } catch (PDOException $e) {
            return "gagal mengedit";
        }
    }
}
