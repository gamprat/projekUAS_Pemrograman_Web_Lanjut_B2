<?php
    include ('../projekUAS_2103040136_B2/koneksi.php');
    function logout() {
    // Hapus semua data sesi
    session_start();
    if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
    }

    $username = $_SESSION['user'];

    session_unset();
    session_destroy();

    // Redirect ke halaman login
    header("Location: login.php");
    exit();
    }

    // Memeriksa apakah pengguna mengklik tombol logout
    if (isset($_GET['logout'])) {
        logout();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemetaan dan Pelaporan Jalan Rusak di Kabupaten Pemalang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style type="text/css">
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        header {
            width: 100%;
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.5)), url("../projekUAS_2103040136_B2/img/ump.jpg");
            background-size: cover;
        }
        nav {
            width: 100%;
            height: 100px;
            color: white;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .logo {
            font-size: 2em;
            letter-spacing: 2px;
        }
        .menu a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            font-size: 20px;
            position: relative;
        }
        .menu a::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            border-bottom: 2px solid red;
            transition: 0.2s linear;
        }
        .menu a:hover:before {
            width: 90%;
        }
        .menu a:active:before {
            width: 90%;
        }
        .user {
            width: 40px;
            border-radius: 50%;
            cursor: pointer;
            filter: brightness(0) invert(1) grayscale(1);
        }
        .judul {
            max-width: 650px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }
        .judul span {
            letter-spacing: 5px;
        }
        .judul h1 {
            font-size: 35px;
        }
        .sub-menu-wrap {
            position: absolute;
            top: 15%;
            right: 10%;
            width: 320px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s;
        }
        .sub-menu-wrap.open-menu {
            max-height: 400px;
        }
        .sub-menu {
            background: #fff;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .user-info h2 {
            font-weight: 500;
            color: black;
        }
        .user-info img {
            width: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }
        .sub-menu hr {
            border: 0;
            height: 2px;
            width: 100%;
            background: #ccc;
            margin: 15px 0 10px;
        }
        .sub-menu-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #525252;
            margin: 12px 0;
        }
        .sub-menu-link:hover{
            background: red;
            border-radius: 10px;
        }
        .sub-menu-link img {
            width: 35px;
            padding: 8px;
            margin-right: 15px;
            margin-left: 15px;
            transition: transform 0.5s;
        }
        .sub-menu-link p {
            width: 100%;
            vertical-align: center;
            margin-top: 15px;
            transition: transform 0.5s;
        }
        .sub-menu-link span {
            font-size: 22px;
            transition: transform 0.5s;
            margin-right: 10px;
        }
        .sub-menu-link:hover span {
            transform: translateX(5px);
            color: white;
        }
        .sub-menu-link:hover p {
            font-weight: 600;
            color: white;
            transform: translateX(5px);
        }
        .sub-menu-link:hover img {
            transform: translateX(5px);
            filter: brightness(0) invert(1);
        }
    </style>
