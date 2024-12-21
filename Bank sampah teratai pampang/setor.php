<?php
session_start();
include 'templates/header.php';
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$query = "SELECT jenis_sampah FROM daftar_harga";
$result = $conn->query($query);
?>

<section class="section">
    <div class="columns is-centered">
        <div class="column is-6">
            <!-- Header Section -->
            <div class="is-flex is-justify-content-space-between mb-4">
                <h1 class="title">Form Setor Sampah</h1>
                <a href="proses/logout.php" class="button is-danger">Logout</a>
            </div>

            <!-- Form Section -->
            <form action="proses/setor.php" method="POST" class="box">
                <div class="field">
                    <label class="label">Jenis Sampah</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="jenis_sampah" required>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <option value="<?php echo $row['jenis_sampah']; ?>">
                                        <?php echo $row['jenis_sampah']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Berat (kg)</label>
                    <div class="control">
                        <input class="input" type="number" name="berat" step="0.01" min="0.01" required>
                    </div>
                </div>
                <div class="field">
                    <button class="button is-primary is-fullwidth">Setor Sampah</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include 'templates/footer.php'; ?>
