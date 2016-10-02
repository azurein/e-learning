
    <div class="form-clean">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 form-container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Materi</h2><hr>
                    </div>
                </div>
                <?php
                if(@$_GET['action'] == '') { ?>
                	<div class="row">
                	    <div class="col-md-12">
                	        <div class="panel panel-default">
                	            <div class="panel-heading">Informasi Materi Pelatihan</div>
                	            <div class="panel-body">
                	                <div class="table-responsive">
                	                    <table class="table table-striped table-bordered table-hover">
                	                        <thead>
                	                            <tr>
                	                                <th>#</th>
                	                                <th>Mata Pelajaran</th>
                                                    <th>Kelas</th>
                	                                <th>Aksi</th>
                	                            </tr>
                	                        </thead>
                	                        <tbody>
                	                        <?php
                	                        $no = 1;
                                            $condition = "";
                                            if($_GET['id'] > 0) {
                                                $condition = "AND tb_mapel_ajar.id_mapel = $_GET[id]";
                                            }
                	                        $sql_mapel = mysqli_query($db, "
                                                SELECT DISTINCT tb_mapel_ajar.id_mapel, tb_mapel.mapel, tb_kelas.nama_kelas

                                                FROM tb_jadwal_siswa

                                                JOIN tb_mapel_ajar
                                                ON tb_jadwal_siswa.id_mapel_ajar = tb_mapel_ajar.id

                                                JOIN tb_mapel
                                                ON tb_mapel_ajar.id_mapel = tb_mapel.id

                                                JOIN tb_kelas
                                                ON tb_mapel_ajar.id_kelas = tb_kelas.id_kelas

                                                WHERE tb_jadwal_siswa.id_siswa = '$_SESSION[siswa]'
                                                AND tb_mapel_ajar.status_aktif = 1
                                                ".$condition."

                                                ORDER BY tb_mapel.mapel, tb_kelas.nama_kelas ASC
                                            ") or die ($db->error);
                	                        while($data_mapel = mysqli_fetch_array($sql_mapel)) { ?>
                	                            <tr>
                	                                <td width="25px" align="center"><?php echo $no++; ?></td>
                	                                <td><?php echo $data_mapel['mapel']; ?></td>
                                                    <td><?php echo $data_mapel['nama_kelas']; ?></td>
                	                                <td width="200px" align="center">
                	                                	<a href="?page=materi&action=lihatmateri&id_mapel=<?php echo $data_mapel['id_mapel']; ?>" class="btn btn-primary btn-xs">Lihat Materi</a>
                	                                </td>
                	                            </tr>
                	                        	<?php
                	                        } ?>
                	                        </tbody>
                	                    </table>
                	                </div>
                	            </div>
                	        </div>
                	    </div>
                	</div>
                <?php
                } else if(@$_GET['action'] == 'lihatmateri') { ?>
                	<div class="row">
                	    <div class="col-md-12">
                	        <div class="panel panel-default">
                	            <div class="panel-heading">Lihat Data Materi Pelajaran &nbsp; <a onClick="window.history.back()" class="btn btn-warning btn-sm">Kembali</a></div>
                	            <div class="panel-body">
                					<div class="table-responsive">
                						<table class="table table-striped table-bordered table-hover">
                						    <thead>
                						        <tr>
                						            <th>#</th>
                						            <th>Judul Materi</th>
                						            <th>Tanggal Posting</th>
                						            <th>Pembuat</th>
                						            <th>Dilihat</th>
                						            <th>Opsi</th>
                						        </tr>
                						    </thead>
                						    <tbody id="materi">
                						    <?php
                						    $no = 1;
                                            $id_mapel = $_GET['id_mapel'];
                						    $sql_materi = mysqli_query($db, "
                                                SELECT DISTINCT
                                                id_materi,
                                                judul,
                                                tgl_posting,
                                                pembuat,
                                                hits,
                                                nama_file

                                                FROM tb_file_materi

                                                JOIN tb_mapel_ajar
                                                ON tb_file_materi.id_mapel = tb_mapel_ajar.id_mapel
                                                AND tb_file_materi.id_kelas = tb_mapel_ajar.id_kelas

                                                JOIN tb_jadwal_siswa
                                                ON tb_mapel_ajar.id = tb_jadwal_siswa.id_mapel_ajar

                                                WHERE id_siswa = '$_SESSION[siswa]'
                                                AND tb_mapel_ajar.id_mapel = '$id_mapel'
                                            ") or die ($db->error);
                                            if($_GET['id_tq']) {
                                                $sql_materi = mysqli_query($db, "
                                                    SELECT DISTINCT
                                                    tb_file_materi.id_materi,
                                                    tb_file_materi.judul,
                                                    tgl_posting,
                                                    tb_file_materi.pembuat,
                                                    hits,
                                                    nama_file

                                                    FROM tb_file_materi

                                                    JOIN tb_mapel_ajar
                                                    ON tb_file_materi.id_mapel = tb_mapel_ajar.id_mapel
                                                    AND tb_file_materi.id_kelas = tb_mapel_ajar.id_kelas

                                                    JOIN tb_jadwal_siswa
                                                    ON tb_mapel_ajar.id = tb_jadwal_siswa.id_mapel_ajar

                                                    JOIN tb_topik_quiz
                                                    ON tb_mapel_ajar.id_mapel = tb_topik_quiz.id_mapel
                                                    AND tb_mapel_ajar.id_kelas = tb_topik_quiz.id_kelas

                                                    JOIN tb_quiz_materi
                                                    ON tb_topik_quiz.id_tq = tb_quiz_materi.id_tq
                                                    AND tb_file_materi.id_materi = tb_quiz_materi.id_materi

                                                    WHERE id_siswa = '$_SESSION[siswa]'
                                                    AND tb_topik_quiz.id_tq = '$_GET[id_tq]'
                                                ") or die ($db->error);
                                            }
                						    while($data_materi = mysqli_fetch_array($sql_materi)) { ?>
                						        <tr>
                						            <td width="25px" align="center"><?php echo $no++; ?></td>
                						            <td id="judul"><?php echo $data_materi['judul']; ?></td>
                						            <td><?php echo $data_materi['tgl_posting']; ?></td>
                						            <td>
                						            	<?php
                										if($data_materi['pembuat'] == 'admin') {
                											echo "Admin";
                										} else {
                											$sql_pengajar = mysqli_query($db, "SELECT * FROM tb_pengajar WHERE id_pengajar = '$data_materi[pembuat]'") or die($db->error);
                											$data_pengajar = mysqli_fetch_array($sql_pengajar);
                											echo $data_pengajar['nama_lengkap'];
                										} ?>
                						            </td>
                						            <td><?php echo $data_materi['hits']." kali"; ?></td>
                						            <td align="center">
                						            	<a href="./admin/file_materi/<?php echo $data_materi['nama_file']; ?>" target="_blank" id="klik" isi="<?php echo $data_materi['id_materi']; ?>" class="btn btn-primary btn-xs">Lihat / Download</a>
                						            </td>
                						        </tr>
                						    	<?php
                						    } ?>
                						    </tbody>
                						</table>
                					</div>
                                    <script type="text/javascript">
                                    $("#materi").on("click", "#klik", function() {
                                    	var id = $(this).attr("isi");
                						$.ajax({
                							url : 'inc/prosesklik.php',
                							type : 'POST',
                							data : 'id='+id,
                							success : function(msg) {}
                						});
                                    });
                                    </script>
                				</div>
                			</div>
                		</div>
                	</div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
