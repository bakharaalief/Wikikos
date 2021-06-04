<?php
class Fasilitas_Kos extends Connection2
{
    private $idFasilitasKos;
    private $idFasilitas;
    private $nama;
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

    //delete fasilitas kos
    public function deleteKosFasilitas()
    {
        //berhasil hapus fasilitas kos
        try {
            $sql = "DELETE FROM fasilitas_kos WHERE id_fasilitas_kosan = :id_fasilitas_kos";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_fasilitas_kos', $this->idFasilitasKos);
            $stmt->execute();

            return "berhasil menghapus";
        }

        //gagal hapus fasilitas kos
        catch (PDOException $e) {
            return "gagal menghapus";
        }
    }

    //create fasilitas kos
    public function createKosFasilitas()
    {
        //berhasil nambah fasilitas
        try {
            $sql = "INSERT INTO fasilitas_kos(id_fasilitas, id_kosan) 
            VALUES ('$this->idFasilitas', '$this->idKosan')";
            $this->conn->exec($sql);
            return "berhasil daftar";
        }

        //gagal nambah nomor fasilitas
        catch (PDOException $e) {
            return "gagal daftar";
        }
    }

    //cek fasilitas terdaftar
    public function cekFasilitasKos()
    {
        $sql = "SELECT * FROM fasilitas_kos WHERE id_fasilitas = :id_fasilitas AND id_kosan = :id_kosan";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_fasilitas', $this->idFasilitas);
        $stmt->bindParam(':id_kosan', $this->idKosan);
        $stmt->execute();

        $count = $stmt->rowCount();

        //sudah ada
        if ($count == 1) {
            return true;
        }
        //tidak ada
        else {
            return false;
        }
    }
}
