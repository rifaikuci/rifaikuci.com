<?php


$skills = getAllData("skills", $db);

?>

<div class="ds-skills-section">
    <div class="container">
        <div class="row">
            <?php
            foreach ($TYPE_SKILLS as $key => $value) {
                $tempArray = getDataFilter($skills, 'type', $key);
                if (count($tempArray) > 0) { ?>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <h2 class="ds-heading"><?php getLabel($value, $key, $lang); ?></h2>
                        <ul class="ds-skills-list">
                            <?php for ($k = 0; $k < count($tempArray); $k++) { ?>
                                <li><?php echo getColumn($tempArray[$k], 'name', $lang) ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</div>