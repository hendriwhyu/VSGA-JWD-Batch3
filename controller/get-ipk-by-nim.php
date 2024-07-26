<?php
include '../utils/config.php'; // Pastikan path sudah benar

$nim = $_GET['nim'] ?? '';

if ($nim) {
    // Query ke database untuk mendapatkan IPK
    $query = "SELECT ipk FROM nilai WHERE nim = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        echo json_encode(['ipk' => $row['ipk']]);
    } else {
        echo json_encode(['error' => 'No data found']);
    }
    $stmt->close();
} else {
    echo json_encode(['error' => 'NIM is required']);
}

$conn->close();
?>
