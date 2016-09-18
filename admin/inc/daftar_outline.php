<?php
$id = @$_GET['id'];

$sql_tujuanAjar = mysqli_query($db, "SELECT * FROM tb_tujuan_ajar WHERE id_mapel_ajar = '$id'") or die ($db->error);
$sql_sertifikasi = mysqli_query($db, "SELECT * FROM tb_sertifikasi WHERE id_mapel_ajar = '$id'") or die ($db->error);
$sql_buku = mysqli_query($db, "SELECT * FROM tb_buku WHERE id_mapel_ajar = '$id'") or die ($db->error);
$sql_materi = mysqli_query($db, "SELECT * FROM tb_file_materi WHERE id_mapel_ajar = '$id'") or die ($db->error);
?>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="?page=kelas" class="btn btn-danger btn-sm">Kembali</a> &nbsp; 
			Daftar Outline : 
			<a href="?page=kelas&action=daftaroutline&hal=tujuanajar&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Tujuan Pembelajaran (<?php echo mysqli_num_rows($sql_tujuanAjar); ?>)</a>
			<a href="?page=kelas&action=daftaroutline&hal=sertifikasi&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Sertifikasi (<?php echo mysqli_num_rows($sql_sertifikasi); ?>)</a> 
			<a href="?page=materi" class="btn btn-primary btn-sm">Materi (<?php echo mysqli_num_rows($sql_materi); ?>)</a>
			<a href="?page=kelas&action=daftaroutline&hal=bukupendukung&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Buku Pendukung (<?php echo mysqli_num_rows($sql_buku); ?>)</a>		
		</div>
	</div>
</div>

<?php
$subid = @$_GET['subid'];
$k = 1;
$ke = @$_GET['ke'];

