<?php
include "koneksi.php";
session_start();
if (isset($_POST['edit'])) {

    $fotoid         = $_POST['fotoid'];
    $JudulFoto      = $_POST["JudulFoto"];
    $DeskripsiFoto  = $_POST["DeskripsiFoto"];
    $albumid        = $_POST["albumid"];

    $ekstensi =  array('png','jpg','jpeg');
    $foto_saat_ini = $_POST['foto_saat_ini'];
    $foto_baru = $_FILES['foto_baru']['name'];
    $file_tmp = $_FILES['foto_baru']['tmp_name'];
    $eks = pathinfo($foto_baru, PATHINFO_EXTENSION);
        
    if (!empty($foto_baru)){
        if(in_array($eks, $ekstensi) === true){
            move_uploaded_file($file_tmp, 'gambar/'.$foto_baru);
            
            if ($foto_saat_ini){
                unlink("gambar/".$foto_saat_ini);
            }
            
            mysqli_query($conn, "UPDATE foto SET JudulFoto='$JudulFoto', DeskripsiFoto='$DeskripsiFoto',LokasiFile='$foto_baru',albumid='$albumid' WHERE fotoid='$fotoid'")or die(mysqli_error($conn));
            header("location: foto.php");
        }else{
            mysqli_error($conn);
        }
    }else{
        mysqli_query($conn, "UPDATE foto SET JudulFoto='$JudulFoto', DeskripsiFoto='$DeskripsiFoto',albumid='$albumid' WHERE fotoid='$fotoid'")or die(mysqli_error($conn));
        header("location: foto.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Edit Foto</title>
</head>
<body>
    <table>
        <form action="editfoto.php" method="post" enctype="multipart/form-data">
            <tr>
                <h2>Edit Foto</h2>
            </tr>
            <?php
            $fotoid = $_GET['fotoid'];
            $sql="select * from foto where fotoid='$fotoid'";
            $hasil=mysqli_query($conn,$sql);
            while ($data = mysqli_fetch_array($hasil)){
            $albumid2 = $data['albumid'];
            ?>
            <tr>
                <td><input type="hidden" name="fotoid" value="<?= $data['fotoid'];?>"></td>
            </tr>
            <tr>
                <td>Judul Foto</td>
                <td><input type="text" name="JudulFoto" value="<?= $data['JudulFoto'];?>"></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="DeskripsiFoto" value="<?= $data['DeskripsiFoto'];?>"></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td><input type="date" name="TanggalUnggah" value="<?= $data['TanggalUnggah'];?>"></td>
            </tr>
            <tr>
                <td>Lokasi File</td>
                <input type="hidden" name="foto_saat_ini" value="<?= $data['LokasiFile'];?>">
                <td><input class="form-control" type="file" name="foto_baru"></td>
            </tr>
            <tr>
                <td>Album</td>
                <td>
                    <select name="albumid" required>
                    <?php
                        $userid = $_SESSION['userid'];
                        $sql = mysqli_query($conn,"select * from album where userid='$userid'");
                        while($data2 = mysqli_fetch_array($sql)){
                    ?>
                        <option <?php if ($albumid2==$data2['albumid']) echo "selected"; ?> value="<?php echo $data2['albumid'];?>"><?php echo $data2['NamaAlbum'];?></option>
                        
                    <?php } 
                    ?>
                    </select>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td></td>
                <td><input type="submit" name="edit" value="edit"></td>
            </tr>
        </form>
    </table>
</body>
</html>