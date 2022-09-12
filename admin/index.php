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

include_once "header.php";
include_once "ambildata.php";
?>

<div class="row">

  <div class="col-md-12">
    <div class="panel panel-info panel-dashboard centered">
      <div class="panel-heading">
        <h2 class="panel-title"><strong> - TAMPILAN PETA - </strong></h2>
        <div id="coord"></div>
      </div>
      <div class="panel-body">
        <div id="map" style="width:100%;height:780px;"></div>

        <!-- 
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAbXF62gVyhJOVkRiTHcVp_BkjPYDQfH5w"></script> -->


        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCCc2S27MyVOC2u-fBWfagA5UyKpOPRkX0"></script>

        <!-- trial API -->
        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYoYWDkkxVBzR-qMaf8zhgZhyBYXGN6bU&callback=initMap&libraries=places"></script> -->

        <!-- API Google -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCc2S27MyVOC2u-fBWfagA5UyKpOPRkX0&callback=initMap&v=weekly" async></script>
        <script type="text/javascript">
          var user_latitude;
          var user_longitude;

          function getLocation() {
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition)

            } else {}
          }

          function showPosition(position) {
            // alert(position.coords.latitude + " , " + position.coords.longitude);
            initialize(position.coords.latitude, position.coords.longitude);

          }

          getLocation();

          function initialize(user_latitude, user_longitude) {

            var mapOptions = {
              zoom: 13,
              center: new google.maps.LatLng(-7.794915406409172, 110.37020923802413),
              mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var mapElement = document.getElementById('map');

            var map = new google.maps.Map(mapElement, mapOptions);

            // var myMarker = new google.maps.Marker({
            //   position: new google.maps.LatLng(-7.746968975949346, 110.35363297477984),
            //   title : user_latitude + " , " + user_longitude,
            //   map: map
            //   });


            var myMarker = new google.maps.Marker({
              position: new google.maps.LatLng(user_latitude, user_longitude),
              title: "Lokasi Anda : " + user_latitude + " , " + user_longitude,
              map: map,
              icon: '../img/marker_user.png'
            });

            setMarkers(map, locations);


          }

          var locations = [
            <?php
            if (json_decode($data, true)) {
              $obj = json_decode($data);
              foreach ($obj->results as $item) {
            ?>[<?php echo $item->id ?>, '<?php echo $item->nama_toko ?>', '<?php echo $item->alamat ?>', <?php echo $item->longitude ?>, <?php echo $item->latitude ?>, '<?php echo $item->simbol ?>', '<?php echo $item->nama_kategori ?>', '<?php echo $item->img ?>'],
            <?php
              }
            }
            ?>
          ];

          function setMarkers(map, locations) {

            for (var i = 0; i < locations.length; i++) {

              var toko = locations[i];
              var myLatLng = new google.maps.LatLng(toko[4], toko[3]);
              var infowindow = new google.maps.InfoWindow({
                content: contentString
              });

              var contentString =
                '<div id="content">' +
                '<div id="siteNotice">' +
                '</div>' +
                '<img src="../img/toko/' + toko[7] + '" width="100%" class="mb-2">' +
                '<h5 id="firstHeading" class="firstHeading">' + toko[1] + '</h5>' +
                '<div id="bodyContent">' +
                '<p> Kategori : ' + toko[6] + '</p>' +
                '<p>' + toko[2] + '</p>' +
                // '<a class="btn btn-primary" href=data_edit.php?id='+toko[0]+'>Ubah Data</a>'+
                '</div>' +
                '</div>';

              var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: toko[1],
                icon: '../img/' + toko[5]
              });

              google.maps.event.addListener(marker, 'click', getInfoCallback(map, contentString));
            }
          }

          function getInfoCallback(map, content) {
            var infowindow = new google.maps.InfoWindow({
              content: content
            });
            return function() {
              infowindow.setContent(content);
              infowindow.open(map, this);
            };
          }

          google.maps.event.addDomListener(window, 'load', initialize);
        </script>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<?php


include_once "footer.php"; ?>