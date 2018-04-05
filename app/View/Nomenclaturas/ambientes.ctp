<!-- Modal Header -->
<div class="modal-header">
  <h2 class="modal-title"><i class="fa fa-building-o"></i> Asignacion <small>(<?php echo $nomenclatura['Nomenclatura']['nombre'] ?>)</small></h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<?php echo $this->Form->create('Nomenclatura', array('action' => 'ajax_ambientes', 'class' => 'form-horizontal form-bordered', 'id' => 'ajax-ambientes')); ?>
<div class="modal-body">
  <?php echo $this->Form->hidden('id', array('value' => $idNomenclatura)) ?>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <div class="row">  
          <label class="col-md-4 control-label">Piso</label>
          <div class="col-md-8">
            <?php echo $this->Form->select("Piso.id", $pisos, array('class' => 'form-control', 'empty' => 'Ninguno', 'id' => 'piso-s')) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php echo $this->Form->end(); ?>
  <?php echo $this->Form->create('Nomenclatura',array('action' => 'registra_ambientes','id' => 'ajax-reg')); ?>
  <?php echo $this->Form->hidden('id', array('value' => $idNomenclatura)) ?>
  <div class="row" id="div-ambientes">
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table id="general-table" class="table table-striped table-vcenter table-hover">
          <thead>
            <tr>
              <th>Piso</th>
              <th>Ambiente</th>
              <th>Quitar</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($ambientes as $am): ?>
              <tr>
                <td><?php echo $am['NomenclaturasAmbiente']['piso'] ?></td>
                <td><?php echo $am['Ambiente']['nombre'] ?></td>
                <td><a title="Quitar Ambiente" href="javascript:" class="label label-danger" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'quita_ambiente', $idNomenclatura, $am['NomenclaturasAmbiente']['id'])) ?>');">Quitar</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
  <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
</div>
<?php echo $this->Form->end();?>
<!-- END Modal Body -->

<script>
  $('#piso-s').change(function () {
    var postData = $('#ajax-ambientes').serializeArray();
    var formURL = $('#ajax-ambientes').attr("action");
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
                  $('#div-ambientes').html(data);
                      //direccion = '<?php echo $this->Html->url(array('action' => 'inquilinos')) ?>';
                      //cargarmodal(direccion);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                      //if fails   
                      alert("error");
                    }
                  });
  });
  $("#ajax-reg").submit(function (e)
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
                  direccion = '<?php echo $this->Html->url(array('action' => 'ambientes',$idNomenclatura)) ?>';
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
