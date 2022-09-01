<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'skills', $db);

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("skillsUpdate", $id);
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Yetenekler (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, " Özellik Adı", "", "name", $row['name'], false, false);
                    getTextArea(12, "Açıklama", "", "description", 3, $row['description'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Yetenekler (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, " Özellik Adı", "", "nameE", $row['nameE'], false, false);
                    getTextArea(12, "Açıklama", "", "descriptionE", 3, $row['descriptionE'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php
            getTextInput(3, "Seviye", "", "level", $row['level'], false, false);
            getTextInput(3, "Class adı", "", "className", $row['className'], false, false);
            getSelect(3,$TYPE_SKILLS,"Kategori","type","",false,$row['type'],false,false);
            getInputFile(3, "image", "Resim", true, false, false);

            if ($row['image'])
                getViewFile(3, "Resim", $row['image']);
            ?>
        </div>

        <div class="card-footer">
            <?php getButton("btn btn-warning", 'left', "Vazgeç", "", false); ?>
            <?php getButton("btn btn-success", 'right', "Güncelle", "", false); ?>
        </div>
    </form>
</section>


