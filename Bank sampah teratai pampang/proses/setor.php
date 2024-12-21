<?php
session_start();
include '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$jenis_sampah = $_POST['jenis_sampah'];
$berat = floatval($_POST['berat']);

$query_harga = "SELECT harga_per_kg FROM daftar_harga WHERE jenis_sampah = ?";
$stmt = $conn->prepare($query_harga);
$stmt->bind_param("s", $jenis_sampah);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $harga_per_kg = $result->fetch_assoc()['harga_per_kg'];
    $total_harga = $berat * $harga_per_kg;

    // Simpan transaksi
    $query = "INSERT INTO setor_sampah (user_id, jenis_sampah, berat, tanggal, total_harga) 
              VALUES (?, ?, ?, NOW(), ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issd", $user_id, $jenis_sampah, $berat, $total_harga);
    $stmt->execute();

    // Update saldo
    $update_saldo = "UPDATE users SET saldo = saldo + ? WHERE id = ?";
    $stmt = $conn->prepare($update_saldo);
    $stmt->bind_param("di", $total_harga, $user_id);
    $stmt->execute();

    $_SESSION['message'] = "Setor sampah berhasil!";
    header("Location: ../setor.php");
} else {
    $_SESSION['error'] = "Jenis sampah tidak valid!";
    header("Location: ../setor.php");
}
exit();
?>