</head>
<body>
    <header>
        <nav id="home">
            <div class="logo">
                Gam Website
            </div>
            <div class="menu">
                <a href="#home">Home</a>
                <a href="#data">Data</a>
            </div>
            <img src="img/user.png" class="user" onclick="toggleMenu()">
            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="img/user.png">
                        <h2><?php echo $user; ?></h2>
                    </div>
                    <hr>
                    <a href="?logout=true" class="sub-menu-link">
                        <img src="img/logout.png">
                        <p>Logout</p>
                        <span>></span>
                    </a>
                </div>
            </div>
        </nav>
        <div class="judul">
            <span>Sistem Informasi Geografis</span>
            <h1>Pemetaan dan Pelaporan Jalan Rusak</h1>
            <h1>Kabupaten Pemalang</h1>
        </div>
    </header>
    
    <section id="data">
        <div class="container">
        <div class="card mt-5">
            <div class="card-header bg-secondary text-white">
                Data Kerusakan Jalan
            </div>
            <div class="card-body">

            <!-- Tombol Modal untuk Menambah Data -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahData">
                Tambah Data
            </button>

                <table class="table table-bordered table-striped table-hover table-fixed">
                    <thead>
                    <tr style="text-align: center; vertical-align: middle">
                        <th>Nomor</th>
                        <th>Judul Laporan</th>
                        <th>Lokasi Kerusakan</th>
                        <th>Jenis Kerusakan</th>
                        <th>Informasi Tambahan</th>
                        <th>Foto Pendukung</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php
                            //Menampilkan Data
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * FROM db_jalan ORDER BY id DESC");
                            while ($row = mysqli_fetch_array($tampil)) :
                
                        ?>

                        <tr>
                            <td style="text-align: center"><?= $no++ ?></td>
                            <td><?= $row['judul_laporan'] ?></td>
                            <td style="text-align: center"><iframe
                                width="300"
                                height="200"
                                frameborder="0"
                                style="border:0"
                                src="https://maps.google.com/maps?q=<?= $row['lokasi_kerusakan'] ?>&amp;output=embed"
                                allowfullscreen
                            ></iframe></td>
                            <td style="text-align: center"><?= $row['jenis_kerusakan'] ?></td>
                            <td style="text-align: center"><?= $row['informasi_tambahan'] ?></td>
                            <td><img style="margin: 0 auto; margin: 50px;" src="image/<?php echo $row['foto_pendukung'];?>" width = "150px"></td>
                            <td style="text-align: center; vertical-align: middle">
                                <a href='update_data.php?id=<?php echo $row["id"]; ?>' class="btn btn-warning mt-2">Ubah</a>
                                <a href='delete_data.php?id=<?php echo $row["id"]; ?>' class="btn btn-danger mt-2" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                <a href='https://www.lapor.go.id/' target="_blank" class="btn btn-secondary mt-2">Lapor</a>
                            </td>
                        </tr>                  
                    </tbody>
                    <?php endwhile ?>
                </table>

                <!-- Modal Form Pengisian Data -->
                <div class="modal fade" id="modalTambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Masukkan Data Baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container" >
                            <form action="insert_data.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Judul Laporan</label>
                                <input type="text" class="form-control" name="judul_laporan" id="judul_laporan"
                                placeholder="Masukkan judul">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lokasi Kerusakan</label>
                                <input type="text" class="form-control" name="lokasi_kerusakan" id="lokasi_kerusakan"
                                placeholder="Masukkan lokasi secara detail (lihat Google Maps)">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Kerusakan</label>
                                <select class="form-select" name="jenis_kerusakan" id="jenis_kerusakan">
                                    <option>Pilih salah satu</option>
                                    <option value="ringan">Ringan</option>
                                    <option value="sedang">Sedang</option>
                                    <option value="parah">Parah</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Informasi Tambahan</label>
                                <textarea class="form-control" rows="3" name="informasi_tambahan" id="informasi_tambahan"></textarea>
                                </div>                      
                            <div class="mb-3">
                                <label class="form-label">Foto Pendukung</label> <br>
                                <input type="file" name="gambar" id="" accept=".jpg, .jpeg, .png" value="">
                            </div>  
                            <div class="d-flex justify-content-end mb-2 m-3">
                                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
    let nav = document.querySelector('nav');
    let menuLinks = document.querySelectorAll('.menu a');

    menuLinks.forEach((link) => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            let target = this.getAttribute('href');

            // Scroll ke target dengan efek smooth
            document.querySelector(target).scrollIntoView({
                behavior: 'smooth'
            });

            // Tambahkan class "active" ke link yang diklik
            menuLinks.forEach((menuLink) => {
                menuLink.classList.remove('active');
            });
            this.classList.add('active');

            // Pindahkan navigasi ke posisi yang sesuai
            let navHeight = nav.offsetHeight;
            let targetOffsetTop = document.querySelector(target).offsetTop;
            window.scrollTo({
                top: targetOffsetTop - navHeight,
                behavior: 'smooth'
            });
        });
    });
    </script>

    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu(){
            subMenu.classList.toggle("open-menu");
        }
    </script>
</body>
</html>