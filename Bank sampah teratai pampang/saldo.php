<?php
session_start();
include 'templates/header.php';
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT saldo FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<section class="section">
    <div class="columns is-centered">
        <div class="column is-4">
            <div class="box has-text-centered">
                <h1 class="title">Saldo Anda</h1>
                <p class="is-size-4 has-text-weight-bold">
                    Rp <?php echo number_format($user['saldo'], 2, ',', '.'); ?>
                </p>
                <a href="setor.php" class="button is-primary mt-3">Setor Sampah</a>
            </div>
        </div>
    </div>
</section>

<?php include 'templates/footer.php'; ?>
