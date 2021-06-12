<?php
require_once("./class/class.Kos.php");

class Search extends Connection2
{
    private $keywords;

    //construct
    function __construct()
    {
        parent::__construct();
    }

    //automatic create get
    public function __get($atribute)
    {
        if (property_exists($this, $atribute)) {
            return $this->$atribute;
        }
    }

    public function __set($atribut, $value)
    {
        if (property_exists($this, $atribut)) {
            $this->$atribut = $value;
        }
    }

    public function search()
    {
        //ini querynya
        $sql = "SELECT * FROM kosan ks INNER JOIN Kota k ON ks.kota = k.id_kota WHERE ( ks.nama_kosan LIKE Concat('%', :search_data, '%') AND status = 1 ) OR ( k.nama_kota LIKE Concat('%', :search_data, '%') AND status = 1 )";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':search_data', $this->keywords);
        $stmt->execute();

        //hitung row kosan
        $count = $stmt->rowCount();
        $cnt = 0;

        if ($count > 0) {
            $arrResult  = array();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $kosUser = new Kos();
                $kosUser->idKos = $result['id_kosan'];
                $kosUser->namaKos = $result['nama_kosan'];
                $kosUser->tipe = $result['tipe_kos'];
                $kosUser->harga = $result['harga'];
                $kosUser->ukuran = $result['ukuran'];
                $kosUser->kapasitas = $result['kapasitas'];
                $kosUser->namaJalan = $result['nama_jalan'];
                $kosUser->kecamatan = $result['kecamatan'];
                $kosUser->kota = $result['nama_kota'];
                $kosUser->user->idUser = $result['id_user'];

                $arrResult[$cnt] = $kosUser;
                $cnt++;
            }

            return $arrResult;
        }

        //tidak ada
        else {
            return $arrResult = "kosong";
        }
    }
}
