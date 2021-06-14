<?php
$idUser = $_GET['id-user'];
?>;

<div class="container" id="edit-user">
    <h1>Lupa Password</h1>
    <form action="?p=reset-pass-user-action" method="post">
        <div class="row align-items-start">
            <div class="col">
                <!-- fasilitas -->
                <div class="form-group">
                    <label>Password Baru</label>

                    <input type="password" class="form-control" placeholder="Password" name="password1" required>

                    <br>

                    <input type="password" class="form-control" placeholder="Confirm Password" name="password2" required>
                </div>

                <input type="hidden" name="id-user" value="<?php echo $idUser; ?>" />

                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <div class="col"></div>
        </div>
    </form>
</div>