
    <?php
    $sql_siswa = mysqli_query($db, "SELECT * FROM tb_siswa WHERE id_siswa = '$_SESSION[siswa]'") or die ($db->error);
    $data = mysqli_fetch_array($sql_siswa);

    if($_GET['page'] == 'profile') { ?>

    <div class="form-clean">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 form-container">
                <h2>Profil Saya &nbsp; <a href="?page=edit_profile" class="btn btn-warning btn-sm">Edit</a></h2><hr>
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
                            <td>Foto</td>
                            <td>:</td>
                            <td><img src="./img/foto_siswa/<?php echo $data['foto']; ?>" width="200px" /></td>
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
    <?php
    } else if($_GET['page'] == 'edit_profile') { ?>

        <div class="form-clean">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 form-container">
                    <h2>Edit Profil &nbsp; <a href="?page=profile" class="btn btn-warning btn-sm">Kembali</a></h2><hr>
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
                        Foto : <br /><img src="./img/foto_siswa/<?php echo $data['foto']; ?>" width="150px" style="margin-bottom:5px;" /><input type="file" name="gambar" class="form-control" />
                        Username* : <input type="text" name="user" value="<?php echo $data['username']; ?>" class="form-control" required />
                        Password* : <input type="text" name="pass" value="<?php echo $data['pass']; ?>" class="form-control" required />
                        <hr />
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
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
                        $user = @mysqli_real_escape_string($db, $_POST['user']);
                        $pass = @mysqli_real_escape_string($db, $_POST['pass']);

                        $sumber = @$_FILES['gambar']['tmp_name'];
                        $target = 'img/foto_siswa/';
                        $nama_gambar = @$_FILES['gambar']['name'];

                        if($nama_gambar == '') {
                            mysqli_query($db, "UPDATE tb_siswa SET nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', nama_ayah = '$nama_ayah', nama_ibu = '$nama_ibu', no_telp = '$no_telp', email = '$email', alamat = '$alamat', username = '$user', password = md5('$pass'), pass = '$pass' WHERE id_siswa = '$_SESSION[siswa]'") or die ($db->error);
                            echo '<script>window.location="?page=profile";</script>';
                        } else {
                            if(move_uploaded_file($sumber, $target.$nama_gambar)) {
                                mysqli_query($db, "UPDATE tb_siswa SET nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', nama_ayah = '$nama_ayah', nama_ibu = '$nama_ibu', no_telp = '$no_telp', email = '$email', alamat = '$alamat', foto = '$nama_gambar', username = '$user', password = md5('$pass'), pass = '$pass' WHERE id_siswa = '$_SESSION[siswa]'") or die ($db->error);
                                echo '<script>window.location="?page=profile";</script>';
                            } else {
                                echo '<script>alert("Gagal mengedit info profil, foto gagal diupload, coba lagi!");</script>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    } ?>
