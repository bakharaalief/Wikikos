<?php
require_once("./authPemilik.php");
require_once("./class/class.Kos.php");
require_once("./class/class.Foto_Kosan.php");

$idKos = $_GET['id-kos'];

//fetch data kosan by id
$kos = new Kos();
$kos->idKos = $idKos;
$kos->getKosanData();
?>

<div class="container" id="edit-kosan">
    <!-- judul -->
    <h1>Edit Kosan</h1>

    <div class="aa">
        <a class="btn btn-primary" href=<?php echo "?p=create-fasilitas-kos&id-kos=$kos->idKos" ?>>Tambah Fasilitas</a>
        <a class="btn btn-primary" href=<?php echo "?p=create-foto-kos&id-kos=$kos->idKos" ?>>Tambah Foto</a>
    </div>

    <!-- tab -->
    <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#fasilitas" role="tab" aria-controls="fasilitas" aria-selected="false">Fasilitas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#foto" role="tab" aria-controls="foto aria-selected=" false">Foto</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <!-- profile -->
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="home-tab">

            <form action="?p=edit-kos-action" method="post" enctype="multipart/form-data">
                <!-- info kosan -->
                <div class="col">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama-kos" placeholder="Nama Kos" value='<?php echo $kos->namaKos; ?>' required>
                    </div>
                    <div class="form-group">
                        <label>Tipe</label>
                        <select class="form-control" name="tipe-kos">
                            <option value="campur" <?php if ($kos->tipe == 'campur') echo 'selected="selected"'; ?>>Campur</option>
                            <option value="laki" <?php if ($kos->tipe == 'laki') echo 'selected="selected"'; ?>>Laki</option>
                            <option value="perempuan" <?php if ($kos->tipe == 'perempuan') echo 'selected="selected"'; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ukuran</label>
                        <input type="text" class="form-control" name="ukuran-kos" placeholder="Ukuran Kos" value='<?php echo $kos->ukuran; ?>' required>
                    </div>
                    <div class="form-group">
                        <label>Kapasitas</label>
                        <input type="number" class="form-control" name="kapasitas-kos" placeholder="Kapasitas Kos" value='<?php echo $kos->kapasitas; ?>' required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" class="form-control" name="harga-kos" placeholder="Harga Kos" value='<?php echo $kos->harga; ?>' required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="jalan-kos" placeholder="Nama Jalan" value='<?php echo $kos->namaJalan; ?>' required>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="kecamatan-kos" placeholder="Nama Kecamatan" value='<?php echo $kos->kecamatan; ?>' required>
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
                            <input type="text" class="form-control" name="kota-kos" placeholder="Nama Kota" value='<?php echo $kos->kota; ?>' required>
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="deskripsi-kos" rows="3" required><?php echo $kos->detail; ?></textarea>
                    </div>

                    <input type="hidden" name="id-kos" value="<?php echo $kos->idKos; ?>" />
                    <input type="hidden" name="id-user" value="<?php echo $kos->idUser; ?>" />

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>

        <!-- fasilitas -->
        <div class="tab-pane fade" id="fasilitas" role="tabpanel" aria-labelledby="home-tab">

            <table class="table" id="fasilitas">
                <thead>
                    <tr>
                        <th scope="col">Nama Fasilitas</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- kosan get from db -->
                    <?php
                    require_once("./class/class.Fasilitas.php");
                    $allFasilitas = $kos->getAllFasilitas();

                    //kosan kosong
                    if ($allFasilitas == "kosong") {
                        echo "<tr>";
                        echo "<td><p>Maaf Data Kosong</p></td>";
                        echo "<tr>";
                        $count = 0;
                    }

                    //kosan ada
                    else {
                        $count = count($allFasilitas);
                        foreach ($allFasilitas as $dataFasilitas) {
                            echo "<tr>";
                            echo "<td>$dataFasilitas->nama</td>";
                            echo "<td><a class='btn btn-primary' onclick='confirmDataFasilitas($dataFasilitas->idFasilitasKos, $kos->idKos)'>Delete</a></td>";
                            echo "<tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- foto -->
        <div class="tab-pane fade" id="foto" role="tabpanel" aria-labelledby="home-tab">

            <table class="table" id="fasilitas">
                <thead>
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- kosan get from db -->
                    <?php
                    $allFoto = $kos->getAllPhoto();

                    //kosan kosong
                    if ($allFoto == "kosong") {
                        echo "<tr>";
                        echo "<td><p>Maaf Data Kosong</p></td>";
                        echo "<tr>";
                        $count = 0;
                    }

                    //kosan ada
                    else {
                        $count = count($allFoto);
                        foreach ($allFoto as $dataFoto) {
                            echo "<tr>";
                            echo '<td><img id="image-crop" src="' . $dataFoto->Foto . '" alt="your image" /></td>';
                            echo "<td><a class='btn btn-primary' onclick='confirmDataFoto($dataFoto->idFoto, $kos->idKos," . "\"" . $dataFoto->Foto . "\"" . ")'>Delete</a></td>";
                            echo "<tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal fasilitas -->
<div class="modal fade" id="fasilitas-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Fasilitas</h5>
                <button type="button" class="btn btn-secondary" id="close-fasilitas-modal">Close</button>
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
                        $count = 0;
                        echo "<option id='kosong'>Maaf Data Kosong</option>";
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
                <!-- <input list="fasilitas" id="fasilitas-kos" class="form-control" name="fasilitas" required />
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
                <input type="hidden" name="id-kos" value="<?php echo $kos->idKos; ?>" />

                <!-- handle tambah fasilitas button -->
                <?php
                if ($count == 0) {
                    echo '<button type="submit" class="btn btn-primary" id="tambah-fasilitas2" disabled>Tambah Fasilitas</button>';
                } else {
                    echo '<button type="submit" class="btn btn-primary" id="tambah-fasilitas">Tambah Fasilitas</button>';
                }
                ?>

                <!-- yg lama -->
                <!-- <button type="submit" class="btn btn-primary" id="tambah-fasilitas">Tambah Fasilitas</button> -->
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDataFasilitas(id, idKos) {
        var data = confirm("Apakah anda ingin menghapus Fasilitas ?");
        if (data) {
            window.location = "?p=remove-fasilitas-kos-action&id-fasilitas-kos=" + id + "&id-kos=" + idKos
        }
    }

    function confirmDataFoto(id, idKos, lokasi) {
        var data = confirm("Apakah anda ingin menghapus Foto ?");
        if (data) {
            window.location = "?p=remove-foto-kos-action&id-foto=" + id + "&id-kos=" + idKos + "&lokasi=" + lokasi
        }
    }
</script>