<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-users"></i> Usuarios</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body" id="idmodal-contenido">
    <div id="idmensaje">

    </div>
    <?php echo $this->Form->create('Edificio', array('action' => 'guarda_usurio', 'class' => 'form-horizontal form-bordered', 'id' => 'ajaxformusuario')); ?>
    <fieldset>
        <div class="form-group">
            <label class="col-md-2 control-label" onclick="$('#divformusuario').toggle(400);" title="Nuevo Usuario">Usuario</label>
            <div class="col-md-8">
                <?php echo $this->Form->hidden('User.edificio_id', array('value' => $idEdificio)) ?>
                <?php echo $this->Form->select('User.id', $select_usuarios, array('class' => 'form-control', 'required')); ?>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success" type="submit">ADD</button>
            </div>
        </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
    <div id="divformusuario" style="display: none;">
        <?php echo $this->Form->create('Edificio', array('action' => 'guarda_nuevo_usuario', 'class' => 'form-horizontal form-bordered', 'id' => 'ajaxform')); ?>
        <fieldset>
            <legend>Nuevo Usuario</legend>
            <div class="form-group">
                <label class="col-md-4 control-label">Nombre</label>
                <div class="col-md-8">
                    <?php echo $this->Form->hidden('User.id'); ?>
                    <?php echo $this->Form->hidden('User.role', array('value' => 'Administrador')) ?>
                    <?php echo $this->Form->hidden('User.edificio_id', array('value' => $idEdificio)) ?>
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
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Usuario</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('User.username', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de usuario', 'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Contrase&ntilde;a</label>
                <div class="col-md-8">
                    <?php echo $this->Form->password('User.password', array('class' => 'form-control', 'placeholder' => 'Ingrese un password')); ?>
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
                        <?php foreach ($usuarios as $us): ?>
                            <tr>
                                <td><?php echo $us['User']['nombre'] ?></td>
                                <td><a title="Quitar inquilino" href="javascript:" class="label label-danger" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'quita_usuario', $us['User']['id'],$idEdificio)) ?>');">Quitar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- END Modal Body -->
<script>
    $("#ajaxform").submit(function (e)
    {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
                {
                    url: formURL,
                    type: "POST",
                    data: postData,
                    /*beforeSend:function (XMLHttpRequest) {
                     alert("antes de enviar");
                     },
                     complete:function (XMLHttpRequest, textStatus) {
                     alert('despues de enviar');
                     },*/
                    success: function (data, textStatus, jqXHR)
                    {
                        if ($.parseJSON(data).mensaje != '')
                        {
                            mensaje($.parseJSON(data).mensaje);
                            $('div.modal-body').scrollTo( 0 , 800 );
                        } else {
                            direccion = '<?php echo $this->Html->url(array('action' => 'usuarios', $idEdificio)) ?>';
                            cargarmodal(direccion);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
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
    $("#ajaxformusuario").submit(function (e)
    {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
                {
                    url: formURL,
                    type: "POST",
                    data: postData,
                    /*beforeSend:function (XMLHttpRequest) {
                     alert("antes de enviar");
                     },
                     complete:function (XMLHttpRequest, textStatus) {
                     alert('despues de enviar');
                     },*/
                    success: function (data, textStatus, jqXHR)
                    {
                        direccion = '<?php echo $this->Html->url(array('action' => 'usuarios', $idEdificio)) ?>';
                        cargarmodal(direccion);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        //if fails   
                        alert("error");
                    }
                });
        e.preventDefault(); //STOP default action
        //e.unbind(); //unbind. to stop multiple form submit.
    });

    function mensaje(vmensaje)
    {
        divmensaje1 = '<h4><i class="fa fa-times-circle"></i> Error</h4> ' + vmensaje;
        divmensaje2 = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + divmensaje1;
        divmensaje3 = '<div class="alert alert-danger alert-dismissable">' + divmensaje2 + '</div>';
        $('#idmensaje').html(divmensaje3);
    }
</script>
