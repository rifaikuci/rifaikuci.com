<main class="ds-main-section">
    <div class="container">
        <div class="ds-work-details-section">
            <div class="text-center">
                <a href="javascript:history.go(-1)" class="ds-button ds-arrow-button"><i class="ri-arrow-left-s-line"></i>
                    <?php echo getLabel("Geri", "Back",$lang)?>
                </a>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 col-xxl-10">
                    <header class="ds-work-det-hed">
                        <h1 class="ds-work-det-title"><?php echo getColumn($project,"title",$lang);?></h1>
                        <span class="ds-work-det-dep">
                            
                             <?php if($lang == 'tr')  {

                                     echo   onlyDateMonthTr($project['startDate']) ;
                             } else {

                                     echo   onlyDateMonthEng($project['startDate']) ;
                             }?>
                        </span>
                    </header>
                    <figure>
                        <?php if($project['image']) { ?>
                        <img class="img-fluid" src="<?php echo base_url_back().$project['image']; ?>">
                        <?php } else {?>
                            <img class="img-fluid" src="<?php echo base_url_back() . "assets/images/projects/default.jpg" ?>">
                        <?php } ?>
                    </figure>
                    <div class="ds-work-content-sec">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 col-xxl-8">
                                <p>

                              <?php

                              echo getColumn($project,"detail",$lang);
                              ?>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
