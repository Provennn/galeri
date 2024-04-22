<?php
include "koneksi.php";
if (isset($_POST['edit'])) {

    $albumid        = $_POST['albumid'];
    $NamaAlbum       = $_POST["NamaAlbum"];
    $Deskripsi       = $_POST["Deskripsi"];
    $TanggalDibuat   = $_POST["TanggalDibuat"];

    $sql= "update album set NamaAlbum='$NamaAlbum', Deskripsi='$Deskripsi',TanggalDibuat='$TanggalDibuat' where albumid='$albumid'";
    $res = mysqli_query($conn,$sql);
    
    if ($res){
        header("Location: album.php");
    }else{
        mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Edit Album</title>
</head>
<body>
    <table>
        <form action="editalbum.php" method="post" enctype="multipart/form-data">
            <tr>
                <h2>Edit Album</h2>
            </tr>
            <?php
            $albumid = $_GET['albumid'];
            $sql="select * from album where albumid='$albumid'";
            $hasil=mysqli_query($conn,$sql);
            while ($data = mysqli_fetch_array($hasil)){
            ?>
            <tr>
                <td><input type="hidden" name="albumid" value="<?= $data['albumid'];?>"></td>
            </tr>
            <tr>
                <td>Nama Album</td>
                <td><input type="text" name="NamaAlbum" value="<?= $data['NamaAlbum'];?>"></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="Deskripsi" value="<?= $data['Deskripsi'];?>"></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td><input type="date" name="TanggalDibuat" value="<?= $data['TanggalDibuat'];?>"></td>
            </tr>
            <?php 
        } 
        ?>
            <tr>
                <td></td>
                <td><input type="submit" name="edit" value="edit"></td>
            </tr>
        </form>
    </table>
</body>
</html>