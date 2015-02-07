<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-user"></i> Pago en el ambiente <?php echo $ambiente['Ambiente']['nombre']?></h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Ambiente',array('action' => 'guarda_pago','class' => 'form-horizontal form-bordered','id' => 'ajaxform'));?>
        <fieldset>
            <legend>Informacion de Propietario</legend>
            <div class="form-group">
                <label class="col-md-4 control-label">Inquilino</label>
                <div class="col-md-8">
                    <?php echo $this->Form->hidden('Pago.id');?>
                    <?php echo $this->Form->hidden('Pago.ambiente_id',array('value' => $ambiente['Ambiente']['id']));?>
                    <?php echo $this->Form->hidden('Pago.user_id',array('value' => $this->Session->read('Auth.User.id')));?>
                    <?php echo $this->Form->select('Pago.propietario_id', $inquilinos,array('class' => 'form-control', 'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Concepto</label>
                <div class="col-md-8">
                    <?php echo $this->Form->select('Pago.concepto_id',$conceptos, array('class' => 'form-control', 'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Fecha</label>
                <div class="col-md-8">
                    <?php echo $this->Form->date('Pago.fecha', array('id' => 'example-datepicker','class' => 'form-control input-datepicker', 'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Monto</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('Pago.monto', array('class' => 'form-control','placeholder' => 'Ingrese el monto','type' => 'number','step' => 'any','min' => 0)); ?>
                </div>
            </div>
        </fieldset>
        <div class="form-group form-actions">
            <div class="col-xs-12 text-right">
                
                <button type="submit" class="btn btn-sm btn-primary">Registrar</button>
            </div>
        </div>
    <?php echo $this->Form->end();?>
</div>
<!-- END Modal Body -->

