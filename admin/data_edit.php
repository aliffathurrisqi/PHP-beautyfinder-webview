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
      center: new google.maps.LatLng(document.getElementById("lat").value, document.getElementById("lng").value),
      zoom: 16,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var peta = new google.maps.Map(document.getElementById("map-canvas"), propertiPeta);

    var marker_lama = new google.maps.Marker({
      position: new google.maps.LatLng(document.getElementById("lat").value, document.getElementById("lng").value),
      map: peta,
      icon: '../img/marker_last.png'
    });

    // even listner ketika peta diklik
    google.maps.event.addListener(peta, 'click', function(event) {
      taruhMarker(this, event.latLng);
    });

  }

  // event jendela di-load  
  google.maps.event.addDomListener(window, 'load', initialize);
</script>
<form method="POST" enctype="multipart/form-data">
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
          <table class="table">
            <tr>
              <th colspan="2">Data Toko</th>
            </tr>

            <?php
            $id = $_GET['id'];
            $data_toko = mysqli_query(
              $conn,
              "SELECT id,nama_toko,alamat,latitude,longitude,img 
              FROM toko WHERE toko.id = $id"
            );
            if ($data_toko) {
              while ($data = mysqli_fetch_array($data_toko)) {
                $gambar = $data['img'];
            ?>
                <tr colspan="2">
                  <label>Upload Gambar</label><br>
                  <center>
                    <img src="../img/toko/<?php echo $gambar ?>" id="image-preview" width="150px">
                  </center>
                  <input type="file" id="photo" name="photo" aria-describedby="basic-addon1" accept="image/png, image/gif, image/jpeg, image/jpg" onchange="previewImage()">
                </tr>
                <tr>
                  <td>Nama Toko</td>
                  <td><input type="text" name="nm_toko" class="form-control" placeholder="Masukkan nama toko" aria-describedby="basic-addon1" value="<?php echo $data['nama_toko'] ?>"></td>
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
                  <td><input type="text" name="al_toko" class="form-control" placeholder="Masukkan alamat" aria-describedby="basic-addon1" value="<?php echo $data['alamat'] ?>"></td>
                </tr>
                <td><input type="hidden" name="la_toko" id="lat" class="form-control" placeholder="Masukkan latitude" aria-describedby="basic-addon1" value="<?php echo $data['latitude'] ?>"></td>
                <td><input type="hidden" name="lo_toko" id="lng" class="form-control" placeholder="Masukkan longitude" aria-describedby="basic-addon1" value="<?php echo $data['longitude'] ?>"></td>
          </table>
      <?php
              }
            }
      ?>
      <button class="btn btn-success mb-2" name="btnPost" style="width: 100%; color:white;">Ubah Data</button>
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

// mengubah data

if (isset($_POST["btnPost"])) {

  $nama = $_POST["nm_toko"];
  $kategori = $_POST["kat_toko"];
  $alamat = $_POST["al_toko"];
  $latitude = $_POST["la_toko"];
  $longitude = $_POST["lo_toko"];

  $search = mysqli_query($conn, "SELECT * FROM toko WHERE id = '$id'");
  $data = mysqli_fetch_array($search);

  if ($_FILES["photo"]["tmp_name"] != NULL) {

    if ($data['img'] != 'default.png') {
      $files    = glob('../img/toko/' . $data['img']);
      foreach ($files as $file) {
        if (is_file($file))
          unlink($file);
      }
    }

    $dir = "../img/toko/";
    $foto = date('Ymdhis') . '.jpg';
    move_uploaded_file($_FILES["photo"]["tmp_name"], $dir . $foto);

    $edit = mysqli_query(
      $conn,
      "UPDATE toko SET nama_toko = '$nama', id_kategori = '$kategori', alamat = '$alamat',
        latitude = '$latitude', longitude = '$longitude', img = '$foto' WHERE id = '$id'"
    );
  } else {
    $edit = mysqli_query(
      $conn,
      "UPDATE toko SET nama_toko = '$nama', id_kategori = '$kategori', alamat = '$alamat',
        latitude = '$latitude', longitude = '$longitude' WHERE id = '$id'"
    );
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