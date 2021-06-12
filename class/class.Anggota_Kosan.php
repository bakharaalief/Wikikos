<?php
class Anggota_Kosan extends Connection2
{
    private $idAnggota;
    private $Nama;
    private $idKos;

    //construct
    function __construct()
    {
        parent::__construct();
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

    //create anggota
    public function createAnggota()
    {
        try {
            $sql = "INSERT INTO anggota_kos(nama_anggota, id_kosan) 
            VALUES ('$this->Nama', '$this->idKos')";
            $this->conn->exec($sql);

            return "berhasil mendaftar";
        } catch (PDOException $e) {
            return "gagal mendaftar";
        }
    }

    //menghapus anggota
    public function deleteAnggota()
    {
        try {
            $sql = "DELETE FROM anggota_kos WHERE id_anggota = :id_anggota";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_anggota', $this->idAnggota);
            $stmt->execute();

            return "berhasil menghapus";
        } catch (PDOException $e) {
            return "gagal menghapus";
        }
    }

    //edit anggota
    public function editAnggota()
    {
        try {
            //update to anggota
            $sql = "UPDATE anggota_kos SET nama_anggota='$this->Nama', id_kosan='$this->idKos'
            WHERE id_anggota=$this->idAnggota";
            $this->conn->exec($sql);

            return "berhasil mengedit";
        } catch (PDOException $e) {
            return "gagal mengedit";
        }
    }
}
