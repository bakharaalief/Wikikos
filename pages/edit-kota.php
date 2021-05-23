<?php
require_once("./authAdmin.php");
require_once("./class/class.Kota.php");

$idKota = $_GET['id-kota'];

//fetch data kosan by id
$kota = new Kota();
$kota->idKota = $idKota;
$kota->getKota();
?>

<div class="container" id="edit-user">
    <h1>Edit Kota</h1>
    <form action="?p=edit-kota-action" method="post">
        <div class="row align-items-start">
            <div class="col">
                <!-- fasilitas -->
                <div class="form-group">
                    <label>Nama Kota</label>
                    <input type="text" class="form-control" placeholder="Nama Kota" name="namaKota" value="<?php echo $kota->nama; ?>" required>
                </div>

                <input type="hidden" name="id-kota" value="<?php echo $kota->idKota; ?>" />

                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <div class="col"></div>
        </div>
    </form>
</div>