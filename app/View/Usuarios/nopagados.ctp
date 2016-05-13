<!-- END Blank Header -->
<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de deudas</h2>
    </div>    
    <!-- Example Content -->
    <div class="table-responsive">
        <table id="general-table" class="table table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th>De fecha</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0.00; ?>
                <?php foreach ($nopagados as $pa): ?>
                  <?php $total = $total + $pa['Pago']['monto']; ?>
                  <tr>
                      <td><?php echo $pa['Concepto']['nombre'] ?></td>
                      <td><?php echo $pa['Pago']['fecha'] ?></td>
                      <td><?php echo $pa['Pago']['monto'] ?></td>
                  </tr>
                <?php endforeach; ?>
              <tr>
                  <td></td>
                  <td>TOTAL</td>
                  <td><?php  echo $total;  ?></td>
              </tr>
            </tbody>

        </table>
    </div>
    <!-- END Example Content -->
</div>
<!-- END Example Block -->