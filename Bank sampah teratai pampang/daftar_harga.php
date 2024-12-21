<?php
session_start();
include 'templates/header.php';
include 'config.php';

$query = "SELECT jenis_sampah, harga_per_kg FROM daftar_harga";
$result = $conn->query($query);
?>

<section class="section">
    <h1 class="title has-text-centered">Daftar Harga Sampah</h1>
    <table class="table is-striped is-fullwidth">
        <thead>
            <tr>
                <th>Jenis Sampah</th>
                <th>Harga per Kg (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['jenis_sampah']); ?></td>
                    <td>Rp <?php echo number_format($row['harga_per_kg'], 2, ',', '.'); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>

<?php include 'templates/footer.php'; ?>
