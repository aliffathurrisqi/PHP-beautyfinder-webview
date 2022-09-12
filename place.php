<?php
session_start();
$_SESSION['username'] = $_SESSION['username'];
$user = $_SESSION['username'];
if ($user == NULL) {
    echo '<script> location.replace("login.php"); </script>';
}
include "koneksi.php";
include_once "header.php";
include_once "navbar.php"; ?>


<!-- <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAbXF62gVyhJOVkRiTHcVp_BkjPYDQfH5w"></script> -->

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYoYWDkkxVBzR-qMaf8zhgZhyBYXGN6bU&callback=initMap&libraries=places"></script>
<script src="https://maps.googleapis.com/maps/api/directions/json?origin=Disneyland&destination=Universal+Studios+Hollywood&key=AIzaSyAYoYWDkkxVBzR-qMaf8zhgZhyBYXGN6bU&callback=initMap&libraries=places"></script> -->

<!-- trial API -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYoYWDkkxVBzR-qMaf8zhgZhyBYXGN6bU&callback=initMap&libraries=places"></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/directions/json?origin=KOORDINAT&destination=KOORDINAT&key=APIKEY"></script> -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCc2S27MyVOC2u-fBWfagA5UyKpOPRkX0&callback=initMap&libraries=places"></script>

<script>
    var marker;

    function initialize() {
        var propertiPeta = {
            center: new google.maps.LatLng(document.getElementById("lat").value, document.getElementById("lng").value),
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var peta = new google.maps.Map(document.getElementById("map-canvas"), propertiPeta);

        var marker_lama = new google.maps.Marker({
            position: new google.maps.LatLng(document.getElementById("lat").value, document.getElementById("lng").value),
            map: peta,
            icon: 'img/marker_add.png'
        });

        google.maps.event.addListener(peta, 'click', function(event) {
            taruhMarker(this, event.latLng);
        });

    }


    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<form method="POST">
    <div class="row">

        <?php
        $id = $_GET['id'];
        $data_toko = mysqli_query(
            $conn,
            "SELECT toko.id,nama_toko,alamat,latitude,longitude,img,nama_kategori
              FROM toko INNER JOIN kategori ON toko.id_kategori = kategori.id_kategori WHERE toko.id = $id"
        );
        $data = mysqli_fetch_array($data_toko);
        $idtoko = $data['id'];

        if ($data['nama_kategori'] == "Busana") {
            $produk = "Baju, Celana, Rok, Jaket, Outer";
        }

        if ($data['nama_kategori'] == "Skincare") {
            $produk = "Pelembab, Serum, Essence, Toner, Sabun Wajah";
        }

        if ($data['nama_kategori'] == "Kosmetik") {
            $produk = "Lipstick, Bedak, Foundation, Eye Shadow";
        }

        if ($data['nama_kategori'] == "Aksesoris") {
            $produk = "Gelang, Kalung, Jepit, Bando, Jilbab";
        }
        ?>
        <div class="col-md-12">

            <!-- <div id="map-canvas" style="width:100%;height:180px;margin-top:50px;"></div> -->
            <div>
                <img src="img/toko/<?php echo $data['img']; ?>" width="100%">
            </div>

        </div>
        <div class="panel panel-info">
            <div class="panel-body">
                <td><input type="hidden" name="la_toko" id="lat" class="form-control" placeholder="Masukkan latitude" aria-describedby="basic-addon1" value="<?php echo $data['latitude'] ?>"></td>
                <td><input type="hidden" name="lo_toko" id="lng" class="form-control" placeholder="Masukkan longitude" aria-describedby="basic-addon1" value="<?php echo $data['longitude'] ?>"></td>
                <div class="fs-5">
                    <h5><?php echo $data['nama_toko']; ?></h5>
                    <p>
                        <?php echo $data['alamat']; ?>
                    </p>
                    <p class="text-secondary">
                        Jenis Produk : <?php echo $produk; ?>
                    </p>
                    <center>
                        <a class="btn btn-primary text-center w-50" href="routes.php?search=&&destination=<?php echo $data['latitude']; ?>,<?php echo $data['longitude']; ?>">Temukan Rute</a>
                    </center>
                </div>

                <?php
                $rating = mysqli_query($conn, "SELECT ROUND(AVG(rating),1) AS rating,COUNT(id) AS jmlRating FROM ulasan WHERE id_toko = '$idtoko'");
                $datarating = mysqli_fetch_array($rating);
                if ($datarating['rating'] > 0) {
                ?>
                    <span class="fs-1 text-warning mb-2"><i class="bi bi-star-fill"></i> <?php echo $datarating['rating']; ?> </span><span class="fs-4"> dari <?php echo $datarating['jmlRating']; ?> pengguna</span>
                <?php
                }
                if ($datarating['rating'] == NULL) {
                ?>
                    <span class="fs-5 mb-2"><i>Belum ada rating<i></span>
                    <?php
                }

                if ($user != NULL) {

                    $cekrating = mysqli_query($conn, "SELECT username FROM ulasan WHERE username = '$user' AND id_toko = '$idtoko'");
                    $cekrating2 = mysqli_num_rows($cekrating);
                    if ($cekrating2 < 1) {
                    ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="input-group mb-2 mt-2">
                                <i class="bi bi-star-fill text-warning fs-1"></i>
                                <select name="rating" class="form-select form-select-sm ms-2 fs-5" aria-label=".form-select-sm example">
                                    <i class="bi bi-star-fill text-warning fs-3">
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                </select>
                                <input type="text" class="form-control w-50" placeholder="tuliskan penilaian anda disini" name="ulasan">
                                <input type="submit" class="btn btn-primary w-25" name="btnUlas" value="Kirim">
                            </div>
                        </form>
            </div>
    <?php
                    }
                }
    ?>

    <?php
    $dataulasan = mysqli_query($conn, "SELECT * FROM ulasan WHERE id_toko = '$idtoko' ORDER BY waktu DESC");
    while ($ulas = mysqli_fetch_array($dataulasan)) {
        $dataUser = $ulas['username'];
        $dataUserulasan = mysqli_query($conn, "SELECT img FROM user WHERE username = '$dataUser'");
        $ulasUser = mysqli_fetch_array($dataUserulasan);
        if ($ulasUser['img'] != NULL) {
            $gambarUser = $ulasUser['img'];
        } else {
            $gambarUser = 'default.png';
        }
    ?>

        <div class="mt-2 mb-2 p-2 fs-5">
            <img class="rounded-circle me-1" src="img/user/<?php echo $gambarUser; ?>" width="20px" height="20px" id="image-preview">
            <a href="people.php?id=<?php echo $ulas['username']; ?>" id="people"><strong><?php echo $ulas['username']; ?></strong></a>
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
    ?>

        </div>
</form>
</div>
</div>

<?php
// include "bottomnav.php";

if (isset($_POST['btnUlas'])) {

    $rating = $_POST['rating'];
    $ulasan = $_POST['ulasan'];
    $idulasan = $idtoko . $user;
    $url = $_SERVER["REQUEST_URI"];
    mysqli_query($conn, "INSERT INTO ulasan VALUES('$idulasan','$idtoko','$rating','$user','$ulasan',NOW())");

    echo "<script>location.replace('$url')</script>";
}

?>