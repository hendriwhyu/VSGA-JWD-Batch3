<?php
include_once "../utils/config.php";
include_once "../utils/upload-file.php";

// create insert data
function insertData($conn, $postData, $fileName) {
    $nama = $postData['nama'];
    $nim = $postData['nim'];
    $email = $postData['email'];
    $no_hp = $postData['no_hp'];
    $semester = $postData['semester'];
    $ipk = $postData['ipk'];
    $beasiswa = $postData['beasiswa'];

    // Escape variables for security
    $nama = mysqli_real_escape_string($conn, $nama);
    $email = mysqli_real_escape_string($conn, $email);
    $no_hp = mysqli_real_escape_string($conn, $no_hp);
    $semester = (int)$semester;
    $ipk = (float)$ipk;
    $beasiswa = mysqli_real_escape_string($conn, $beasiswa);
    $status_ajuan = 0;

    if (empty($semester) || $semester <= 0) {
        return ['status' => 'error', 'message' => 'Semester tidak boleh kosong atau kurang dari 1'];
    }

    $query = "INSERT INTO mahasiswa (nama, nim, email, no_hp, semester, ipk, beasiswa, status_ajuan, file) 
              VALUES ('$nama', '$nim', '$email', '$no_hp', $semester, $ipk, '$beasiswa', '$status_ajuan','$fileName')";

    $result = mysqli_query($conn, $query);
    if (!$result) {
        $message = "Error: " . $query . "<br>" . mysqli_error($conn);
        return ['status' => 'error', 'message' => $message];
    }

    return ['status' => 'success'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get function to uploadImage
    $fileUploadResult = uploadImage($_FILES['file']);
    // Check if image upload was successful or not
    if ($fileUploadResult['status'] == 'success') {
        // If image upload is successful, insert product data into the database
        $insertResult = insertData($conn, $_POST, $fileUploadResult['fileName']);
        if ($insertResult['status'] == 'success') {
            header('Location: ../pages/hasil.php');
        } else {
            $message = $insertResult['message'];
            echo "<script>alert('$message'); window.history.back();</script>";
        }
    } else {
        $message = $fileUploadResult['message'];
        echo "<script>alert('$message'); window.history.back();</script>";
    }
}
?>
