<div class="container" id="create-kosan">
    <h1>Buat Kosan</h1>
    <form action="" method="post">
        <div class="row align-items-start">
            <!-- info kosan -->
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="email" class="form-control" name="nama" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Fasilitas</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Kapasitas</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Tipe Kos</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Lokasi</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
            </div>

            <!-- gambar dan fasilitas -->
            <div class="col" id="fasilitas-gambar">
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
                <input type="file" id="gambar-kos" class="form-control" name="fasilitas" />
                <img id="image-crop" src="" alt="your image" />

                <br>
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