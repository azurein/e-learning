-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 16, 2016 at 01:15 PM
-- Server version: 5.7.13
-- PHP Version: 5.5.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearn_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_lengkap`, `alamat`, `no_telp`, `email`, `username`, `password`, `pass`) VALUES
(1, 'Mohammad Nur Fawaiq', 'Desa Gajahmati Rt:03 Rw:02 Kec. Pati Kab. Pati Jawa Tengah', '085786447406', 'nurfawaiq@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id_berita` int(11) NOT NULL,
  `judul` text NOT NULL,
  `isi` longtext NOT NULL,
  `tgl_posting` date NOT NULL,
  `penerbit` varchar(10) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_berita`
--

INSERT INTO `tb_berita` (`id_berita`, `judul`, `isi`, `tgl_posting`, `penerbit`, `status`) VALUES
(1, 'Cara Belajar Mudah, Menyenangkan dan Efektif', 'Hai teman2. djsdnsjdnsdjnsdsds dsjds dsjdbsds dsdgsduui\r\n\r\nKali ini dsdsjdhsd dsjsdbsd\r\n\r\nkita dksnksd dsjdsjd dsusdgyow9weuwr', '2015-08-15', 'admin', 'aktif'),
(2, 'How to Be Success', 'asdshsuh sdsgdgysgd.\r\n\r\ndfdfdfdfdhfdhfdhfd.\r\nsdsdjd.', '2015-08-16', '1', 'aktif'),
(4, 'Manfaat Menulis', 'Jadi temen2, manfaat menulis ialah bla bla bla.\r\n\r\ndfdhfhdifd fhdudfdf gfudfhudhf.\r\n\r\nfdfjdfjdf d.d\r\nfd\r\nfdfdfdfdf', '2015-08-16', '10', 'tidak aktif'),
(5, 'Kenakalan Remaja (Pencarian Jati Diri)', 'Remaja memang identik dengan nakal, tetapi tidaklah benar jika hanya remaja yang selalu di klaim nakal.\r\n\r\nDi Indonesia ini seperti negeri sandiwara, banyak ahli hukum mencederai hukum, banyak ahli ilmu mencederai ilmu, banyak wakil rakyat yang seharusnya mengemban amanah tetapi mereka malah melakukan KKN.\r\n\r\nApakah mereka remaja ? Tentu bukan, mereka sudah dewasa.', '2015-08-16', 'admin', 'aktif'),
(6, 'The Power of Life', 'The Power of Life jsndjsd sdsdsd sdsyftsas arsduywge rtposfh0a9hqwreb eeuheirer.\r\n\r\ndfdfdfhidf wuuwgyuwwo dsiuhsduishdsds', '2015-08-16', '8', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `id_mapel_ajar` int(11) NOT NULL,
  `judul` varchar(500) DEFAULT NULL,
  `sinopsis` varchar(800) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `edisi` varchar(5) DEFAULT NULL,
  `penulis` varchar(500) DEFAULT NULL,
  `penerbit` varchar(300) DEFAULT NULL,
  `ISBN` int(11) DEFAULT NULL,
  `kutip_hal` varchar(20) DEFAULT NULL,
  `file_buku` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_file_materi`
--

