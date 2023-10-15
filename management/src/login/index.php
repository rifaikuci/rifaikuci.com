<?php
if (file_exists("utils/index.php"))
    require_once "utils/index.php";
else if (file_exists("../utils/index.php"))
    require_once "../utils/index.php";
else if (file_exists("../../utils/index.php"))
    require_once "../../utils/index.php";
else if (file_exists("../../../utils/index.php"))
    require_once "../../../utils/index.php";
?>


<!doctype html>
<html lang=<?php echo $lang; ?>>
<head>
    <title><?php echo function_exists('firmName') ? firmName() . " | " : "" ?><?php echo getLabel("Giriş", "Login", $lang) ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">
                    <?php echo function_exists('firmName') ? firmName() . " | " : "";
                    echo "Yönetim Ekranı" ?>
                </h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-user-o"></span>
                    </div>
                    <h3 class="text-center mb-4">
                        <?php echo getLabel("Giriş", "Login", $lang) ?>
                    </h3>
                    <form method="post" action="<?php echo base_url_back() . 'kusva/index.php' ?>" class="login-form">
                        <?php getTextHidden("loginControl","loginControl"); ?>
                        <div class="form-group">
                            <input name="name" type="text" class="form-control rounded-left"
                                   oninput="this.value = this.value.replace(/[^0-9a-zA-Z@.?!+^()/=%&]/g, '').replace(/(\..*)\./g, '$1');"
                                   placeholder="Username" required>
                        </div>
                        <div class="form-group d-flex">
                            <input type="password"
                                   oninput="this.value = this.value.replace(/[^0-9a-zA-Z@.?!+^()/=%&]/g, '').replace(/(\..*)\./g, '$1');"
                                   name="password" class="form-control rounded-left" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">
                                <?php getLabel("Giriş", "Login", $lang); ?>
                            </button>
                        </div>
                        <div class="form-group d-md-flex">
                            <a href="mailto:rifaikuci@gmail.com"

                            <div class="w-50 text-md-right">
                                <a href="mailto:rifaikuci@gmail.com" target="_blank">
                                    <?php getLabel("Şifreyi Unuttum", "Forgot Password", $lang); ?>
                                </a>
                            </div>
                            <?php if( isset($_GET['kullanici']) && $_GET['kullanici'] == "no") { ?>
                                <div style="margin:10px" class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Hata!</strong> Kullanıcı bulunamadı!!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>

                            <?php if( isset($_GET['session']) && $_GET['session'] == "no") { ?>
                                <div style="margin:10px" class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Hata!</strong> Session bulunamadı!!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>

