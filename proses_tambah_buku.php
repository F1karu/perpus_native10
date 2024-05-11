<?php
if ($_POST) {
    $nama_file = $_FILES['foto']['name'];
    $tmp_file = $_FILES['foto']['tmp_name'];
    $tipe_file = $_FILES['foto']['type'];
    $ukuran_file = $_FILES['foto']['size'];

    $nama_buku = $_POST['nama_buku'];
    $deskripsi_buku = $_POST['deskripsi_buku'];

    // Cek apakah file yang diupload adalah gambar
    if ($tipe_file != "image/jpeg" && $tipe_file != "image/png" && $tipe_file != "image/jpg") {
        echo "<script>alert('Tipe file yang diupload bukan gambar!');location.href='tambah_buku.php';</script>";
        exit;
    }

    // Cek ukuran file
    if ($ukuran_file > 1048576) { // 1 MB
        echo "<script>alert('Ukuran file melebihi batas (1 MB)!');location.href='tambah_buku.php';</script>";
        exit;
    }

    // Generate nama file baru yang unik
    $ext = explode(".", $nama_file);
    $nama_file_baru = uniqid() . "." . end($ext);

    // Pindahkan file yang diupload ke folder "assets/foto"
    move_uploaded_file($tmp_file, "assets/foto/" . $nama_file_baru);

    // Simpan informasi foto dan data buku ke database
    include "koreksi.php";
    $insert = mysqli_query($conn, "INSERT INTO buku (foto, nama_buku, deskripsi_buku) VALUES ('" . $nama_file_baru . "', '" . $nama_buku . "', '" . $deskripsi_buku . "')");

    if ($insert) {
        echo "<script>alert('Sukses menambahkan buku');location.href='tambah_buku.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan buku');location.href='tambah_buku.php';</script>";
    }
}
?>
