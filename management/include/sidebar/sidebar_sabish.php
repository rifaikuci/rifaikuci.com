<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">

        <?php

        $isInfoOpen3 = isTreeOpen(array('sabish/matchingGameCategory', 'sabish/matchingGamePr'));
        ?>
        <li class="nav-item <?php echo $isInfoOpen3 ? 'menu-open' : ''; ?>">
            <?php menuTreeTitle("Sabish", "fas fa-building"); ?>
            <ul class="nav nav-treeview">

                <?php
                menuTreeSubTitle("Eşleştirme Kategori Pr",
                    "far fas fa-list nav-icon",
                    "src/sabish/matchingGamePr",
                    "", "");

                menuTreeSubTitle("Eşleştirme Kategorileri",
                    "far fas fa-gamepad nav-icon",
                    "src/sabish/matchingGameCategory",
                    "", "");
                ?>


            </ul>
        </li>


        <?php
        menuLabel("Site Bilgileri", "green");

        menuTitleWithDot("Siteye Giriş", "primary", base_url_front(), "_blank");
        menuTitleWithDot("Çıkış Yap", "danger", base_url_back() . "kusva/?logout=true", "")
        ?>


    </ul>
</nav>
