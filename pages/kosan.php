<?php
require_once("./class/class.Kos.php");
require_once("./class/class.Foto_Kosan.php");

$idKos = $_GET['id-kos'];

//fetch data kosan by id
$kos = new Kos();
$kos->idKos = $idKos;
$kos->getKosanData();

?>

<div class="container" id="kosan">
    <div class="row">
        <?php
            //fetch foto kosan by id
            $allFoto = $kos->getAllPhoto();

            //kosong
            if ($allFoto == "kosong") {
                return;
                }

            //selain itu
            else {
                foreach ($allFoto as $dataFoto) {
                    echo '<div class="col" id="col-1" />';
                    echo '<img class="kos-photo" src="' . substr($dataFoto->Foto, 0) . '" alt="Card image cap">';
                    echo '</div>';
                    }
                }
        ?>
        <!-- <div class="col" id="col-1">
            <img class="kos-photo" src="https://pix10.agoda.net/hotelImages/361/3612573/3612573_18012114440061220336.jpg?s=1024x768" alt="Card image cap">
        </div> -->
        <div class="col" id="col-2">
            <h1><?php echo $kos->namaKos; ?> </h1>
            <div class="card-info">
                <img src="./image/money-icon.png" width="20" height="20" alt="">
                <p class="kos-harga"><?php echo $kos->harga; ?></p>
            </div>
            <div class="card-info">
            <img src="./image/house-icon.png" width="20" height="20" alt="">
                <?php
                    //fetch fasilitas by id
                    $allFasilitas = $kos->getAllFasilitas();

                    //kosong
                    if ($allFasilitas == "kosong") {
                        return;
                        }

                    //selain itu
                    else {
                        foreach ($allFasilitas as $dataFasilitas) {
                            echo '<p class="kos-fasilitas"> '.$dataFasilitas->nama. ' ' .' </p>';
                            }
                        }
                ?>
            </div>
            <div class="card-info">
                <img src="./image/person-icon.png" width="20" height="20" alt="">
                <?php
                    //fetch anggota by id
                    $allAnggota = $kos->getAllAnggota();

                    //kosong
                    if ($allAnggota == "kosong") {
                        return;
                        }

                    //selain itu
                    else {
                        foreach ($allAnggota as $dataAnggota) {
                            echo '<p class="kos-anggota"> '.$dataAnggota->Nama. ' ' . ' </p>';
                            }
                        }
                ?>
            </div>
            <div class="card-info">
                <img src="./image/map-icon.png" width="20" height="20" alt="">
                <p class="kos-lokasi"><?php echo $kos->namaJalan, ' ', $kos->kecamatan, ' ', $kos->kota ?></p>
            </div>
        </div>
    </div>

</div>