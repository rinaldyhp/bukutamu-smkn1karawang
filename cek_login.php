<?php

// Aktifkan Session
session_start();

//Panggil Koneksi Database
include "koneksi.php";

@$pass = md5($_POST['password']);
@$username = mysqli_escape_string($koneksi, $_POST['username']);
@$password = mysqli_escape_string($koneksi, $pass);


$login = mysqli_query($koneksi, "SELECT * FROM tuser where username = '$username' and password = '$password' and status = 'Aktif' ");

$data = mysqli_fetch_array($login);

// Uji Jika Username dan Password Sesuai
if($data){
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['password'] = $data['password'];
    $_SESSION['nama_admin'] = $data['nama_admin'];

    //Halaman Admin
    header('location:admin.php');
}else{
    echo "<script>
            alert('Maaf, Login Gagal. Pastikan Username dan Password Anda Benar...!!!');
            document.location='index.php';
        </script>";
}

?>