<?php
$info = getDataRow(1, "info", $db);
$infoName = getColumn($info, 'name', $lang);

$smedia = getAllData("smedia",'', $db);
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$currentURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$filteredURL = preg_replace('~(\?|&)'.'lang'.'=[^&]*~', '$1', $currentURL);
$filteredURL = str_replace("?","",$filteredURL);

?>

<header class="ds-header" id="site-header">
    <div class="container">
        <div class="ds-header-inner">
            <a href="<?php echo base_url_front(); ?>" class="ds-logo">
                <span><?php echo substr($infoName, 0, 1) ?></span>
                <?php echo $infoName ?>
            </a>


            <ul>
                <span><a class="<?php echo $lang == "tr" ? 'active-lang' : 'passive-lang'?>"
                            href="<?php
                    echo $filteredURL . "?lang=tr" ?>">TR</a></span>
                <span>-</span>
                <span><a class="<?php echo $lang == "en" ? 'active-lang' : 'passive-lang'?>"
                            href="<?php echo base_url_front() . "?lang=en" ?>">EN</a></span>
            </ul>


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