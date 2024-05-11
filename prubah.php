<?php
include "koreksi.php"; // Menghubungkan ke file koneksi.php

// Periksa apakah data yang diperlukan telah disubmit melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $id_siswa = $_POST['id_siswa'];
    $nama_siswa = $_POST['nama_siswa'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $gender = $_POST['gender'];

    // Query untuk mengupdate data siswa berdasarkan id_siswa
    $query_update_siswa = mysqli_query($conn, "UPDATE siswa SET nama_siswa='$nama_siswa', tanggal_lahir='$tanggal_lahir', alamat='$alamat', gender='$gender' WHERE id_siswa = $id_siswa");

    // Periksa apakah query berhasil dijalankan
    if ($query_update_siswa) {
        // Redirect kembali ke halaman tampil_siswa.php setelah berhasil mengubah data
        header("Location: tampil_siswa.php");
        exit(); // Pastikan tidak ada output lain yang dihasilkan setelah redirect
    } else {
        // Jika query gagal dijalankan, tampilkan pesan kesalahan
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Jika data tidak disubmit melalui metode POST, tampilkan pesan kesalahan
    echo "Metode yang digunakan tidak valid.";
}
?>