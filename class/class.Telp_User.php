<?php
class Telp_User
{
    private $idNoTelp;
    private $NoTelp;
    private $idUser;

    public function __construct($idNoTelp, $NoTelp, $idUser)
    {
        $this->idNoTelp = $idNoTelp;
        $this->NoTelp = $NoTelp;
        $this->idUser = $idKosan;
    }

    //automatic create get
    public function __get($atribute)
    {
        if (property_exists($this, $atribute)) {
            return $this->$atribute;
        }
    }
}
