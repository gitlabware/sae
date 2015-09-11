

<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de Ingresos</h2>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha de Pago</th>
                    <th>Corresponde a fecha</th>
                    <th>Concepto</th>
                    <th>Porcentaje</th>
                    <th>Monto</th>
                    <th>Ambiente</th>
                    <th>Piso</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ingresos as $in): ?>
                  <tr>
                      <td><?php echo $in['Cuentasmonto']['created']?></td>
                      <td><?php echo $in['Pago']['fecha']?></td>
                      <td><?php echo $in['Cuentasmonto']['concepto']?></td>
                      <td><?php echo $in['Cuentasmonto']['porcentaje']?></td>
                      <td><?php echo $in['Pago']['monto']*$in['Cuentasmonto']['porcentaje']/100?></td>
                      <td><?php echo $in['Cuentasmonto']['ambiente']?></td>
                      <td><?php echo $in['Cuentasmonto']['piso']?></td>
                  </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <br>
</div>

