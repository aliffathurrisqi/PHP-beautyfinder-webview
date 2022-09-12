<?php
include "koneksi.php";
$id = $_GET['id'];
$Q = mysqli_query($conn, "SELECT toko.id,toko.nama_toko,kategori.nama_kategori,toko.alamat, kategori.nama_kategori 
,toko.longitude,toko.latitude,kategori.simbol FROM toko INNER JOIN kategori ON toko.id_kategori = kategori.id_kategori WHERE id='$id'");
if($Q){
 $posts = array();
      if(mysqli_num_rows($Q))
      {
             while($post = mysqli_fetch_assoc($Q)){
                     $posts[] = $post;
             }
      }  
      $data = json_encode(array('results'=>$posts));
                   
}

?>