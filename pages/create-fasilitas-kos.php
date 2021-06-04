<?php
require_once("./authPemilik.php");
$idKos = $_GET['id-kos'];
?>

<div class="container" id="edit-user">
    <h1>Tambah Fasilitas</h1>
    <form action="?p=create-fasilitas-kos-action" method="post">
        <div class="row align-items-start">
            <div class="col">
                <!-- fasilitas -->
                <div class="form-group">
                    <label>Nama Fasilitas</label>
                    <select class="form-control" id="fasilitas-kos" name="fasilitas">
                        <?php
                        require_once("./class/class.Fasilitas.php");

                        $fasilitas = new Fasilitas();
                        $allFasilitas = $fasilitas->getAllFasilitas();

                        //nomor telpon kosong
                        if ($allFasilitas == "kosong") {
                            echo "<option>Maaf Data Kosong</option>";
                            $count = 0;
                        }

                        //nomor telpon ada
                        else {
                            $count = count($allFasilitas);
                            foreach ($allFasilitas as $dataFasilitas) {
                                echo "<option value=$dataFasilitas->idFasilitas>" . $dataFasilitas->nama . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <br>

                <input type="hidden" name="id-kos" value="<?php echo $idKos; ?>" />

                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <div class="col"></div>
        </div>
    </form>
</div>