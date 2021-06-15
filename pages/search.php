<?php
if (!isset($_GET['search-data'])) {
    $keywords = '';
} else {
    $keywords = $_GET['search-data'];
}

//go to rupiah
function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

//fasilitas
$checked = [];
if (isset($_GET['fasilitas'])) {
    $checked = $_GET['fasilitas'];
}

//kota
$checkedKota = [];
if (isset($_GET['kota'])) {
    $checkedKota = $_GET['kota'];
}

//get url to normal
function data($url)
{
    $string = rawurldecode($url);
    $new_string = str_replace('+', ' ', $string);
    return $new_string;
}
?>


<div class="container" id="search">

    <!-- search form -->
    <form action="index.php" method="get">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari Tempat" name="p" value="search" hidden>

            <?php
            if (!isset($_GET['search-data'])) {
                echo '<input type="text" class="form-control" placeholder="Cari Kos" name="search-data">';
            } else {
                echo '<input type="text" class="form-control" placeholder="Cari Kos" name="search-data" value=\'' . data($_GET['search-data']) . '\'>';
            }
            ?>

            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">
                    <img src="./image/search-icon.png" width="20" height="20" alt="">
                </button>
            </div>
        </div>


        <!-- kos found -->
        <div class="row">
            <!-- col-1 -->
            <div class="col-2">

                <!-- fasilitas -->
                <h3>Fasilitas</h3>
                <?php
                require_once("./class/class.Fasilitas.php");
                $fasilitas = new Fasilitas();
                $allFasilitas = $fasilitas->getAllFasilitas();

                //fasilitas kosong
                if ($allFasilitas == "kosong") {
                    echo "<tr>";
                    echo "<td><p>Maaf Data Kosong</p></td>";
                    echo "<tr>";
                }

                //fasilitas ada
                else {
                    foreach ($allFasilitas as $dataFasilitas) {
                        $status = "";
                        if (in_array($dataFasilitas->idFasilitas, $checked)) {
                            $status = "checked";
                        }
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input fasilitas-selector" type="checkbox" name="fasilitas[]" value="' . $dataFasilitas->idFasilitas . '" id="flexCheckDefault"' . $status . '>';
                        echo '<label class="form-check-label" for="flexCheckDefault">' . $dataFasilitas->nama . '</label>';
                        echo '</div>';
                    }
                }
                ?>

                <br>

                <!-- daerah -->
                <h3>Kota</h3>
                <?php
                require_once("./class/class.Kota.php");
                $kota = new Kota();
                $allKota = $kota->getAllKota();

                //fasilitas kosong
                if ($allKota == "kosong") {
                    echo "<tr>";
                    echo "<td><p>Maaf Data Kosong</p></td>";
                    echo "<tr>";
                }

                //fasilitas ada
                else {
                    foreach ($allKota as $dataKota) {
                        $status = "";
                        if (in_array($dataKota->idKota, $checkedKota)) {
                            $status = "checked";
                        }
                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="checkbox" name="kota[]" value="' . $dataKota->idKota . '" id="flexCheckDefault"' . $status . '>';
                        echo '<label class="form-check-label" for="flexCheckDefault">' . $dataKota->nama . '</label>';
                        echo '</div>';
                    }
                }
                ?>
            </div>

            <!-- col-2 -->
            <div class="col-10">
                <div class=" kos-found">
                    <?php
                    require("./class/class.Search.php");
                    $search = new Search();
                    $search->keywords = $keywords;
                    $search->fasilitas = $checked;
                    $search->kota = $checkedKota;
                    $allKos = $search->search();

                    //kosan kosong
                    if ($allKos == "kosong") {
                        echo "<tr>";
                        echo "<td><p>Maaf Data Kosong</p></td>";
                        echo "<tr>";
                        $count = 0;
                    }

                    //ada isinya
                    else {
                        $count = count($allKos);
                        foreach ($allKos as $dataKos) {

                            //location after click item
                            echo "<div class='card' id='kos-item' onclick='location.href=\"?p=kosan&id-kos=$dataKos->idKos\"'>";

                            //kosan photo
                            $allFoto = $dataKos->getAllPhoto();
                            //kosong
                            if ($allFoto == "kosong") {
                                echo '<img class="card-img-top" src="./image/no-image-found.png" alt="Card image cap">';
                                echo "<div class='card-body' id='card-body'>";
                            }

                            //selain itu
                            else {
                                $jumlah = count($allFoto);
                                $i = 0;

                                foreach ($allFoto as $dataFoto) {
                                    $i++;

                                    //munculin satu gambar saja
                                    if ($i <= 1) {
                                        echo '<img class="card-img-top" src="' . substr($dataFoto->Foto, 0) . "?t=" . time() . '" alt="Card image cap">';
                                        echo "<div class='card-body' id='card-body'>";
                                    }
                                }
                            }



                            //nama kosan
                            echo "<h5 class='card-title'>" . ucwords($dataKos->namaKos) . "</h5>";



                            //info kos harga
                            echo "<div class='card-info'>";
                            echo "<img src='./image/money-icon.png' width='20' height='20' alt=''>";
                            echo "<p>" . rupiah($dataKos->harga) . " / bulan</p>";
                            echo "</div>";



                            //info kos fasilitas
                            echo "<div class='card-info'>";
                            echo "<img src='./image/house-icon.png' width='20' height='20' alt=''>";
                            //fetch fasilitas by id
                            $allFasilitas = $dataKos->getAllFasilitas();

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

                                        //lebih dari 3
                                        else if ($i > 2) {
                                            $string =  $string . " - dll. ";
                                            break;
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

                                echo "<p>" . $string . "</p>";
                            }
                            echo "</div>";


                            //tipe kos
                            echo "<div class='card-info'>";
                            echo "<img src='./image/type-icon.png' width='20' height='20' alt=''>";
                            echo "<p>" . ucwords($dataKos->tipe) . "</p>";
                            echo "</div>";


                            //tipe kos
                            echo "<div class='card-info'>";
                            echo "<img src='./image/size-icon.png' width='20' height='20' alt=''>";
                            echo "<p>$dataKos->ukuran</p>";
                            echo "</div>";


                            //info kos lokasi
                            echo "<div class='card-info'>";
                            echo "<img src='./image/map-icon.png' width='20' height='20' alt=''>";
                            echo "<p>$dataKos->namaJalan, $dataKos->kecamatan, $dataKos->kota </p>";
                            echo "</div>";


                            //info mhs aktif
                            echo "<div class='card-info'>";
                            echo "<img src='./image/person-icon.png' width='20' height='20' alt=''>";
                            $allAnggota = $dataKos->getAllAnggota();
                            //kosong
                            if ($allAnggota == "kosong") {
                                echo "<p>Kosong</p>";
                            }
                            //selain itu
                            else {
                                $count = count($allAnggota);
                                echo "<p>" . $count . " Aktif </p>";
                            }
                            echo "</div>";



                            echo "</div>";
                            echo "</div>";
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </form>
</div>