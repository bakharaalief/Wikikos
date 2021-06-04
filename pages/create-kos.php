<?php
require_once("./authPemilik.php");
?>

<div class="container" id="create-kosan">
    <h1>Buat Kosan</h1>
    <form action="?p=create-kos-action" method="post" enctype="multipart/form-data">
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

                        <!-- yg baru -->
                        <div class="col">
                            <select class="form-control" id="exampleFormControlSelect1" name="kota-kos">
                                <?php
                                require_once("./class/class.Kota.php");

                                $kota = new Kota();
                                $allKota = $kota->getAllKota();

                                //kota kosong
                                if ($allKota == "kosong") {
                                    echo "<tr>";
                                    echo "<td><p>Maaf Data Kosong</p></td>";
                                    echo "<tr>";
                                    $count = 0;
                                }

                                //kota ada
                                else {
                                    $count = count($allKota);
                                    $jumlahKota = 0;
                                    foreach ($allKota as $dataKota) {
                                        if ($dataKota->idKota == $kos->kota)
                                            $output = "<option value=" . $dataKota->idKota  . " selected='selected'>" . $dataKota->nama . "</option>";
                                        else {
                                            $output = "<option value=" . $dataKota->idKota  . " >" . $dataKota->nama . "</option>";
                                        }
                                        echo $output;
                                    }
                                }
                                ?>
                            </select>
                        </div>


                        <!-- yg lama -->
                        <!-- <div class="col">
                            <input type="text" class="form-control" name="kota-kos" placeholder="Nama Kota" required>
                        </div> -->
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi-kos" rows="3" required></textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Buat</button>
    </form>


    <!-- Modal fasilitas -->
    <div class="modal fade" id="fasilitas-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Fasilitas</h5>
                </div>
                <div class="modal-body">

                    <!-- yg baru -->
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
                                echo "<option value='" . $dataFasilitas->nama . '-' . $dataFasilitas->idFasilitas . "' >" . $dataFasilitas->nama . "</option>";
                            }
                        }
                        ?>
                    </select>

                    <!-- yg lama -->
                    <!-- <input list="fasilitas" id="fasilitas-kos" class="form-control" name="fasilitas" />
                    <datalist id="fasilitas">
                        <option value="AC">
                        <option value="Kulkas">
                        <option value="Gym">
                        <option value="Kasur">
                        <option value="Meja Belajar">
                        <option value="Lemari">
                        <option value="Kamar Mandi Dalam">
                        <option value="Kamar Mandi Luar">
                    </datalist> -->

                    <span id="error_fasilitas_kos" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="button" class="btn btn-secondary" id="close-fasilitas-modal">Close</button>

                    <!-- handle tambah fasilitas button -->
                    <?php
                    if ($count == 0) {
                        echo '<button type="submit" class="btn btn-primary" id="tambah-fasilitas2" disabled>Tambah Fasilitas</button>';
                    } else {
                        echo '<button type="submit" class="btn btn-primary" id="tambah-fasilitas">Tambah Fasilitas</button>';
                    }
                    ?>

                    <!-- button lama -->
                    <!-- <button type="submit" class="btn btn-primary" id="tambah-fasilitas">Tambah Fasilitas</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="./js/create-kos.js" type="text/javascript"></script> -->