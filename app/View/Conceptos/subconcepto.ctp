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
                <?php echo $this->Form->checkbox('Subconcepto.gestiones_anteriores', array('class' => 'form-control', 'id' => 'ch-anterior', 'onclick' => 'ver_check_ant();')); ?>
            </div>
        </div>
        <button type="submit" class="hide"></button>
        <?php echo $this->Form->end(); ?>
        <div id="d-gestiones" style="display: none;">
            <?= $this->Form->create('Concepto', array('id' => 'form-gestion', 'action' => 'registra_sgention')); ?>
            <?= $this->Form->hidden('SubcGestione.subconcepto_id', array('value' => $this->request->data['Subconcepto']['id'])) ?>
            <div class="form-group">
                <label class="col-md-4 control-label">Gestiones</label>
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
                      <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i></button>
                    <?php endif; ?>
                </div>
            </div>
            <?= $this->Form->end(); ?>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-8">
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
                                      <a href="javascript:" class="btn btn-sm btn-danger" title="Quitar" onclick="quitar_ajax_sg(<?= $ge['SubcGestione']['id'] ?>);"><i class="fa fa-times"></i></a>
                                  </td>
                              </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
            <br>
        </div>

    </fieldset>
    <div class="form-group form-actions">
        <div class="col-xs-12 text-right">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-sm btn-primary" onclick="enviar_form();">Guardar</button>
        </div>
    </div>

</div>

<!-- END Modal Body -->
<script>

  function enviar_form() {
      $('#ajaxform').find('[type="submit"]').trigger('click');
  }
  var cont_gen = 0;


  function add_gestion() {
      //alert($('#form-gestion').valid());
      if ($('#form-gestion').valid()) {
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

  $("#form-gestion").submit(function (e)
  {
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
                      //data: return data from server
                      //$("#parte").html(data);
                      if ($.parseJSON(data).mensaje != '')
                      {
                          mensaje($.parseJSON(data).mensaje);
                          $('div.modal-body').scrollTo(0, 800);
                      } else {
                          var growlType = 'success';
                          $.bootstrapGrowl('<h4>Excelente!</h4> <p>Se registro todos los datos correctamente!!</p>', {
                              type: growlType,
                              delay: 2500,
                              allow_dismiss: true
                          });
                          cargarmodal('<?= $this->Html->url(array('action' => 'subconcepto', $this->request->data['Subconcepto']['id'])); ?>');
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

  function quitar_ajax_sg(ids) {
      cargarmodal('<?= $this->Html->url(array('action' => 'elimina_subgestion', $this->request->data['Subconcepto']['id'])); ?>/' + ids);
      var growlType = 'success';
      $.bootstrapGrowl('<h4>Excelente!</h4> <p>Se elimino correctamente!!</p>', {
          type: growlType,
          delay: 2500,
          allow_dismiss: true
      });
  }

</script>