CREATE TABLE `tb_file_materi` (
  `id_materi` int(11) NOT NULL,
  `id_mapel_ajar` int(4) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `nama_file` varchar(250) NOT NULL,
  `tgl_posting` date NOT NULL,
  `pembuat` varchar(10) NOT NULL,
  `hits` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_file_materi`
--

INSERT INTO `tb_file_materi` (`id_materi`, `id_mapel_ajar`, `judul`, `nama_file`, `tgl_posting`, `pembuat`, `hits`) VALUES
(3, 3, 'Modul Latihan', 'Cetak Soal Tryout P1.pdf', '2015-08-15', 'admin', 4),
(4, 1, 'Modul 1', 'kumpulan_soal_20152.pdf', '2015-08-15', '1', 7),
(5, 1, 'Modul 2', '2072-P1-SPK-Rekayasa Perangkat Lunak.doc', '2015-08-15', '1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_ajar`
--

CREATE TABLE `tb_jadwal_ajar` (
  `id_jadwal` int(11) NOT NULL,
  `id_mapel_ajar` int(11) NOT NULL,
  `jadwal_mulai` datetime DEFAULT NULL,
  `jadwal_selesai` datetime DEFAULT NULL,
  `ruang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `id` int(11) NOT NULL,
  `id_tq` int(4) NOT NULL,
  `id_soal` int(4) NOT NULL,
  `id_siswa` int(4) NOT NULL,
  `jawaban` text NOT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`id`, `id_tq`, `id_soal`, `id_siswa`, `jawaban`, `gambar`) VALUES
(17, 11, 19, 15, 'a', 'BlazeChocobo.jpg'),
(18, 11, 20, 15, 'b', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'X-A'),
(2, 'X-B'),
(3, 'X-C'),
(4, 'X-D'),
(15, 'qq'),
(17, 'kelas baru 1'),
(18, 'kelas baru 2'),
(19, 'kelas baru 3'),
(20, 'kelas baru 4'),
(21, 'sd'),
(22, 'baru nie'),
(23, 'baruuu'),
(24, 'kelas wew');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id` int(11) NOT NULL,
  `kode_mapel` varchar(10) NOT NULL,
  `mapel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mapel`
--

INSERT INTO `tb_mapel` (`id`, `kode_mapel`, `mapel`) VALUES
(1, 'A1', 'Bahasa Indonesia'),
(2, 'A2', 'Matematika'),
(3, 'A3', 'Bahasa Inggris'),
(4, 'A4', 'TIK'),
(5, 'A5', 'Olahraga');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mapel_ajar`
--

CREATE TABLE `tb_mapel_ajar` (
  `id` int(11) NOT NULL,
  `id_mapel` int(5) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `id_pengajar` int(5) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mapel_ajar`
--

INSERT INTO `tb_mapel_ajar` (`id`, `id_mapel`, `id_kelas`, `id_pengajar`, `keterangan`, `tgl_mulai`, `tgl_selesai`, `status_aktif`) VALUES
(8, 5, 2, 0, '', '2001-01-01 00:00:00', '2001-01-01 00:00:00', 1),
(10, 3, 17, 10, 'kelas baru', '2010-01-01 00:00:00', '2011-02-02 00:00:00', 0),
(11, 4, 2, 1, 'kelas udah ada sblmnnya', '2016-01-01 00:00:00', '2016-12-12 00:00:00', 1),
(12, 2, 2, 12, 'asd', '2017-01-01 00:00:00', '2017-02-02 00:00:00', 0),
(13, 1, 0, 1, '', '2015-11-11 00:00:00', '2016-02-02 00:00:00', 0),
(14, 1, 0, 1, '', '2015-11-11 00:00:00', '2016-02-02 00:00:00', 0),
(15, 1, 0, 1, 'sad', '2016-01-01 00:00:00', '2017-01-01 00:00:00', 0),
(19, 1, 17, 1, '', '1992-01-01 00:00:00', '1992-02-02 00:00:00', 0),
(20, 1, 18, 1, '123', '1992-01-01 00:00:00', '1992-01-01 00:00:00', 1),
(23, 1, 1, 1, 'asd', '2001-01-01 00:00:00', '2001-01-01 00:00:00', 0),
(24, 3, 22, 1, '', '0001-01-01 00:00:00', '0001-01-01 00:00:00', 1),
(25, 3, 2, 8, 'wew', '1991-01-01 00:00:00', '1992-01-01 00:00:00', 0),
(27, 1, 24, 0, '', '2001-01-01 00:00:00', '2001-01-01 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_essay`
--

CREATE TABLE `tb_nilai_essay` (
  `id` int(11) NOT NULL,
  `id_tq` int(5) NOT NULL,
  `id_siswa` int(5) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai_essay`
--

INSERT INTO `tb_nilai_essay` (`id`, `id_tq`, `id_siswa`, `nilai`) VALUES
(1, 11, 15, 75);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_pilgan`
--

CREATE TABLE `tb_nilai_pilgan` (
  `id` int(11) NOT NULL,
  `id_tq` int(4) NOT NULL,
  `id_siswa` int(4) NOT NULL,
  `benar` int(4) NOT NULL,
  `salah` int(4) NOT NULL,
  `tidak_dikerjakan` int(4) NOT NULL,
  `presentase` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_nilai_pilgan`
--

INSERT INTO `tb_nilai_pilgan` (`id`, `id_tq`, `id_siswa`, `benar`, `salah`, `tidak_dikerjakan`, `presentase`) VALUES
(39, 11, 15, 1, 0, 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengajar`
--

CREATE TABLE `tb_pengajar` (
  `id_pengajar` int(11) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `web` varchar(60) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengajar`
--

INSERT INTO `tb_pengajar` (`id_pengajar`, `nip`, `nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `no_telp`, `email`, `alamat`, `jabatan`, `foto`, `web`, `username`, `password`, `pass`, `status`) VALUES
(1, '7676656', 'Ahmad', 'Rembang', '1989-06-10', 'L', 'Islam', '0867785365xx', 'hhuh@hd.vom', 'Rembang, Indonesia', 'Guru', '11539603_672029272928710_5015884061222980920_n.jpg', 'http://ilmu-lengkap.com', 'ahmad', '61243c7b9a4022cb3f8dc3106767ed12', 'ahmad', 'aktif'),
(8, '123', 'Ubab', 'Rembang', '2015-07-03', 'L', 'Islam', '87857565', '', 'Rembang', 'Guru', 'anonim.png', '', 'ubab', '1e71f0128a74222155076585a012cbde', 'ubab', 'aktif'),
(10, '274378434', 'Jajal', 'London', '1990-07-18', 'P', 'Islam', '089676778xx', 'jajal@yahoo.com', 'London, English', 'Guru', 'anonim.png', '', 'jajal', '0ce39f78d16cab3888366d5f4f5485eb', 'jajal', 'tidak aktif'),
(11, '898', 'Mbuh', 'Jepara', '2015-07-15', 'P', 'Katholik', '98993', '', 'Jepara', 'Guru', 'anonim.png', '', 'mbuh', '4cb3a57aafa5238fb25202ac75f6944f', 'mbuh', 'aktif'),
(12, '878', 'Mpok', 'Jakarat', '2015-07-25', 'P', 'Kristen', '7676', '', 'Jakarta', 'Guru', 'anonim.png', '', 'mpok', 'f9cfa808be96e05153f43ee98c51e7cf', 'mpok', 'aktif'),
(13, '67', 'nnnn', 'jjn', '2015-07-17', 'P', 'Hindu', '76676', '', 'jhjh', 'Guru', 'anonim.png', '', 'bb', '21ad0bd836b90d08f4cf640b4c298e7c', 'bb', 'aktif'),
(14, '77989', 'Lee Min Ho', 'Korea', '1990-07-16', 'L', 'Konghucu', '089681898xxx', 'leeminho@yahoo.com', 'Seoul, Korea', 'Guru Bahasa Korea', '10672295_1463699220608256_6533316162177641215_n.jpg', 'http://ilmu-lengkap.com', 'lee', 'b0f8b49f22c718e9924f5b1165111a67', 'lee', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sertifikasi`
--

CREATE TABLE `tb_sertifikasi` (
  `id_sertifikasi` int(11) NOT NULL,
  `id_mapel_ajar` int(11) NOT NULL,
  `nama_sertifikasi` varchar(200) DEFAULT NULL,
  `deskripsi_sertifikasi` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `id_kelas` varchar(5) DEFAULT NULL,
  `thn_masuk` int(5) DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nis`, `nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `nama_ayah`, `nama_ibu`, `no_telp`, `email`, `alamat`, `id_kelas`, `thn_masuk`, `foto`, `username`, `password`, `pass`, `status`) VALUES
(14, '1608000006', 'Melisa Aryani', 'Jakarta', '1992-11-11', 'P', 'Kristen', 'Ayah Melisa', 'Ibu Melisa', '08999999999', 'melisaaryani@gmail.com', 'Taman Palem Lestari Blok A7 No.14', NULL, 2016, 'MelisaAryani.jpg', 'melisa', '207bc608101a56a807388a7e5ef1343a', 'aryani', 'tidak aktif'),
(15, '1608000007', 'Robin Cosamas', 'Jakarta', '1992-11-06', 'L', 'Katholik', 'Ayah Robin', 'Ibu Robin', '+628988360025', 'robin.cosamas@gmail.com', 'Jalan Kamal Raya No. 40, RT.001 - RW.006, Tegal Alur, Kalideres', '2', 2016, 'CalvinKvvan.jpg', 'robin', '8ee60a2e00c90d7e00d5069188dc115b', 'robin', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa_ajar`
--

CREATE TABLE `tb_siswa_ajar` (
  `id_siswa` int(11) NOT NULL,
  `id_mapel_ajar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal_essay`
--

CREATE TABLE `tb_soal_essay` (
  `id_essay` int(11) NOT NULL,
  `id_tq` int(5) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tgl_buat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_soal_essay`
--

INSERT INTO `tb_soal_essay` (`id_essay`, `id_tq`, `pertanyaan`, `gambar`, `tgl_buat`) VALUES
(19, 11, 'a', '', '2016-09-06'),
(20, 11, 'b', '', '2016-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soal_pilgan`
--

CREATE TABLE `tb_soal_pilgan` (
  `id_pilgan` int(11) NOT NULL,
  `id_tq` int(5) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `pil_a` text NOT NULL,
  `pil_b` text NOT NULL,
  `pil_c` text NOT NULL,
  `pil_d` text NOT NULL,
  `pil_e` text NOT NULL,
  `kunci` varchar(2) NOT NULL,
  `tgl_buat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_soal_pilgan`
--

INSERT INTO `tb_soal_pilgan` (`id_pilgan`, `id_tq`, `pertanyaan`, `gambar`, `pil_a`, `pil_b`, `pil_c`, `pil_d`, `pil_e`, `kunci`, `tgl_buat`) VALUES
(14, 11, 'a', '', 'a', 'a', 'a', 'a', 'a', 'A', '2016-09-06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_topik_quiz`
--

CREATE TABLE `tb_topik_quiz` (
  `id_tq` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `id_mapel` int(5) NOT NULL,
  `tgl_buat` date NOT NULL,
  `pembuat` varchar(10) NOT NULL,
  `waktu_soal` int(8) NOT NULL,
  `info` varchar(250) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_topik_quiz`
--

INSERT INTO `tb_topik_quiz` (`id_tq`, `judul`, `id_kelas`, `id_mapel`, `tgl_buat`, `pembuat`, `waktu_soal`, `info`, `status`) VALUES
(11, 'pg essay', 2, 5, '2016-09-06', 'admin', 2340, 'asd', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tujuan_ajar`
--

CREATE TABLE `tb_tujuan_ajar` (
  `id_tujuan_ajar` int(11) NOT NULL,
  `id_mapel_ajar` int(11) NOT NULL,
  `tujuan_ajar` varchar(500) DEFAULT NULL,
  `prioritas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tb_file_materi`
--
ALTER TABLE `tb_file_materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `tb_jadwal_ajar`
--
ALTER TABLE `tb_jadwal_ajar`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mapel_ajar`
--
ALTER TABLE `tb_mapel_ajar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_nilai_essay`
--
ALTER TABLE `tb_nilai_essay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_nilai_pilgan`
--
ALTER TABLE `tb_nilai_pilgan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengajar`
--
ALTER TABLE `tb_pengajar`
  ADD PRIMARY KEY (`id_pengajar`);

--
-- Indexes for table `tb_sertifikasi`
--
ALTER TABLE `tb_sertifikasi`
  ADD PRIMARY KEY (`id_sertifikasi`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tb_siswa_ajar`
--
ALTER TABLE `tb_siswa_ajar`
  ADD PRIMARY KEY (`id_siswa`,`id_mapel_ajar`);

--
-- Indexes for table `tb_soal_essay`
--
ALTER TABLE `tb_soal_essay`
  ADD PRIMARY KEY (`id_essay`);

--
-- Indexes for table `tb_soal_pilgan`
--
ALTER TABLE `tb_soal_pilgan`
  ADD PRIMARY KEY (`id_pilgan`);

--
-- Indexes for table `tb_topik_quiz`
--
ALTER TABLE `tb_topik_quiz`
  ADD PRIMARY KEY (`id_tq`);

--
-- Indexes for table `tb_tujuan_ajar`
--
ALTER TABLE `tb_tujuan_ajar`
  ADD PRIMARY KEY (`id_tujuan_ajar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_file_materi`
--
ALTER TABLE `tb_file_materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_mapel_ajar`
--
ALTER TABLE `tb_mapel_ajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tb_nilai_essay`
--
ALTER TABLE `tb_nilai_essay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_nilai_pilgan`
--
ALTER TABLE `tb_nilai_pilgan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `tb_pengajar`
--
ALTER TABLE `tb_pengajar`
  MODIFY `id_pengajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tb_sertifikasi`
--
ALTER TABLE `tb_sertifikasi`
  MODIFY `id_sertifikasi` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tb_soal_essay`
--
ALTER TABLE `tb_soal_essay`
  MODIFY `id_essay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tb_soal_pilgan`
--
ALTER TABLE `tb_soal_pilgan`
  MODIFY `id_pilgan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tb_topik_quiz`
--
ALTER TABLE `tb_topik_quiz`
  MODIFY `id_tq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_tujuan_ajar`
--
ALTER TABLE `tb_tujuan_ajar`
  MODIFY `id_tujuan_ajar` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
