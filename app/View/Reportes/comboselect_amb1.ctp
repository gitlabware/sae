<!-- Modal Header -->
<div class="modal-header">
  <h2 class="modal-title"><i class="fa fa-money"></i> Busque el Ambiente</h2>
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<?php echo $this->Form->create('Reporte', array('id' => 'idformcombo1')); ?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-12">

      <div class="form-group">
        <div class="row">

          <label class="col-md-4 control-label">Ambiente</label>
          <div class="col-md-8">
            <?php echo $this->Form->text('Ambiente.nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre del ambiente', 'required', 'id' => 'campobuscar')); ?>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">

          <div class="col-md-12">
            <div id="listado" class="table-responsive panel-collapse pull out">

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
  <button type="button" class="btn btn-danger waves-effect waves-light"  onclick="$('#<?php echo $div; ?>').load('<?php echo $this->Html->url(array('action' => 'comboselect_amb3', $campoform, $div, NULL)); ?>');
  jQuery('#myModal').modal('toggle');">Ninguno</button>
</div>
<?php echo $this->Form->end(); ?>
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