<?php
session_start();
require "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php"); 
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($koneksi, "SELECT * FROM film WHERE id_film='$id'");
    $film = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $nama_film   = $_POST['nama_film'];
    $genre       = $_POST['genre'];
    $sutradara   = $_POST['sutradara'];
    $durasi      = $_POST['durasi'];
    $status_film = $_POST['status_film'];
    $sinopsis    = $_POST['sinopsis'];

    if (!empty($_FILES['poster']['name'])) {
        $poster = $_FILES['poster']['name'];
        $tmp    = $_FILES['poster']['tmp_name'];
        $path   = "images/" . $poster;

        if (file_exists($film['poster'])) {
            unlink($film['poster']);
        }

        move_uploaded_file($tmp, $path);
        $posterQuery = ", poster='$path'";
    } else {
        $posterQuery = "";
    }

    $query = "UPDATE film SET 
                nama_film='$nama_film',
                genre='$genre',
                sutradara='$sutradara',
                durasi='$durasi',
                status_film='$status_film',
                sinopsis='$sinopsis'
                $posterQuery
              WHERE id_film='$id'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php?msg=edit_success");
    } else {
        echo "<p class='msg error'>Gagal update: " . mysqli_error($koneksi) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Film</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background: #f4f4f4; 
        }
        form { 
            background: #fff; 
            padding: 15px; 
            border-radius: 8px; 
            box-shadow: 0 0 5px rgba(0,0,0,0.1); 
        }
        label { 
            font-weight: bold; 
        }
        input, textarea, select, button {
            width: 1255px; 
            padding: 8px; 
            margin: 8px 0;
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
    </style>
</head>
<body>

<h2>Edit Film</h2>
<form method="post" enctype="multipart/form-data">
    <label>Nama Film</label>
    <input type="text" name="nama_film" value="<?php echo $film['nama_film']; ?>" required>

    <label>Genre</label>
    <input type="text" name="genre" value="<?php echo $film['genre']; ?>" required>

    <label>Sutradara</label>
    <input type="text" name="sutradara" value="<?php echo $film['sutradara']; ?>" required>

    <label>Durasi</label>
    <input type="time" name="durasi" value="<?php echo $film['durasi']; ?>" required>

    <label>Status Film</label>
    <select name="status_film" required>
        <option value="now_playing" <?php if($film['status_film']=="now_playing") echo "selected"; ?>>Now Playing</option>
        <option value="upcoming" <?php if($film['status_film']=="upcoming") echo "selected"; ?>>Upcoming</option>
    </select>

    <label>Poster</label><br>
    <img src="<?php echo $film['poster']; ?>" width="120"><br>
    <input type="file" name="poster" accept="image/*">

    <label>Sinopsis</label>
    <textarea name="sinopsis" rows="4" required><?php echo $film['sinopsis']; ?></textarea>

    <button type="submit" name="update">Update</button>
</form>

</body>
</html>
