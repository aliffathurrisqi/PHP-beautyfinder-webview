<?php
session_start();
include_once "koneksi.php";
if (isset($_GET['username'])) {

  $userLog = $_GET["username"];
  $cekLogin = mysqli_query($conn, "SELECT * FROM user WHERE username = '$userLog' OR email = '$userLog'");
  $dataLog = mysqli_fetch_array($cekLogin);
  $_SESSION['username'] = $dataLog['username'];
  $_SESSION['location'] = $_GET["location"];
}

$user = $_SESSION['username'];
echo $userLog;

include_once "header.php";
include_once "ambildata.php";
include_once "navbar.php";
?>
<div class="row p-0">
  <div class="col-md-12">

    <div class="p-0 mh-100 d-inline-block" id="map" style="width:100%;height:100%;min-height:550px;margin-top:0px;">
    </div>

    <!-- Menampilkan Peta -->
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCCc2S27MyVOC2u-fBWfagA5UyKpOPRkX0"></script>

    <!-- API Google -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCc2S27MyVOC2u-fBWfagA5UyKpOPRkX0&callback=initMap&v=weekly" async></script>

    <script type="text/javascript">
      var user_latitude;
      var user_longitude;
      var rute;
      var userposition;

      function getLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition)

        } else {}
      }

      function showPosition(position) {
        initialize(position.coords.latitude, position.coords.longitude);
        userposition = position.coords.latitude + "," + position.coords.longitude;

      }

      function initialize(user_latitude, user_longitude) {

        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();

        var mapOptions = {
          zoom: 12,
          center: new google.maps.LatLng(-7.794915406409172, 110.37020923802413),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var mapElement = document.getElementById('map');

        var map = new google.maps.Map(mapElement, mapOptions);

        const onClickHandler = function() {
          calculateAndDisplayRoute(directionsService, directionsRenderer);
        };


        var myMarker = new google.maps.Marker({
          position: new google.maps.LatLng(user_latitude, user_longitude),
          title: "Lokasi Anda : " + user_latitude + " , " + user_longitude,
          map: map,
          icon: 'img/marker_user.png'
        });
        getLocation();
        setMarkers(map, locations);

        document.getElementById("start").value = userposition;
        document.getElementById("end").addEventListener("click", onClickHandler);



      }

      function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        directionsService
          .route({
            origin: {
              query: document.getElementById("start").value,
            },
            destination: {
              query: document.getElementById("end").value,
            },
            travelMode: google.maps.TravelMode.DRIVING,
          })
          .then((response) => {
            directionsRenderer.setDirections(response);
          })
          .catch((e) => window.alert("Directions request failed due to " + status));
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

      // Menampilkan marker (titik toko)
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
            '<img src="img/toko/' + toko[7] + '" width="100%" class="mb-2">' +
            '<h5 id="firstHeading" class="firstHeading text-center">' + toko[1] + '</h5>' +
            '<div id="bodyContent">' +
            '<p class="text-center"> Kategori : ' + toko[6] + '</p>' +
            '<p>' + toko[2] + '</p>' +
            '<form method = "POST">' +
            '<a href="place.php?id=' + toko[0] + '" class="btn btn-primary text-center w-100 mb-2">Lihat Toko</a>' +
            '<a class="btn btn-primary text-center w-100" href="routes.php?search=&&destination=' + toko[4] + ',' + toko[3] + '">Temukan Rute</a>' +
            '</form>' +
            '</div>' +
            '</div>';

          var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: toko[1],
            icon: 'img/' + toko[5]
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

<div class="d-none d-sm-inline-block">
  <input id="start" type="text">
</div>
<input type="hidden" class="btn btn-primary text-center w-100" id="end">
<?php
// include "bottomnav.php";
?>