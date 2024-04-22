<?php
include "koneksi.php";
session_start();
if (isset($_POST['tambah'])) {

    $NamaAlbum        = $_POST["NamaAlbum"];
    $Deskripsi        = $_POST["Deskripsi"];
    $TanggalDibuat    = date("Y-m-d");
    $userid           = $_SESSION["userid"];

    $sql = mysqli_query($conn , "INSERT INTO album VALUES ('','$NamaAlbum','$Deskripsi','$TanggalDibuat','$userid')") ;

    if($sql){
       header("location:album.php");
    }else{
        mysqli_error($conn);
    }
}
?>