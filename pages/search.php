<?php
$search = $_GET['search-data'];
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

    <?php
    require_once("./class/class.Kos.php");

    //ini querynya
    $sql = "SELECT * FROM kosan WHERE nama_kosan LIKE Concat(:search_data, '%')";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':search_data', $search);
    $stmt->execute();

    //hitung row kosan
    $count = $stmt->rowCount();

    //kos yang ketemu
    echo "<h1>$count Ketemu</h1>";
    ?>


    <!-- kos found -->
    <div class="kos-found">

        <?php

        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $idKos = $result['id_kosan'];
            $namaKos = $result['nama_kosan'];
            $tipeKos = $result['tipe_kos'];
            $ukuranKos = $result['ukuran'];
            $hargaKos = $result['harga'];
            $kapasitasKos = $result['kapasitas'];
            $namaJalan = $result['nama_jalan'];
            $kecamatan = $result['kecamatan'];
            $kota = $result['kota'];
            $detail = $result['deskripsi'];
            $idUser = $result['id_user'];

            //buat kos
            $kos = new Kos($idKos, $namaKos, $tipeKos, $ukuranKos, $hargaKos, $kapasitasKos, $detail, $namaJalan, $kecamatan, $kota, $idUser);

            echo "<div class='card' id='kos-item' onclick='location.href=\"?p=kosan\"'>";
            //kosan photo
            echo "<img class='card-img-top' src='https://cf.bstatic.com/images/hotel/max1024x768/208/208038194.jpg' alt='Card image cap'>";
            echo "<div class='card-body' id='card-body'>";

            //nama kosan
            echo "<h5 class='card-title'>$kos->namaKos</h5>";

            //info kos fasilitas
            echo "<div class='card-info'>";
            echo "<img src='./image/house-icon.png' width='20' height='20' alt=''>";
            echo "<p>Tv, Meja Makan, Kursi</p>";
            echo "</div>";

            //info kos lokasi
            echo "<div class='card-info'>";
            echo "<img src='./image/map-icon.png' width='20' height='20' alt=''>";
            echo "<p>$kos->namaJalan, $kos->kecamatan, $kos->kota </p>";
            echo "</div>";

            //info kos harga
            echo "<div class='card-info'>";
            echo "<img src='./image/money-icon.png' width='20' height='20' alt=''>";
            echo "<p>Rp $kos->harga</p>";
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
        ?>

        <!-- <div class="card" id="kos-item" onclick='location.href="?p=kosan"'>
            <img class="card-img-top" src="https://cf.bstatic.com/images/hotel/max1024x768/208/208038194.jpg" alt="Card image cap">
            <div class="card-body" id="card-body">
                <h5 class="card-title">Kostan Bu Haji</h5>
                <div class="card-info">
                    <img src="./image/house-icon.png" width="20" height="20" alt="">
                    <p class="kos-fasilitas">Tv, Meja Makan, Kursi</p>
                </div>
                <div class="card-info">
                    <img src="./image/map-icon.png" width="20" height="20" alt="">
                    <p class="kos-lokasi">Cilandak</p>
                </div>
                <div class="card-info">
                    <img src="./image/money-icon.png" width="20" height="20" alt="">
                    <p class="kos-harga">1.500.000</p>
                </div>
                <div class="card-info">
                    <img src="./image/person-icon.png" width="20" height="20" alt="">
                    <p class="kos-aktif">3 Aktif</p>
                </div>
            </div>
        </div> -->
    </div>
</div>