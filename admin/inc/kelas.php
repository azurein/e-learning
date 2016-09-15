<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Manajemen Kelas</h1>
    </div>
</div>

<?php
$id = @$_GET['id'];
$sql_per_id = mysqli_query($db, "SELECT * FROM tb_kelas WHERE id_kelas = '$id'") or die ($db->error);
$data = mysqli_fetch_array($sql_per_id);

$sql_kelas = mysqli_query($db, "
    SELECT
    tb_kelas.id_kelas,
    nama_kelas,
    id_mapel,
    kode_mapel,
    mapel,
    id_pengajar,
    tgl_mulai,
    tgl_selesai,
    status_aktif

    FROM tb_kelas

    JOIN tb_mapel_ajar
    ON tb_kelas.id_kelas = tb_mapel_ajar.id_kelas

    JOIN tb_mapel
    ON tb_mapel_ajar.id_mapel = tb_mapel.id
") or die ($db->error);
$no = 1;

if(@$_SESSION[admin]) {

    echo '<div class="row">';
    if(@$_GET['action'] == '') { ?>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="?page=kelas&action=tambah" class="btn btn-primary btn-sm">Tambah Data</a> &nbsp; <a href="./laporan/cetak.php?data=kelas" target="_blank" class="btn btn-default btn-sm">Cetak</a></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kelas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Pengajar</th>
                                    <th>Waktu</th>
                                    <th>Opsi</th>
                                    <th>Outline</th>
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
                                    $sql_tampil_guru = tampil_per_id("tb_pengajar", "id_pengajar = '$data_kelas[id_pengajar]'");
                                    $data_tampil_guru = mysqli_fetch_array($sql_tampil_guru);
                                    $cek_tampil_guru = mysqli_num_rows($sql_tampil_guru);
                                    if($cek_tampil_guru > 0) {
                                        echo "<td>".$data_tampil_guru['nama_lengkap']."</td>";
                                    } else {
                                        echo "<td><i>Belum diatur</i></td>";
                                    }

                                    date_default_timezone_set('Asia/Jakarta');
                                    $formattedDate = date("d M Y", strtotime($data_kelas['tgl_mulai']))." s/d<br>".(date("d M Y", strtotime($data_kelas['tgl_selesai'])));
                                    echo "<td>".$formattedDate."</td>";

                                    ?>
                                    <td align="center" width="200px">
                                        <a href="?page=kelas&action=edit&id=<?php echo $data_kelas['id_kelas']; ?>" class="btn btn-warning btn-xs">Edit</a>
                                        <a onclick="return confirm('Yakin akan menghapus kelas?');" href="?page=kelas&action=hapus&id_kelas=<?php echo $data_kelas['id_kelas']; ?>&id_mapel=<?php echo $data_kelas['id_mapel'] ?>" class="btn btn-danger btn-xs">Hapus</a>
                                        <?php
                                        if ($data_kelas['status_aktif']) { ?>
                                            <a onclick="return confirm('Yakin akan non aktifkan kelas?');" href="?page=kelas&action=nonaktifkan&id_kelas=<?php echo $data_kelas['id_kelas']; ?>&id_mapel=<?php echo $data_kelas['id_mapel'] ?>" class="btn btn-primary btn-xs">Non Aktifkan</a>
                                        <?php
                                        } else { ?>
                                            <a onclick="return confirm('Yakin akan aktifkan kelas?');" href="?page=kelas&action=aktifkan&id_kelas=<?php echo $data_kelas['id_kelas']; ?>&id_mapel=<?php echo $data_kelas['id_mapel'] ?>" class="btn btn-success btn-xs">Aktifkan</a>
                                        <?php
                                        } ?>
                                        <a href="?page=kelas&IDkelas=<?php echo $data_kelas['id_kelas']; ?>&kelas=<?php echo $data_kelas['nama_kelas']; ?>" class="btn btn-default btn-xs">Daftar Siswa</a>
                                    </td>
                                    <td align="center" width="200px">
                                        <a href="?page=kelas&action=buatoutline&kelas=<?php echo $data_kelas['id_kelas']; ?>&mapel=<?php echo $data_kelas['id_mapel']; ?>" class="btn btn-default btn-xs">Buat</a>
                                        <a href="?page=kelas&action=copyoutline" class="btn btn-default btn-xs">Copy</a><br>
                                        <a href="?page=kelas&action=daftaroutline&kelas=<?php echo $data_kelas['id_kelas']; ?>&mapel=<?php echo $data_kelas['id_mapel']; ?>" class="btn btn-default btn-xs">Daftar Outline</a>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                            </tbody>
                        </table>
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
                            <input id="nama_kelas_txt" type="text" name="nama_kelas_txt" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label><input type="radio" name="kelas_type"  onclick="$('#nama_kelas_txt').prop('disabled', true); $('#nama_kelas_ddl').prop('disabled', false);"> Pilih Kelas</label>
                            <select id="nama_kelas_ddl" name="nama_kelas_ddl" class="form-control" disabled>
                                <?php
                                $sql_guru = mysqli_query($db, "SELECT * FROM tb_kelas ORDER BY nama_kelas") or die ($db->error);
                                while($data_guru = mysqli_fetch_array($sql_guru)) {
                                    echo '<option value="'.$data_guru['id_kelas'].'">'.$data_guru['nama_kelas'].'</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <select name="mata_pelajaran" class="form-control">
                                <?php
                                $sql_mapel = mysqli_query($db, "SELECT * FROM tb_mapel ORDER BY mapel") or die ($db->error);
                                while($data_mapel = mysqli_fetch_array($sql_mapel)) {
                                    echo '<option value="'.$data_mapel['id'].'">'.$data_mapel['kode_mapel'].' - '.$data_mapel['mapel'].'</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pengajar</label>
                            <select name="pengajar" class="form-control">
                                <?php
                                $sql2 = tampil_per_id("tb_pengajar", "id_pengajar = '$data[id_pengajar]'");
                                $data2 = mysqli_fetch_array($sql2);
                                if(mysqli_num_rows($sql2) > 0) {
                                    echo '<option value="'.$data2['id_pengajar'].'">'.$data2['nama_lengkap'].'</option>';
                                }

                                $sql_guru = mysqli_query($db, "SELECT * FROM tb_pengajar") or die ($db->error);
                                while($data_guru = mysqli_fetch_array($sql_guru)) {
                                    echo '<option value="'.$data_guru['id_pengajar'].'">'.$data_guru['nama_lengkap'].'</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="keterangan" rows="4" cols="40" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Mulai</label>
                            <input type="date" name="tgl_mulai" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Selesai</label>
                            <input type="date" name="tgl_selesai" class="form-control" />
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

                        if($nama_kelas != "") {
                            mysqli_query($db, "INSERT INTO tb_kelas(nama_kelas) VALUES('$nama_kelas')") or die ($db->error);
                            $id_kelas = mysqli_insert_id($db);
                        }

                        mysqli_query($db, "INSERT INTO tb_mapel_ajar(id_kelas, id_mapel, id_pengajar, keterangan, tgl_mulai, tgl_selesai, status_aktif) VALUES('$id_kelas', '$id_mapel', '$id_pengajar', '$keterangan', '$tgl_mulai', '$tgl_selesai', 0)") or die ($db->error);
                        echo "<script>window.location='?page=kelas';</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else if(@$_GET['action'] == 'edit') { ?>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Data Kelas &nbsp; <a href="?page=kelas" class="btn btn-warning btn-sm">Kembali</a></div>
                <div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Nama Kelas *</label>
                            <input type="text" name="nama_kelas" value="<?php echo $data['nama_kelas']; ?>" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Pengajar</label>
                            <select name="pengajar" class="form-control">
                                <?php
                                $sql2 = tampil_per_id("tb_pengajar", "id_pengajar = '$data[id_pengajar]'");
                                $data2 = mysqli_fetch_array($sql2);
                                if(mysqli_num_rows($sql2) > 0) {
                                    echo '<option value="'.$data2['id_pengajar'].'">'.$data2['nama_lengkap'].'</option>';
                                    echo '<option value="">- Pilih -</option>';
                                } else {
                                    echo '<option value="">- Pilih -</option>';
                                }

                                $sql_guru = mysqli_query($db, "SELECT * FROM tb_pengajar") or die ($db->error);
                                while($data_guru = mysqli_fetch_array($sql_guru)) {
                                    echo '<option value="'.$data_guru['id_pengajar'].'">'.$data_guru['nama_lengkap'].'</option>';
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
                        $nama_kelas = @mysqli_real_escape_string($db, $_POST['nama_kelas']);
                        mysqli_query($db, "UPDATE tb_kelas SET nama_kelas = '$nama_kelas'  WHERE id_kelas = '$id'") or die ($db->error);
                        echo "<script>window.location='?page=kelas';</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    } else if(@$_GET['action'] == 'hapus') {
        mysqli_query($db, "DELETE FROM tb_mapel_ajar WHERE id_kelas = '$_GET[id_kelas]' AND id_mapel = '$_GET[id_mapel]'") or die ($db->error);
        echo "<script>window.location='?page=kelas';</script>";
    } else if(@$_GET['action'] == 'nonaktifkan') {
        mysqli_query($db, "UPDATE tb_mapel_ajar SET status_aktif = 0 WHERE id_kelas = '$_GET[id_kelas]' AND id_mapel = '$_GET[id_mapel]'") or die ($db->error);
        echo "<script>window.location='?page=kelas';</script>";
    } else if(@$_GET['action'] == 'aktifkan') {
        mysqli_query($db, "UPDATE tb_mapel_ajar SET status_aktif = 1 WHERE id_kelas = '$_GET[id_kelas]' AND id_mapel = '$_GET[id_mapel]'") or die ($db->error);
        echo "<script>window.location='?page=kelas';</script>";
    } else if(@$_GET['action'] == 'buatoutline') {
        include "buat_outline.php";
    } else if(@$_GET['action'] == 'copyoutline') {
        echo "copy";
    } else if(@$_GET['action'] == 'daftaroutline') {
        include "daftar_outline.php";
    }
    echo "</div>";
}
