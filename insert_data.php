<?php
  include ('../projekUAS_2103040136_B2/koneksi.php');

  $judul_laporan = $_POST["judul_laporan"];
  $lokasi_kerusakan = $_POST["lokasi_kerusakan"];
  $jenis_kerusakan = $_POST["jenis_kerusakan"];
  $informasi_tambahan = $_POST["informasi_tambahan"];
  $gambar=$_FILES["gambar"]["name"];
  
   if (empty($judul_laporan) || empty($lokasi_kerusakan) || empty($jenis_kerusakan) || empty($informasi_tambahan) || empty($gambar)) {
    echo "<script>alert('Mohon lengkapi semua data!');</script>";
    echo "<script type='text/javascript'> document.location ='display_data.php'; </script>";
  } else {
    // get the image extension
    $extension = substr($gambar, strlen($gambar) - 4, strlen($gambar));
    // allowed extensions
    $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");
    // Validation for allowed extensions .in_array() function searches an array for a specific value.
    if (!in_array($extension, $allowed_extensions)) {
        echo "<script>alert('Format gambar tidak valid!');</script>";
        echo "<script type='text/javascript'> document.location ='display_data.php'; </script>";
    } else {
        // rename the image file
        $imgnewfile = md5($gambar) . time() . $extension;
        // Code for move image into directory
        move_uploaded_file($_FILES["gambar"]["tmp_name"], "image/" . $imgnewfile);
        // Query for data insertion
        $query = mysqli_query($koneksi, "INSERT INTO db_jalan(judul_laporan, lokasi_kerusakan, jenis_kerusakan, informasi_tambahan, foto_pendukung) 
        VALUE ('$judul_laporan','$lokasi_kerusakan', '$jenis_kerusakan', '$informasi_tambahan', '$imgnewfile')");

        if ($query) {
            echo "<script>alert('Data berhasil ditambahkan!');</script>";
            echo "<script type='text/javascript'> document.location ='display_data.php'; </script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menambahkan data!');</script>";
            echo "<script type='text/javascript'> document.location ='display_data.php'; </script>";
        }
    }
}
?>