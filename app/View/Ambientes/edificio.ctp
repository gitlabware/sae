
<?php foreach ($pisos as $pi): ?>
  <div class="block">
      <!-- Interactive Title -->
      <div class="block-title">
          <!-- Interactive block controls (initialized in js/app.js -> interactiveBlocks()) -->
          <div class="block-options pull-right">
              <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" onclick="$('#<?php echo 'idcont-' . $pi['Piso']['id'] ?>').toggle(400);"><i class="fa fa-arrows-v"></i></a>
              <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('controller' => 'Edificios', 'action' => 'elimina_piso', $pi['Piso']['id']), array('class' => 'btn btn-alt btn-sm btn-primary', 'confirm' => 'Esta seguro de eliminar el piso??', 'escape' => FALSE)); ?>
          </div>
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
      <!-- END Interactive Title -->

      <!-- Interactive Content -->
      <!-- The content you will put inside div.block-content, will be toggled -->
      <div class="block-content" id="<?php echo 'idcont-' . $pi['Piso']['id'] ?>" style="display: none;">
          <div class="row">
              <table class="table table-striped" style="font-size: 15px; font-weight: bold;">
                  <thead>
                      <tr>
                          <th>Representante</th>
                          <th>Propietario</th>
                          <th>Ambiente</th>
                          <th>Accion</th>
                      </tr>
                  </thead>
                  <?php $ambientes = $this->requestAction(array('action' => 'get_ambientes', $edificio['Edificio']['id'], $pi['Piso']['id'])) ?>
                  <?php foreach ($ambientes as $am): ?>
                    <tr>
                        <td class="success"><?php echo $am['Representante']['nombre'] ?></td>
                        <td class="success"><?php echo $am['User']['nombre'] ?></td>
                        <td class="info"><?php echo $am['Ambiente']['nombre'] ?></td>
                        <td class="warning">
                            <a class="btn btn-info" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ambiente', $pi['Piso']['id'], $am['Ambiente']['id'])); ?>');"> <i class="gi gi-edit"></i> </a>  
                            <?php echo $this->Html->link('<i class="gi gi-circle_remove"></i>', array('action' => 'eliminar', $am['Ambiente']['id']), array('class' => 'btn btn-danger', 'escape' => FALSE, 'confirm' => 'Esta seguro de quitar el ambiente', 'title' => 'Quitar ambiente')) ?> 

                        </td>
                    </tr>
                  <?php endforeach; ?>
              </table>
              <div class="col-md-3">
                  <a class="btn btn-success col-md-12" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ambiente', $pi['Piso']['id'])); ?>');">ADICIONAR</a>
              </div> 
          </div>
      </div>
  </div>
<?php endforeach; ?>
<div class="row">
    <div class="col-md-12">
        <a class="btn btn-success col-md-12" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Edificios', 'action' => 'piso')); ?>');">ADICIONAR PISO</a>
    </div>
</div>
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

