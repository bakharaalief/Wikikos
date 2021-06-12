<?php
require_once("./authAdmin.php");
require_once("./class/class.Kos.php");

$idKos = $_GET['id-kos'];

//fetch data kosan by id
$kos = new Kos();
$kos->idKos = $idKos;
$kos->getStatusKos();
?>

<div class="container" id="edit-user">
    <h1>Edit Status</h1>
    <form action="?p=edit-status-kos-action" method="post">
        <div class="row align-items-start">
            <div class="col">
                <!-- fasilitas -->
                <div class="form-group">
                    <label>Status Kos</label>
                    <select class="form-control" name="status">
                        <option value="0" <?php if ($kos->status == 0) echo 'selected="selected"'; ?>>Review</option>
                        <option value="1" <?php if ($kos->status == 1) echo 'selected="selected"'; ?>>Aktif</option>
                        <option value="2" <?php if ($kos->status == 2) echo 'selected="selected"'; ?>>Tolak</option>
                    </select>
                </div>

                <input type="hidden" name="email-kos" value="<?php echo $kos->user->email; ?>" />
                <input type="hidden" name="id-kos" value="<?php echo $kos->idKos; ?>" />

                <br>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <div class="col"></div>
        </div>
    </form>
</div>