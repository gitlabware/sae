<link href="<?php echo $this->webroot; ?>template/assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
<link href="<?php echo $this->webroot; ?>template/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<div class="modal-header">
  <h2 class="modal-title"><i class="fa fa-sort"></i>Sub-concepto</h2>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
  </button>
</div>

<!-- END Modal Header -->

<!-- Modal Body -->
<div class="modal-body">
  <?php echo $this->Form->create('Concepto', array('id' => 'ajaxform')); ?>
  <div class="row">

    <div class="col-md-4">
      <div class="form-group">
        <label class="control-label">Codigo</label>
        <?php echo $this->Form->text('Subconcepto.codigo', array('class' => 'form-control', 'placeholder' => 'Ej: 2', 'required')); ?>
      </div>
    </div>

    <div class="col-md-8">
      <div class="form-group">
        <label class="control-label">Concepto</label>
        <?php echo $this->Form->hidden('Subconcepto.id'); ?>
        <?php echo $this->Form->hidden('Subconcepto.edificio_id', array('value' => $this->Session->read('Auth.User.edificio_id'))); ?>
        <?php echo $this->Form->select('Subconcepto.concepto_id', $conceptos, array('class' => 'form-control', 'empty' => 'Seleccione el concepto')); ?>
      </div>      
    </div>

  </div>

  <div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">Nombre</label>
            <?php echo $this->Form->text('Subconcepto.nombre', array('class' => 'form-control', 'placeholder' => 'Ej: Ingresos Corritentes', 'required')); ?>
        </div>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label">Es parte de</label>

    <?php echo $this->Form->select('Subconcepto.subconcepto_id', $subconceptos, array('class' => 'form-control select2', 'empty' => 'Seleccione el subconcepto', 'style' => 'width: 100%;')); ?>

  </div>
  <div class="form-group">
    <div id="select-tipo">
      <label class="control-label">Tipo</label>

      <?php echo $this->Form->select('Subconcepto.tipo', array('Ingreso' => 'Ingreso','Egreso' => 'Egreso'), array('class' => 'form-control select-tipo', 'empty' => false, 'required')); ?>

    </div>
  </div>
  <div class="form-group">
    <label class="control-label">Gestns. Anteriores</label>

    <?php echo $this->Form->checkbox('Subconcepto.gestiones_anteriores', array('class' => 'form-control', 'id' => 'ch-anterior', 'onclick' => 'ver_check_ant();')); ?>

  </div>
  <button type="submit" class="hide"></button>
  <?php echo $this->Form->end(); ?>
  <div id="d-gestiones" style="display: none;">
    <?= $this->Form->create('Concepto', array('id' => 'form-gestion', 'action' => 'registra_sgention')); ?>
    <?= $this->Form->hidden('SubcGestione.subconcepto_id', array('value' => $this->request->data['Subconcepto']['id'])) ?>
    <div class="form-group">


      <div class="row">
        <div class="col-12"></div>
        <h3  class="col-md-4 card-title">Gestiones :</h3>
        <div class="col-md-3">
          <?php echo $this->Form->text('SubcGestione.gestion_ini', array('class' => 'form-control', 'required', 'placeholder' => 'Gestion Inicial', 'type' => 'number', 'id' => 'id-ges-ini', 'onkeyup' => '$("#id-ges-fin").val(this.value);')); ?>
        </div>
        <div class="col-md-3">
          <?php echo $this->Form->text('SubcGestione.gestion_fin', array('class' => 'form-control', 'required', 'placeholder' => 'Gestion Final', 'type' => 'number', 'id' => 'id-ges-fin')); ?>
        </div>
        <div class="col-md-2">
          <?php if (empty($this->request->data['Subconcepto']['id'])): ?>
            <button class="btn btn-success" type="button" onclick="add_gestion();"><i class="fa fa-plus"></i></button>
          <?php else: ?>
            <button class="btn btn-success" type="button" onclick="enviaformu_gestion();"><i class="fa fa-plus"></i></button>
          <?php endif; ?>
        </div>
      </div>

    </div>
    <?= $this->Form->end(); ?>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Gestion Ini.</th>
              <th>Gestion Fin</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="body-gestiones">
            <?php foreach ($generaciones as $ge): ?>
              <tr>
                <td><?= $ge['SubcGestione']['gestion_ini'] ?></td>
                <td><?= $ge['SubcGestione']['gestion_fin'] ?></td>
                <td>
                  <a href="javascript:" class="btn btn-danger btn-sm" title="Quitar" onclick="quitar_ajax_sg(<?= $ge['SubcGestione']['id'] ?>);"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>

        </table>
      </div>
    </div>
    <br>
  </div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
  <button type="button" class="btn btn-danger waves-effect waves-light" onclick="enviar_form();">Guardar</button>
