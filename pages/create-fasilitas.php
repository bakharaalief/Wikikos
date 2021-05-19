<?php
require_once("./authAdmin.php");
?>

<div class="container" id="edit-user">
    <h1>Tambah Fasilitas</h1>
    <form action="?p=create-fasilitas-action" method="post">
        <div class="row align-items-start">
            <div class="col">
                <!-- fasilitas -->
                <div class="form-group">
                    <label>Nama Fasilitas</label>
                    <input type="text" class="form-control" placeholder="Nama Fasilitas" name="namaFasilitas" required>
                </div>

                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <div class="col"></div>
        </div>
    </form>
</div>