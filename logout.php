<?php 

// Session Start
session_start();

//Unset Session
unset($_SESSION['id_user']);
unset($_SESSION['password']);
unset($_SESSION['nama_admin']);
unset($_SESSION['username']);

session_destroy();
echo "<script>
alert('Terimakasih, Anda Telah Keluar Dari Halaman Admin...');
document.location='index.php';
</script>";
