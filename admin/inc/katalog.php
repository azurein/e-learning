<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Management Katalog</h1>
    </div>
</div>

<?php
if(@$_GET['action'] == '') { ?>
	<div class="row">
		<div class="col-md-12">
	        <div class="panel panel-default">
	            <div class="panel-heading">Data Katalog &nbsp;<a href="?page=katalog&action=tambah" class="btn btn-primary btn-sm">Tambah Data</a></div>
	            <div class="panel-body">
	                <div class="table-responsive">
	                    <table class="table table-striped table-bordered table-hover" id="datakatalog">
	                        <thead>
	                            <tr>
	                                <th>#</th>
	                                <th>Nama Item</th>
                                    <th>Harga</th>
	                                <th>Nama File</th>
	                                <th>Tanggal Posting</th>
	                                <th>Dilihat</th>
	                                <th>Opsi</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        <?php
	                        $no = 1;
	                        $sql_katalog = mysqli_query($db, "SELECT * FROM tb_katalog") or die($db->error);
                        	while($data_katalog = mysqli_fetch_array($sql_katalog)) { ?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $data_katalog['judul']; ?></td>
									<td><?php echo $data_katalog['harga']; ?></td>
									<td><a href="./file_katalog/<?php echo $data_katalog['nama_file']; ?>" target="_blank"><?php echo $data_katalog['nama_file']; ?></a></td>
									<td><?php echo tgl_indo($data_katalog['tgl_posting']); ?></td>
                                    <td><?php echo $data_katalog['hits']." kali"; ?></td>
									<td align="center">
                                        <a onclick="return confirm('Yakin akan menghapus data?');" href="?page=katalog&action=hapus&id_katalog=<?php echo $data_katalog['id_katalog']; ?>" class="btn btn-danger btn-xs">Hapus</a>
                                    </td>
								</tr>
							<?php
                        	} ?>
	                        </tbody>
	                    </table>
	                    <script>
                        $(document).ready(function () {
                            $('#datakatalog').dataTable();
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
                <div class="panel-heading">Tambah Katalog &nbsp; <a href="?page=katalog" class="btn btn-warning btn-sm">Kembali</a></div>
                <div class="panel-body">
                	<form method="post" enctype="multipart/form-data">
                    	<div class="form-group">
                            <label>Judul *</label>
                            <input type="text" name="judul" class="form-control judul_text" value="<?php if(isset($_GET['judul'])) echo $_GET['judul']; ?>" required />
                        </div>
                        <div class="form-group">
                            <label>Harga *</label>
                            <input type="number" name="harga" class="form-control harga_text" value="<?php if(isset($_GET['harga'])) echo $_GET['harga']; ?>" required />
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            <select name="jenis" class="form-control">
                                <option val="gambar">Gambar</option>
                                <option val="file">File</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>File *</label>
                            <input type="file" name="katalog" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                            <input type="reset" value="Reset" class="btn btn-danger" />
                        </div>
                    </form>
					<?php
                    if(@$_POST['simpan']) {
                    	$judul = @mysqli_real_escape_string($db, $_POST['judul']);
                        $harga = @mysqli_real_escape_string($db, $_POST['harga']);
                        $jenis = @mysqli_real_escape_string($db, $_POST['jenis']);
                        $sumber = @$_FILES['katalog']['tmp_name'];
                        $target = 'file_katalog/';
                        $nama_file = @$_FILES['katalog']['name'];

                        if(move_uploaded_file($sumber, $target.$nama_file)) {
                            mysqli_query($db, "INSERT INTO tb_katalog (id_katalog, judul, harga, nama_file, tgl_posting, hits, jenis) VALUES(NULL, '$judul', '$harga', '$nama_file', now(), '0', '$jenis')") or die ($db->error);
                            echo '<script>window.location="?page=katalog";</script>';
                        } else {
                            echo '<script>alert("Gagal menambah katalog, file gagal diupload, coba lagi!");</script>';
                        }
                    } ?>
                </div>
            </div>
        </div>
	</div>
<?php
} else if(@$_GET['action'] == 'hapus') {
	mysqli_query($db, "DELETE FROM tb_katalog WHERE id_katalog = '$_GET[id_katalog]'") or die($db->error);
	echo "<script>window.location='?page=katalog';</script>";
} ?>
