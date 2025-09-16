-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Sep 2025 pada 04.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_film`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `film`
--

CREATE TABLE `film` (
  `id_film` int(11) NOT NULL,
  `nama_film` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `sutradara` varchar(255) NOT NULL,
  `durasi` time NOT NULL,
  `poster` varchar(255) NOT NULL,
  `sinopsis` text NOT NULL,
  `status_film` enum('now_playing','upcoming') NOT NULL DEFAULT 'now_playing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `film`
--

INSERT INTO `film` (`id_film`, `nama_film`, `genre`, `sutradara`, `durasi`, `poster`, `sinopsis`, `status_film`) VALUES
(1, 'Avengers: Endgame', 'Action, Adventure, Sci-Fi', 'Anthony Russo, Joe Russo', '03:01:00', 'images/p1.jpg', 'Setelah kejadian dahsyat di Avengers: Infinity War, para Avengers yang tersisa harus bekerja sama untuk mengembalikan apa yang hilang dan mengalahkan Thanos dalam pertempuran terakhir.', 'now_playing'),
(2, 'Pengabdi Setan 2: Communion', 'Horror', 'Joko Anwar', '01:59:00', 'images/p2.jpeg', 'Rini dan keluarganya pindah ke rumah susun setelah tragedi, namun teror mengerikan kembali menghantui mereka dengan misteri kematian massal.', 'now_playing'),
(3, 'Miracle in Cell No. 7', 'Drama, Keluarga', 'Hanung Bramantyo', '02:25:00', 'images/p3.jpeg', 'Cerita tentang Dodo Rozak, seorang ayah dengan keterbatasan mental yang dipenjara atas tuduhan salah, namun cintanya pada anak perempuannya membuat semua orang di sekitarnya tersentuh.', 'upcoming'),
(5, 'KKN di Desa Penari', 'Horror, Thriller', 'Awi Suryadi', '02:10:00', 'images/p4.jpg', 'Sekelompok mahasiswa melaksanakan KKN di sebuah desa terpencil, namun mereka melanggar aturan gaib dan terjebak dalam teror mistis yang mematikan.', 'upcoming'),
(6, 'Ngeri-Ngeri Sedap', 'Drama, Komedi', 'Bene Dion Rajagukguk', '01:54:00', 'images/p5.jpeg', 'Kisah keluarga Batak yang pura-pura hendak bercerai agar anak-anak mereka pulang ke kampung halaman, namun justru membuka konflik dan kehangatan keluarga.', 'upcoming'),
(7, 'Ivanna', 'Horror', 'Kimo Stamboel', '01:43:00', 'images/p6.jpg', 'Ambar yang kehilangan penglihatannya pindah ke rumah baru, namun arwah seorang gadis Belanda bernama Ivanna mulai menghantui dengan penuh dendam.', 'upcoming');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`) VALUES
(1, 'Tegar', 'tegar@gmail.com', 'tegar123'),
(2, 'admin', 'aku@gmail.com', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `film`
--
ALTER TABLE `film`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
