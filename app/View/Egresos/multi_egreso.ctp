<style>
    .has-warning .chosen-container-single .chosen-single{
        border: 1px solid #e67e22;
    }
</style>
<!-- Example Block -->
<div class="row">
    <div class="col-sm-12">
        <!-- Example Form Block -->
        <div class="block">
            <!-- Example Form Title -->
            <div class="block-title">
                <h2>Formulario de Gastos</h2>
            </div>
            <!-- END Example Form Title -->

            <!-- Example Form Content -->
            <?php echo $this->Form->create('Egreso', array('class' => 'form-bordered')); ?>
            <div class="form-group has-success">
                <div class="input-group">
                    <span class="input-group-addon">Proveedor</span>
                    <?php echo $this->Form->text('Cuentasegreso.proveedor', array('class' => 'form-control', 'placeholder' => 'Ingrese el Proveedor')); ?>
                </div>
            </div>
            <div class="form-group has-success">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">Caja/Banco</span>
                            <?php echo $this->Form->select('Cuentasegreso.banco_id', $bancos, array('class' => 'form-control', 'required', 'empty' => 'Seleccione la Caja/Banco')); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">Cuenta</span>
                            <?php echo $this->Form->select('Cuentasegreso.cuenta_id', $cuentas, array('class' => 'form-control', 'required', 'empty' => 'Seleccione la cuenta')); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group has-success" id="detalles-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">Fecha</span>
                            <?php echo $this->Form->date('Cuentasegreso.fecha', array('class' => 'form-control', 'required', 'value' => date('Y-m-d'))); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">Doc.Respaldo</span>
                            <?php echo $this->Form->text('Cuentasegreso.referencia', array('class' => 'form-control', 'placeholder' => 'Ejemplo: Pago con cheque numero: 8896')); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group form-actions">
                <button type="button" class="btn btn-sm btn-success" onclick="adiciona();"><i class="fa fa-plus"></i> Adicionar detalle de gasto</button> 
                <button type="button" class="btn btn-sm btn-danger" onclick="quita();"><i class="fa fa-minus"></i> Quitar detalle de gasto</button>
            </div>
            <div class="form-group form-actions">
                <button type="submit" class="btn btn-sm btn-info btn-block"><i class="fa fa-check"></i> Register</button>
            </div>
            <?php echo $this->Form->end(); ?>
            <!-- END Example Form Content -->
        </div>
        <!-- END Example Form Block -->
    </div>
</div>

<div style="display: none;" id="detalles-div">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon">Nomenclatura</span>
                <?php echo $this->Form->select("Cuentasegresos.nomenclatura_id", $nomenclaturas, array('class' => '', 'required', 'empty' => 'Seleccione el tipo de egreso', 'nombre' => 'nomenclatura_id')); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon">Detalle</span>
                <?php echo $this->Form->text("Cuentasegresos.detalle", array('class' => 'form-control', 'required', 'placeholder' => 'Ingrese el detalle del egreso', 'nombre' => 'detalle')); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon">Importe Total</span>
                <?php echo $this->Form->text("Cuentasegresos.monto", array('class' => 'form-control', 'required', 'placeholder' => 'Ingrese el monto', 'type' => 'number', 'step' => 'any', 'min' => 0, 'nombre' => 'monto')); ?>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->script(array('scriptegresos'), array('block' => 'addscript')); ?>