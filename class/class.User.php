<?php

class User
{
    private $idUser;
    private $username;
    private $password;
    private $email;
    private $nama;
    private $NIK;
    private $level;

    //constructor
    public function __construct(
        $idUser,
        $username,
        $password,
        $email,
        $nama,
        $NIK,
        $level,
    ) {
        $this->idUser = $idUser;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->nama = $nama;
        $this->NIK = $NIK;
        $this->level = $idUser;
    }

    //automatic create get
    public function __get($atribute)
    {
        if (property_exists($this, $atribute)) {
            return $this->$atribute;
        }
    }

    public function wadaw()
    {
    }
}
