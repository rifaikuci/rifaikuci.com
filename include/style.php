
<?php
$favIcon = getDataRow(1,"favIcon",$db);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) {
    echo "asd";
    exit();
}

?>
<meta charset="utf-8">
<link rel="shortcut icon" type="image/png" href="<?php echo base_url_back() . $favIcon['image']; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="<?php echo base_url_front() ."assets/css/main.css" ?>" rel="stylesheet">
<link href="<?php echo base_url_front() ."assets/css/font-awesome/css/all.min.css?ver=1.2.1" ?>" rel="stylesheet">
<link href="<?php echo base_url_front() ."assets/css/mdb.min.css?ver=1.2.1" ?>" rel="stylesheet">
<link href="<?php echo base_url_front() ."assets/css/aos.css?ver=1.2.1" ?>" rel="stylesheet">
<link href="<?php echo base_url_front() ."assets/css/main.css?ver=1.2.1" ?>" rel="stylesheet">


<noscript>
    <style type="text/css">
        [data-aos] {
            opacity: 1 !important;
            transform: translate(0) scale(1) !important;
        }
    </style>
</noscript>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-98YED43H10"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-98YED43H10');
</script>
