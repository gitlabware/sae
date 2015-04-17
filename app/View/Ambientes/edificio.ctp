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
              <div id="div-nombre-amb-<?php echo $pi['Piso']['id']; ?>">
                  <span id="idnombre-span-amb-<?php echo $pi['Piso']['id']; ?>" title="EDITAR" onclick="$('#div-nombre-amb-<?php echo $pi['Piso']['id']; ?>').toggle(200);
                    $('#edita-ambiente-<?php echo $pi['Piso']['id']; ?>').toggle(200);"><?php echo $pi['Piso']['nombre']; ?></span> - AMBIENTES <span id="iderror-amb-<?php echo $pi['Piso']['id']; ?>"></span>
              </div>
              <div id="edita-ambiente-<?php echo $pi['Piso']['id']; ?>" style="display: none;">
                  <?php echo $this->Form->create('Ambiente', array('action' => 'registra_nombre', 'id' => 'form-ambiente-' . $pi['Piso']['id'])); ?>
                  <?php echo $this->Form->text('Ambiente.nombre', array('placeholder' => 'Nombre del ambiente', 'id' => 'idnombret-' . $pi['Piso']['id'], 'value' => $pi['Piso']['nombre'])); ?> 
                  <button class="btn btn-xs btn-success" type="button" onclick="guarda_ambiente(<?php echo $pi['Piso']['id']; ?>);">Guardar</button>  - AMBIENTES
                  <?php echo $this->Form->end(); ?>
              </div>
          </h2>
      </div>
      <?php $ambientes = $this->requestAction(array('action' => 'get_ambientes', $edificio['Edificio']['id'], $pi['Piso']['id'])) ?>
      <div class="row">
          <?php foreach ($ambientes as $am): ?>
            <div class="col-md-3">
                <a class="btn btn-info col-md-10" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ambiente', $pi['Piso']['id'], $am['Ambiente']['id'])); ?>');"><?php echo $am['Ambiente']['nombre'] ?></a> 
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
<script>
  function guarda_ambiente(id_piso) {
      var postData = $('#form-ambiente-' + id_piso).serializeArray();
      var formURL = $('#form-ambiente-' + id_piso).attr("action");
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
                    
                      //data: return data from server
                      //$("#parte").html(data);
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      //if fails   
                      alert("error");
                  }
              });
  }


</script>
