<?php


function imageUpload( $folderName, $name, $fileName)
{
    $path = imageBaseUrl();
    if(file_exists(imageBaseUrl())) {
        $path =imageBaseUrl();
    } else if(file_exists("../".imageBaseUrl())){
        $path = "../".imageBaseUrl();
    } else if(file_exists("../../".imageBaseUrl())){
        $path = "../../".imageBaseUrl()."/";
    } else if(file_exists("../../../".imageBaseUrl())){
        $path = "../../../".imageBaseUrl()."/";
    }



    if (!file_exists($path . $folderName)) {
        mkdir($path . $folderName, 0777, true);
    }

    $target_dir = $path . $folderName;

    $target_file = $target_dir . "/" . basename($_FILES[$name]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($fileName) {
        $target_file = imageBaseUrl() . $folderName . "/" . $fileName . "." . $imageFileType;
    } else {
        $uniq = uniqid();
        $target_file = imageBaseUrl() . $folderName . "/" . $uniq. "." . $imageFileType;
    }

    if ($_FILES[$name]["size"] > 5000000) { // 5 mb
        return "image_large";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        return "image_invalid_type";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        return "image_not_upload";
    } else {
        if (move_uploaded_file($_FILES[$name]["tmp_name"], "../" . $target_file)) {
            if ($fileName) {
                return imageBaseUrl() . $folderName . "/" . $fileName . "." . $imageFileType;
            } else {
                return imageBaseUrl() . $folderName . "/" . $uniq . "." . $imageFileType;
            }
        } else {
            return "image_not_upload";
        }
    }
}

function pdfUpload( $folderName, $name, $fileName)
{
    $path = pdfBaseUrl();
    if(file_exists(pdfBaseUrl())) {
        $path =pdfBaseUrl();
    } else if(file_exists("../".pdfBaseUrl())){
        $path = "../".pdfBaseUrl();
    } else if(file_exists("../../".pdfBaseUrl())){
        $path = "../../".pdfBaseUrl()."/";
    } else if(file_exists("../../../".pdfBaseUrl())){
        $path = "../../../".pdfBaseUrl()."/";
    }



    if (!file_exists($path . $folderName)) {
        mkdir($path . $folderName, 0777, true);
    }

    $target_dir = $path . $folderName;

    $target_file = $target_dir . "/" . basename($_FILES[$name]["name"]);
    $uploadOk = 1;


    $imageFileType = "pdf";

    if ($fileName) {
        $target_file = pdfBaseUrl() . $folderName . "/" . $fileName . "." . $imageFileType;
    } else {
        $uniq = uniqid();
        $target_file = pdfBaseUrl() . $folderName . "/" . $uniq. "." . $imageFileType;
    }

    if ($_FILES[$name]["size"] > 9000000) { // 9 mb
        return "pdf_large";
        $uploadOk = 0;
    }

    if ($imageFileType != "pdf") {
        return "pdf_invalid_type";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        return "pdf_not_upload";
    } else {
        if (move_uploaded_file($_FILES[$name]["tmp_name"], "../" . $target_file)) {
            if ($fileName) {
                return pdfBaseUrl() . $folderName . "/" . $fileName . "." . $imageFileType;
            } else {
                return pdfBaseUrl() . $folderName . "/" . $uniq . "." . $imageFileType;
            }
        } else {
            return "pdf_not_upload";
        }
    }
}

?>
