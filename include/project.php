<?php
$projects = getAllDataWithSort("projects", "", $db, "desc");

?>

<div class="ds-work-section">
    <div class="container">
        <h2 class="ds-heading"><?php echo getLabel("Projeler", "Projects", $lang) ?></h2>
        <div class="ds-work-list-section">
            <?php
            for ($i = 0; $i < count($projects); $i++) { ?>
                <div class="ds-work-list">
                    <div class="row">
                        <div class="col-lg-7 col-xl-7 col-xxl-7">
                                <h3 class="ds-work-tilte">
                                    <?php echo getColumn($projects[$i], "title", $lang); ?>
                                </h3>
                                <p>
                                    <?php wordCharacter(strip_tags(getColumn($projects[$i], "detail", $lang)), 300); ?>
                                </p>

                                <p>


                                <a href="<?php
                                $link = base_url_front() . "detail/?seo=" . getColumn($projects[$i], "seoTitle", $lang);
                                echo $link;
                                ?>" class="ds-button"><?php echo getLabel("Detay", "Detail", $lang) ?></a>
                                </p>

                        </div>
                        <div class="col-md-12 col-lg-5 col-xl-5 col-xxl-5">
                            <?php if ($projects[$i]['image']) { ?>
                                <figure><img class="img-fluid" src="<?php echo base_url_back() . $projects[$i]['image'] ?>"></figure>
                            <?php } else { ?>
                                <figure><img class="img-fluid" src="<?php echo base_url_back() . "assets/images/projects/default.jpg" ?>">
                                </figure>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
</div>

