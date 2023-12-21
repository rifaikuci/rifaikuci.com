<?php

if (isset($_GET['itemId'])) {
    $itemId = $_GET['itemId'];
    $count = $_GET['count'];

    $stockList =   getAllData("stockItem","",$db);


    $dataStock = array();
    for($k = 0 ; $k < count($stockList); $k++) {
        $dataStock[$stockList[$k]['id']] = $stockList[$k]['shortName'];
    }
}
?>


<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php

        ?>
        <div class="card card-dark">

            <div class="card-header">
                <h3 class="card-title">Hisse Senet Satışları</h3>

            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextHidden("myStockListUpdateTotal", $itemId);
                    getSelect(3,$dataStock, "Hisse","myStockListUpdateTotal","blue",false,$itemId,true,true);
                    getNumberInput(3, "Satılan Adet", "0", "substract", $count, 1, 0,$count,false,false);
                    getDatetime(3,"İşlem Zamanı","sellDate","",false,false);


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


