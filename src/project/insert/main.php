

<section class="content">

    <form method="post" action="<?php echo base_url() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Başka Title</h3>
            </div>
            <div class="card-body" id="app">

                <div class="row">
                    <?php
                    getTextInput(6,"Proje Adı","Proje adı...","title","",true,false);
                    getTextInput(6,"Keywords","Anahtar Kelimeler...","keywords","",false,false);
                    getTextArea(12,"content", "İçerik", "içerik giriniz",3,"",true,false);
                    getTextArea(12,"description", "Açıklama Girinizz", "Description giriniz",3,"",true,false);
                    getDatetime(3,"Paylaşım Zamanı","noticeDate","",false,true);
                    getInputFile(3,"image","Proje Resmi",false, false,false);
                    getTextHidden("projectInsert","projectInsert");

                    ?>
                </div>



            </div>
            <div class="card-footer">
                <?php getButton("btn btn-secondary", 'left', "Vazgeç", "", false); ?>
                <?php getButton("btn btn-success", 'right', "Ekle", "", false); ?>
            </div>
        </div>
    </form>
</section>


