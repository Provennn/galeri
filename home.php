<?php
    include "koneksi.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Home</title>
</head>
<body>
    <table>
        <tr><a href="home.php">home</a></tr>
        <br>
        <tr><a href="album.php">album</a></tr>
        <br>
        <tr><a href="foto.php">foto</a></tr>
        <br>
        <tr><a href="logout.php">logout</a></tr>
        
    </table>
    <?php
    $username = $_SESSION['username'];
      $sql="SELECT * FROM album INNER JOIN foto ON album.albumid=foto.albumid";
      $res = mysqli_query($conn,$sql);  
      while($data=mysqli_fetch_array($res)){
    ?>
    <table>
        <tr>
            <td><img src="gambar/<?= $data['LokasiFile'];?>" class="card-img-top"></td>
            <td><h5 class="card-title"><?= $data['JudulFoto'];?></h5></td>
            <td><p class="card-text"><?= $data['DeskripsiFoto'];?></p></td>
            <?php
            $fotoid = $data['fotoid'];
            $sql1 = mysqli_query($conn, "select * from likefoto where fotoid = '$fotoid'");
            $dd = mysqli_num_rows($sql1);
            ?>
            <td><small class="text-muted"><?= $data['TanggalUnggah'];?></small></td>
            <td><a class="btn btn-light border" href="like.php?fotoid=<?php echo $data['fotoid']; ?>" style="width:145px;">Like <?php if($dd>0){echo $dd;}?></a></td>
            <td><a href="komentar.php?fotoid=<?php echo $data['fotoid']; ?>" class="btn btn-light border" style="width:120px;">Komentar</a></td>
        </tr>
    </table>
    <?php }?>
</body>
</html>