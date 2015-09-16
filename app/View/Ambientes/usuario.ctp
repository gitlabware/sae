<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-user"></i> Propietario</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <div id="idmensaje">

    </div>
    <?php echo $this->Form->create('Ambiente', array('action' => 'guarda_propietario/' . $idPiso, 'class' => 'form-horizontal form-bordered', 'id' => 'ajaxform')); ?>
    <fieldset>
        <legend>Informacion de Propietario</legend>
        <div class="form-group">
            <label class="col-md-4 control-label">Nombre</label>
            <div class="col-md-8">
                <?php echo $this->Form->hidden('User.id'); ?>
                <?php echo $this->Form->text('User.nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de Propietario', 'required')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">C.I.:</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('User.ci', array('class' => 'form-control', 'placeholder' => 'Ingrese el C.I.:', 'required')); ?>
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
            <button type="button" class="btn btn-sm btn-default" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ambiente', $idPiso, 0, 0, 1)); ?>')">Cancelar</button>
            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
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
                          $('div.modal-body').scrollTo(0, 800);
                      } else {
                          
                          direccion = '<?php echo $this->Html->url(array('action' => 'ambiente', $idPiso, 0)) ?>/' + $.parseJSON(data).usuario + '/1';
                          cargarmodal(direccion);
                      }
                      //direccion = '<?php //echo $this->Html->url(array('action' => 'ambiente', $idPiso, 0))   ?>/' + $.parseJSON(data).usuario + '/1';
                      //alert($.parseJSON(data).usuario);
                      //data: return data from server
                      //$("#selectpropietario").html(data);
                      //cargarmodal(direccion);
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
