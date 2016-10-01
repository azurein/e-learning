
    <div class="form-clean">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 form-container">
                <h2>Katalog</h2><hr>
                <div class="panel panel-default">
                    <div class="panel-heading">Penawaran Produk Kami</div>
                    <div class="panel-body">
                        <div class="article-list">
                            <?php
                            $sql_katalog = mysqli_query($db, "SELECT * FROM tb_katalog") or die ($db->error);
                            while($data_katalog = mysqli_fetch_array($sql_katalog)) { ?>
                            <div class="col-md-4 col-sm-6 item">
                                <?php
                                if($data_katalog['jenis'] == 'Gambar') { ?>
                                    <img class="img-responsive img-katalog" src="./admin/file_katalog/<?php echo $data_katalog['nama_file']; ?>">
                                    <?php
                                } else { ?>
                                    <img class="img-responsive img-katalog" src="./admin/img/default-katalog.png">
                                    <?php
                                } ?>
                                <h3 class="name"><?php echo $data_katalog['judul']; ?></h3>
                                <label>Rp <?php echo $data_katalog['harga']; ?></label>
                                <hr>
                            </div>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
