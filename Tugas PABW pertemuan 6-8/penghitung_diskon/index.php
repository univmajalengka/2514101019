<?php
// Memanggil file koneksi & fungsi diskon
require_once 'koneksi.php';

$pesan = "";

// Proses Form Submit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['total_belanja'])) {
    $totalBelanja = floatval($_POST['total_belanja']);
    
    if ($totalBelanja > 0) {
        $diskon = hitungDiskon($totalBelanja);
        $totalBayar = $totalBelanja - $diskon;

        // Simpan Data ke Database
        $stmt = $conn->prepare("INSERT INTO transaksi (total_belanja, diskon, total_bayar) VALUES (?, ?, ?)");
        $stmt->bind_param("ddd", $totalBelanja, $diskon, $totalBayar);

        if ($stmt->execute()) {
            $pesan = "<div class='alert success'>
                <div class='alert-icon'>✓</div>
                <div>
                    <strong>Transaksi Berhasil Disimpan!</strong><br>
                    Total Belanja: <span>Rp " . number_format($totalBelanja, 0, ',', '.') . "</span><br>
                    Diskon: <span>Rp " . number_format($diskon, 0, ',', '.') . "</span><br>
                    <span class='highlight'>Total Bayar: Rp " . number_format($totalBayar, 0, ',', '.') . "</span>
                </div>
            </div>";
        } else {
            $pesan = "<div class='alert danger'><div class='alert-icon'>✕</div><div>Gagal menyimpan: " . $stmt->error . "</div></div>";
        }
        $stmt->close();
    } else {
        $pesan = "<div class='alert danger'><div class='alert-icon'>!</div><div>Masukkan total belanja yang valid!</div></div>";
    }
}

// Ambil Data Transaksi Terakhir
$result = $conn->query("SELECT id, total_belanja, diskon, total_bayar, created_at FROM transaksi ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskon Transaksi</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- File CSS Terpisah -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="wrapper">
    <!-- Form Card -->
    <div class="card">
        <div class="header">
            <div class="icon-box">🏷️</div>
            <h2>Perhitungan Diskon</h2>
            <p>Penghitung otomatis diskon kasir</p>
        </div>
        
        <?= $pesan; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="total_belanja">Total Belanja</label>
                <div class="input-wrapper">
                    <span>Rp</span>
                    <input type="number" id="total_belanja" name="total_belanja" placeholder="120.000" required min="1">
                </div>
            </div>
            <button type="submit" class="btn">Hitung Diskon & Simpan</button>
        </form>
    </div>

    <!-- Riwayat Transaksi Card -->
    <?php if ($result && $result->num_rows > 0): ?>
    <div class="history">
        <div class="history-header">
            <h3>Riwayat Transaksi</h3>
            <span class="badge">5 Terakhir</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Belanja</th>
                    <th>Diskon</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>Rp <?= number_format($row['total_belanja'], 0, ',', '.') ?></td>
                        <td>
                            <?php if ($row['diskon'] > 0): ?>
                                <span class="diskon-tag">-Rp <?= number_format($row['diskon'], 0, ',', '.') ?></span>
                            <?php else: ?>
                                <span style="color:#a0aec0;">Rp 0</span>
                            <?php endif; ?>
                        </td>
                        <td class="total-tag">Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

</body>
</html>
<?php $conn->close(); ?>