<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-building"></i> Nuevo piso</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Edificio', array('action' => 'piso', 'class' => 'form-horizontal form-bordered', 'id' => 'form-edificio', 'enctype' => 'multipart/form-data')); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="col-md-4 control-label">Nombre del Piso</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('Piso.nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre del piso', 'required')); ?>
                </div>
            </div>
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

