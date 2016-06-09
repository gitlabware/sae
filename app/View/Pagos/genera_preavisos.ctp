<?php
// create new PDF document
$height = 213;
$width = 161;
$pdf = new TCPDF('L', 'mm', 'LETTER', true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SAE');
$pdf->SetTitle('PRE-AVISOS');
$pdf->SetSubject('PRE-AVISOS');
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


// add a page


$meses[1] = 'Ene';
$meses[2] = 'Feb';
$meses[3] = 'Mar';
$meses[4] = 'Abr';
$meses[5] = 'May';
$meses[6] = 'Jun';
$meses[7] = 'Jul';
$meses[8] = 'Ago';
$meses[9] = 'Sep';
$meses[10] = 'Oct';
$meses[11] = 'Nov';
$meses[12] = 'Dic';

$meses2['01'] = 'Enero';
$meses2['02'] = 'Febrero';
$meses2['03'] = 'Marzo';
$meses2['04'] = 'Abril';
$meses2['05'] = 'Mayo';
$meses2['06'] = 'Junio';
$meses2['07'] = 'Julio';
$meses2['08'] = 'Octubre';
$meses2['09'] = 'Septiembre';
$meses2['10'] = 'Octubre';
$meses2['11'] = 'Noviembre';
$meses2['12'] = 'Diciembre';

$fecha_literal = "La Paz, " . date('d') . ' de ' . $meses2[date('m')] . ' de ' . date('Y');

$imagen_logo = $this->Session->read('Auth.User.Edificio.imagen');


$x = 0;
$y = 0;

$contador = 0;
foreach ($ambientes as $amb) {
    $contador++;
    if ($contador == 1) {
        $pdf->AddPage();
        $x = 0;
        $y = 0;
    } elseif ($contador == 2) {
        $x = 140;
        $y = 0;
    } elseif ($contador == 3) {
        $x = 0;
        $y = 108;
    } elseif ($contador == 4) {
        $x = 140;
        $y = 108;
        $contador = 0;
    }

    if (!empty($imagen_logo)) {
        $imagen = WWW_ROOT . 'imagenes' .DS.$imagen_logo;
        $pdf->Image($imagen, $x + 17, $y + 12, 26, 9, '', '', '', false, 300, '', false, false, 0, false, false, false);
    }

    $pdf->SetFont(null, 'IB', 11);
    $pdf->Text($x + 94, $y + 15, 'PRE-AVISO');

    $pdf->SetFont(null, 'B', 8);
    $pdf->Text($x + 58, $y + 27, "Cuota de $nombre_concepto Bs. " . $amb['ambiente']['Ambienteconcepto']['monto']);


    $pdf->SetFont(null, 'BI', 7);
    $pdf->SetFillColor(255, 255, 255);
    $mis_bordes = array('LTRB' => array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
    $pdf->SetXY($x + 6, $y + 32);
    $pdf->MultiCell(27, 4.2, 'Copropietario: ', $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 4.2, 'M');
    $pdf->SetXY($x + 6, $y + 36.2);
    $pdf->MultiCell(27, 4.2, 'Inquilino: ', $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 4.2, 'M');
    $pdf->SetXY($x + 6, $y + 40.4);
    $pdf->MultiCell(27, 4.2, 'Ambiente: ', $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 4.2, 'M');

    $pdf->SetXY($x + 33, $y + 32);
    $pdf->MultiCell(8, 4.2, '', $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 8, 'M');
    $pdf->SetXY($x + 33, $y + 36.2);
    $pdf->MultiCell(8, 4.2, '', $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 8, 'M');
    $pdf->SetXY($x + 33, $y + 40.4);
    $pdf->MultiCell(8, 4.2, '', $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 8, 'M');

    $pdf->SetFont(null, '', 7);
    $pdf->SetXY($x + 42, $y + 32);
    $pdf->MultiCell(71, 4.2, $amb['ambiente']['User']['nombre'], $mis_bordes, 'L', 1, 0, '', '', true, 0, false, true, 4.2, 'M');
    $pdf->SetXY($x + 42, $y + 36.2);
    $pdf->MultiCell(49, 4.2, $amb['ambiente']['Inquilino']['nombre'], $mis_bordes, 'L', 1, 0, '', '', true, 0, false, true, 4.2, 'M');
    $pdf->SetXY($x + 42, $y + 40.4);
    $pdf->MultiCell(49, 4.2, $amb['ambiente']['Ambiente']['nombre'], $mis_bordes, 'L', 1, 0, '', '', true, 0, false, true, 4.2, 'M');
    $pdf->SetFont(null, 'B', 7);
    $pdf->SetXY($x + 91, $y + 36.2);
    $pdf->MultiCell(22, 4.2, "Planta", $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 4.2, 'M');
    $pdf->SetFont(null, '', 7);
    $pdf->SetXY($x + 91, $y + 40.4);
    $pdf->MultiCell(22, 4.2, $amb['ambiente']['Piso']['nombre'], $mis_bordes, 'L', 1, 0, '', '', true, 0, false, true, 4.2, 'M');

    $ya = $y + 45;
    $xa = $x + 6;
    $pdf->SetFont(null, 'BI', 6);
    $pdf->SetXY($xa, $ya);
    $pdf->MultiCell(8, 4.5, 'Año', $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');
    for ($i = 1; $i <= 12; $i++) {
        $xa = $xa + 8.3;
        $pdf->SetXY($xa, $ya);
        $pdf->MultiCell(8.3, 4.5, $meses[$i], $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');
    }
    $xa = $xa + 8;
    $pdf->SetXY($xa, $ya);
    $pdf->MultiCell(15, 4.5, 'Mes - Bs.', $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');

    $pdf->SetXY($xa, $ya - 4);
    $pdf->MultiCell(15, 4, 'T. Deuda', $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 4, 'M');

    $ya = $y + 45;

    $pdf->SetFont(null, '', 6);
    $total_to = 0.00;
    foreach ($amb['pagos'] as $ano => $aa) {
        $xa = $x + 6;
        $ya = $ya + 4.5;
        $pdf->SetXY($xa, $ya);
        $tot_monto_d = 0.00;
        $cont_deu = 0;
        $pdf->MultiCell(8, 4.5, $ano, $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');
        for ($i = 1; $i <= 12; $i++) {
            $xa = $xa + 8.3;
            $pdf->SetXY($xa, $ya);
            $monto_d = 0.00;
            if (!empty($aa[$i])) {
                $monto_d = $aa[$i];
                $cont_deu++;
            }
            $tot_monto_d = $tot_monto_d + $monto_d;
            $pdf->MultiCell(8.3, 4.5, $monto_d, $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');
        }
        $total_to = $total_to + $tot_monto_d;
        $xa = $xa + 8;
        $pdf->SetXY($xa, $ya);
        $pdf->MultiCell(5, 4.5, $cont_deu, $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 3.5, 'M');
        $xa = $xa + 4;
        $pdf->SetXY($xa, $ya);
        $pdf->MultiCell(10, 4.5, $tot_monto_d, $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 3.5, 'M');
    }
    $pdf->SetFont(null, 'BI', 6.5);
    $mis_bordes = array('TB' => array('width' => 0.7, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
    $ya = $ya + 4.8;
    $pdf->SetXY($x + 60, $ya);
    $pdf->MultiCell(55, 5.5, "TOTAL Deuda pendiente de pago Bs.:", $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 5.5, 'M');
    $pdf->SetXY($x + 115, $ya);
    $pdf->MultiCell(13, 5.5, $total_to, $mis_bordes, 'R', 1, 0, '', '', true, 0, false, true, 5.5, 'M');

    $mis_bordes = array('B' => array('width' => 0.7, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
    $pdf->SetFont(null, '', 7.5);
    $pdf->SetXY($x + 6, $y + 96);
    $pdf->MultiCell(123, 6, "Atentamente: LA ADMINISTRACION", $mis_bordes, 'C', 1, 0, '', '', true, 0, false, true, 5.5, 'M');

    $pdf->SetFont(null, 'IB', 7.5);
    $pdf->Text($x + 10, $y + 103, "Fecha del pre-aviso: $fecha_literal");
}





$pdf->Output('credencial.pdf', 'I');
exit;
?>
<!--<table style="background-color: #ccffcc;">
    <tr>
        <td style="padding-bottom: 1px; border: 1px solid #00000; height: 30px;">
            
        </td>
    </tr>
</table>-->