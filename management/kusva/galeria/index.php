<?phpif (!empty($_FILES) && isset($_POST['galeriaInsert'])) {    $image = imageUpload("galeria", "file", "");    $sql = "INSERT INTO galeria (image)    VALUES ('$image')";    mysqli_query($db, $sql);}if (isset($_GET['imageSil'])) {    $dirName = isset($_GET['dirName']) ? $_GET['dirName'] : __DIR__;    if (isset($_GET['productId'])) {        $path = base_url_back() . "src/" . $dirName . "/uploadImages?id=" . $_GET['productId'];    } else {        $path = base_url_back() . "src/" . $dirName;    }    $id = $_GET['imageSil'];    $row = getDataRow($id, 'galeria', $db);    $file = $row['image'];    if (file_exists("../" . $file)) {        unlink("../" . $file);    }    $sql = delete($id, "galeria");    if (mysqli_query($db, $sql)) {        if ($_GET['productId']) {            header("Location:" . $path . "&delete=ok");            exit();        } else {            header("Location:" . $path . "/?delete=ok");            exit();        }    } else {        if (file_exists("../" . $file)) {            unlink("../" . $file);        }        if ($_GET['productId']) {            header("Location:" . $path . "&delete=no");            exit();        } else {            header("Location:" . $path . "/?delete=no");            exit();        }        exit();    }}function imageDeleteByProductId($tableName, $productId,$db){    $sql = "SELECT * FROM galeria where tblName = '$tableName' and productId = '$productId' ";;    $result = $db->query($sql);    while ($row = $result->fetch_array()) {        $id = $row['id'];        $file = $row['image'];        if (file_exists("../" . $file)) {            unlink("../" . $file);        }        $sql = delete($id, "galeria");        mysqli_query($db, $sql);    }}?>