<?php
// Konfigurasi database
$host = 'localhost'; // Host database
$user = 'root';      // Username database
$password = '';      // Password database
$dbname = 'bank_sampah'; // Nama database

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>
