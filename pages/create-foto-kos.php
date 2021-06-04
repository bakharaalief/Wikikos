<?php
require_once("./authPemilik.php");
$idKos = $_GET['id-kos'];
?>

<div class="container" id="edit-foto">
    <h1>Tambah Foto</h1>
    <form action="?p=create-foto-kos-action" method="post" enctype="multipart/form-data">
        <div class="row align-items-start">
            <div class="col">
                <!-- fasilitas -->
                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" id="gambar-kos" class="form-control" name="gambar-input" required />
                    <img id="image-crop" src="" alt="your image" />
                </div>

                <br>

                <input type="hidden" name="id-kos" value="<?php echo $idKos; ?>" />

                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <div class="col"></div>
        </div>
    </form>
</div>

<script src="./js/create-foto.js" type="text/javascript"></script>