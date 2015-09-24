<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-calendar"></i> Ingreso</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Presupuesto', array('action' => 'guarda_ingreso', $this->request->data['Ingreso']['presupuesto_id'])); ?>
    <?php echo $this->Form->hidden('Ingreso.id'); ?>
    <div class="form-horizontal form-bordered">
        <div class="form-group">

            <div class="col-md-12">
                <div id="concepto-select2">
                    <label>Concepto ingreso <a href="javascript:" class="label label-primary" onclick="muestra_form_c2();">Nuevo</a></label>
                    <?php echo $this->Form->select('Ingreso.subconcepto_id', $subconceptos, array('class' => 'form-control f-subconcepto2', 'empty' => 'Seleccione el sub-concepto', 'required')); ?>
                </div>
                <div id="concepto-form2" style="background-color: gainsboro; display: none;">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Concepto <a href="javascript:" onclick="muestra_select_c2();" class="label label-primary">Seleccionar</a></label>
                            <?php echo $this->Form->select('Ingreso.concepto_id', $conceptos, array('class' => 'form-control f-n-concepto2', 'empty' => 'Seleccione el sub-concepto')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div id="c_tipo_t2" style="display: none;">
                                <label>Tipo <a href="javascript:" onclick="muestra_c_tipo_s2();" class="label label-success">Seleccionar</a></label>
                                <?php echo $this->Form->text('Ingreso.nombre_tipo', array('class' => 'form-control c-tipo-t2', 'placeholder' => 'Ingrese el tipo')); ?>
                            </div>
                            <div id="c_tipo_s2">
                                <label>Tipo <a href="javascript:" onclick="muestra_c_tipo_t2();" class="label label-success">Nuevo</a></label>
                                <?php echo $this->Form->select('Ingreso.tipo', $tipos, array('class' => 'form-control f-n-concepto2 c-tipo-s2', 'empty' => 'Seleccione el tipo')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Nombre Sub-Concepto</label>
                            <?php echo $this->Form->text('Ingreso.nombre_subconcepto', array('class' => 'form-control f-n-concepto2', 'placeholder' => 'Ingrese nombre del subconcepto')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label>%</label>
                <?php echo $this->Form->text('Ingreso.porcentaje', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'max' => 1, 'placeholder' => '0.00', 'id' => 'c-porcentaje2')); ?>
            </div>
            <div class="col-md-6">
                <label>Ingreso anual</label>
                <?php echo $this->Form->text('Ingreso.ingreso', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00', 'id' => 'c-ingreso2')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label>Presupuesto anterior</label>
                <?php echo $this->Form->text('Ingreso.pres_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
            <div class="col-md-6">
                <label>Ejecutado anterior</label>
                <?php echo $this->Form->text('Ingreso.ejec_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label>Presupuesto</label>
                <?php echo $this->Form->text('Ingreso.presupuesto', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00', 'id' => 'c-presupuesto2')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <button class="btn btn-alt btn-primary col-md-12" type="submit">REGISTRAR</button>
            </div>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>
</div>
<!-- END Modal Body -->
<script>
  function muestra_form_c2() {
      $('#concepto-select2').toggle(400);
      $('#concepto-form2').toggle(400);
      $('.f-n-concepto2').each(function (i, val) {
          $(val).prop('required', true);
      });
      $('.f-subconcepto2').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
  }
  function muestra_select_c2() {
      $('#concepto-select2').toggle(400);
      $('#concepto-form2').toggle(400);
      $('.f-n-concepto2').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
      $('.f-subconcepto2').each(function (i, val) {
          $(val).prop('required', true);
      });
  }
  function muestra_c_tipo_t2() {
      $('#c_tipo_s2').toggle(400);
      $('#c_tipo_t2').toggle(400);
      $('.c-tipo-t2').each(function (i, val) {
          $(val).prop('required', true);
      });
      $('.c-tipo-s2').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
  }
  function muestra_c_tipo_s2() {
      $('#c_tipo_t2').toggle(400);
      $('#c_tipo_s2').toggle(400);
      $('.c-tipo-t2').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
      $('.c-tipo-s2').each(function (i, val) {
          $(val).prop('required', true);
      });
  }
  var porcentaje2 = 0.00;
  var ingreso2 = 0.00;
  var presupuesto2 = 0.00;
<?php if (!empty($this->request->data['Ingreso']['porcentaje'])): ?>
    porcentaje2 = <?php echo $this->request->data['Ingreso']['porcentaje'] ?>;
<?php endif; ?>
<?php if (!empty($this->request->data['Ingreso']['ingreso'])): ?>
    ingreso2 = <?php echo $this->request->data['Ingreso']['ingreso'] ?>;
<?php endif; ?>
<?php if (!empty($this->request->data['Ingreso']['presupuesto'])): ?>
    presupuesto2 = <?php echo $this->request->data['Ingreso']['presupuesto'] ?>;
<?php endif; ?>
  $('#c-porcentaje2').keyup(function () {
      if ($('#c-porcentaje2').val() != '') {
          porcentaje2 = parseFloat($('#c-porcentaje2').val());
      } else {
          porcentaje2 = 0.00;
      }
      presupuesto2 = Math.round(porcentaje2 * ingreso2 * 100) / 100;
      $('#c-presupuesto2').val(presupuesto2);
  });
  $('#c-ingreso2').keyup(function () {
      if ($('#c-ingreso2').val() != '') {
          ingreso2 = parseFloat($('#c-ingreso2').val());
      } else {
          ingreso2 = 0.00;
      }
      presupuesto2 = Math.round(porcentaje2 * ingreso2 * 100) / 100;
      $('#c-presupuesto2').val(presupuesto2);
  });
</script>