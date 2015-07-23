<style type="text/css" media="print">
    @page {
        size: 16.5cm 21.59cm;
        
    }
    *{
        background-color: white !important;
        margin: 0px !important;
        padding: 0px !important;

    }
    
    .no-imprime{
        display: none !important;
    }
    

    .cabecera-r{

    }

    .block{
        margin-left: 1cm !important;
        margin-right: 1cm !important;
        margin-top: 2.5cm !important;
        height: 15.5cm !important;
        border: 0px;
    }
    
    .CSSTableGenerator {
        margin:0px;padding:0px;
        width:100%;
        border:1px solid #000000;

        -moz-border-radius-bottomleft:0px;
        -webkit-border-bottom-left-radius:0px;
        border-bottom-left-radius:0px;

        -moz-border-radius-bottomright:0px;
        -webkit-border-bottom-right-radius:0px;
        border-bottom-right-radius:0px;

        -moz-border-radius-topright:0px;
        -webkit-border-top-right-radius:0px;
        border-top-right-radius:0px;

        -moz-border-radius-topleft:0px;
        -webkit-border-top-left-radius:0px;
        border-top-left-radius:0px;
    }.CSSTableGenerator table{
        border-collapse: collapse;
        border-spacing: 0;
        width:100%;
        height:100%;
        margin:0px;padding:0px;
    }.CSSTableGenerator tr:last-child td:last-child {
        -moz-border-radius-bottomright:0px;
        -webkit-border-bottom-right-radius:0px;
        border-bottom-right-radius:0px;
    }
    .CSSTableGenerator table tr:first-child td:first-child {
        -moz-border-radius-topleft:0px;
        -webkit-border-top-left-radius:0px;
        border-top-left-radius:0px;
    }
    .CSSTableGenerator table tr:first-child td:last-child {
        -moz-border-radius-topright:0px;
        -webkit-border-top-right-radius:0px;
        border-top-right-radius:0px;
    }.CSSTableGenerator tr:last-child td:first-child{
        -moz-border-radius-bottomleft:0px;
        -webkit-border-bottom-left-radius:0px;
        border-bottom-left-radius:0px;
    }.CSSTableGenerator tr:hover td{
        background-color:#ffffff;


    }
    .CSSTableGenerator td{
        vertical-align:middle !important;

        background-color:#ffffff !important;

        border:1px solid #000000 !important;
        border-width:0px 1px 1px 0px !important;
        padding:1px !important;
        font-size:10px !important;
        font-family:Arial !important;
        font-weight:bold !important;
        color:#000000 !important;
    }.CSSTableGenerator tr:last-child td{
        border-width:0px 1px 0px 0px;
    }.CSSTableGenerator tr td:last-child{
        border-width:0px 0px 1px 0px;
    }.CSSTableGenerator tr:last-child td:last-child{
        border-width:0px 0px 0px 0px;
    }
</style>
<style>
    .CSSTableGenerator {
        margin:0px;padding:0px;
        width:100%;
        border:1px solid #000000;

        -moz-border-radius-bottomleft:0px;
        -webkit-border-bottom-left-radius:0px;
        border-bottom-left-radius:0px;

        -moz-border-radius-bottomright:0px;
        -webkit-border-bottom-right-radius:0px;
        border-bottom-right-radius:0px;

        -moz-border-radius-topright:0px;
        -webkit-border-top-right-radius:0px;
        border-top-right-radius:0px;

        -moz-border-radius-topleft:0px;
        -webkit-border-top-left-radius:0px;
        border-top-left-radius:0px;
    }.CSSTableGenerator table{
        border-collapse: collapse;
        border-spacing: 0;
        width:100%;
        height:100%;
        margin:0px;padding:0px;
    }.CSSTableGenerator tr:last-child td:last-child {
        -moz-border-radius-bottomright:0px;
        -webkit-border-bottom-right-radius:0px;
        border-bottom-right-radius:0px;
    }
    .CSSTableGenerator table tr:first-child td:first-child {
        -moz-border-radius-topleft:0px;
        -webkit-border-top-left-radius:0px;
        border-top-left-radius:0px;
    }
    .CSSTableGenerator table tr:first-child td:last-child {
        -moz-border-radius-topright:0px;
        -webkit-border-top-right-radius:0px;
        border-top-right-radius:0px;
    }.CSSTableGenerator tr:last-child td:first-child{
        -moz-border-radius-bottomleft:0px;
        -webkit-border-bottom-left-radius:0px;
        border-bottom-left-radius:0px;
    }.CSSTableGenerator tr:hover td{
        background-color:#ffffff;


    }
    .CSSTableGenerator td{
        vertical-align:middle;

        background-color:#ffffff;

        border:1px solid #000000;
        border-width:0px 1px 1px 0px;
        padding:7px;
        font-size:10px;
        font-family:Arial;
        font-weight:bold;
        color:#000000;
    }.CSSTableGenerator tr:last-child td{
        border-width:0px 1px 0px 0px;
    }.CSSTableGenerator tr td:last-child{
        border-width:0px 0px 1px 0px;
    }.CSSTableGenerator tr:last-child td:last-child{
        border-width:0px 0px 0px 0px;
    }

