<?php
class Anggota_Kosan
{
    private $idAnggota;
    private $NIKAnggota;
    private $NamaAnggota;
    private $idKosan;

    public function __construct($idAnggota, $NIKAnggota, $NamaAnggota, $idKosan)
    {
        $this->idAnggota = $idAnggota;
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
