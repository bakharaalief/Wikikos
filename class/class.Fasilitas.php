<?php
class Fasilitas
{
    private $idFasilitas;
    private $namaFasilitas;
    private $idKosan;

    public function __construct($idFasilitas, $namaFasilitas, $idKosan)
    {
        $this->idFasilitas = $idFasilitas;
        $this->namaFasilitas = $namaFasilitas;
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
