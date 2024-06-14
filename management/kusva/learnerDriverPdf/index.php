<?php

require_once "../../assets/fpdf/fpdf.php";
require_once "../../utils/index.php";

function turkce($k)
{
    return iconv('utf-8', 'iso-8859-9', $k);

}

if (isset($_GET['group_detail'])) {

    $groupId = $_GET['group_detail'];

    $groupDetail = getDataRow($groupId, 'learnerDriverGroup', $db);
    $sqlGroup = "select l.id, l.insertDate, l.identityNo, max(shortName) as shortName, max(debit) as debit, sum(paymentPrice) as paymentPrice from learnerDriver l inner join learnerDriverPayment p on p.learnerDriverId = l.id where groupId  = $groupId group by l.id";
    $result = $db->query($sqlGroup);

    $groupArray = array();
    $sira = 1 ;
    while ($row = $result->fetch_array()) {

        $item['sira'] = $sira;
        $item['id'] = $row['id'];
        $item['insertDate'] = $row['insertDate'];
        $item['identityNo'] = $row['identityNo'];
        $item['shortName'] = $row['shortName'];
        $item['debit'] = $row['debit'] ?  $row['debit'] : 0;
        $item['paymentPrice'] = $row['paymentPrice'];
        $item['kalan']  = $row['debit']  ? $item['debit'] - $row['paymentPrice'] : 0;

        $sira++;
        array_push($groupArray,$item);
    }



    $pdf = new FPDF();
    $pdf->AddPage('P', 'A4');

    $pdf->AddFont('arial_tr', '', 'arial_tr.php');
    $pdf->AddFont('arial_tr', 'B', 'arial_tr_bold.php');

    $pdf->SetFont("arial_tr", '', 12);

    $pdfHeight = 20;
    $pdf->Cell(180, $pdfHeight, date("d.m.Y H:i"), '', '', 'R');
    $pdfHeight = $pdfHeight + 30;

    $pdf->Cell(0, 0, "", "", "", "L");
    $pdf->Ln();

    $pdf->SetFont("arial_tr", 'B', 16);
    $pdf->Cell(0, $pdfHeight, turkce($groupDetail['groupName'] . " Listesi"), '', '', 'C');
    $pdf->Ln(35);

    $pdf->SetFont("arial_tr", 'B', 12);
    $pdf->Cell(10, 10, turkce("#"), 1, 0, "C");
    $pdf->Cell(60, 10, turkce("Sürücü Adı"), 1, 0, "C");
    $pdf->Cell(30, 10, turkce("Kimlik No"), 1, 0, "C");
    $pdf->Cell(45, 10, turkce("Kayıt Tarihi"), 1, 0, "C");
    $pdf->Cell(25, 10, turkce("Ödenen "), 1, 0, "C");
    $pdf->Cell(25, 10, turkce("Toplam "), 1, 1, "C");

// Example data for the rows



    $pdf->SetFont("arial_tr", '', 10);
    for ($i  = 0 ; $i<count($groupArray); $i++ ) {
        $pdf->Cell(10, 10, turkce($groupArray[$i]['sira']), 1, 0, "C");
        $pdf->Cell(60, 10, turkce($groupArray[$i]['shortName']), 1, 0, "C");
        $pdf->Cell(30, 10, $groupArray[$i]['identityNo'], 1, 0, "C");
        $pdf->Cell(45, 10, dateWithTime($groupArray[$i]['insertDate']), 1, 0, "C");
        $pdf->Cell(25, 10, $groupArray[$i]['paymentPrice'], 1, 0, "C");
        $pdf->Cell(25, 10, $groupArray[$i]['debit'], 1, 1, "C");
    }

    $pdf->Output();
    exit();
}

if (isset($_GET['group_payment_detail'])) {

    $groupId = $_GET['group_payment_detail'];
    $groupDetail = getDataRow($groupId, 'learnerDriverGroup', $db);
    $sqlGroupPayment = "select p.id as id, shortName, paymentPrice, description, p.insertDate, p.paymentType, p.description as description
from learnerDriverPayment p
         inner join learnerDriver l on p.learnerDriverId = l.id
         inner join learnerDriverGroup g on g.id = l.groupId where g.id = $groupId";
    $result = $db->query($sqlGroupPayment);

    $groupArray = array();
    $sira = 1 ;
    while ($row = $result->fetch_array()) {

        $item['sira'] = $sira;
        $item['shortName'] = $row['shortName'];
        $item['paymentType'] = $row['paymentType'];
        $item['insertDate'] = $row['insertDate'];
        $item['paymentPrice'] = $row['paymentPrice'];
        $item['description'] = $row['description'];

        $sira++;
        array_push($groupArray,$item);
    }


    $pdf = new FPDF();
    $pdf->AddPage('P', 'A4');

    $pdf->AddFont('arial_tr', '', 'arial_tr.php');
    $pdf->AddFont('arial_tr', 'B', 'arial_tr_bold.php');

    $pdf->SetFont("arial_tr", '', 12);

    $pdfHeight = 20;
    $pdf->Cell(180, $pdfHeight, date("d.m.Y H:i"), '', '', 'R');
    $pdfHeight = $pdfHeight + 30;

    $pdf->Cell(0, 0, "", "", "", "L");
    $pdf->Ln();

    $pdf->SetFont("arial_tr", 'B', 16);
    $pdf->Cell(0, $pdfHeight, turkce($groupDetail['groupName'] . " Ödeme Listesi"), '', '', 'C');
    $pdf->Ln(35);

    $pdf->SetFont("arial_tr", 'B', 12);
    $pdf->Cell(10, 10, turkce("#"), 1, 0, "C");
    $pdf->Cell(50, 10, turkce("Sürücü"), 1, 0, "C");
    $pdf->Cell(35, 10, turkce("Ödeme T."), 1, 0, "C");
    $pdf->Cell(20, 10, turkce("Tür"), 1, 0, "C");
    $pdf->Cell(20, 10, turkce("Tutar "), 1, 0, "C");
    $pdf->Cell(60, 10, turkce("Açıklama "), 1, 1, "C");


    $pdf->SetFont("arial_tr", '', 10);
    for ($i  = 0 ; $i<count($groupArray); $i++ ) {
        $pdf->SetFont("arial_tr", '', 10);
        $pdf->Cell(10, 10, turkce($groupArray[$i]['sira']), 1, 0, "C");
        $pdf->Cell(50, 10, turkce($groupArray[$i]['shortName']), 1, 0, "C");
        $pdf->Cell(35, 10, dateWithTime($groupArray[$i]['insertDate']), 1, 0, "C");
        $pdf->Cell(20, 10, turkce($groupArray[$i]['paymentType']), 1, 0, "C");
        $pdf->Cell(20, 10, $groupArray[$i]['paymentPrice'], 1, 0, "C");
        $pdf->SetFont("arial_tr", '', 8);
        $pdf->Cell(60, 10, turkce($groupArray[$i]['description']), 1, 1, "C");
    }

    $pdf->Output();
    exit();


}

?>