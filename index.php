<?php

//Panggil Koneksi Database
include "koneksi.php";

// Uji jika tombol simpan diklick
if (isset($_POST['bsimpan'])){
    $tgl = date('Y-m-d');

    
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
    $nope = htmlspecialchars($_POST['nope'], ENT_QUOTES);
    $keperluan = htmlspecialchars($_POST['keperluan'], ENT_QUOTES);

    //Persiapan query simpan data
    $simpan = mysqli_query($koneksi, "INSERT INTO ttamu VALUES ('','$tgl','$nama','$alamat', '$nope', '$keperluan')");

    //Uji jika simpan data berhasil
    if ($simpan) {
        echo "<script>alert('Simpan Data Sukses, Terima Kasih..!'); document.location='?'</script>";
    } else {
        echo "<script>alert('Simpan Data Gagal!!!'); document.location='?'</script>";
    }    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Buku Tamu SMKN 1 KARAWANG</title>
    <!-- Icon -->
    <link rel="icon" href="assets/img/logo.png" type="image/x-icon">

        <!-- Custom fonts for this template-->
        <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
        <!-- Custom styles for this page -->
        <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <!-- Container -->
    <div class="container">
        <!-- Head -->
        <div class="head text-center">
            <img src="assets/img/logo.png" width="100">
            <h2 class="text-white">Sistem Informasi Buku Tamu <br> SMKN 1 KARAWANG</h2>
        </div>
        <!-- End Head -->

        <!-- Start Row -->
        <div class="row mt-2">
            <!-- col-lg-7 -->
            <div class="col-lg-7 mb-3">
               <div class="card shadow bg-gradient-light">
                    <!-- Card Body -->
                    <div class="card-body">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                            </div>
                            <form class="user" method="POST" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="alamat" placeholder="Alamat" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nope" placeholder="No. Telp" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="keperluan" placeholder="Keperluan" required>
                                </div>

                                <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">Simpan Data</button>
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="login.php">Login Sebagai Admin</a>
                            </div>
                    </div>
                    <!-- End Card Body -->            
               </div> 
            </div>
            <!-- col-lg-7 -->

            <!-- col-lg-5 -->
            <div class="col-lg-5 mb-3">
               <div class="card shadow">
                    <div class="card-body">
                        <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
                        </div>

                        <?php
                            //Deklarasi tanggal

                            //menampilkan tanggal sekarang
                            $tgl_sekarang = date('Y-m-d');

                            //menampilkan tgl kemarin
                            $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

                            //menampilkan 6 hari sebelum tgl sekarang
                            $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));

                            $sekarang = date('Y-m-d h:i:s');


                            //persiapan query tampilkan data pengunjung
                            $tgl_sekarang = mysqli_fetch_array(mysqli_query($koneksi,
                            "SELECT count(*) FROM ttamu where tanggal like '%$tgl_sekarang%'"));

                            $kemarin = mysqli_fetch_array(mysqli_query($koneksi,
                            "SELECT count(*) FROM ttamu where tanggal like '%$kemarin%'"));

                            $seminggu = mysqli_fetch_array(mysqli_query($koneksi,
                            "SELECT count(*) FROM ttamu where tanggal BETWEEN '$seminggu' and '$sekarang'"));

                            $bulan_ini = date('m');
                            $sebulan = mysqli_fetch_array(mysqli_query($koneksi,
                            "SELECT count(*) FROM ttamu where month(tanggal) = '$bulan_ini'"));

                            $keseluruhan = mysqli_fetch_array(mysqli_query($koneksi,
                            "SELECT count(*) FROM ttamu"));
                        ?>


                        <table class="table table-bordered">
                            <tr>
                                <td>Hari ini</td>
                                <td>: <?= $tgl_sekarang[0] ?></td>
                            </tr>
                            <tr>
                                <td>Kemarin</td>
                                <td>: <?= $kemarin[0] ?></td>
                            </tr>
                            <tr>
                                <td>Minggu ini</td>
                                <td>: <?= $seminggu[0] ?></td>
                            </tr>
                            <tr>
                                <td>Bulan ini</td>
                                <td>: <?= $sebulan[0] ?></td>
                            </tr>
                            <tr>
                                <td>Keseluruhan</td>
                                <td>: <?= $keseluruhan[0] ?></td>
                            </tr>
                        </table>

                        <div class="text-center">
                            <a class="small">
                                <small>&copy; Project KKP Universitas Pelita Bangsa | 2022 - <?=date('Y')?></small>
                            </a>
                        </div>

                    </div>
               </div>
            </div>
            <!-- End col-lg-5 -->       
        </div>
        <!-- End Row -->

        </div>
    <!-- End Container -->

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

     <!-- Page level plugins -->
     <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

    
</body>
</html>