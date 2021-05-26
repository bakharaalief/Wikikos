<?php
require_once("./class/class.Kos.php");
require_once("./class/class.Foto_Kosan.php");

$idKos = $_GET['id-kos'];

//fetch data kosan by id
$kos = new Kos();
$kos->idKos = $idKos;
$kos->getKosanData();


function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>

<div class="container" id="kosan">
    <div class="row">
        <?php
        //fetch foto kosan by id
        $allFoto = $kos->getAllPhoto();

        //kosong
        if ($allFoto == "kosong") {
            echo '<div class="col" id="col-1" />';
            echo '<img class="kos-photo" alt="Card image cap">';
            echo '</div>';
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

        <!-- bagian info kosan -->
        <div class="col" id="col-2">
            <!-- nama kos -->
            <h1><?php echo ucwords($kos->namaKos); ?> </h1>

            <!-- harga -->
            <div class="card-info">
                <!-- <img src="./image/money-icon.png" width="20" height="20" alt=""> -->
                <p class="kos-harga"> <?php echo rupiah($kos->harga); ?> / bulan </p>
            </div>

            <br>

            <!-- fasilitas kos -->
            <div class="card-info">
                <img src="./image/house-icon.png" width="20" height="20" alt="">
                <?php
                //fetch fasilitas by id
                $allFasilitas = $kos->getAllFasilitas();

                //kosong
                if ($allFasilitas == "kosong") {
                    echo '<p class="kos-fasilitas">Kosong</p>';
                }

                //selain itu
                else {
                    $string = '';
                    $count = count($allFasilitas);

                    //lebih dari 2
                    if ($count > 2) {
                        $i = 0;
                        foreach ($allFasilitas as $dataFasilitas) {
                            $i++;
                            //last index in array
                            if ($i == $count) {
                                $string =  $string . " - " . $dataFasilitas->nama;
                            }

                            //first index
                            else if ($i == 1) {
                                $string =  $string . $dataFasilitas->nama;
                            }


                            //antara itu index
                            else {
                                $string =  $string . " - " . $dataFasilitas->nama;
                            }
                        }
                    }


                    // jumlah fasilitas 2
                    else if ($count > 1) {
                        $i = 0;
                        foreach ($allFasilitas as $dataFasilitas) {
                            $i++;
                            //last index in array
                            if ($i == $count) {
                                $string =  $string . " - " . $dataFasilitas->nama;
                            }

                            //antara itu index
                            else {
                                $string =  $string . $dataFasilitas->nama;
                            }
                        }
                    }

                    //jumlah fasilitas 1
                    else {
                        $i = 0;
                        foreach ($allFasilitas as $dataFasilitas) {
                            $string =  $string . $dataFasilitas->nama;
                        }
                    }

                    echo '<p class="kos-fasilitas">' . $string . '</p>';
                }
                ?>
            </div>

            <!-- alamat-kos -->
            <div class="card-info">
                <img src="./image/map-icon.png" width="20" height="20" alt="">
                <p class="kos-lokasi"><?php echo ucwords($kos->namaJalan) . ', ' . ucwords($kos->kecamatan) . ', ' . ucwords($kos->kota) ?></p>
            </div>

            <!-- anggota kos -->
            <div class="card-info">
                <img src="./image/person-icon.png" width="20" height="20" alt="">
                <?php
                //fetch anggota by id
                $allAnggota = $kos->getAllAnggota();

                //kosong
                if ($allAnggota == "kosong") {
                    echo '<p class="kos-anggota">Kosong</p>';
                }

                //selain itu
                else {
                    $string = '';
                    $count = count($allAnggota);

                    //lebih dari 2
                    if ($count > 2) {
                        $i = 0;
                        foreach ($allAnggota as $dataAnggota) {
                            $i++;
                            //last index in array
                            if ($i == $count) {
                                $string =  $string . " - " . $dataAnggota->nama;
                            }

                            //first index
                            else if ($i == 1) {
                                $string =  $string . $dataAnggota->nama;
                            }


                            //antara itu index
                            else {
                                $string =  $string . " - " . $dataAnggota->Nama;
                            }
                        }
                    }

                    //lebih dari 1
                    else if ($count > 1) {
                        $i = 0;
                        foreach ($allAnggota as $dataAnggota) {
                            $i++;
                            //last index in array
                            if ($i == $count) {
                                $string =  $string . " - " . $dataAnggota->Nama;
                            }

                            //antara itu index
                            else {
                                $string =  $string . $dataAnggota->Nama;
                            }
                        }
                    }

                    //jumlah fasilitas 1
                    else {
                        $i = 0;
                        foreach ($allAnggota as $dataAnggota) {
                            $string =  $string . $dataAnggota->Nama;
                        }
                    }

                    echo '<p class="kos-fasilitas">' . $string . '</p>';
                }
                ?>
            </div>

            <!-- notes kos -->
            <div class="card-info">
                <img src="./image/pencil-icon.png" width="20" height="20" alt="">
                <p class="kos-lokasi"><?php echo $kos->detail; ?></p>
            </div>

        </div>
    </div>

</div>