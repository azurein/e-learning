-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2016 at 02:49 PM
-- Server version: 5.7.13
-- PHP Version: 5.6.24

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
(1, 'Robin', 'Jalan Pondok Kopi', '08999999999', 'robin.cosamas@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin');

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
(1, 'SEMINAR TAX AMNESTY – KUPAS TUNTAS TENTANG PENGAMPUNAN PAJAK', 'KUPAS TUNTAS TENTANG PENGAMPUNAN PAJAK DAN SIMULASI PENGISIAN FORMULIR PENGAMPUNAN PAJAK BAGI WAJIB PAJAK PRIBADI   WAKTU & TEMPAT: JUMAT, 29 JULI 2016 08.30 – 16.30 WIB HOTEL MERLYNN PARK.', '2016-09-28', 'admin', 'aktif'),
(3, 'berita 1', 'test', '2016-10-21', 'admin', 'aktif'),
(4, 'asd', 'asd', '2016-10-26', '16', 'aktif');

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
  `ISBN` varchar(100) DEFAULT NULL,
  `kutip_hal` varchar(20) DEFAULT NULL,
  `file_buku` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `id_mapel_ajar`, `judul`, `sinopsis`, `tahun`, `edisi`, `penulis`, `penerbit`, `ISBN`, `kutip_hal`, `file_buku`) VALUES
