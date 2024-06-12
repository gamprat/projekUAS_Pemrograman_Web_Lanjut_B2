<?php
// Mengambil data dari form login
$username = $_POST["user"];
$password = $_POST["pass"];

// Koneksi ke database
$servername = "localhost"; // Ubah sesuai dengan server database Anda
$dbusername = "2103040136"; // Ubah sesuai dengan username database Anda
$dbpassword = "2103040136"; // Ubah sesuai dengan password database Anda
$dbname = "db_2103040136"; // Ubah sesuai dengan nama database Anda

$koneksi = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Memeriksa koneksi database
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Mengecek kecocokan username dan password dalam database
$sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    // Jika kecocokan ditemukan, login berhasil
    // Redirect ke halaman lain
    header("Location: display_data.php");
    exit();
} else {
    // Jika tidak ada kecocokan, tampilkan pesan kesalahan menggunakan SweetAlert2
    echo '<script>
                window.onload = function() {
                    Swal.fire({
                        icon: "error",
                        title: "Login Gagal",
                        text: "Username atau password salah!",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(function() {
                        window.location.href = "login.php";
                    });
                };
              </script>';
}

// Menutup koneksi database
$koneksi->close();
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>