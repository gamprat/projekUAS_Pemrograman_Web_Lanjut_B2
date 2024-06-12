<!-- signup.php -->
<?php

include ('../projekUAS_2103040136_B2/koneksi.php');

// Memeriksa apakah form sign up sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["user"];
    $password = $_POST["pass"];

    // Menyimpan data ke database
    $sql = "INSERT INTO login (username, password) VALUES ('$username', '$password')";
    if ($koneksi->query($sql) === true) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }

    // Menutup koneksi database
    $koneksi->close();
}
?>
