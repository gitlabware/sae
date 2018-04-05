<div class="modal-header">
    <h2 class="modal-title"><i class="fa fa-exchange"></i>Movimiento Bancos</h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
    </button>
</div>

<?php echo $this->Form->create('Banco', array('class' => 'form-horizontal ', 'id' => 'ajaxform')); ?>
<div class="modal-body">
    <?php echo $this->Form->hidden('Bancosmovimiento.id'); ?>
    <div class="form-group">
        <label class="col-md-4 control-label" for="user-settings-email">De Caja/Banco</label>
        
        <?php echo $this->Form->select('Bancosmovimiento.desdebanco_id', $bancos, array('class' => 'form-control', 'required','empty' => 'Seleccione la Caja/Banco')); ?>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" for="user-settings-email">Desde Cuenta</label>
        
        <?php echo $this->Form->select('Bancosmovimiento.desdecuenta_id', $cuentas, array('class' => 'form-control', 'required','empty' => 'Seleccione la Cuenta')); ?>
        
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" for="user-settings-email">A Caja/Banco</label>
        
        <?php echo $this->Form->select('Bancosmovimiento.hastabanco_id', $bancos, array('class' => 'form-control', 'required','empty' => 'Seleccione la Caja/Banco')); ?>
        
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" for="user-settings-email">Hasta Cuenta</label>
        
        <?php echo $this->Form->select('Bancosmovimiento.hastacuenta_id', $cuentas, array('class' => 'form-control', 'required','empty' => 'Seleccione la Cuenta')); ?>
        
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" for="user-settings-email">Importe</label>
        
        <?php echo $this->Form->text('Bancosmovimiento.monto', array('class' => 'form-control', 'required','placeholder' => 'Ingrese el monto', 'type' => 'number', 'step' => 'any', 'min' => 0)); ?>
        
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" for="user-settings-email">Fecha</label>
        
        <?php echo $this->Form->date('Bancosmovimiento.fecha', array( 'class' => 'form-control', 'required','value' => date('Y-m-d'))); ?>
        
    </div>
    <div class="form-group">
        <label class="col-md-10 control-label" for="user-settings-email">Nota(Eje: Nro. Cheque)</label>
        
        <?php echo $this->Form->textarea('Bancosmovimiento.nota', array('class' => 'form-control', 'required','placeholder' => 'Ejemplo: Pago con cheque numero: 5563')); ?>
        
    </div>
</div>
<div class="form-group modal-footer"> 
    <button type="submit" class="btn btn-danger waves-effect waves-light">Registrar</button>
</div>
<?php echo $this->Form->end(); ?>

