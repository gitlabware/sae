<div class="modal-header">
    <h2 class="modal-title"><i class="fa fa-building"></i>Informacion de Edificio</h2>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>


<?php echo $this->Form->create('Edificio', array('action' => 'guarda_edificio', 'class' => 'form-horizontal form-bordered', 'id' => 'form-edificio', 'enctype' => 'multipart/form-data')); ?>
<div class="modal-body">

    
    <div class="form-group">
        <div class="row">
            <label class="col-md-4 control-label">Nombre</label>
            <div class="col-md-8">
                <?php echo $this->Form->hidden('id'); ?>
                <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre del edificio', 'required')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label class="col-md-4 control-label" for="user-settings-email">Direccion</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('direccion', array('class' => 'form-control', 'placeholder' => 'Ingrese la direccion', 'required')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label class="col-md-4 control-label" for="user-settings-email">Telefonos</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('telefonos', array('class' => 'form-control', 'required', 'placeholder' => 'Ingrese el o los numeros de telefono')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label class="col-md-4 control-label" for="user-settings-email">Imagen logo o firma</label>
            <div class="col-md-8">
                <?php echo $this->Form->file('imagen_up', array('class' => 'form-control', 'accept' => 'image/*')); ?>
            </div>
        </div>
    </div>

    <?php if (!empty($this->request->data['Edificio']['id'])): ?>
        <div class="form-group">
            <div class="row">
                <label class="col-md-4 control-label">T/C UFV</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('tc_ufv', array('class' => 'form-control', 'placeholder' => 'T/C UFV', 'type' => 'number', 'step' => 'any', 'min' => 0)); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-md-4 control-label">T/C DOLAR</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('tc_dolar', array('class' => 'form-control', 'placeholder' => 'T/C DOLAR', 'type' => 'number', 'step' => 'any', 'min' => 0)); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- solo cuando sea nuevo edificio -->
    <?php if (empty($this->request->data['Edificio']['id']) || $pisos == 0): ?>
        <div class="form-group">
            <div class="row">
                <label class="col-md-4 control-label" for="user-settings-email">Pisos</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('pisos', array('class' => 'form-control', 'placeholder' => 'Nro de pisos', 'type' => 'number')); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (empty($this->request->data['Edificio']['id'])): ?>

        <legend align="center">
            <button class="btn btn-default" type="button" onclick="$('#form-ambientes-defecto').toggle(400);">
                Informacion de ambientes por defecto
            </button>
        </legend>
        <hr>
        <div id="form-ambientes-defecto" style="display: none;">
            <div class="form-group">
                <div class="row">
                    <label class="col-md-4 control-label" for="user-settings-email">Nro ambientes x piso</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('ambientes', array('class' => 'form-control', 'placeholder' => 'Ambientes por piso', 'type' => 'number')); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-4 control-label" for="user-settings-email">Area Util</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('area_util', array('class' => 'form-control', 'placeholder' => 'Area Util', 'type' => 'number', 'step' => 'any')); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-4 control-label" for="user-settings-email">Area Comun</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('area_comun', array('class' => 'form-control', 'placeholder' => 'Area Comun', 'type' => 'number', 'step' => 'any')); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-4 control-label" for="user-settings-email">Categoria Ambiente</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->select('gcategoriasambiente_id', $catambientes, array('class' => 'form-control')); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->text('Categoriasambiente.constante', array('class' => 'form-control', 'placeholder' => 'Constante', 'type' => 'number', 'step' => 'any')); ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label class="col-md-4 control-label" for="user-settings-email">Categoria Pago</label>
                    <div class="col-md-4">
                        <?php echo $this->Form->select('gcategoriaspago_id', $catpagos, array('class' => 'form-control')); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->text('Categoriaspago.constante', array('class' => 'form-control', 'placeholder' => 'Constante', 'type' => 'number', 'step' => 'any')); ?>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <label class="col-md-4 control-label" for="user-settings-email">Retencion Alquiler</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('retencion_alquiler', array('class' => 'form-control', 'placeholder' => 'Ingrese el porcentaje de retencion', 'type' => 'number', 'step' => 'any', 'min' => 0)); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-4 control-label" for="user-settings-email">Retencion Mantenimietno</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('retencion_mantenimiento', array('class' => 'form-control', 'placeholder' => 'Ingrese el porcentaje de retencion', 'type' => 'number', 'step' => 'any', 'min' => 0)); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-4 control-label">Numero de recibo actual</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('num_recibo', array('class' => 'form-control', 'placeholder' => 'Numero de recibo actual', 'type' => 'number', 'min' => 0)); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-4 control-label">T/C UFV</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('tc_ufv', array('class' => 'form-control', 'placeholder' => 'T/C UFV', 'type' => 'number', 'step' => 'any', 'min' => 0)); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-md-4 control-label">T/C DOLAR</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('tc_dolar', array('class' => 'form-control', 'placeholder' => 'T/C DOLAR', 'type' => 'number', 'step' => 'any', 'min' => 0)); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
</div>
<?php echo $this->Form->end(); ?>
<!-- END Modal Body -->
<!--
<div class="form-group">
<div class="row">
    <label class="col-md-4 control-label" for="user-settings-email">Categoria Ambiente</label>
    <div class="col-md-8">
        <?php //echo $this->Form->select('categoriasambiente_id', $catambientes, array('class' => 'form-control')); ?>
    </div>
</div>

<div class="form-group">
<div class="row">
    <label class="col-md-4 control-label" for="user-settings-email">Categoria Pago</label>
    <div class="col-md-8">
        <?php //echo $this->Form->select('categoriaspago_id', $catpagos, array('class' => 'form-control')); ?>
    </div>
</div>
-->

