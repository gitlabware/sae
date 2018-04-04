<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-building"></i>Nuevo piso</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>


<?php echo $this->Form->create('Edificio', array('action' => 'piso', 'class' => 'form-horizontal form-bordered', 'id' => 'form-edificio', 'enctype' => 'multipart/form-data')); ?>

<div class="modal-body">


    <div class="form-group">
        <div class="row">
            <label class="col-md-4 control-label">Nombre del Piso</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('Piso.nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre del piso', 'required')); ?>
            </div>
        </div>
    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
</div>
<?php echo $this->Form->end(); ?>

