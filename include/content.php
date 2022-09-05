<?php
$subAbout = getColumn($about, 'subAbout', $lang);


?>

<div class="ds-banner">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                <figure>
                    <img src="<?php echo base_url_back() . $about['image']; ?>">
                </figure>
            </div>
            <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 col-xxl-7">
                <section>
                    <?php echo $subAbout; ?>
                </section>
            </div>
        </div>
    </div>
</div>