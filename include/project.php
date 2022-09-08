<?php
$projects = getAllData("projects", $db);

?>

<div class="ds-work-section">
    <div class="container">
        <h2 class="ds-heading"><?php echo getLabel("Projelerim", "Projects", $lang) ?></h2>
        <div class="ds-work-list-section">
            <?php
            for ($i = 0; $i < count($projects); $i++) { ?>
                <div class="ds-work-list">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 col-xxl-7">
                            <section>
                                <h3 class="ds-work-tilte">
                                    <?php
                                    echo getColumn($projects[$i], "title", $lang);
                                    ?>
                                </h3>
                                <p>

                                    <?php
                                     wordCharacter(strip_tags(getColumn($projects[$i], "detail", $lang)), 300);
                                    ?>
                                </p>

                                <a href="#" class="ds-button"><?php echo getLabel("Detay", "Detail", $lang) ?></a>
                            </section>
                        </div>
                        <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                            <?php if ($projects[$i]['image']) { ?>
                                <figure><img src="<?php echo base_url_back() . $projects[$i]['image'] ?>"></figure>
                            <?php } else { ?>
                                <figure><img src="<?php echo base_url_back() . "assets/images/projects/default.jpg" ?>">
                                </figure>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
</div>

