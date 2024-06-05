

<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("learnerDriverGroupInsert", "learnerDriverGroupInsert");
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <h3 class="card-title">Grup Ekleme</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(8, "Grup Adı", "", "groupName", "", false, false);

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


