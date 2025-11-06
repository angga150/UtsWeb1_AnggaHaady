<?php
session_start();

if( !isset($_SESSION['username']) ) {
    header("Location: login.php");
    exit;
}
?>

<?php
$nama_barang = ["Semangka", "Nanas", "Pisang", "Alpukat", "Jeruk",];
$harga_barang = [35000, 25000, 20000, 21000, 22000];

echo "<h2>-- Polgan Mart --</h2>";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dashboard</title>
</head>
<body>
    <h2>SELAMAT DATANG <?= $_SESSION['username'];?></h2>
    <a href="logout.php">Logout</a>
</body>
</html>