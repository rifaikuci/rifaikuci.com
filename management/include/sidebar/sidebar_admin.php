<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">

        <?php

        $isInfoOpen = isTreeOpen(array('info', 'about', 'favIcon'));
        ?>
        <li class="nav-item <?php echo $isInfoOpen ? 'menu-open' : ''; ?>">
            <?php menuTreeTitle("Ayarlar", "fas fa-info"); ?>
            <ul class="nav nav-treeview">
                <?php menuTreeSubTitle("Genel Bilgiler",
                    "far fas fa-info nav-icon",
                    "src/info",
                    "", "");

                menuTreeSubTitle("Hakkımda",
                    "far fas fa-user nav-icon",
                    "src/about",
                    "", "");

                menuTreeSubTitle("Fav Icon",
                    "far fas fa-image nav-icon",
                    "src/favIcon",
                    "", "");
                ?>
            </ul>
        </li>
        <?php


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

        menuTreeSubTitle("Yazılar",
            "far fas fa-solid fa-newspaper nav-icon",
            "src/articles",
            "", "");

        menuTreeSubTitle("Api Key",
            "far fas fa-solid fa-key nav-icon",
            "src/collectionApi",
            "", "");

        $isInfoOpen2 = isTreeOpen(array('calculate/plus', 'calculate/percent', 'stockItem/', 'myStockList/', 'stockListHistory/'));
        ?>
        <li class="nav-item <?php echo $isInfoOpen2 ? 'menu-open' : ''; ?>">
            <?php menuTreeTitle("Hesaplamalar", "fas fa-calculator"); ?>
            <ul class="nav nav-treeview">

                <?php
                /* menuTreeSubTitle("Toplama Göre",
                     "far fas fa-plus nav-icon",
                     "src/calculate/plus",
                     "", "");

                */
                menuTreeSubTitle("Yüzdeye Göre",
                    "far fas fa-percent nav-icon",
                    "src/calculate/percent",
                    "", "");

                menuTreeSubTitle("Hisse Senetleri Tanım",
                    "far fas fa-percent nav-icon",
                    "src/stockItem",
                    "", "");

                menuTreeSubTitle("Senetlerim",
                    "far fas fa-percent nav-icon",
                    "src/myStockList",
                    "", "");

                menuTreeSubTitle("Arındırmalar",
                    "far fas fa-percent nav-icon",
                    "src/stockListHistory",
                    "", "");
                ?>


            </ul>
        </li>

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
        $isInfoOpen4 = isTreeOpen(array('learnerDriverUser', 'learnerDriverPayment', 'learnerDriverGroup'));
        ?>
        <li class="nav-item <?php echo $isInfoOpen4 ? 'menu-open' : ''; ?>">
            <?php menuTreeTitle("Sürücü Kursu", "fa fa-id-card"); ?>
            <ul class="nav nav-treeview">

                <?php
                menuTreeSubTitle("Sürücü Adayları",
                    "far fas fa-list nav-icon",
                    "src/learnerDriverUser",
                    "", "");

                menuTreeSubTitle("Ödeme Geçmişi",
                    "far fas fa-list nav-icon",
                    "src/learnerDriverPayment",
                    "", "");

                menuTreeSubTitle("Grup Bilgisi",
                    "far fas fa-list nav-icon",
                    "src/learnerDriverGroup",
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
