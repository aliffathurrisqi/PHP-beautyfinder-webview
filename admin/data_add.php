<?php
session_start();
$_SESSION['username'] = $_SESSION['username'];
$user = $_SESSION['username'];
if ($user == NULL) {
  echo '<script> location.replace("../login.php"); </script>';
}

include "koneksi.php";

$cek = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");
$data = mysqli_fetch_array($cek);
if ($data['akses'] != 'Admin') {
  echo '<script> location.replace("../index.php?search="); </script>';
}

include_once "header.php"; ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCc2S27MyVOC2u-fBWfagA5UyKpOPRkX0&callback=initMap&libraries=places"></script>

<script>
  var marker;

  function taruhMarker(peta, posisiTitik) {

    if (marker) {
      // pindahkan marker
      marker.setPosition(posisiTitik);
    } else {
      // buat marker baru
      marker = new google.maps.Marker({
        position: posisiTitik,
        map: peta,
        icon: '../img/marker_add.png'
      });
    }

    // isi nilai koordinat ke form
    document.getElementById("lat").value = posisiTitik.lat();
    document.getElementById("lng").value = posisiTitik.lng();

  }

  function initialize() {
    var propertiPeta = {
      center: new google.maps.LatLng(-7.794915406409172, 110.37020923802413),
      zoom: 12,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var peta = new google.maps.Map(document.getElementById("map-canvas"), propertiPeta);

    google.maps.event.addListener(peta, 'click', function(event) {
      taruhMarker(this, event.latLng);
    });

  }

  google.maps.event.addDomListener(window, 'load', initialize);
</script>
<form method="POST">
  <div class="row">
    <div class="col-md-7">
      <div class="panel panel-info panel-dashboard">
        <div class="panel-heading centered">
          <h2 class="panel-title"><strong> - Lokasi - </strong></h4>
        </div>
        <div class="panel-body">
          <div id="map-canvas" style="width:100%;height:380px;"></div>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="panel panel-info panel-dashboard">
        <div class="panel-heading centered">
          <h2 class="panel-title"><strong> - Detail - </strong></h4>
        </div>
        <div class="panel-body">
          <label>Upload Gambar</label><br>
          <center>
            <img src="../img/toko/default.png" id="image-preview" width="150px">
          </center>
          <input type="file" id="photo" name="photo" aria-describedby="basic-addon1" accept="image/png, image/gif, image/jpeg, image/jpg" onchange="previewImage()">
          <table class="table">
            <tr>
              <th colspan="2">Data Toko</th>
            </tr>
            <tr>
              <td>Nama Toko</td>
              <td><input type="text" name="nm_toko" class="form-control" placeholder="Masukkan nama toko" aria-describedby="basic-addon1"></td>
            </tr>
            <tr>
              <td>Kategori</td>
              <td>
                <div class="input-group mb-3">
                  <select name="kat_toko" class="form-select" id="inputGroupSelect01">
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM kategori");
                    while ($row = mysqli_fetch_array($kategori)) {
                    ?>
                      <option value="<?php echo $row['id_kategori']; ?>"><?php echo $row['nama_kategori']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>
                <textarea class="form-control" name="al_toko" aria-label="With textarea" style="resize: none; height:100px;" placeholder="Masukkan Alamat"></textarea>
              </td>
            </tr>
            <input type="hidden" name="la_toko" id="lat" class="form-control" placeholder="Masukkan latitude" aria-describedby="basic-addon1">
            <input type="hidden" name="lo_toko" id="lng" class="form-control" placeholder="Masukkan longitude" aria-describedby="basic-addon1">
          </table>
          <button class="btn btn-success mb-2" name="btnPost" style="width: 100%; color:white;">Tambah Data</button>
          <br><br>
          <a class="btn btn-danger mb-2" href="data.php" style="width: 100%; color:white;">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</form>
</div>
</div>
<?php
include_once "footer.php";

// Menambahkan data toko

if (isset($_POST["btnPost"])) {

  $nama = $_POST["nm_toko"];
  $kategori = $_POST["kat_toko"];
  $alamat = $_POST["al_toko"];
  $latitude = $_POST["la_toko"];
  $longitude = $_POST["lo_toko"];

  if ($_FILES["photo"]["tmp_name"] != NULL) {
    $dir = "../img/toko/";
    $foto = date('Ymdhis') . '.jpg';
    move_uploaded_file($_FILES["photo"]["tmp_name"], $dir . $foto);
    $post = mysqli_query($conn, "INSERT INTO toko VALUES(NULL,'$nama','$kategori','$foto','$alamat','$latitude','$longitude','$user','Tidak')");
  } else {
    $post = mysqli_query($conn, "INSERT INTO toko VALUES(NULL,'$nama','$kategori','default.png','$alamat','$latitude','$longitude','$user','Tidak')");
  }

  echo '<script> location.replace("data.php"); </script>';
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