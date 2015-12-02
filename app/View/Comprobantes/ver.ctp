<style type="text/css" media="print">
    .no-imprime{
        display: none !important;
    }
</style>

<div class="block">
    <table class="table table-bordered">
        <tr>
            <td></td>
            <td style="width: 60%;">
                <span class="text-success" style="font-size: 18px;">COMPROBANTE DE <?php echo strtoupper($comprobante['Comprobante']['tipo']); ?></span><br>
                <span class="text-success" style="font-size: 16px;">NUMERO: <?php echo $comprobante['Comprobante']['numero'] ?></span>
            </td>
        </tr>
    </table>
    <table class="table table-bordered" style="margin-top: -21px;">
        <?php
        
        $pagador = "";
        if ($comprobante['Comprobante']['tipo'] == 'Ingreso') {
          $pagador = "Recibido de: ";
        } elseif ($comprobante['Comprobante']['tipo'] == 'Egreso') {
          $pagador = "Beneficiario: ";
        } elseif ($comprobante['Comprobante']['tipo'] == 'Ingreso de Banco') {
          $pagador = "Recibido de: ";
        }
        ?>
        <tr>
            <td><?php echo $pagador; ?></td>
            <td><?php echo $comprobante['Comprobante']['nombre'] ?></td>
            <td>Bs. </td>
            <td><?php echo $comprobante['Comprobante']['monto_total'] ?></td>
        </tr>
        <tr>
            <td>Concepto: </td>
            <td><?php echo $comprobante['Comprobante']['concepto'] ?></td>
            <td>Fecha: </td>
            <td><?php echo $comprobante['Comprobante']['fecha'] ?></td>
        </tr>
        <tr>
            <td>Doc. Respaldo: </td>
            <td><?php echo $comprobante['Comprobante']['nota'] ?></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table class="table table-bordered" style="margin-top: -10px;">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Cuenta Contable</th>
                <th>Auxiliar</th>
                <th>Debe</th>
                <th>Haber</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $debe = 0.00;
            $haber = 0.00;
            ?>
            <?php foreach ($comprobantes as $com): ?>
              <?php
              $debe += $com['Comprobantescuenta']['debe'];
              $haber += $com['Comprobantescuenta']['haber'];
              ?>
              <tr>
                  <td><?php echo $com['Comprobantescuenta']['codigo'] ?></td>
                  <td><?php echo $com['Comprobantescuenta']['cta_ctable'] ?></td>
                  <td><?php echo $com['Comprobantescuenta']['auxiliar'] ?></td>
                  <td><?php echo $com['Comprobantescuenta']['debe'] ?></td>
                  <td><?php echo $com['Comprobantescuenta']['haber'] ?></td>
              </tr>
            <?php endforeach; ?>
            <tr>
                <td>SON: </td>
                <td><?php echo $this->requestAction(array('controller' => 'Ambientes', 'action' => 'get_monto_literal', $comprobante['Comprobante']['monto_total'])); ?> Bolivianos</td>
                <td>TOTAL Bs.</td>
                <td><?php echo $debe; ?></td>
                <td><?php echo $haber; ?></td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered" style="margin-top: -10px;">
        <tr>
            <td style="height: 100px;">
                Realizado por:
            </td>
            <td style="height: 100px;">
                Aprobado por:
            </td>
            <td style="height: 100px;">
                Realizado por:
            </td>
        </tr>
    </table>

</div>
<div class="block no-imprime">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-block btn-primary" onclick="window.print();">IMPRIMIR</button><br>
        </div>
    </div>
</div>