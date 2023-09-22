<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = getDataRow($id, 'myStockList', $db);
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
        getTextHidden("myStockListUpdate", $id);

        ?>
        <div class="card card-dark">

            <div class="card-header">
                <h3 class="card-title">Hisse Senet Satışları</h3>

            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getTextHidden("myStockListUpdate", $id);
                    getTextHidden("count", $row['count']);
                    getSelect(3,$dataStock, "Hisse","stockItemId","blue",false,$row['stockItemId'],true,true);
                    getNumberInput(3, "Satılan Adet", "0", "substract", $row['count'], 1, 0,$row['count'],false,false);


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


