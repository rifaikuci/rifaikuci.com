<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <div class="sidebar">

        <?php require_once "sidebar-top.php" ?>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <?php
                menuTreeSubTitle("Genel Bilgiler",
                    "far fas fa-info nav-icon",
                    "src/info",
                    "", "");

                menuTreeSubTitle("Sosyal Medyalar",
                    "far fas fa-hashtag nav-icon",
                    "src/smedia",
                    "", "");

                menuTreeSubTitle("Eğitim Bilgileri",
                    "far fas fa-graduation-cap nav-icon",
                    "src/education",
                    "", "");

                menuTreeSubTitle("Kitap Listesi",
                    "far fas fa-book nav-icon",
                    "src/books",
                    "", "");

                menuTreeSubTitle("Dil Listesi",
                    "far fas fa-language nav-icon",
                    "src/languages",
                    "", "");

                menuTreeSubTitle("Sertifika Listesi",
                    "far fas fa-stamp nav-icon",
                    "src/certificate",
                    "", "");

                menuTreeSubTitle("Yetenekler",
                    "far fas fa-sitemap nav-icon",
                    "src/skills",
                    "", "");

                menuTreeSubTitle("Deneyimler",
                    "far fas fa-vials nav-icon",
                    "src/experience",
                    "", "");
                menuTreeSubTitle("Projeler",
                    "far fas fa-solid fa-bars nav-icon",
                    "src/projects",
                    "", "");
                ?>

            </ul>
        </nav>
    </div>
</aside>