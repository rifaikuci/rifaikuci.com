<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'learnerDriverGroup', $db);

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("learnerDriverGroupUpdate", $id);

        ?>
        <div class="card card-dark">

            <div class="card-header">
                <h3 class="card-title">Grup Bilgi Güncelleme</h3>

            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextHidden("learnerDriverGroupUpdate", $id);
                    getTextInput(8, "Grup Adı", "", "groupName", $row['groupName'], false, false);


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


