<?php
$sql_kelas = mysqli_query($db, "
    SELECT DISTINCT
    tb_mapel_ajar.id as id_mapel_ajar,
    tb_mapel.id as id_mapel,
    tb_mapel.mapel,
    tb_mapel_ajar.keterangan,
    tb_mapel_ajar.tgl_mulai,
    tb_mapel_ajar.tgl_selesai

    FROM tb_mapel_ajar

    JOIN tb_mapel
    ON tb_mapel_ajar.id_mapel = tb_mapel.id

    WHERE tb_mapel_ajar.status_aktif = 1
    AND tb_mapel_ajar.id IN (
        SELECT id_mapel_ajar FROM tb_jadwal_siswa WHERE id_siswa = '$_SESSION[siswa]'
    )
") or die ($db->error);
if(mysqli_num_rows($sql_kelas) > 0 && $_SESSION['siswa']) {
?>
<div class="features-clean">
    <div class="container">
        <div class="intro">
            <div class="intro">
                <h2 class="text-center">Kelas yang sedang Anda jalani</h2>
                <p class="text-center">Our customers love us! Read what they have to say below. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae.</p>
            </div>
        </div>
        <div class="row features">
            <?php
            while($data_kelas = mysqli_fetch_array($sql_kelas)) { ?>
            <div class="col-md-6 col-sm-6 item"><i class="fa fa-pencil-square-o"></i>
                <h3 class="name"><?=$data_kelas['mapel']?> <small> <?=tgl_indo($data_kelas['tgl_mulai'])?> - <?=tgl_indo($data_kelas['tgl_selesai'])?></small></h3>
                <p class="description"><?=$data_kelas['keterangan']?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <h4>Buku</h4>
                            <ul>
                                <?php
                                $sql_buku = mysqli_query($db, "
                                    SELECT * FROM tb_buku
                                    WHERE id_mapel_ajar = '$data_kelas[id_mapel_ajar]'
                                    ORDER BY judul ASC
                                ") or die ($db->error);

                                while($data_buku = mysqli_fetch_array($sql_buku)) { ?>
                                    <li><a href="./admin/file_buku/<?=$data_buku['file_buku']?>" target="_blank">
                                        <?php echo $data_buku['penulis'].'. '.$data_buku['tahun'].'. '.$data_buku['judul'].'. '.$data_buku['penerbit'].'. '.$data_buku['kutip_hal']; ?>
                                        <br>ISBN: <?=$data_buku['ISBN']?>
                                    </a></li>
                                <?php
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <h4>Tujuan Pembelajaran</h4>
                            <ul>
                                <?php
                                $sql_tujuan_ajar = mysqli_query($db, "
                                    SELECT DISTINCT tujuan_ajar, prioritas
                                    FROM tb_tujuan_ajar
                                    WHERE id_mapel_ajar = '$data_kelas[id_mapel_ajar]'
                                    ORDER BY prioritas ASC
                                ") or die ($db->error);

                                while($data_tujuan_ajar = mysqli_fetch_array($sql_tujuan_ajar)) { ?>
                                    <li><?=$data_tujuan_ajar['tujuan_ajar']?></li>
                                <?php
                                } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <h4>Sertifikasi</h4>
                            <ul>
                                <?php
                                $sql_sertifikasi = mysqli_query($db, "
                                    SELECT DISTINCT nama_sertifikasi, deskripsi_sertifikasi
                                    FROM tb_sertifikasi
                                    WHERE id_mapel_ajar = '$data_kelas[id_mapel_ajar]'
                                    ORDER BY nama_sertifikasi ASC
                                ") or die ($db->error);

                                while($data_sertifikasi = mysqli_fetch_array($sql_sertifikasi)) { ?>
                                    <li><?=$data_sertifikasi['nama_sertifikasi']?></li>
                                <?php
                                } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                    <a href="?page=jadwal&id=<?=$data_kelas['id_mapel']?>" target="_blank" class="btn btn-primary" type="button">Jadwal</a>
                                    <a href="?page=forum" target="_blank" class="btn btn-success" type="button">Forum</a>
                                    <a href="?page=quiz&id=<?=$data_kelas['id_mapel']?>" target="_blank" class="btn btn-info" type="button">Tugas / Quiz</a>
                                    <a href="?page=nilai&id=<?=$data_kelas['id_mapel']?>" target="_blank" class="btn btn-warning" type="button">Nilai</a>
                                    <a href="?page=materi&id=<?=$data_kelas['id_mapel']?>" target="_blank" class="btn btn-danger" type="button">Materi</a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <?php
            } ?>
        </div>
    </div>
</div>
<?
} ?>
<div class="features-clean">
    <div class="container">
        <div class="intro">
            <div class="intro">
                <h2 class="text-center">Mari daftar kelas pajak online!</h2>
                <p class="text-center">Our customers love us! Read what they have to say below. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae.</p>
            </div>
        </div>
        <div class="row features">
            <?php
            $sql_kelas = mysqli_query($db, "
                SELECT DISTINCT
                tb_mapel_ajar.id as id_mapel_ajar,
                tb_mapel.mapel,
                tb_mapel_ajar.keterangan,
                tb_mapel_ajar.tgl_mulai,
                tb_mapel_ajar.tgl_selesai

                FROM tb_mapel_ajar

                JOIN tb_mapel
                ON tb_mapel_ajar.id_mapel = tb_mapel.id

                WHERE tb_mapel_ajar.status_aktif = 1
                AND tb_mapel_ajar.id NOT IN (
                    SELECT id_mapel_ajar FROM tb_jadwal_siswa WHERE id_siswa = '$_SESSION[siswa]'
                )
            ") or die ($db->error);

            while($data_kelas = mysqli_fetch_array($sql_kelas)) { ?>
                <div class="col-md-6 col-sm-6 item"><i class="glyphicon glyphicon-education icon"></i>
                    <h3 class="name"><?=$data_kelas['mapel']?> <small> <?=tgl_indo($data_kelas['tgl_mulai'])?> - <?=tgl_indo($data_kelas['tgl_selesai'])?></small></h3>
                    <p class="description"><?=$data_kelas['keterangan']?>
                    <div class="form-group">
                        <h4>Tujuan Pembelajaran</h4>
                        <ul>
                            <?php
                            $sql_tujuan_ajar = mysqli_query($db, "
                                SELECT DISTINCT tujuan_ajar, prioritas
                                FROM tb_tujuan_ajar
                                WHERE id_mapel_ajar = '$data_kelas[id_mapel_ajar]'
                                ORDER BY prioritas ASC
                            ") or die ($db->error);

                            while($data_tujuan_ajar = mysqli_fetch_array($sql_tujuan_ajar)) { ?>
                                <li><?=$data_tujuan_ajar['tujuan_ajar']?></li>
                            <?php
                            } ?>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <h4>Sertifikasi </h4>
                                <ul>
                                    <?php
                                    $sql_sertifikasi = mysqli_query($db, "
                                        SELECT DISTINCT nama_sertifikasi, deskripsi_sertifikasi
                                        FROM tb_sertifikasi
                                        WHERE id_mapel_ajar = '$data_kelas[id_mapel_ajar]'
                                        ORDER BY nama_sertifikasi ASC
                                    ") or die ($db->error);

                                    while($data_sertifikasi = mysqli_fetch_array($sql_sertifikasi)) { ?>
                                        <li><?=$data_sertifikasi['nama_sertifikasi']?></li>
                                    <?php
                                    } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group enroll-button">
                                <button class="btn btn-success enroll-button" type="button">Daftar Sekarang</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            <?php
            } ?>
        </div>
    </div>
</div>
<div class="testimonials-clean">
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Apa kata mereka?</h2>
            <p class="text-center">Our customers love us! Read what they have to say below. Aliquam sed justo ligula. Vestibulum nibh erat, pellentesque ut laoreet vitae.</p>
        </div>
        <div class="row people">
            <div class="col-md-4 col-sm-6 item">
                <div class="box">
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est.</p>
                </div>
                <div class="author"><img class="img-circle" src="style/new_assets/img/1.jpg">
                    <h5 class="name">Ben Johnson</h5>
                    <p class="title">Student of Best University</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 item">
                <div class="box">
                    <p class="description">Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo suscipit id.</p>
                </div>
                <div class="author"><img class="img-circle" src="style/new_assets/img/3.jpg">
                    <h5 class="name">Carl Kent</h5>
                    <p class="title">Tax Consultant</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 item">
                <div class="box">
                    <p class="description">Aliquam varius finibus est, et interdum justo suscipit. Vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p>
                </div>
                <div class="author"><img class="img-circle" src="style/new_assets/img/2.jpg">
                    <h5 class="name">Emily Clark</h5>
                    <p class="title">Owner of PT. Creative</p>
                </div>
            </div>
        </div>
    </div>
</div>
