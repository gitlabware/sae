<?php
// create new PDF document
$height = 213;
$width = 161;
$pdf = new TCPDF('P', 'mm', array($height, $width), true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SAE');
$pdf->SetTitle('RECIBO');
$pdf->SetSubject('RECIBO');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);
$pdf->SetLeftMargin(0);
$pdf->SetRightMargin(0);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


$pdf->SetFont(null, 'B', 10);
// add a page
$pdf->AddPage();

$pdf->setCellHeightRatio(1);
$pdf->SetFillColor(240, 240, 240);
$pdf->SetXY(111, 25);
$mis_bordes = array('LTRB' => array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->MultiCell(35, 8, 'No. ' . $recibo['Recibo']['numero'], $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 8, 'M');

$pdf->SetFont(null, 'IB', 8);
$pdf->Text(30, 35, 'Recibimos de: ');

$pdf->SetFont(null, '', 7);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetXY(53, 34);
$mis_bordes = array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->MultiCell(93, 4.5, strtoupper($recibo['Recibo']['pagador']), $mis_bordes, 'L', 1, 0, '', '', true, 0, false, true, 4.5, 'M');

$pdf->SetFont(null, '', 6);
$pdf->SetXY(104, 39.5);
$mis_bordes = array('LTRB' => array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->MultiCell(42, 3.5, 'Expresado en Bs.', $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

$pdf->SetXY(31, 44);
$pdf->MultiCell(72, 3.5, 'CONCEPTO', $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

$pdf->SetXY(104, 44);
$pdf->MultiCell(20, 3.5, 'Importe', $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

$pdf->SetXY(125, 44);
$pdf->MultiCell(21, 3.5, 'Retencion', $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

$y = 44;
$total_i = 0.00;
$total_r = 0.00;
foreach ($conceptos as $con) {
    $y = $y + 3.5;
    $pdf->SetXY(31, $y);
    $pdf->MultiCell(72, 3.5, $con['Concepto']['nombre'], $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 3.5, 'M');
    $pago = $this->requestAction(array('action' => 'get_pagos_rec', $idRecibo, $con['Concepto']['id']));

    $importe = 0.00;
    $retencion = 0.00;
    if (!empty($pago[0][0]['imp_total'])) {
        $importe = $pago[0][0]['imp_total'];
    }
    if (!empty($pago[0][0]['retencion'])) {
        $retencion = $pago[0][0]['retencion'];
    }
    $total_i = $total_i + $importe;
    $total_r = $total_r + $retencion;

    $pdf->SetXY(104, $y);
    $pdf->MultiCell(20, 3.5, $importe, $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

    $pdf->SetXY(125, $y);
    $pdf->MultiCell(21, 3.5, $retencion, $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 3.5, 'M');
}


$y = $y + 3.5;
$pdf->SetXY(31, $y);
$pdf->MultiCell(72, 3.5, 'Total importe y Total retencion', $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 3.5, 'M');


$pdf->SetXY(31, ($y + 5.5));
$pdf->MultiCell(72, 3.5, 'Importe sujeto a retencion', $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

$pdf->SetFont(null, 'B', 6);
$pdf->SetTextColorArray(array(255, 255, 255));
$pdf->SetFillColor(69, 69, 69);
$pdf->SetXY(104, $y);
$pdf->MultiCell(20, 3.5, $total_i, $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

$pdf->SetXY(125, $y);
$pdf->MultiCell(21, 3.5, $total_r, $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

$y = $y + 5.4;
$pdf->SetXY(125, $y);
$pdf->MultiCell(21, 3.5, ($total_i + $total_r), $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

//$y = $y -0.9;
$mis_bordes = array('TB' => array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont(null, '', 6);
$pdf->SetTextColorArray(array(0, 0, 0));

$pdf->SetXY(31, ($y - 0.9));
$pdf->MultiCell(114.5, 5.5, '', $mis_bordes, 'R', 0, 0, '', '', true, 0, false, true, 5.5, 'M');


$y = $y + 7;
$mis_bordes = array('LRTB' => array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->SetFont(null, '', 6);
$pdf->SetXY(31, $y);
$pdf->MultiCell(114.5, 13, '', $mis_bordes, 'R', 0, 0, '', '', true, 0, false, true, 13, 'M');

$pdf->SetXY(35, ($y - 0.7));
$pdf->MultiCell(18, 2.4, 'Observaciones: ', 0, 'L', 1, 0, '', '', true, 0, false, true, 2.4, 'T');

$y = $y + 14.5;

$pdf->setCellHeightRatio(0.5);
$nume = 0 ;

$meses['1'] = 'Enero';
$meses['2'] = 'Febrero';
$meses['3'] = 'Marzo';
$meses['4'] = 'Abril';
$meses['5'] = 'Mayo';
$meses['6'] = 'Junio';
$meses['7'] = 'Julio';
$meses['8'] = 'Agosto';
$meses['9'] = 'Septiembre';
$meses['10'] = 'Octubre';
$meses['11'] = 'Nomviembre';
$meses['12'] = 'Diciembre';

$total_t = 0.00;
foreach ($pagos as $pa) {
    $pdf->Text(43, $y, '*Detalle de ' . $pa['Concepto']['nombre']);


    $y = $y + 3;
    $pdf->SetFont(null, 'B', 6);
    $pdf->SetTextColorArray(array(255, 255, 255));
    $pdf->SetFillColor(69, 69, 69);
    $pdf->SetXY(53, $y);
    $pdf->MultiCell(10, 3.5, 'Año', $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

    $pdf->SetXY(64, $y);
    $pdf->MultiCell(19, 3.5, 'Mes', $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

    $pdf->SetXY(84, $y);
    $pdf->MultiCell(41, 3.5, 'Nombre del Ambiente', $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

    $pdf->SetXY(126, $y);
    $pdf->MultiCell(19, 3.5, 'Importe', $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');


    $pdf->SetFont(null, '', 6);
    $pdf->SetTextColorArray(array(0, 0, 0));
    $pdf->SetFillColor(255, 255, 255);


    $detalles = $this->requestAction(array('action' => 'get_det_pagos', $idRecibo, $pa['Concepto']['id']));

    
    foreach ($detalles as $det) {
        $total_t = $total_t + $det[0]['pago'];
        $nume++;
        $y = $y + 3.5;

        $pdf->SetXY(45, $y);
        $pdf->MultiCell(7, 3.5, $nume, $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

        $pdf->SetXY(53, $y);
        $pdf->MultiCell(10, 3.5, $det[0]['gestion'], $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

        $pdf->SetXY(64, $y);
        $pdf->MultiCell(19, 3.5, $meses[$det[0]['mes']], $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

        $pdf->SetXY(84, $y);
        $pdf->MultiCell(41, 3.5, $det[0]['ambiente'], $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

        $pdf->SetXY(126, $y);
        $pdf->MultiCell(19, 3.5, $det[0]['pago'], $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 3.5, 'M');
    }
}


$pdf->SetXY(126, 180);
$pdf->MultiCell(19, 3.5, $total_t, $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

$pdf->SetXY(65.5, 180);
$pdf->MultiCell(10, 3.5, $nume, $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

$pdf->setCellHeightRatio(1);
$pdf->SetXY(42, 190.5);

$pdf->MultiCell(20, 3.5, date('d/m/Y'), $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');
$pdf->Text(34, 191, 'Fecha: ');

$pdf->Text(103, 191, 'Original: Propietario / Arrendatario');
$pdf->SetFont(null, 'B', 6);
$pdf->SetTextColorArray(array(255, 255, 255));
$pdf->SetFillColor(69, 69, 69);
$pdf->SetXY(45, 180);
$pdf->MultiCell(20, 3.5, 'No. Cuotas:', 0, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

$pdf->SetXY(76, 180);
$pdf->MultiCell(49, 3.5, 'Total cuotas ordinarias:', 0, 'R', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

$pdf->setCellHeightRatio(1);
$mis_bordes = array('TB' => array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont(null, '', 6);
$pdf->SetTextColorArray(array(0, 0, 0));
$pdf->SetXY(31, 185);

$monto_cob_t = ($total_i + $total_r);
$lit_dec = explode('.', $monto_cob_t);
if(!empty($lit_dec[1])){
    $decimal = $lit_dec[1];
}else{
    $decimal = 0.00;
}

$monto_lit = $this->requestAction(array('action' => 'get_monto_literal', $monto_cob_t)).' '.$decimal.'/100 BOLIVIANOS';
$pdf->MultiCell(114.5, 5.5, 'Son: '.$monto_lit, $mis_bordes, 'L', 0, 0, '', '', true, 0, false, true, 5.5, 'M');

$pdf->Output('credencial.pdf', 'I');
exit;
?>
<!--<table style="background-color: #ccffcc;">
    <tr>
        <td style="padding-bottom: 1px; border: 1px solid #00000; height: 30px;">
            
        </td>
    </tr>
</table>-->