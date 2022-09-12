<?php
session_start();
$_SESSION['username'] = $_SESSION['username'];
$user = $_SESSION['username'];
$people_id = $_GET['id'];

include "koneksi.php";
include_once "header.php";
include_once "navbar.php"; ?>

<form method="POST" enctype="multipart/form-data">
    <div class="row" style="margin-top:50px;">
        <div class="panel panel-info">
            <div class="panel-body">
                <?php
                $people = mysqli_query(
                    $conn,
                    "SELECT username,nama_lengkap,img
              FROM user WHERE username = '$people_id'"
                );
                $data = mysqli_fetch_array($people);
                if ($data['img'] != NULL) {
                    $gambar = $data['img'];
                } else {
                    $gambar = 'default.png';
                }
                $countulas = mysqli_query($conn, "SELECT COUNT(username) as jmlUlas FROM ulasan WHERE username = '$people_id'");
                $counttoko = mysqli_query($conn, "SELECT COUNT(username) as jmlRekomendasi FROM toko WHERE username = '$people_id' AND verifikasi = 'Ya'");
                $jmlulas = mysqli_fetch_array($countulas);
                $jmltoko = mysqli_fetch_array($counttoko);
                ?>
                <div class="fs-5 w-100 text-center w-100">
                    <center>
                        <div class="mb-2">
                            <img class="rounded-circle" src="img/user/<?php echo $gambar; ?>" width="50px" height="50px" id="image-preview">
                        </div>
                    </center>
                    <div id="showName">
                        <h5 class="mt-2"><?php echo $data['username']; ?></h5>
                        <form method="POST">
                            <span id="namaUser"><?php echo $data['nama_lengkap']; ?></span>
                            <?php
                            if ($user == $data['username']) {
                            ?>
                                <br><input type="submit" class="btn btn-primary mt-2" value="Ubah Profile" name="btnEdit">
                            <?php
                            }
                            ?>
                    </div>
                    <div id="editName" style="display: none;">
                        <div class="mb-2">
                            <center>
                                <input type="file" class="mb-2" id="photo" name="photo" aria-describedby="basic-addon1" accept="image/png, image/gif, image/jpeg, image/jpg" onchange="previewImage()" width="50%">
                            </center>
                        </div>
                        <input type="text" class="w-50" id=form-nama onkeyup="validate();" value="<?php echo $data['nama_lengkap']; ?>" name="nama_lengkap">
                        <script>
                            function validate() {
                                var element = document.getElementById('form-nama');
                                element.value = element.value.replace(/[^a-zA-Z ]+/, '');
                            };
                        </script>
                        <br><input type="submit" class="btn btn-primary mt-2" value="Kirim" name="btnKirim">
                    </div>
</form>
<div class="navbar navbar-light navbar-expand w-100">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item">
            <div class="alert alert-light text-center text-warning" role="alert">
                <i class="bi bi-star-fill text-warning"></i> <br><?php echo $jmlulas['jmlUlas']; ?> Ulasan
            </div>
        </li>
        <li class="nav-item ">
            <div class="alert alert-light text-center text-success" role="alert">
                <i class="bi bi-geo-alt-fill text-success"></i> <br><?php echo $jmltoko['jmlRekomendasi']; ?> Tempat Ditambahkan
            </div>
        </li>
    </ul>
</div>
</div>
<div class="fs-5 mt-2">
    Daftar ulasan <strong><?php echo $data['username']; ?></strong>
</div>
<?php
$dataulasan = mysqli_query(
    $conn,
    "SELECT ulasan.username,ulasan.rating,ulasan.ulasan,toko.nama_toko,toko.id,ulasan.waktu FROM ulasan INNER JOIN toko ON toko.id = ulasan.id_toko
                WHERE ulasan.username = '$people_id' ORDER BY ulasan.waktu DESC"
);
$hitungdata = mysqli_num_rows($dataulasan);
if ($hitungdata > 0) {

    while ($ulas = mysqli_fetch_array($dataulasan)) {
?>

        <div class="mt-2 mb-2 p-2 fs-5">
            <a id="people" href="place.php?id=<?php echo $ulas['id']; ?>"><strong><?php echo $ulas['nama_toko']; ?></strong></a>
            <?php
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $ulas['rating']) {
            ?>
                    <i class="bi bi-star-fill text-warning"></i>
                <?php
                } else {
                ?>
                    <i class="bi bi-star text-warning"></i>
                <?php
                }
                ?>

            <?php
            }
            ?>
            <br>
            <small class="text-muted float-start"><?php echo $ulas['waktu']; ?> WIB</small>
            <br>
            <?php echo $ulas['ulasan']; ?>
        </div>

    <?php
    }
}
if ($hitungdata == 0) {
    ?>
    <div class="alert alert-secondary mt-2 text-center" role="alert">
        Pengguna ini belum menulis ulasan dimanapun
    </div>
<?php
}
?>

</div>
</form>
</div>
</div>

<?php
// include "bottomnav.php";

if (isset($_POST['btnEdit'])) {
    echo '<script type="text/javascript">$("#showName").hide()</script>';
    echo '<script type="text/javascript">$("#editName").show()</script>';
}

if (isset($_POST['btnKirim'])) {
    if ($_FILES["photo"]["tmp_name"] != NULL) {

        if ($data['img'] != NULL) {
            $files    = glob('img/user/' . $data['img']);
            foreach ($files as $file) {
                if (is_file($file))
                    unlink($file);
            }
        }

        $dir = "img/user/";
        $foto = $user . date('Ymdhis') . '.jpg';
        move_uploaded_file($_FILES["photo"]["tmp_name"], $dir . $foto);

        $nama = $_POST['nama_lengkap'];
        mysqli_query($conn, "UPDATE user SET nama_lengkap = '$nama', img = '$foto' WHERE username = '$user'");
    } else {
        $nama = $_POST['nama_lengkap'];
        mysqli_query($conn, "UPDATE user SET nama_lengkap = '$nama' WHERE username = '$user'");
    }

    $url = $_SERVER["REQUEST_URI"];
    echo "<script>location.replace('$url')</script>";
}

?>

<script>
    function previewImage() {
        document.getElementById("image-preview").style.display = "block";
        var onFReader = new FileReader();
        onFReader.readAsDataURL(document.getElementById("photo").files[0]);

        onFReader.onload = function(oFREvent) {
            document.getElementById("image-preview").src = oFREvent.target.result;
        };
    }
</script>