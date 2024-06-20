
<?php

session_start();
if (!isset($_SESSION['management'])) {
    header("Location:" . base_url_back() . "/src/login/");
}

?>
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="<?php echo base_url_back() . "style/plugins/fontawesome-free/css/all.min.css" ?>">
<link rel="stylesheet" href="<?php echo base_url_back() . "style/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" ?>">
<link rel="stylesheet" href="<?php echo base_url_back() . "style/plugins/select2/css/select2.min.css" ?>">
<link rel="stylesheet" href="<?php echo base_url_back() . "style/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" ?>">
<link rel="stylesheet" href="<?php echo base_url_back() . "style/plugins/summernote/summernote-bs4.min.css" ?>">
<link rel="stylesheet" href="<?php echo base_url_back() . "style/plugins/ekko-lightbox/ekko-lightbox.css" ?>">
<link rel="stylesheet" href="<?php echo base_url_back() . "style/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" ?>">
<link rel="stylesheet" href="<?php echo base_url_back() . "style/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" ?>">
<link rel="stylesheet" href="<?php echo base_url_back() . "style/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" ?>">
<link rel="stylesheet" href="<?php echo base_url_back() . "style/plugins/dropzone/min/dropzone.min.css" ?>">
<link rel="stylesheet" href="<?php echo base_url_back() . "style/dist/css/adminlte.min.css?v=3.2.0" ?>">

