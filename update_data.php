<?php
include('../projekUAS_2103040136_B2/koneksi.php');

// Cek apakah parameter ID telah diterima dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data berdasarkan ID
    $query = mysqli_query($koneksi, "SELECT * FROM db_jalan WHERE id = '$id'");
    $data = mysqli_fetch_assoc($query);

    // Cek apakah data ditemukan
    if ($data) {
        // Proses pembaruan data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul_laporan = $_POST["judul_laporan"];
            $lokasi_kerusakan = $_POST["lokasi_kerusakan"];
            $jenis_kerusakan = $_POST["jenis_kerusakan"];
            $informasi_tambahan = $_POST["informasi_tambahan"];

            // Proses pembaruan gambar jika ada file yang diunggah
            if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $gambar = $_FILES["gambar"]["name"];
                $extension = substr($gambar, strlen($gambar) - 4, strlen($gambar));
                $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");

                // Validasi ekstensi gambar
                if (in_array($extension, $allowed_extensions)) {
                    $imgnewfile = md5($gambar) . time() . $extension;
                    move_uploaded_file($_FILES["gambar"]["tmp_name"], "image/" . $imgnewfile);
                    $gambar_pendukung = $imgnewfile;

                    // Update data dengan pembaruan gambar
                    $query_update = mysqli_query($koneksi, "UPDATE db_jalan SET judul_laporan = '$judul_laporan', lokasi_kerusakan = '$lokasi_kerusakan', jenis_kerusakan = '$jenis_kerusakan', informasi_tambahan = '$informasi_tambahan', foto_pendukung = '$gambar_pendukung' WHERE id = '$id'");
                    if ($query_update) {
                        echo "<script>alert('Data berhasil diperbarui!');</script>";
                        echo "<script type='text/javascript'> document.location ='display_data.php'; </script>";
                    } else {
                        echo "<script>alert('Terjadi kesalahan saat memperbarui data!');</script>";
                    }
                } else {
                    echo "<script>alert('Format gambar tidak valid!');</script>";
                }
            } else {
                // Update data tanpa pembaruan gambar
                $query_update = mysqli_query($koneksi, "UPDATE db_jalan SET judul_laporan = '$judul_laporan', lokasi_kerusakan = '$lokasi_kerusakan', jenis_kerusakan = '$jenis_kerusakan', informasi_tambahan = '$informasi_tambahan' WHERE id = '$id'");
                if ($query_update) {
                    echo "<script>alert('Data berhasil diperbarui!');</script>";
                    echo "<script type='text/javascript'> document.location ='display_data.php'; </script>";
                } else {
                    echo "<script>alert('Terjadi kesalahan saat memperbarui data!');</script>";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Kerusakan Jalan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <!-- Form untuk memperbarui data -->
        <!-- Form untuk memperbarui data -->
<div class="mt-3">
    <h3 class="text-center">Ubah Data Laporan Kerusakan Jalan</h3>
</div>

<div class="container">
    <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Judul Laporan</label>
            <input type="text" class="form-control" name="judul_laporan" placeholder="Masukkan judul"
                value="<?php echo $data['judul_laporan']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Lokasi Kerusakan</label>
            <input type="text" class="form-control" name="lokasi_kerusakan"
                placeholder="Masukkan lokasi secara detail" value="<?php echo $data['lokasi_kerusakan']; ?>"
                required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Kerusakan</label>
            <select class="form-select" name="jenis_kerusakan" value="<?php echo $data['jenis_kerusakan']; ?>"
                required>
                <option>Pilih salah satu</option>
                <option value="ringan">Ringan</option>
                <option value="sedang">Sedang</option>
                <option value="parah">Parah</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Informasi Tambahan</label>
            <textarea class="form-control" rows="3" name="informasi_tambahan"
                required><?php echo $data['informasi_tambahan']; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto Pendukung</label> <br>
            <input type="file" name="gambar" id="" accept=".jpg, .jpeg, .png" value="">
        </div>
        <div class="d-flex justify-content-end mb-5">
            <a href="display_data.php" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html> 