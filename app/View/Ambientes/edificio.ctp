<!-- Blank Header -->
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-brush"></i>Edificio <?php echo $edificio['Edificio']['nombre'] ?><br>
        </h1>
    </div>
</div>
<?php foreach ($pisos as $pi): ?>
  <div class="block">
      <!-- Example Title -->
      <div class="block-title">
          <h2>
              <div id="div-nombre-edi-<?php echo $pi['Piso']['id']; ?>">
                  <span id="idnombre-span-amb-<?php echo $pi['Piso']['id']; ?>" title="EDITAR" onclick="$('#div-nombre-edi-<?php echo $pi['Piso']['id']; ?>').toggle(200);
                        $('#edita-edificio-<?php echo $pi['Piso']['id']; ?>').toggle(200);"><?php echo $pi['Piso']['nombre']; ?></span> - AMBIENTES <span id="iderror-amb-<?php echo $pi['Piso']['id']; ?>"></span>
              </div>
              <div id="edita-edificio-<?php echo $pi['Piso']['id']; ?>" style="display: none;">
                  <?php echo $this->Form->create('Ambiente', array('action' => 'registra_nombre', 'id' => 'form-ambiente-' . $pi['Piso']['id'])); ?>
                  <?php echo $this->Form->hidden('Piso.id', array('value' => $pi['Piso']['id'])); ?>
                  <?php echo $this->Form->hidden('Piso.edificio_id', array('value' => $pi['Piso']['edificio_id'])); ?>
                  <?php echo $this->Form->text('Piso.nombre', array('placeholder' => 'Nombre del ambiente', 'id' => 'idnombret-' . $pi['Piso']['id'], 'value' => $pi['Piso']['nombre'])); ?> 
                  <button class="btn btn-xs btn-success" type="button" onclick="guarda_edificio(<?php echo $pi['Piso']['id']; ?>);">Guardar</button>  - AMBIENTES
                  <?php echo $this->Form->end(); ?>
              </div>
              <div id="idloadnombre-<?php echo $pi['Piso']['id']; ?>" style="display: none;">
                  <i class="fa fa-asterisk fa-spin fa-2x text-info"></i>
              </div>
          </h2>
      </div>
      <?php $ambientes = $this->requestAction(array('action' => 'get_ambientes', $edificio['Edificio']['id'], $pi['Piso']['id'])) ?>
      <div class="row">
          <?php foreach ($ambientes as $am): ?>
            <div class="col-md-3">
                <?php //debug($am); ?>
                <a class="btn btn-info col-md-8" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ambiente', $pi['Piso']['id'], $am['Ambiente']['id'])); ?>');"><?php echo $am['User']['nombre'] ?></a> 
                <a class="btn btn-warning col-md-2"><?php echo $am['Ambiente']['nombre'] ?></a> 
                <?php echo $this->Html->link('<i class="gi gi-circle_remove"></i>', array('action' => 'eliminar', $am['Ambiente']['id']), array('class' => 'btn btn-danger col-md-2', 'escape' => FALSE, 'confirm' => 'Esta seguro de quitar el ambiente', 'title' => 'Quitar ambiente')) ?>
            </div> 
          <?php endforeach; ?>
          <div class="col-md-3">
              <a class="btn btn-success col-md-12" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ambiente', $pi['Piso']['id'])); ?>');">ADICIONAR</a>
          </div> 
      </div>
      <br>
  </div>
<?php endforeach; ?>
<script src="<?php echo $this->webroot; ?>js/pages/uiProgress.js"></script>
<script>
              function guarda_edificio(id_piso) {
                  var postData = $('#form-ambiente-' + id_piso).serializeArray();
                  var formURL = $('#form-ambiente-' + id_piso).attr("action");
                  $.ajax(
                          {
                              url: formURL,
                              type: "POST",
                              data: postData,
                              beforeSend: function (XMLHttpRequest) {
                                  $('#edita-edificio-' + id_piso).toggle();
                                  $('#idloadnombre-<?php echo $pi['Piso']['id']; ?>').toggle();
                              },
                              /*complete: function (XMLHttpRequest, textStatus) {
                               //alert('despues de enviar');
                               },*/
                              success: function (data, textStatus, jqXHR)
                              {
                                  if ($.parseJSON(data).msgerror == '') {
                                      $('#idnombre-span-amb-' + id_piso).html($.parseJSON(data).nombre_amb);
                                      var growlType = 'success';
                                      $.bootstrapGrowl('<h4>Excelente!</h4> <p>Se registro correctamente!!</p>', {
                                          type: growlType,
                                          delay: 2500,
                                          allow_dismiss: true
                                      });
                                      $(this).prop('disabled', true);
                                  } else {
                                      var growlType = 'danger';
                                      $.bootstrapGrowl('<h4>Error!</h4> <p>' + $.parseJSON(data).msgerror + '</p>', {
                                          type: growlType,
                                          delay: 2500,
                                          allow_dismiss: true
                                      });
                                      $(this).prop('disabled', true);
                                  }
                                  $('#idloadnombre-<?php echo $pi['Piso']['id']; ?>').toggle();
                                  $('#div-nombre-edi-' + id_piso).toggle(200);
                              },
                              error: function (jqXHR, textStatus, errorThrown)
                              {
                                  //if fails   
                                  alert("error");
                              }
                          });
              }
</script>
