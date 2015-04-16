<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-money"></i> Busque el Ambiente</h2>
</div>
<div class="modal-body">
    <?php echo $this->Form->create('Reporte', array('id' => 'idformcombo1')); ?>
    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <div class="form-group">
                    <label class="col-md-4 control-label">Ambiente</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->text('Ambiente.nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre del ambiente', 'required', 'id' => 'campobuscar')); ?>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <div class="col-md-12">
                        <div id="listado" class="table-responsive panel-collapse pull out">

                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="form-group form-actions">
        <div class="col-xs-12 text-right">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-sm btn-primary" onclick="$('#<?php echo $div; ?>').load('<?php echo $this->Html->url(array('action' => 'comboselect_amb3', $campoform, $div, NULL)); ?>');
          jQuery('#myModal').modal('toggle');">NINGUNO</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<!-- END Modal Body -->
<script>
  jQuery(document).ready(function () {
      jQuery("#idformcombo1").submit(function () {
          return false;
      });
  });
  jQuery('#campobuscar').keyup(function () {
      var postData = jQuery(this).serializeArray();
      var formURL = "<?php echo $this->Html->url(array('action' => 'comboselect_amb2', $campoform, $div)); ?>";
      jQuery.ajax(
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
                      jQuery("#listado").html(data);
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      //if fails   
                      alert("error");
                  }
              });
  });
</script>