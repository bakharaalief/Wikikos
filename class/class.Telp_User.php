<?php
require_once("class.User2.php");

class Telp_User extends Connection2
{
    private $idNoTelp;
    private $NoTelp;

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

    //get telpon
    public function getTelpon()
    {
        $sql = "SELECT * FROM telpon WHERE id_telpon = :id_telpon";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_telpon', $this->idNoTelp);
        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count == 1) {
            $result   = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->idNoTelp = $result['id_telpon']; // set sesion dengan variabel username
            $this->NoTelp = $result['nomor_telpon'];
        }
    }

    //get all no Telp
    public function getAllNoTelp()
    {
        $sql = "SELECT t.*,u.username FROM telpon t INNER JOIN user u ON t.id_user=u.id_user";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $count = $stmt->rowCount();
        $cnt = 0;

        //ada
        if ($count > 0) {
            $arrResult  = array();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $telpon = new Telp_User();
                $telpon->idNoTelp = $result['id_telpon'];
                $telpon->NoTelp = $result['nomor_telpon'];
                $telpon->user->username = $result['username'];

                $arrResult[$cnt] = $telpon;
                $cnt++;
            }

            return $arrResult;
        }

        //tidak ada
        else {
            return $arrResult = "kosong";
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

    //edit fasilitas
    public function editTelpon()
    {
        try {
            $sql = "UPDATE telpon SET nomor_telpon='$this->NoTelp'
                    WHERE id_telpon=$this->idNoTelp";
            $this->conn->exec($sql);

            return "berhasil mengedit";
        } catch (PDOException $e) {
            return "gagal mengedit";
        }
    }
}
