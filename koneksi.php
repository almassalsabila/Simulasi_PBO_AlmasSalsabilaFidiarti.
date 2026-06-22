<?php
// Konfigurasi Database
$host     = "localhost";
$username = "root"; 
$password = "";     
$database = "db_simulasi_pbo_trpl1A_AlmasSalsabilaFidiarti";

// Membuat koneksi ke database menggunakan MySQLi (Object-Oriented)
$koneksi = new mysqli($host, $username, $password, $database);

// Memeriksa apakah koneksi berhasil atau gagal
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}

// Set charset ke UTF-8
$koneksi->set_charset("utf8");
?>