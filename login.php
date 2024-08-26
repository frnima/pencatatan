<?php
session_start();
include 'koneksi.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];

    // Mencari user berdasarkan email atau username
    $sql = "SELECT * FROM users WHERE username = '$username_or_email' OR email = '$username_or_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Simpan informasi user dalam session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: index.php");
            exit;
        } else {
            $message = "Password salah.";
        }
    } else {
        $message = "Username atau email tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginpage.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <h2>Login</h2>
            <?php if ($message): ?>
                <p id="message"><?= $message ?></p>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="input-group">
                    <label for="username_or_email"><i class="fas fa-user"></i> Username atau Email</label>
                    <input type="text" id="username_or_email" name="username_or_email" required>
                </div>
                <div class="input-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-btn"><i class="fas fa-sign-in-alt"></i> Login</button>
            </form>
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>
