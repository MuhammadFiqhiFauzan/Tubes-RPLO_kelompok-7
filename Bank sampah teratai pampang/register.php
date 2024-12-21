<?php
session_start();
include 'templates/header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';

    // Cek apakah nama sudah digunakan
    $check_query = "SELECT * FROM users WHERE nama = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Nama sudah terdaftar.";
    } else {
        // Insert data user baru
        $insert_query = "INSERT INTO users (nama, password, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sss", $nama, $password, $role);
        $stmt->execute();
        $_SESSION['message'] = "Pendaftaran berhasil. Silakan login.";
        header("Location: login.php");
        exit();
    }
}
?>

<section class="section">
    <div class="columns is-centered">
        <div class="column is-4">
            <h1 class="title has-text-centered">Register</h1>
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
                    <button class="button is-primary is-fullwidth">Register</button>
                </div>
            </form>
            <p class="has-text-centered">Sudah punya akun? <a href="login.php">Login</a></p>
        </div>
    </div>
</section>

<?php include 'templates/footer.php'; ?>
