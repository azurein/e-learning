<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Management File Materi</h1>
    </div>
</div>

<?php
if(@$_GET['action'] == '') { ?>
	<div class="row">
		<div class="col-md-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">Data Materi &nbsp;<a href="?page=materi&action=tambah" class="btn btn-primary btn-sm">Tambah Data</a> &nbsp; <a href="./laporan/cetak.php?data=materi" target="_blank" class="btn btn-default btn-sm">Cetak</a></div>
	            <div class="panel-body">
	                <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover" id="datamateri">
	                        <thead>
	                            <tr>
	                                <th>#</th>
	                                <th>Judul</th>
	                                <th>Kelas</th>
	                                <th>Mapel</th>
	                                <th>Nama File</th>
	                                <th>Tanggal Posting</th>
	                                <th>Pembuat</th>
	                                <th>Dilihat</th>
	                                <th>Opsi</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        <?php
	                        $no = 1;
	                        if(@$_SESSION[admin]) {
		                        $sql_materi = mysqli_query($db, "SELECT * FROM tb_file_materi JOIN tb_kelas ON tb_file_materi.id_kelas = tb_kelas.id_kelas JOIN tb_mapel ON tb_file_materi.id_mapel = tb_mapel.id") or die($db->error);
	                        } else if(@$_SESSION[pengajar]) {
	                        	$sql_materi = mysqli_query($db, "SELECT * FROM tb_file_materi JOIN tb_kelas ON tb_file_materi.id_kelas = tb_kelas.id_kelas JOIN tb_mapel ON tb_file_materi.id_mapel = tb_mapel.id JOIN tb_mapel_ajar ON tb_file_materi.id_kelas = tb_mapel_ajar.id_kelas AND tb_file_materi.id_mapel = tb_mapel_ajar.id_mapel WHERE tb_mapel_ajar.id_pengajar = '$_SESSION[pengajar]'") or die($db->error);
	                        }
                        	while($data_materi = mysqli_fetch_array($sql_materi)) { ?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $data_materi['judul']; ?></td>
									<td><?php echo $data_materi['nama_kelas']; ?></td>
									<td><?php echo $data_materi['mapel']; ?></td>
									<td><a href="./file_materi/<?php echo $data_materi['nama_file']; ?>" target="_blank"><?php echo $data_materi['nama_file']; ?></a></td>
									<td><?php echo tgl_indo($data_materi['tgl_posting']); ?></td>
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
                                        <a onclick="return confirm('Yakin akan menghapus data?');" href="?page=materi&action=hapus&IDmateri=<?php echo $data_materi['id_materi']; ?>" class="btn btn-danger btn-xs">Hapus</a>
                                    </td>
								</tr>
							<?php
                        	} ?>
	                        </tbody>
	                    </table>
	                    <script>
                        $(document).ready(function () {
                            $('#datamateri').dataTable();
                        });
                        </script>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<?php
} if(@$_GET['action'] == 'tambah') { ?>
	<div class="row">
		<div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah File Materi &nbsp; <a href="?page=materi" class="btn btn-warning btn-sm">Kembali</a></div>
                <div class="panel-body">
                	<form method="post" enctype="multipart/form-data">
                    	<div class="form-group">
                            <label>Judul *</label>
                            <input type="text" name="judul" class="form-control judul_text" value="<?php if(isset($_GET['judul'])) echo $_GET['judul']; ?>" required />
                        </div>
                        <div class="form-group">
                            <label>Mapel *</label>
                            <select name="mapel" class="form-control mapel_ddl" required>
                                <option>- Pilih -</option>
                            	<?php
                                $query = "";
                                if(@$_SESSION[admin]) {
                                    $query = "SELECT * FROM tb_mapel";
                                } else if(@$_SESSION[pengajar]) {
                                    $query = "SELECT tb_mapel.* FROM tb_mapel JOIN tb_mapel_ajar ON tb_mapel.id = tb_mapel_ajar.id_mapel WHERE tb_mapel_ajar.id_pengajar = '$_SESSION[pengajar]'";
                                }
                            	$sql_mapel = mysqli_query($db, $query) or die ($db->error);
                            	while($data_mapel = mysqli_fetch_array($sql_mapel)) {
                                    if($data_mapel['id'] == $_GET['idmapel']) {
	                            		echo '<option selected value="'.$data_mapel['id'].'">'.$data_mapel['mapel'].'</option>';
                                    } else {
                                        echo '<option value="'.$data_mapel['id'].'">'.$data_mapel['mapel'].'</option>';
                                    }
                            	} ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kelas *</label>
                            <select name="kelas" class="form-control" required>
                            	<?php
                            	$sql_kelas = mysqli_query($db, "SELECT * FROM tb_kelas JOIN tb_mapel_ajar ON tb_kelas.id_kelas = tb_mapel_ajar.id_kelas WHERE tb_mapel_ajar.id_mapel = '$_GET[idmapel]'") or die ($db->error);
                            	while($data_kelas = mysqli_fetch_array($sql_kelas)) {
                            		echo '<option value="'.$data_kelas['id_kelas'].'">'.$data_kelas['nama_kelas'].'</option>';
                            	} ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>File *</label>
                            <input type="file" name="materi" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                            <input type="reset" value="Reset" class="btn btn-danger" />
                        </div>
                    </form>
					<?php
                    if(@$_POST['simpan']) {
                    	$judul = @mysqli_real_escape_string($db, $_POST['judul']);
                        $mapel = @mysqli_real_escape_string($db, $_POST['mapel']);
                        $kelas = @mysqli_real_escape_string($db, $_POST['kelas']);

                        $sumber = @$_FILES['materi']['tmp_name'];
                        $target = 'file_materi/';
                        $nama_file = @$_FILES['materi']['name'];

                        if(move_uploaded_file($sumber, $target.$nama_file)) {
                        	if(@$_SESSION[admin]) {
	                            mysqli_query($db, "INSERT INTO tb_file_materi (id_materi, id_kelas, id_mapel, judul, nama_file, tgl_posting, pembuat, hits) VALUES(NULL, '$kelas', '$mapel', '$judul', '$nama_file', now(), 'admin', '0')") or die ($db->error);
                            } else if(@$_SESSION[pengajar]) {
                            	mysqli_query($db, "INSERT INTO tb_file_materi (id_materi, id_kelas, id_mapel, judul, nama_file, tgl_posting, pembuat, hits) VALUES(NULL, '$kelas', '$mapel', '$judul', '$nama_file', now(), '$_SESSION[pengajar]', '0')") or die ($db->error);
                            }
                            echo '<script>window.location="?page=materi";</script>';
                        } else {
                            echo '<script>alert("Gagal menambah materi, file gagal diupload, coba lagi!");</script>';
                        }
                    } ?>
                </div>
            </div>
        </div>
	</div>
<?php
} else if(@$_GET['action'] == 'hapus') {
	mysqli_query($db, "DELETE FROM tb_file_materi WHERE id_materi = '$_GET[IDmateri]'") or die($db->error);
	echo "<script>window.location='?page=materi';</script>";
} ?>
<script type="text/javascript">
    $(".mapel_ddl").change(function(){
        window.location="?page=materi&action=tambah&judul="+$(".judul_text").val()+"&idmapel="+$(this).val()
    })
</script>
