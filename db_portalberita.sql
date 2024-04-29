-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Feb 2024 pada 05.09
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_portalberita`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_balasadmin`
--

CREATE TABLE `tbl_balasadmin` (
  `id_balasadmin` int(25) NOT NULL,
  `id_pesan` int(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `to_email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id_banner` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `judul_banner` varchar(100) NOT NULL,
  `status` varchar(40) NOT NULL,
  `urutan` int(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_banner`
--

INSERT INTO `tbl_banner` (`id_banner`, `gambar`, `judul_banner`, `status`, `urutan`, `keterangan`) VALUES
(2, 'course-video.mp4', 'Selamat Datang', 'Aktif', 1, 'Selamat datang di SMKN 2 LANGSA, tempat di mana setiap anak dapat berkembang secara holistik dan menjadi pribadi yang unggul. Mari kita bersama-sama menciptakan masa depan yang gemilang bagi generasi penerus melalui pendidikan yang bermakna dan berkualitas.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_berita`
--

CREATE TABLE `tbl_berita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar_berita` varchar(255) NOT NULL,
  `tanggal_dimasukkan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_berita`
--

INSERT INTO `tbl_berita` (`id_berita`, `judul_berita`, `deskripsi`, `gambar_berita`, `tanggal_dimasukkan`) VALUES
(17, 'SMKN 2 Langsa Sabet Anugerah K', 'SMKN 2 Langsa menyabet Anugerah Kihajar 2022, yang diselenggarakan Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi (Kemendikbudristek) melalui Pusat Data dan Teknologi Informasi Pendidikan dan Kebudayaan (Pusdatin) di Jakarta, Rabu 30 Oktober 2022.  Guru Pembimbing siswi SMK Negeri 2 Langsa yang meraih juara pertama di tingkat provinsi dan nasional, Adinur mengatakan  ketiga siswi SMK Negeri 2 Langsa yang meraih juara pertama di ajang Anugerah Kihajar 2022 adalah Nayla Muthia Ramadhani Azzahra, Nadia Rabila dan Riska Agus Putri. Ketiga siswi ini masih duduk di kelas XI RPL (Rekayasa Perangkat Lunak).  “Karya mereka, penemuan daun mangrove dijadikan sebagai bahan deterjen ini diambil berdasarkan referensi jurnal yang ada,” ujar Adinur, Jumat 2 Nopember 2022.  Dijelaskan, pembuatan deterjen dari daun mangrove itu melalui proses destilasi atau penyulingan daun manggrove sehingga menghasilkan beberapa zat katalis yang dijadikan bahan pencampur untuk pembuatan deterjen.', 'https://halaman7.com/2022/12/smkn-2-langsa-sabet-anugerah-kihajar-nasional/', '2024-02-19 02:51:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_galeri`
--

CREATE TABLE `tbl_galeri` (
  `id_galeri` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `judul_galeri` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_galeri`
--

INSERT INTO `tbl_galeri` (`id_galeri`, `image`, `judul_galeri`, `deskripsi`, `tanggal`) VALUES
(2, 'sekolah.jpg', 'pembekalan Bersama', 'bagus', '2024-02-12 03:34:25'),
(3, 'IMG-20230728-WA0601.jpg', 'belajar bersamaa', 'diskon 10% untuk awal tahun', '2024-02-12 04:08:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `id_guru` int(25) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `JK` varchar(22) NOT NULL,
  `NIP` varchar(100) NOT NULL,
  `mapel` varchar(50) NOT NULL,
  `tugastambahan` varchar(60) NOT NULL,
  `agama` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_guru`
--

INSERT INTO `tbl_guru` (`id_guru`, `gambar`, `nama_guru`, `JK`, `NIP`, `mapel`, `tugastambahan`, `agama`) VALUES
(4, 'pegawai1.jpg', 'Amperawati', 'Perempuan', '196607261986032002', 'Guru Mapel', '-', 'islam'),
(6, 'pegawai.jpg', 'Agam Agus Budiono', 'Laki-laki', '196608201989101002', 'Guru Mapel', '-', 'islam'),
(7, 'pegawai.jpg', 'Adi Sukamto', 'Laki-laki', '19641005198902003', 'Guru Mapel', 'Kepala Bengkel', 'islam'),
(8, 'pegawai.jpg', 'Ardinur Mahyuzar', 'Laki-laki', '198110032007011002', 'Guru Mapel', 'Wakil Kepala Sekolah', 'islam'),
(9, 'pegawai.jpg', 'Baharruddin', 'Laki-laki', '198203112009041002', 'Guru Mapel', 'Kepala Program Keahlian', 'islam'),
(10, 'pegawai.jpg', 'Chairul Bahri', 'Laki-laki', '198307162009041003', 'Guru Mapel', 'Kaprok', 'islam'),
(11, 'pegawai.jpg', 'Diawan', 'Laki-laki', '196501081989031003', 'Guru Mapel', 'Kepala Bengkel', 'islam'),
(12, 'pegawai1.jpg', 'Erlitawati', 'Perempuan', '197106281928012001', 'Guru Mapel', '-', 'islam'),
(13, 'pegawai1.jpg', 'Eva Lala Srianti', 'Perempuan', '198707162010032001', 'Guru Mapel', '-', 'islam'),
(14, 'pegawai1.jpg', 'Eva Mawaddah', 'Perempuan', '197905272009042003', 'Guru Mapel', '-', 'islam'),
(15, 'pegawai.jpg', 'Dicky Kurniawan', 'Laki-laki', '198409042008011001', 'Guru Mapel', 'Kepala Bengkel', 'islam'),
(16, 'pegawai.jpg', 'Harianto', 'Laki-laki', '197909232008011001', 'Guru Mapel', 'Komnator P5', 'islam'),
(17, 'pegawai.jpg', 'Boby Handoko', 'Laki-laki', '197604142005041004', 'Guru Mapel', 'Kepala Laboratorium', 'islam'),
(18, 'pegawai.jpg', 'Hidayat Sumanti', 'Laki-laki', '196610061991031007', 'Guru Mapel', 'Kepala Program Keahlian', 'islam'),
(19, 'pegawai.jpg', 'Iwan Fansuri', 'Laki-laki', '198612092023211014', 'Guru Mapel', 'Pembina Osis', 'islam'),
(20, 'pegawai.jpg', 'Juliadi', 'Laki-laki', '197507242023211003', 'Guru Mapel', 'Kepala Bengkel', 'islam'),
(21, 'pegawai1.jpg', 'Sukarseh', 'Perempuan', '198312192011032001', 'Guru Mapel', 'Kepala Bengkel', 'islam'),
(22, 'pegawai.jpg', 'T. Devie Julianto', 'Laki-laki', '1983031120070101009', 'Guru Mapel', 'Wakil Kepala Sekolah', 'islam'),
(23, 'pegawai1.jpg', 'Puspa Sari', 'Perempuan', '199404192023212026', 'Guru Mapel', '-', 'islam'),
(24, 'pegawai1.jpg', 'Nurleli', 'Perempuan', '198205062011032002', 'Guru Mapel', '-', 'islam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jurusan`
--

CREATE TABLE `tbl_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `namajurusan` varchar(100) NOT NULL,
  `jumlah_siswa` int(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_jurusan`
--

INSERT INTO `tbl_jurusan` (`id_jurusan`, `namajurusan`, `jumlah_siswa`, `status`, `gambar`, `deskripsi`) VALUES
(6, 'TEKNIK INFORMATIKA', 300, 'Aktif', 'pramuka1.webp', 'Teknik Informatika merupakan jurusan yang banyak mengulas beragam teknologi komputer, mulai dari prinsip prinsip ilmu komputer, alisis matematis, evaluasi sistem operasi, sehingga pengembangan dan perancangan software. \r\nTeknik Informatika terbagi : \r\n~ Rekayasa Perangkat Lunak (RPL)\r\n   Rekayasa Perangkat Lunak atau biasa disingkat dengan RPL adalah salah satu bidang profesi dan juga mata pelajaran yang mempelajari tentang \r\n   pengembangan perangkat-perangkat lunak termasuk dalam hal pembuatannya, pemeliharaan hingga manajemen organisasi dan manajemen \r\n   kualitasnya.\r\n~ Teknik Informasi dan Jaringan (TKJ)\r\n   TKJ merupakan sebuah kejuruan yang mempelajari tentang cara merakit komputer, mengenal dan mempelajari komponen hardware apa saja \r\n   yang ada di dalam komputer, merakit komputer serta fokus mempelajari jaringan dasar.'),
(7, 'LISTRIK', 300, 'Aktif', 'desainer.jpg', 'Teknik listrik atau teknik elektro adalah salah satu bidang ilmu teknik mengenai aplikasi listrik untuk memenuhi kebutuhan masyarakat. Teknik listrik melibatkan konsep, perancangan, pengembangan, dan produksi peralatan listrik dan elektronik yang dibutuhkan oleh masyarakat.\r\nTeknik Listrik terbagi :\r\n~ Teknik Instalasi Tenaga Listrik (TITL)\r\n   Teknik Instalasi Tenaga Listrik adalah jurusan yang mempelajari tentang perencanaan dan pemasangan instalasi penerangan, tenaga pemasangan \r\n   dan pengoperasian motor listrik dengan kendali elektromekanik, elektronik dan PLC (Programable Logic Controller).\r\n~ Teknik Pendingin dan Tata Udara (TPTU)\r\n   Teknik Pendingin dan Tata Udara (Refrigeration) merupakan teknologi pengaturan temperatur udara sesuai dengan kebutuhan yang dikehandaki \r\n   mencakup kebutuhan ruangan maupun lainnya guna keperluan prosesing pengawetan bahan pangan, meliputi pelayanan/produksi, \r\n   pemeliharaan dan perawatan (maintenance) dan pengendalian mutu alat-alat pendingin.'),
(8, 'ELEKTRONIKA', 300, 'Aktif', 'IMG-20230728-WA0601.jpg', 'Elektronika merupakan ilmu yang mempelajari alat listrik arus lemah yang dioperasikan dengan cara mengontrol aliran elektron atau partikel bermuatan listrik dalam suatu alat seperti komputer, peralatan elektronik, termokopel, semikonduktor, dan lain sebagainya.\r\nElektronika Terbagi :\r\n~ Teknik Audio VIdeo (TAV)\r\n   Teknik Audio Video (TAV) adalah salah satu nama kompetensi keahlian atau jurusan yang ada di MAN Kendal. Teknik Audio Video merupakan satu \r\n   dari tiga kompetensi keahlian dalam bidang keahlian elektronika pada konsep kurikulum 2019 yang lalu dan hingga saat ini masih berjalan.\r\n~ Teknik Elektronika Industri (ELIN)\r\n   Teknik Elektronika Industri atau disebut ELIN dipersiapkan untuk mampu membuat aplikasi-aplikasi rangkaian, seperti: mendesain dan merakit \r\n   rangkaian elektronika baik analog maupun digital, pemakaian sensor dan aktuator, serta memprogram dalam komunikasi data dan interface.'),
(9, 'TEKNIK MESIN', 300, 'Aktif', 'pramuka2.jpg', 'Teknik mesin atau Teknik mekanik adalah ilmu teknik mengenai aplikasi dari prinsip fisika untuk analisis, desain, manufaktur dan pemeliharaan sebuah sistem mekanik.Ilmu ini membutuhkan pengertian mendalam atas konsep utama dari cabang ilmu mekanika, kinematika, teknik material, termodinamika dan energi.\r\nTeknik Mesin Terbagi :\r\n~ Teknik Mesin Produksi (MP)\r\n   Jurusan Teknik Mesin Produksi mempelajari tentang semua hal yang berhubungan dengan proses produksi yang meliputi \r\n   perancangan produk atau desain produk, proses produksi, dan juga pengelolaan sistem manufaktur atau Manajemen Produksi.\r\n~ Teknik Pengelasan \r\n    Pengelasan (welding) adalah salah satu teknik penyambungan logam dengan cara mencairkan sebagian logam induk dan logam pengisi dengan \r\n    atau tanpa tekanan dan dengan atau tanpa logam penambah dan menghasilkan sambungan yang kontinu.'),
(10, 'TEKNIK BANGUNAN', 300, 'Aktif', 'desainer.jpg', 'Teknik adalah bidang tenik yang berhubungan dengan analisa desain struktur bangunan, menilai suatu kekokohan dan kemampuan bangunan untuk memuat beban. \r\nTeknik Bangunan Terbagi Beberapa Bidang : \r\n~ Teknik Gambar Bangunan (DPIB)  \r\n~ Bisnis Konstruksi dan Properti (BKP)'),
(11, 'TEKNIK OTOMOTIF', 3000, 'Aktif', 'ayam.jpg', 'Teknik otomotif adalah salah satu cabang ilmu teknik mesin yang mempelajari tentang bagaimana merancang, membuat dan mengembangkan alat-alat transportasi darat yang menggunakan mesin, terutama sepeda motor, mobil, bis dan truk.\r\nTeknik Otomotif terbagi :\r\n~ Teknik Kendaraan Ringan (TKR)\r\n   Teknik Kendaraan Ringan merupakan kompetensi keahlian dibidang Teknik Otomotif yang menekankan keahlian pada bidang penguasaan jasa \r\n   perbaikan kendaraan ringan.\r\n~ Teknik Bisnis Sepeda Motor (TBSM)\r\n   Teknik dan Bisnis Sepeda Motor (TBSM) adalah Jurusan yang mempelajari ilmu-ilmu yang berkaitan tentang sepeda motor, jurusan yang banyak \r\n   diminati oleh siswa terutama siswa laki-laki.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kepalasekolah`
--

CREATE TABLE `tbl_kepalasekolah` (
  `id_kepalasekolah` int(11) NOT NULL,
  `NIP` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kepalasekolah`
--

INSERT INTO `tbl_kepalasekolah` (`id_kepalasekolah`, `NIP`, `nama`, `jabatan`, `gambar`) VALUES
(2, '13462517', 'doni', 'Kepala Sekolah', 'pegawai.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_login`
--

INSERT INTO `tbl_login` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin123', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `id_menuutama` int(50) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `urutan` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `id_menuutama`, `nama_menu`, `status`, `urutan`) VALUES
(1, 2, 'chicken holic', 'Aktif', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menuutama`
--

CREATE TABLE `tbl_menuutama` (
  `id_menuutama` int(11) NOT NULL,
  `nama_menuutama` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `urutan` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_menuutama`
--

INSERT INTO `tbl_menuutama` (`id_menuutama`, `nama_menuutama`, `status`, `urutan`) VALUES
(2, 'profil', 'Tidak Aktif', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_organisasi`
--

CREATE TABLE `tbl_organisasi` (
  `id_organisasi` int(11) NOT NULL,
  `gambar_organisasi` varchar(255) NOT NULL,
  `nama_organisasi` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_organisasi`
--

INSERT INTO `tbl_organisasi` (`id_organisasi`, `gambar_organisasi`, `nama_organisasi`, `deskripsi`, `tanggal`) VALUES
(2, 'pramuka2.jpg', 'Pramuka', 'Pramuka adalah singkatan dari Praja Muda Karana dan merupakan organisasi atau gerakan kepanduan. Pramuka adalah sebuah organisasi yang merupakan wadah proses pendidikan kepramukaan yang dilaksanakan di Indonesia. Dalam dunia internasional, Pramuka disebut dengan istilah “Kepanduan” (Boy Scout)', '2024-02-16 13:45:12'),
(3, 'sekolah.jpg', 'OSIS', 'OSIS adalah Organisasi yang bersifat intra sekolah, dan merupakan satu-satunya organisasi siswa yang sah di sekolah sebagai wadah siswa berorganisasi, menampung seluruh kegiatan siswa, serta tidak ada hubungan organisatoris dengan OSIS di sekolah lain, dan atau tidak menjadi bagian dari organisasi lain di luar sekolah.', '2024-02-19 02:22:32'),
(4, 'FOTO PROFIL.jpeg', 'PASKIBRA', 'Paskibraka adalah singkatan dari Pasukan Pengibar Bendera Pusaka dengan tugas utamanya untuk mengibarkan dan menurunkan Bendera Pusaka negara dalam upacara peringatan Hari Kemerdekaan Republik Indonesia dan Proklamasi Kemerdekaan Republik Indonesia di tiga tempat, yakni tingkat kabupaten/kota, provinsi, dan nasional', '2024-02-19 02:24:13'),
(5, 'Class Diagram penyewaan.jpg', 'ROHANI ISLAM', 'Rohani Islam (disingkat Rohis) adalah sebuah organisasi memperdalam dan memperkuat ajaran Islam. Rohis sering disebut juga sebagai IREMA(Ikatan Remaja Masjid) atau Dewan Keluarga Masjid (DKM).', '2024-02-19 02:25:39'),
(6, 'download.jpg', 'PALANG MERAH REMAJA', 'Palang Merah Remaja atau PMR adalah suatu organisasi binaan dari Palang Merah Indonesia yang berpusat di sekolah-sekolah ataupun kelompok-kelompok masyarakat (sanggar, kelompok belajar, dll.) yang bertujuan membangun dan mengembangkan karakter Kepalangmerahan agar siap menjadi Relawan PMI pada masa depan.', '2024-02-19 02:26:40'),
(7, '2.ALIF HILALLUDDIN,desain web.png', 'KESENIAN', 'Seni adalah keahlian membuat karya yang bermutu, seperti tari, lukisan, ukiran. Seni meliputi banyak kegiatan manusia dalam menciptakan karya visual, audio, atau pertunjukan yang mengungkapkan imajinasi, gagasan, atau keprigelan teknik pembuatnya, untuk dihargai keindahannya atau kekuatan emosinya', '2024-02-19 02:27:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pesan`
--

CREATE TABLE `tbl_pesan` (
  `id_pesan` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_pesan`
--

INSERT INTO `tbl_pesan` (`id_pesan`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Alif Hilalluddin', 'alif04hilal@gmail.com', 'pendaftaran', 'frghgf'),
(2, 'Alif Hilalluddin', 'alif04hilal@gmail.com', 'pendaftaran', 'hdushfuhshd'),
(3, 'Alif Hilalluddin', 'alif04hilal@gmail.com', 'pendaftaran', 'kapan berita terbarunya'),
(4, 'Alif Hilalluddin', 'alif04hilal@gmail.com', 'pendaftaran', 'vfhghf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_profil`
--

CREATE TABLE `tbl_profil` (
  `id_profil` int(11) NOT NULL,
  `nama_profil` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `jam_masuk` varchar(50) NOT NULL,
  `jam_pulang` varchar(30) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `no_tlpn` varchar(80) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_profil`
--

INSERT INTO `tbl_profil` (`id_profil`, `nama_profil`, `deskripsi`, `alamat`, `logo`, `jam_masuk`, `jam_pulang`, `facebook`, `instagram`, `youtube`, `no_tlpn`, `email`) VALUES
(1, 'SMKN 2 Kota Langsa', 'SMK Negeri 2 Langsa (STM), merupakan salah satu Sekolah Menengah Kejuruan Negeri yang ada di Provinsi Aceh, Indonesia. Sama dengan SMK pada umumnya di Indonesia masa pendidikan sekolah di SMK Negeri 2 Langsa ditempuh dalam waktu tiga tahun pelajaran, mulai dari Kelas X sampai Kelas XII.  SMK Negeri 2 Langsa adalah salah satu sekolah menengah kejuruan yang ada di Kota Langsa Provinsi Aceh. SMKN 2 Langsa juga termasuk SMK besar di Indonesia dengan 20 program keahlian. Dengan fasilitas ruang belajar dan laboratorium yang cukup memadai siap memajukan pendidikan nasional.', 'Jln. Jendral Ahmad Yani, Paya Bujok Seulemak, Langsa Baro KOTA LANGSA - ACEH', 'WhatsApp Image 2024-02-10 at 21.59.19.jpeg', '07:00', '14:00', '-', '-', '-', '086583672', 'smkn2langsa@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id_siswa` int(11) NOT NULL,
  `NISN` int(100) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id_siswa`, `NISN`, `nama_siswa`, `jurusan`, `gambar`) VALUES
(11, 56105043, 'Abdul Hamid Harahap', 'RPL', 'pegawai.jpg'),
(12, 67503103, 'Alif Hilalluddin', 'RPL', 'pegawai.jpg'),
(13, 65072699, 'Basdwizal Prayoga', 'RPL', 'pegawai.jpg'),
(14, 131537840, 'Cut Risha Anggraini', 'RPL', 'pegawai1.jpg'),
(15, 64225496, 'Dea Maydalena Anggraini', 'RPL', 'pegawai1.jpg'),
(16, 69876874, 'Dipo Arjuna Fathurrahman', 'RPL', 'pegawai.jpg'),
(17, 62572475, 'Dwiky Rivaldy Putra', 'RPL', 'pegawai.jpg'),
(18, 63676895, 'Hanifa Dwi Ariyanti', 'RPL', 'pegawai1.jpg'),
(19, 68089203, 'Jihan Salsabila Balqis', 'RPL', 'pegawai1.jpg'),
(20, 55563889, 'Khalid Fathurrahman', 'RPL', 'pegawai.jpg'),
(21, 68739758, 'Lucky Dwi Febriansyah', 'RPL', 'pegawai.jpg'),
(22, 65884592, 'M. Al Qadri', 'RPL', 'pegawai.jpg'),
(23, 73342919, 'M. Fauzan Muharram', 'RPL', 'pegawai.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_submenu`
--

CREATE TABLE `tbl_submenu` (
  `id_submenu` int(11) NOT NULL,
  `id_menu` int(30) NOT NULL,
  `nama_submenu` varchar(50) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `urutan` int(40) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_submenu`
--

INSERT INTO `tbl_submenu` (`id_submenu`, `id_menu`, `nama_submenu`, `gambar`, `status`, `urutan`, `isi`) VALUES
(1, 1, 'PPDB 2023', '65c9893940696.jpg', 'Aktif', 1, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_visimisi`
--

CREATE TABLE `tbl_visimisi` (
  `id_visimisi` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_visimisi`
--

INSERT INTO `tbl_visimisi` (`id_visimisi`, `gambar`, `visi`, `misi`) VALUES
(1, '', 'This is an edu meeting HTML CSS template provided by TemplateMo website. This is a Bootstrap v5.1.3 layout. The video background is taken from Pexels website, a group of young people by Pressmaster.', 'Sejarah Disdikbud (Dinas Pendidikan dan Kebudayaan) Kota Langsa dimulai seiring dengan perkembangan Kota Langsa itu sendiri.\r\nKota Langsa adalah salah satu kota di Aceh, Indonesia, yang memiliki peran penting dalam bidang pendidikan dan kebudayaan. \r\nPada awalnya, pendidikan di Kota Langsa lebih bersifat informal, dengan lembaga-lembaga pendidikan yang sederhana. \r\nNamun, seiring berjalannya waktu, Kota Langsa mulai menyadari pentingnya mengembangkan sistem pendidikan yang lebih formal dan terstruktur.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_balasadmin`
--
ALTER TABLE `tbl_balasadmin`
  ADD PRIMARY KEY (`id_balasadmin`),
  ADD KEY `id_pesan` (`id_pesan`);

--
-- Indeks untuk tabel `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Indeks untuk tabel `tbl_berita`
--
ALTER TABLE `tbl_berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `tbl_galeri`
--
ALTER TABLE `tbl_galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indeks untuk tabel `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `tbl_kepalasekolah`
--
ALTER TABLE `tbl_kepalasekolah`
  ADD PRIMARY KEY (`id_kepalasekolah`);

--
-- Indeks untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_menuutama` (`id_menuutama`);

--
-- Indeks untuk tabel `tbl_menuutama`
--
ALTER TABLE `tbl_menuutama`
  ADD PRIMARY KEY (`id_menuutama`);

--
-- Indeks untuk tabel `tbl_organisasi`
--
ALTER TABLE `tbl_organisasi`
  ADD PRIMARY KEY (`id_organisasi`);

--
-- Indeks untuk tabel `tbl_pesan`
--
ALTER TABLE `tbl_pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `tbl_profil`
--
ALTER TABLE `tbl_profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indeks untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `NISN` (`NISN`);

--
-- Indeks untuk tabel `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  ADD PRIMARY KEY (`id_submenu`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `tbl_visimisi`
--
ALTER TABLE `tbl_visimisi`
  ADD PRIMARY KEY (`id_visimisi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_balasadmin`
--
ALTER TABLE `tbl_balasadmin`
  MODIFY `id_balasadmin` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_berita`
--
ALTER TABLE `tbl_berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_galeri`
--
ALTER TABLE `tbl_galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_guru`
--
ALTER TABLE `tbl_guru`
  MODIFY `id_guru` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tbl_jurusan`
--
ALTER TABLE `tbl_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_kepalasekolah`
--
ALTER TABLE `tbl_kepalasekolah`
  MODIFY `id_kepalasekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_menuutama`
--
ALTER TABLE `tbl_menuutama`
  MODIFY `id_menuutama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_organisasi`
--
ALTER TABLE `tbl_organisasi`
  MODIFY `id_organisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_pesan`
--
ALTER TABLE `tbl_pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_profil`
--
ALTER TABLE `tbl_profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_visimisi`
--
ALTER TABLE `tbl_visimisi`
  MODIFY `id_visimisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_balasadmin`
--
ALTER TABLE `tbl_balasadmin`
  ADD CONSTRAINT `tbl_balasadmin_ibfk_1` FOREIGN KEY (`id_pesan`) REFERENCES `tbl_pesan` (`id_pesan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