if(@$_GET['hal'] == "tujuanajar") { ?>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Tujuan Pembelajaran &nbsp; <a href="?page=kelas&action=buatoutline&hal=tujuanajar&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Tambah Tujuan Pembelajaran</a></div>
			<div class="panel-body">
				<div class="table-responsive">
					<table width="100%">
				<?php
				if(mysqli_num_rows($sql_tujuanAjar) > 0) {
					while($data_tujuanajar = mysqli_fetch_array($sql_tujuanAjar)) { ?>
						<tr>
							<td valign="top">No. ( <?php echo $no++; ?> )</td>
							<td>
								<table class="table">
									<thead>
										<tr>
											<td width="20%"><b>Tujuan Pembelajaran</b></td>
											<td>:</td>
											<td width="65%"><?php echo $data_tujuanajar['tujuan_ajar']; ?></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Prioritas</td>
											<td>:</td>
											<td><?php echo $data_tujuanajar['prioritas']; ?></td>
										</tr><tr>
											<td>Opsi</td>
											<td>:</td>
											<td>
												<a href="?page=kelas&action=daftaroutline&hal=edittujuanajar&id=<?php echo $id; ?>&subid=<?php echo $data_tujuanajar['id_tujuan_ajar']; ?>&ke=<?php echo $k++; ?>" class="badge" style="background-color:#f60;">Edit</a>
												<a onclick="return confirm('Yakin akan menghapus data?');" href="?page=kelas&action=daftaroutline&hal=hapustujuanajar&id=<?php echo $id; ?>&subid=<?php echo $data_tujuanajar['id_tujuan_ajar']; ?>" class="badge" style="background-color:#f00;">Hapus</a>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					
					<?php
					}
				} else { ?>
					<div class="alert alert-danger">Data tujuan pembelajaran tidak ditemukan</div>
					<?php
				} ?>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
} else if(@$_GET['hal'] == "sertifikasi") { ?>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Sertifikasi &nbsp; <a href="?page=kelas&action=buatoutline&hal=sertifikasi&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Tambah Sertifikasi</a></div>
			<div class="panel-body">
				<div class="table-responsive">
					<table width="100%">
				<?php
				if(mysqli_num_rows($sql_sertifikasi) > 0) {
					while($data_sertifikasi = mysqli_fetch_array($sql_sertifikasi)) { ?>
						<tr>
							<td valign="top">No. ( <?php echo $no++; ?> )</td>
							<td>
								<table class="table">
									<thead>
										<tr>
											<td width="20%"><b>Nama Sertifikasi</b></td>
											<td>:</td>
											<td width="65%"><?php echo $data_sertifikasi['nama_sertifikasi']; ?></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Deskripsi Sertifikasi</td>
											<td>:</td>
											<td><?php echo $data_sertifikasi['deskripsi_sertifikasi']; ?></td>
										</tr><tr>
											<td>Opsi</td>
											<td>:</td>
											<td>
												<a href="?page=kelas&action=daftaroutline&hal=editsertifikasi&id=<?php echo $id; ?>&subid=<?php echo $data_sertifikasi['id_sertifikasi']; ?>" class="badge" style="background-color:#f60;">Edit</a>
												<a onclick="return confirm('Yakin akan menghapus data?');" href="?page=kelas&action=daftaroutline&hal=hapussertifikasi&id=<?php echo $id; ?>&subid=<?php echo $data_sertifikasi['id_sertifikasi']; ?>" class="badge" style="background-color:#f00;">Hapus</a>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					
					<?php
					}
				} else { ?>
					<div class="alert alert-danger">Data sertifikasi tidak ditemukan</div>
					<?php
				} ?>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
} else if(@$_GET['hal'] == "bukupendukung") { ?>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Buku Pendukung &nbsp; <a href="?page=kelas&action=buatoutline&hal=bukupendukung&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Tambah Buku Pendukung</a></div>
			<div class="panel-body">
				<div class="table-responsive">
					<table width="100%">
				<?php
				if(mysqli_num_rows($sql_buku) > 0) {
					while($data_sertifikasi = mysqli_fetch_array($sql_buku)) { ?>
						<tr>
							<td valign="top">No. ( <?php echo $no++; ?> )</td>
							<td>
								<table class="table">
									<thead>
										<tr>
											<td width="20%"><b>Judul</b></td>
											<td>:</td>
											<td width="65%"><?php echo $data_sertifikasi['judul']; ?></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Sinopsis</td>
											<td>:</td>
											<td><?php echo $data_sertifikasi['sinopsis']; ?></td>
										</tr>
										<tr>
											<td>Tahun</td>
											<td>:</td>
											<td><?php echo $data_sertifikasi['tahun']; ?></td>
										</tr>
										<tr>
											<td>Edisi</td>
											<td>:</td>
											<td><?php echo $data_sertifikasi['edisi']; ?></td>
										</tr>
										<tr>
											<td>Penulis</td>
											<td>:</td>
											<td><?php echo $data_sertifikasi['penulis']; ?></td>
										</tr>
										<tr>
											<td>Penerbit</td>
											<td>:</td>
											<td><?php echo $data_sertifikasi['penerbit']; ?></td>
										</tr>
										<tr>
											<td>ISBN</td>
											<td>:</td>
											<td><?php echo $data_sertifikasi['ISBN']; ?></td>
										</tr>
										<tr>
											<td>Kutip Hal</td>
											<td>:</td>
											<td><?php echo $data_sertifikasi['kutip_hal']; ?></td>
										</tr>
										<tr>
											<td>File Buku</td>
											<td>:</td>
											<td><?php echo $data_sertifikasi['file_buku']; ?></td>
										</tr>
										<tr>
											<td>Opsi</td>
											<td>:</td>
											<td>
												<a href="?page=kelas&action=daftaroutline&hal=editbukupendukung&id=<?php echo $id; ?>&subid=<?php echo $data_sertifikasi['id_buku']; ?>" class="badge" style="background-color:#f60;">Edit</a>
												<a onclick="return confirm('Yakin akan menghapus data?');" href="?page=kelas&action=daftaroutline&hal=hapusbukupendukung&id=<?php echo $id; ?>&subid=<?php echo $data_sertifikasi['id_buku']; ?>" class="badge" style="background-color:#f00;">Hapus</a>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					
					<?php
					}
				} else { ?>
					<div class="alert alert-danger">Data buku pendukung tidak ditemukan</div>
					<?php
				} ?>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
} else if(@$_GET['hal'] == "edittujuanajar") { ?>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Edit Tujuan Pembelajaran</div>
			<div class="panel-body">
			<?php
			$sql_tujuan_ajar = mysqli_query($db, "SELECT * FROM tb_tujuan_ajar WHERE id_tujuan_ajar = '$subid'") or die ($db->error);
			$data_tujuan_ajar = mysqli_fetch_array($sql_tujuan_ajar);
			?>
				<form method="post" enctype="multipart/form-data">
					<div class="col-md-2">
						<label>Tujuan Pembelajaran</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="tujuanAjar" class="form-control" rows="2" required><?php echo $data_tujuan_ajar['tujuan_ajar']; ?></textarea>
						</div>
					</div>

					<div class="col-md-2">
						<label>Prioritas</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="prioritas" class="form-control" rows="1" required><?php echo $data_tujuan_ajar['prioritas']; ?></textarea>
						</div>
					</div>
					
					<div class="col-md-2">
						<label></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
							<input type="reset" value="Reset" class="btn btn-danger" />
						</div>
					</div>
				</form>
				<?php
				if(@$_POST['simpan']) {
					$tujuanAjar = @mysqli_real_escape_string($db, $_POST['tujuanAjar']);
					$prioritas = @mysqli_real_escape_string($db, $_POST['prioritas']);

					mysqli_query($db, "UPDATE tb_tujuan_ajar SET tujuan_ajar = '$tujuanAjar', prioritas = '$prioritas' WHERE id_tujuan_ajar = '$subid'") or die ($db->error);          
					
					echo "<script>window.location='?page=kelas&action=daftaroutline&hal=tujuanajar&id=".$id."';</script>";
				} ?>

			</div>
		</div>
	</div>
	<?php
} else if(@$_GET['hal'] == "hapustujuanajar") {
	mysqli_query($db, "DELETE FROM tb_tujuan_ajar WHERE id_tujuan_ajar = '$subid'") or die ($db->error);
	echo "<script>window.location='?page=kelas&action=daftaroutline&hal=tujuanajar&id=".$id."';</script>";
} else if(@$_GET['hal'] == "editsertifikasi") { ?>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Edit Sertifikasi</div>
			<div class="panel-body">
			<?php
			$sql_sertifikasi = mysqli_query($db, "SELECT * FROM tb_sertifikasi WHERE id_sertifikasi = '$subid'") or die ($db->error);
			$data_sertifikasi = mysqli_fetch_array($sql_sertifikasi);
			?>
				<form method="post" enctype="multipart/form-data">
					<div class="col-md-2">
						<label>Nama Sertifikasi</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="namaSertifikasi" class="form-control" rows="2" required><?php echo $data_sertifikasi['nama_sertifikasi']; ?></textarea>
						</div>
					</div>

					<div class="col-md-2">
						<label>Deskripsi Sertifikasi</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="deskripsiSertifikasi" class="form-control" rows="1" required><?php echo $data_sertifikasi['deskripsi_sertifikasi']; ?></textarea>
						</div>
					</div>
					
					<div class="col-md-2">
						<label></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
							<input type="reset" value="Reset" class="btn btn-danger" />
						</div>
					</div>
				</form>
				<?php
				if(@$_POST['simpan']) {
					$namaSertifikasi = @mysqli_real_escape_string($db, $_POST['namaSertifikasi']);
					$deskripsiSertifikasi = @mysqli_real_escape_string($db, $_POST['deskripsiSertifikasi']);

					mysqli_query($db, "UPDATE tb_sertifikasi SET nama_sertifikasi = '$namaSertifikasi', deskripsi_sertifikasi = '$deskripsiSertifikasi' WHERE id_sertifikasi = '$subid'") or die ($db->error);          
					
					echo "<script>window.location='?page=kelas&action=daftaroutline&hal=sertifikasi&id=".$id."';</script>";
				} ?>

			</div>
		</div>
	</div>
	<?php
} else if(@$_GET['hal'] == "hapussertifikasi") {
	mysqli_query($db, "DELETE FROM tb_sertifikasi WHERE id_sertifikasi = '$subid'") or die ($db->error);
	echo "<script>window.location='?page=kelas&action=daftaroutline&hal=sertifikasi&id=".$id."';</script>";
} else if(@$_GET['hal'] == "editbukupendukung") { ?>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Edit Buku Pendukung</div>
			<div class="panel-body">
			<?php
			$sql_bukupendukung = mysqli_query($db, "SELECT * FROM tb_buku WHERE id_buku = '$subid'") or die ($db->error);
			$data_bukupendukung = mysqli_fetch_array($sql_bukupendukung);
			?>
				<form method="post" enctype="multipart/form-data">
					<div class="col-md-2">
						<label>Judul</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="judul" class="form-control" rows="2" required><?php echo $data_bukupendukung['judul']; ?></textarea>
						</div>
					</div>

					<div class="col-md-2">
						<label>Sinopsis</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="sinopsis" class="form-control" rows="2"><?php echo $data_bukupendukung['sinopsis']; ?></textarea>
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Tahun</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="text" name="tahun" class="form-control" value="<?php echo $data_bukupendukung['tahun']; ?>"></input>
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Edisi</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="text" name="sinopsis" class="form-control" value="<?php echo $data_bukupendukung['edisi']; ?>"></input>
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Penulis</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="penulis" class="form-control" rows="2"><?php echo $data_bukupendukung['penulis']; ?></textarea>
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Penerbit</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="text" name="penerbit" class="form-control" value="<?php echo $data_bukupendukung['penerbit']; ?>"></input>
						</div>
					</div>

					<div class="col-md-2">
						<label>ISBN</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="text" name="isbn" class="form-control" value="<?php echo $data_bukupendukung['ISBN']; ?>"></input>
						</div>
					</div>

					<div class="col-md-2">
						<label>Kutip Hal</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="kutipHal" class="form-control" rows="2"><?php echo $data_bukupendukung['kutip_hal']; ?></textarea>
						</div>
					</div>

					<div class="col-md-2">
						<label>File Buku</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="namaFile" class="form-control" ></input>
	                    </div>
	                </div>
					
					<div class="col-md-2">
						<label></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
							<input type="reset" value="Reset" class="btn btn-danger" />
						</div>
					</div>
				</form>
				<?php
				if(@$_POST['simpan']) {
					$judul = @mysqli_real_escape_string($db, $_POST['judul']);
					$sinopsis = @mysqli_real_escape_string($db, $_POST['sinopsis']);
					$tahun = @mysqli_real_escape_string($db, $_POST['tahun']);
					$edisi = @mysqli_real_escape_string($db, $_POST['edisi']);
					$penulis = @mysqli_real_escape_string($db, $_POST['penulis']);
					$penerbit = @mysqli_real_escape_string($db, $_POST['penerbit']);
					$isbn = @mysqli_real_escape_string($db, $_POST['isbn']);
					$kutipHal = @mysqli_real_escape_string($db, $_POST['kutipHal']);

					if(empty($_FILES['namaFile']['tmp_name']) || !is_uploaded_file($_FILES['namaFile']['tmp_name']))
					{
						mysqli_query($db, "UPDATE tb_buku SET judul = '$judul', sinopsis = '$sinopsis', tahun = '$tahun', edisi = '$edisi', penulis = '$penulis', penerbit = '$penerbit', isbn = '$isbn', kutip_hal = '$kutipHal' WHERE id_buku = '$subid'") or die ($db->error);          
						
						echo "<script>window.location='?page=kelas&action=daftaroutline&hal=bukupendukung&id=".$id."';</script>";
					}
					else
					{
						$sumber = @$_FILES['namaFile']['tmp_name'];
						$target = $file_buku;
						$namaFile = @$_FILES['namaFile']['name'];

						if(move_uploaded_file($sumber, $target.$namaFile)) {
							mysqli_query($db, "UPDATE tb_buku SET judul = '$judul', sinopsis = '$sinopsis', tahun = '$tahun', edisi = '$edisi', penulis = '$penulis', penerbit = '$penerbit', isbn = '$isbn', kutip_hal = '$kutipHal', file_buku = '$namaFile' WHERE id_buku = '$subid'") or die ($db->error);          
							echo '<script>window.location="?page=kelas&action=daftaroutline&hal=bukupendukung&id='.$id.'"</script>';
						} else {
							echo '<script>alert("Gagal menambah buku pendukung, file gagal diupload, coba lagi!");</script>';
						}
					}
				} ?>

			</div>
		</div>
	</div>
	<?php
} else if(@$_GET['hal'] == "hapusbukupendukung") {
	mysqli_query($db, "DELETE FROM tb_buku WHERE id_buku = '$subid'") or die ($db->error);
	echo "<script>window.location='?page=kelas&action=daftaroutline&hal=bukupendukung&id=".$id."';</script>";
} ?>