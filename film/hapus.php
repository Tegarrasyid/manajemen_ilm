<?php
session_start();
require "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php"); 
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT poster FROM film WHERE id_film='$id'");
    $data  = mysqli_fetch_assoc($query);

    if ($data && file_exists($data['poster'])) {
        unlink($data['poster']); 
    }

    $hapus = mysqli_query($koneksi, "DELETE FROM film WHERE id_film='$id'");

    if ($hapus) {
        header("Location: index.php?msg=hapus_success");
    } else {
        header("Location: index.php?msg=hapus_error");
    }
} else {
    header("Location: index.php");
}
