<?php
require_once("./authPemilik.php");
require_once("./class/class.Telp_User.php");

$idTelpon = $_GET['id-telpon'];

//fetch data kosan by id
$telpon = new Telp_User();
$telpon->idNoTelp = $idTelpon;
$telpon->getTelpon();
?>

<div class="container" id="edit-user">
    <h1>Edit Telpon</h1>
    <form action="?p=edit-telpon-action" method="post">
        <div class="row align-items-start">
            <div class="col">
                <!-- fasilitas -->
                <div class="form-group">
                    <label>Nomor Telpon</label>
                    <input type="text" class="form-control" placeholder="Nomor Telpon" name="noTelp" value="<?php echo $telpon->NoTelp; ?>" required>
                </div>

                <input type="hidden" name="id-telpon" value="<?php echo $telpon->idNoTelp; ?>" />

                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <div class="col"></div>
        </div>
    </form>
</div>