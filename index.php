<?php
@session_start();
include "+koneksi.php";
$sql_siswa = mysqli_query($db, "SELECT * FROM tb_siswa WHERE id_siswa = '$_SESSION[siswa]'") or die ($db->error);
$data = mysqli_fetch_array($sql_siswa);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learn Pajak</title>
    <link rel="stylesheet" href="style/new_assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700"> -->
    <link rel="stylesheet" href="style/new_assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="style/new_assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="style/new_assets/css/Brands.css">
    <link rel="stylesheet" href="style/new_assets/css/Features-Blue.css">
    <link rel="stylesheet" href="style/new_assets/css/Features-Clean.css">
    <link rel="stylesheet" href="style/new_assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="style/new_assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="style/new_assets/css/Header-Blue-1.css">
    <link rel="stylesheet" href="style/new_assets/css/Header-Blue.css">
    <link rel="stylesheet" href="style/new_assets/css/Pretty-Login-Form.css">
    <link rel="stylesheet" href="style/new_assets/css/Pretty-Header.css">
    <link rel="stylesheet" href="style/new_assets/css/Navigation-with-Button1.css">
    <link rel="stylesheet" href="style/new_assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="style/new_assets/css/Testimonials.css">
    <link rel="stylesheet" href="style/new_assets/css/Form-Clean.css">
    <link rel="stylesheet" href="style/assets/css/Article-List.css">
    <link rel="stylesheet" href="style/assets/css/lightbox.min.css">
    <link rel="stylesheet" href="style/assets/css/Lightbox-Gallery.css">
    <link rel="stylesheet" href="style/new_assets/css/styles.css">
</head>

<body>
    <div>
        <div class="header-blue">
            <nav class="navbar navbar-default navigation-clean-search">
                <div class="container">
                    <div class="navbar-header"><a class="navbar-brand navbar-link" href="index.php">E-Learning Pajak</a>
                        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    </div>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav">
                            <?php
                            if(isset($_SESSION['siswa'])) { ?>
                            <li><a href="#">Dashboard</a></li>
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Kelas Saya<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li <?php if(@$_GET['page'] == 'jadwal') { echo 'class="active"'; } ?> ><a href="?page=jadwal">Jadwal</a></li>
                                    <li <?php if(@$_GET['page'] == 'forum') { echo 'class="active"'; } ?> ><a href="?page=forum">Forum</a></li>
                                    <li <?php if(@$_GET['page'] == 'quiz') { echo 'class="active"'; } ?> ><a href="?page=quiz">Tugas / Ujian</a></li>
                                    <li <?php if(@$_GET['page'] == 'nilai') { echo 'class="active"'; } ?> ><a href="?page=nilai">Nilai</a></li>
                                    <li <?php if(@$_GET['page'] == 'materi') { echo 'class="active"'; } ?> ><a href="?page=materi">Materi</a></li>
                                </ul>
                            </li>
                            <?php
                            } ?>
                            <li <?php if(@$_GET['page'] == 'berita') { echo 'class="active"'; } ?> ><a href="?page=berita">Berita</a></li>
                            <li <?php if(@$_GET['page'] == 'katalog') { echo 'class="active"'; } ?> ><a href="?page=katalog">Katalog</a></li>
                        </ul>
                        <?php
                        if(isset($_SESSION['siswa'])) { ?>
                        <ul class="nav navbar-nav pull-right" id="profile-right">
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Halo, <?=$data['nama_lengkap']?><span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="?page=profile">Profil Saya</a></li>
                                    <li><a href="inc/logout.php?sesi=siswa">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                        <?php
                        } ?>
                    </div>
                </div>
            </nav>

            <?php
            if(@$_GET['page'] == '') { ?>
            <div class="container hero">
                <div class="row">
                    <?php
                    if(isset($_SESSION['siswa'])) { ?>
                    <div class="col-lg-12 col-md-12 col-md-offset-0">
                        <h1 class="main-title">Selamat Datang di E-Learning Pajak</h1>
                        <p>Mauris egestas tellus non ex condimentum, ac ullamcorper sapien dictum. Nam consequat neque quis sapien viverra convallis. In non tempus lorem. </p>
                    </div>
                    <?php
                    } else { ?>
                    <div class="col-lg-6 col-md-6 col-md-offset-0">
                        <h1 class="main-title">Selamat Datang di E-Learning Pajak</h1>
                        <p>Mauris egestas tellus non ex condimentum, ac ullamcorper sapien dictum. Nam consequat neque quis sapien viverra convallis. In non tempus lorem. </p>
                        <a href="?page=register" class="btn btn-default btn-lg action-button" type="button">Menjadi Anggota</a>
                    </div>
                    <?php
                    }
                    if(!isset($_SESSION['siswa'])) {
                        include "login.php";
                    } ?>
                </div>
            </div>
            <?php
            } ?>

        </div>
    </div>

    <?php
    if(@$_GET['page'] == '') {
        include "inc/beranda.php";
    } else if(@$_GET['page'] == 'register') {
        include "register.php";
    } else if(@$_GET['page'] == 'profile' || @$_GET['page'] == 'edit_profile') {
        include "profile.php";
    } else if(@$_GET['page'] == 'jadwal') {
        include "inc/jadwal.php";
    } else if(@$_GET['page'] == 'forum') {
        include "inc/forum/index.php";
    } else if(@$_GET['page'] == 'quiz') {
        include "inc/quiz.php";
    } else if(@$_GET['page'] == 'nilai') {
        include "inc/nilai.php";
    } else if(@$_GET['page'] == 'materi') {
        include "inc/materi.php";
    } else if(@$_GET['page'] == 'berita') {
        include "inc/berita.php";
    } else if(@$_GET['page'] == 'katalog') {
        include "inc/katalog.php";
    } ?>

    <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-push-6 item text">
                        <h3>Nama Perusahaan</h3>
                        <p>Praesent sed lobortis mi. Suspendisse vel placerat ligula. Vivamus ac sem lacus. Ut vehicula rhoncus elementum. Etiam quis tristique lectus. Aliquam in arcu eget velit pulvinar dictum vel in justo.</p>
                    </div>
                    <div class="col-md-3 col-md-pull-6 col-sm-4 item">
                        <h3>Sitemap</h3>
                        <ul>
                            <li><a href="#">Menu 1</a></li>
                            <li><a href="#">Menu 2</a></li>
                            <li><a href="#">Menu 3</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-md-pull-6 col-sm-4 item">
                        <h3>About </h3>
                        <ul>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Careers</a></li>
                        </ul>
                    </div>
                    <div class="col-md-12 col-sm-4 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a></div>
                </div>
                <p class="copyright">E-Learning Pajak© 2016</p>
            </div>
        </footer>
    </div>

    <script src="style/new_assets/js/jquery.min.js"></script>
    <script src="style/new_assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="style/assets/js/lightbox.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        if($(window).width() < 767) {
            $("#profile-right").removeClass("pull-right");
        }
        $(window).resize(function() {
            if($(window).width() < 767) {
                $("#profile-right").removeClass("pull-right");
            } else {
                $("#profile-right").addClass("pull-right");
            }
        });
    });
    </script>
</body>
</html>
