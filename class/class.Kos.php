<?php
class Kos
{
    private $idKosan;
    private $namaKos;
    private $tipe;
    private $ukuran;
    private $harga;
    private $kapasitas;
    private $detail;
    private $namaJalan;
    private $kecamatan;
    private $kota;
    private $idUser;

    //constructor
    public function __construct(
        $idKosan,
        $namaKos,
        $tipe,
        $ukuran,
        $harga,
        $kapasitas,
        $detail,
        $namaJalan,
        $kecamatan,
        $kota,
        $idUser
    ) {
        $this->idKosan = $idKosan;
        $this->namaKos = $namaKos;
        $this->tipe = $tipe;
        $this->ukuran = $ukuran;
        $this->harga = $harga;
        $this->kapasitas = $kapasitas;
        $this->detail = $detail;
        $this->namaJalan = $namaJalan;
        $this->kecamatan = $kecamatan;
        $this->kota = $kota;
        $this->idUser = $idUser;
    }

    //automatic create get
    public function __get($atribute)
    {
        if (property_exists($this, $atribute)) {
            return $this->$atribute;
        }
    }
}
