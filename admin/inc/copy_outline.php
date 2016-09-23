<?php
$id = @$_GET['id'];
$pembuat = '';

if(@$_SESSION['admin']) {
    $pembuat = "admin";
} else if(@$_SESSION['pengajar']) {
    $pembuat = @$_SESSION['pengajar'];
}
?>
<?php
if(@$_GET['action'] == 'copyoutline') { ?>
	<div class="row">
		<div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Copy Outline &nbsp; <a href="?page=kelas" class="btn btn-warning btn-xs">Kembali</a></div>
                <div class="panel-body">
                	<form method="post" enctype="multipart/form-data">
                    	<div class="form-group">
                            <label>Mapel *</label>
                            <select name="mapel" class="form-control mapel_ddl" required>
                                <option>- Pilih -</option>
                            	<?php
                            	$sql_mapel = mysqli_query($db, "SELECT * FROM tb_mapel") or die ($db->error);
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
                            		echo '<option value="'.$data_kelas['id'].'">'.$data_kelas['nama_kelas'].'</option>';
                            	} ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                            <input type="reset" value="Reset" class="btn btn-danger" />
                        </div>
                    </form>
					<?php
                    if(@$_POST['simpan']) {
                    	$mapel = @mysqli_real_escape_string($db, $_POST['mapel']);
                        $kelas = @mysqli_real_escape_string($db, $_POST['kelas']);

						mysqli_query($db, "INSERT INTO tb_tujuan_ajar SELECT NULL, '$kelas', tujuan_ajar, prioritas FROM tb_tujuan_ajar WHERE id_mapel_ajar='$id';") or die ($db->error);
						mysqli_query($db, "INSERT INTO tb_sertifikasi SELECT NULL, '$kelas', nama_sertifikasi, deskripsi_sertifikasi FROM tb_sertifikasi WHERE id_mapel_ajar='$id';") or die ($db->error);
						mysqli_query($db, "INSERT INTO tb_buku SELECT NULL, '$kelas', judul, sinopsis, tahun, edisi, penulis, penerbit, ISBN, kutip_hal, file_buku FROM tb_buku WHERE id_mapel_ajar='$id';") or die ($db->error);
						mysqli_query($db, "INSERT INTO tb_file_materi SELECT NULL, '$kelas', judul, nama_file, tgl_posting, pembuat, hits FROM tb_file_materi WHERE id_mapel_ajar='$id';") or die ($db->error);
						echo '<script>window.location="?page=kelas";</script>';
                    } ?>
                </div>
            </div>
        </div>
	</div>
<?php
} 
?>
<script type="text/javascript">
    $(".mapel_ddl").change(function(){
        window.location="?page=kelas&action=copyoutline&id=<?php echo $id; ?>&idmapel="+$(this).val()
    })
</script>
