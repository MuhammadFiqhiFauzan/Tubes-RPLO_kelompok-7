<?php 
session_start();
include 'templates/header.php';
include 'config.php'; // File koneksi database

// Cek apakah user sudah login dan tipe pengguna adalah "user"
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    echo "<section class='section'><div class='notification is-danger'>Anda tidak memiliki akses ke halaman ini!</div></section>";
    include 'templates/footer.php';
    exit();
}

// Ambil ID user dari session
$user_id = $_SESSION['user_id'];

// Query untuk mendapatkan data setor sampah dengan nama pengguna
$query = "
    SELECT users.nama, setor_sampah.jenis_sampah, setor_sampah.berat, setor_sampah.tanggal
    FROM setor_sampah
    INNER JOIN users ON setor_sampah.user_id = users.id
    WHERE setor_sampah.user_id = ?
    ORDER BY setor_sampah.tanggal DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<section class="section">
    <div class="container">
        <h1 class="title has-text-centered">Riwayat Setor Sampah</h1>

        <?php if ($result->num_rows > 0): ?>
            <table class="table is-striped is-fullwidth">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jenis Sampah</th>
                        <th>Berat (kg)</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while ($row = $result->fetch_assoc()): 
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['jenis_sampah']); ?></td>
                            <td><?php echo htmlspecialchars($row['berat']); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="notification is-info has-text-centered">
                Anda belum pernah menyetor sampah. Silakan setor sampah terlebih dahulu.
            </div>
        <?php endif; ?>

        <div class="has-text-centered mt-5">
            <a href="setor.php" class="button is-primary">Setor Sampah</a>
        </div>
    </div>
</section>
<?php 
$stmt->close();
$conn->close();
include 'templates/footer.php'; 
?>
