<div class="container" id="profile">
    <div class="row align-items-start">
        <!-- info tentang nama dan status user -->
        <div class="col" id="info1">
            <?php
            echo "<h1>" . ucwords($user->nama) . "</h1>";
            if ($user->level == 0) {
                echo "<p>Admin</p>";
            }
            if ($user->level == 1) {
                echo "<p>Pemilik Kos</p>";
            }
            if ($user->level == 2) {
                echo "<p>Pengguna</p>";
            }
            echo "<p> ID " . $user->idUser . "</p>";
            ?>
        </div>

        <!-- nomor telpon -->
        <div class="col" id="nomor-telpon">
            <label>Nomor Telpon</label>
            <table class="table" id="nomor-telpon-data">
                <thead>
                    <tr>
                        <th scope="col">Nomor Telpon</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- nomor telpon get from db -->
                    <?php
                    require_once("./class/class.Telp_User.php");

                    $idUser = $user->idUser;

                    $sql = "SELECT * FROM telpon WHERE id_user = :id_user";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':id_user', $idUser);
                    $stmt->execute();

                    //hitung row nomor telpon
                    $count = $stmt->rowCount();

                    //looping to load no telp same with user id
                    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $idTelpon = $result['id_telpon'];
                        $nmrTelpon = $result['nomor_telpon'];
                        $idUser = $result['id_user'];

                        $telpon = new Telp_User($idTelpon, $nmrTelpon, $idUser);

                        echo "<tr>";
                        echo "<td>" . $telpon->NoTelp . "</td>";
                        echo '<td><a type="button" class="btn btn-danger btn-xs" href="./action/profile/remove-nomor-telpon.php?id_telpon=' . $telpon->idNoTelp . '">Delete</a></td>';
                        echo "<tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- control add nomor telpon button -->
            <?php
            if ($user->level == 0) {
                echo '<a class="btn btn-primary" id="muncul-nomor-telpon-modal">Tambah Nomor</a>';
            }
            if ($user->level == 1) {
                if ($count < 2) {
                    echo '<a class="btn btn-primary" id="muncul-nomor-telpon-modal">Tambah Nomor</a>';
                }
            }
            if ($user->level == 2) {
                if ($count < 1) {
                    echo '<a class="btn btn-primary" id="muncul-nomor-telpon-modal">Tambah Nomor</a>';
                }
            }
            ?>

        </div>
    </div>

    <!-- table kosan -->
    <div class="Semua-kosan">
        <div class="data1">
            <h1>Kosan Dimiliki</h1>
            <button onclick="location.href='?p=create-kos'">Tambah Kosan</button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kosan</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Kapasitas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Kosan Bu Haji</td>
                    <td>Rp. 200.000</td>
                    <td>4/5</td>
                    <td>20/50</td>
                    <td>
                        <button type="button" class="button btn-primary">Edit</button>
                        <button type="button" class="button ">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal nomor telpon -->
<div class="modal fade" id="nomor-telpon-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Nomor</h5>
                <button type="button" class="btn btn-secondary" id="close-nomor-telpon-modal">Close</button>
            </div>
            <form action="./action/profile/add-nomor-telpon.php" method="post">
                <div class="modal-body">
                    <input type="text" id="nomor-telpon-kos" class="form-control" name="nomor" required />
                    <input type="text" id="id-user" value="<?php echo $user->idUser; ?>" name="id_user" hidden>
                    <span id="error_nomor_telpon_kos" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="row_id" id="hidden_row_id" />
                    <button type="submit" class="btn btn-primary" id="tambah-nomor">Tambah Nomor</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="./action/profile/create-nomor-telpon.js" type="text/javascript"></script>