<?php

if (isset($_POST['aboutUpdate'])) {

    $id = $_POST['aboutUpdate'];
    $dirName = basename(__DIR__);
    $path = base_url_back() . "src/" . $dirName;
    $data = array();

    if (isset($_FILES['cv']) && $_FILES['cv']['name']) {
        $file = pdfUpload("about", 'cv', 'rifaikuci_cv_tr');
        if ($file == "pdf_large" || $file == "pdf_invalid_type" || $file == "pdf_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file);
            exit();
        }

        if (isset($_POST['deleteFile']) && $_POST['deleteFile']) {
            if (file_exists("../" . $_POST['deleteFile'])) {
                unlink("../" . $_POST['deleteFile']);
            }
        }
    }

    if (isset($_FILES['cvE']) && $_FILES['cvE']['name']) {
        $file2 = pdfUpload("about", 'cvE', 'rifaikuci_cv_eng');
        if ($file2 == "pdf_large" || $file2 == "pdf_invalid_type" || $file2 == "pdf_not_upload") {
            header("Location:" . $path . "/index.php?hata=" . $file2);
            exit();
        }

        if (isset($_POST['deleteFileE']) && $_POST['deleteFileE']) {
            if (file_exists("../" . $_POST['deleteFileE'])) {
                unlink("../" . $_POST['deleteFileE']);
            }
        }
    }

    $arrayKey = [
        "about", "aboutE", "title", "titleE","keywords", "keywordsE","description", "descriptionE", "link","linkE"
    ];
    $data = getDataForm($arrayKey);

    if (isset($_FILES['cv']) && $_FILES['cv']['name']) $data['cv'] = $file;
    if (isset($_FILES['cvE']) && $_FILES['cvE']['name']) $data['cvE'] = $file2;

    $sql = update($data, "about", $id);
    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?update=ok");
        exit();
    } else {
        if (file_exists("../" . $file)) {
            unlink("../" . $file);
        }
        header("Location:" . $path . "/?update=no");
        exit();
    }
}

?>