<!-- Modal Header -->
<div class="modal-header">
    <h2 class="modal-title"><i class="fa fa-briefcase"></i> Servicios</h2>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Concepto', array('action' => 'guarda_servicio_a', 'class' => 'form-horizontal form-bordered','id' => 'ajaxformservicio')); ?>

    <div class="form-group">
        <div class="row">

            <div class="col-md-6" onclick="$('#divformservicio').toggle(400);" title="Nuevo Concepto"><b>Concepto</b></div>
            <div class="col-md-4"><b>Monto</b></div>
            <div class="col-md-2"></div>
            <div class="col-md-6">
                <?php echo $this->Form->hidden('Ambienteconcepto.ambiente_id' ,array('value' => $idAmbiente))?>
                <?php echo $this->Form->select('Ambienteconcepto.concepto_id',$conceptos, array('class' => 'form-control', 'required')); ?>
            </div>
            <div class="col-md-4">
                <?php echo $this->Form->text('Ambienteconcepto.monto',array('class' => 'form-control','placeholder' => 'monto','required','type' => 'number','step' => 'any','min' => 0));?>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success" type="submit">ADD</button>
            </div>
        </div>
    </div>

    <?php echo $this->Form->end();?>
    <div id="divformservicio" style="display: none;">
        <?php echo $this->Form->create('Concepto', array('action' => 'guarda_nuevo_servicio_a', 'class' => 'form-horizontal form-bordered', 'id' => 'ajaxform')); ?>
        
        <legend>Nuevo concepto de pago</legend>
        <div class="form-group">
            <div class="row">

                <label class="col-md-4 control-label">Nombre</label>
                <div class="col-md-8">
                    <?php echo $this->Form->hidden('Ambienteconcepto.ambiente_id' ,array('value' => $idAmbiente))?>
                    <?php echo $this->Form->hidden('Concepto.edificio_id' ,array('value' => $idEdificio))?>
                    <?php echo $this->Form->text('Concepto.nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de Propietario', 'required')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">

                <label class="col-md-4 control-label" for="user-settings-email">Descripcion</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('Concepto.descripcion', array('class' => 'form-control', 'placeholder' => 'Descripcion')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">

                <label class="col-md-4 control-label" for="user-settings-email">Monto</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('Ambienteconcepto.monto', array('class' => 'form-control', 'placeholder' => 'Ingrese el monto','required','type' => 'number','step' => 'any','min' => 0)); ?>
                </div>
            </div>
        </div>
        
        <div class="form-group form-actions">
            <div class="col-xs-12 text-right">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="general-table" class="table table-striped table-vcenter table-hover">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Monto</th>
                            <th>Quitar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($servicios as $ser):?>
                            <tr>
                                <td><?php echo $ser['Concepto']['nombre']?></td>
                                <td><?php echo $ser['Ambienteconcepto']['monto']?></td>
                                <td><a title="Quitar Servicio" href="javascript:" class="label label-danger" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'quita_servicio_a',$ser['Ambienteconcepto']['id'],$idAmbiente,$idEdificio))?>');">Quitar</a></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-default waves-effect waves-light" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Ambientes','action' => 'ambiente', $idPiso, $idAmbiente)) ?>',true);">Ambiente</button>
</div>
<!-- END Modal Body -->
<script>
  $("#ajaxform").submit(function(e)
  {
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        /*beforeSend:function (XMLHttpRequest) {
            alert("antes de enviar");
        },
        complete:function (XMLHttpRequest, textStatus) {
            alert('despues de enviar');
        },*/
        success:function(data, textStatus, jqXHR) 
        {
            direccion = '<?php echo $this->Html->url(array('action' => 'aservicios',$idAmbiente,$idEdificio))?>';
            cargarmodal(direccion);
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if fails   
            alert("error");
        }
    });
    e.preventDefault(); //STOP default action
    //e.unbind(); //unbind. to stop multiple form submit.
});
</script>

<script>
  $("#ajaxformservicio").submit(function(e)
  {
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        /*beforeSend:function (XMLHttpRequest) {
            alert("antes de enviar");
        },
        complete:function (XMLHttpRequest, textStatus) {
            alert('despues de enviar');
        },*/
        success:function(data, textStatus, jqXHR) 
        {
            direccion = '<?php echo $this->Html->url(array('action' => 'aservicios',$idAmbiente,$idEdificio))?>';
            cargarmodal(direccion);
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if fails   
            alert("error");
        }
    });
    e.preventDefault(); //STOP default action
    //e.unbind(); //unbind. to stop multiple form submit.
});
</script>
