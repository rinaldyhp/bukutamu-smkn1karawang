<?php include "header.php"; ?>

<!-- Head -->
<div class="head text-center">
    <img src="assets/img/logo.png" width="100">
    <h2 class="text-white">Sistem Informasi Buku Tamu <br> SMKN 1 KARAWANG</h2>
</div>
<!-- End Head -->

<!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari Ini [<?=date('d-m-Y') ?>] </h6>
        </div>
            <div class="card-body">
                <a href="rekapitulasi.php" class="btn btn-success mb-3">
                    <i class="fa fa-table"></i>Rekapitulasi Pengunjung</a>
                    
                <a href="logout.php" class="btn btn-danger mb-3">
                    <i class="fa fa-sign-out-alt"></i>Logout</a>


                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No.Telp</th>
                                <th>Keperluan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tgl = date('Y-m-d'); 
                                $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu where tanggal like '%$tgl%' order by id desc");
                                $no = 1;
                                while($data = mysqli_fetch_array($tampil)){
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['tanggal'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['alamat'] ?></td>
                                <td><?= $data['nope'] ?></td>
                                <td><?= $data['keperluan'] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

<?php include "footer.php"; ?>