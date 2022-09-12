<?php 
$id = $_GET['id'];
include_once "ambildata_id.php";
$obj = json_decode($data);
$titles="";
$ids="";
$kat="";
// $web="";
// $hp="";
$alamat="";
// $kota="";
// $prov="";
$lat="";
$long="";
$sym="";

foreach($obj->results as $item){
  $titles.=$item->nama_toko;
  $ids.=$item->id;
  $kat.=$item->nama_kategori;
  // $web.=$item->website;
  // $hp.=$item->no_hp;
  $alamat.=$item->alamat;
  // $kota.=$item->kota;
  // $prov.=$item->provinsi;
  $lat.=$item->latitude;
  $long.=$item->longitude;
  $sym.=$item->simbol;
}

$title = "Detail dan Lokasi : ".$titles;
include_once "header.php"; ?>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAbXF62gVyhJOVkRiTHcVp_BkjPYDQfH5w"></script>

<script>

function initialize() {
  var myLatlng = new google.maps.LatLng(<?php echo $lat ?>,<?php echo $long ?>);
  var mapOptions = {
    zoom: 16,
    center: myLatlng
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h5 id="firstHeading" class="firstHeading"><?php echo $titles ?></h5>'+
      '<div id="bodyContent">'+
      '<p><?php echo $alamat ?></p>'+
      '</div>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: '<?php echo $titles?>',
      icon:'img/<?php echo $sym?>'
  });
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
      <div class="row">
      <div class="col-md-5">
          <div class="panel panel-info panel-dashboard">
            <div class="panel-heading centered">
              <h2 class="panel-title"><strong> - Lokasi - </strong></h4>
            </div>
            <div class="panel-body">
              <div id="map-canvas" style="width:100%;height:380px;"></div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="panel panel-info panel-dashboard">
            <div class="panel-heading centered">
              <h2 class="panel-title"><strong> - Detail - </strong></h4>
            </div>
            <div class="panel-body">
             <table class="table">
               <tr>
                 <th colspan="2">Data Toko</th>
               </tr>
               <tr>
                 <td>Nama Toko</td>
                 <td><h4><?php echo $titles ?></h4></td>
               </tr>
               <tr>
                 <td>Kategori</td>
                 <td><h4><?php echo $kat ?></h4></td>
               </tr>
               <tr>
                 <td>Alamat</td>
                 <td><h4><?php echo $alamat ?></h4></td>
               </tr>
             </table>
            </div>
            </div>
          </div>

        
        </div>
      </div>
    </div>
    <?php 
    //var_dump($obj = json_decode($data));
    include_once "footer.php"; ?>