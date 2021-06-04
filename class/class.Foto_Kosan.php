<?php
class Foto_Kosan extends Connection2
{
    private $idFoto;
    private $Foto;
    private $idKos;

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

    //delete foto kos
    public function deleteKosFoto()
    {
        //berhasil hapus foto kos
        try {
            $sql = "DELETE FROM foto_kos WHERE id_foto = :id_foto";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_foto', $this->idFoto);
            $stmt->execute();

            return "berhasil menghapus";
        }

        //gagal hapus foto kos
        catch (PDOException $e) {
            return "gagal menghapus";
        }
    }

    //create kosan foto
    public function createKosFoto()
    {
        //berhasil nambah foto
        try {
            $sql = "INSERT INTO foto_kos(lokasi_foto, id_kosan) 
            VALUES ('$this->Foto', '$this->idKos')";
            $this->conn->exec($sql);
            return "berhasil daftar";
        }

        //gagal nambah foto
        catch (PDOException $e) {
            return "gagal daftar";
        }
    }
}
