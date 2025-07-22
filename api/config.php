<?php
// Izinkan akses dari domain mana pun.
// Untuk produksi, ganti "*" dengan domain spesifik website Anda (contoh: "https://ucapan-ayah.com").
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, DELETE, PUT"); // Izinkan metode HTTP yang digunakan
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Konfigurasi Database
define('DB_SERVER', 'localhost'); // Biasanya 'localhost'
define('DB_USERNAME', 'root'); // GANTI DENGAN USERNAME DATABASE ANDA
define('DB_PASSWORD', ''); // GANTI DENGAN PASSWORD DATABASE ANDA
define('DB_NAME', 'ayah_birthday_messages'); // GANTI DENGAN NAMA DATABASE ANDA

// Membuat koneksi ke database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Koneksi database gagal: " . $conn->connect_error]);
    exit(); // Hentikan eksekusi jika koneksi gagal
}
?>