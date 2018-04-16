<div class="row">
  <div class="col-md-12">
    <!-- Basic Form Elements Block -->
    <div class="card">
      <!-- Basic Form Elements Title -->
      <div class="card-header">
        <h4>REPORTE GENERAL DE PAGOS</h4>
      </div>

      <div class="card-body">
        <div class="form-horizontal form-bordered">
          <?php echo $this->Form->create('Reporte', array('action' => 'ajax_reporte_pagos', 'id' => 'ajaxform','class' => 'no-imrprime-p')); ?>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label class="control-label">Ambiente</label>
                <div id="divselectambiente">
                  <button type="button" class="btn btn-info col-md-12" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'comboselect_amb1', 'Reporte.ambiente_id', 'divselectambiente')); ?>');">
                    SELECCIONE EL AMBIENTE
                  </button>
                </div>
              </div>
              <div class="col-md-4">
                <label class="control-label">Propietario</label>
                <div id="divselectpropietario">
                  <button type="button" class="btn btn-info col-md-12" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'comboselect_prop1', 'Reporte.propietario_id', 'divselectpropietario')); ?>');">
                    SELECCIONE EL PROPIETARIO
                  </button>
                </div>
              </div>
              <div class="col-md-4">
                <label class="control-label">Inquilino</label>
                <div id="divselectinquilino">
                  <button type="button" class="btn btn-info col-md-12" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'comboselect_inq1', 'Reporte.inquilino_id', 'divselectinquilino')); ?>');">
                    SELECCIONE EL INQUILINO
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">

              <div class="col-md-2">
                <label class="control-label">Fecha_Inicio</label>
                <?php echo $this->Form->date('fecha_ini', array('class' => 'form-control', 'required')); ?>
              </div>
              <div class="col-md-2">
                <label class="control-label">Fecha_Fin</label>
                <?php echo $this->Form->date('fecha_fin', array('class' => 'form-control', 'required')); ?>
              </div>
              <div class="col-md-3">
                <label class="control-label">Tipo</label>
                <?php echo $this->Form->select('tipo', array('Debe' => 'Debe', 'Pagado' => 'Pagado', 'Todos' => 'Todos'), array('class' => 'form-control')); ?>
              </div>
              <div class="col-md-3">
                <label class="control-label">Concepto</label>
                <?php echo $this->Form->select('concepto_id', $conceptos, array('class' => 'form-control')); ?>
              </div>
              <div class="col-md-2">
                <label class="control-label">&nbsp;</label>
                <button class="btn btn-primary form-control text-white">BUSCAR</button>
              </div>
            </div>
          </div>
          <?php echo $this->Form->end(); ?>
          <div class="form-group">
            <div class="row">

              <div class="col-md-12" id="divtablapagos">

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php $this->start('campo_js') ?>
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
                      //data: return data from server
                      $("#divtablapagos").html(data);
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

  <?php $this->end() ?>