<div class="create-all">
    <div id="create" class="container">
        <div class="row align-items-center">
            <!-- left-side -->
            <div class="col" id="col-2">
                <img src="./image/house-2.png" alt="">
            </div>

            <!-- right-side -->
            <div class="col" id="col-1">
                <h1>Create</h1>
                <h4>Find a mate and your comfort space with WikiKos.</h4>

                <!-- Register form -->
                <form action="./action/create-user/create-user-db.php" method="Post">

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
                            <option value="1">Pemilik</option>
                            <option value="2">Pengguna Kos</option>
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
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>

                    <!-- button input -->
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>

            </div>
        </div>
    </div>
    <div class="shape2"></div>
</div>