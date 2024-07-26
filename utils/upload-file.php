<?php
// Function to handle image upload
function uploadImage($file) {
    // Define file name
    $fileName       = $file['name'];
    // Define temporary file path
    $fileTemp       = $file['tmp_name'];
    // Define image path
    $imagePath      = "../assets/uploads/";
    // Define maximum file size (1MB)
    $maxSize        = 1 * 1024 * 1024;
    // Define allowed file types (jpg, png, jpeg, gif)
    $allowTypes     = ['jpg', 'png', 'jpeg', 'gif', 'pdf', 'zip'];
    // Check if file type is allowed
    $fileType       = pathinfo($fileName, PATHINFO_EXTENSION);

    // Check if file size is within the allowed limit
    if ($file['size'] > $maxSize) {
        return ['status' => 'error', 'message' => 'File size exceeds the maximum limit'];
    }
    // Check if file is uploaded successfully
    if (is_uploaded_file($fileTemp) && in_array($fileType, $allowTypes)) {
        $upload = move_uploaded_file($fileTemp, $imagePath . $fileName);
        if (!$upload) {
            return ['status' => 'error', 'message' => 'Failed to upload image'];
        }
        return ['status' => 'success', 'message' => 'Image has been uploaded successfully', 'fileName' => $fileName];
    } else {
        return ['status' => 'error', 'message' => 'Invalid file type or failed to move uploaded file'];
    }
}
?>