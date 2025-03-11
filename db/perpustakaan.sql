-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 04, 2025 at 04:32 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_lengkap`, `email`, `created_at`, `updated_at`) VALUES
(7, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator', 'admin@perpustakaan.com', '2025-01-17 03:08:00', '2025-01-17 03:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int NOT NULL,
  `judul` varchar(100) NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` int NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `jumlah_halaman` int DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `cover`, `pengarang`, `penerbit`, `tahun_terbit`, `isbn`, `jumlah_halaman`, `kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
(16, 'About You', '6789e27e02c1a.jpg', 'Visya Nabila', 'Cloudbook Publishing. ', 2024, '978-0747532743', 223, 'Fiksi', 'About You adalah novel karya Visya Nabila yang mengisahkan pertemuan antara dua remaja, Gavesha dan Bryan, yang mengalami cinta pada pandangan pertama setelah melakukan kontak mata singkat di suatu tempat. Keduanya memiliki kesamaan dalam selera musik, terutama kecintaan mereka terhadap Taylor Swift, sehingga mereka dijuluki \"Swiftie couple\". Hubungan mereka unik karena menggunakan lirik lagu dan kutipan novel sebagai bentuk ungkapan cinta. Selain kisah romantis, novel ini juga menyajikan konflik yang menantang namun tetap menarik, dengan nuansa yang menyenangkan dan berakhir dengan akhir yang bahagia.', '2025-01-17 03:08:00', '2025-02-03 06:35:46'),
(17, 'Hello Cello', '678de543ec357.jpg', 'Nadia Ristivani', 'Bukune Kreatif Cipta', 2023, '978-0261103283', 310, 'Fiksi', 'Hello, Cello adalah novel karya Nadia Ristivani yang mengisahkan tentang Helga, seorang mahasiswi sekaligus penulis yang telah mengalami berbagai kekecewaan dalam percintaan, membuatnya enggan untuk jatuh cinta lagi. Di tengah proses penulisan buku keenamnya, Helga bertemu dengan Marcello, atau Cello, seorang mahasiswa tampan yang terkenal sebagai playboy di kampusnya. Awalnya, Cello berniat mendekati Una, sahabat Helga yang populer, namun justru semakin dekat dengan Helga yang memiliki kepribadian unik dan sering bersikap spontan. Kedekatan mereka menimbulkan pertanyaan: mampukah Cello menaklukkan hati Helga yang telah membeku?', '2025-01-17 03:08:00', '2025-02-03 06:38:15'),
(18, '3726 MDPL ', '6789db447a7db.jpg', 'Nurwina Sari', 'Romancious', 2024, '978-0141439518', 432, 'Fiksi', '3726 MDPL adalah novel karya Nurwina Sari yang mengisahkan tentang Rangga Raja, seorang mahasiswa Fakultas Kehutanan yang juga menjabat sebagai Ketua Panitia OSPEK pada tahun 2023. Selain disibukkan dengan skripsinya, Rangga diam-diam mengagumi Andini Hangura, adik tingkatnya yang bercita-cita mendaki Gunung Rinjani. Selama empat tahun, Rangga rutin mengirimkan pesan ulang tahun kepada Andini, meskipun tidak pernah mendapat balasan. Namun, setelah Rangga mengirimkan foto dari puncak Gunung Rinjani, Andini akhirnya membalas pesannya, yang menjadi awal kedekatan mereka. Cerita ini menggambarkan perjuangan Rangga dalam mengungkapkan perasaannya dan dinamika hubungan mereka yang diwarnai oleh masa lalu Andini.', '2025-01-17 03:08:00', '2025-02-03 06:37:39'),
(20, 'Make U Mine', '678e005e77072.png', 'Indah Aini', 'Cloudbook Publishing. ', 2024, '978-0451524935', 328, 'Fiksi ', 'Make U Mine adalah novel karya Indah Aini yang mengisahkan pertemuan tak terduga antara Kafka Maverick dan Alluna Odelyn. Kafka, seorang anggota band dan ekskul basket yang rendah hati dan populer di sekolahnya, merasa terkesan mendalam setelah bertemu dengan Alluna, seorang siswi berprestasi yang menjadi kebanggaan sekolah. Setelah menyadari bahwa mereka bersekolah di tempat yang sama, Kafka secara terang-terangan berusaha mendekati Alluna dengan berbagai cara, termasuk meminta bantuan teman-temannya. Namun, usahanya sering kali membuatnya frustrasi karena Alluna ternyata sangat tidak peka dan memiliki gengsi yang tinggi. Cerita ini menggambarkan perjuangan Kafka dalam mendapatkan cinta Alluna dan apakah kisah cinta pertamanya akan berakhir indah.', '2025-01-17 03:08:00', '2025-02-03 06:35:57'),
(27, 'Bandung After Rain', '678dfcf8be722.png', 'Wulan Nur Amalia', 'Black Swan Books', 2024, '978-3161484100', 220, 'Fiksi', 'Bandung After Rain adalah novel karya Wulan Nur Amalia yang mengisahkan perjalanan cinta antara Hema dan Rania. Setelah menjalin hubungan selama hampir tujuh tahun, mereka memutuskan berpisah karena sikap Hema yang semakin acuh terhadap Rania. Keputusan ini membuat Hema dipenuhi penyesalan mendalam. Sementara itu, Rania berusaha bangkit dengan fokus pada pendidikan dan kehidupannya sendiri. Di tengah proses tersebut, muncul Jeano, sahabat Hema yang diam-diam menyimpan perasaan terhadap Rania. Jeano menunjukkan cinta yang tulus tanpa mengharapkan balasan, hanya ingin melihat Rania bahagia. Novel ini menggambarkan dinamika emosi para tokohnya dalam menghadapi perpisahan, penyesalan, dan proses penyembuhan hati. Latar Kota Bandung setelah hujan menambah nuansa melankolis dan menjadi simbol harapan bagi para tokoh.', '2025-01-20 07:36:24', '2025-02-03 06:11:18'),
(30, 'Who\'s The Impostor?', '679085c336ef2.png', 'Nabila Eky', 'Katadepan', 2023, '978-1234567897', 300, 'Fiksi', 'Who\'s the Impostor adalah novel karya Nabila Eky yang mengisahkan tentang serangan mendadak segerombolan zombie yang menyebarkan virus mematikan di sebuah kota. Kekacauan melanda, dengan darah berceceran di mana-mana, dan penduduk berusaha menyelamatkan diri masing-masing. Di tengah situasi mencekam ini, tujuh pemuda dan seorang gadis berlindung di apartemen XKR. Berbeda dengan yang lain, mereka bekerja sama untuk saling melindungi dan mencari cara menghentikan wabah tersebut. Namun, di tengah perjuangan mereka, terungkap fakta mengejutkan bahwa salah satu dari mereka adalah penyebab terjadinya wabah ini, yaitu orang yang menciptakan virus tersebut. Mereka harus mengidentifikasi siapa di antara mereka yang menjadi dalang di balik bencana ini dan memaksanya mengungkapkan cara menghentikan penyebaran virus. Selama penyelidikan, berbagai fakta mengejutkan terungkap, menambah ketegangan dalam upaya mereka menyelamatkan diri. Pertanyaannya adalah, apakah mereka berhasil menemukan sang impostor, atau justru mereka semua akan menjadi korban berikutnya?', '2025-01-22 05:43:49', '2025-02-03 06:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `deskripsi`, `created_at`) VALUES
(1, 'Fiksi', 'Buku-buku fiksi umum', '2025-01-17 03:08:00'),
(2, 'Non-Fiksi', 'Buku-buku berbasis fakta dan pengetahuan', '2025-01-17 03:08:00'),
(3, 'Fantasi', 'Buku-buku dengan unsur fantasi', '2025-01-17 03:08:00'),
(4, 'Klasik', 'Karya-karya klasik literatur', '2025-01-17 03:08:00'),
(5, 'Fiksi Dystopian', 'Buku-buku dengan tema masa depan dystopian', '2025-01-17 03:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int NOT NULL,
  `id_buku` int DEFAULT NULL,
  `nama_peminjam` varchar(100) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` enum('Dipinjam','Dikembalikan','Terlambat') DEFAULT 'Dipinjam',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `after_peminjaman_insert` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
    UPDATE buku SET stok = stok - 1
    WHERE id = NEW.id_buku AND stok > 0;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_peminjaman_update` AFTER UPDATE ON `peminjaman` FOR EACH ROW BEGIN
    IF NEW.status = 'Dikembalikan' AND OLD.status = 'Dipinjam' THEN
        UPDATE buku SET stok = stok + 1
        WHERE id = NEW.id_buku;
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_judul` (`judul`),
  ADD KEY `idx_pengarang` (`pengarang`),
  ADD KEY `idx_isbn` (`isbn`),
  ADD KEY `idx_kategori` (`kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `idx_status_peminjaman` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
