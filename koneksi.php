<?php
$host     = "localhost";
$username = "root";
$password = ""; // Kosongkan jika menggunakan XAMPP bawaan
$database = "db_uas_pbo_ti1c_giatjohannasrulloh";

// Membuat koneksi menggunakan MySQLi
$koneksi = new mysqli($host, $username, $password, $database);

// Memeriksa apakah koneksi berhasil atau gagal
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}

// Set charset ke utf8 agar pembacaan karakter lebih aman
$koneksi->set_charset("utf8");
?>