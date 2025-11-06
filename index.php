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
    <style>
            * {
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  background: #f5f8ff;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
}

.login-container {
  background: #fff;
  padding: 2rem 2.5rem;
  border-radius: 10px;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
  width: 320px;
  text-align: center;
}

h2 {
  color: #1a57e2;
  margin-bottom: 1rem;
  font-weight: 700;
}

.error-message {
  background: #ffe5e5;
  color: #d93025;
  padding: 10px;
  border-radius: 5px;
  margin-bottom: 1rem;
  font-size: 0.9rem;
}

form {
  text-align: left;
}

label {
  display: block;
  font-size: 0.9rem;
  margin: 0.5rem 0 0.3rem;
  color: #333;
}

input {
  width: 100%;
  padding: 10px;
  border: 1px solid #dcdcdc;
  border-radius: 6px;
  outline: none;
  font-size: 0.9rem;
}

input:focus {
  border-color: #1a57e2;
  box-shadow: 0 0 4px rgba(26, 87, 226, 0.3);
}

.login-btn {
  width: 100%;
  background: #1a57e2;
  color: #fff;
  border: none;
  padding: 10px;
  border-radius: 6px;
  font-size: 1rem;
  margin-top: 1rem;
  cursor: pointer;
  transition: background 0.3s;
}

.login-btn:hover {
  background: #004ad9;
}

.cancel-btn {
  width: 100%;
  background: #fff;
  color: #333;
  border: 1px solid #ccc;
  padding: 10px;
  border-radius: 6px;
  font-size: 1rem;
  margin-top: 0.5rem;
  cursor: pointer;
  transition: all 0.3s;
}

.cancel-btn:hover {
  background: #f0f0f0;
}

footer {
  font-size: 0.8rem;
  color: #777;
  margin-top: 1.5rem;
}

    </style>
</head>
<body>
<div class="login-container">
    <h2>POLGAN MART</h2>
    <form action="" method="post">
        <!-- username : <input type="text" name="username" placeholder="masukan username"><br>
        password : <input type="password" name="password" placeholder="masukan password"><br> -->

        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="masukan username">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukan Password">

        <button type="submit" class="login-btn">Login</button>

    </form>
</div>
</body>
</html>