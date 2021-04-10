<?php
class Fasilitas
{
    private $idFasilitas;
    private $fasilitas;
    private $idKosan;

    public function __construct($idFasilitas, $fasilitas, $idKosan)
    {
        $this->idFasilitas = $idFasilitas;
        $this->fasilitas = $fasilitas;
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
