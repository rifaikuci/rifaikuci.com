<?php

function getBasePath($baseFunc) {
    $paths = [
        $baseFunc(),
        "../" . $baseFunc(),
        "../../" . $baseFunc(),
        "../../../" . $baseFunc()
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            return rtrim($path, '/') . '/';
        }
    }

    return null; // Return null if no valid path is found
}

function validateImage($name) {
    if ($_FILES[$name]["size"] > 5000000) {
        return "image_large";
    }

    $imageFileType = strtolower(pathinfo($_FILES[$name]["name"], PATHINFO_EXTENSION));
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        return "image_invalid_type";
    }

    return null; // Return null if valid
}

function imageUpload($folderName, $name, $fileName) {
    $path = getBasePath('imageBaseUrl');
    if (!$path) {
        return "base_path_not_found";
    }

    // Ensure the folder exists
    if (!file_exists($path . $folderName)) {
        mkdir($path . $folderName, 0777, true);
    }

    // Validate the image
    $validationError = validateImage($name);
    if ($validationError) {
        return $validationError;
    }

    // Prepare the target file path
    $imageFileType = strtolower(pathinfo($_FILES[$name]["name"], PATHINFO_EXTENSION));
    $uniq = $fileName ?: uniqid();
    $target_file = $folderName . "/" . $uniq . "." . $imageFileType;

    // Attempt to move uploaded file
    $uploadSuccess = move_uploaded_file($_FILES[$name]["tmp_name"], $path . $target_file);

    return $uploadSuccess ? "assets/images/" . $target_file : "image_not_upload"; // Final return
}


function pdfUpload($folderName, $name, $fileName) {
    $path = getBasePath('pdfBaseUrl');
    if (!$path) {
        return "base_path_not_found";
    }

    // Ensure the folder exists
    if (!file_exists($path . $folderName)) {
        mkdir($path . $folderName, 0777, true);
    }

    // Validate the PDF
    $validationError = validatePdf($name);
    if ($validationError) {
        return $validationError;
    }

    // Prepare the target file path
    $uniq = $fileName ?: uniqid();
    $target_file = $folderName . "/" . $uniq . ".pdf";

    // Attempt to move uploaded file
    $uploadSuccess = move_uploaded_file($_FILES[$name]["tmp_name"], $path . $target_file);

    return $uploadSuccess ? "assets/pdf/" . $target_file : "pdf_not_upload"; // Final return
}

function validatePdf($name) {
    if ($_FILES[$name]["size"] > 9000000) { // 9 MB
        return "pdf_large";
    }

    if (strtolower(pathinfo($_FILES[$name]["name"], PATHINFO_EXTENSION)) !== "pdf") {
        return "pdf_invalid_type";
    }

    return null; // Return null if valid
}



?>
