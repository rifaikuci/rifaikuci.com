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

            <div class="ds-button-sec text-center">
                <a href="#" class="ds-button">Download Resume</a>

            </div>
        </section>
    </div>
</div>