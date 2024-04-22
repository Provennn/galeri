<?php
include "koneksi.php";
session_start();
if (isset($_POST['register'])){

    $username       =$_POST["username"];
    $password       =md5($_POST["password"]);
    $email          =$_POST["email"];
    $namalengkap    =$_POST["namalengkap"];
    $alamat         =$_POST["alamat"];

    $sql=mysqli_query ($conn, "INSERT INTO user values ('','$username','$password','$email','$namalengkap','$alamat')");

    if($sql){
            header ("location:login.php");
        }else {
            header ("location:register.php");
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Register</title>
</head>
<body>
    <table>
        <form method  ="post">
            <tr>
                <h2>REGISTER</h2>
</tr>
<tr>
    <td>Username:</td>
    <td><input type ="text" name="username"></td>
</tr>
<tr>
    <td>Password:</td>
    <td><input type ="password" name="password"></td>
</tr>
<tr>
    <td>Email:</td>
    <td><input type ="text" name="email"></td>
</tr>
<tr>
    <td>Nama Lengkap:</td>
    <td><input type ="text" name="namalengkap"></td>
</tr>
<tr>
    <td>Alamat:</td>
    <td><input type ="text" name="alamat"></td>
</tr>
<tr>
    <td></td>
    <td><input type ="submit" name="register" value ="submit"></td>
</tr>

</form>
</table>  
</body>
</html>