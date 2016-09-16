<?php
$no = 1;
$id = @$_GET['id'];

if(@$_SESSION['admin']) {
?>

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">Manajemenen Registrasi Siswa</h1>
        </div>
    </div>

    <?php
    if(@$_GET['action'] == '') {
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Data Siswa yang Registrasi (Mendaftar) &nbsp; <a href="./laporan/cetak.php?data=siswaregistrasi" target="_blank" class="btn btn-default btn-xs">Cetak Data Siswa</a></div>
                <div class="panel-body">
                	<div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="datasiswaregistrasi">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIS</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>TTL</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_siswa = mysqli_query($db, "SELECT * FROM tb_siswa WHERE status = 'tidak aktif'") or die ($db->error);
                            if(mysqli_num_rows($sql_siswa) > 0) {
    	                        while($data_siswa = mysqli_fetch_array($sql_siswa)) {

                                    if($data_siswa['jenis_kelamin'] == 'L') {
                                        $gender_persiswa = 'Laki-laki';
                                    } else {
                                        $gender_persiswa = 'Perempuan';
                                    }
                                ?>
    	                            <tr>
    	                                <td align="center"><?php echo $no++; ?></td>
    	                                <td><?php echo $data_siswa['nis']; ?></td>
    	                                <td><?php echo $data_siswa['nama_lengkap']; ?></td>
    	                                <td><?php echo $gender_persiswa; ?></td>
    	                                <td><?php echo $data_siswa['tempat_lahir'].", ".tgl_indo($data_siswa['tgl_lahir']); ?></td>
    	                                <td><?php echo $data_siswa['alamat']; ?></td>
    	                                <td><?php echo ucfirst($data_siswa['status']); ?></td>
    	                                <td align="center" width="200px">
    	                                    <a href="?page=siswaregistrasi&action=aktifkan&id=<?php echo $data_siswa['id_siswa']; ?>" class="btn btn-success btn-xs">Aktifkan</a>
                                            <a onclick="return confirm('Yakin akan menghapus data ?');" href="?page=siswaregistrasi&action=hapus&id=<?php echo $data_siswa['id_siswa']; ?>" class="btn btn-danger btn-xs">Hapus</a>
                                             <a href="?page=siswaregistrasi&action=detail&IDsiswa=<?php echo $data_siswa['id_siswa']; ?>" class="btn btn-default btn-xs">Detail</a>
    	                                </td>
    	                            </tr>
    	                        <?php
    		                    }
    		                } else { ?>
    							<tr>
                                    <td colspan="8" align="center">Data tidak ditemukan</td>
    							</tr>
    		                	<?php
    		                } ?>
                            </tbody>
                        </table>
                        <script>
                        $(document).ready(function () {
                            $('#datasiswaregistrasi').dataTable();
                        });
                        </script>
                    </div>
                </div>
            </div>
    	</div>
    </div>

    <?php
    } else if(@$_GET['action'] == 'aktifkan') {
        mysqli_query($db, "UPDATE tb_siswa SET status = 'aktif' WHERE id_siswa = '$id'") or die ($db->error);
        echo "<script>window.location='?page=siswaregistrasi';</script>";
    } else if(@$_GET['action'] == 'hapus') {
        mysqli_query($db, "DELETE FROM tb_siswa WHERE id_siswa = '$id'") or die ($db->error);
        echo "<script>window.location='?page=siswaregistrasi';</script>";
    } else if(@$_GET['action'] == 'detail') {
        $sql_siswa_per_id = mysqli_query($db, "SELECT * FROM tb_siswa WHERE id_siswa = '$_GET[IDsiswa]'") or die ($db->error);
        $data = mysqli_fetch_array($sql_siswa_per_id);
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Detail Profil Siswa</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>NIS</td>
                                    <td>:</td>
                                    <td><?php echo $data['nis']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>:</td>
                                    <td><?php echo $data['nama_lengkap']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tempat Tanggal Lahir</td>
                                    <td>:</td>
                                    <td><?php echo $data['tempat_lahir'].", ".tgl_indo($data['tgl_lahir']); ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td><?php echo $data['jenis_kelamin']; ?></td>
                                </tr>
                                <tr>
                                    <td>Agama</td>
                                    <td>:</td>
                                    <td><?php echo $data['agama']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Ayah</td>
                                    <td>:</td>
                                    <td><?php echo $data['nama_ayah']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Ibu</td>
                                    <td>:</td>
                                    <td><?php echo $data['nama_ibu']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon</td>
                                    <td>:</td>
                                    <td><?php echo $data['no_telp']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><?php echo $data['email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><?php echo $data['alamat']; ?></td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>:</td>
                                    <td><?php echo $data['nama_kelas']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tahun Masuk</td>
                                    <td>:</td>
                                    <td><?php echo $data['thn_masuk']; ?></td>
                                </tr>
                                <tr>
                                    <td>Foto</td>
                                    <td>:</td>
                                    <td><img src="../img/foto_siswa/<?php echo $data['foto']; ?>" width="200px" /></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td><?php echo $data['username']; ?></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>:</td>
                                    <td><?php echo $data['pass']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

} else { ?>
	<div class="row">
	    <div class="col-xs-12">
	        <div class="alert alert-danger">Maaf Anda tidak punya hak akses masuk halaman ini!</div>
	    </div>
	</div>
	<?php
} ?>
