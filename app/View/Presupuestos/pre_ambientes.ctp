<div class="block">
    <h3 class="text-center">EDIFICIO <?php echo strtoupper($this->Session->read('Auth.User.Edificio.nombre')); ?></h3>
    <h4 class="text-center">SUB-CONCEPTO <?= $subconcepto['Subconcepto']['nombre']; ?></h4>
    <div class="form-horizontal form-bordered">
        <?php echo $this->Form->create('Presupuesto', array('action' => 'guarda_ingreso', $presupuesto['Presupuesto']['id'], 'id' => 'form-ingresos')); ?>
        <?php echo $this->Form->hidden('Ingreso.presupuesto_id', array('value' => $presupuesto['Presupuesto']['id'])); ?>
        <?php echo $this->Form->hidden('Ingreso.subconcepto_id', array('value' => $subconcepto['Subconcepto']['id'])); ?>
        <?php echo $this->Form->hidden('Ingreso.concepto_id', array('value' => $subconcepto['Subconcepto']['concepto_id'])); ?>
        <div class="form-group">

            <div class="col-md-1">
                <label>%</label>
                <?php echo $this->Form->text('Ingreso.porcentaje', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'max' => 1, 'placeholder' => '0.00', 'id' => 'c-porcentaje')); ?>
            </div>
            <div class="col-md-2">
                <label>Ingreso anual</label>
                <?php echo $this->Form->text('Ingreso.ingreso', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00', 'id' => 'c-ingreso')); ?>
            </div>
            <div class="col-md-2">
                <label>Presupuesto anterior</label>
                <?php echo $this->Form->text('Ingreso.pres_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
            <div class="col-md-2">
                <label>Ejecutado anterior</label>
                <?php echo $this->Form->text('Ingreso.ejec_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
            <div class="col-md-2">
                <label>Presupuesto</label>
                <?php echo $this->Form->text('Ingreso.presupuesto', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00', 'id' => 'c-presupuesto')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <button class="btn btn-alt btn-primary col-md-12" type="submit">REGISTRAR</button>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter table-condensed table-bordered dataTable no-footer">
            <thead>
                <tr>
                    <th>Ambiente</th>
                    <th>Piso</th>
                    <th>Representante</th>
                    <th>Monto</th>
                    <th></th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="ambientes-a">
                <?php $i = 0; ?>
                <?php foreach ($nomenclaturas as $no): ?>
                  <tr>
                      <td colspan="7" class="info text-center"><h4><?= $no['Nomenclatura']['nombre']; ?></h4></td>
                  </tr>
                  <?php
                  $ambientes = $this->requestAction(array('action' => 'get_amb_nom', $no['Nomenclatura']['id'], $subconcepto['Subconcepto']['concepto_id']));
                  ?>
                  <?php foreach ($ambientes as $am): ?>
                    <?php $i++; ?>
                    <tr>
                        <td><?= $am['Ambiente']['nombre'] ?></td>
                        <td><?= $am['NomenclaturasAmbiente']['piso'] ?></td>
                        <td><?= $am['NomenclaturasAmbiente']['representante'] ?></td>
                        <td><?= $this->Form->text("Aux.$i.monto", array('class' => 'form-control c-monto', 'onkeyup' => 'calcula();', 'value' => $am['NomenclaturasAmbiente']['monto'], 'numero' => $i, 'id' => 'c-monto-' . $i)); ?></td>
                        <td>X</td>
                        <td><?= $this->Form->text("Aux.$i.cantidad", array('class' => 'form-control', 'onkeyup' => 'calcula();', 'value' => 12, 'numero' => $i, 'id' => 'c-cantida-' . $i)); ?></td>
                        <td><?= $this->Form->text("Aux.$i.total", array('class' => 'form-control e-total', 'onkeyup' => 'calcula();', 'numero' => $i, 'id' => 'c-total-' . $i)); ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
  var total = 0.00;
  function calcula() {
      $('#ambientes-a .c-monto').each(function (i, elemento) {
          //console.log($(elemento).attr('numero'));
          //console.log($(elemento).val()*$('#c-cantida-'+$(elemento).attr('numero')).val());
          var monto_to = $(elemento).val() * $('#c-cantida-' + $(elemento).attr('numero')).val();
          if (isNaN(monto_to)) {
              $('#c-total-' + $(elemento).attr('numero')).val(0);
          } else {
              $('#c-total-' + $(elemento).attr('numero')).val(monto_to);
          }
      });
      suma_todo();
  }
  calcula();
  function suma_todo() {
      total = 0.00;
      $('#ambientes-a .e-total').each(function (i, elemento) {
          total += parseFloat($(elemento).val());
      });
      $('#c-ingreso').val(total);
  }
  $('#c-porcentaje').keyup(function () {
      calc_presupuesto();
  });
  $('#c-ingreso').keyup(function () {
      calc_presupuesto();
  });
  function calc_presupuesto() {
      if ($('#c-ingreso').val() != '') {
          ingreso = parseFloat($('#c-ingreso').val());
      } else {
          ingreso = 0.00;
      }
      if ($('#c-porcentaje').val() != '') {
          porcentaje = parseFloat($('#c-porcentaje').val());
      } else {
          porcentaje = 0.00;
      }
      presupuesto = Math.round(porcentaje * ingreso * 100) / 100;
      $('#c-presupuesto').val(presupuesto);
  }
  calc_presupuesto();
</script>