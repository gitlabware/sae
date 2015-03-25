<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-table"></i> Ambiente</h2>
</div>
<!-- END Modal Header -->

<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Ambiente', array('action' => 'guarda_ambiente', 'class' => 'form-horizontal form-bordered', 'id' => 'formambiente')); ?>

    <fieldset>
        <legend><?php echo "Edificio " . $piso['Edificio']['nombre'] . " | Piso " . $piso['Piso']['nombre'] ?></legend>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Nombre</label>
            <div class="col-md-8">
                <?php echo $this->Form->hidden('edificio_id', array('value' => $piso['Edificio']['id'])); ?>
                <?php echo $this->Form->hidden('piso_id', array('value' => $piso['Piso']['id'])); ?>
                <?php echo $this->Form->hidden('id'); ?>
                <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'required', 'placeholder' => 'Nombre del ambiente')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Area Util</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('area_util', array('class' => 'form-control', 'required', 'placeholder' => 'Area Util', 'type' => 'number', 'step' => 'any', 'id' => 'idareautil')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Area Comun</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('area_comun', array('class' => 'form-control', 'required', 'placeholder' => 'Area Comun', 'type' => 'number', 'step' => 'any', 'id' => 'idareacomun')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Categoria Ambiente</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('categoriasambiente_id', $catambientes, array('class' => 'form-control', 'required', 'id' => 'idcatambientes')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Categoria Pago</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('categoriaspago_id', $catpagos, array('class' => 'form-control', 'required', 'id' => 'idcatpagos')); ?>
            </div>
        </div>
        <div class="form-group">
            <div id="selectpropietario">
                <label class="col-md-4 control-label" for="user-settings-email"><a href="javascript:" title="Nuevo Propietario" onclick="cargarmodal_amb('<?php echo $this->Html->url(array('controller' => 'Ambientes', 'action' => 'usuario',$idPiso)); ?>')">Propietario</a></label>
                <div class="col-md-8">
                    <?php echo $this->Form->select('user_id', $usuarios, array('class' => 'form-control')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="user-settings-email">Fecha de Ocupacion</label>
            <div class="col-md-8">
                <?php echo $this->Form->date('fecha_ocupacion', array('class' => 'form-control', 'placeholder' => 'ejemplo: 2014-12-01')); ?>
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
            <?php if(!empty($idAmbiente)):?>
            <button type="button" class="btn btn-sm btn-info" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Conceptos','action' => 'aservicios',$idAmbiente,$piso['Edificio']['id']))?>');">Servicios</button>
            <button type="button" class="btn btn-sm btn-warning" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'inquilinos',$idAmbiente))?>');">Inquilinos</button>
            <button type="button" class="btn btn-sm btn-success" onclick="window.location = ('<?php echo $this->Html->url(array('action' => 'pagos',$idAmbiente))?>');">Pagos</button>
            
            <?php endif;?>
            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<!-- END Modal Body -->

<script>
    var cateambientes = [];
<?php foreach ($categoria_ambientes as $cat): ?>
        cateambientes[parseInt('<?php echo $cat['Categoriasambiente']['id']; ?>')] = <?php echo $cat['Categoriasambiente']['constante']; ?>;
<?php endforeach; ?>
    var catepagos = [];
<?php foreach ($categoria_pagos as $cate): ?>
        catepagos[parseInt('<?php echo $cate['Categoriaspago']['id']; ?>')] = <?php echo $cate['Categoriaspago']['constante']; ?>;
<?php endforeach; ?>

    $("#idareautil").change(function () {
        calcula_mantenimiento();
    });
    $("#idareacomun").change(function () {
        calcula_mantenimiento();
    });
    $("#idcatambientes").change(function () {
        calcula_mantenimiento();
    });
    $("#idcatpagos").change(function () {
        calcula_mantenimiento();
    });

    function calcula_mantenimiento()
    {
        totalmt = (parseFloat($("#idareautil").val()) + parseFloat($("#idareacomun").val())).toFixed(2);
        costob = (totalmt * cateambientes[parseInt($("#idcatambientes").val())]).toFixed(2);
        mantenimiento = (parseFloat(costob) + parseFloat(catepagos[parseInt($("#idcatpagos").val())])).toFixed(2);
        $("#idambiente").val(mantenimiento);
    }
</script>
<?php if (empty($idAmbiente) && !$sw): ?>
    <script>
        calcula_mantenimiento();
    </script>
<?php endif; ?>
<script>
    function cargarmodal_amb(urle)
    {
        var postData = $("#formambiente").serializeArray();
        var formURL = "<?php echo $this->Html->url(array('action' => 'rescata_datos')); ?>";
        $.ajax(
                {
                    url: formURL,
                    type: "POST",
                    data: postData,
                    /*beforeSend:function (XMLHttpRequest) {
                     alert("antes de enviar");
                     },*/
                    complete: function (XMLHttpRequest, textStatus) {
                        cargarmodal(urle);
                    },
                    success: function (data, textStatus, jqXHR)
                    {
                        //data: return data from server
                        //$("#selectpropietario").html(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        //if fails   
                        alert("error");
                    }
                });
    }
</script>