<?php
$info = getDataRow(1, "info", $db);
$infoName = getColumn($info, 'name', $lang);

$smedia = getAllData("smedia", $db);
?>

<header class="ds-header" id="site-header">
    <div class="container">
        <div class="ds-header-inner">
            <a href="<?php echo base_url_front(); ?>" class="ds-logo">
                <span><?php echo substr($infoName, 0, 1) ?></span>
                <?php echo $infoName ?>
            </a>

            <!-- #todo dil kısmı yapılacak
            <ul>
                <span><a href="#">TR</a></span>
                <span> - </span>
                <span><a href="#">EN</a></span>
            </ul> -->

            <ul class="ds-social">
                <?php
                for ($i = 0; $i < count($smedia); $i++) {

                    $className = 'ri-' . $smedia[$i]['class'] . '-fill';
                    ?>

                    <li>
                        <a href="<?php echo $smedia[$i]['link'] ?>" target="_blank"><i
                                    class="<?php echo $className ?>"></i>
                        </a>
                    </li>

                <?php } ?>
            </ul>

        </div>
    </div>
</header>