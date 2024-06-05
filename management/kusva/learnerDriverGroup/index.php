<?php


if(isset($_POST['groupDetailShow'] )) {

    require_once  'detail.php';
}

if (isset($_POST['learnerDriverGroupInsert'])) {

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;

    $data = array();


    $arrayKey = ["groupName"];
    $data = getDataForm($arrayKey);

    $sql = insert($data, "learnerDriverGroup");
    if (mysqli_query($db, $sql)) {

        header("Location:" . $path . "/?insert=ok");
        exit();
    } else {
        header("Location:" . $path . "/?insert=no");
        exit();
    }
}


if (isset($_GET['learnerDriverGroupDelete'])) {
    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;

    $id = $_GET['learnerDriverGroupDelete'];
    $sql = delete($id, 'learnerDriverGroup');
    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?delete=ok");
        exit();
    } else {
        header("Location:" . $path . "/?delete=no");
        exit();
    }
}

if (isset($_POST['learnerDriverGroupUpdate'])) {

    $dirName = basename(__DIR__);
    $fileName = basename(__FILE__, ".php");
    $path = base_url_back() . "src/" . $dirName;

    $id = $_POST['learnerDriverGroupUpdate'];
    $data = array();
    $arrayKey = ["groupName"];
    $data = getDataForm($arrayKey);


    $sql = update($data, "learnerDriverGroup", $id);
    if (mysqli_query($db, $sql)) {
        header("Location:" . $path . "/?update=ok");
        exit();
    } else {
        header("Location:" . $path . "/?update=no");
        exit();
    }
}

?>