<div class="table-responsive">
    <table class="table table-striped table-vcenter">
        <thead>
            <tr>
                <td>#</td>
                <td>Ambiente</td>
                <td>Piso</td>
                <td>Propietario</td>
                <td>Representante</td>
                <td>Concepto</td>
                <td>Estado</td>
                <td>Costo</td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0;?>
            <?php $total_monto = 0.00;?>
            <?php foreach ($pagos as $pa): ?>
            <?php $total_monto = $total_monto + $pa[0]['monto_total'];?>
            <?php $i++;?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $pa['Ambiente']['nombre'];?></td>
                  <td><?php echo $pa['Pago']['piso'];?></td>
                  <td><?php echo $pa['Propietario']['nombre'];?></td>
                  <td><?php echo $pa['Pago']['representante'];?></td>
                  <td><?php echo $pa['Concepto']['nombre'];?></td>
                  <td><?php echo $pa['Pago']['estado'];?></td>
                  <td><?php echo $pa[0]['monto_total'];?></td>
              </tr>
            <?php endforeach; ?>
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><?php echo $total_monto;?></td>
              </tr>
        </tbody>
    </table>
</div>