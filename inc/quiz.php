
<div class="form-clean">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 form-container">
            <div class="row">
                <div class="col-md-12">
                <h2>Tugas / Ujian</h2><hr>
                </div>
            </div>

    <?php
    $id = @$_GET['id'];
    $no = 1;

    if(@$_GET['action'] == '') { ?>

    	<div class="row">
    	    <div class="col-md-12">
    	        <div class="panel panel-default">
    	            <div class="panel-heading">Data Tugas / Ujian Setiap Mata Pelajaran</div>
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
    	                        $sql_mapel = mysqli_query($db, "
                                    SELECT DISTINCT
                                    tb_mapel_ajar.id_mapel,
                                    tb_mapel_ajar.id_kelas,
                                    tb_mapel.mapel,
                                    tb_kelas.nama_kelas

                                    FROM tb_jadwal_siswa

                                    JOIN tb_mapel_ajar
                                    ON tb_jadwal_siswa.id_mapel_ajar = tb_mapel_ajar.id

                                    JOIN tb_mapel
                                    ON tb_mapel_ajar.id_mapel = tb_mapel.id

                                    JOIN tb_kelas
                                    ON tb_mapel_ajar.id_kelas = tb_kelas.id_kelas

                                    WHERE tb_jadwal_siswa.id_siswa = '$_SESSION[siswa]'
                                    AND tb_mapel_ajar.status_aktif = 1
                                ") or die ($db->error);
    	                        while($data_mapel = mysqli_fetch_array($sql_mapel)) { ?>
    	                            <tr>
    	                                <td width="25px" align="center"><?php echo $no++; ?></td>
    	                                <td><?php echo $data_mapel['mapel']; ?></td>
                                        <td><?php echo $data_mapel['nama_kelas']; ?></td>
    	                                <td width="200px" align="center">
    	                                	<a href="?page=quiz&action=daftartopik&id_mapel=<?php echo $data_mapel['id_mapel']; ?>&id_kelas=<?php echo $data_mapel['id_kelas']; ?>" class="btn btn-primary btn-xs">Lihat Ujian</a>
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
    } else if(@$_GET['action'] == 'daftartopik') { ?>
    	<div class="row">
    	    <div class="col-md-12">
    	        <div class="panel panel-default">
    	            <div class="panel-heading">Data Tugas / Ujian Setiap Mata Pelajaran &nbsp; <a onClick="window.history.back()" class="btn btn-warning btn-sm">Kembali</a></div>
    	            <div class="panel-body">
    					<div class="table-responsive">
    					<?php
    					$id_mapel = @$_GET['id_mapel'];
                        $id_kelas = @$_GET['id_kelas'];
    					$sql_tq = mysqli_query($db, "SELECT * FROM tb_topik_quiz WHERE id_mapel = '$id_mapel' AND id_kelas = '$id_kelas' AND status = 'aktif'") or die ($db->error);
    					if(mysqli_num_rows($sql_tq) > 0) {
    						while($data_tq = mysqli_fetch_array($sql_tq)) { ?>
    						<table width="100%">
    							<tr>
    								<td valign="top">No. ( <?php echo $no++; ?> )</td>
    								<td>
    									<table class="table">
    									    <thead>
    									        <tr>
    									            <td width="20%"><b>Judul</b></td>
    									            <td>:</td>
    									            <td width="65%"><?php echo $data_tq['judul']; ?></td>
    									        </tr>
    									    </thead>
    									    <tbody>
    									        <tr>
    									            <td>Tanggal Pembuatan</td>
    									            <td>:</td>
    									            <td><?php echo tgl_indo($data_tq['tgl_buat']); ?></td>
    									        </tr>
    									        <tr>
    									            <td>Pembuat</td>
    									            <td>:</td>
    									            <td>
    									            	<?php
    									            	if($data_tq['pembuat'] != 'admin') {
    									            		$sql_peng = mysqli_query($db, "SELECT * FROM tb_pengajar WHERE id_pengajar = '$data_tq[pembuat]'") or die ($db->error);
    									            		$data_peng = mysqli_fetch_array($sql_peng);
    									            		echo $data_peng['nama_lengkap'];
    									            	} else {
    									            		echo $data_tq['pembuat'];
    									            	} ?>
    									            </td>
    									        </tr>
    									        <tr>
    									            <td>Waktu Pengerjaan</td>
    									            <td>:</td>
    									            <td><?php echo $data_tq['waktu_soal'] / 60 ." menit"; ?></td>
    									        </tr>
    									        <tr>
    									            <td>Info</td>
    									            <td>:</td>
    									            <td><?php echo $data_tq['info']; ?></td>
    									        </tr>
    									        <tr>
    									        	<td></td>
    									        	<td></td>
    									        	<td>
    									        		<a href="?page=quiz&action=infokerjakan&id_tq=<?php echo $data_tq['id_tq']; ?>" class="btn btn-primary btn-xs">Kerjakan Soal</a>
                                                        <a href="?page=materi&action=lihatmateri&id_tq=<?php echo $data_tq['id_tq']; ?>" class="btn btn-info btn-xs">Lihat Materi</a>
    									        	</td>
    									        </tr>
    									    </tbody>
    									</table>
    								</td>
    							</tr>
    						</table>
    						<?php
    						}
    					} else { ?>
    						<div class="alert alert-danger">Tidak ada Tugas / Ujian terkait mata pelajaran dan kelas ini.</div>
    						<?php
    					} ?>
    					</div>
    	            </div>
    	        </div>
    	    </div>
    	</div>
    	<?php
    } else if(@$_GET['action'] == 'infokerjakan') { ?>
    	<div class="row">
    	    <div class="col-md-12">
    	        <div class="panel panel-default">
    	            <div class="panel-heading">Informasi Tugas / Ujian</div>
    	            <div class="panel-body">
    	            <?php
    	            $sql_nilai = mysqli_query($db, "SELECT * FROM tb_nilai_pilgan WHERE id_tq = '$_GET[id_tq]' AND id_siswa = '$_SESSION[siswa]'") or die ($db->error);
    	            $sql_jwb = mysqli_query($db, "SELECT * FROM tb_jawaban WHERE id_tq = '$_GET[id_tq]' AND id_siswa = '$_SESSION[siswa]'") or die ($db->error);
    	            if(mysqli_num_rows($sql_nilai) > 0 || mysqli_num_rows($sql_jwb) > 0) {
    	            	echo "Anda sudah mengerjakan tugas / ujian ini, silahkan lihat nilai Anda di halaman nilai.";
    	            } else { ?>
    					1. Baca dengan seksama dan teliti sebelum mengerjakan Tugas / Ujian.<br />
    					2. Pastikan koneksi anda terjamin dan bagus.<br />
    					3. Pilih browser yang versi terbaru.<br />
    					4. Waktu akan berjalan otomatis berlanjut walau anda close halaman ujiannya, oleh karena itu siapkan waktu untuk ujian anda.<br />
    					5. Jika mati lampu hubungi pengajar mata pelajaran terkait untuk melakukan jian ulang.
    					<?php
    				} ?>
    	            </div>
    	            <div class="panel-footer">
    					<?php
    					if(mysqli_num_rows($sql_nilai) > 0 || mysqli_num_rows($sql_jwb) > 0) { ?>
    						<a onClick="window.history.back()" class="btn btn-warning">Kembali</a>
    						<?php
    					} else {
    						$sql_cek_soal_pilgan = mysqli_query($db, "SELECT * FROM tb_soal_pilgan WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
    						$sql_cek_soal_essay = mysqli_query($db, "SELECT * FROM tb_soal_essay WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
    						if(mysqli_num_rows($sql_cek_soal_pilgan) > 0 || mysqli_num_rows($sql_cek_soal_essay) > 0) { ?>
    							<a href="soal.php?id_tq=<?php echo @$_GET['id_tq']; ?>" class="btn btn-primary">Mulai Mengerjakan</a>
    						<?php
    						} else { ?>
    							<a onclick="alert('Data soal tidak ditemukan, mungkin karena belum dibuat. Silahkan hubungi guru yang bersangkutan');" class="btn btn-primary">Mulai Mengerjakan</a>
    						<?php
    						} ?>
    						<a href="?page=quiz" class="btn btn-primary">Kembali</a>
    					<?php
    					} ?>
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
