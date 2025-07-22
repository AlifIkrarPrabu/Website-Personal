<?php
include 'config.php'; // Sertakan file konfigurasi database

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id)) {
    echo json_encode(["success" => false, "message" => "ID ucapan tidak ditemukan."]);
    $conn->close();
    exit();
}

$id = $conn->real_escape_string($data->id);

$sql = "DELETE FROM messages WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); // "i" untuk integer

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Ucapan berhasil dihapus."]);
    } else {
        echo json_encode(["success" => false, "message" => "Ucapan dengan ID tersebut tidak ditemukan."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Error menghapus ucapan: " . $stmt->error]);
}

$stmt->close();
$conn->close(); // Tutup koneksi database
?>