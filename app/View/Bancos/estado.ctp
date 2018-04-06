<div class="col-md-6 col-8 align-self-center">
  <h2 class="text-themecolor m-b-0 m-t-0">DETALLES SOBRE <b><?php echo $banco['Banco']['nombre']?> (TOTAL: <?php echo $banco['Banco']['monto']?>)</b></h2>
</div>

<div class="row">
  <div class="col-md-12">
   <div class="card">
    <div class="card-body">
     <div class="table-responsive m-t-40">
      <!-- Basic Form Elements Title -->

      <div class="form-horizontal form-bordered">
        <?php echo $this->Form->create('Reporte', array('id' => 'ajaxform')); ?>
        <div class="form-group">
          <div class="col-md-4">
            <label class="control-label"><b>Fecha_Inicio</b></label>
            <?php echo $this->Form->date('fecha_ini', array('class' => 'form-control', 'required')); ?>
          </div>
          <div class="col-md-4">
            <label class="control-label"><b>Fecha_Fin</b></label>
            <?php echo $this->Form->date('fecha_fin', array('class' => 'form-control', 'required')); ?>
          </div>

          <div class="col-md-4">
            <label class="control-label">&nbsp;</label>
            <button class="btn btn-block btn-danger">GENERAR</button>
          </div>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-8 align-self-center">
    <h2 class="text-themecolor m-b-0 m-t-0">REPORTE DE EGRESOS BANCO/CAJA ()</h2>
  </div>        
 
    <?php if (!empty($egresos)): ?>

      <div class="col-12" id="divtablapagos">
        <div class="card">
          <div class="card-body">
           <div class="table-responsive m-t-40">
            <table id="general-table" class="table table-bordered">
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
    </div>
  


  <div class="col-12" id="divtablapagos" align="center">
   <div class="card">
    <div class="card-body">
     <div class="table-responsive m-t-40">
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
</div>

<?php endif; ?>
</div>
</div>
</div>
</div>

