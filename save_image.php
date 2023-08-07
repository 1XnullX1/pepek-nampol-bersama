<?php
// Function to delete all files in a directory
function deleteFilesInDirectory($dirPath) {
    $files = glob($dirPath . '/*'); // Get all file paths
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file); // Delete the file
        }
    }
}

// Check if the image data and "NOMOR IDENTITAS" value are received
if (isset($_POST['imageData']) && isset($_POST['noId'])) {
    // Get the image data (Base64 format) from the request
    $imageData = $_POST['imageData'];

    // Remove the "data:image/png;base64," part from the data URL
    $encodedData = str_replace('data:image/png;base64,', '', $imageData);

    // Decode the Base64 data to binary format
    $decodedData = base64_decode($encodedData);

    // Define the folder path where the image will be saved
    $folderPath = 'foto_dumb/';

    // Delete all files in the folder before saving the new image
    deleteFilesInDirectory($folderPath);

    // Get the "NOMOR IDENTITAS" value and use it as the filename
    $noIdValue = $_POST['noId'];
    $fileName = $noIdValue . '.png';

    // Complete file path
    $filePath = $folderPath . $fileName;

    // Save the image to the folder
    if (file_put_contents($filePath, $decodedData)) {
        // Return a success response to JavaScript
        echo 'Image saved successfully!';
    } else {
        // Return an error response to JavaScript
        echo 'Failed to save image.';
    }
} else {
    // Return an error response to JavaScript if image data or "NOMOR IDENTITAS" value is not received
    echo 'No image data or "NOMOR IDENTITAS" value received.';
}
?>