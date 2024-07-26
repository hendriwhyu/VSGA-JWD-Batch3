<?php
include_once "../utils/config.php";

function validateData($conn, $id) {
    // Update query to set status to 'terverifikasi'
    $query = "UPDATE mahasiswa SET status_ajuan = 1 WHERE id = $id";
    
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        $message = "Error: " . $query . "<br>" . mysqli_error($conn);
        return ['status' => 'error', 'message' => $message];
    }
    
    return ['status' => 'success', 'message' => 'Data berhasil divalidasi'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $id = $_POST['id'];
    
    if ($action === 'validate') {
        $validationResult = validateData($conn, $id);
        
        if ($validationResult['status'] == 'success') {
            header('Location: ../pages/hasil.php');
        } else {
            $message = $validationResult['message'];
            echo "<script>alert('$message'); window.history.back();</script>";
        }
    }
}
?>
