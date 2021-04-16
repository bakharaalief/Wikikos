<?php
class Foto_Kosan
{
    private $Foto;
    private $idKosan;

    public function __construct($Foto,  $idKosan)
    {
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
