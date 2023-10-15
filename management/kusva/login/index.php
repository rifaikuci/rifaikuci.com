<?php
if (isset($_POST['loginControl'])) {

    $name = $_POST['name'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM info WHERE mail = '$name'  AND password = '$password' ";
    $sonuc = mysqli_query($db, $sql);
    $row = $sonuc->fetch_assoc();
    if ($row && count($row) > 0) {
        $_SESSION['management'] = uniqid();
        header("Location:" . base_url_back());
        exit();
    } else {
        header("Location:" . base_url_back() . "src/login/?kullanici=no");
        exit();
    }


}

if (isset($_GET['logout'])) {

    session_destroy();
    header("Location:" . base_url_back() ."/src/login");
}

?>