<div class="container" id="edit-user">
    <h1>Tambah User</h1>
    <form action="?p=create-user-admin-action" method="post">
        <div class="row align-items-start">
            <div class="col">

                <!-- full name -->
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" placeholder="Nama Lengkap" name="namaLengkap" required>
                </div>

                <!-- NIK -->
                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" class="form-control" placeholder="NIK" name="NIK" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                </div>

                <!-- Mau Jadi Apa -->
                <div class="form-group">
                    <label>Menjadi</label>
                    <select class="form-control" name="level">
                        <option value="0">Admin</option>
                        <option value="1">Pemilik</option>
                    </select>
                </div>

                <!-- Username -->
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>

                <!-- password -->
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" placeholder="Password" name="password" required>
                </div>

                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <div class="col"></div>
        </div>
    </form>
</div>