</div>

<!-- END Modal Body -->
<script src="<?php echo $this->webroot; ?>template/assets/plugins/toast-master/js/jquery.toast.js"></script>

<script src="<?php echo $this->webroot; ?>template/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script>
  $('.select2').select2();
  function enviar_form() {
    $('#ajaxform').find('[type="submit"]').trigger('click');
  }
  var cont_gen = 0;


  function add_gestion() {
      //alert($('#form-gestion').valid());
      // $("#form-gestion input").jqBootstrapValidation();
      if ($('#id-ges-ini').val() != '' && $('#id-ges-fin').val() != '') {
        cont_gen++;
        var ges_ini = $('#id-ges-ini').val();
        var ges_fin = $('#id-ges-fin').val();
        $('#id-ges-ini').val('');
        $('#id-ges-fin').val('');
        var contenido_g = '<tr class="clase-g-' + cont_gen + '">'
        + '<td>' + ges_ini + '</td>'
        + '<td>' + ges_fin + '</td>'
        + '<td><a href="javascript:" class="btn btn-sm btn-danger" title="Quitar" onclick="quitar_gestion(' + cont_gen + ');"><i class="fa fa-times"></i></a></td>'
        + '</tr>';
        var campos_f_g = '<input type="hidden" class="clase-g-' + cont_gen + '" name="data[gestiones][' + cont_gen + '][gestion_ini]" value="' + ges_ini + '">'
        + '<input type="hidden" class="clase-g-' + cont_gen + '" name="data[gestiones][' + cont_gen + '][gestion_fin]" value="' + ges_fin + '">';
        $('#ajaxform').append(campos_f_g);
        $('#body-gestiones').append(contenido_g);
        enviaformu_gestion();
      }else{
        alert("Ambos campos deben estar llenos");
      }
    }
    function quitar_gestion(numero) {
      $('.clase-g-' + numero).remove();
    }

    function ver_check_ant() {
      if ($('#ch-anterior').prop('checked')) {
        $('#d-gestiones').show(200);
      } else {
        $('#d-gestiones').hide(200);
      }
    }
    ver_check_ant();

    function show_text() {
      $('#text-tipo').show(400);
      $('#select-tipo').hide(400);
      $('.text-tipo').prop('required', true);
      $('.select-tipo').prop('required', false);
      $('.select-tipo').val('');
    }

    <?php //if (!empty($this->request->data['Subconcepto']['id'])):   ?>
  //show_text();
  //$('.text-tipo').val('<?php //echo $this->request->data['Subconcepto']['tipo']   ?>');
  <?php //endif;   ?>

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
                    direccion = '<?php echo $this->Html->url($this->request->referer()) ?>';
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




  function enviaformu_gestion(){
    $('#ajaxform :input').not(':submit').clone().hide().appendTo('#form-gestion');
    var postData = $("#form-gestion").serializeArray();
    var formURL = $("#form-gestion").attr("action");
    $.ajax(
    {
      url: formURL,
      type: "POST",
      data: postData,
      success: function (data, textStatus, jqXHR)
      {

        if ($.parseJSON(data).mensaje != '')
        {
          mensaje($.parseJSON(data).mensaje);
          $('div.modal-body').scrollTo(0, 800);
        } else {
          $.toast({
            heading: 'Excelente!!',
            text: 'Se registro todos los datos correctamente!!',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 3500,
            stack: 6
        });
          cargarmodal('<?= $this->Html->url(array('action' => 'subconcepto', $this->request->data['Subconcepto']['id'])); ?>');
        }
      },
      error: function (jqXHR, textStatus, errorThrown)
      {

        alert("error");
      }
    });
  }



  function quitar_ajax_sg(ids) {
    cargarmodal('<?= $this->Html->url(array('action' => 'elimina_subgestion', $this->request->data['Subconcepto']['id'])); ?>/' + ids);
    $.toast({
            heading: 'Excelente!!',
            text: 'Se elimino correctamente!!',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 3500,
            stack: 6
        });
  }

</script>