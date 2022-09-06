<?php

function durumSuccess($content)
{
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Başarılı!</strong> $content
        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
}

function durumDanger($content)
{
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Hata!</strong> $content
        <button type='button' class='close' data-dismiss='alert' aria-label='close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
}

function statusAlert()
{
    if (isset($_GET['hata']) && $_GET['hata'] == 'image_invalid_type') {
        durumDanger("Geçersiz Dosya Tipi !");
    } else if (isset($_GET['hata']) && $_GET['hata'] == 'image_large') {
        durumDanger("Dosya boyutu fazla büyük !");
    } else if (isset($_GET['hata']) && $_GET['hata'] == 'image_not_upload') {
        durumDanger("Resim yüklenirken bir hata oluştu !");
    } else if (isset($_GET['insert']) && $_GET['insert'] == 'ok') {
        durumSuccess("Kayıt başarılı bir şekilde eklendi.");
    } else if (isset($_GET['insert']) && $_GET['insert'] == 'no') {
        durumDanger("Kayıt eklenirken bir hata oluştu.");
    } else if (isset($_GET['delete']) && $_GET['delete'] == 'ok') {
        durumSuccess( "Kayıt başarılı bir şekilde silindi.");
    } else if (isset($_GET['delete']) && $_GET['delete'] == 'no') {
        durumDanger("Kaydı Silerken bir hata oluştu!");
    } else if (isset($_GET['update']) && $_GET['update'] == 'ok') {
        durumSuccess( "Kayıt başarılı bir şekilde Güncellendi.");
    } else if (isset($_GET['update']) && $_GET['update'] == 'no') {
        durumDanger("Kaydı Güncellerken bir hata oluştu!");
    } else if(isset($_GET['hata']) && $_GET['hata'] == 'pdf_invalid_type') {
        durumDanger("Pdf için yanlış Dosya Tipi !");
    } else if (isset($_GET['hata']) && $_GET['hata'] == 'pdf_large') {
        durumDanger("Pdf boyutu fazla büyük !");
    } else if (isset($_GET['hata']) && $_GET['hata'] == 'pdf_not_upload') {
        durumDanger("PDF yüklenirken bir hata oluştu !");
    }
}

?>