
    <div class="form-clean">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 form-container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Jadwal</h2><hr>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Informasi Jadwal Kelas Anda</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        	<table class="table table-striped table-bordered table-hover">
                                <thead>
                            		<tr>
                                        <th>#</th>
                            			<th>Tanggal</th>
                            			<th>Mata Pelajaran</th>
                                        <th>Kelas</th>
                            			<th>Jam</th>
                            			<th>Ruang</th>
                            		</tr>
                                </thead>
                                <tbody>
                        		<?php
                                $no = 1;
                                $condition = "";
                                if($_GET['id'] > 0) {
                                    $condition = "AND tb_mapel_ajar.id_mapel = $_GET[id]";
                                }
                                $sql_jadwal = mysqli_query($db, "
                                    SELECT DISTINCT
                                    id_jadwal,
                                    tanggal,
                                    kode_mapel,
                                    mapel,
                                    nama_kelas,
                                    jam_mulai,
                                    jam_selesai,
                                    ruang

                                    FROM tb_jadwal_ajar

                                    JOIN tb_jadwal_siswa
                                    ON tb_jadwal_ajar.id_mapel_ajar = tb_jadwal_siswa.id_mapel_ajar

                                    JOIN tb_mapel_ajar
                                    ON tb_jadwal_ajar.id_mapel_ajar = tb_mapel_ajar.id

                                    JOIN tb_mapel
                                    ON tb_mapel_ajar.id_mapel = tb_mapel.id

                                    JOIN tb_kelas
                                    ON tb_mapel_ajar.id_kelas = tb_kelas.id_kelas

                                    WHERE tb_jadwal_siswa.id_siswa = '$_SESSION[siswa]'
                                    ".$condition."

                                    ORDER BY tanggal, jam_mulai, jam_selesai, mapel DESC
                                ") or die ($db->error);

                                while($data_jadwal = mysqli_fetch_array($sql_jadwal)) { ?>
                                    <tr>
                                        <td width="25px" align="center"><?php echo $no++; ?></td>
                                        <td><?php echo tgl_indo($data_jadwal['tanggal']); ?></td>
                                        <td><?php echo $data_jadwal['kode_mapel']; ?> - <?php echo $data_jadwal['mapel']; ?></td>
                                        <td><?php echo $data_jadwal['nama_kelas']; ?></td>
                                        <td><?php echo substr($data_jadwal['jam_mulai'],0,5); ?> - <?php echo substr($data_jadwal['jam_selesai'],0,5); ?></td>
                                        <td><?php echo $data_jadwal['ruang']; ?></td>
                                        <?php
                                        if(@$_SESSION['admin']) {
                                        ?>
                                            <td align="center" width="150px">
                                                <a href="?page=jadwal&action=edit&id=<?php echo $data_jadwal['id_jadwal']; ?>" class="btn btn-warning btn-xs">Edit</a>
                                                <a onclick="return confirm('Yakin akan menghapus data?');" href="?page=jadwal&action=hapus&id=<?php echo $data_jadwal['id_jadwal']; ?>" class="btn btn-danger btn-xs">Hapus</a>
                                            </td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                <?php
                                } ?>
                                </tbody>
                            </table>
                       	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
