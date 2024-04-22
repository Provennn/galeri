<?php
    include "koneksi.php";
    session_start();

    $fotoid = $_GET['fotoid'];
    $userid = $_SESSION['userid'];
    $TanggalLike = date("Y-m-d");

    $sql = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid' and userid='$userid'");
    
    if (mysqli_num_rows($sql) == 1) {
        mysqli_query($conn, "delete from likefoto where userid='$userid'");
        header("location: home.php");
    }else{
        $sql = mysqli_query($conn, "insert into likefoto values ('','$fotoid','$userid','$TanggalLike')");
        header("location: home.php");
    }
    ?>