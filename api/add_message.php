<?php
include 'config.php'; // Sertakan file konfigurasi database

// Menerima data JSON dari body permintaan
$data = json_decode(file_get_contents("php://input"));

// Memeriksa apakah data yang diperlukan ada
if (!isset($data->sender) || !isset($data->text)) {
    echo json_encode(["success" => false, "message" => "Data tidak lengkap: pengirim atau teks hilang."]);
    $conn->close();
    exit();
}

// Melindungi dari SQL Injection
$sender = $conn->real_escape_string($data->sender);
$message_text = $conn->real_escape_string($data->text);
// image_url bisa null jika tidak ada gambar
$image_url = isset($data->imageUrl) ? $conn->real_escape_string($data->imageUrl) : null;

$sql = "INSERT INTO messages (sender, message_text, image_url) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $sender, $message_text, $image_url); // "sss" untuk tiga string

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Ucapan berhasil ditambahkan."]);
} else {
    echo json_encode(["success" => false, "message" => "Error menambahkan ucapan: " . $stmt->error]);
}

$stmt->close();
$conn->close(); // Tutup koneksi database
?>