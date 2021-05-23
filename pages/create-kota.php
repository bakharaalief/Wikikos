<?php
require_once("./authAdmin.php");
?>

<div class="container" id="edit-user">
    <h1>Tambah Kota</h1>
    <form action="?p=create-kota-action" method="post">
        <div class="row align-items-start">
            <div class="col">
                <!-- fasilitas -->
                <div class="form-group">
                    <label>Nama Kota</label>
                    <input type="text" class="form-control" placeholder="Nama Kota" name="namaKota" required>
                </div>

                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <div class="col"></div>
        </div>
    </form>
</div>