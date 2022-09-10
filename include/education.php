<?php

$education = getAllData("education", '', $db);
?>

<div class="container" id="experience">
    <h2 class="ds-heading"><?php echo getLabel("Eğitim", "Education", $lang) ?></h2>

    <div class="timeline">
        <section>
            <?php for ($i = 0; $i < count($education); $i++) {
                echo $education['link'];
                ?>
                <div class="timeline-card timeline-card-primary" data-aos="fade-in" data-aos-delay="0">
                    <div class="timeline-head px-4 pt-3">

                        <div class="h5"><?php echo getColumn($education[$i], "title", $lang) ?></div>
                    </div>
                    <div class="timeline-body px-4 pb-4">
                        <div class="text-muted text-small mb-3">
                            <?php if($lang == 'tr')  {
                                
                                if($education[$i]['finishDate']) {
                                    echo  onlyDateMonthTr($education[$i]['startDate']) . " - ".  onlyDateMonthTr($education[$i]['finishDate']);
                                } else {
                                    echo   onlyDateMonthTr($education[$i]['startDate']) . " - ".  "Devam Ediyor";
                                }
                            } else {
                                if($education[$i]['finishDate']) {
                                    echo  onlyDateMonthEng($education[$i]['startDate']) . " - ".  onlyDateMonthEng($education[$i]['finishDate']);
                                } else {
                                    echo   onlyDateMonthEng($education[$i]['startDate']) . " - ".  "Present";
                                }
                            }?>

                        </div>
                        <div><?php echo getColumn($education[$i], "description", $lang) ?>
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