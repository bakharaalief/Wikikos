<?php
require_once("./class/class.Kos.php");
require_once("./class/class.Foto_Kosan.php");

$idKos = $_GET['id-kos'];

//fetch data kosan by id
$sql = "SELECT * FROM kosan WHERE id_kosan = :id_kosan";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_kosan', $idKos);
$stmt->execute();

$count = $stmt->rowCount(); ///menghitung row

// jika rownya ada
if ($count == 1) {

    $result   = $stmt->fetch(PDO::FETCH_ASSOC);
    $idKos = $result['id_kosan'];
    $namaKos = $result['nama_kosan'];
    $tipeKos = $result['tipe_kos'];
    $ukuranKos = $result['ukuran'];
    $hargaKos = $result['harga'];
    $kapasitasKos = $result['kapasitas'];
    $namaJalan = $result['nama_jalan'];
    $kecamatan = $result['kecamatan'];
    $kota = $result['kota'];
    $detail = $result['deskripsi'];
    $idUser = $result['id_user'];

    $kos = new Kos($idKos, $namaKos, $tipeKos, $ukuranKos, $hargaKos, $kapasitasKos, $detail, $namaJalan, $kecamatan, $kota, $idUser);
}

//fetch foto kosan by id
$sql = "SELECT * FROM foto_kos WHERE id_kosan = :id_kosan";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_kosan', $idKos);
$stmt->execute();

$count2 = $stmt->rowCount();

if ($count2 == 1) {

    $result   = $stmt->fetch(PDO::FETCH_ASSOC);
    $idFoto = $result['id_foto'];
    $lokasiFoto = $result['lokasi_foto'];
    $idKos = $result['id_kosan'];

    $fotoKos = new Foto_Kosan($idFoto, $lokasiFoto, $idKos);
}

?>

<div class="container" id="create-kosan">
    <h1>Edit Kosan</h1>
    <form action="./action/kosan/edit-kos-db.php" method="post" enctype="multipart/form-data">
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
                        <div class="col">
                            <input type="text" class="form-control" name="kota-kos" placeholder="Nama Kota" value='<?php echo $kos->kota; ?>' required>
                        </div>
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

                        $sql = "SELECT * FROM fasilitas_kos WHERE id_kosan = :id_kosan";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':id_kosan', $idKos);
                        $stmt->execute();

                        //hitung row kosan
                        $count = $stmt->rowCount();

                        $jumlahFasilitas = 0;

                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $idFasilitas = $result['id_fasilitas'];
                            $namaFasilitas = $result['nama_fasilitas'];
                            $idKosan = $result['id_kosan'];

                            $fasilitas = new Fasilitas($idFasilitas, $namaFasilitas, $idKosan);

                            $jumlahFasilitas++;


                            $output = "<tr id='row_$jumlahFasilitas'>
                            <td>$namaFasilitas<input type='hidden' name='hidden_fasilitas_nama[]' id='fasilitas_nama$jumlahFasilitas' class='fasilitas_nama' value='$namaFasilitas'/></td>
                            <td><a type='button' name='remove_fasilitas_nama' class='btn btn-danger btn-xs remove_fasilitas_nama' id='$jumlahFasilitas'>Hapus</a></td>";
                            '</tr>';

                            echo $output;

                            // echo "<tr>";
                            // echo "<td>$namaFasilitas</td>";
                            // echo "<td><a type='button' class='btn btn-danger btn-xs' onclick='confirmData($fasilitas->idFasilitas, $fasilitas->idKosan)''>Hapus</a></td>";
                            // echo "<tr>";
                        }

                        ?>
                    </tbody>
                </table>
                <a class="btn btn-primary" id="muncul-fasilitas-modal">Tambah Fasilitas</a>
                <br>
                <label>Gambar</label>
                <br>
                <img id="image-crop" src="<?php echo substr($fotoKos->Foto, 4); ?>" alt="your image" />
                <input type="file" id="gambar-kos" class="form-control" name="gambar-input" />
                <input type="hidden" name='id-foto' value="<?php echo $fotoKos->idFoto; ?>" />

                <input type="hidden" name="id-kos" value="<?php echo $kos->idKosan; ?>" />
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
                <!-- <form action="./action/kosan/add-fasilitas-db.php" method="POST">
                    <div class="modal-body">
                        <input list="fasilitas" id="fasilitas-kos" class="form-control" name="fasilitas" required />
                        <datalist id="fasilitas">
                            <option value="AC">
                            <option value="Kulkas">
                            <option value="Gym">
                            <option value="Kasur">
                            <option value="Meja Belajar">
                            <option value="Lemari">
                            <option value="Kamar Mandi Dalam">
                            <option value="Kamar Mandi Luar">
                        </datalist>
                        <span id="error_fasilitas_kos" class="text-danger"></span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id-kos" value="<?php echo $kos->idKosan; ?>" />
                        <button type="submit" class="btn btn-primary" id="tambah-fasilitas">Tambah Fasilitas</button>
                    </div>
                </form> -->

                <div class="modal-body">
                    <input list="fasilitas" id="fasilitas-kos" class="form-control" name="fasilitas" required />
                    <datalist id="fasilitas">
                        <option value="AC">
                        <option value="Kulkas">
                        <option value="Gym">
                        <option value="Kasur">
                        <option value="Meja Belajar">
                        <option value="Lemari">
                        <option value="Kamar Mandi Dalam">
                        <option value="Kamar Mandi Luar">
                    </datalist>
                    <span id="error_fasilitas_kos" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <!-- <input type="hidden" name="id-kos" value="<?php echo $kos->idKosan; ?>" /> -->
                    <button type="submit" class="btn btn-primary" id="tambah-fasilitas">Tambah Fasilitas</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./action/kosan/edit-kosan.js"></script>
<script>
    function confirmData(id, idKos) {
        var data = confirm("Apakah anda ingin menghapus Fasilitas ?");
        if (data) {
            window.location = "./action/kosan/remove-fasilitas-db.php?id-fasilitas=" + id + "&id-kos=" + idKos;
        }
    }
</script>