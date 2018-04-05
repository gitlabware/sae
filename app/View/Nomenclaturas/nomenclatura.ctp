<link href="<?php echo $this->webroot; ?>template/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- Modal Header -->
<div class="modal-header">
    <h2 class="modal-title"><i class="fa fa-building"></i> Categoria/Subcategoria</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<?php echo $this->Form->create('Nomenclatura', array('action' => 'registra', 'class' => 'form-horizontal form-bordered', 'id' => 'form-edificio', 'enctype' => 'multipart/form-data')); ?>
<div class="modal-body">

    <div class="row">
        <div class="col-md-12">

            <div class="form-group">
                <div class="row">

                    <label class="col-md-4 control-label">Nombre</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->hidden('id'); ?>
                        <?php echo $this->Form->hidden('nomenclatura_id'); ?>
                        <?php echo $this->Form->hidden('edificio_id'); ?>
                        <?php echo $this->Form->hidden('codigo_aux', array('value' => $codigo_padre)); ?>
                        <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el codigo de cuenta ', 'required')); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">

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
            </div>
            <div class="form-group" id="div-subconcepto">
                <div class="row">

                    <label class="col-md-4 control-label" for="user-settings-email">Sub-concepto</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->select('subconcepto_id', $subconceptos, array('class' => 'select2', 'empty' => 'Ninguno','style' => 'width: 100%;')); ?>
                    </div>
                </div>
            </div>
            <div class="form-group" id="div-cod-padre" style="display: none;">
                <div class="row">

                    <label class="col-md-4 control-label">Codigo Padre</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('codigo_padre', array('class' => 'form-control', 'placeholder' => 'Codigo del padre','id' => 'text-cod-pad','value' => $val_cod)); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
</div>
<?php echo $this->Form->end(); ?>
<!-- END Modal Body -->
<script src="<?php echo $this->webroot; ?>template/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

<script>
    $('.select2').select2();

    function codigopadre(){
        $('#div-cod-padre').show(400);
        $('#text-cod-pad').attr('required',true);
    }
</script>