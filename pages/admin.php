<?php
require_once("./authAdmin.php");
?>

<div class="container" id="admin">
    <!-- info tentang nama dan status user -->
    <div class="col" id="info1">
        <?php
        echo "<h1>" . ucwords($fullname) . "</h1>";
        echo "<p>ID " . $idUser . "</p>";
        ?>

        <div class="aa">
            <a class="btn btn-primary" href=<?php echo "?p=create-user-admin" ?>>Tambah User</a>
            <a class="btn btn-primary" href=<?php echo "?p=create-fasilitas" ?>>Tambah Fasilitas</a>
            <a class="btn btn-primary" href=<?php echo "?p=create-kota" ?>>Tambah Kota</a>
        </div>
    </div>

    <!-- tab -->
    <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#kos" role="tab" aria-controls="home" aria-selected="true">Kos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="false">User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#nomor_telp" role="tab" aria-controls="nomor_telp" aria-selected="false">No. Telp User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#fasilitas" role="tab" aria-controls="fasilitas" aria-selected="false">Fasilitas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#kota" role="tab" aria-controls="kota" aria-selected="false">Kota</a>
        </li>
    </ul>

    <!-- tab content -->
    <div class="tab-content" id="myTabContent">
        <!-- kosan data -->
        <div class="tab-pane fade show active" id="kos" role="tabpanel" aria-labelledby="home-tab">
            <table class="table" id="data-kosan">
                <thead>
                    <tr>
                        <th scope="col">Kosan</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Kapasitas</th>
                        <th scope="col">Terisi</th>
                        <th scope="col">Kota</th>
                        <th scope="col">Pemilik</th>
                        <th scope="col">Status</th>
                        <th scope="col">Anggota</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- kosan get from db -->
                    <?php
                    $kos = new Kos();
                    $allKos = $kos->getAllKos();

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
                            //untuk mencari tahu yang terisi
                            $data = $dataKos->getAllAnggota();

                            if ($data == "kosong") {
                                $jumlahTerisi = 0;
                            } else {
                                $jumlahTerisi = count($data);
                            }

                            echo "<tr>";
                            echo "<td>$dataKos->namaKos</td>";
                            echo "<td>$dataKos->tipe</td>";
                            echo "<td>$dataKos->harga</td>";
                            echo "<td>$dataKos->kapasitas</td>";
                            echo "<td>$jumlahTerisi</td>";
                            echo "<td>$dataKos->kota</td>";
                            echo "<td>" . $dataKos->user->username . "</td>";

                            //show button status
                            if ($dataKos->status == 0) {
                                echo "<td><a class='btn btn-primary' href='?p=edit-status-kos&id-kos=$dataKos->idKos'>Review</a></td>";
                            } else if ($dataKos->status == 1) {
                                echo "<td><a class='btn btn-primary' href='?p=edit-status-kos&id-kos=$dataKos->idKos'>Aktif</a></td>";
                            } else if ($dataKos->status == 2) {
                                echo "<td><a class='btn btn-primary' href='?p=edit-status-kos&id-kos=$dataKos->idKos'>Tolak</a></td>";
                            }

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

        <!-- user data -->
        <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="profile-tab">

            <table class="table" id="data-kosan">
                <thead>
                    <tr>
                        <th scope="col">Fullname</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Level</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- kosan get from db -->
                    <?php
                    $allUser = $user2->getAllUser();

                    //kosan kosong
                    if ($allUser == "kosong") {
                        echo "<tr>";
                        echo "<td><p>Maaf Data Kosong</p></td>";
                        echo "<tr>";
                        $count = 0;
                    }

                    //kosan ada
                    else {
                        $count = count($allUser);
                        foreach ($allUser as $dataUser) {
                            echo "<tr>";
                            echo "<td>$dataUser->fullname</td>";
                            echo "<td>$dataUser->username</td>";
                            echo "<td>$dataUser->email</td>";

                            if ($dataUser->level == 0) {
                                echo "<td>Admin</td>";
                            } else if ($dataUser->level == 1) {
                                echo "<td>Pemilik</td>";
                            } else if ($dataUser->level == 2) {
                                echo "<td>Pengguna</td>";
                            }

                            echo "<td><a class='btn btn-primary' class='button' href='?p=edit-user-admin&id-user=$dataUser->idUser'</a>Edit</a></td>";
                            echo "<td><a class='btn btn-primary' onclick='confirmDataUser($dataUser->idUser)'>Delete</a></td>";
                            echo "<tr>";
                        }
                    }
                    ?>
                    <a></a>
                </tbody>
            </table>
        </div>

        <!-- telpon data -->
        <div class="tab-pane fade" id="nomor_telp" role="tabpanel" aria-labelledby="telepon-tab">

            <table class="table" id="data-kosan">
                <thead>
                    <tr>
                        <th scope="col">Pemilik</th>
                        <th scope="col">Nomor Telpon</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- kosan get from db -->
                    <?php
                    require_once("./class/class.Telp_User.php");

                    $telpon = new Telp_User();
                    $allTelpon = $telpon->getAllNoTelp();

                    //kosan kosong
                    if ($allTelpon == "kosong") {
                        echo "<tr>";
                        echo "<td><p>Maaf Data Kosong</p></td>";
                        echo "<tr>";
                        $count = 0;
                    }

                    //kosan ada
                    else {
                        $count = count($allTelpon);
                        foreach ($allTelpon as $dataTelpon) {
                            echo "<tr>";
                            echo "<td>" . $dataTelpon->user->username . "</td>";
                            echo "<td>$dataTelpon->NoTelp</td>";
                            echo "<td><a class='btn btn-primary' class='button' href='?p=edit-telpon&id-telpon=$dataTelpon->idNoTelp'</a>Edit</a></td>";
                            echo "<td><a class='btn btn-primary' onclick='confirmDataTelpon($dataTelpon->idNoTelp)'>Delete</a></td>";
                            echo "<tr>";
                        }
                    }
                    ?>
                    <a></a>
                </tbody>
            </table>
        </div>

        <!-- fasilitas data -->
        <div class="tab-pane fade" id="fasilitas" role="tabpanel" aria-labelledby="fasilitas-tab">

            <table class="table" id="data-kosan">
                <thead>
                    <tr>
                        <th scope="col">Nama Fasilitas</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Fasilitas</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- kosan get from db -->
                    <?php
                    require_once("./class/class.Fasilitas.php");

                    $fasilitas = new Fasilitas();
                    $allFasilitas = $fasilitas->getAllFasilitas();

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
                            echo "<td><a class='btn btn-primary' class='button' href='?p=edit-fasilitas&id-fasilitas=$dataFasilitas->idFasilitas'</a>Edit</a></td>";
                            echo "<td><a class='btn btn-primary' onclick='confirmDataFasilitas($dataFasilitas->idFasilitas)'>Delete</a></td>";
                            echo "<tr>";
                        }
                    }
                    ?>
                    <a></a>
                </tbody>
            </table>
        </div>

        <!-- kota data -->
        <div class="tab-pane fade" id="kota" role="tabpanel" aria-labelledby="kota-tab">

            <table class="table" id="data-kosan">
                <thead>
                    <tr>
                        <th scope="col">Nama Kota</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Fasilitas</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- kosan get from db -->
                    <?php
                    require_once("./class/class.Kota.php");

                    $kota = new Kota();
                    $allKota = $kota->getAllKota();

                    //kosan kosong
                    if ($allKota == "kosong") {
                        echo "<tr>";
                        echo "<td><p>Maaf Data Kosong</p></td>";
                        echo "<tr>";
                        $count = 0;
                    }

                    //kosan ada
                    else {
                        $count = count($allKota);
                        foreach ($allKota as $dataKota) {
                            echo "<tr>";
                            echo "<td>$dataKota->nama</td>";
                            echo "<td><a class='btn btn-primary' class='button' href='?p=edit-kota&id-kota=$dataKota->idKota'</a>Edit</a></td>";
                            echo "<td><a class='btn btn-primary' onclick='confirmDataKota($dataKota->idKota)'>Delete</a></td>";
                            echo "<tr>";
                        }
                    }
                    ?>
                    <a></a>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmData(id) {
        var data = confirm("Apakah anda ingin menghapus kosan ?");
        if (data) {
            window.location = "?p=remove-kos-action&id-kos=" + id;
        }
    }

    function confirmDataUser(id) {
        var data = confirm("Apakah anda ingin menghapus User Ini ?");
        if (data) {
            window.location = "?p=remove-user-action&id-user=" + id;
        }
    }

    function confirmDataTelpon(id) {
        var data = confirm("Apakah anda ingin menghapus Telpon Ini ?");
        if (data) {
            window.location = "?p=remove-telpon-action&id-telpon=" + id;
        }
    }

    function confirmDataFasilitas(id) {
        var data = confirm("Apakah anda ingin menghapus Fasilitas Ini ?");
        if (data) {
            window.location = "?p=remove-fasilitas-action&id-fasilitas=" + id;
        }
    }

    function confirmDataKota(id) {
        var data = confirm("Apakah anda ingin menghapus Kota Ini ?");
        if (data) {
            window.location = "?p=remove-kota-action&id-kota=" + id;
        }
    }
</script>