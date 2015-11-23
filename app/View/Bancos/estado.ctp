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
                      <td><?php echo $in['Cuentasmonto']['created'] ?></td>
                      <td><?php echo $in['Pago']['fecha'] ?></td>
                      <td><?php echo $in['Cuentasmonto']['concepto'] ?></td>
                      <td><?php echo $in['Cuentasmonto']['porcentaje'] ?></td>
                      <td><?php echo $in['Cuentasmonto']['monto'] ?></td>
                      <td><?php echo $in['Cuentasmonto']['ambiente'] ?></td>
                      <td><?php echo $in['Cuentasmonto']['piso'] ?></td>
                  </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <br>
</div>

<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de Movimientos</h2>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Movimiento</th>
                    <th>Banco/Caja</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movimientos as $mo): ?>
                  <tr>
                      <td><?php echo $mo['Bancosmovimiento']['fecha']; ?></td>
                      <td><?php echo $mo['Bancosmovimiento']['movimiento']; ?></td>
                      <td><?php echo $mo['Bancosmovimiento']['banco']; ?></td>
                      <td><?php echo $mo['Bancosmovimiento']['monto']; ?></td>
                  </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <br>
</div>

<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de Egresos</h2>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Detalle</th>
                    <th>Proveedor</th>
                    <th>Tipo E.</th>
                    <th>Banco</th>
                    <th>Cuenta</th>
                    <th>Monto Bs</th>
                    <th>Referencia</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($egresos as $eg): ?>
                  <tr>
                      <td><?php echo $eg['Cuentasegreso']['fecha'] ?></td>
                      <td><?php echo $eg['Cuentasegreso']['detalle'] ?></td>
                      <td><?php echo $eg['Cuentasegreso']['proveedor'] ?></td>
                      <td><?php echo $eg['Nomenclatura']['nombre'] ?></td>
                      <td><?php echo $eg['Banco']['nombre'] ?></td>
                      <td><?php echo $eg['Cuenta']['nombre'] ?></td>
                      <td><?php echo $eg['Cuentasegreso']['monto'] ?></td>
                      <td><?php echo $eg['Cuentasegreso']['referencia'] ?></td>
                  </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <br>
</div>

