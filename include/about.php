<?php
$about = getDataRow(1, "about", $db);
?>

<div class="ds-about-section">
    <div class="container">
        <section>
            <h2 class="ds-heading"><?php getLabel("Hakkımda", "About me", $lang); ?></h2>
            <p>
                <?php echo getColumn($about, 'about', $lang); ?>
            </p>


            <?php
            if ($lang == 'tr') { ?>
                <div class="ds-button-sec text-center">
                    <a href="<?php echo base_url_back(). $about['cv'] ?>" class="ds-button">Özgeçmişi İndir</a>
                </div>
            <?php } else { ?>
                <div class="ds-button-sec text-center">
                    <a href="<?php echo base_url_back(). $about['cvE'] ?>" class="ds-button">Download  CV</a>
                </div>
            <?php } ?>
        </section>
    </div>
</div>