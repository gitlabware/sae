<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-building"></i> Banco/caja</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Banco', array('action' => 'registra', 'class' => 'form-horizontal form-bordered', 'id' => 'form-edificio', 'enctype' => 'multipart/form-data'));?>

    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <div class="form-group">
                    <label class="col-md-4 control-label">Codigo</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->hidden('id');?>
                        <?php echo $this->Form->text('codigo_cuenta', array('class' => 'form-control', 'placeholder' => 'Ingrese el codigo de cuenta '));?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="user-settings-email">Nombre</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre', 'required'));?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="user-settings-email">Numero de cuenta</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('numero_cuenta', array('class' => 'form-control', 'placeholder' => 'Ingrese el numero de cuenta'));?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="user-settings-email">Fondo</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->select('cuenta_id',$cuentas, array('class' => 'form-control', 'empty' => 'Seleccione Fondo'));?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="user-settings-email">Monto</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('monto', array('class' => 'form-control', 'placeholder' => 'Monto en caja/banco','step' => 'any','type' => 'number'));?>
                    </div>
                </div>
            </fieldset>
            
        </div>
    </div>
    <div class="form-group form-actions">
        <div class="col-xs-12 text-right">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
        </div>
    </div>
    <?php echo $this->Form->end();?>
</div>
<!-- END Modal Body -->

