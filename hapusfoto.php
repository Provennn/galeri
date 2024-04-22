<?php
    include "koneksi.php";
    $fotoid = $_GET['fotoid'];

    $sqql = mysqli_query($conn, "SELECT * FROM foto WHERE fotoid='$fotoid'");

    $sql = mysqli_query($conn, "DELETE FROM foto WHERE fotoid='$fotoid'");

    $data = mysqli_fetch_array($sqql);
    
    if ($sql){
        if(unlink("gambar/". $data['LokasiFile']) ){
            header("Location: foto.php");
        }
    }else{
        mysqli_error($conn);
    }
?>