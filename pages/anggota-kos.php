<?php
require_once("./class/class.Kos.php");

$idKos = $_GET['id-kos'];

//get data for kapasitas kos
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


// get data anggota for kosan
$sql = "SELECT * FROM anggota_kos WHERE id_kosan = :id_kosan";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_kosan', $idKos);
$stmt->execute();

//hitung banyaknya anggota di kosan
$count = $stmt->rowCount();
?>

<div class="container" id="anggota">
    <div class="info1">
        <div class="info1-a">
            <h1><?php echo ucwords($kos->namaKos); ?></h1>
            <p><?php echo "Jumlah Anggota : $count" ?></p>
            <p><?php echo "Max Anggota : $kos->kapasitas" ?></p>
        </div>

        <?php
        if ($kos->kapasitas == $count) {
            echo "<a class='btn btn-primary' id='a2'>Anggota Penuh</a>";
        } else {
            echo '<a class="btn btn-primary" id="muncul-anggota-modal">Tambah Anggota</a>';
        }
        ?>

    </div>

    <table class="table" id="data-anggota">
        <thead>
            <tr>
                <th scope="col">NIK</th>
                <th scope="col">Nama</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- anggota from db -->
            <?php
            require_once("./class/class.Anggota_Kosan.php");

            //looping to load no telp same with user id
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $idAnggota = $result['id_anggota'];
                $NIK = $result['NIK'];
                $namaAnggota = $result['nama_anggota'];
                $idKosan = $result['id_kosan'];

                $anggota = new Anggota_Kosan($idAnggota, $NIK, $namaAnggota, $idKosan);

                echo "<tr>";
                echo "<td>" . $anggota->NIKAnggota . "</td>";
                echo "<td>" . $anggota->NamaAnggota . "</td>";
                echo "<td><a type='button' class='btn btn-primary btn-xs' id='muncul-edit-anggota-modal' onclick='editData(" . $anggota->idAnggota .  "," . $anggota->NIKAnggota . ",\"" . $anggota->NamaAnggota . "\");'>Edit</a></td>";
                echo "<td><a type='button' class='btn btn-primary btn-xs' onclick='confirmData($anggota->idAnggota, $kos->idKosan)'>Delete</a></td>";
                echo "<tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal tambah anggota -->
<div class="modal fade" id="anggota-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
                <button type="button" class="btn btn-secondary" id="close-anggota-modal">Close</button>
            </div>
            <form action="./action/anggota/create-anggota-db.php" method="post">
                <div class="modal-body">
                    <input type="text" id="NIK-anggota" class="form-control" name="NIK" placeholder="NIK" required />
                    <span id="error_NIK_anggota_kos" class="text-danger"></span>
                    </br>
                    <input type="text" id="nama-anggota" class="form-control" name="nama" placeholder="Nama Lengkap" required />
                    <span id="error_nama_anggota_kos" class="text-danger"></span>
                    <input type="text" id="id-kos" value="<?php echo $idKos; ?>" name="id_kos" hidden>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="submit" class="btn btn-primary" id="tambah-nomor">Tambah Anggota</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit anggota -->
<div class="modal fade" id="edit-anggota-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Anggota</h5>
                <button type="button" class="btn btn-secondary" id="close-edit-anggota-modal">Close</button>
            </div>
            <form action="./action/anggota/edit-anggota-db.php" method="post">
                <div class="modal-body">
                    <input type="text" id="NIK-anggota-edit" class="form-control" name="NIK" placeholder="NIK" required />
                    <span id="error_NIK_anggota_kos" class="text-danger"></span>
                    </br>
                    <input type="text" id="nama-anggota-edit" class="form-control" name="nama" placeholder="Nama Lengkap" required />
                    <span id="error_nama_anggota_kos" class="text-danger"></span>
                    <input type="text" id="id-kos" value="<?php echo $idKos; ?>" name="id-kos" hidden>
                    <input type="text" id="id-anggota" name="id-anggota" hidden>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="submit" class="btn btn-primary" id="tambah-nomor">Simpan Anggota</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="./action/anggota/create-anggota.js" type="text/javascript"></script>
<script>
    function confirmData(id, idKosan) {
        var data = confirm("Apakah anda ingin menghapus Anggota ?");
        if (data) {
            window.location = href = './action/anggota/remove-anggota-db.php?id-anggota=' + id + '&id-kos=' + idKosan;
        }
    }

    function editData(idAnggota, NIK, namaAnggota) {
        $('#edit-anggota-modal').modal('show');

        document.getElementById("id-anggota").value = idAnggota;
        document.getElementById("NIK-anggota-edit").value = NIK;
        document.getElementById("nama-anggota-edit").value = namaAnggota;
    }
</script>