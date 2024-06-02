<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">

        <?php
        $isInfoOpen4 = isTreeOpen(array('learnerDriver/', 'learnerDriverPayment'));
        ?>
        <li class="nav-item <?php echo $isInfoOpen4 ? 'menu-open' : ''; ?>">
            <?php menuTreeTitle("Sürücü Kursu", "fa fa-id-card"); ?>
            <ul class="nav nav-treeview">

                <?php
                menuTreeSubTitle("Sürücü Adayları",
                    "far fas fa-list nav-icon",
                    "src/learnerDriver/",
                    "", "");

                menuTreeSubTitle("Ödeme Geçmişi",
                    "far fas fa-list nav-icon",
                    "src/learnerDriverPayment",
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
