<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-users"></i> Inquilinos</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Ambiente', array('action' => 'guarda_inquilino', 'class' => 'form-horizontal form-bordered', 'id' => 'ajaxforminquilino')); ?>
    <fieldset>
        <div class="form-group">
            <label class="col-md-2 control-label">Inquilino</label>
            <div class="col-md-8">
                <?php echo $this->Form->hidden('Inquilino.ambiente_id', array('value' => $idAmbiente)) ?>
                <?php echo $this->Form->hidden('Inquilino.estado', array('value' => 1)) ?>
                <?php echo $this->Form->hidden("Inquilino.user_id", array('id' => 'id-user_id-user')) ?>
                <?php echo $this->Form->text('Inquilino.user', array('class' => 'form-control', 'required', 'id' => 'id-nombre-user','placeholder' => 'Escriba el nombre del usuario')); ?>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success" type="button" onclick="$('#divforminquilino').toggle(400);">Nuevo</button>
            </div>
        </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
    <div class="row">
        <div class="col-md-12" id="div-usuarios">

        </div>
    </div>
    <div id="divforminquilino" style="display: none;">
        <?php echo $this->Form->create('Ambiente', array('action' => 'guarda_nuevo_inquilino', 'class' => 'form-horizontal form-bordered', 'id' => 'ajaxform')); ?>
        <fieldset>
            <legend>Nuevo Inquilino</legend>
            <div class="form-group">
                <label class="col-md-4 control-label">Nombre</label>
                <div class="col-md-8">
                    <?php echo $this->Form->hidden('User.id'); ?>
                    <?php echo $this->Form->hidden('User.role', array('value' => 'Inquilino')) ?>
                    <?php echo $this->Form->hidden('Inquilino.ambiente_id', array('value' => $idAmbiente)) ?>
                    <?php echo $this->Form->hidden('Inquilino.estado', array('value' => 1)) ?>
                    <?php echo $this->Form->text('User.nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de Propietario', 'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">C.I.:</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('User.ci', array('class' => 'form-control', 'placeholder' => 'Ingrese el C.I.', 'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Telefonos</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('User.telefonos', array('class' => 'form-control', 'placeholder' => 'Ingrese los telefonos')); ?>
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
                        <?php foreach ($inquilinos as $in): ?>
                          <tr>
                              <td><?php echo $in['User']['nombre'] ?></td>
                              <td><a title="Quitar inquilino" href="javascript:" class="label label-danger" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'quita_inquilino', $in['Inquilino']['user_id'], $idAmbiente)) ?>');">Quitar</a></td>
                          </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="form-group form-actions">
        <div class="col-xs-12 text-right">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-sm btn-primary" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ambiente', $idPiso, $idAmbiente)) ?>');">Atras</button>
        </div>
    </div>
</div>
<!-- END Modal Body -->
<script>
  function cambia_usuario(idUsuario) {
      $('#id-user_id-user').val(idUsuario);
      /*$('#div-usuarios').html("");
      $('#id-nombre-user').val("");*/
      var postData = $("#ajaxforminquilino").serializeArray();
      var formURL = $("#ajaxforminquilino").attr("action");
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
                      direccion = '<?php echo $this->Html->url(array('action' => 'inquilinos', $idAmbiente)) ?>';
                      cargarmodal(direccion);
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      //if fails   
                      alert("error");
                  }
              });
  }
  $('#id-nombre-user').keyup(function () {
      var postData = $('#ajaxforminquilino').serializeArray();
      $.ajax(
              {
                  url: '<?php echo $this->Html->url(array('action' => 'busca_usuario')); ?>',
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
                      $("#div-usuarios").html(data);
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      //if fails   
                      alert("error");
                  }
              });
  });
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
                      direccion = '<?php echo $this->Html->url(array('action' => 'inquilinos', $idAmbiente)) ?>';
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
</script>

<script>
  $("#ajaxforminquilino").submit(function (e)
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
                      direccion = '<?php echo $this->Html->url(array('action' => 'inquilinos', $idAmbiente)) ?>';
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
</script>
