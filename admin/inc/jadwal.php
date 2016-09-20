<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Manajemen Jadwal</h1>
    </div>
</div>

<?php

if(@$_SESSION[admin]) {

    echo '<div class="row">';
    if(@$_GET['action'] == '') { ?>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="?page=jadwal&action=tambah" class="btn btn-primary btn-sm">Tambah Data</a> &nbsp; <a href="./laporan/cetak.php?data=mapel" target="_blank" class="btn btn-default btn-sm">Cetak</a></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="datajadwal">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Mapel</th>
                                    <th>Kelas</th>
                                    <th>Jam</th>
                                    <th>Ruang</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_jadwal = mysqli_query($db, "
                                SELECT
                                id_jadwal,
                                tanggal,
                                kode_mapel,
                                mapel,
                                nama_kelas,
                                jam_mulai,
                                jam_selesai,
                                ruang

                                FROM tb_jadwal_ajar

                                JOIN tb_mapel_ajar
                                ON tb_jadwal_ajar.id_mapel_ajar = tb_mapel_ajar.id

                                JOIN tb_mapel
                                ON tb_mapel_ajar.id_mapel = tb_mapel.id

                                JOIN tb_kelas
                                ON tb_mapel_ajar.id_kelas = tb_kelas.id_kelas

                                ORDER BY tanggal, jam_mulai, jam_selesai, mapel
                            ") or die ($db->error);
                            if(mysqli_num_rows($sql_jadwal) > 0) {
	                            while($data_jadwal = mysqli_fetch_array($sql_jadwal)) { ?>
	                                <tr>
                                        <td><?php echo tgl_indo($data_jadwal['tanggal']); ?></td>
	                                    <td><?php echo $data_jadwal['kode_mapel']; ?> - <?php echo $data_jadwal['mapel']; ?></td>
	                                    <td><?php echo $data_jadwal['nama_kelas']; ?></td>
                                        <td><?php echo substr($data_jadwal['jam_mulai'],0,5); ?> - <?php echo substr($data_jadwal['jam_selesai'],0,5); ?></td>
                                        <td><?php echo $data_jadwal['ruang']; ?></td>
                                        <td align="center" width="150px">
	                                        <a href="?page=jadwal&action=edit&id=<?php echo $data_jadwal['id_jadwal']; ?>" class="btn btn-warning btn-xs">Edit</a>
	                                        <a onclick="return confirm('Yakin akan menghapus data?');" href="?page=jadwal&action=hapus&id=<?php echo $data_jadwal['id_jadwal']; ?>" class="btn btn-danger btn-xs">Hapus</a>
	                                    </td>
	                                </tr>
	                            <?php
	                            }
                            } else {
                            	echo '<td colspan="4" align="center">Tidak ada data</td>';
                        	} ?>
                            </tbody>
                        </table>
                        <script>
                        $(document).ready(function () {
                            $('#datajadwal').dataTable();
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
                <div class="panel-heading">Tambah Data Jadwal &nbsp; <a href="?page=jadwal" class="btn btn-warning btn-sm">Kembali</a></div>
                <div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Mata Pelajaran - Kelas</label>
                            <select id="mapelkelas_ddl" name="mapelkelas_ddl" class="form-control">
                            <?php
                            $sql_mapelkelas_ddl = mysqli_query($db, "
                                SELECT
                                tb_mapel_ajar.id as id_mapel_ajar,
                                tb_mapel_ajar.id_mapel,
                                nama_kelas,
                                kode_mapel,
                                mapel

                                FROM tb_mapel_ajar

                                JOIN tb_mapel
                                ON tb_mapel_ajar.id_mapel = tb_mapel.id

                                JOIN tb_kelas
                                ON tb_mapel_ajar.id_kelas = tb_kelas.id_kelas

                                ORDER BY mapel, nama_kelas
                            ") or die ($db->error);
                            while($data_mapelkelas_ddl = mysqli_fetch_array($sql_mapelkelas_ddl)) {
                                echo '<option value="'.$data_mapelkelas_ddl['id_mapel_ajar'].'">'.$data_mapelkelas_ddl['kode_mapel'].' '.$data_mapelkelas_ddl['mapel'].' / '.$data_mapelkelas_ddl['nama_kelas'].'</option>';
                            } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal_date" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Jam Mulai</label>
                            <input type="time" name="jam_mulai_time" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Jam Selesai</label>
                            <input type="time" name="jam_selesai_time" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Ruang</label>
                            <input type="text" name="ruang_text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                            <input type="reset" value="Reset" class="btn btn-danger" />
                        </div>
                    </form>
                    <?php
                    if(@$_POST['simpan']) {
                        $id_mapel_ajar = @mysqli_real_escape_string($db, $_POST['mapelkelas_ddl']);
                        $tanggal = @mysqli_real_escape_string($db, $_POST['tanggal_date']);
                        $jam_mulai = @mysqli_real_escape_string($db, $_POST['jam_mulai_time']);
                        $jam_selesai = @mysqli_real_escape_string($db, $_POST['jam_selesai_time']);
                        $ruang = @mysqli_real_escape_string($db, $_POST['ruang_text']);

                        $tanggal = $tanggal == '' ? '01-01-0001' : $tanggal;
                        $jam_mulai = $jam_mulai == '' ? '00:00:00' : $jam_mulai;
                        $jam_selesai = $jam_selesai == '' ? '00:00:00' : $jam_selesai;

                        mysqli_query($db, "
                            INSERT INTO tb_jadwal_ajar (id_mapel_ajar, tanggal, jam_mulai, jam_selesai, ruang)
                            VALUES('$id_mapel_ajar', '$tanggal', '$jam_mulai', '$jam_selesai', '$ruang')
                        ") or die ($db->error);
                        echo "<script>window.location='?page=jadwal';</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else if(@$_GET['action'] == 'edit') {
        $sql_jadwal_perid = mysqli_query($db, "
            SELECT
            id_jadwal,
            tanggal,
            kode_mapel,
            mapel,
            nama_kelas,
            jam_mulai,
            jam_selesai,
            ruang

            FROM tb_jadwal_ajar

            JOIN tb_mapel_ajar
            ON tb_jadwal_ajar.id_mapel_ajar = tb_mapel_ajar.id

            JOIN tb_mapel
            ON tb_mapel_ajar.id_mapel = tb_mapel.id

            JOIN tb_kelas
            ON tb_mapel_ajar.id_kelas = tb_kelas.id_kelas

            WHERE tb_jadwal_ajar.id_jadwal = '$_GET[id]'

            ORDER BY tanggal, jam_mulai, jam_selesai, mapel
        ") or die ($db->error);
        $data_jadwal_perid = mysqli_fetch_array($sql_jadwal_perid);
    ?>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Data Mata Pelajaran &nbsp; <a href="?page=jadwal" class="btn btn-warning btn-sm">Kembali</a></div>
                <div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Mata Pelajaran - Kelas :
                            <?php
                            $sql_mapelkelas_ddl = mysqli_query($db, "
                                SELECT
                                tb_mapel_ajar.id as id_mapel_ajar,
                                tb_mapel_ajar.id_mapel,
                                nama_kelas,
                                kode_mapel,
                                mapel

                                FROM tb_jadwal_ajar

                                JOIN tb_mapel_ajar
                                ON tb_jadwal_ajar.id_mapel_ajar = tb_mapel_ajar.id

                                JOIN tb_mapel
                                ON tb_mapel_ajar.id_mapel = tb_mapel.id

                                JOIN tb_kelas
                                ON tb_mapel_ajar.id_kelas = tb_kelas.id_kelas

                                WHERE id_jadwal = '$_GET[id]'

                                ORDER BY mapel, nama_kelas
                            ") or die ($db->error);
                            while($data_mapelkelas_ddl = mysqli_fetch_array($sql_mapelkelas_ddl)) {
                                echo $data_mapelkelas_ddl['kode_mapel'].' '.$data_mapelkelas_ddl['mapel'].' / '.$data_mapelkelas_ddl['nama_kelas'];
                            } ?>
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal_date" class="form-control" value="<?php if(isset($_POST['tanggal'])) echo $_POST['tanggal']; else $data_jadwal_perid['tanggal']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Jam Mulai</label>
                            <input type="time" name="jam_mulai_time" class="form-control" value="<?php if(isset($_POST['jam_mulai'])) echo $_POST['jam_mulai']; else $data_jadwal_perid['jam_mulai']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Jam Selesai</label>
                            <input type="time" name="jam_selesai_time" class="form-control" value="<?php if(isset($_POST['jam_selesai'])) echo $_POST['jam_selesai']; else $data_jadwal_perid['jam_selesai']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Ruang</label>
                            <input type="text" name="ruang_text" class="form-control" value="<?php if(isset($_POST['ruang'])) echo $_POST['ruang']; else $data_jadwal_perid['ruang']; ?>" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
                            <input type="reset" value="Reset" class="btn btn-danger" />
                        </div>
                    </form>
                    <?php
                    if(@$_POST['simpan']) {
                        $tanggal = @mysqli_real_escape_string($db, $_POST['tanggal_date']);
                        $jam_mulai = @mysqli_real_escape_string($db, $_POST['jam_mulai_time']);
                        $jam_selesai = @mysqli_real_escape_string($db, $_POST['jam_selesai_time']);
                        $ruang = @mysqli_real_escape_string($db, $_POST['ruang_text']);

                        $tanggal = $tanggal == '' ? '01-01-0001' : $tanggal;
                        $jam_mulai = $jam_mulai == '' ? '00:00:00' : $jam_mulai;
                        $jam_selesai = $jam_selesai == '' ? '00:00:00' : $jam_selesai;

                        mysqli_query($db, "UPDATE tb_jadwal_ajar SET tanggal = '$tanggal', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai', ruang = '$ruang'  WHERE id_jadwal = '$id'") or die ($db->error);
                        echo "<script>window.location='?page=jadwal';</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else if(@$_GET['action'] == 'hapus') {
        mysqli_query($db, "DELETE FROM tb_jadwal_ajar WHERE id_jadwal = '$_GET[id]'") or die ($db->error);
        echo "<script>window.location='?page=jadwal';</script>";
    }
    echo "</div>";
} ?>
