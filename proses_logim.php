<?php
session_start();

$user_type = $_POST['user_type'];
$username = $_POST['username'];
$password = $_POST['password'];

$conn = mysqli_connect("localhost", "root", "toko_online");

if ($conn) {
  $table_name = "petugas"; // Default table

  $sql = "SELECT * FROM $table_name WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_type'] = $user_type; // Store user type in session
    if ($user_type == "petugas") {
      $_SESSION['user_id'] = $row['id_petugas']; // Simpan ID petugas di session
    } else {
      $_SESSION['user_id'] = $row['id_pelanggan']; // Simpan ID pelanggan di session
    }
    header("Location: homeless.php"); // Redirect to appropriate homepage
  } else {
    echo "<script>alert('Username atau password salah!');</script>";
  }
} else {
  echo "Connection failed: " . mysqli_connect_error();
}

mysqli_close($conn);