

<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("stockInsert","stockInsert");
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <h3 class="card-title">Hisse Senet Bilgileri</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, "Kısa Adı", "", "shortName", '', false, false);
                    getTextInput(6, "Uzun Adı", "", "fullName", '', false, false);
                    getTextInput(3, "Link", "", "link", '', false, false);
                    getTextInput(3, "B Value", "", "bValue", '', false, false);
                    getTextInput(3, "C Value", "", "cValue", '', false, false);
                    getTextInput(3, "Total Lot", "", "totalLot", '', false, false);
                    getTextInput(3, "Aylık ", "", "month", '', false, false);
                    ?>

                </div>

            </div>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Ekle", "", false); ?>
        </div>
    </form>
</section>


