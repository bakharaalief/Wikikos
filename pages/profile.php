<div class="container" id="profile">
    <div class="row align-items-start">
        <!-- info tentang nama dan status user -->
        <div class="col" id="info1">
            <?php
            echo "<h1>" . ucwords($fullname) . "</h1>";
            if ($level == 1) {
                echo "<p>Pemilik Kos</p>";
            }
            if ($level == 2) {
                echo "<p>Pengguna</p>";
            }
            echo "<p> ID " . $idUser . "</p>";
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

                    $allTelpon = $user2->getAllTelpon();

                    //nomor telpon kosong
                    if ($allTelpon == "kosong") {
                        echo "<tr>";
                        echo "<td><p>Maaf Data Kosong</p></td>";
                        echo "<tr>";
                        $count = 0;
                    }

                    //nomor telpon ada
                    else {
                        $count = count($allTelpon);
                        foreach ($allTelpon as $dataTelpon) {
                            echo "<tr>";
                            echo "<td>" . $dataTelpon->NoTelp . "</td>";
                            echo '<td><a type="button" class="btn btn-danger btn-xs" href="?p=remove-telpon-action&id_telpon=' . $dataTelpon->idNoTelp . '">Delete</a></td>';
                            echo "<tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>

            <!-- control add nomor telpon button -->
            <?php
            if ($level == 0) {
                echo '<a class="btn btn-primary" id="muncul-nomor-telpon-modal">Tambah Nomor</a>';
            }
            if ($level == 1) {
                if ($count < 2) {
                    echo '<a class="btn btn-primary" id="muncul-nomor-telpon-modal">Tambah Nomor</a>';
                }
            }
            if ($level == 2) {
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
            <a class="btn btn-primary" href=<?php echo "?p=create-kos" ?>>Tambah Kosan</a>
        </div>
        <table class="table" id="data-kosan">
            <thead>
                <tr>
                    <th scope="col">Kosan</th>
                    <th scope="col">Tipe</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Kapasitas</th>
                    <th scope="col">Anggota</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <!-- kosan get from db -->
                <?php

                $allKos = $user2->getAllKos();

                //kosan kosong
                if ($allKos == "kosong") {
                    echo "<tr>";
                    echo "<td><p>Maaf Data Kosong</p></td>";
                    echo "<tr>";
                    $count = 0;
                }

                //kosan ada
                else {
                    $count = count($allKos);
                    foreach ($allKos as $dataKos) {
                        echo "<tr>";
                        echo "<td>$dataKos->namaKos</td>";
                        echo "<td>$dataKos->tipe</td>";
                        echo "<td>$dataKos->harga</td>";
                        echo "<td>$dataKos->kapasitas</td>";
                        echo "<td><a class='btn btn-primary' href='?p=anggota-kos&id-kos=$dataKos->idKos'>Anggota</a></td>";
                        echo "<td><a class='btn btn-primary' class='button' href='?p=edit-kos&id-kos=$dataKos->idKos'</a>Edit</a></td>";
                        echo "<td><a class='btn btn-primary' onclick='confirmData($dataKos->idKos)'>Delete</a></td>";
                        echo "<tr>";
                    }
                }
                ?>

                <a></a>
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
            <form action="?p=add-telpon-action" method="post">
                <div class="modal-body">
                    <input type="text" id="nomor-telpon-kos" class="form-control" name="nomor" required />
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

<script src="./js/create-nomor-telpon.js" type="text/javascript"></script>
<script>
    function confirmData(id) {
        var data = confirm("Apakah anda ingin menghapus kosan ?");
        if (data) {
            window.location = "?p=remove-kos-action&id-kos=" + id;
        }
    }
</script>