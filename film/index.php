<?php
session_start();
require "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php"); 
    exit;
}

if (isset($_POST['simpan'])) {
    $nama_film   = $_POST['nama_film'];
    $genre       = $_POST['genre'];
    $sutradara   = $_POST['sutradara'];
    $durasi      = $_POST['durasi'];
    $status_film = $_POST['status_film'];
    $sinopsis    = $_POST['sinopsis'];

    $poster = $_FILES['poster']['name'];
    $tmp    = $_FILES['poster']['tmp_name'];
    $path   = "images/" . $poster;

    if (move_uploaded_file($tmp, $path)) {
        $query = "INSERT INTO film (nama_film, genre, sutradara, durasi, poster, sinopsis, status_film)
                  VALUES ('$nama_film', '$genre', '$sutradara', '$durasi', '$path', '$sinopsis', '$status_film')";
        if (mysqli_query($koneksi, $query)) {
            echo "<p class='msg success'>Film berhasil ditambahkan!</p>";
        } else {
            echo "<p class='msg error'>Gagal menambahkan film: " . mysqli_error($koneksi) . "</p>";
        }
    } else {
        echo "<p class='msg error'>Upload poster gagal!</p>";
    }
}

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

if ($filter) {
    $query = "SELECT * FROM film WHERE status_film = '$filter'";
} else {
    // untuk menampilkan semuanya
    $query = "SELECT * FROM film"; 
}
$result = mysqli_query($koneksi, $query);
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Film</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr; /* 2 kolom */
            gap: 20px;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .form-left, .form-right {
            display: flex;
            flex-direction: column;
        }
        .form-submit {
            grid-column: 1 / span 2; 
            display: flex;
            justify-content: center;
        }
        .form-submit button {
            width: 5000px;
            padding: 10px;
            font-size: 16px;
            border-radius: 6px;
        }
        label {
            font-weight: bold;
        }
        input, select, button {
            width: 600px;
            margin-top: 5px;
            margin-bottom: 15px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea{
            width: 600px;
            height: 85px;
            margin-top: 5px;
            margin-bottom: 15px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background: #007bff;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .msg {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .success { 
            background: #d4edda; 
            color: #155724; 
        }
        .error { 
            background: #f8d7da; 
            color: #721c24; 
        }

        .filter {
            margin: 10px 0;
        }
        .filter a {
            text-decoration: none;
            margin-right: 10px;
            padding: 6px 12px;
            border-radius: 4px;
            background: #ddd;
            color: #333;
        }
        .filter a.active {
            background: #333;
            color: #fff;
            font-weight: bold;
        }
        .filter a:hover {
            background: #bbb;
        }

        .film-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .film-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            flex-direction: column;
        }
        .film-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.15);
        }
        .film-card img {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }
        .film-info {
            padding: 15px;
            flex-grow: 1;
        }
        .film-info strong {
            font-size: 18px;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }
        .film-info p {
            margin: 4px 0;
            font-size: 14px;
            color: #555;
        }
        .aksi {
            margin-top: 10px;
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            margin-right: 8px;
        }
        .btn.edit {
            background: #007bff;
            color: #fff;
        }
        .btn.edit:hover {
            background: #0056b3;
        }
        .btn.delete {
            background: #dc3545;
            color: #fff;
        }
        .btn.delete:hover {
            background: #a71d2a;
        }
        .btn.logout {
            background: #dc3545;
            color: #fff;
            padding: 6px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
        }
        .btn.logout:hover {
            background: #a71d2a;
        }

    </style>
</head>
<body>
<h2 style="display:flex; justify-content:space-between; align-items:center;">
    Tambah Film 
    <a href="logout.php" class="btn logout">Logout</a>
</h2>
<form method="post" enctype="multipart/form-data" class="form-grid">
    <div class="form-left">
        <label>Nama Film</label>
        <input type="text" name="nama_film" required>

        <label>Genre</label>
        <input type="text" name="genre" required>

        <label>Sutradara</label>
        <input type="text" name="sutradara" required>

        <label>Durasi </label>
        <input type="time" name="durasi" required>
    </div>

    <div class="form-right">
        <label>Status Film</label>
        <select name="status_film" required>
            <option value="now_playing">Now Playing</option>
            <option value="upcoming">Upcoming</option>
        </select>

        <label>Poster</label>
        <input type="file" name="poster" accept="image/*" required>

        <label>Sinopsis</label>
        <textarea name="sinopsis" rows="4" required></textarea>
    </div>

    <div class="form-submit">
        <button type="submit" name="simpan">Simpan</button>
    </div>
</form>


<!-- Filter Tombol -->
<div class="filter">
    <a href="?" class="<?= $filter == '' ? 'active' : '' ?>">Semua</a>
    <a href="?filter=now_playing" class="<?= $filter == 'now_playing' ? 'active' : '' ?>">Now Playing</a>
    <a href="?filter=upcoming" class="<?= $filter == 'upcoming' ? 'active' : '' ?>">Upcoming</a>
</div>

<div class="film-container">
<?php while($row = mysqli_fetch_assoc($result)): ?>
    <div class="film-card">
        <img src="<?php echo $row['poster']; ?>" alt="Poster">
        <div class="film-info">
            <strong><?php echo $row['nama_film']; ?></strong>
            <p><b>Genre:</b> <?php echo $row['genre']; ?></p>
            <p><b>Sutradara:</b> <?php echo $row['sutradara']; ?></p>
            <p><b>Durasi:</b> <?php echo $row['durasi']; ?> menit</p>
            <p><b>Status:</b> <?php echo ucfirst(str_replace("_"," ",$row['status_film'])); ?></p>
            <p><b>Sinopsis:</b> <?php echo $row['sinopsis']; ?></p>

            <!-- Tombol Aksi -->
            <div class="aksi">
                <a href="edit.php?id=<?php echo $row['id_film']; ?>" class="btn edit">Edit</a>
                <a href="hapus.php?id=<?php echo $row['id_film']; ?>" class="btn delete" onclick="return confirm('Yakin ingin menghapus film ini?')">Hapus</a>
            </div>
        </div>
    </div>
<?php endwhile; ?>
</div>

</body>
</html>
