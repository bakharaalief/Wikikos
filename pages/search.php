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

    <!-- result text -->
    <h1>10 Kos Found</h1>

    <!-- kos found -->
    <div class="kos-found">

        <div class="card" id="kos-item" onclick="location.href='?p=kosan'">
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
                    <p class="kos-harga">3 Aktif</p>
                </div>
            </div>
        </div>
    </div>
</div>