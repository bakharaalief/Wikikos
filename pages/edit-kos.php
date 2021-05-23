<?php
require_once("./class/class.Kos.php");
require_once("./class/class.Foto_Kosan.php");

$idKos = $_GET['id-kos'];

//fetch data kosan by id
$kos = new Kos();
$kos->idKos = $idKos;
$kos->getKosanData();

?>

<div class="container" id="create-kosan">
    <h1>Edit Kosan</h1>
    <form action="?p=edit-kos-action" method="post" enctype="multipart/form-data">
        <div class="row align-items-start">
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
            </div>

            <!-- gambar dan fasilitas -->
            <div class="col" id="fasilitas-gambar">
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" name="deskripsi-kos" rows="3" required><?php echo $kos->detail; ?></textarea>
                </div>

                <label id="fasilitas-aa">Fasilitas</label>
                <table class="table" id="fasilitas-data">
                    <thead>
                        <tr>
                            <th scope="col">Nama Fasiitas</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
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

                        //fasilitas ada
                        else {
                            $count = count($allFasilitas);
                            $jumlahFasilitas = 0;
                            foreach ($allFasilitas as $dataFasilitas) {

                                $jumlahFasilitas++;
                                $output = "<tr id='row_$jumlahFasilitas'>
                                <td>$dataFasilitas->nama<input type='hidden' name='hidden_fasilitas_nama[]' id='fasilitas_nama$jumlahFasilitas' class='fasilitas_nama' value='$dataFasilitas->idFasilitas'/></td>
                                <td><a type='button' name='remove_fasilitas_nama' class='btn btn-danger btn-xs remove_fasilitas_nama' id='$jumlahFasilitas'>Hapus</a></td>";
                                '</tr>';

                                echo $output;
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <a class="btn btn-primary" id="muncul-fasilitas-modal">Tambah Fasilitas</a>
                <br>

                <!-- gambar kosan -->
                <label>Gambar</label>
                <br>

                <?php
                //fetch foto kosan by id
                $allFoto = $kos->getAllPhoto();

                //kosong
                if ($allFoto == "kosong") {
                    return;
                }

                //selain itu
                else {
                    foreach ($allFoto as $dataFoto) {
                        echo '<img id="image-crop" src="' . substr($dataFoto->Foto, 0) . '" alt="your image" />';
                        echo '<input type="file" id="gambar-kos" class="form-control" name="gambar-input" />';
                        echo '<input type="hidden" name="id-foto" value="' . $dataFoto->idFoto . '" />';
                    }
                }
                ?>

                <input type="hidden" name="id-kos" value="<?php echo $kos->idKos; ?>" />
                <input type="hidden" name="id-user" value="<?php echo $kos->idUser; ?>" />
                <input type="hidden" id="jumlah-fasilitas" value="<?php echo $jumlahFasilitas; ?>" />

                <br>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>

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
</div>

<script src="./js/edit-kos.js"></script>
<script>
    function confirmData(id, idKos) {
        var data = confirm("Apakah anda ingin menghapus Fasilitas ?");
        if (data) {
            window.location = "./action/kosan/remove-fasilitas-db.php?id-fasilitas=" + id + "&id-kos=" + idKos;
        }
    }
</script>