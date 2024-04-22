<?php
include "koneksi.php";
session_start();
if (isset($_POST['login'])) {
    $username= $_POST["username"];
    $password= md5($_POST["password"]);

    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $res = mysqli_query($conn,$sql);
    $hasil = mysqli_num_rows($res);
    
    if ($hasil>0){
        $row = mysqli_fetch_assoc($res);

        $_SESSION["userid"]         = $row["userid"];
        $_SESSION["username"]       = $row["username"];
        $_SESSION["password"]       = $row["password"];
        $_SESSION["email"]          = $row["email"];
        $_SESSION["namalengkap"]    = $row["namalengkap"];
        $_SESSION["alamat"]         = $row["alamat"];
        
        header("location: home.php");
    }else {
        mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
    <table>
        <form method="post">
            <tr>
                <h2>Login</h2>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="login" value="submit"></td>
            </tr>
        </form>
    </table>
</body>
</html>