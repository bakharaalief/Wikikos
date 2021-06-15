<?php
require_once("./class/class.Kos.php");

class Search extends Connection2
{
    private $keywords;
    private $fasilitas = [];
    private $kota = [];

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
        $sql = "SELECT k.*, kt.nama_kota, group_concat(fk.id_fasilitas) as 'Fasilitas', group_concat(f.nama_fasilitas) as 'Fasilitas' FROM kosan k
                INNER JOIN kota kt ON k.kota=kt.id_kota
                LEFT JOIN fasilitas_kos fk ON k.id_kosan=fk.id_kosan
                LEFT JOIN fasilitas f ON fk.id_fasilitas=f.id_fasilitas
                WHERE k.nama_kosan LIKE Concat('%', :search_data, '%')";

        //ini kalau kedua2nya nggak kosong
        if (!empty($this->fasilitas) && !empty($this->kota)) {
            $fasilitasFilter = implode(',', $this->fasilitas);
            $kotaFilter = implode(',', $this->kota);
            $sql .= "AND k.status = 1 AND f.id_fasilitas IN ($fasilitasFilter) AND k.kota IN ($kotaFilter) GROUP BY k.nama_kosan";
        }

        //ketika fasilitas nggak kosong
        else if (!empty($this->fasilitas)) {
            $fasilitasFilter = implode(',', $this->fasilitas);
            $sql .= "AND k.status = 1 AND f.id_fasilitas IN ($fasilitasFilter) GROUP BY k.nama_kosan";
        }

        //ketika kota tidak kosong
        else if (!empty($this->kota)) {
            $kotaFilter = implode(',', $this->kota);
            $sql .= "AND k.status = 1 AND k.kota IN ($kotaFilter) GROUP BY k.nama_kosan";
        }

        //selain itu
        else {
            $sql .= "AND k.status = 1 GROUP BY k.nama_kosan";
        }

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
