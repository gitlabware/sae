<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-building"></i> Edificio</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Edificio', array('action' => 'guarda_edificio', 'class' => 'form-horizontal form-bordered')); ?>
    <div class="row">
        <div class="col-md-12">
            
            <fieldset>
                <legend>Informacion de Edificio </legend>
                <div class="form-group">
                    <label class="col-md-4 control-label">Nombre</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->hidden('id'); ?>
                        <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre del edificio', 'required')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="user-settings-email">Direccion</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('direccion', array('class' => 'form-control', 'placeholder' => 'Ingrese la direccion', 'required')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="user-settings-email">Telefonos</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('telefonos', array('class' => 'form-control', 'required', 'placeholder' => 'Ingrese el o los numeros de telefono')); ?>
                    </div>
                </div>
                <!-- solo cuando sea nuevo edificio -->
                <?php if (empty($this->request->data['Edificio']['id'])): ?>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="user-settings-email">Pisos</label>
                        <div class="col-md-8">
                            <?php echo $this->Form->text('pisos', array('class' => 'form-control', 'required', 'placeholder' => 'Nro de pisos', 'type' => 'number')); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </fieldset>
            <fieldset>
                <legend>Informacion de ambientes por defecto</legend>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="user-settings-email">Nro ambientes x piso</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('ambientes', array('class' => 'form-control', 'required', 'placeholder' => 'Ambientes por piso', 'type' => 'number')); ?>
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
                        <?php echo $this->Form->select('categoriasambiente_id', $catambientes, array('class' => 'form-control', 'required')); ?>
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