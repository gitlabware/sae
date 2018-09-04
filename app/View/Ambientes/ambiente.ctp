<div class="modal-header">
  <h4 class="modal-title"><i class="fa fa-table"></i> Ambiente</h4>
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<?php echo $this->Form->create('Ambiente', array('action' => 'guarda_ambiente', 'class' => 'form-horizontal form-bordered', 'id' => 'formambiente')); ?>

<div class="modal-body">

  <legend><?php echo "Edificio " . $piso['Edificio']['nombre'] . " | Piso " . $piso['Piso']['nombre'] ?></legend>

  <div class="row">

    <div class="col-md-8">
      <div class="form-group">
        <label class="control-label">Identificador</label>
        <div class="controls">
          <?php echo $this->Form->hidden('edificio_id', array('value' => $piso['Edificio']['id'])); ?>
          <?php echo $this->Form->hidden('piso_id', array('value' => $piso['Piso']['id'])); ?>
          <?php echo $this->Form->hidden('id'); ?>
          <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'required', 'placeholder' => 'Nombre del ambiente')); ?>
        </div>
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Areal Util</label>
        <div class="controls">
          <?php echo $this->Form->text('area_util', array('class' => 'form-control', 'required', 'placeholder' => 'Ej: 30', 'type' => 'number', 'step' => 'any', 'id' => 'idareautil')); ?>
        </div>
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Area Comun</label>
        <div class="controls">
          <?php echo $this->Form->text('area_comun', array('class' => 'form-control', 'required', 'placeholder' => 'Ej: 5', 'type' => 'number', 'step' => 'any', 'id' => 'idareacomun')); ?>
        </div>
      </div>
    </div>

  </div>

  <div class="row">

    <div class="col-md-8">
      <div class="form-group">
        <label class="control-label">Categoria Ambiente</label>
        <div class="controls">
          <?php echo $this->Form->select('categoriasambiente_id', $catambientes, array('class' => 'form-control', 'required', 'id' => 'idcatambientes')); ?>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label class="control-label">Categoria Pago</label>
        <div class="controls">
          <?php echo $this->Form->select('categoriaspago_id', $catpagos, array('class' => 'form-control', 'required', 'id' => 'idcatpagos')); ?>
        </div>
      </div>
    </div>

  </div>

  <?php
  $representante_id = '';
  if (!empty($this->request->data['Ambiente']['representante_id'])) {
    $representante_id = $this->request->data['Ambiente']['representante_id'];
  }
  $user_id = '';
  if (!empty($this->request->data['Ambiente']['user_id'])) {
    $user_id = $this->request->data['Ambiente']['user_id'];
  }
  ?>
  <input type="hidden" name="data[Ambiente][representante_id]" id="idrepresen" value="<?php echo $representante_id ?>">
  
  <div class="row">

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">
          Propietario
          <button 
            type="button" 
            class="btn btn-sm btn-success"
            onclick="cargarmodal_amb('<?php echo $this->Html->url(array('controller' => 'Ambientes', 'action' => 'usuario', $idPiso)); ?>')" >
            Nuevo
          </button>
        </label>
        <div class="controls">
          <?php echo $this->Form->select('user_id', $usuarios, array('class' => 'form-control', 'id' => 'select-prop')); ?>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">
          Inquilino
          <button 
            type="button" 
            class="btn btn-sm btn-success"
            onclick="cargarmodal_amb('<?php echo $this->Html->url(array('controller' => 'Ambientes', 'action' => 'inquilino', $idPiso)); ?>')" >
            Nuevo
          </button>
        </label>
        <div class="controls">
          <?php echo $this->Form->select('inquilino_id', $select_inquilinos, array('class' => 'form-control', 'id' => 'select-prop')); ?>
        </div>
      </div>
    </div>
  </div>

  <script>
  $('#select-prop').change(function () {
    $('#idrepprop').val($('#select-prop').val());
  });
  </script>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">
          Fecha de Ocupacion
        </label>
        <div class="controls">
          <?php echo $this->Form->date('fecha_ocupacion', array('class' => 'form-control', 'placeholder' => 'ejemplo: 2014-12-01')); ?>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">
          Estado
        </label>
        <div class="controls">
          <?php echo $this->Form->select('estado', 
            array('Activo' => 'Activo', 'Inactivo' => 'Inactivo'), 
            array('class' => 'form-control', 'required', 'empty' => false)); ?>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label">
          Descripcion
        </label>
        <div class="controls">
          <?php echo $this->Form->text('descripcion', array('class' => 'form-control', 'placeholder' => 'Descripcion')); ?>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- END Modal Body -->
<div class="modal-footer">
  <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
  <?php if (!empty($idAmbiente)): ?>
  <button type="button" class="btn btn-info" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Conceptos', 'action' => 'aservicios', $idAmbiente, $piso['Edificio']['id'])) ?>');">Servicios</button>
  <?php echo $this->Html->link("Por cobrar", array('action' => 'xcobrar', $idAmbiente), array('class' => 'btn btn-success')) ?>
  <?php endif;?>
  <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
</div>
<?php echo $this->Form->end(); ?>
<script>
  var cateambientes = [];
  <?php foreach ($categoria_ambientes as $cat): ?>
  cateambientes[parseInt('<?php echo $cat['Categoriasambiente']['id']; ?>')] = <?php echo $cat['Categoriasambiente']['constante']; ?>;
  <?php endforeach;?>
  var catepagos = [];
  <?php foreach ($categoria_pagos as $cate): ?>
  catepagos[parseInt('<?php echo $cate['Categoriaspago']['id']; ?>')] = <?php echo $cate['Categoriaspago']['constante']; ?>;
  <?php endforeach;?>
  $("#idareautil").keyup(function () {
    calcula_mantenimiento();
  });
  $("#idareacomun").keyup(function () {
    calcula_mantenimiento();
  });
  $("#idcatambientes").change(function () {
    calcula_mantenimiento();
  });
  $("#idcatpagos").change(function () {
    calcula_mantenimiento();
  });
  function calcula_mantenimiento()
  {
    totalmt = (parseFloat($("#idareautil").val()) + parseFloat($("#idareacomun").val())).toFixed(2);
    costob = (totalmt * cateambientes[parseInt($("#idcatambientes").val())]).toFixed(2);
    mantenimiento = (parseFloat(costob) + parseFloat(catepagos[parseInt($("#idcatpagos").val())])).toFixed(2);
    $("#mantenimiento_span").html('Mantenimiento(' + mantenimiento + ')');
  }
</script>
<?php if (empty($idAmbiente) && !$sw): ?>
  <script>
    calcula_mantenimiento();
  </script>
<?php endif;?>
<script>
  function cargarmodal_amb(urle)
  {
    var postData = $("#formambiente").serializeArray();
    var formURL = "<?php echo $this->Html->url(array('action' => 'rescata_datos')); ?>";
    $.ajax(
    {
      url: formURL,
      type: "POST",
      data: postData,
/*beforeSend:function (XMLHttpRequest) {
alert("antes de enviar");
},*/
complete: function (XMLHttpRequest, textStatus) {
  cargarmodal(urle);
},
success: function (data, textStatus, jqXHR)
{
//data: return data from server
//$("#selectpropietario").html(data);
},
error: function (jqXHR, textStatus, errorThrown)
{
//if fails
alert("error");
}
});
  }
</script>
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