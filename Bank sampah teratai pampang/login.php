<?php
session_start();
include 'templates/header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE nama = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama'] = $user['nama'];

            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Password salah.";
        }
    } else {
        $_SESSION['error'] = "Akun tidak ditemukan.";
    }
}
?>

<section class="section">
    <div class="columns is-centered">
        <div class="column is-4">
            <h1 class="title has-text-centered">Login</h1>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="notification is-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="field">
                    <label class="label">Nama</label>
                    <div class="control">
                        <input class="input" type="text" name="nama" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Password</label>
                    <div class="control">
                        <input class="input" type="password" name="password" required>
                    </div>
                </div>
                <div class="field">
                    <button class="button is-primary is-fullwidth">Login</button>
                </div>
            </form>
            <p class="has-text-centered">Belum punya akun? <a href="register.php">Register</a></p>
        </div>
    </div>
</section>

<?php include 'templates/footer.php'; ?>
