<?php header('Content-type: application/xml; charset="utf-8"', true); ?>

<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <?php
    $tarih = date("Y-m-d");

    if(file_exists("common/methods/info.php")) {
        require_once "common/methods/info.php";
        require_once "common/db/index.php";
    } else if(file_exists("../common/methods/info.php")) {
        require_once "../common/methods/info.php";
        require_once "../common/db/index.php";
    }  else if(file_exists("../../common/methods/info.php")) {
        require_once "../../common/methods/info.php";
        require_once "../../common/db/index.php";
    }

    ?>

    <url>
        <loc><?php echo base_url_front(); ?></loc>
        <lastmod><?php echo $tarih; ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.00</priority>
    </url>

    <?php

    $sql = 'SELECT * FROM tblhizmet where durum=1';
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) { ?>
        <url>
            <loc><?php echo $row['link']; ?></loc>
            <lastmod><?php echo $tarih; ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>1.00</priority>
        </url>
    <?php } ?>

    <?php

    $projects = getAllData("projects","",$db);

    for ($i = 0; $i < count($projects); $i++) { ?>
        <url>
            <loc><?php echo base_url_front()."detail/?seo=".$projects[$i]['seoTitle']; ?></loc>
            <lastmod><?php echo $tarih; ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>1.00</priority>
        </url>
        <url>
            <loc><?php echo base_url_front()."detail/?seo=".$projects[$i]['seoTitleE']; ?></loc>
            <lastmod><?php echo $tarih; ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>1.00</priority>
        </url>
    <?php } ?>





</urlset>