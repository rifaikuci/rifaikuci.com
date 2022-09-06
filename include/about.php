
<?php
 $about = getDataRow(1,"about",$db);
?>

<div class="ds-about-section">
    <div class="container">
        <section>
            <h2 class="ds-heading"><?php getLabel("Hakkımda","About me",$lang); ?></h2>
            <?php echo getColumn($about,'about',$lang);?>
            <div class="ds-button-sec text-center">
                <a href="#" class="ds-button"><?php getLabel("CV indir","Cv Download", $lang);?></a>
            </div>
        </section>
    </div>
</div>