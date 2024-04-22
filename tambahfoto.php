<?php
include "koneksi.php";
session_start();
if (isset($_POST['tambah'])) {

    $JudulFoto       = $_POST["JudulFoto"];
    $DeskripsiFoto   = $_POST["DeskripsiFoto"];
    $albumid         = $_POST['albumid'];
    $TanggalUnggah   = $_POST['TanggalUnggah'];
    $userid          = $_SESSION["userid"];

    $ekstensi =  array('png','jpg','jpeg','gif');
    $LokasiFile= $_FILES['LokasiFile']['name'];
    $eks = pathinfo($LokasiFile, PATHINFO_EXTENSION);
    
    if(in_array($eks,$ekstensi) ) {
        move_uploaded_file($_FILES['LokasiFile']['tmp_name'], 'gambar/'.$LokasiFile);
        mysqli_query($conn, "INSERT INTO foto VALUES(NULL,'$JudulFoto','$DeskripsiFoto','$TanggalUnggah','$LokasiFile','$albumid','$userid')");
        header("location: foto.php");
    }else{	
        mysqli_error($conn);
    }
}
?>