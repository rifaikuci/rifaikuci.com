<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'stock', $db);

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("stockUpdate", $id);

        ?>
        <div class="card card-dark">

            <div class="card-header">
                <h3 class="card-title">Hisse Senet Bilgileri</h3>

            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextHidden("stockUpdate", $id);

                    getTextInput(3, "Kısa Adı", "", "shortName", $row['shortName'], false, false);
                    getTextInput(6, "Uzun Adı", "", "fullName", $row['fullName'], false, false);
                    getTextInput(3, "Link", "", "link", $row['link'], false, false);
                    getTextInput(3, "B Value", "", "bValue", $row['bValue'], false, false);
                    getTextInput(3, "C Value", "", "cValue", $row['cValue'], false, false);
                    getTextInput(3, "Total Lot", "", "totalLot", $row['totalLot'], false, false);
                    getTextInput(3, "Aylık ", "", "month", $row['month'], false, false);
                    ?>

                </div>

            </div>
        </div>




        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Güncelle", "", false); ?>
        </div>
    </form>
</section>


