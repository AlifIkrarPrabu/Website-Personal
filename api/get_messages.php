<?php
include 'config.php'; // Sertakan file konfigurasi database

$sql = "SELECT id, sender, message_text, image_url, timestamp FROM messages ORDER BY timestamp DESC";
$result = $conn->query($sql);

$messages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Format timestamp agar lebih mudah dibaca di JavaScript jika perlu
        // $row['timestamp'] = date('Y-m-d H:i:s', strtotime($row['timestamp']));
        $messages[] = $row;
    }
}

echo json_encode($messages); // Mengembalikan data dalam format JSON
$conn->close(); // Tutup koneksi database
?>