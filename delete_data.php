<?php
include('../projekUAS_2103040136_B2/koneksi.php');

// Cek apakah parameter ID telah diterima dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan ID
    $query = mysqli_query($koneksi, "DELETE FROM db_jalan WHERE id = '$id'");

    if ($query) {
        echo "<script>alert('Data berhasil dihapus!');</script>";
        echo "<script type='text/javascript'> document.location ='display_data.php'; </script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data!');</script>";
        echo "<script type='text/javascript'> document.location ='display_data.php'; </script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan!');</script>";
    echo "<script type='text/javascript'> document.location ='display_data.php'; </script>";
}
?>