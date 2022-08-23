<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <div class="sidebar">

        <?php require_once "sidebar-top.php" ?>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <?php menuTreeSubTitle("Ayarlar",
                    "far fas fa-cog nav-icon",
                    "src/settings",
                    "", ""); ?>

                <?php menuTreeSubTitle("Project",
                    "far fas fa-list nav-icon",
                    "src/project",
                    "", ""); ?>
            </ul>
        </nav>
    </div>
</aside>