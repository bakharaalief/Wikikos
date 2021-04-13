<div class="container" id="profile">

    <!-- info tentang nama dan status user -->
    <div class="info1">
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
        ?>
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