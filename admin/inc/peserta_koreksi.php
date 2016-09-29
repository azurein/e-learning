<div class="row">
	<div class="panel panel-default">
	    <div class="panel-heading">
	        Data Siswa yang Mengikuti Ujian &nbsp; <a href="?page=quiz" class="btn btn-danger btn-sm">Kembali</a>
	    </div>
	    <div class="panel-body">
            <div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
							<th>Nilai Pilihan Ganda</th>
							<th>Nilai Essay</th>
							<th>Nilai Akhir</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php
					$id_tq = $_GET['id_tq'];
					$sql_cek_nilai = mysqli_query($db, "

						SELECT DISTINCT
							tb_topik_quiz.id_mapel,
							kode_mapel,
							mapel,
							tb_topik_quiz.id_tq,
							judul,
							tb_topik_quiz.id_kelas,
							tb_kelas.nama_kelas,
							tb_siswa.id_siswa,
							tb_siswa.nama_lengkap,
							tb_nilai_pilgan.id as id_pilgan,
							benar,
							salah,
							tidak_dikerjakan,
							presentase,
							tb_nilai_essay.id as id_essay,
							nilai

						FROM tb_topik_quiz

						LEFT JOIN tb_nilai_pilgan
						ON tb_topik_quiz.id_tq = tb_nilai_pilgan.id_tq

						LEFT JOIN tb_nilai_essay
						ON tb_topik_quiz.id_tq = tb_nilai_essay.id_tq

						JOIN tb_mapel_ajar
						ON tb_topik_quiz.id_mapel = tb_mapel_ajar.id_mapel
						AND tb_topik_quiz.id_kelas = tb_mapel_ajar.id_kelas

						JOIN tb_jadwal_siswa
						ON tb_mapel_ajar.id = tb_jadwal_siswa.id_mapel_ajar

						JOIN tb_siswa
						ON tb_jadwal_siswa.id_siswa = tb_siswa.id_siswa

						JOIN tb_mapel ON tb_topik_quiz.id_mapel = tb_mapel.id

						JOIN tb_kelas ON tb_topik_quiz.id_kelas = tb_kelas.id_kelas

						WHERE tb_topik_quiz.status like 'aktif'
                        AND tb_topik_quiz.id_tq = '$id_tq'

                    ") or die ($db->error);
					while($data_nilai = mysqli_fetch_array($sql_cek_nilai)) {
						?>
                        <tr>
                            <td align="center" width="40px"><?php echo $no++; ?></td>
                            <td><?php echo $data_nilai['nama_lengkap']; ?></td>
							<td>
								<?php
								if(isset($data_nilai['id_pilgan'])) {
									echo "Benar : ".$data_nilai['benar']." soal<br />";
									echo "Salah : ".$data_nilai['salah']." soal<br />";
									echo "Tidak dikerjakan : ".$data_nilai['tidak_dikerjakan']." soal<br />";
									echo "Presentase : ".round($data_nilai['presentase']);
								} else {
									echo "Ujian ini tidak ada soal pilihan ganda";
								} ?>
							</td>
							<?php
							$sql_cek_jawaban = mysqli_query($db, "SELECT * FROM tb_jawaban WHERE id_tq = '$id_tq' AND id_siswa = '$data_nilai[id_siswa]'") or die ($db->error);
							$data_jawaban = mysqli_fetch_array($sql_cek_jawaban);
							if(mysqli_num_rows($sql_cek_jawaban) > 0) {
								$sql_cek_nilai_essay = mysqli_query($db, "SELECT * FROM tb_nilai_essay WHERE id_tq = '$id_tq' AND id_siswa = '$data_nilai[id_siswa]'") or die ($db->error);
								$data_nilai_essay = mysqli_fetch_array($sql_cek_nilai_essay);

								if(mysqli_num_rows($sql_cek_nilai_essay) > 0) {
									echo "<td>".round($data_nilai_essay['nilai'])."</td>";
									if(isset($data_nilai['id_pilgan'])) {
										$nilaifinal = (($data_nilai['presentase']+$data_nilai_essay['nilai'])/2);
										echo "<td>".round($nilaifinal)."</td>";
									} else {
										$nilaifinal = ($data_nilai['presentase']+$data_nilai_essay['nilai']);
										echo "<td>".round($nilaifinal)."</td>";
									}
								} else {
									echo "<td>Soal essay belum dikoreksi</td>";
									echo "<td>Menunggu soal essay dikoreksi</td>";
								}
							} else {
								echo "<td>Ujian ini tidak ada soal essay</td>";
								if(isset($data_nilai['id_pilgan'])) {
									echo "<td>".$data_nilai['presentase']."</td>";
								} else {
									echo "<td>-</td>";
								}
							} ?>
							<td align="center" width="220px">
                                <?php
                                if(mysqli_num_rows($sql_cek_jawaban) > 0) {
                                    if(mysqli_num_rows($sql_cek_nilai_essay) > 0) { ?>
                                        <a href="?page=quiz&action=koreksi&hal=editessay&id_tq=<?php echo $id_tq; ?>&id_siswa=<?php echo $data_nilai['id_siswa']; ?>&id_nilai=<?php echo $data_nilai_essay['id']; ?>" class="btn btn-default btn-xs">Edit Koreksi Essay</a>
                                    <?php
                                    } else { ?>
                                        <a href="?page=quiz&action=koreksi&hal=essay&id_tq=<?php echo $id_tq; ?>&id_siswa=<?php echo $data_nilai['id_siswa']; ?>" class="btn btn-default btn-xs">Koreksi Jawaban Essay</a>
                                    <?php
                                    }
                                } ?>
                                <a onclick="return confirm('Yakin akan menghapus siswa ini dari daftar peserta ujian?');" href="?page=quiz&action=hapuspeserta&id_tq=<?php echo $id_tq; ?>&id_siswa=<?php echo $data_siswa_mengikuti_tes['id_siswa']; ?>" class="btn btn-default btn-xs">Hapus Siswa dari Peserta Ujian</a>
                            </td>
                        </tr>
					<?php
					} ?>
                    </tbody>
                </table>
                <?php if(mysqli_num_rows($sql_cek_nilai) > 0) { ?>
                    <a href="./laporan/cetak.php?data=quiz&id_tq=<?php echo $id_tq; ?>" target="_blank" class="btn btn-default btn-sm">Cetak</a>
                <?php } ?>
            </div>
        </div>
	</div>
</div>
