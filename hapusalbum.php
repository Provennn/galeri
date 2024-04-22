<?php
    include "koneksi.php";
    $albumid = $_GET['albumid'];

    $sql = mysqli_query($conn, "DELETE foto,album FROM foto INNER JOIN album ON foto.albumid=album.albumid WHERE foto.albumid = '$albumid'");

    $sql = mysqli_query($conn, "DELETE FROM album WHERE albumid='$albumid'");

    if($sql){
        header("Location: album.php");
    }
?>