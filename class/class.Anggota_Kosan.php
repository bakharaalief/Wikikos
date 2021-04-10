<?php
class Anggota_Kosan
{
    private $NIKAnggota;
    private $NamaAnggota;
    private $idKosan;

    public function __construct($NIKAnggota, $NamaAnggota, $idKosan)
    {
        $this->NIKAnggota = $NIKAnggota;
        $this->NamaAnggota = $NamaAnggota;
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
