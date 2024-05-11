<?php
include "koreksi.php"; // Menghubungkan ke file koneksi.php

// Periksa apakah parameter id_siswa ada dan merupakan angka
if(isset($_GET['id_siswa']) && is_numeric($_GET['id_siswa'])) {
    // Ambil id_siswa dari URL
    $id_siswa = $_GET['id_siswa'];

    // Query untuk mengambil data siswa berdasarkan id_siswa
    $query_get_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa = $id_siswa");

    // Query untuk mengambil data kelas
    $qry_kelas = mysqli_query($conn, "SELECT * FROM kelas");
    
    // Periksa apakah data siswa dengan id_siswa yang diberikan ditemukan
    if(mysqli_num_rows($query_get_siswa) > 0) {
        $data_siswa = mysqli_fetch_assoc($query_get_siswa); // Mendapatkan data siswa
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Siswa</title>
</head>
<body>
    <h3>Ubah Data Siswa</h3>
    <form method="post" action="proses_ubah_siswa.php"> <!-- Form akan dikirimkan ke proses_ubah_siswa.php -->
        <input type="hidden" name="id_siswa" value="<?=$id_siswa?>"> <!-- Menyimpan id_siswa yang akan diubah -->
        <label>Nama Siswa:</label>
        <input type="text" name="nama_siswa" value="<?=$data_siswa['nama_siswa']?>"><br>
        <label>Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" value="<?=$data_siswa['tanggal_lahir']?>"><br>
        <label>Gender:</label>
        <select name="gender" class="form-control">
            <option value="L" <?=($data_siswa['gender'] == 'L') ? 'selected' : ''?>>Laki-laki</option>
            <option value="P" <?=($data_siswa['gender'] == 'P') ? 'selected' : ''?>>Perempuan</option>
        </select><br>
        <label>Kelas:</label>
        <select name="id_kelas" class="form-control">
            <?php
            // Loop untuk menampilkan opsi kelas
            while($data_kelas = mysqli_fetch_array($qry_kelas)) {
                echo '<option value="'.$data_kelas['id_kelas'].'" '.($data_kelas['id_kelas'] == $data_siswa['id_kelas'] ? 'selected' : '').'>'.$data_kelas['nama_kelas'].'</option>'; 
            }
            ?>
        </select><br>
        <!-- Anda dapat menambahkan field lain sesuai kebutuhan -->
        <input type="submit" value="Simpan">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>

<?php
    } else {
        echo "Data siswa tidak ditemukan.";
    }
} else {
    echo "ID siswa tidak valid.";
}
?>