</style>
<div class="block">
    <table class="CSSTableGenerator cabecera-r">
        <tr>
            <td></td>
            <td style="width: 60%;">
                <span class="text-success" style="font-size: 16px;">RECIBO</span><br>
                <span class="text-success" style="font-size: 14px;">INGRESO POR MANTENIMIENTO Y OTROS</span>
            </td>
        </tr>
    </table>
    <table class="CSSTableGenerator" style="margin-top:-1px;">
        <tr>
            <td><span class="text-success" style="font-size:12px;">Propietario: </span></td>
            <td><?php echo $recibo['Propietario']['nombre']; ?></td>
            <td>
                <span class="text-success">FECHA: <?php echo date('d/m/Y'); ?></span>
            </td>
        </tr>
    </table>
    <table class="CSSTableGenerator" style="margin-top:-1px;">
        <tr>
            <td><span class="text-success" style="font-size:12px;">Pagador: </span></td>
            <td><?php
                if (!empty($recibo['Recibo']['inquilino_id'])) {
                  echo $recibo['Recibo']['usuario_inquilino'] . ' (Inquilino)';
                } else {
                  echo $recibo['Propietario']['nombre'] . ' (Propietario)';
                }
                ?></td>
            <td>
                <span class="text-success">Nro: <?php echo $recibo['Recibo']['numero']; ?></span>
            </td>
        </tr>
    </table>
    <table class="CSSTableGenerator" style="margin-top:-1px;">
        <tr>
            <td style="background-color: #B7B7B7;"><span>Nro</span></td>
            <td style="background-color: #B7B7B7;"><span>Concepto</span></td>
            <td style="background-color: #B7B7B7;"><span>Importe Total Bs</span></td>
        </tr>
        <?php $i = 0;
        $total_i = 0.00;
        ?>
<?php foreach ($pagos as $pa):$i++; ?>
          <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $pa['Concepto']['nombre']; ?></td>
              <td><?php echo $pa[0]['imp_total']; ?></td>
          </tr>
          <?php $total_i = $total_i + $pa[0]['imp_total']; ?>
<?php endforeach; ?>
        <tr>
            <td style="background-color: #B7B7B7;"></td>
            <td style="background-color: #B7B7B7;">TOTAL BOLIVIANOS</td>
            <td style="background-color: #B7B7B7;"><?php echo $total_i; ?></td>
        </tr>
    </table>
    DETALLE DE LAS CUOTAS
    <table class="CSSTableGenerator">
        <tr>
            <td style="background-color: #B7B7B7;">Id</td>
            <td style="background-color: #B7B7B7;">Fecha</td>
            <td style="background-color: #B7B7B7;">Ambiente</td>
            <td style="background-color: #B7B7B7;">Monto</td>
        </tr>
        <?php $total_det = 0.00; ?>
        <?php foreach ($detalles as $det): ?>
  <?php $total_det = $total_det + $det['Pago']['monto_total']; ?>
          <tr>
              <td><?php echo $det['Pago']['id'] ?></td>
              <td><?php echo $det['Pago']['fecha'] ?></td>
              <td><?php echo $det['Ambiente']['nombre'] ?></td>
              <td><?php echo $det['Pago']['monto_total'] ?></td>
          </tr>
<?php endforeach; ?>
        <tr>
            <td style="background-color: #B7B7B7;"></td>
            <td style="background-color: #B7B7B7;"></td>
            <td style="background-color: #B7B7B7;">Total</td>
            <td style="background-color: #B7B7B7;"><?php echo $total_det; ?></td>
        </tr>
    </table>
    GESTIONES ANTERIORES DE DETALLE DE LAS CUOTAS
    <table class="CSSTableGenerator">
        <tr>
            <td style="background-color: #B7B7B7;">Id</td>
            <td style="background-color: #B7B7B7;">Fecha</td>
            <td style="background-color: #B7B7B7;">Ambiente</td>
            <td style="background-color: #B7B7B7;">Monto</td>
        </tr>
        <?php $total_det_a = 0.00; ?>
        <?php foreach ($detalles_a as $det): ?>
  <?php $total_det = $total_det + $det['Pago']['monto_total']; ?>
          <tr>
              <td><?php echo $det['Pago']['id'] ?></td>
              <td><?php echo $det['Pago']['fecha'] ?></td>
              <td><?php echo $det['Ambiente']['nombre'] ?></td>
              <td><?php echo $det['Pago']['monto_total'] ?></td>
          </tr>
<?php endforeach; ?>
        <tr>
            <td style="background-color: #B7B7B7;"></td>
            <td style="background-color: #B7B7B7;"></td>
            <td style="background-color: #B7B7B7;">Total</td>
            <td style="background-color: #B7B7B7;"><?php echo $total_det_a; ?></td>
        </tr>
    </table>
    <table class="CSSTableGenerator" style="margin-top:-1px;">
        <tr>
            <td>Son: <?php echo $this->requestAction(array('action' => 'get_monto_literal', $total_i)); ?> Bolivianos</td>
        </tr>
    </table>
    <br>
    <div class="row ocultar-imp">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary col-md-12" onclick="window.print();">IMPRIMIR</button>
        </div>
    </div>
    <br>
</div>