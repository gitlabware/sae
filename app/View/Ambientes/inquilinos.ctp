<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-users"></i> Inquilinos</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Ambiente', array('action' => 'guarda_inquilino', 'class' => 'form-horizontal form-bordered','id' => 'ajaxforminquilino')); ?>
        <fieldset>
            <div class="form-group">
                
                <label class="col-md-2 control-label" onclick="$('#divforminquilino').toggle(400);" title="Nuevo Inquilino">Inquilino</label>
                <div class="col-md-8">
                    <?php echo $this->Form->hidden('Inquilino.ambiente_id' ,array('value' => $idAmbiente))?>
                    <?php echo $this->Form->hidden('Inquilino.estado' ,array('value' => 1))?>
                    <?php echo $this->Form->select('Inquilino.user_id',$select_inquilinos, array('class' => 'form-control', 'required')); ?>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success" type="submit">ADD</button>
                </div>
            </div>
        </fieldset>
    <?php echo $this->Form->end();?>
    <div id="divforminquilino" style="display: none;">
        <?php echo $this->Form->create('Ambiente', array('action' => 'guarda_nuevo_inquilino', 'class' => 'form-horizontal form-bordered', 'id' => 'ajaxform')); ?>
        <fieldset>
            <legend>Nuevo Inquilino</legend>
            <div class="form-group">
                <label class="col-md-4 control-label">Nombre</label>
                <div class="col-md-8">
                    <?php echo $this->Form->hidden('User.id'); ?>
                    <?php echo $this->Form->hidden('User.role' ,array('value' => 'Inquilino'))?>
                    <?php echo $this->Form->hidden('Inquilino.ambiente_id' ,array('value' => $idAmbiente))?>
                    <?php echo $this->Form->hidden('Inquilino.estado' ,array('value' => 1))?>
                    <?php echo $this->Form->text('User.nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de Propietario', 'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Telefonos</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('User.telefonos', array('class' => 'form-control', 'placeholder' => 'Ingrese los telefonos', 'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Direccion</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('User.direccion', array('class' => 'form-control', 'placeholder' => 'Ingrese la direccion')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">E-mail</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('User.email', array('class' => 'form-control', 'placeholder' => 'Ingrese correo electronico')); ?>
                </div>
            </div>
        </fieldset>
        <div class="form-group form-actions">
            <div class="col-xs-12 text-right">
                <button type="submit" class="btn btn-sm btn-primary">Registrar</button>
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
                            <th>Nombre</th>
                            <th>Quitar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inquilinos as $in):?>
                        <tr>
                            <td><?php echo $in['User']['nombre']?></td>
                            <td>Quitar</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
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
            direccion = '<?php echo $this->Html->url(array('action' => 'inquilinos',$idAmbiente))?>';
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
  $("#ajaxforminquilino").submit(function(e)
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
            direccion = '<?php echo $this->Html->url(array('action' => 'inquilinos',$idAmbiente))?>';
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
