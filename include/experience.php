<?php

$experience = getAllData("experience", $db);
?>

<div class="container" id="experience">
    <h2 class="ds-heading"><?php echo getLabel("Deneyimler", "Experience", $lang) ?></h2>

    <div class="timeline">
        <section>
            <?php for ($i = 0;
                       $i < count($experience);
                       $i++) {
                echo $experience['link'];
                ?>
                <div class="timeline-card timeline-card-success" data-aos="fade-in" data-aos-delay="0">
                    <div class="timeline-head px-4 pt-3">

                        <div class="h5"><?php echo getColumn($experience[$i], "title", $lang) ?>

                            <?php if ($experience[$i]['link']) { ?>
                                <a href="<?php echo $experience[$i]['link'] ?>" target="_blank">
                                    <span class="text-muted h6"><?php echo " - ". getColumn($experience[$i], "firmName", $lang) ?></span>
                                </a>
                            <?php } else { ?>
                                <span class="text-muted h6"><?php echo " - ". getColumn($experience[$i], "firmName", $lang) ?></span>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="timeline-body px-4 pb-4">
                        <div class="text-muted text-small mb-3">
                            <?php if($lang == 'tr')  {
                                
                                if($experience[$i]['finishDate']) {
                                    echo  onlyDateMonthTr($experience[$i]['startDate']) . " - ".  onlyDateMonthTr($experience[$i]['finishDate']);
                                } else {
                                    echo   onlyDateMonthTr($experience[$i]['startDate']) . " - ".  "Devam Ediyor";
                                }
                            } else {
                                if($experience[$i]['finishDate']) {
                                    echo  onlyDateMonthEng($experience[$i]['startDate']) . " - ".  onlyDateMonthEng($experience[$i]['finishDate']);
                                } else {
                                    echo   onlyDateMonthEng($experience[$i]['startDate']) . " - ".  "Present";
                                }

                            }?>

                        </div>
                        <div><?php echo getColumn($experience[$i], "description", $lang) ?>
                        </div>
                    </div>
                </div>

            <?php } ?>


        </section>

    </div>

</div>
<br>
<br>
<br>