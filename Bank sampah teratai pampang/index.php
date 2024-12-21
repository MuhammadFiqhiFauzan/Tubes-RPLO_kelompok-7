<?php
session_start();
include 'templates/header.php'; // Header umum
?>

<section class="hero is-primary is-bold">
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title">Sistem Transaksi Pencatatan Bank Sampah Teratai Pampang</h1>
            <h2 class="subtitle">Selamat Datang di Sistem Bank Sampah</h2>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="columns is-multiline is-centered">
            <!-- Card 1: Lihat Saldo -->
            <div class="column is-4">
                <div class="card">
                    <div class="card-content has-text-centered">
                        <p class="title is-4">Lihat Saldo</p>
                        <p class="subtitle is-6">Cek saldo sampah Anda</p>
                        <a href="saldo.php" class="button is-primary">Lihat Saldo</a>
                    </div>
                </div>
            </div>

            <!-- Card 2: Setor Sampah -->
            <div class="column is-4">
                <div class="card">
                    <div class="card-content has-text-centered">
                        <p class="title is-4">Setor Sampah</p>
                        <p class="subtitle is-6">Setor sampah dan tingkatkan saldo Anda</p>
                        <a href="setor.php" class="button is-success">Setor Sekarang</a>
                    </div>
                </div>
            </div>

            <!-- Card 3: Daftar Harga -->
            <div class="column is-4">
                <div class="card">
                    <div class="card-content has-text-centered">
                        <p class="title is-4">Daftar Harga</p>
                        <p class="subtitle is-6">Lihat harga sampah per kilogram</p>
                        <a href="daftar_harga.php" class="button is-info">Lihat Harga</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Login / Logout -->
        <div class="has-text-centered mt-4">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="proses/logout.php" class="button is-danger">Logout</a>
            <?php else: ?>
                <a href="login.php" class="button is-primary">Login</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'templates/footer.php'; ?>
