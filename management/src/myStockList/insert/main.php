
<?php
  $stockList =   getAllData("stockItem","",$db);

  $dataStock = array();
  for($k = 0 ; $k < count($stockList); $k++) {
      $dataStock[$stockList[$k]['id']] = $stockList[$k]['shortName'];
  }
?>

<section class="content">

    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>"
          enctype="multipart/form-data">

        <?php
        getTextHidden("myStockListInsert","myStockListInsert");
        ?>
        <div class="card card-dark">

            <div class="card-header">
                <h3 class="card-title">Senet Alış</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    getSelect(3,$dataStock, "Hisseler","stockItemId","blue",false,false,true,false);
                    getNumberInput(3, "Adet", "0", "count", '', 1, 0,"",false,false);
                    getDatetime(3,"İşlem Zamanı","buyDate","",false,false);

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


