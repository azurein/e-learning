

    <div class="form-clean">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 form-container">
                <form method="post" enctype="multipart/form-data">
                    <h2>Form Pendaftaran</h2><hr>
                    <div class="form-group">Nama Lengkap* : <input type="text" name="nama_lengkap" class="form-control" required /></div>
                    <div class="form-group">Tempat Lahir* : <input type="text" name="tempat_lahir" class="form-control" required /></div>
                    <div class="form-group">Tanggal Lahir* : <input type="date" name="tgl_lahir" class="form-control" required /></div>
                    <div class="form-group">
                        Jenis Kelamin* :
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        Agama* :
                        <select name="agama" class="form-control" required>
                            <option value="">- Pilih -</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katholik">Katholik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                    <div class="form-group">Nama Ayah* : <input type="text" name="nama_ayah" class="form-control" required /></div>
                    <div class="form-group">Nama Ibu* : <input type="text" name="nama_ibu" class="form-control" required /></div>
                    <div class="form-group">Nomor Telepon : <input type="text" name="no_telp" class="form-control" /></div>
                    <div class="form-group">Email : <input type="email" name="email" class="form-control" /></div>
                    <div class="form-group">Alamat* : <textarea name="alamat" class="form-control" rows="3" required></textarea></div>
                    <div class="form-group">Foto : <input type="file" name="gambar" class="form-control" /></div>
                    <div class="form-group">Username* : <input type="text" name="user" class="form-control" autocomplete="new-username" required /></div>
                    <div class="form-group">Password* : <input type="password" name="pass" class="form-control" autocomplete="new-password" required /></div>
                    <br />
                    <i><b>Catatan</b> : Tanda * wajib disi</i>
                    <hr />
                    <div class="form-group">
                        <button type="submit" name="daftar" value="Daftar" class="btn btn-success">Submit Form</button>
                        <button type="reset" name="daftar" value="Daftar" class="btn btn-danger">Reset Form</button>
                    </div>
                </form>

                <?php
                if(@$_POST['daftar']) {
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
                $user = @mysqli_real_escape_string($db, $_POST['user']);
                $pass = @mysqli_real_escape_string($db, $_POST['pass']);

                $sumber = @$_FILES['gambar']['tmp_name'];
                $target = 'img/foto_siswa/';
                $nama_gambar = @$_FILES['gambar']['name'];

                $sql_generate_nis = mysqli_query($db, "
                    SELECT IF(
                        (SELECT DISTINCT 1=1 FROM tb_siswa WHERE LEFT(nis,4) = DATE_FORMAT(NOW(),'%y%m')),
                        (SELECT MAX(nis)+1 FROM tb_siswa),
                        CONCAT(DATE_FORMAT(NOW(),'%y%m'),'000001')) as nis
                    ");

                $nis = mysqli_fetch_array($sql_generate_nis)[0];

                $sql_cek_user = mysqli_query($db, "SELECT * FROM tb_siswa WHERE username = '$user'") or die ($db->error);
                if(mysqli_num_rows($sql_cek_user) > 0) {
                    echo "<script>alert('Username yang Anda pilih sudah ada, silahkan ganti yang lain');</script>";
                } else {
                    if($nama_gambar != '') {
                        if(move_uploaded_file($sumber, $target.$nama_gambar)) {
                            mysqli_query($db,
                                "INSERT INTO tb_siswa VALUES(0, $nis, '$nama_lengkap', '$tempat_lahir', '$tgl_lahir', '$jenis_kelamin',
                                '$agama', '$nama_ayah', '$nama_ibu', '$no_telp', '$email', '$alamat', NULL, YEAR(NOW()), '$nama_gambar',
                                '$user', md5('$pass'), '$pass', 'tidak aktif')"
                            ) or die ($db->error);
                            echo '<script>alert("Pendaftaran berhasil, tunggu akun aktif dan silahkan login"); window.location="./"</script>';
                        } else {
                            echo '<script>alert("Gagal mendaftar, foto gagal diupload, coba lagi!");</script>';
                        }
                    } else {
                        mysqli_query($db,
                            "INSERT INTO tb_siswa VALUES(0, '$nis', '$nama_lengkap', '$tempat_lahir', '$tgl_lahir', '$jenis_kelamin',
                            '$agama', '$nama_ayah', '$nama_ibu', '$no_telp', '$email', '$alamat', NULL, YEAR(NOW()), 'anonim.png',
                            '$user', md5('$pass'), '$pass', 'tidak aktif')"
                        ) or die ($db->error);
                        echo '<script>alert("Pendaftaran berhasil, tunggu akun aktif dan silahkan login"); window.location="./"</script>';
                    }
                }
                }
                ?>
            </div>
        </div>
    </div>
