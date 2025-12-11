
<?php

$barang_list = [
    ["K001", "Semangka", 35000],
    ["K002", "Nanas", 25000],
    ["K003", "Pisang", 20000],
    ["K004", "Alpukat", 21000],
    ["K005", "Jeruk", 22000],
];

// DATA PEMBELIAN AWAL DIBUAT KOSONG DAN TOTAL DISET KE NOL
$belanja_awal = [];
$grandtotal_awal = 0;
$diskon_awal = 0;
$total_akhir_awal = 0;


// Format angka ke Rupiah
function format_rupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Fungsi untuk mendapatkan teks Diskon
function get_diskon_text($diskon_amount, $grandtotal) {
    if ($grandtotal == 0 || $diskon_amount == 0) return format_rupiah(0);
    $persen = round(($diskon_amount / $grandtotal) * 100);
    return format_rupiah($diskon_amount) . ($persen > 0 ? " (" . $persen . "%)" : "");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>POLGAN MART - Sistem Penjualan Sederhana</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        /* --- CSS (Sama seperti sebelumnya) --- */
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
        body {
            background: #f5f8ff;
            color: #333;
            padding: 0;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background: #fff;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
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
            border-radius: 5px;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.1rem;
        }
        .title h2 {
            font-size: 1.2rem;
            color: #1a57e2;
            margin-bottom: 3px;
        }
        .title p {
            font-size: 0.8rem;
            color: #777;
        }
        .right-section {
            text-align: right;
            line-height: 1.4;
        }
        .right-section p {
            font-size: 0.9rem;
            color: #333;
        }
        .right-section .role {
            font-size: 0.8rem;
            color: #777;
        }
        .right-section a {
            display: block;
            margin-top: 5px;
            font-size: 0.9rem;
            color: #1a57e2;
            text-decoration: none;
        }
        .content {
            background: #fff;
            margin: 0 auto;
            padding: 2rem;
            width: 90%;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
        .form-group input[type="number"] {
            -moz-appearance: textfield;
            appearance: textfield;
        }
        .actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            margin-bottom: 3rem;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
        }
        .btn-primary {
            background-color: #1a57e2;
            color: white;
        }
        .btn-secondary {
            background-color: #f0f0f0;
            color: #333;
        }
        h3.list-title {
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
            font-weight: 600;
            padding-top: 1.5rem;
            border-top: 1px solid #e6e6e6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            padding: 10px 15px;
            text-align: left;
            font-size: 0.95rem;
        }
        thead tr {
            border-bottom: 1px solid #e6e6e6;
        }
        th {
            font-weight: 600;
            color: #777;
        }
        tbody tr:last-child td {
            border-bottom: none;
        }
        .table-summary td {
            border-top: none !important;
            border-bottom: none !important;
            font-weight: 400;
        }
        .table-summary tr:nth-child(2) td,
        .table-summary tr:nth-child(3) td {
            padding-top: 5px;
        }
        .table-summary tr:last-child td {
            font-weight: 600;
            font-size: 1.05rem;
            border-top: 1px solid #e6e6e6 !important;
            padding-top: 10px;
        }
        .summary-label {
            text-align: right;
            font-weight: 600;
            width: 60%;
        }
        .summary-value {
            text-align: right;
            font-weight: 500;
            width: 40%;
        }
        .total-pay-value {
            color: #1a57e2;
        }
        .empty-cart-btn {
            background-color: transparent;
            color: #777;
            font-size: 0.9rem;
            text-align: left;
            margin-top: 15px;
            padding-left: 0;
            text-decoration: none;
        }
    </style>
</head>
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
            <p>Selamat datang, **ANGGA**<br>
            <span class="role">Role: Mahasiswa</span></p>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <main class="content">
        <div class="input-form">
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <select id="kode_barang" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 1rem;">
                    <option value="">Pilih Kode Barang</option>
                    <?php foreach ($barang_list as $barang): ?>
                        <option 
                            value="<?= $barang[0]; ?>" 
                            data-nama="<?= $barang[1]; ?>" 
                            data-harga="<?= $barang[2]; ?>"
                        >
                            <?= $barang[0] . " - " . $barang[1]; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" placeholder="Nama Barang" readonly> 
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" id="harga" placeholder="Harga" step="1000" min="0" readonly>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" placeholder="Masukkan Jumlah" min="1">
            </div>
            <div class="actions">
                <button class="btn btn-primary" id="btn-tambah">Tambahkan</button>
                <button class="btn btn-secondary" id="btn-batal">Batal</button>
            </div>
        </div>
        
        <h3 class="list-title">Daftar Pembelian</h3>
        <table>
           </thead>
<tbody id="keranjang"></tbody>
</table>

<!-- TABEL TOTAL PEMBAYARAN -->
<table class="table-summary" style="margin-top: 20px;">
    <tr>
        <td class="summary-label">Grand Total</td>
        <td class="summary-value" id="grandtotal">Rp 0</td>
    </tr>
    <tr>
        <td class="summary-label">Diskon</td>
        <td class="summary-value" id="diskon">Rp 0</td>
    </tr>
    <tr>
        <td class="summary-label">Total Akhir</td>
        <td class="summary-value total-pay-value" id="totalakhir">Rp 0</td>
    </tr>
</table>

<button class="btn btn-secondary" id="btn-kosongkan" style="margin-top:15px;">
    Kosongkan Barang
</button>

        </main>

  <script>
document.addEventListener('DOMContentLoaded', function() {

    const kodeInput = document.getElementById('kode_barang'); 
    const namaInput = document.getElementById('nama_barang');
    const hargaInput = document.getElementById('harga');
    const jumlahInput = document.getElementById('jumlah');
    const btnTambah = document.getElementById('btn-tambah');
    const btnBatal = document.getElementById('btn-batal');

    const keranjangBody = document.getElementById('keranjang');
    const grandtotalEl = document.getElementById('grandtotal');
    const diskonEl = document.getElementById('diskon');
    const totalakhirEl = document.getElementById('totalakhir');

    // FUNGSI FORMAT RUPIAH
    function rupiah(x) {
        return "Rp " + Number(x).toLocaleString("id-ID");
    }

    // AUTOFILL NAMA & HARGA
    kodeInput.addEventListener('change', function() {

        const selectedOption = kodeInput.options[kodeInput.selectedIndex];

        if (selectedOption.value === "") {
            namaInput.value = "";
            hargaInput.value = "";
            jumlahInput.value = "";
            return;
        }

        const nama = selectedOption.getAttribute('data-nama');
        const harga = selectedOption.getAttribute('data-harga');

        namaInput.value = nama;
        hargaInput.value = harga;
        jumlahInput.focus();
    });

    // CLEAR INPUT
    btnBatal.addEventListener('click', function() {
        kodeInput.value = "";
        namaInput.value = "";
        hargaInput.value = "";
        jumlahInput.value = "";
    });

    // TAMBAHKAN KE KERANJANG
    btnTambah.addEventListener('click', function() {

        const kode = kodeInput.value;
        const nama = namaInput.value;
        const harga = Number(hargaInput.value);
        const jumlah = Number(jumlahInput.value);

        if (!kode || !jumlah) {
            alert("Silakan pilih barang dan masukkan jumlah!");
            return;
        }

        const total = harga * jumlah;

        // Tambahkan baris baru ke tabel
        const row = `
            <tr>
                <td>${kode}</td>
                <td>${nama}</td>
                <td>${rupiah(harga)}</td>
                <td>${jumlah}</td>
                <td>${rupiah(total)}</td>
            </tr>
        `;

        keranjangBody.innerHTML += row;

        hitungTotal();

        // Clear form
        btnBatal.click();
    });

    // HITUNG TOTAL PEMBELIAN
    function hitungTotal() {
        let grandtotal = 0;

        document.querySelectorAll("#keranjang tr").forEach(tr => {
            const totalText = tr.children[4].innerText.replace(/Rp|\.|\s/g, "");
            grandtotal += Number(totalText);
        });

        let diskon = 0;
        if (grandtotal >= 100000) {
            diskon = grandtotal * 0.10;
        } else if (grandtotal >= 50000) {
            diskon = grandtotal * 0.05;
        }

        const totalakhir = grandtotal - diskon;

        grandtotalEl.innerText = rupiah(grandtotal);
        diskonEl.innerText = rupiah(diskon);
        totalakhirEl.innerText = rupiah(totalakhir);
    }

    // KOSONGKAN KERANJANG
    const btnKosongkan = document.getElementById('btn-kosongkan');

    btnKosongkan.addEventListener('click', function() {
        keranjangBody.innerHTML = "";
        grandtotalEl.innerText = rupiah(0);
        diskonEl.innerText = rupiah(0);
        totalakhirEl.innerText = rupiah(0);
        btnBatal.click();
    });

});
</script>
</body>
</html>
