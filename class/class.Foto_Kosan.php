<?php
class Foto_Kosan
{
    private $idFoto;
    private $Foto;
    private $idKos;

    // public function __construct($idFoto, $Foto,  $idKosan)
    // {
    //     $this->idFoto = $idFoto;
    //     $this->Foto = $Foto;
    //     $this->idKosan = $idKosan;
    // }

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
}
