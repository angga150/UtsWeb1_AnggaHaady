<?php
session_start();

if( !isset($_SESSION['username']) ) {
    header("Location: index.php");
    exit;
}
?>

<?php
$nama_barang = ["Semangka", "Nanas", "Pisang", "Alpukat", "Jeruk",];
$harga_barang = [35000, 25000, 20000, 21000, 22000];

$beli = [];
$jumlah = [];
$total = [];
$grandtotal = 0;

$jumlah_item = rand(2, 5);

$pilih_index = array_rand($nama_barang, $jumlah_item);

if (!is_array($pilih_index)) {
    $pilih_index = [$pilih_index];
}

foreach ($pilih_index as $idx) {
    $beli[] = $nama_barang[$idx];
    $jumlah[] = rand(1, 5); 
}


// foreach ($beli as $i => $barang) {
//     $sub_total = $harga_barang[array_search($barang, $nama_barang)] * $jumlah[$i];
//     echo "<tr>
//             <td>{$barang}</td>
//             <td>Rp " . number_format($harga_barang[array_search($barang, $nama_barang)], 0, ',', '.') . "</td>
//             <td>{$jumlah[$i]}</td>
//             <td>Rp " . number_format($sub_total, 0, ',', '.') . "</td>
//           </tr>";
//     $grandtotal += $sub_total;
// }

// echo "<tr><td colspan='3'><b>Total Belanja</b></td>
//       <td><b>Rp " . number_format($grandtotal, 0, ',', '.') . "</b></td></tr>";
// echo "</table>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dashboard</title>
</head>
<style>
    * {
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
}

body {
  background: #f5f8ff;
  color: #333;
}

/* ====== NAVBAR ====== */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #fff;
  padding: 1rem 2rem;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.left-section {
  display: flex;
  align-items: center;
  gap: 15px;
}

.logo {
  background: #1a57e2;
  color: white;
  font-weight: 600;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.title h2 {
  font-size: 1.2rem;
  color: #1a57e2;
}

.title p {
  font-size: 0.8rem;
  color: #777;
}

.right-section {
  text-align: right;
}

.role {
  font-size: 0.8rem;
  color: #666;
}

.logout-btn {
  background: #fff;
  color: #1a57e2;
  border: 1px solid #1a57e2;
  padding: 6px 14px;
  border-radius: 6px;
  cursor: pointer;
  margin-top: 5px;
  transition: all 0.3s;
}

.logout-btn:hover {
  background: #1a57e2;
  color: #fff;
}

/* ====== MAIN CONTENT ====== */
.content {
  background: #fff;
  margin: 2rem auto;
  padding: 2rem;
  width: 90%;
  max-width: 800px;
  border-radius: 10px;
  box-shadow: 0 5px 20px rgba(0,0,0,0.05);
  text-align: center;
}

.content h3 {
  color: #1a57e2;
  margin-bottom: 5px;
}

.subtext {
  font-size: 0.85rem;
  color: #777;
  margin-bottom: 1.5rem;
}

/* ====== TABLE ====== */
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border-bottom: 1px solid #e6e6e6;
  padding: 10px;
  text-align: left;
}

th {
  background: #f8f9fc;
  font-weight: 600;
}

td {
  font-size: 0.95rem;
}

tfoot td {
  font-weight: 600;
  border-top: 2px solid #ccc;
}

.total-label {
  text-align: right;
}

.total-value {
  color: #1a57e2;
  text-align: right;
}

</style>
<body>
    <header class="navbar">
    <div class="left-section">
      <div class="logo">PM</div>
      <div class="title">
        <h2>--POLGAN MART--</h2>
        <p>Sistem Penjualan Sederhana</p>
      </div>
    </div>
    <div class="right-section">
      <p>Selamat datang, <strong>admin!</strong><br>
      <span class="role">Role: Dosen</span></p>
      <a href="logout.php" class="btn btn-primary">logout</a>
    </div>
  </header>

  <main class="content">
    <h3>Daftar Pembelian</h3>
    <p class="subtext">Daftar pembelian dibuat secara acak tiap kali halaman dimuat</p>

    <table>
      <thead>
        <tr>
          <th>Nama Barang</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <?php foreach ($beli as $i => $barang) : 
    $sub_total = $harga_barang[array_search($barang, $nama_barang)] * $jumlah[$i]; ?>
    <tr>
            <td><?=$barang;?></td>
            <td>Rp.<?php echo number_format($harga_barang[array_search($barang, $nama_barang)], 0, ',', '.') ?></td>
            <td><?=$jumlah[$i];?></td>
            <td>Rp.<?php echo number_format($sub_total, 0, ',', '.') ?></td>
          </tr>
<?php endforeach; 
$grandtotal += $sub_total;?>
      <tfoot>
        <tr>
          <td colspan="4" class="total-label">Total Belanja</td>
          <td class="total-value">Rp. <?php echo number_format($grandtotal, 0, ',', '.') ?></td>
        </tr>
      </tfoot>
    </table>
  </main>
</body>
</html>