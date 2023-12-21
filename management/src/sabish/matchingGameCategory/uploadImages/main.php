
<?php

    $tableName = "sabishMatchingGameCategory";

    $id = $_GET['id'];
    $sql = "SELECT * FROM galeria where tblName = '$tableName' and productId = '$id' ";;

$columns = getTableColumns("galeria", $db);

$result = $db->query($sql);
$data = array();
$counter = 0;
while ($row = $result->fetch_array()) {
    $counter ++;
    $item = null;
    for ($i = 0; $i < count($columns); $i++) {
        $item[$columns[$i]] = $row[$columns[$i]];
    }
    array_push($data,$item);
}
?>

<section class="content">

    <?php statusAlert(); ?>


    <form method="post" class="dropzone" action="<?php echo base_url_back() . 'kusva/index.php' ?>">
        <?php getTextHidden("multipleImageInsert", "multipleImageInsert"); ?>
        <?php getTextHidden("tblName", $tableName); ?>
        <?php getTextHidden("productId", $id); ?>

    </form>


</section>

<br><br>
<section class="content">


    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Yüklenen imageler</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <?php  for($k = 0; $k < count($data); $k++) { ?>
                    <div class="col-sm-3">
                        <a href="<?php echo base_url_back().$data[$k]['image'] ?>" data-toggle="lightbox"
                           data-gallery="gallery">
                            <img src="<?php echo base_url_back().$data[$k]['image'] ?>" class="img-fluid mb-2"
                                 alt="white sample"/>
                        </a>
                        <div style="bottom 0 ; margin-top: 10px">

                            <a href="<?php echo base_url_back()."kusva/?imageSil=".$data[$k]['id']."&dirName=sabish/matchingGameCategory&productId=".$id; ?> "
                               class="btn btn-outline-danger">Sil</a>
                        </div>
                    </div>
                    <?php  }?>


                </div>
            </div>
        </div>
    </div>
</section>


