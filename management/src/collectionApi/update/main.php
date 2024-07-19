<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'collectionApi', $db);

}
?>

<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("collectionApiUpdate", $id);

        ?>
        <div class="card card-dark">

            <div class="card-header">
                <h3 class="card-title">Api Key Güncelleme</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(12, "Mail", "", "mail", $row['mail'], true, false);
                    getTextInput(12, "Api Key", "", "apiKey", $row['apiKey'], true, false);
                    getDatetime(4,"Kayıt Tarihi","insertDate",$row['insertDate'],false,true);

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


