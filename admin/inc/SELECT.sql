SELECT 
                        tb_topik_quiz.id_tq,
                        tb_topik_quiz.judul,
                        tb_topik_quiz.id_kelas,
                        tb_topik_quiz.id_mapel,
                        tb_topik_quiz.tgl_buat,
                        tb_topik_quiz.pembuat,
                        tb_topik_quiz.waktu_soal,
                        tb_topik_quiz.info,
                        tb_topik_quiz.status,
                        tb_jawaban.id_soal,
                        tb_jawaban.id_siswa,
                        tb_jawaban.jawaban,
                        tb_siswa.nis,
                        tb_siswa.nama_lengkap,
                        tb_nilai_pilgan.benar,
                        tb_nilai_pilgan.salah,
                        tb_nilai_pilgan.tidak_dikerjakan,
                        tb_nilai_pilgan.presentase,
                        tb_nilai_essay.nilai as 'nilai_essay',
                        tb_kelas.nama_kelas,
                        tb_kelas.ruang,
                        tb_kelas.wali_kelas,
                        tb_kelas.ketua_kelas

						FROM tb_topik_quiz
                        
                        JOIN tb_jawaban
                        ON tb_jawaban.id_tq = tb_topik_quiz.id_tq
                        
                        JOIN tb_siswa 
                        ON tb_jawaban.id_siswa = tb_siswa.id_siswa

                        LEFT JOIN tb_nilai_pilgan 
                        ON tb_jawaban.id_tq = tb_nilai_pilgan.id_tq
                        AND tb_siswa.id_siswa = tb_nilai_pilgan.id_siswa

                        LEFT JOIN tb_nilai_essay
                        ON tb_jawaban.id_tq = tb_nilai_essay.id_tq 
                        AND tb_siswa.id_siswa = tb_nilai_essay.id_siswa

                        JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas 

                        WHERE tb_topik_quiz.status like 'aktif'
                        AND tb_topik_quiz.id_tq = '6'