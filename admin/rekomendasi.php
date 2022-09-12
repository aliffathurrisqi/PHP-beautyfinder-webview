<?php
session_start();
$_SESSION['username'] = $_SESSION['username'];
$user = $_SESSION['username'];
if ($user == NULL) {
    echo '<script> location.replace("../login.php"); </script>';
}

include_once "koneksi.php";
$cek = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");
$data = mysqli_fetch_array($cek);
if ($data['akses'] != 'Admin') {
    echo '<script> location.replace("../index.php?search="); </script>';
}
$title = "BEAUTY FINDER";
include_once "header.php";
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info panel-dashboard">
            <div class="panel-heading centered">
                <h2 class="panel-title"><strong> - <?php echo $title ?> - </strong></h2>
            </div>
            <div class="panel-body">
                <div class="btn-group">
                    <a href="data_add.php" rel="tooltip" data-placement="top" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Lokasi</a>&nbsp;
                </div>
                <table class="table table-bordered table-striped table-admin">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th width="20%">Nama Perusahaan</th>
                            <th width="10%">Kategori</th>
                            <th width="22%">Alamat</th>
                            <th width="11%">Oleh</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $data_toko = mysqli_query(
                            $conn,
                            "SELECT toko.id,toko.nama_toko,kategori.nama_kategori,toko.alamat,toko.username
              FROM toko INNER JOIN kategori ON toko.id_kategori = kategori.id_kategori WHERE verifikasi = 'Tidak'"
                        );
                        $no = 1;
                        if ($data_toko) {
                            while ($row = mysqli_fetch_array($data_toko)) {

                        ?>

                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row['nama_toko']; ?></td>
                                    <td><?php echo $row['nama_kategori']; ?></td>
                                    <td><?php echo $row['alamat']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td align="center">
                                        <a href="data_konfirmasi.php?id=<?php echo $row['id']; ?>" class="btn btn-success">
                                            <i class="bi bi-geo-alt-fill"></i> Publikasikan</a>
                                        <br><br>
                                        <a href="data_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">
                                            <i class="bi bi-zoom-in"></i> Lihat Informasi</a>
                                        <br><br>
                                        <a href="data_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger w-100">
                                            <i class="bi bi-trash"></i> Hapus Data</a>
                                    </td>
                                </tr>

                        <?php $no++;
                            }
                        }
                        // }}

                        // else{
                        //   echo "data tidak ada.";
                        //   } 
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php
// var_dump(file_get_contents("ambildata.php"));
?>

<?php include_once "footer.php" ?>