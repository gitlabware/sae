
<div class="block">
    <h3 class="text-center">EDIFICIO <?php echo strtoupper($presupuesto['Edificio']['nombre']); ?></h3>
    <h2 class="text-center">PLAN ANUAL OPERATIVO</h2>
    <h2 class="text-center text-success page-header">INGRESOS</h2>
    <div class="form-horizontal form-bordered">
        <?php echo $this->Form->create('Presupuesto', array('action' => 'guarda_ingreso', $presupuesto['Presupuesto']['id'])); ?>
        <?php echo $this->Form->hidden('Ingreso.presupuesto_id',array('value' => $presupuesto['Presupuesto']['id'])); ?>
        <div class="form-group">

            <div class="col-md-3">
                <div id="concepto-select">
                    <label>Concepto ingreso <a href="javascript:" class="label label-primary" onclick="muestra_form_c();">Nuevo</a></label>
                    <?php echo $this->Form->select('Ingreso.subconcepto_id', $subconceptos, array('class' => 'form-control f-subconcepto', 'empty' => 'Seleccione el sub-concepto', 'required')); ?>
                </div>
                <div id="concepto-form" style="background-color: gainsboro; display: none;">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Concepto <a href="javascript:" onclick="muestra_select_c();" class="label label-primary">Seleccionar</a></label>
                            <?php echo $this->Form->select('Ingreso.concepto_id', $conceptos, array('class' => 'form-control f-n-concepto', 'empty' => 'Seleccione el sub-concepto')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Nombre Sub-Concepto</label>
                            <?php echo $this->Form->text('Ingreso.nombre_subconcepto', array('class' => 'form-control f-n-concepto', 'placeholder' => 'Ingrese nombre del subconcepto')); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <label>%</label>
                <?php echo $this->Form->text('Ingreso.porcentaje', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'max' => 1, 'placeholder' => '0.00')); ?>
            </div>
            <div class="col-md-2">
                <label>Ingreso anual</label>
                <?php echo $this->Form->text('Ingreso.ingreso', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
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
                <?php echo $this->Form->text('Ingreso.presupuesto', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
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
                    <th>Detalle Ingresos</th>
                    <th>%</th>
                    <th>Ingreso Anual</th>
                    <th>Presupuesto Anterior</th>
                    <th>Ejecutado Anterior</th>
                    <th>Presupuesto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ingresos as $in): ?>
                  <tr>
                      <td>
                          <?php
                          if (!empty($in['Subconcepto']['nombre'])) {
                            echo $in['Subconcepto']['nombre'];
                          } else {
                            echo $in['Concepto']['nombre'];
                          }
                          ?>
                      </td>
                      <td><?php echo $in['Ingreso']['porcentaje'] ?></td>
                      <td><?php echo $in['Ingreso']['ingreso'] ?></td>
                      <td><?php echo $in['Ingreso']['pres_anterior'] ?></td>
                      <td><?php echo $in['Ingreso']['ejec_anterior'] ?></td>
                      <td><?php echo $in['Ingreso']['presupuesto'] ?></td>
                  </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
  function muestra_form_c() {
      $('#concepto-select').toggle(400);
      $('#concepto-form').toggle(400);
      $('.f-n-concepto').each(function (i, val) {
          $(val).prop('required', true);
      });
      $('.f-subconcepto').each(function (i, val) {
          $(val).prop('required', false);
      });
  }
  function muestra_select_c() {
      $('#concepto-select').toggle(400);
      $('#concepto-form').toggle(400);
      $('.f-n-concepto').each(function (i, val) {
          $(val).prop('required', false);
      });
      $('.f-subconcepto').each(function (i, val) {
          $(val).prop('required', true);
      });
  }
</script>