<?php
class Tempat_Kosan
{
    private $namaJalan;
    private $Kota;
    private $Kecamatan;
    private $idKosan;

    public function __construct($namaJalan, $Kota, $Kecamatan, $idKosan)
    {
        $this->namaJalan = $namaJalan;
        $this->Kota = $Kota;
        $this->Kecamatan = $Kecamatan;
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
