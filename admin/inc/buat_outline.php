<?php
$id = @$_GET['id'];
$pembuat = '';

if(@$_SESSION['admin']) {
    $pembuat = "admin";
} else if(@$_SESSION['pengajar']) {
    $pembuat = @$_SESSION['pengajar'];
}
?>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a onclick="self.history.back();" class="btn btn-danger btn-sm">Kembali</a> &nbsp;
			Buat Outline :
			<a href="?page=kelas&action=buatoutline&hal=tujuanajar&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Tujuan Pembelajaran</a>
			<a href="?page=kelas&action=buatoutline&hal=sertifikasi&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Sertifikasi</a>
			<a href="?page=kelas&action=buatoutline&hal=bukupendukung&id=<?php echo $id; ?>"class="btn btn-primary btn-sm">Buku Pendukung</a>
		</div>
	</div>
</div>

<?php
if(@$_GET['hal'] == "tujuanajar") { ?>
	<div class="row">
		<div class="panel panel-default">
		    <div class="panel-heading">Buat Outline - Tujuan Pembelajaran</div>
		    <div class="panel-body">
		    	<form method="post" enctype="multipart/form-data">
					<div class="col-md-2">
						<label>Tujuan Pembelajaran</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="tujuanAjar" class="form-control" rows="2" required></textarea>
						</div>
					</div>

					<div class="col-md-2">
						<label>Prioritas</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="prioritas" class="form-control" rows="1" required></textarea>
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

					mysqli_query($db, "INSERT INTO tb_tujuan_ajar VALUES(NULL, '$id', '$tujuanAjar', '$prioritas')") or die ($db->error);
					echo '<script>window.location="?page=kelas&action=daftaroutline&hal=tujuanajar&id='.$id.'"</script>';
	            } ?>
		    </div>
		</div>
	</div>
<?php
} else if(@$_GET['hal'] == "sertifikasi") { ?>
	<div class="row">
		<div class="panel panel-default">
		    <div class="panel-heading">Buat Outline - Sertifikasi</div>
		    <div class="panel-body">
		    	<form method="post" enctype="multipart/form-data">
					<div class="col-md-2">
						<label>Nama Sertifikasi</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="namaSertifikasi" class="form-control" rows="2" required></textarea>
						</div>
					</div>

					<div class="col-md-2">
						<label>Deskripsi Sertifikasi</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="deskripsiSertifikasi" class="form-control" rows="1" required></textarea>
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

                    mysqli_query($db, "INSERT INTO tb_sertifikasi VALUES(NULL, '$id', '$namaSertifikasi', '$deskripsiSertifikasi')") or die ($db->error);
                    echo '<script>window.location="?page=kelas&action=daftaroutline&hal=sertifikasi&id='.$id.'"</script>';
	            }
	            ?>
		    </div>
		</div>
	</div>
<?php
} else if(@$_GET['hal'] == "bukupendukung") { ?>
	<div class="row">
		<div class="panel panel-default">
		    <div class="panel-heading">Buat Outline - Buku Pendukung</div>
		    <div class="panel-body">
		    	<form method="post" enctype="multipart/form-data">
					<div class="col-md-2">
						<label>Judul</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="judul" class="form-control" rows="2" required></textarea>
						</div>
					</div>

					<div class="col-md-2">
						<label>Sinopsis</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="sinopsis" class="form-control" rows="2"></textarea>
						</div>
					</div>

					<div class="col-md-2">
						<label>Tahun</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="text" name="tahun" class="form-control" ></input>
						</div>
					</div>

					<div class="col-md-2">
						<label>Edisi</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="text" name="edisi" class="form-control" ></input>
						</div>
					</div>

					<div class="col-md-2">
						<label>Penulis</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="penulis" class="form-control" rows="2"></textarea>
						</div>
					</div>

					<div class="col-md-2">
						<label>Penerbit</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="text" name="penerbit" class="form-control" ></input>
						</div>
					</div>

					<div class="col-md-2">
						<label>ISBN</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="text" name="isbn" class="form-control" ></input>
						</div>
					</div>

					<div class="col-md-2">
						<label>Kutip Hal</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="kutipHal" class="form-control" rows="2"></textarea>
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
						mysqli_query($db, "INSERT INTO tb_buku VALUES(NULL, '$id', '$judul', '$sinopsis', '$tahun', '$edisi', '$penulis', '$penerbit', '$isbn', '$kutipHal', '')") or die ($db->error);
						echo '<script>window.location="?page=kelas&action=daftaroutline&hal=bukupendukung&id='.$id.'"</script>';
					}
					else
					{
						$sumber = @$_FILES['namaFile']['tmp_name'];
						$target = $file_buku;
						$namaFile = @$_FILES['namaFile']['name'];

						if(move_uploaded_file($sumber, $target.$namaFile)) {
							mysqli_query($db, "INSERT INTO tb_buku VALUES(NULL, '$id', '$judul', '$sinopsis', '$tahun', '$edisi', '$penulis', '$penerbit', '$isbn', '$kutipHal', '$namaFile')") or die ($db->error);
							echo '<script>window.location="?page=kelas&action=daftaroutline&hal=bukupendukung&id='.$id.'"</script>';
						} else {
							echo '<script>alert("Gagal menambah buku pendukung, file gagal diupload, coba lagi!");</script>';
						}
					}
	            }
	            ?>
		    </div>
		</div>
	</div>
	<?php
} ?>
