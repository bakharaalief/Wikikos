<?php
//get id user
$id_user =  $_GET['id_user'];
?>


<div class="container" id="create-kosan">
    <h1>Buat Kosan</h1>
    <form action="./action/create-kos/create-kos-db.php" method="post" enctype="multipart/form-data">
        <div class="row align-items-start">
            <!-- info kosan -->
            <div class="col">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama-kos" placeholder="Nama Kos" required>
                </div>
                <div class="form-group">
                    <label>Tipe</label>
                    <select class="form-control" name="tipe-kos">
                        <option value="campur">Campur</option>
                        <option value="laki">Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ukuran</label>
                    <input type="text" class="form-control" name="ukuran-kos" placeholder="Ukuran Kos" required>
                </div>
                <div class="form-group">
                    <label>Kapasitas</label>
                    <input type="number" class="form-control" name="kapasitas-kos" placeholder="Kapasitas Kos" required>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" class="form-control" name="harga-kos" placeholder="Harga Kos" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="jalan-kos" placeholder="Nama Jalan" required>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="kecamatan-kos" placeholder="Nama Kecamatan" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="kota-kos" placeholder="Nama Kota" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- gambar dan fasilitas -->
            <div class="col" id="fasilitas-gambar">
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi-kos" rows="3" required></textarea>
                </div>

                <label id="fasilitas-aa">Fasilitas</label>
                <table class="table" id="fasilitas-data">
                    <thead>
                        <tr>
                            <th scope="col">Nama Fasiitas</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <a class="btn btn-primary" id="muncul-fasilitas-modal">Tambah Fasilitas</a>
                <br>

                <label>Gambar</label>
                <input type="file" id="gambar-kos" class="form-control" name="gambar-input" required />
                <img id="image-crop" src="" alt="your image" />

                <br>

                <input type="text" class="form-control" name="id-user" value='<?php echo $id_user; ?>' hidden />

                <button type="submit" class="btn btn-primary">Buat</button>
            </div>
        </div>
    </form>


    <!-- Modal fasilitas -->
    <div class="modal fade" id="fasilitas-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Fasilitas</h5>
                </div>
                <div class="modal-body">
                    <input list="fasilitas" id="fasilitas-kos" class="form-control" name="fasilitas" />
                    <datalist id="fasilitas">
                        <option value="AC">
                        <option value="Kulkas">
                        <option value="Gym">
                        <option value="Kasur">
                        <option value="Meja Belajar">
                        <option value="Lemari">
                        <option value="Kamar Mandi Dalam">
                        <option value="Kamar Mandi Luar">
                    </datalist>
                    <span id="error_fasilitas_kos" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" class="btn btn-secondary" id="close-fasilitas-modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="tambah-fasilitas">Tambah Fasilitas</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./action/create-kos/create-kosan.js" type="text/javascript"></script>