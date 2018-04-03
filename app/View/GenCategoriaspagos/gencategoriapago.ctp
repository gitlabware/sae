<!-- Modal Header -->
<div class="modal-header">
    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h2 class="modal-title"><i class="fa fa-building"></i>Categoria de Ambiente</h2> -->
    <h2 class="modal-title" id="exampleModalLabel1"><i class="fa fa-building"></i>Categoria de Pago</h2>    
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
</div>
<?php echo $this->Form->create('GenCategoriaspago', array('action' => 'guarda_gencategoriapago')); ?>
<div class="modal-body">


     <div class="form-group">
        <label for="recipient-name" class="control-label">Nombre</label>
        <?php echo $this->Form->hidden('id'); ?>
        <?php echo $this->Form->text('nombre', array('id'=>'recipient-name','class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoria general', 'required')); ?>                    
    </div>
    <div class="form-group">
        <label for="recipient-name" class="control-label">Descripcion</label>

        <?php echo $this->Form->text('descripcion', array('id'=>'recipient-name','class' => 'form-control', 'placeholder' => 'Ingrese la descripcion')); ?>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-danger btn-primary">Guardar</button>
</div>
<?php echo $this->Form->end(); ?>
</div>
<!-- END Modal Body -->