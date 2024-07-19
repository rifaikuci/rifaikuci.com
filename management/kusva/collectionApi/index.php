<?php

if (isset($_POST['collectionApiInsert'])) {


    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");

    $path = base_url_back() . "src/" . $dirName;
    if ($fileName != "index")
        $path = $path . "/" . $fileName;

    $data = array();

    $arrayKey = ["mail", "apiKey"];
    $data = getDataForm($arrayKey);

    $sql = insert($data, "collectionApi");
    if (mysqli_query($db, $sql)) {

        header("Location:" . $path . "/?insert=ok");
        exit();
    } else {

        header("Location:" . $path . "/?insert=no");
        exit();
    }
}

if (isset($_POST['collectionApiUpdate'])) {

    $id = $_POST['collectionApiUpdate'];

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");

    $path = base_url_back() . "src/" . $dirName;
    if ($fileName != "index")
        $path = $path . "/" . $fileName;

    $data = array();


    $arrayKey = ["mail", "apiKey"];
    $data = getDataForm($arrayKey);


    $sql = update($data, "collectionApi", $id);

    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?update=ok");
        exit();
    } else {
        header("Location:" . $path . "/?update=no");
        exit();
    }
}

if (isset($_GET['collectionApiDelete'])) {
    $id = $_GET['collectionApiDelete'];
    $sql = delete($id, 'collectionApi');
    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");

    $path = base_url_back() . "src/" . $dirName;
    if ($fileName != "index")
        $path = $path . "/" . $fileName;

    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?delete=ok");
        exit();
    } else {
        header("Location:" . $path . "/?delete=no");
        exit();
    }
}

?>