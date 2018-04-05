<div class="row">
  <div class="col-md-12">
    <!-- Basic Form Elements Block -->
    <div class="card">
      <!-- Basic Form Elements Title -->
      <div class="card-header">
        <h4>REPORTE DE EGRESOS SEGUN BANCO/CAJA</h4>
      </div>
      <div class="card-body">
        <?php echo $this->Form->create('Reporte', array('id' => 'ajaxform')); ?>
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label class="control-label">Fecha_Inicio</label>
              <?php echo $this->Form->date('fecha_ini', array('class' => 'form-control', 'required')); ?>
            </div>
            <div class="col-md-3">
              <label class="control-label">Fecha_Fin</label>
              <?php echo $this->Form->date('fecha_fin', array('class' => 'form-control', 'required')); ?>
            </div>

            <div class="col-md-4">
              <label class="control-label">Banco/Caja</label>
              <?php echo $this->Form->select('banco_id', $bancos, array('class' => 'form-control', 'requied')); ?>
            </div>
            <div class="col-md-2">
              <label class="control-label">&nbsp;</label>
              <button class="btn btn-primary form-control">BUSCAR</button>
            </div>
          </div>
        </div>
        <?php echo $this->Form->end(); ?>
        <?php if (!empty($egresos)): ?>
          <div class="form-group">
            <div class="row">
              <div class="col-md-12" id="divtablapagos">
                <table class="table table-bordered">
                  <thead>
                    <tr class="warning">
                      <th>Item</th>
                      <th>Fecha</th>
                      <th>Referencia</th>
                      <th>Proveedor</th>
                      <th>Detalle</th>
                      <th>Tipo Cuenta</th>
                      <th>Ingreso</th>
                      <th>Egreso</th>
                      <th>Saldo</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $saldo = 0.00; ?>
                    <?php foreach ($egresos as $key => $eg): ?>
                      <?php $saldo+=$eg['datos']['saldo'] + $eg['datos']['ingreso']; ?>
                      <?php $saldo-= $eg['datos']['egreso']; ?>
                      <tr>
                        <td><?php echo $key ?></td>
                        <td><?php echo $eg['datos']['fecha'] ?></td>
                        <td><?php echo $eg['datos']['referencia'] ?></td>
                        <td><?php echo $eg['datos']['proveedor'] ?></td>
                        <td><?php echo $eg['datos']['detalle'] ?></td>
                        <td><?php echo $eg['datos']['nomenclatura'] ?></td>
                        <td><?php echo $eg['datos']['ingreso'] ?></td>
                        <td><?php echo $eg['datos']['egreso'] ?></td>
                        <td><?php echo $saldo ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">

              <div class="col-md-12" id="divtablapagos" align="center">
                <table class="table table-bordered" style="width: 50%;">
                  <tbody>
                    <?php $total = 0.00; ?>
                    <?php foreach ($cuentas as $cu): ?>
                      <?php $total+= $cu[0]['monto']; ?>
                      <tr>
                        <td class="warning"><?php echo $cu['Nomenclatura']['codigo_completo'] ?></td>
                        <td class="success"><?php echo $cu['Nomenclatura']['nombre'] ?></td>
                        <td class="info"><?php echo $cu[0]['monto'] ?></td>
                      </tr>
                    <?php endforeach; ?>
                    <tr>
                      <td></td>
                      <td><b>TOTAL EGRESOS:</b></td>
                      <td><?php echo $total ?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><b>SALDO:</b></td>
                      <td><?php echo $saldo ?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><b>TOTAL:</b></td>
                      <td><?php echo $total + $saldo ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
