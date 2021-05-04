<?php
class Telp_User extends Connection2
{
    private $idNoTelp;
    private $NoTelp;
    private $idUser;

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

    //remove telpon
    public function removeTelpon()
    {
        //berhasil remove
        try {
            $sql = "DELETE FROM telpon WHERE id_telpon = :id_telpon";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_telpon', $this->idNoTelp);
            $stmt->execute();

            return "berhasil menghapus";
        }

        //gagal remove
        catch (PDOException $e) {
            return "gagal menghapus";
        }
    }
}
