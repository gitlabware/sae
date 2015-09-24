<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-calendar"></i> Gasto</h2>
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
                    <label>Gasto egreso <a href="javascript:" class="label label-primary" onclick="muestra_form_c_g2();">Nuevo</a></label>
                    <?php echo $this->Form->select('Egreso.subgasto_id', $subgastos, array('class' => 'form-control f-subgasto2', 'empty' => 'Seleccione el sub-gasto', 'required')); ?>
                </div>
                <div id="gasto-form2" style="background-color: gainsboro; display: none;">

                    <div class="form-group">
                        <div class="col-md-12">
                            <div id="c_gasto_t_g2" style="display: none;">
                                <label>Gasto <a href="javascript:" onclick="muestra_c_gasto_s_g2();" class="label label-success">Seleccionar</a> <a href="javascript:" onclick="muestra_select_c_g2();" class="label label-primary">Seleccionar sub-gasto</a></label>
                                <?php echo $this->Form->text('Egreso.nombre_gasto', array('class' => 'form-control c-gasto-t-g2', 'placeholder' => 'Ingrese el gasto')); ?>
                            </div>
                            <div id="c_gasto_s_g2">
                                <label>Tipo <a href="javascript:" onclick="muestra_c_gasto_t_g2();" class="label label-success">Nuevo</a> <a href="javascript:" onclick="muestra_select_c_g2();" class="label label-primary">Seleccionar sub-gasto</a></label>
                                <?php echo $this->Form->select('Egreso.gasto_id', $gastos, array('class' => 'form-control f-n-gasto2 c-gasto-s-g2', 'empty' => 'Seleccione el gasto')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div id="c_tipo_t_g2" style="display: none;">
                                <label>Tipo <a href="javascript:" onclick="muestra_c_tipo_s_g2();" class="label label-success">Seleccionar</a></label>
                                <?php echo $this->Form->text('Egreso.nombre_tipo', array('class' => 'form-control c-tipo-t-g2', 'placeholder' => 'Ingrese el tipo')); ?>
                            </div>
                            <div id="c_tipo_s_g2">
                                <label>Tipo <a href="javascript:" onclick="muestra_c_tipo_t_g2();" class="label label-success">Nuevo</a></label>
                                <?php echo $this->Form->select('Egreso.tipo', $gtipos, array('class' => 'form-control f-n-gasto2 c-tipo-s-g2', 'empty' => 'Seleccione el tipo')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Nombre Sub-Gasto</label>
                            <?php echo $this->Form->text('Egreso.nombre_subgasto', array('class' => 'form-control f-n-gasto2', 'placeholder' => 'Ingrese nombre del subgasto')); ?>
                        </div>
                    </div>
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
            <div class="col-md-12">
                <label>Presupuesto</label>
                <?php echo $this->Form->text('Egreso.presupuesto', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
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
  }
</script>