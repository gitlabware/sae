<!-- Modal Header -->
<div class="modal-header">
    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h2 class="modal-title"><i class="fa fa-building"></i>Categoria de Ambiente</h2> -->

    <h2 class="modal-title"><i class="fa fa-building"></i>Categoria de Ambiente</h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
    </button>
</div>
<?php echo $this->Form->create('GenCategoriasambiente', array('action' => 'guarda_gencategoria')); ?>
<div class="modal-body">


    <div class="form-group">
        <label class="col-md-4 control-label">Nombre</label>
        <?php echo $this->Form->hidden('id'); ?>
        <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoria general', 'required')); ?>

    </div>
    <div class="form-group">

        <label class="col-md-4 control-label">Descripcion</label>

        <?php echo $this->Form->text('descripcion', array('class' => 'form-control', 'placeholder' => 'Ingrese la descripcion')); ?>


    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
</div>
<?php echo $this->Form->end(); ?>

<!-- END Modal Body -->