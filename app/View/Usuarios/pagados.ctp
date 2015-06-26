<!-- END Blank Header -->
<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de ultimos pagos realizados</h2>
    </div>    
    <!-- Example Content -->
    <div class="table-responsive">
        <table id="general-table" class="table table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    <th>Fecha de Pago</th>
                    <th>Concepto</th>
                    <th>De fecha</th>
                    <th>Monto</th>
                    <th>Retencion</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php //$total_total = 0.00; ?>
                <?php //$total = 0.00; ?>
                <?php foreach ($pagados as $pa): ?>
                  <?php //$total_total = $total_total + $pa['Pago']['monto_total']; ?>
                  <?php //$total = $total + $pa['Pago']['monto']; ?>
                  <tr>
                      <td><?php echo $pa['Pago']['modified'] ?></td>
                      <td><?php echo $pa['Concepto']['nombre'] ?></td>
                      <td><?php echo $pa['Pago']['fecha'] ?></td>
                      <td><?php echo $pa['Pago']['monto'] ?></td>
                      <td><?php echo $pa['Pago']['monto_ret'] ?></td>
                      <td><?php echo $pa['Pago']['monto_total'] ?></td>
                  </tr>
                <?php endforeach; ?>
              <!--<tr>
                  <td></td>
                  <td></td>
                  <td>TOTAL</td>
                  <td><?php // echo $total;  ?></td>
                  <td></td>
                  <td><?php //echo $total_total;  ?></td>
              </tr>-->
            </tbody>

        </table>
    </div>
    <!-- END Example Content -->
</div>
<!-- END Example Block -->