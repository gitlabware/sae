<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-sort"></i> Sub-concepto</h2>
</div>
<!-- END Modal Header -->

<!-- Modal Body -->
<div class="modal-body">
    <div id="idmensaje">

    </div>
    <?php echo $this->Form->create('Concepto', array('id' => 'ajaxform', 'class' => 'form-horizontal form-bordered')); ?>
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label">Concepto</label>
            <div class="col-md-8">
                <?php echo $this->Form->hidden('Subconcepto.id'); ?>
                <?php echo $this->Form->hidden('Subconcepto.edificio_id', array('value' => $this->Session->read('Auth.User.edificio_id'))); ?>
                <?php echo $this->Form->select('Subconcepto.concepto_id', $conceptos, array('class' => 'form-control', 'empty' => 'Seleccione el concepto', 'required')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Nombre</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('Subconcepto.nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre del subconcepto', 'required')); ?>
            </div>
        </div>
        <div class="form-group">
            <div id="select-tipo">
                <label class="col-md-4 control-label">Tipo <a href="javascript:" class="label label-info" onclick="show_text();">Texto</a></label>
                <div class="col-md-8">
                    <?php echo $this->Form->select('Subconcepto.tipo', $tipos, array('class' => 'form-control select-tipo', 'empty' => 'Seleccione el Tipo', 'required')); ?>
                </div>
            </div>
            <div id="text-tipo" style="display: none;">
                <label class="col-md-4 control-label">Tipo <a href="javascript:" class="label label-info" onclick="show_select();">Seleccion</a></label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('Subconcepto.nuevo_tipo', array('class' => 'form-control text-tipo', 'placeholder' => 'Ingrese el tipo')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Gestns. Anteriores</label>
            <div class="col-md-8">
                <?php echo $this->Form->checkbox('Subconcepto.gestiones_anteriores', array('class' => 'form-control')); ?>
            </div>
        </div>
    </fieldset>
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
<?php if (!empty($this->request->data['Subconcepto']['id'])): ?>
    show_text();
    $('.text-tipo').val('<?php echo $this->request->data['Subconcepto']['tipo'] ?>');
<?php endif; ?>

  function show_text() {
      $('#text-tipo').show(400);
      $('#select-tipo').hide(400);
      $('.text-tipo').prop('required', true);
      $('.select-tipo').prop('required', false);
      $('.select-tipo').val('');
  }
  function show_select() {
      $('#text-tipo').hide(400);
      $('#select-tipo').show(400);
      $('.text-tipo').prop('required', false);
      $('.select-tipo').prop('required', true);
      $('.text-tipo').val('');
  }

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
                          direccion = '<?php echo $this->Html->url(array('action' => 'subconceptos')) ?>';
                          window.location.href = direccion;
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
  function mensaje(vmensaje)
  {
      divmensaje1 = '<h4><i class="fa fa-times-circle"></i> Error</h4> ' + vmensaje;
      divmensaje2 = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + divmensaje1;
      divmensaje3 = '<div class="alert alert-danger alert-dismissable">' + divmensaje2 + '</div>';
      $('#idmensaje').html(divmensaje3);
  }
</script>