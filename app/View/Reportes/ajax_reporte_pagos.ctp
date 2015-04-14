<div class="table-responsive">
    <table class="table table-striped table-vcenter">
        <thead>
            <tr>
                <td>#</td>
                <td>Ambiente</td>
                <td>Piso</td>
                <td>Propietario</td>
                <td>Inquilinos</td>
                <td>Fecha</td>
                <td>Concepto</td>
                <td>Costo</td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0;?>
            <?php foreach ($pagos as $pa): ?>
            <?php $i++;?>
              <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $pa['Ambiente']['nombre'];?></td>
                  <td><?php echo $pa['Pago']['piso'];?></td>
                  <td><?php echo $pa['Propietario']['nombre'];?></td>
                  <td><?php echo $pa['Pago']['inquilino'];?></td>
                  <td><?php echo $pa['Pago']['fecha'];?></td>
                  <td><?php echo $pa['Concepto']['nombre'];?></td>
                  <td><?php echo $pa['Pago']['monto'];?></td>
              </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>