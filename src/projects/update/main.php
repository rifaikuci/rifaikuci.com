<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'books', $db);

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("booksUpdate", $id);
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Kitap Listesi (Türkçe)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, "Kitap Adı", "", "name", $row['name'], false, false);
                    getTextInput(3, "Yazar", "", "author", $row['author'], false, false);
                    getTextInput(3, "Yayınevi", "", "publisher", $row['publisher'], false, false);
                    getTextArea(12, "Özet", "", "summary", 3, $row['summary'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="card card-dark">

            <div class="card-header">
                <?php expandable_header(); ?>
                <h3 class="card-title">Kitap Listesi (İngilizce)</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextInput(3, "Kitap Adı", "", "nameE", $row['nameE'], false, false);
                    getTextInput(3, "Yazar", "", "authorE", $row['authorE'], false, false);
                    getTextInput(3, "Yayınevi", "", "publisherE", $row['publisherE'], false, false);
                    getTextArea(12, "Özet", "", "summaryE", 3, $row['summaryE'], false, false);
                    ?>

                </div>
                <div class="row">

                </div>
            </div>
        </div>

        <div class="row">
            <?php
            getNumberInput(3, "Basım Yılı", "2022", "printing", $row['printing'], 1, 1960,date("Y"),false,false);

            getDatetime(2,"Başlangıç","startDate",$row['startDate'],false,false);
            getDatetime(2,"Bitiş","finishDate",$row['finishDate'],false,false);
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


