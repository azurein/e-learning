
    <div class="form-clean">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 form-container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Halaman Berita / Info</h2><hr>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="notice-board">
                            <ul class="list-group">
                                <li class="list-group-item" style="color: #333333; background: #f5f5f5"><span>Daftar Berita (klik judul untuk membaca isi)</span></li>
                                <?php
                                $sql_berita = mysqli_query($db, "SELECT * FROM tb_berita WHERE status = 'aktif' ORDER BY tgl_posting DESC LIMIT 0, 4") or die($db->error);
                                while($data_berita = mysqli_fetch_array($sql_berita)) { ?>
                                    <li class="list-group-item"><span>
                                        <i class="fa fa-newspaper-o"></i> &nbsp;
                                        <a href="?page=berita&action=detail&id_berita=<?php echo $data_berita['id_berita']; ?>">
                                            <span><?=$data_berita['judul']; ?></span>
                                        </a>
                                    </span></li>
                                    <?php
                                } ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                    if(@$_GET['action'] == 'detail') { ?>
                    <div class="col-md-7">
                        <div class="notice-board">
                            <div class="panel panel-default">
                                <div class="panel-heading">Detail Berita</div>
                                <div class="panel-body">
                                    <?php
                                    $sql_berita_detail = mysqli_query($db, "SELECT * FROM tb_berita WHERE id_berita = '$_GET[id_berita]'") or die($db->error);
                                    $data_berita_detail = mysqli_fetch_array($sql_berita_detail);
                                    ?>
                                    <h3 align="center"><?php echo $data_berita_detail['judul']; ?></h3>
                                    By : <span class="label label-warning">
                                        <?php
                                        if($data_berita_detail['penerbit'] == 'admin') {
                                            echo "Admin";
                                        } else {
                                            $sql_pengajar = mysqli_query($db, "SELECT * FROM tb_pengajar WHERE id_pengajar = '$data_berita_detail[penerbit]'") or die($db->error);
                                            $data_pengajar = mysqli_fetch_array($sql_pengajar);
                                            echo $data_pengajar['nama_lengkap'];
                                        } ?>
                                    </span> &nbsp;
                                    <span class="label label-info"><?php echo tgl_indo($data_berita_detail['tgl_posting']); ?></span>
                                    <hr />
                                    <div>
                                        <?php echo nl2br($data_berita_detail['isi']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>
