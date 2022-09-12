<!-- Bottom Navbar -->
<nav class="navbar navbar-light bg-light border-top navbar-expand d-md-none d-lg-none d-xl-none fixed-bottom mb-0 p-0">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item">
            <a href="index.php?search=" class="nav-link" style="text-decoration:none;">
                <i class="bi bi-house-fill text-dark fs-1"></i>
                <br>
                <small>Home</small>
            </a>
        </li>
        <li class="nav-item">
            <div class="btn-group dropup">
                <a class="nav-link align-middle" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration:none;">
                    <i class="bi bi-tag-fill text-dark fs-1"></i>
                    <small class="dropdown-toggle"></small>
                    <br>
                    <small>Cari Kategori</small>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="index.php?search=">
                            <img src="img/marker_add.png" height="20px">
                            Semua
                        </a>
                    </li>
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM kategori");
                    while ($row = mysqli_fetch_array($kategori)) {
                    ?>
                        <li><a class="dropdown-item" href="index.php?search=<?php echo $row['nama_kategori']; ?>">
                                <img src="img/<?php echo $row['simbol']; ?>" height="20px">
                                <?php echo $row['nama_kategori']; ?>
                            </a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>

        </li>
        <li class="nav-item">
            <?php
            if ($user != NULL) {
            ?>
                <a href="data_add.php" class="nav-link" style="text-decoration:none;">
                    <i class="bi bi-plus-circle text-dark fs-1"></i>
                    <br>
                    <small>Tambah Lokasi</small>
                </a>
            <?php
            } else {
            ?>
                <a href="login.php" class="nav-link" style="text-decoration:none;">
                    <i class="bi bi-plus-circle text-dark fs-1"></i>
                    <br>
                    <small>Tambah Lokasi</small>
                </a>
            <?php
            }
            ?>

        </li>
        <li class="nav-item">
            <?php
            if ($user != NULL) {
                include 'koneksi.php';
                $login = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");
                $dataUser = mysqli_fetch_array($login);
                if ($dataUser['img'] != NULL) {
                    $gambar = $dataUser['img'];
                } else {
                    $gambar = 'default.png';
                }
            ?>
                <div class="btn-group dropup">
                    <a href="#" class="nav-link" data-bs-toggle="dropdown" style="text-decoration:none;">
                        <img class="rounded-circle mb-2" src="img/user/<?php echo $gambar; ?>" width="25px" height="25px">
                        <br>
                        <small><?php echo $user; ?></small>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="people.php?id=<?php echo $user; ?>">
                                <i class="bi bi-person text-dark fs-5"></i>
                                My Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="logout.php">
                                <i class="bi bi-door-open text-dark fs-5"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            <?php
            } else {
            ?>
                <a href="login.php" class="nav-link" style="text-decoration:none;">
                    <i class="bi bi-person-circle text-dark fs-1"></i>
                    <br>
                    <small>Login ke Akun</small>
                </a>
            <?php
            }
            ?>

        </li>
    </ul>
</nav>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>