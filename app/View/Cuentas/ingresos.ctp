<div class="row">
 <div class="col-12">
  <div class="card">
    <div class="card-body">
      <h1 class="card-title text-center">Movimientos</h1>

      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down "> <font size=5> Lista de Ingresos</font></span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down"><font size=5> Lista de Egresos </font> </span></a> </li>         
        
        
      </ul>
      <!-- Tab panes -->
      <div class="tab-content tabcontent-border">
        <div class="tab-pane active" id="home" role="tabpanel">
          <div class="p-20">
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
                    <td><?php echo $in['Cuentasmonto']['monto']?></td>
                    <td><?php echo $in['Cuentasmonto']['ambiente']?></td>
                    <td><?php echo $in['Cuentasmonto']['piso']?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

          </div>
        </div>


        <div class="tab-pane  p-20" id="profile" role="tabpanel">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Detalle</th>
                <th>Proveedor</th>
                <th>Tipo E.</th>
                <th>Banco</th>
                <th>Cuenta</th>
                <th>Monto</th>
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
        
      </div>
    </div>
  </div>
</div>
</div>



