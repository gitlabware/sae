<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-building"></i> Cuenta</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Cuenta', array('action' => 'guarda_cuenta', 'class' => 'form-horizontal form-bordered', 'id' => 'form-cuenta')); ?>
    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <legend>Informacion de Edificio </legend>
                <div class="form-group">
                    <label class="col-md-4 control-label">Nombre</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->hidden('id'); ?>
                        <?php echo $this->Form->hidden('edificio_id',array('value' => $this->Session->read('Auth.User.edificio_id'))); ?>
                        <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la cuenta', 'required')); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4 control-label">Descripcion</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('descripcion', array('class' => 'form-control', 'placeholder' => 'Ingrese una descripcion')); ?>
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
    <?php echo $this->Form->end(); ?>
</div>
<!-- END Modal Body -->

