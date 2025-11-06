<?php
session_start();

if( isset($_SESSION['username']) ) {
    header("Location: dashboard.php");
    exit;
}

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if( $username == 'admin' && $password == '123' ) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    }
    else {
        $error = "user & pass salah";
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
    <h2>Form Login</h2>
    <form action="" method="post">
        username : <input type="text" name="username" placecholder="masukan username"><br>
        password : <input type="password" name="password" placeholder="masukan password"><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>