<div class="row">
    <div class="col-md-12">
        <h1 class="page-header"><?php if(@$_SESSION['admin']) echo "Manajemen "; ?>Kelas</h1>
    </div>
</div>

<?php
$pengajar = "";
if (@$_SESSION['pengajar']) {
    $pengajar = "WHERE tb_mapel_ajar.id_pengajar = '$_SESSION[pengajar]'";
}
$sql_kelas = mysqli_query($db, "
    SELECT
    tb_mapel_ajar.id,
    tb_mapel_ajar.id_kelas,
    nama_kelas,
    tb_mapel_ajar.id_mapel,
    kode_mapel,
    mapel,
    tb_mapel_ajar.id_pengajar,
    COALESCE(nama_lengkap, '') AS nama_lengkap,
    tgl_mulai,
    tgl_selesai,
    status_aktif

    FROM tb_mapel_ajar

    JOIN tb_kelas
    ON tb_kelas.id_kelas = tb_mapel_ajar.id_kelas

    JOIN tb_mapel
    ON tb_mapel_ajar.id_mapel = tb_mapel.id

    LEFT JOIN tb_pengajar
    ON tb_pengajar.id_pengajar = tb_mapel_ajar.id_pengajar

    ".$pengajar."

    ORDER BY tgl_mulai DESC
") or die ($db->error);

$no = 1;

echo '<div class="row">';
if(@$_GET['action'] == '') { ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Data Kelas &nbsp;
                <?php
                if(@$_SESSION['admin']) {
                    echo '<a href="?page=kelas&action=tambah" class="btn btn-primary btn-sm">Tambah Data</a> &nbsp;';
                }
                ?>
                <a href="./laporan/cetak.php?data=kelas" target="_blank" class="btn btn-default btn-sm">Cetak</a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="datakelas">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kelas</th>
                                <th>Mata Pelajaran</th>
                                <?php
                                if(@$_SESSION['admin']) {
                                    echo "<th>Pengajar</th>";
                                }
                                ?>
                                <th>Periode</th>
                                <th>Opsi</th>
                                <?php
                                if(@$_SESSION['admin']) {
                                    echo "<th>Outline</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($data_kelas = mysqli_fetch_array($sql_kelas)) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data_kelas['nama_kelas']; ?></td>
                                <td><?php echo $data_kelas['kode_mapel']." - ".$data_kelas['mapel']; ?></td>
                                <?php
                                if(@$_SESSION['admin']) {
                                    if($data_kelas['id_pengajar'] != 0) {
                                        echo "<td>".$data_kelas['nama_lengkap']."</td>";
                                    } else {
                                        echo "<td><i>Belum diatur</i></td>";
                                    }
                                }
                                ?>
                                <td>
                                <?php
                                if(@$_SESSION['admin']) {
                                    echo tgl_indo($data_kelas['tgl_mulai'])."<br>s/d<br>".tgl_indo($data_kelas['tgl_mulai']);
                                } elseif(@$_SESSION['pengajar']) {
                                    echo tgl_indo($data_kelas['tgl_mulai'])." s/d ".tgl_indo($data_kelas['tgl_mulai']);
                                }
                                ?>
                                </td>
                                <td align="center" width="200px">
                                    <?php
                                    if(@$_SESSION['admin']) {
                                    ?>
                                        <a href="?page=kelas&action=edit&id=<?php echo $data_kelas['id']; ?>" class="btn btn-warning btn-xs">Edit</a>
                                        <a onclick="return confirm('Yakin akan menghapus kelas?');" href="?page=kelas&action=hapus&id=<?php echo $data_kelas['id']; ?>" class="btn btn-danger btn-xs">Hapus</a>
                                        <?php
                                        if ($data_kelas['status_aktif']) { ?>
                                            <a onclick="return confirm('Yakin akan non aktifkan kelas?');" href="?page=kelas&action=nonaktifkan&id=<?php echo $data_kelas['id']; ?>" class="btn btn-primary btn-xs">Non Aktifkan</a>
                                        <?php
                                        } else { ?>
                                            <a onclick="return confirm('Yakin akan aktifkan kelas?');" href="?page=kelas&action=aktifkan&id=<?php echo $data_kelas['id']; ?>" class="btn btn-success btn-xs">Aktifkan</a>
                                        <?php
                                        }
                                    }
                                    ?>
                                    <a href="?page=kelas&action=daftar_siswa&id=<?php echo $data_kelas['id']; ?>" class="btn btn-default btn-xs">Daftar Siswa</a>
                                </td>
                                <?php
                                if(@$_SESSION['admin']) {
                                ?>
                                    <td align="center" width="200px">
                                        <a href="?page=kelas&action=buatoutline&id=<?php echo $data_kelas['id']; ?>" class="btn btn-default btn-xs">Buat</a>
                                        <a href="?page=kelas&action=copyoutline&id=<?php echo $data_kelas['id']; ?>" class="btn btn-default btn-xs">Copy</a><br>
                                        <a href="?page=kelas&action=daftaroutline&id=<?php echo $data_kelas['id']; ?>" class="btn btn-default btn-xs">Daftar Outline</a>
                                    </td>
                                <?php
                                }
                            } ?>
                            </tr>
                        </tbody>
                    </table>
                    <script>
                    $(document).ready(function () {
                        $('#datakelas').dataTable();
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php
} else if(@$_GET['action'] == 'tambah') { ?>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Tambah Data Kelas &nbsp; <a href="?page=kelas" class="btn btn-warning btn-sm">Kembali</a></div>
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <label><input type="radio" name="kelas_type" onclick="$('#nama_kelas_txt').prop('disabled', false); $('#nama_kelas_ddl').prop('disabled', true);" checked> Nama Kelas *</label>
                        <input id="nama_kelas_txt" type="text" name="nama_kelas_txt" class="form-control" value="<?php if(isset($_POST['nama_kelas_txt'])) echo $_POST['nama_kelas_txt']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label><input type="radio" name="kelas_type"  onclick="$('#nama_kelas_txt').prop('disabled', true); $('#nama_kelas_ddl').prop('disabled', false);"> Pilih Kelas</label>
                        <select id="nama_kelas_ddl" name="nama_kelas_ddl" class="form-control" disabled>
                            <?php
                            $sql_kelas_ddl = mysqli_query($db, "SELECT * FROM tb_kelas ORDER BY nama_kelas") or die ($db->error);
                            while($data_kelas_ddl = mysqli_fetch_array($sql_kelas_ddl)) {
                                $compare_kelas = "0";
                                if(isset($_POST['nama_kelas_ddl'])) {
                                    $compare_kelas = $_POST['nama_kelas_ddl'];
                                }

                                if($data_kelas_ddl['id_kelas'] == $compare_kelas) {
                                    echo '<option selected value="'.$data_kelas_ddl['id_kelas'].'">'.$data_kelas_ddl['nama_kelas'].'</option>';
                                } else {
                                    echo '<option value="'.$data_kelas_ddl['id_kelas'].'">'.$data_kelas_ddl['nama_kelas'].'</option>';
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mata Pelajaran</label>
                        <select name="mata_pelajaran" class="form-control" value="<?php if(isset($_POST['mata_pelajaran'])) echo $_POST['mata_pelajaran']; ?>">
                            <?php
                            $sql_mapel = mysqli_query($db, "SELECT * FROM tb_mapel ORDER BY mapel") or die ($db->error);
                            while($data_mapel = mysqli_fetch_array($sql_mapel)) {
                                $compare_mapel = "0";
                                if(isset($_POST['mata_pelajaran'])) {
                                    $compare_mapel = $_POST['mata_pelajaran'];
                                }

                                if($data_mapel['id'] == $compare_mapel) {
                                    echo '<option selected value="'.$data_mapel['id'].'">'.$data_mapel['kode_mapel'].' - '.$data_mapel['mapel'].'</option>';
                                } else {
                                    echo '<option value="'.$data_mapel['id'].'">'.$data_mapel['kode_mapel'].' - '.$data_mapel['mapel'].'</option>';
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pengajar</label>
                        <select name="pengajar" class="form-control" value="<?php if(isset($_POST['pengajar'])) echo $_POST['pengajar']; ?>">
                            <option value="0">Belum diatur</option>
                            <?php
                            $sql_guru = mysqli_query($db, "SELECT * FROM tb_pengajar") or die ($db->error);
                            while($data_guru = mysqli_fetch_array($sql_guru)) {
                                $compare_pengajar = "0";
                                if(isset($_POST['pengajar'])) {
                                    $compare_pengajar = $_POST['pengajar'];
                                }

                                if($data_guru['id_pengajar'] == $compare_pengajar) {
                                    echo '<option selected value="'.$data_guru['id_pengajar'].'">'.$data_guru['nama_lengkap'].'</option>';
                                } else {
                                    echo '<option value="'.$data_guru['id_pengajar'].'">'.$data_guru['nama_lengkap'].'</option>';
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="keterangan" rows="4" cols="40" class="form-control"><?php if(isset($_POST['keterangan'])) echo $_POST['keterangan']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Mulai</label>
                        <input type="date" name="tgl_mulai" class="form-control" value="<?php if(isset($_POST['tgl_mulai'])) echo $_POST['tgl_mulai']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Selesai</label>
                        <input type="date" name="tgl_selesai" class="form-control" value="<?php if(isset($_POST['tgl_selesai'])) echo $_POST['tgl_selesai']; ?>" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                        <input type="reset" value="Reset" class="btn btn-danger" />
                    </div>
                </form>
                <?php
                if(@$_POST['simpan']) {
                    $nama_kelas = @mysqli_real_escape_string($db, $_POST['nama_kelas_txt']);
                    $id_kelas = @mysqli_real_escape_string($db, $_POST['nama_kelas_ddl']);
                    $id_mapel = @mysqli_real_escape_string($db, $_POST['mata_pelajaran']);
                    $id_pengajar = @mysqli_real_escape_string($db, $_POST['pengajar']);
                    $keterangan = @mysqli_real_escape_string($db, $_POST['keterangan']);
                    $tgl_mulai = @mysqli_real_escape_string($db, $_POST['tgl_mulai']);
                    $tgl_selesai = @mysqli_real_escape_string($db, $_POST['tgl_selesai']);

                    $tgl_mulai = $tgl_mulai == '' ? '01-01-0001' : $tgl_mulai;
                    $tgl_selesai = $tgl_selesai == '' ? '01-01-0001' : $tgl_selesai;

                    if($nama_kelas != "") {
                        mysqli_query($db, "INSERT INTO tb_kelas(nama_kelas) SELECT '$nama_kelas' WHERE NOT EXISTS (SELECT nama_kelas FROM tb_kelas WHERE nama_kelas LIKE '$nama_kelas')") or die ($db->error);
                        if(mysqli_insert_id($db) != 0) {
                            $id_kelas = mysqli_insert_id($db);
                        } else {
                            $sql_per_kelas = tampil_per_id("tb_kelas", "nama_kelas = '$nama_kelas'");
                            $data_per_kelas = mysqli_fetch_array($sql_per_kelas);
                            $id_kelas = $data_per_kelas['id_kelas'];
                        }
                    }
                    mysqli_query($db, "
                        INSERT INTO tb_mapel_ajar(id_kelas, id_mapel, id_pengajar, keterangan, tgl_mulai, tgl_selesai, status_aktif)
                        SELECT
                        '$id_kelas',
                        '$id_mapel',
                        '$id_pengajar',
                        '$keterangan',
                        '$tgl_mulai',
                        '$tgl_selesai',
                        0
                        WHERE NOT EXISTS (
                        SELECT id FROM tb_mapel_ajar WHERE id_kelas LIKE '$id_kelas' AND id_mapel LIKE '$id_mapel'
                        )
                    ") or die ($db->error);
                    if(mysqli_insert_id($db) != 0) {
                        echo "<script>window.location='?page=kelas';</script>";
                    } else {
                        echo "<div class='alert alert-danger'><strong>Kelas baru gagal disimpan!</strong> Kombinasi Kelas dan Mata Pelajaran tersebut sudah tersedia.</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
} else if(@$_GET['action'] == 'edit') {
    $sql_kelas_perid = mysqli_query($db, "
        SELECT
        tb_mapel_ajar.id,
        tb_mapel_ajar.id_kelas,
        nama_kelas,
        tb_mapel_ajar.id_mapel,
        kode_mapel,
        mapel,
        tb_mapel_ajar.id_pengajar,
        COALESCE(nama_lengkap, '') AS nama_lengkap,
        keterangan,
        tgl_mulai,
        tgl_selesai,
        status_aktif

        FROM tb_mapel_ajar

        JOIN tb_kelas
        ON tb_kelas.id_kelas = tb_mapel_ajar.id_kelas

        JOIN tb_mapel
        ON tb_mapel_ajar.id_mapel = tb_mapel.id

        LEFT JOIN tb_pengajar
        ON tb_pengajar.id_pengajar = tb_mapel_ajar.id_pengajar

        WHERE tb_mapel_ajar.id = '$_GET[id]'
    ") or die ($db->error);
    $data_kelas_perid = mysqli_fetch_array($sql_kelas_perid);

    date_default_timezone_set('Asia/Jakarta');
    $tgl_mulai_perid = date("Y-m-d", strtotime($data_kelas_perid['tgl_mulai']));
    $tgl_selesai_perid = date("Y-m-d", strtotime($data_kelas_perid['tgl_selesai']));
?>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Edit Data Kelas &nbsp; <a href="?page=kelas" class="btn btn-warning btn-sm">Kembali</a></div>
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <label>Nama Kelas: <?php echo $data_kelas_perid['nama_kelas']; ?>, Mata Pelajaran: <?php echo $data_kelas_perid['mapel']; ?></label>
                    </div>
                    <div class="form-group">
                        <label>Pengajar</label>
                        <select name="pengajar" class="form-control" value="<?php if(isset($_POST['pengajar'])) echo $_POST['pengajar']; ?>">
                            <option value="0">Belum diatur</option>
                            <?php
                            $sql_guru = mysqli_query($db, "SELECT * FROM tb_pengajar") or die ($db->error);
                            while($data_guru = mysqli_fetch_array($sql_guru)) {
                                $compare_pengajar = $data_kelas_perid['id_pengajar'];
                                if(isset($_POST['pengajar'])) {
                                    $compare_pengajar = $_POST['pengajar'];
                                }

                                if($data_guru['id_pengajar'] == $compare_pengajar) {
                                    echo '<option selected value="'.$data_guru['id_pengajar'].'">'.$data_guru['nama_lengkap'].'</option>';
                                } else {
                                    echo '<option value="'.$data_guru['id_pengajar'].'">'.$data_guru['nama_lengkap'].'</option>';
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="keterangan" rows="4" cols="40" class="form-control"><?php if(isset($_POST['keterangan'])) echo $_POST['keterangan']; else echo $data_kelas_perid['keterangan']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Mulai</label>
                        <input type="date" id="tgl_mulai" name="tgl_mulai" class="form-control" value="<?php if(isset($_POST['tgl_mulai'])) echo $_POST['tgl_mulai']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Selesai</label>
                        <input type="date" id="tgl_selesai" name="tgl_selesai" class="form-control" value="<?php if(isset($_POST['tgl_selesai'])) echo $_POST['tgl_selesai']; ?>" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                        <input type="reset" value="Reset" class="btn btn-danger" />
                    </div>
                    <?php echo '<script>document.getElementById("tgl_mulai").value = "'.$tgl_mulai_perid.'"; document.getElementById("tgl_selesai").value = "'.$tgl_selesai_perid.'";</script>'; ?>
                </form>
                <?php
                if(@$_POST['simpan']) {
                    $id_pengajar = @mysqli_real_escape_string($db, $_POST['pengajar']);
                    $keterangan = @mysqli_real_escape_string($db, $_POST['keterangan']);
                    $tgl_mulai = @mysqli_real_escape_string($db, $_POST['tgl_mulai']);
                    $tgl_selesai = @mysqli_real_escape_string($db, $_POST['tgl_selesai']);

                    $tgl_mulai = $tgl_mulai == '' ? '01-01-0001' : $tgl_mulai;
                    $tgl_selesai = $tgl_selesai == '' ? '01-01-0001' : $tgl_selesai;

                    $nama_kelas = @mysqli_real_escape_string($db, $_POST['nama_kelas']);
                    mysqli_query($db, "UPDATE tb_mapel_ajar SET id_pengajar = '$id_pengajar', keterangan = '$keterangan', tgl_mulai = '$tgl_mulai', tgl_selesai = '$tgl_selesai' WHERE id = '$_GET[id]'") or die ($db->error);
                    echo "<script>window.location='?page=kelas';</script>";
                }
                ?>
            </div>
        </div>
    </div>
<?php
} else if(@$_GET['action'] == 'daftar_siswa') { ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Data Siswa &nbsp; <a href="?page=kelas" class="btn btn-warning btn-sm">Kembali</a></div>
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="datasiswa">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;"><input type="checkbox" id="checkAll"></th>
                                        <th>NIS</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>TTL</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql_siswa = mysqli_query($db, "
                                    SELECT
                                    tb_siswa.id_siswa,
                                    tb_siswa.nis,
                                    tb_siswa.nama_lengkap,
                                    tb_siswa.tempat_lahir,
                                    tb_siswa.tgl_lahir,
                                    tb_siswa.jenis_kelamin,
                                    tb_siswa.alamat,
                                    COALESCE(tb_jadwal_siswa.id_siswa, 0) as isChecked

                                    FROM tb_siswa

                                    LEFT JOIN tb_jadwal_siswa
                                    ON tb_siswa.id_siswa = tb_jadwal_siswa.id_siswa

                                    WHERE status LIKE 'aktif'
                                ") or die ($db->error);

    	                        while($data_siswa = mysqli_fetch_array($sql_siswa)) {
                                    if($data_siswa['jenis_kelamin'] == 'L') {
                                        $gender_persiswa = 'Laki-laki';
                                    } else {
                                        $gender_persiswa = 'Perempuan';
                                    }
                                ?>
    	                            <tr>
    	                                <td align="center"><input <?php if($data_siswa['isChecked'] != 0) echo "checked"; ?> type="checkbox" name="listsiswa[]" value="<?php echo $data_siswa['id_siswa']; ?>"></td>
    	                                <td><?php echo $data_siswa['nis']; ?></td>
    	                                <td><?php echo $data_siswa['nama_lengkap']; ?></td>
    	                                <td><?php echo $gender_persiswa; ?></td>
                                        <td><?php echo $data_siswa['tempat_lahir'].", ".tgl_indo($data_siswa['tgl_lahir']); ?></td>
    	                                <td><?php echo $data_siswa['alamat']; ?></td>
    	                            </tr>
    	                        <?php
    		                    } ?>
                                </tbody>
                            </table>
                            <script>
                            $(document).ready(function () {
                                $('#datasiswa').dataTable();
                                $('#checkAll').change(function(){
                                    $('input[type=checkbox]').prop('checked',$('#checkAll').prop('checked'));
                                });
                            });
                            </script>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                    </div>
                </form>
                <?php
                if(@$_POST['simpan']) {
                    mysqli_query($db, "DELETE FROM tb_jadwal_siswa WHERE id_mapel_ajar = '$_GET[id]'");
                    if(!empty($_POST['listsiswa'])) {
                        foreach($_POST['listsiswa'] as $idsiswa) {
                            mysqli_query($db, "INSERT INTO tb_jadwal_siswa (id_mapel_ajar, id_siswa) VALUES ('$_GET[id]', '$idsiswa')");
                        }
                    }
                    echo "<script>window.location='?page=kelas';</script>";
                }
                ?>
            </div>
        </div>
    </div>
<?php
} else if(@$_GET['action'] == 'hapus') {
    mysqli_query($db, "DELETE FROM tb_mapel_ajar WHERE id = '$_GET[id]'") or die ($db->error);
    echo "<script>window.location='?page=kelas';</script>";
} else if(@$_GET['action'] == 'nonaktifkan') {
    mysqli_query($db, "UPDATE tb_mapel_ajar SET status_aktif = 0 WHERE id = '$_GET[id]'") or die ($db->error);
    echo "<script>window.location='?page=kelas';</script>";
} else if(@$_GET['action'] == 'aktifkan') {
    mysqli_query($db, "UPDATE tb_mapel_ajar SET status_aktif = 1 WHERE id = '$_GET[id]'") or die ($db->error);
    echo "<script>window.location='?page=kelas';</script>";
} else if(@$_GET['action'] == 'buatoutline') {
    include "buat_outline.php";
} else if(@$_GET['action'] == 'copyoutline') {
    include "copy_outline.php";
} else if(@$_GET['action'] == 'daftaroutline') {
    include "daftar_outline.php";
}
echo "</div>";
