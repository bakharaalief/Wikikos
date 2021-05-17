<div class="create-all">
    <div id="create" class="container">
        <div class="row align-items-center">
            <!-- left-side -->
            <div class="col" id="col-2">
                <img src="./image/house-2.png" alt="">
            </div>

            <!-- right-side -->
            <div class="col" id="col-1">
                <h1>Daftar</h1>
                <h4>Ayo Gabung Bersama Wikikos</h4>

                <!-- Register form -->
                <form action="?p=create-user-action" method="Post">

                    <!-- full name -->
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="namaLengkap" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>

                    <!-- Mau Jadi Apa -->
                    <input type="text" class="form-control" name="level" value="1" hidden>

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