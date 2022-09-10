<?php
if (file_exists("utils/index.php"))
    require_once "utils/index.php";
else if (file_exists("../utils/index.php"))
    require_once "../utils/index.php";
else if (file_exists("../../utils/index.php"))
    require_once "../../utils/index.php";
else if (file_exists("../../../utils/index.php"))
    require_once "../../../utils/index.php";
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url_back() . "style/dist/img/favIcon/icon.png"; ?>">

    <title><?php echo function_exists('firmName') ? firmName() . " | " : "" ?> Anasayfa</title>
    <?php
    if (file_exists("include/style.php"))
        require_once "include/style.php";
    else if (file_exists("../include/style.php"))
        require_once "../include/style.php";
    else if (file_exists("../../include/style.php"))
        require_once "../../include/style.php";
    else if (file_exists("../../../include/style.php"))
        require_once "../../../include/style.php";
    ?>
</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <?php
        if (file_exists("include/sidebar-menu-icon.php")) {
            require_once "include/sidebar-menu-icon.php";
            require_once "include/top-bar-notification.php";
        } else if (file_exists("../include/sidebar-menu-icon.php")) {
            require_once "../include/sidebar-menu-icon.php";
            require_once "../include/top-bar-notification.php";
        } else if (file_exists("../../include/sidebar-menu-icon.php")) {
            require_once "../../include/sidebar-menu-icon.php";
            require_once "../../include/top-bar-notification.php";
        } else if (file_exists("../../../include/sidebar-menu-icon.php")) {
            require_once "../../../include/sidebar-menu-icon.php";
            require_once "../../../include/top-bar-notification.php";
        } ?>

    </nav>

    <?php
    if (file_exists("include/sidebar.php"))
        require_once "include/sidebar.php";
    else if (file_exists("../include/sidebar.php"))
        require_once "../include/sidebar.php";
    else if (file_exists("../../include/sidebar.php"))
        require_once "../../include/sidebar.php";
    else if (file_exists("../../../include/sidebar.php"))
        require_once "../../../include/sidebar.php";
    ?>

    <div class="content-wrapper">
        <?php require_once "main.php" ?>
    </div>

    <?php
    if (file_exists("include/footer.php"))
        require_once "include/footer.php";
    else if (file_exists("../include/footer.php"))
        require_once "../include/footer.php";
    else if (file_exists("../../include/footer.php"))
        require_once "../../include/footer.php";
    else if (file_exists("../../../include/footer.php"))
        require_once "../../../include/footer.php";
    ?>

</div>

<?php
if (file_exists("include/script.php"))
    require_once "include/script.php";
else if (file_exists("../include/script.php"))
    require_once "../include/script.php";
else if (file_exists("../../include/script.php"))
    require_once "../../include/script.php";
else if (file_exists("../../../include/script.php"))
    require_once "../../../include/script.php";
?>
</body>
</html>
