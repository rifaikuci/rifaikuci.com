<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'tblProject', $db);

}
?>


<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Güncelleme</h3>
            </div>
            <div class="card-body" id="app">

                <div class="row">
                    <?php
                    getTextInput(6, "Proje Adı", "Proje adı...", "title", $row['title'], false, false);
                    getTextInput(6, "Keywords", "Anahtar Kelimeler...", "keywords", $row['keywords'], false, false);
                    getTextArea(12, "content", "İçerik", "içerik giriniz", 3, $row['content'], false, false);
                    getTextArea(12, "description", "Açıklama Girinizz", "Description giriniz", 3, $row['description'], false, false);
                    getDatetime(3, "Paylaşım Zamanı", "noticeDate", $row['noticeDate'], false, false);
                    getInputFile(3, "image", "Proje Resmi", false, false, false);
                    getViewFile(3, "Resim", $row['image']);
                    getTextHidden("projectUpdate",$row['id']);
                    ?>
                </div>


            </div>
            <div class="card-footer">
                <?php getButton("btn btn-secondary", 'left', "Vazgeç", "", false); ?>
                <?php getButton("btn btn-success", 'right', "Güncelle", "", false); ?>
            </div>
        </div>
    </form>
</section>


