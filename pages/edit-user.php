<?php
require_once("./authPemilik.php");
$idUser = $_GET['id-user'];

//fetch data kosan by id
$user = new User2();
$user->idUser = $idUser;
$user->getUserData();

?>

<div class="container" id="edit-user">
    <h1>Edit User</h1>
    <form action="?p=edit-user-action" method="post" enctype="multipart/form-data">
        <div class="row align-items-start">
            <div class="col">

                <!-- full name -->
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" placeholder="Nama Lengkap" name="namaLengkap" value="<?php echo $user->fullname; ?>" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $user->email; ?>" required>
                </div>

                <!-- Mau Jadi Apa -->
                <div class="form-group">
                    <label>Menjadi</label>
                    <select class="form-control" name="level">
                        <option value="0" <?php if ($user->level == 0) echo 'selected="selected"'; ?>>Admin</option>
                        <option value="1" <?php if ($user->level == 1) echo 'selected="selected"'; ?>>Pemilik</option>
                        <option value="2" <?php if ($user->level == 2) echo 'selected="selected"'; ?>>Pengguna Kos</option>
                    </select>
                </div>

                <!-- Username -->
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $user->username; ?>" required>
                </div>

                <!-- password -->
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" placeholder="Masukan Password jika ingin merubah" name="password">
                </div>

                <input type="hidden" name="id-user" value="<?php echo $idUser; ?>" />

                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <div class="col"></div>
        </div>
    </form>
</div>