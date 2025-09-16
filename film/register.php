<?php 
require "koneksi.php"; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .card {
      width: 400px;
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
    label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
      margin-top: 10px;
      color: #555;
    }
    input {
      width: 380px;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 6px;
      margin-bottom: 10px;
      font-size: 14px;
    }
    button {
      width: 100%;
      padding: 10px;
      background: #007bff;
      border: none;
      border-radius: 6px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      margin-top: 10px;
    }
    button:hover {
      background: #0056b3;
    }
    .link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }
    .link a {
      color: #007bff;
      text-decoration: none;
    }
    .link a:hover {
      text-decoration: underline;
    }
    .alert {
      margin-top: 15px;
      padding: 10px;
      border-radius: 6px;
      font-size: 14px;
      text-align: center;
    }
    .alert-success { background: #d4edda; color: #155724; }
    .alert-danger { background: #f8d7da; color: #721c24; }
  </style>
</head>
<body>

<div class="card">
  <h2>Register</h2>
  <form action="" method="post">
    <label>Username</label>
    <input type="text" name="username" required>
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Password</label>
    <input type="password" name="password" required>
    <button type="submit" name="register">Register</button>
  </form>
  <div class="link">
    Sudah punya akun? <a href="login.php">Login</a>
  </div>

  <?php
  if(isset($_POST['register'])){
      $username = htmlspecialchars($_POST['username']);
      $email = htmlspecialchars($_POST['email']);
      $password = htmlspecialchars($_POST['password']);

      if (empty($username) || empty($email) || empty($password)) {
          echo "<div class='alert alert-danger'>Data tidak boleh kosong</div>";
      } else {
          $query = mysqli_query($koneksi, "INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')");
          if ($query) {
              echo "<div class='alert alert-success'>Register Berhasil</div>";
              echo "<meta http-equiv='refresh' content='1; url=login.php'>";
          } else {
              echo "<div class='alert alert-danger'>Register Gagal</div>";
          }
      }
  }
  ?>
</div>

</body>
</html>

