<div class="container" id="admin">
    <!-- info tentang nama dan status user -->
    <div class="col" id="info1">
        <?php
        echo "<h1>" . ucwords($fullname) . "</h1>";
        echo "<p>ID " . $idUser . "</p>";
        ?>
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
            <a class="nav-link" data-toggle="tab" href="#anggota" role="tab" aria-controls="anggota" aria-selected="false">Anggota</a>
        </li>
    </ul>

    <!-- tab content -->
    <!-- data-kosan -->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="kos" role="tabpanel" aria-labelledby="home-tab">
            <table class="table" id="data-kosan">
                <thead>
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Kosan</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Kapasitas</th>
                        <th scope="col">Daerah</th>
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
                            echo "<tr>";
                            echo "<td>$dataKos->pemilik</td>";
                            echo "<td>$dataKos->namaKos</td>";
                            echo "<td>$dataKos->tipe</td>";
                            echo "<td>$dataKos->harga</td>";
                            echo "<td>$dataKos->kapasitas</td>";
                            echo "<td>$dataKos->kota</td>";
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
                        <th scope="col">Password</th>
                        <th scope="col">Email</th>
                        <th scope="col">NIK</th>
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
                            echo "<td>$dataUser->password</td>";
                            echo "<td>$dataUser->email</td>";
                            echo "<td>$dataUser->NIK</td>";

                            if ($dataUser->level == 0) {
                                echo "<td>Admin</td>";
                            } else if ($dataUser->level == 1) {
                                echo "<td>Pemilik</td>";
                            } else if ($dataUser->level == 2) {
                                echo "<td>Pengguna</td>";
                            }

                            echo "<td><a class='btn btn-primary' class='button' href='?p=edit-user&id-user=$dataUser->idUser'</a>Edit</a></td>";
                            echo "<td><a class='btn btn-primary' onclick='confirmDataUser($dataUser->idUser)'>Delete</a></td>";
                            echo "<tr>";
                        }
                    }
                    ?>
                    <a></a>
                </tbody>
            </table>
        </div>

        <!-- user anggota -->
        <div class="tab-pane fade" id="anggota" role="tabpanel" aria-labelledby="contact-tab">
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

    function confirmDataUser(id) {
        var data = confirm("Apakah anda ingin menghapus User Ini ?");
        if (data) {
            window.location = "?p=remove-user-action&id-user=" + id;
        }
    }
</script>