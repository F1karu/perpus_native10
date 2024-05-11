<?php

include "koreksi.php";


if(isset($_GET['id_siswa'])) {
    
    $id_siswa = mysqli_real_escape_string($conn, $_GET['id_siswa']);

    
    $query = "DELETE FROM siswa WHERE id_siswa = '$id_siswa'";

  
    if(mysqli_query($conn, $query)) {
       
        header("Location: tampil_siswa.php");
        exit(); 
    } else {
        echo "Gagal menghapus data siswa: " . mysqli_error($conn);
    }
} else {
    
    echo "ID siswa tidak ditemukan.";
}
?>