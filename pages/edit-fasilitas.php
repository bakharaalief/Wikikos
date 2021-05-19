<?php
require_once("./authAdmin.php");
require_once("./class/class.Fasilitas.php");

$idFasilitas = $_GET['id-fasilitas'];

//fetch data kosan by id
$fasilitas = new Fasilitas();
$fasilitas->idFasilitas = $idFasilitas;
$fasilitas->getFasilitas();
?>

<div class="container" id="edit-user">
    <h1>Edit Fasilitas</h1>
    <form action="?p=edit-fasilitas-action" method="post">
        <div class="row align-items-start">
            <div class="col">
                <!-- fasilitas -->
                <div class="form-group">
                    <label>Nama Fasilitas</label>
                    <input type="text" class="form-control" placeholder="Nama Fasilitas" name="namaFasilitas" value="<?php echo $fasilitas->nama; ?>" required>
                </div>

                <input type="hidden" name="id-fasilitas" value="<?php echo $fasilitas->idFasilitas; ?>" />

                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <div class="col"></div>
        </div>
    </form>
</div>