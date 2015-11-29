<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-money"></i> Egreso</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Egreso', array('class' => 'form-horizontal form-bordered', 'id' => 'ajaxform')); ?>
    <fieldset>
        <?php echo $this->Form->hidden('Cuentasegreso.id'); ?>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Detalle</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('Cuentasegreso.detalle', array('class' => 'form-control', 'required','placeholder' => 'Ingrese el detalle del egreso')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Proveedor</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('Cuentasegreso.proveedor', array('class' => 'form-control','placeholder' => 'Ingrese el Proveedor')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Tipo de Egreso</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('Cuentasegreso.nomenclatura_id', $nomenclaturas, array('class' => 'select-chosen', 'required','empty' => 'Seleccione el tipo de egreso')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Caja/Banco</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('Cuentasegreso.banco_id', $bancos, array('class' => 'form-control', 'required','empty' => 'Seleccione la Caja/Banco')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Cuenta</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('Cuentasegreso.cuenta_id', $cuentas, array('class' => 'form-control', 'required','empty' => 'Seleccione la cuenta')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Fecha</label>
            <div class="col-md-8">
                <?php echo $this->Form->date('Cuentasegreso.fecha', array( 'class' => 'form-control', 'required','value' => date('Y-m-d'))); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Importe Total</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('Cuentasegreso.monto', array('class' => 'form-control', 'required','placeholder' => 'Ingrese el monto', 'type' => 'number', 'step' => 'any', 'min' => 0)); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Doc.Respaldo</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('Cuentasegreso.referencia', array('class' => 'form-control','placeholder' => 'Ejemplo: Pago con cheque numero: 8896')); ?>
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

<script>
$('.select-chosen').chosen({width: "100%"});
</script>