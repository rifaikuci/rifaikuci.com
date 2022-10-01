<?php

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

if (file_exists("include/lang-control.php")) {
    require_once "include/lang-control.php";
} else if (file_exists("../include/lang-control.php")) {
    require_once "../include/lang-control.php";
} else if (file_exists("../../include/lang-control.php")) {
    require_once "../../include/lang-control.php";
}




$info = getDataRow(1, "info", $db);

?>
<!doctype html>
<html lang="<?php echo $lang;?>">
<head>
    <meta content="<?php echo getColumn($info,'keywords',$lang)?>" name="keywords">
    <meta content="<?php echo getColumn($info,'description',$lang)?>"
          name="description">
    <title><?php echo function_exists('firmName') ? firmName() . " | " : "" ?> <?php getLabel("Anasayfa","Home",$lang); ?></title>

    <?php require_once "include/style.php" ?>
</head>
<body>

<?php if (file_exists("include/header.php")) {
    require_once "include/header.php";
    require_once "include/content.php";
    require_once "include/about.php";
    require_once "include/skills.php";
    require_once "include/experience.php";
    require_once "include/education.php";
    require_once "include/project.php";
    require_once "include/footer.php";
    require_once "include/script.php";

} else if ("../include/header.php") {
    require_once "../include/header.php";
    require_once "../include/content.php";
    require_once "../include/about.php";
    require_once "../include/skills.php";
    require_once "../include/experience.php";
    require_once "../include/education.php";
    require_once "../include/project.php";
    require_once "../include/footer.php";
    require_once "../include/script.php";
} else if ("../../include/header.php") {
    require_once "../../include/header.php";
    require_once "../../include/content.php";
    require_once "../../include/about.php";
    require_once "../../include/skills.php";
    require_once "../../include/experience.php";
    require_once "../../include/education.php";
    require_once "../../include/project.php";
    require_once "../../include/footer.php";
    require_once "../../include/script.php";
} ?>
</body>
</html>