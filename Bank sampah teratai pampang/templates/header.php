<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah Teratai Pampang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<nav class="navbar is-primary">
    <div class="navbar-brand">
        <a class="navbar-item" href="index.php">
            <strong>Bank Sampah Teratai Pampang</strong>
        </a>
    </div>
    <div class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="index.php">Beranda</a>
            <a class="navbar-item" href="daftar_harga.php">Daftar Harga</a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
                <a class="navbar-item" href="setor.php">Setor Sampah</a>
                <a class="navbar-item" href="saldo.php">Saldo</a>
                <a class="navbar-item" href="view_setor.php">Riwayat Setor</a>
            <?php endif; ?>
        </div>
        <div class="navbar-end">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="navbar-item" href="proses/logout.php">Logout</a>
            <?php else: ?>
                <a class="navbar-item" href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container mt-5">
