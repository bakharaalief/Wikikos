<?php
if (!isset($_GET['search-data'])) {
    $keywords = '';
} else {
    $keywords = $_GET['search-data'];
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>


<div class="container" id="search">

    <!-- search form -->
    <form action="/kuliah/project/dashboard.php" method="get">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari Tempat" name="p" value="search" hidden>
            <input type="text" class="form-control" placeholder="Cari Tempat" name="search-data">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">
                    <img src="./image/search-icon.png" width="20" height="20" alt="">
                </button>
            </div>
        </div>
    </form>

    <!-- kos found -->
    <div class="kos-found">
        <?php
        require("./class/class.Search.php");
        $search = new Search();
        $search->keywords = $keywords;
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
                    echo '<img class="card-img-top" alt="Card image cap">';
                    echo '</div>';
                }

                //selain itu
                else {
                    foreach ($allFoto as $dataFoto) {
                        echo '<img class="card-img-top" src="' . substr($dataFoto->Foto, 0) . "?t=" . time() . '" alt="Card image cap">';
                        echo "<div class='card-body' id='card-body'>";
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