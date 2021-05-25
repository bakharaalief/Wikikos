<?php
$keywords = $_GET['search-data'];
?>


<div class="container" id="search">
    <!-- search form -->
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari Tempat">
        <div class="input-group-append">
            <button onclick="location.href='?p=search'" class="btn btn-outline-secondary" type="button">
                <img src="./image/search-icon.png" width="20" height="20" alt="">
            </button>
        </div>
    </div>

    <!-- kos found -->
    <div class="kos-found">
    <?php
        require("./class/class.Search.php");
        $search = new Search();
        $search->keywords= $keywords;
        $allKos = $search->search();

        if ($allKos == "kosong") {
            echo "<tr>";
            echo "<td><p>Maaf Data Kosong</p></td>";
            echo "<tr>";
            $count = 0;
        }

        else {
            $count = count($allKos);

            foreach ($allKos as $dataKos) {

            echo "<div class='card' id='kos-item' onclick='location.href=\"?p=kosan&id-kos=$dataKos->idKos\"'>";
            //kosan photo
            echo "<img class='card-img-top' src='https://cf.bstatic.com/images/hotel/max1024x768/208/208038194.jpg' alt='Card image cap'>";
            echo "<div class='card-body' id='card-body'>";

            //nama kosan
            echo "<h5 class='card-title'>$dataKos->namaKos</h5>";

            //info kos fasilitas
            echo "<div class='card-info'>";
            echo "<img src='./image/house-icon.png' width='20' height='20' alt=''>";
            echo "<p>Tv, Meja Makan, Kursi</p>";
            echo "</div>";

            //info kos lokasi
            echo "<div class='card-info'>";
            echo "<img src='./image/map-icon.png' width='20' height='20' alt=''>";
            echo "<p>$dataKos->namaJalan, $dataKos->kecamatan, $dataKos->kota </p>";
            echo "</div>";

            //info kos harga
            echo "<div class='card-info'>";
            echo "<img src='./image/money-icon.png' width='20' height='20' alt=''>";
            echo "<p>Rp $dataKos->harga</p>";
            echo "</div>";

            //info mhs aktif
            echo "<div class='card-info'>";
            echo "<img src='./image/person-icon.png' width='20' height='20' alt=''>";
            echo "<p>3 Aktif</p>";
            echo "</div>";

            //
            echo "</div>";
            echo "</div>";
        }
    }

        ?>
    </div>
</div>
