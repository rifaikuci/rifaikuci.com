<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <div class="sidebar">

        <?php require_once "sidebar-top.php" ?>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <?php menuTreeSubTitle("Genel Bilgiler",
                    "far fas fa-info nav-icon",
                    "src/info",
                    "", ""); ?>

                <?php menuTreeSubTitle("Sosyal Medyalar",
                    "far fas fa-hashtag nav-icon",
                    "src/smedia",
                    "", ""); ?>

            </ul>
        </nav>
    </div>
</aside>