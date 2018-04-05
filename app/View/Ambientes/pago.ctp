<!-- Modal Header -->
<div class="modal-header">
    <h2 class="modal-title"><i class="fa fa-money"></i> Pago en el ambiente <?php echo $ambiente['Ambiente']['nombre'] ?></h2>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<?php echo $this->Form->create('Ambiente', array('action' => 'guarda_pago', 'class' => 'form-horizontal form-bordered', 'id' => 'ajaxform')); ?>
<div class="modal-body">
    <?php echo $this->Form->hidden('Pago.id'); ?>
    <?php echo $this->Form->hidden('Pago.ambiente_id', array('value' => $ambiente['Ambiente']['id'])); ?>
    <?php echo $this->Form->hidden('Pago.user_id', array('value' => $this->Session->read('Auth.User.id'))); ?>
    <?php echo $this->Form->hidden('Pago.estado', array('value' => 'Debe')); ?>
    <?php echo $this->Form->hidden('Pago.propietario_id', array('value' => $ambiente['Ambiente']['user_id'])); ?>
    <div class="form-group">
        <div class="row">

            <label class="col-md-4 control-label" for="user-settings-email">Concepto</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('Pago.concepto_id', $conceptos, array('class' => 'form-control', 'required')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label class="col-md-4 control-label" for="user-settings-email">Fecha</label>
            <div class="col-md-8">
                <?php echo $this->Form->date('Pago.fecha', array('id' => 'example-datepicker', 'class' => 'form-control input-datepicker', 'required')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label class="col-md-4 control-label" for="user-settings-email">Monto</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('Pago.monto', array('class' => 'form-control', 'placeholder' => 'Ingrese el monto', 'type' => 'number', 'step' => 'any', 'min' => 0)); ?>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
  <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
</div>
<?php echo $this->Form->end(); ?>
<!-- END Modal Body -->

