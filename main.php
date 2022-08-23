

<section class="content">

    <?php statusAlert();?>
    <form method="post" action="<?php echo base_url() . 'kusva/info/index.php' ?>"
          enctype="multipart/form-data">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Başka Title</h3>

              <?php expandable_header(); ?>
            </div>
            <div class="card-body" id="app">

                <div class="row">
                    <?php

                    // dosya olup olmadığı kontrolü yapılmakta is_dir("utils/metasdasdhods");
                    $data = ["E" => "Erkek", "K" => "Kadın"];
                    getTextInput(3, "Ad", "Ad giriniz", "name", "", "", false, false);
                    getTextInput(3, "Soyad", "Soyad giriniz", "surname", "", "", false, "");
                    getTextInput(3, "Adres Girinz", "Adres giriniz", "address", "", "", "", "");
                    getTextInput(3, "Memleket Girinz", "Memleket giriniz", "city", "", "", "", "");
                    getSelect( 3,$data, "Cinsiyet", "gender", "", false, "", false, false);
                    getDatetime(3, "Doğum Tarihiniz", "birthdate", "", true, false);
                    getNumberInput(3, "Yaş", 0, "age", "", "", "", "", false, false);

                    getInputFile("file","Resim", 4,false,false, false);
                    ?>

                </div>


            </div>
            <div class="card-footer">
                <?php getButton("btn btn-primary", 'right', "Denek", "infoekleme", false); ?>
            </div>
        </div>
    </form>
</section>


