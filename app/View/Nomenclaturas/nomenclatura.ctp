<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-building"></i> Categoria/Subcategoria</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Nomenclatura', array('action' => 'registra', 'class' => 'form-horizontal form-bordered', 'id' => 'form-edificio', 'enctype' => 'multipart/form-data')); ?>

    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <div class="form-group">
                    <label class="col-md-4 control-label">Nombre</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->hidden('id'); ?>
                        <?php echo $this->Form->hidden('nomenclatura_id'); ?>
                        <?php echo $this->Form->hidden('edificio_id'); ?>
                        <?php echo $this->Form->hidden('codigo_aux', array('value' => $codigo_padre)); ?>
                        <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el codigo de cuenta ', 'required')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" title="Codigo Padre" onclick="codigopadre();">
                        <?php
                        $val_cod = '';
                        if (!empty($codigo_padre)) {
                            $val_cod = $codigo_padre;
                            echo "Codigo $codigo_padre.";
                        } else {
                            echo "Codigo";
                        }
                        ?>
                    </label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('codigo', array('class' => 'form-control', 'placeholder' => 'Ingrese el codigo', 'required')); ?>
                    </div>
                </div>
                <div class="form-group" id="div-subconcepto">
                    <label class="col-md-4 control-label" for="user-settings-email">Sub-concepto</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->select('subconcepto_id', $subconceptos, array('class' => 'select-chosen', 'empty' => 'Ninguno')); ?>
                    </div>
                </div>
                <div class="form-group" id="div-cod-padre" style="display: none;">
                    <label class="col-md-4 control-label">Codigo Padre</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('codigo_padre', array('class' => 'form-control', 'placeholder' => 'Codigo del padre','id' => 'text-cod-pad','value' => $val_cod)); ?>
                    </div>
                </div>
                <br><br><br><br><br><br><br><br>
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


<script>
    $('.select-chosen').chosen({width: "100%"});

    function codigopadre(){
        $('#div-cod-padre').show(400);
        $('#text-cod-pad').attr('required',true);
    }
</script>