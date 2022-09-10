<?php

if (file_exists("include/lang-control.php")) {
    require_once "include/lang-control.php";
} else if (file_exists("../include/lang-control.php")) {
    require_once "../include/lang-control.php";
} else if (file_exists("../../include/lang-control.php")) {
    require_once "../../include/lang-control.php";
}


if (file_exists("common/db/index.php")) {
    require_once "common/db/index.php";
    require_once "common/methods/index.php";
    require_once "common/data/index.php";
} else if (file_exists("../common/db/index.php")) {
    require_once "../common/db/index.php";
    require_once "../common/methods/index.php";
    require_once "../common/data/index.php";
} else if (file_exists("../../common/db/index.php")) {
    require_once "../../common/db/index.php";
    require_once "../../common/methods/index.php";
    require_once "../../common/data/index.php";
} else if (file_exists("../../../../common/db/index.php")) {
    require_once "../../../../common/db/index.php";
    require_once "../../../../common/methods/index.php";
    require_once "../../../../common/data/index.php";
}

if(isset($_GET['seo']) && $_GET['seo']) {
    $seo = $_GET['seo'];
    $sql = "SELECT * FROM projects where seoTitle = '$seo' or seoTitleE = '$seo'";
    $project = mysqli_query($db,$sql)->fetch_assoc();
}



?>


<!doctype html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta content="<?php echo getColumn($project, 'keywords', $lang) ?>" name="keywords">
    <meta content="<?php echo getColumn($project, 'description', $lang) ?>"
          name="description">
    <title><?php echo function_exists('firmName') ? firmName() . " | " . getColumn($project,"title", $lang) : ""   ?></title>

    <?php

    if (file_exists("include/style.php"))
        require_once "include/style.php";
    else if (file_exists("../include/style.php"))
        require_once "../include/style.php";
    else if (file_exists("../../include/style.php"))
        require_once "../../include/style.php";
    ?>
</head>
<body>

<?php
if (file_exists("include/header.php"))
    require_once "include/header.php";
else if (file_exists("../include/header.php"))
    require_once "../include/header.php";
else if (file_exists("../../include/header.php"))
    require_once "../../include/header.php";


require_once "main.php";

if (file_exists("include/footer.php")) {
    require_once "include/footer.php";
    require_once "include/script.php";

} else if ("../include/footer.php") {
    require_once "../include/footer.php";
    require_once "../include/script.php";
} else if ("../../include/footer.php") {
    require_once "../../include/footer.php";
    require_once "../../include/script.php";
} ?>


</body>
</html>