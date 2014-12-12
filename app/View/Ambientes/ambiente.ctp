<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-table"></i> Ambiente</h2>
</div>
<!-- END Modal Header -->

<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Ambiente', array('action' => 'guarda_ambiente', 'class' => 'form-horizontal form-bordered')); ?>
    <fieldset>
        <legend><?php echo "Edificio ".$piso['Edificio']['nombre']." | Piso ".$piso['Piso']['nombre']?></legend>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Nombre</label>
            <div class="col-md-8">
                <?php echo $this->Form->hidden('edificio_id',array('value' => $piso['Edificio']['id']));?>
                <?php echo $this->Form->hidden('piso_id',array('value' => $piso['Piso']['id']));?>
                <?php echo $this->Form->hidden('id');?>
                <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'required', 'placeholder' => 'Nombre del ambiente')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Area Util</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('area_util', array('class' => 'form-control', 'required', 'placeholder' => 'Area Util', 'type' => 'number', 'step' => 'any')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Area Comun</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('area_comun', array('class' => 'form-control', 'required', 'placeholder' => 'Area Comun', 'type' => 'number', 'step' => 'any')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Categoria Ambiente</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('categoriasambiente_id',$catambientes, array('class' => 'form-control', 'required')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Categoria Pago</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('categoriaspago_id',$catpagos, array('class' => 'form-control', 'required')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Usuario</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('user_id',$usuarios, array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Costo Mantenimiento</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('mantenimiento', array('class' => 'form-control', 'required','type' => 'number','step' => 'any')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Descripcion</label>
            <div class="col-md-8">
                <?php echo $this->Form->textarea('descripcion', array('class' => 'form-control', 'placeholder' => 'Descripcion')); ?>
            </div>
        </div>
    </fieldset>
    <div class="form-group form-actions">
        <div class="col-xs-12 text-right">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<!-- END Modal Body -->