<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-building"></i> Categoria de Pago</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('GenCategoriaspago', array('action' => 'guarda_gencategoriapago', 'class' => 'form-horizontal form-bordered')); ?>
    <div class="row">
        <div class="col-md-12">
            
            <fieldset>
                <legend>Informacion de Categoria </legend>
                <div class="form-group">
                    <label class="col-md-4 control-label">Nombre</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->hidden('id'); ?>
                        <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoria general', 'required')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="user-settings-email">Descripcion</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('descripcion', array('class' => 'form-control', 'placeholder' => 'Ingrese la descripcion')); ?>
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