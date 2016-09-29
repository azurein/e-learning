<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Materi Pelatihan</h4>
    </div>
</div>

<?php
$db = mysqli_connect("localhost", "root", "root", "elearn_db");
if(@$_GET['action'] == '') { ?>
	<div class="row">
	    <div class="col-md-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">Data Materi Pelatihan</div>
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
                            ") or die ($db->error);
	                        while($data_mapel = mysqli_fetch_array($sql_mapel)) { ?>
	                            <tr>
	                                <td width="40px" align="center"><?php echo $no++; ?></td>
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
	            <div class="panel-heading">Lihat Data Materi Pelajaran</div>
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
						    $sql_materi = mysqli_query($db, "
                                SELECT DISTINCT
                                id_materi,
                                judul,
                                tgl_posting,
                                pembuat,
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
                            ") or die ($db->error);
						    while($data_materi = mysqli_fetch_array($sql_materi)) { ?>
						        <tr>
						            <td width="40px" align="center"><?php echo $no++; ?></td>
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
						            	<a href="./admin/file_materi/<?php echo $data_materi['nama_file']; ?>" target="_blank" id="klik" isi="<?php echo $data_materi['id_materi']; ?>" class="btn btn-info btn-xs">Lihat / Download</a>
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
