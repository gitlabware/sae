<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-tasks"></i> Opciones</h2>
</div>
<!-- END Modal Header -->

<!-- Modal Body -->
<div class="modal-body">
    <div id="idmensaje">

    </div>
    <fieldset>
        <?php echo $this->Form->create('Comprobante', array('action' => 'unir_comprobante')); ?>
        <?php echo $this->Form->hidden('Aux.id', array('value' => $comprobante_u['Comprobantescuenta']['id'])); ?>
        <?php echo $this->Form->hidden('Aux.comprobante_id', array('value' => $comprobante_u['Comprobantescuenta']['comprobante_id'])); ?>
        <?php echo $this->Form->hidden('Aux.comprobante_aux', array('value' => $comprobante_u['Comprobantescuenta']['comprobante_aux'])); ?>
        <div class="row form-group">
            <label class="col-md-4 control-label">Unir al comprobante:</label>
            <div class="col-md-4">
                <?php echo $this->Form->select('Aux.comprobante_cambio', $comprobantes, array('class' => 'form-control', 'empty' => 'Comprobante ID', 'id' => 'a-comprobantes', 'required')); ?>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-success col-md-12" onclick="$('#f-comprobantes').submit();">Unir</button>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
        <br>
        <?php if (!empty($comprobante_u['Comprobantescuenta']['comprobante_aux'])): ?>
          <?php echo $this->Form->create('Comprobante', array('action' => 'devolver_comprobante')); ?>
          <?php echo $this->Form->hidden('Aux.id', array('value' => $comprobante_u['Comprobantescuenta']['id'])); ?>
          <?php echo $this->Form->hidden('Aux.comprobante_id', array('value' => $comprobante_u['Comprobantescuenta']['comprobante_id'])); ?>
          <?php echo $this->Form->hidden('Aux.comprobante_aux', array('value' => $comprobante_u['Comprobantescuenta']['comprobante_aux'])); ?>
          <div class="row form-group">
              <label class="col-md-4 control-label">VOLVER A ID: <?php echo $comprobante_u['Comprobantescuenta']['comprobante_aux'] ?></label>
              <div class="col-md-8">
                  <button type="submit" class="btn btn-warning col-md-12" >Devolver</button>
              </div>
          </div>
          <?php echo $this->Form->end(); ?>
        <?php endif; ?>
        <?php echo $this->Form->create('Comprobante', array('action' => 'eliminar_comprobante')); ?>
        <?php echo $this->Form->hidden('Aux.id', array('value' => $comprobante_u['Comprobantescuenta']['id'])); ?>
        <?php echo $this->Form->hidden('Aux.comprobante_id', array('value' => $comprobante_u['Comprobantescuenta']['comprobante_id'])); ?>
        <?php echo $this->Form->hidden('Aux.comprobante_aux', array('value' => $comprobante_u['Comprobantescuenta']['comprobante_aux'])); ?>
        <div class="row form-group">
            <label class="col-md-4 control-label">ELIMINAR: </label>
            <div class="col-md-8">
                <button type="submit" class="btn btn-danger col-md-12" >Eliminar</button>
                <?php //echo $this->Html->link("Eliminar", array('action' => 'eliminar_u', $comprobante_u['Comprobantescuenta']['id']), array('class' => 'btn btn-danger col-md-12', 'confirm' => 'Esta seguro de eliminar del comprobante??')) ?>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </fieldset>
    <br>
    <div class="form-group form-actions">
        <div class="col-xs-12 text-right">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    </div>

</div>

<script>
  $('#a-comprobantes').change(function () {
      $('#s-comprobante-id').val($('#a-comprobantes').val());
  });
</script>

