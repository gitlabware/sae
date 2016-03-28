<style type="text/css" media="print">
    .no-imprime{
        display: none !important;
    }
</style>

<div class="block">
    <table class="table table-bordered">
        <tr>
            <td align="center" style="width: 50%;">
                <?php if (!empty($edificio['Edificio']['imagen'])): ?>
                  <img src="<?php echo $this->webroot . 'imagenes/' .$edificio['Edificio']['imagen']; ?>" alt="Logo" height="80" width="250">
                <?php endif; ?>
            </td>
            <td style="width: 50%;">
                <span class="text-success" style="font-size: 18px;">COMPROBANTE DE <?php echo strtoupper($comprobante['Comprobante']['tipo']); ?></span><br>
                <span class="text-success" style="font-size: 16px;">NUMERO: <?php echo $comprobante['Comprobante']['numero'] ?></span><br>
                <span class="text-success" style="font-size: 16px;">FECHA: <?php echo $comprobante['Comprobante']['fecha'] ?></span>
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
            <td style="font-size: 16px; font-weight: bold;"><?php echo $pagador; ?></td>
            <td><?php echo $comprobante['Comprobante']['nombre'] ?></td>
            <td style="font-size: 16px; font-weight: bold;">Bs. </td>
            <td><?php echo $comprobante['Comprobante']['monto_total'] ?></td>
        </tr>
        <tr>
            <td style="font-size: 16px; font-weight: bold;">Doc. Respaldo: </td>
            <td><?php echo $comprobante['Comprobante']['nota'] ?></td>
            <td style="font-size: 16px; font-weight: bold;">T/C UFV: </td>
            <td><?php echo $comprobante['Comprobante']['tc_ufv'] ?></td>
        </tr>
    </table>
    <table class="table table-bordered" style="margin-top: -10px;">
        <thead>
            <tr>
                <th>Cod.Ap.</th>
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
                  <td><?php echo $com['Comprobantescuenta']['codigo_subc'] ?></td>
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
    <table class="table table-bordered" style="margin-top: -10px;">
        <tr>
            <td style="font-size: 16px; font-weight: bold;">Glosa: </td>
            <td><?php echo nl2br($comprobante['Comprobante']['concepto']) ?></td>
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