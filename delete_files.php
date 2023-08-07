<?php
function deleteFilesInFolder($folder_path) {
    // Get the list of files in the folder
    $files = glob($folder_path . "*");

    // Loop through each file and delete it
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
}

// Set the folder path to 'foto_dumb'
$folder_path = "foto_dumb/";

// Call the function to delete all files in the 'foto_dumb' folder
deleteFilesInFolder($folder_path);
?>