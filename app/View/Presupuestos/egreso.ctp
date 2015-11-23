<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-calendar"></i> Egreso</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Presupuesto', array('action' => 'guarda_egreso', $this->request->data['Egreso']['presupuesto_id'])); ?>
    <?php echo $this->Form->hidden('Egreso.id'); ?>
    <div class="form-horizontal form-bordered">
        <div class="form-group">

            <div class="col-md-12">
                <div id="gasto-select2">
                    <label>Tipo de Egreso</label>
                    <?php echo $this->Form->select('Egreso.nomenclatura_id', $nomenclaturas, array('class' => 'select-chosen f-subgasto2', 'empty' => 'Seleccione el tipo de egreso', 'required')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label>Presupuesto anterior</label>
                <?php echo $this->Form->text('Egreso.pres_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
            <div class="col-md-6">
                <label>Ejecutado anterior</label>
                <?php echo $this->Form->text('Egreso.ejec_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <label>Presupuesto</label>
                <?php echo $this->Form->text('Egreso.presupuesto', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
            <div class="col-md-6">
                <label>Ejecutado</label>
                <?php echo $this->Form->text('Egreso.ejecutado', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
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
  $('.select-chosen').chosen({width: "100%"});
</script>
<script>
  /*
  function muestra_form_c_g2() {
      $('#gasto-select2').hide(400);
      $('#gasto-form2').show(400);
      $('.f-n-gasto2').each(function (i, val) {
          $(val).prop('required', true);
      });
      $('.f-subgasto2').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
  }
  function muestra_select_c_g2() {
      $('#gasto-select2').show(400);
      $('#gasto-form2').hide(400);
      $('.f-n-gasto2').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
      $('.f-subgasto2').each(function (i, val) {
          $(val).prop('required', true);
      });
      muestra_c_tipo_s_g2();
      muestra_c_gasto_s_g2();
  }
  function muestra_c_tipo_t_g2() {
      $('#c_tipo_s_g2').hide(400);
      $('#c_tipo_t_g2').show(400);
      $('.c-tipo-t-g2').each(function (i, val) {
          $(val).prop('required', true);
      });
      $('.c-tipo-s-g2').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
  }
  function muestra_c_tipo_s_g2() {
      $('#c_tipo_t_g2').hide(400);
      $('#c_tipo_s_g2').show(400);
      $('.c-tipo-t-g2').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
      $('.c-tipo-s-g2').each(function (i, val) {
          $(val).prop('required', true);
      });
  }
  function muestra_c_gasto_t_g2() {
      $('#c_gasto_s_g2').hide(400);
      $('#c_gasto_t_g2').show(400);
      $('.c-gasto-t-g2').each(function (i, val) {
          $(val).prop('required', true);
      });
      $('.c-gasto-s-g2').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
  }
  function muestra_c_gasto_s_g2() {
      $('#c_gasto_t_g2').hide(400);
      $('#c_gasto_s_g2').show(400);
      $('.c-gasto-t-g2').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
      $('.c-gasto-s-g2').each(function (i, val) {
          $(val).prop('required', true);
      });
  }*/
</script>