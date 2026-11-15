<?php
// Konfigurasi Database
$db_host = "localhost";
$db_user = "root";       
$db_pass = "";           
$db_name = "toko_online";

// Membuat Koneksi
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

/**
 * Prosedur/Fungsi Menghitung Diskon
 */
function hitungDiskon($totalBelanja) {
    if ($totalBelanja >= 100000) {
        return 0.10 * $totalBelanja; // Diskon 10%
    } elseif ($totalBelanja >= 50000) {
        return 0.05 * $totalBelanja; // Diskon 5%
    }
    return 0; // Tanpa diskon
}
?>