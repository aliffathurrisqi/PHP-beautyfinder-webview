<!-- Navbar -->
<nav class="navbar navbar-light bg-light navbar-expand mb-0">
    <ul class="navbar-nav w-100">
        <li class="nav-item ms-5">
            <a href="index.php?search="><img src="img/beautyfinder_logo.png" height="30px"></a>
        </li>
    </ul>
</nav>
<nav class="navbar navbar-light bg-light navbar-expand mb-0">
    <ul class="w-100">
        <form method="POST">
            <div class="input-group w-100">
                <input type="text" class="form-control" placeholder="Masukkan nama tempat" name="p_cari" aria-describedby="button-addon2">
                <button class="btn btn-primary" name="btnCari">Cari</button>
                <a href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                    <button class="btn btn-primary h-100 ms-2" name="btnCari">
                        Kategori <i class="bi bi-arrow-down"></i></button>
                </a>
                <ul class="dropdown-menu w-100 bg-light" aria-labelledby="navbarDropdown">
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
                        <li><a class="dropdown-item mb-2" href="index.php?search=<?php echo $row['nama_kategori']; ?>">
                                <img src="img/<?php echo $row['simbol']; ?>" height="20px">
                                <?php echo $row['nama_kategori']; ?>
                            </a></li>
                    <?php
                    }
                    ?>

                </ul>
            </div>

        </form>
    </ul>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<!-- Bootstrap Bundle with Popper -->