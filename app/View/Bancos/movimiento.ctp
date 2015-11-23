<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-exchange"></i> Movimiento Bancos</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Banco', array('class' => 'form-horizontal form-bordered', 'id' => 'ajaxform')); ?>
    <fieldset>
        <?php echo $this->Form->hidden('Bancosmovimiento.id'); ?>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Monto</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('Bancosmovimiento.monto', array('class' => 'form-control', 'required','placeholder' => 'Ingrese el monto', 'type' => 'number', 'step' => 'any', 'min' => 0)); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">De Caja/Banco</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('Bancosmovimiento.desdebanco_id', $bancos, array('class' => 'form-control', 'required','empty' => 'Seleccione la Caja/Banco')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">A Caja/Banco</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('Bancosmovimiento.hastabanco_id', $bancos, array('class' => 'form-control', 'required','empty' => 'Seleccione la Caja/Banco')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Fecha</label>
            <div class="col-md-8">
                <?php echo $this->Form->date('Bancosmovimiento.fecha', array( 'class' => 'form-control', 'required','value' => date('Y-m-d'))); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Concepto/Observacion</label>
            <div class="col-md-8">
                <?php echo $this->Form->textarea('Bancosmovimiento.concepto', array('class' => 'form-control', 'required','placeholder' => 'Ingrese el Concepto u Observacion')); ?>
            </div>
        </div>
    </fieldset>
    <div class="form-group form-actions">
        <div class="col-xs-12 text-right">
            <button type="submit" class="btn btn-sm btn-primary">Registrar</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<!-- END Modal Body -->

