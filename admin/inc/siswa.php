<?php
$no = 1;
$id = @$_GET['id'];

if(@$_SESSION['admin']) { ?>
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">Manajemenen Data Siswa</h1>
        </div>
    </div>
<?php
}

if(@$_GET['action'] == '') {

?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                <?php
                if(@$_GET['IDkelas'] == '') {
                    echo 'Data Siswa yang Aktif &nbsp; <a href="./laporan/cetak.php?data=siswa" target="_blank" class="btn btn-default btn-xs">Cetak Data Siswa</a>';
                } else if(@$_GET['IDkelas'] != '') {
                    echo "Data Siswa Per Kelas ".@$_GET['kelas']." yang Aktif &nbsp; <a href='?page=kelas' class='btn btn-warning btn-sm'>Kembali</a>";
                } ?>

                </div>
                <div class="panel-body">
                	<div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="datasiswa">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIS</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Kelas</th>
                                    <?php if(@$_SESSION[admin]) { ?>
                                        <th>Status</th>
                                    <?php } ?>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                            if(@$_GET['IDkelas'] == '') {
                                $sql_siswa = mysqli_query($db, "SELECT * FROM tb_siswa WHERE tb_siswa.status = 'aktif'") or die ($db->error);
                            } else if(@$_GET['IDkelas'] != '') {
                                $sql_siswa = mysqli_query($db, "SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas WHERE tb_siswa.status = 'aktif' AND tb_siswa.id_kelas = '$_GET[IDkelas]'") or die ($db->error);
                            }

                            if(mysqli_num_rows($sql_siswa) > 0) {
    	                        while($data_siswa = mysqli_fetch_array($sql_siswa)) { ?>
    	                            <tr>
    	                                <td align="center"><?php echo $no++; ?></td>
    	                                <td><?php echo $data_siswa['nis']; ?></td>
    	                                <td><?php echo $data_siswa['nama_lengkap']; ?></td>
    	                                <td><?php echo $data_siswa['jenis_kelamin']; ?></td>
    	                                <td><?php echo $data_siswa['alamat']; ?></td>
                                        <td align="center"><?php echo $data_siswa['nama_kelas']; ?></td>
                                        <?php if(@$_SESSION[admin]) { ?>
        	                                <td><?php echo ucfirst($data_siswa['status']); ?></td>
                                        <?php } ?>
    	                                <td align="center">
                                            <?php if(@$_SESSION[admin]) { ?>
        	                                    <a href="?page=siswa&action=nonaktifkan&id=<?php echo $data_siswa['id_siswa']; ?>" class="btn btn-primary btn-xs">Non Aktifkan</a>
                                                <a href="?page=siswa&action=editprofil&IDsiswa=<?php echo $data_siswa['id_siswa']; ?>" class="btn btn-warning btn-xs">Edit</a>
                                                <a onclick="return confirm('Yakin akan menghapus data ?');" href="?page=siswa&action=hapus&id=<?php echo $data_siswa['id_siswa']; ?>" class="btn btn-danger btn-xs">Hapus</a>
                                            <?php } ?>
                                            <a href="?page=siswa&action=detail&IDsiswa=<?php echo $data_siswa['id_siswa']; ?>" class="btn btn-default btn-xs">Detail</a>
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
                            $('#datasiswa').dataTable();
                        });
                        </script>
                    </div>
                </div>
            </div>
    	</div>
    </div>

<?php
} else if(@$_GET['action'] == 'nonaktifkan') {
    mysqli_query($db, "UPDATE tb_siswa SET status = 'tidak aktif' WHERE id_siswa = '$id'") or die ($db->error);
    echo "<script>window.location='?page=siswa';</script>";
} else if(@$_GET['action'] == 'hapus') {
    mysqli_query($db, "DELETE FROM tb_siswa WHERE id_siswa = '$id'") or die ($db->error);
    echo "<script>window.location='?page=siswa';</script>";
} else if(@$_GET['action'] == 'editprofil') {
    $sql_siswa_per_id = mysqli_query($db, "
        SELECT a.*,b.nama_kelas
        FROM tb_siswa a
        JOIN tb_kelas b
        ON a.id_kelas = b.id_kelas
        WHERE id_siswa = '$_GET[IDsiswa]'
    ") or die ($db->error);
    $data = mysqli_fetch_array($sql_siswa_per_id);
    ?>
    <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Edit Profil Siswa</div>
            <div class="panel-body">

            <form method="post" enctype="multipart/form-data">
                Nama Lengkap* : <input type="text" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>" class="form-control" required />
                Tempat Lahir* : <input type="text" name="tempat_lahir" value="<?php echo $data['tempat_lahir']; ?>" class="form-control" required />
                Tanggal Lahir* : <input type="date" name="tgl_lahir" value="<?php echo $data['tgl_lahir']; ?>" class="form-control" required />
                Jenis Kelamin* :
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L">Laki-laki</option>
                    <option value="P" <?php if($data['jenis_kelamin'] == 'P') { echo "selected"; } ?>>Perempuan</option>
                </select>
                Agama* :
                <select name="agama" class="form-control" required>
                    <option value="Islam">Islam</option>
                    <option value="Kristen" <?php if($data['agama'] == 'Kristen') { echo "selected"; } ?>>Kristen</option>
                    <option value="Katholik" <?php if($data['agama'] == 'Katholik') { echo "selected"; } ?>>Katholik</option>
                    <option value="Hindu" <?php if($data['agama'] == 'Hindu') { echo "selected"; } ?>>Hindu</option>
                    <option value="Budha" <?php if($data['agama'] == 'Budha') { echo "selected"; } ?>>Budha</option>
                    <option value="Konghucu" <?php if($data['agama'] == 'Konghucu') { echo "selected"; } ?>>Konghucu</option>
                </select>
                Nama Ayah* : <input type="text" name="nama_ayah" value="<?php echo $data['nama_ayah']; ?>" class="form-control" required />
                Nama Ibu* : <input type="text" name="nama_ibu" value="<?php echo $data['nama_ibu']; ?>" class="form-control" required />
                Nomor Telepon : <input type="text" name="no_telp" value="<?php echo $data['no_telp']; ?>" class="form-control" />
                Email : <input type="email" name="email" value="<?php echo $data['email']; ?>" class="form-control" />
                Alamat* : <textarea name="alamat" class="form-control" rows="3" required><?php echo $data['alamat']; ?></textarea>
                Kelas :
                <select name="kelas" class="form-control" required>
                    <?php
                    if(!isset($data['id_kelas'])) { ?>
                        <option value="">- Pilih -</option>
                    <?php
                    } else { ?>
                        <option value="<?php echo $data['id_kelas']; ?>"><?php echo $data['nama_kelas']; ?></option>
                    <?php
                    } ?>
                    <?php
                    $sql_kelas = mysqli_query($db, "SELECT * from tb_kelas") or die ($db->error);
                    while($data_kelas = mysqli_fetch_array($sql_kelas)) {
                        if($data['id_kelas'] != $data_kelas['id_kelas']) {
                            echo '<option value="'.$data_kelas['id_kelas'].'">'.$data_kelas['nama_kelas'].'</option>';
                        }
                    } ?>
                </select>
                Tahun Masuk :
                <select name="thn_masuk" class="form-control" required>
                    <?php
                    if(!isset($data['thn_masuk'])) { ?>
                        <option value="">- Pilih -</option>
                    <?php
                    } else { ?>
                        <option value="<?php echo $data['thn_masuk']; ?>"><?php echo $data['thn_masuk']; ?></option>
                    <?php
                    } ?>
                    <?php
                    for ($i = 2020; $i >= 2000; $i--) {
                        if($data['thn_masuk'] != $i) {
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    } ?>
                </select>
                Foto : <br /><img src="../img/foto_siswa/<?php echo $data['foto']; ?>" width="150px" style="margin-bottom:5px;" /><input type="file" name="gambar" class="form-control" />
                Username* : <input type="text" name="user" value="<?php echo $data['username']; ?>" class="form-control" required />
                Password* : <input type="text" name="pass" value="<?php echo $data['pass']; ?>" class="form-control" required />
                <hr />
                <input type="submit" name="simpan" value="Simpan" class="btn btn-info" />
                <input type="reset" class="btn btn-danger" />
            </form>
            <?php
            if(@$_POST['simpan']) {
                $nama_lengkap = @mysqli_real_escape_string($db, $_POST['nama_lengkap']);
                $tempat_lahir = @mysqli_real_escape_string($db, $_POST['tempat_lahir']);
                $tgl_lahir = @mysqli_real_escape_string($db, $_POST['tgl_lahir']);
                $jenis_kelamin = @mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
                $agama = @mysqli_real_escape_string($db, $_POST['agama']);
                $nama_ayah = @mysqli_real_escape_string($db, $_POST['nama_ayah']);
                $nama_ibu = @mysqli_real_escape_string($db, $_POST['nama_ibu']);
                $no_telp = @mysqli_real_escape_string($db, $_POST['no_telp']);
                $email = @mysqli_real_escape_string($db, $_POST['email']);
                $alamat = @mysqli_real_escape_string($db, $_POST['alamat']);
                $kelas = @mysqli_real_escape_string($db, $_POST['kelas']);
                $thn_masuk = @mysqli_real_escape_string($db, $_POST['thn_masuk']);
                $user = @mysqli_real_escape_string($db, $_POST['user']);
                $pass = @mysqli_real_escape_string($db, $_POST['pass']);

                $sumber = @$_FILES['gambar']['tmp_name'];
                $target = '../img/foto_siswa/';
                $nama_gambar = @$_FILES['gambar']['name'];

                if($nama_gambar == '') {
                    mysqli_query($db, "UPDATE tb_siswa SET nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', nama_ayah = '$nama_ayah', nama_ibu = '$nama_ibu', no_telp = '$no_telp', email = '$email', alamat = '$alamat', id_kelas = '$kelas', thn_masuk = '$thn_masuk', username = '$user', password = md5('$pass'), pass = '$pass' WHERE id_siswa = '$_GET[IDsiswa]'") or die ($db->error);
                    echo '<script>window.location="?page=siswa&action=detail&IDsiswa='.$_GET[IDsiswa].'";</script>';
                } else {
                    if(move_uploaded_file($sumber, $target.$nama_gambar)) {
                        mysqli_query($db, "UPDATE tb_siswa SET nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', nama_ayah = '$nama_ayah', nama_ibu = '$nama_ibu', no_telp = '$no_telp', email = '$email', alamat = '$alamat', id_kelas = '$kelas', thn_masuk = '$thn_masuk', foto = '$nama_gambar', username = '$user', password = md5('$pass'), pass = '$pass' WHERE id_siswa = '$_GET[IDsiswa]'") or die ($db->error);
                        echo '<script>window.location="?page=siswa&action=detail&IDsiswa='.$_GET[IDsiswa].'";</script>';
                    } else {
                        echo '<script>alert("Gagal mengedit info profil, foto gagal diupload, coba lagi!");</script>';
                    }
                }
            }
            ?>
            </div>
            </div>
        </div>
    </div>
    </div>
<?php
} else if(@$_GET['action'] == 'detail') {
   $sql_siswa_per_id = mysqli_query($db, "
        SELECT a.*,b.nama_kelas
        FROM tb_siswa a
        JOIN tb_kelas b
        ON a.id_kelas = b.id_kelas
        WHERE id_siswa = '$_GET[IDsiswa]'
    ") or die ($db->error);
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
                                <td align="center">:</td>
                                <td><?php echo $data['nama_kelas']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Tahun Masuk</td>
                                <td align="center">:</td>
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
} ?>
