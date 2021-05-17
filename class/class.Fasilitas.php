<?php
class Fasilitas extends Connection2
{
    private $idFasilitasKos;
    private $nama;
    private $idFasilitas;
    private $idKosan;

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
    public function getAllFasilitas()
    {
        $sql = "SELECT * FROM fasilitas";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $count = $stmt->rowCount();
        $cnt = 0;

        //ada
        if ($count > 0) {
            $arrResult  = array();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $fasilitas = new Fasilitas();
                $fasilitas->idFasilitas = $result['id_fasilitas'];
                $fasilitas->nama = $result['nama_fasilitas'];

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

    //get fasilitas data
    public function getFasilitas()
    {
        $sql = "SELECT * FROM fasilitas WHERE id_fasilitas = :id_fasilitas";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_fasilitas', $this->idFasilitas);
        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count == 1) {
            $result   = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idFasilitas = $result['id_fasilitas']; // set sesion dengan variabel username
            $this->nama = $result['nama_fasilitas'];
        }
    }

    //create fasilitas
    public function createFasilitas()
    {
        try {
            $sql = "INSERT INTO fasilitas(nama_fasilitas) 
            VALUES ('$this->nama')";
            $this->conn->exec($sql);

            return "berhasil daftar";
        } catch (PDOException $e) {
            return "gagal daftar";
        }
    }

    //edit delete fasilitas
    public function deleteFasilitas()
    {
        try {
            $sql = "DELETE FROM fasilitas WHERE id_fasilitas = :id_fasilitas";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_fasilitas', $this->idFasilitas);
            $stmt->execute();

            return "berhasil menghapus";
        } catch (PDOException $e) {
            return "gagal menghapus";
        }
    }

    //edit user data
    public function editFasilitas()
    {
        try {
            $sql = "UPDATE fasilitas SET nama_fasilitas='$this->nama'
                    WHERE id_fasilitas=$this->idFasilitas";
            $this->conn->exec($sql);

            return "berhasil mengedit";
        } catch (PDOException $e) {
            return "gagal mengedit";
        }
    }
}