(1, 35, 'Pengenalan Tax Amnesty', 'Buku ini membahas dasar tax amnesty', 2016, '1', 'Sri Mul', 'Gramedia', '25990023156566', 'Seluruh chapter', 'Handout-Materi-Amnesti-Pajak.pdf'),
(2, 38, 'Pengenalan Perpajakan Dasar', 'Buku ini membahas Perpajakan Dasar', 2016, '1', 'Sri Mul', 'Gramedia', '25990023156566', 'Seluruh chapter', 'Handout-Materi-Tax-Intro.pdf'),
(3, 39, 'Pengenalan Tax Management', 'Buku ini membahas dasar tax Management', 2016, '1', 'Sri Mul', 'Gramedia', '25990023156566', 'Seluruh chapter', 'Handout-Materi-Tax-Management.pdf'),
(4, 40, 'buku pajak', 'a', 2000, '1', 'feb', 'rbn', '121920812901829018', 'hal 10-20', 'Handout-Materi-Tax-Management.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tb_file_materi`
--

CREATE TABLE `tb_file_materi` (
  `id_materi` int(11) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `id_mapel` int(5) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `nama_file` varchar(250) NOT NULL,
  `tgl_posting` date NOT NULL,
  `pembuat` varchar(10) NOT NULL,
  `hits` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_file_materi`
--

INSERT INTO `tb_file_materi` (`id_materi`, `id_kelas`, `id_mapel`, `judul`, `nama_file`, `tgl_posting`, `pembuat`, `hits`) VALUES
(11, 26, 7, 'Pengenalan Tax Amnesty', 'Handout-Materi-Amnesti-Pajak.pdf', '2016-09-28', 'admin', 3),
(12, 26, 8, 'wew', '291Alvaro.jpg', '2016-09-29', 'admin', 0),
(15, 26, 9, 'Pengenalan Tax Amnesty', 'Handout-Materi-Amnesti-Pajak.pdf', '2016-09-28', 'admin', 3),
(18, 28, 10, 'Pengenalan Tax Amnesty', 'Handout-Materi-Amnesti-Pajak.pdf', '2016-09-28', 'admin', 3),
(21, 29, 11, 'materi 1', 'Pengenalan pajak.docx', '2016-10-21', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_ajar`
--

CREATE TABLE `tb_jadwal_ajar` (
  `id_jadwal` int(11) NOT NULL,
  `id_mapel_ajar` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `ruang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_jadwal_ajar`
--

INSERT INTO `tb_jadwal_ajar` (`id_jadwal`, `id_mapel_ajar`, `tanggal`, `jam_mulai`, `jam_selesai`, `ruang`) VALUES
(1, 35, '2016-03-09', '07:30:00', '10:00:00', 'Hall A'),
(2, 35, '2016-01-10', '10:00:00', '12:30:00', 'Hall B'),
(3, 38, '2016-02-10', '05:05:00', '06:06:00', 'asd'),
(4, 39, '2016-02-10', '05:05:00', '06:06:00', 'asd'),
(5, 40, '2016-10-22', '09:00:00', '11:00:00', 'gedung perpajakan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_siswa`
--

CREATE TABLE `tb_jadwal_siswa` (
  `id_mapel_ajar` int(5) NOT NULL,
  `id_siswa` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_jadwal_siswa`
--

INSERT INTO `tb_jadwal_siswa` (`id_mapel_ajar`, `id_siswa`) VALUES
(28, 16),
(29, 16),
(35, 16),
(36, 16),
(38, 16),
(40, 20);

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
(5, 2, 2, 16, 'gak tau', ''),
(6, 2, 1, 16, 'wew', ''),
(7, 4, 4, 16, 'wew', ''),
(8, 4, 3, 16, 'wew', ''),
(20, 7, 6, 20, '', ''),
(21, 7, 7, 20, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_katalog`
--

CREATE TABLE `tb_katalog` (
  `id_katalog` int(11) NOT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `harga` float DEFAULT NULL,
  `nama_file` varchar(250) DEFAULT NULL,
  `tgl_posting` date DEFAULT NULL,
  `hits` int(4) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_katalog`
--

INSERT INTO `tb_katalog` (`id_katalog`, `judul`, `harga`, `nama_file`, `tgl_posting`, `hits`, `jenis`) VALUES
(3, 'buku', 10000000, 'Handout-Materi-Amnesti-Pajak.pdf', '2016-09-29', 0, 'File'),
(4, 'buku 2', 50000, 'amnesti-pajak.jpg', '2016-09-29', 0, 'Gambar'),
(5, 'buku 3', 100000, 'logo-amnesti-pajak.jpg', '2016-09-29', 0, 'Gambar'),
(8, 'katalog', 10000, 'amnesti-pajak.jpg', '2016-10-21', 0, 'Gambar');

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
(26, 'Tax Class A'),
(27, 'zz'),
(28, 'New Class A'),
(29, 'Class2000');

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
(7, 'TAX01', 'Tax Amnesty'),
(9, 'TAX02', 'Introduction to Tax'),
(10, 'TAX03', 'Tax Management'),
(11, 'TAX2000', 'Pengenalan Pajak');

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
(35, 7, 26, 15, 'Kelas Tax Amnesty', '2016-01-08 00:00:00', '2016-03-01 00:00:00', 1),
(36, 8, 26, 0, '', '2001-01-01 00:00:00', '2001-01-01 00:00:00', 1),
(37, 8, 27, 0, '', '2001-01-01 00:00:00', '2001-01-01 00:00:00', 0),
(38, 9, 26, 15, 'Pengenalan dasar-dasar perpajakan', '2016-01-10 00:00:00', '2016-01-12 00:00:00', 1),
(39, 10, 28, 15, 'Pengelolaan pajak perusahaan.', '2016-01-10 00:00:00', '2016-03-01 00:00:00', 1),
(40, 11, 29, 16, 'merupakan kelas pengenalan pajak', '2016-10-20 00:00:00', '2016-10-31 00:00:00', 1);

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
(1, 2, 16, 75),
(2, 4, 16, 75);

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
(3, 2, 16, 1, 1, 0, 50),
(4, 3, 16, 1, 1, 0, 50),
(11, 7, 20, 0, 0, 2, 0);

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
(16, 'NIP0123', 'febrian', 'jkt', '1992-01-01', 'L', 'Katholik', '0212346789', 'a@a.com', 'jalan feb', 'guru pajak', 'anonim.png', 'http://www.feb.com', 'feb', 'd7b85f12bdf36266db695411a654f73f', 'feb', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_quiz_materi`
--

CREATE TABLE `tb_quiz_materi` (
  `id_tq` int(5) NOT NULL,
  `id_materi` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_quiz_materi`
--

INSERT INTO `tb_quiz_materi` (`id_tq`, `id_materi`) VALUES
(2, 11),
(4, 13),
(6, 21);

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

--
-- Dumping data for table `tb_sertifikasi`
--

INSERT INTO `tb_sertifikasi` (`id_sertifikasi`, `id_mapel_ajar`, `nama_sertifikasi`, `deskripsi_sertifikasi`) VALUES
(1, 35, 'Sertifikat Tax Amnesty Indonesia', 'Sertifikat asli tax amnesty Indonesia'),
(2, 38, 'Sertifikat Perpajakan Dasar Indonesia', 'Sertifikat asli Perpajakan Dasar Indonesia'),
(3, 39, 'Sertifikat Tax Management Indonesia', 'Sertifikat asli tax Management Indonesia'),
(4, 40, 'sertifikat pajak resmi', 'test');

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
(20, '1610000002', 'robin', 'jakarta', '1992-01-01', 'L', 'Konghucu', 'ayah robin', 'ibu robin', '08111111111', 'robin@gmail.com', 'jalan rbn', NULL, 2016, 'anonim.png', 'robin', '8ee60a2e00c90d7e00d5069188dc115b', 'robin', 'aktif'),
(21, '1610000003', 'bunga', 'jkt', '1992-01-01', 'P', 'Islam', 'ayah bunga', 'ibu bunga', '021987654321', 'bunga@gmail.com', 'jalan rumah bunga', NULL, 2016, 'anonim.png', 'bunga', '80219675a4b4f2bb1fa1e48fe8397f30', 'bunga', 'aktif');

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
(1, 2, 'Berdasarkan (1)... disebutkan bahwa Pemotong PPh Pasal 21 dan/atau PPh Pasal 26 harus memberikan bukti pemotongan PPh Pasal 21 atas penghasilan yang diterima atau diperoleh Pegawai Tetap atau (2)... berkala paling lama 1 (satu) bulan setelah tahun kalender berakhir. Dalam hal Pegawai Tetap berhenti bekerja sebelum bulan (3)..., bukti pemotongan PPh Pasal 21 harus diberikan paling lama 1 (satu) bulan setelah yang bersangkutan berhenti bekerja.\r\n\r\nLengkapi peraturan diatas!', '', '2016-09-28'),
(2, 2, 'Jelaskan yang anda ketahui tentang logo Tax Amnesty 2016! ', 'logo-amnesti-pajak.jpg', '2016-09-28'),
(3, 4, 'a', '', '2016-09-29'),
(4, 4, 'b', '', '2016-09-29'),
(6, 7, 'essay 1', '', '2016-10-21'),
(7, 7, 'essay 2', '', '2016-10-21');

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
(3, 2, 'Batas waktu bagi pemotong PPh Pasal 21 untuk memberikan bukti pemotongan Pasal 21 atas penghasilan yang diterima atau diperoleh pegawai tetap adalah', '', 'Paling lama 1 (satu) minggu setelah tahun kalender berakhir atau setelah yang bersangkutan berhenti bekerja', 'Paling lama 2 (dua) minggu setelah tahun kalender berakhir atau setelah yang bersangkutan berhenti bekerja', 'Paling lama 3 (tiga) minggu setelah tahun kalender berakhir atau setelah yang bersangkutan berhenti bekerja', 'Paling lama 1 (satu) bulan setelah tahun kalender berakhir atau setelah yang bersangkutan berhenti bekerja', 'Semua benar', 'D', '2016-09-28'),
(4, 2, 'Dibawah ini adalah slogan tax amnesty, pilih salah satu yang tidak benar?', 'amnesti-pajak.jpg', 'Ungkap', 'Tebus', 'Lega', 'Semua jawaban diatas benar', 'Semua jawaban diatas salah', 'E', '2016-09-28'),
(5, 3, 'a', '', '1', '2', '3', '4', '5', 'A', '2016-09-29'),
(6, 3, 'b', '', '1', '2', '3', '4', '5', 'B', '2016-09-29'),
(10, 7, 'pg 1', '', 'a', 'b', 'c', 'd', 'e', 'A', '2016-10-21'),
(11, 7, 'pg 2', '', 'a', 'b', 'c', 'd', 'e', 'A', '2016-10-21');

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
(2, 'Ujian Tax Amnesty', 26, 7, '2016-09-28', 'admin', 6000, 'Ujian Tax Amnesty gelombang 1', 'aktif'),
(3, 'PG saja', 26, 7, '2016-09-29', 'admin', 600, 'Pilihan Ganda saja', 'aktif'),
(4, 'Essay saja', 26, 7, '2016-09-29', 'admin', 600, 'Essay saja', 'aktif'),
(7, 'tugas 1', 29, 11, '2016-10-21', 'admin', 60, 'kerjakan dengan serius', 'aktif');

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
-- Dumping data for table `tb_tujuan_ajar`
--

INSERT INTO `tb_tujuan_ajar` (`id_tujuan_ajar`, `id_mapel_ajar`, `tujuan_ajar`, `prioritas`) VALUES
(1, 35, 'Mengenal Tax Amnesty', 1),
(2, 35, 'Dapat menyelesaikan urusan Tax Amnesty', 2),
(3, 38, 'Mengenal Perpajakan Dasar', 1),
(4, 38, 'Dapat menyelesaikan urusan Perpajakan Dasar', 2),
(6, 39, 'Mengenal Tax Management', 1),
(7, 39, 'Dapat menyelesaikan urusan Tax Management', 2),
(8, 40, 'siswa dapat mengenal pajak', 1),
(9, 40, 'siap terjun ke dunia kerja', 2);

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
-- Indexes for table `tb_jadwal_siswa`
--
ALTER TABLE `tb_jadwal_siswa`
  ADD PRIMARY KEY (`id_mapel_ajar`,`id_siswa`);

--
-- Indexes for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_katalog`
--
ALTER TABLE `tb_katalog`
  ADD PRIMARY KEY (`id_katalog`);

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
-- Indexes for table `tb_quiz_materi`
--
ALTER TABLE `tb_quiz_materi`
  ADD PRIMARY KEY (`id_tq`,`id_materi`);

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
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_file_materi`
--
ALTER TABLE `tb_file_materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tb_jadwal_ajar`
--
ALTER TABLE `tb_jadwal_ajar`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tb_katalog`
--
ALTER TABLE `tb_katalog`
  MODIFY `id_katalog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_mapel_ajar`
--
ALTER TABLE `tb_mapel_ajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `tb_nilai_essay`
--
ALTER TABLE `tb_nilai_essay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_nilai_pilgan`
--
ALTER TABLE `tb_nilai_pilgan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_pengajar`
--
ALTER TABLE `tb_pengajar`
  MODIFY `id_pengajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tb_sertifikasi`
--
ALTER TABLE `tb_sertifikasi`
  MODIFY `id_sertifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tb_soal_essay`
--
ALTER TABLE `tb_soal_essay`
  MODIFY `id_essay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_soal_pilgan`
--
ALTER TABLE `tb_soal_pilgan`
  MODIFY `id_pilgan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_topik_quiz`
--
ALTER TABLE `tb_topik_quiz`
  MODIFY `id_tq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_tujuan_ajar`
--
ALTER TABLE `tb_tujuan_ajar`
  MODIFY `id_tujuan_ajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
