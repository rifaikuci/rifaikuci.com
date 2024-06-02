<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <div class="sidebar">

        <?php require_once "sidebar-top.php" ?>

        <?php if ($userInfo['rol'] == "ADMIN") {
            require_once "sidebar/sidebar_admin.php";
        } else if ($userInfo['rol'] == "PERSON_SURUCU") {
            require_once "sidebar/sidebar_person_surucu.php";
        } else if ($userInfo['rol'] == "PERSON_SABISH") {
            require_once "sidebar/sidebar_sabish.php";
        }
        ?>

    </div>
</aside>