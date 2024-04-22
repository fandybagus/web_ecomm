<?php 
require_once('../config/koneksidb.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai yang dimasukkan pengguna
    $email = $_POST['logusername'];
    $password = $_POST['logpassword'];

    // Melakukan escape terhadap input untuk mencegah SQL Injection
    $email = mysqli_real_escape_string($cn_mysql, $email);
    $password = mysqli_real_escape_string($cn_mysql, $password);

    // Query untuk memeriksa apakah email dan password cocok
    $sql = "SELECT * FROM mst_member WHERE email_mb='$email' AND password='$password' AND isactive = 1";
    $result = $cn_mysql->query($sql);

    if ($result->num_rows > 0) {
        // Jika ada hasil, login berhasil
        $row = $result->fetch_assoc();

        // Memulai sesi
        session_start();

        // Mengatur session data
        $_SESSION['nama_member'] = $row['name_mb'];
        $_SESSION['kode_member'] = $row['membercode'];
        $_SESSION['email'] = $row['email_mb'];

        // Mengarahkan ke halaman home.php pada folder member
        header("Location: home.php");
        exit();
    } else {
        // Jika tidak ada hasil, login gagal
        echo '<script>alert("Email atau password salah atau akun tidak aktif!");</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    }
}
?>