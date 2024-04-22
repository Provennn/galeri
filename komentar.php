<?php
    include "koneksi.php";
    session_start();

?>

<?php
if (isset($_POST['komentar'])) {

    $fotoid            = $_POST['fotoid'];
    $userid            = $_SESSION["userid"];
    $isiKomentar       = $_POST["isiKomentar"];
    $TanggalKomentar   = date("Y-m-d");

    $sql= "insert into komentarfoto values ('','$fotoid', '$userid','$isiKomentar','$TanggalKomentar')";
    $res = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    
    if ($res){
        header("Location: komentar.php?fotoid=".$fotoid);
    }else{
        mysqli_error($conn);
    }
}

$idfoto = $_GET['fotoid'];
$sql="select * from foto where fotoid='".$idfoto."'";
$hasil=mysqli_query($conn,$sql);
while ($data = mysqli_fetch_array($hasil)){
$album = $data['albumid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


            <img src="gambar/<?= $data['LokasiFile'];?>" class="card-img-top">
                <h5 class="card-title" style=" font-size: 28px;"><?= $data['JudulFoto'];?></h5>
                <p class="card-text"><?= $data['TanggalUnggah'];?></p>
                <p class="card-text"><?= $data['DeskripsiFoto'];?></p>
    <?php }?>
    
                    <h3 class="card-title text-center mt-3">Komentar</h3>

                    <input type="hidden" name="fotoid" value="<?=$data['fotoid'];?>">
    <?php
    $sql= mysqli_query($conn,"select * from komentarfoto inner join user on komentarfoto.userid = user.userid where fotoid='$idfoto'");
    $rows= mysqli_num_rows($sql);
    if ($rows > 0) {
    while ($data = mysqli_fetch_array($sql)){
    ?>  
                
                    <div class="col-12"><h6 class="card-title" ><?= $data['username'];?></h6></div>
                    <div class="col-12"><?= $data['isiKomentar'];?></div>
                

    <?php }}else{?> 
                    <h2 class="text-center">Belum Ada Komentar rek</h2>
        <?php } ?>
        <form method="post">
        
            <input class="form-control" type="hidden" name="fotoid" value="<?= $idfoto;?>">
            <div class="col-10"><input class="form-control" placeholder="Tambahkan Komentar" type="text" name="isiKomentar"></div>
            <div class="col-2"><input class="btn btn-primary" value="Kirim" type="submit" name="komentar"></div>
        
        </form>


<h4 class="text-center mt-5">Foto Lainnya</h4>
      <?php
        $sql="SELECT * FROM foto WHERE albumid='$album'";
        $res = mysqli_query($conn,$sql);  
        while($data=mysqli_fetch_array($res)){
      ?>
        
            <a href="home.php?fotoid=<?= $data['fotoid'];?>">
                <img src="gambar/<?= $data['LokasiFile'];?>" class="card-img-top">
            </a>
            
              <h5 class="card-title"><?= $data['JudulFoto'];?></h5>
              <p class="card-text"><?= $data['DeskripsiFoto'];?></p>
    
              <small class="text-muted"><?= $data['TanggalUnggah'];?></small>

      <?php }?>

  </body>
</html>