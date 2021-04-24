<?php
class Foto_Kosan
{
    private $idFoto;
    private $Foto;
    private $idKosan;

    public function __construct($idFoto, $Foto,  $idKosan)
    {
        $this->idFoto = $idFoto;
        $this->Foto = $Foto;
        $this->idKosan = $idKosan;
    }

    //automatic create get
    public function __get($atribute)
    {
        if (property_exists($this, $atribute)) {
            return $this->$atribute;
        }
    }
}
