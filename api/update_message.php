<?php
include 'config.php'; // Sertakan file konfigurasi database

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id) || !isset($data->sender) || !isset($data->text)) {
    echo json_encode(["success" => false, "message" => "Data tidak lengkap untuk pembaruan."]);
    $conn->close();
    exit();
}

$id = $conn->real_escape_string($data->id);
$sender = $conn->real_escape_string($data->sender);
$message_text = $conn->real_escape_string($data->text);
$image_url = isset($data->imageUrl) ? $conn->real_escape_string($data->imageUrl) : null;

$sql = "UPDATE messages SET sender = ?, message_text = ?, image_url = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $sender, $message_text, $image_url, $id); // "sssi" untuk 3 string dan 1 integer

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Ucapan berhasil diperbarui."]);
    } else {
        echo json_encode(["success" => false, "message" => "Tidak ada perubahan pada ucapan atau ID tidak ditemukan."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Error memperbarui ucapan: " . $stmt->error]);
}

$stmt->close();
$conn->close(); // Tutup koneksi database
?>