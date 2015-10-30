
<div class="block">
    <h3 class="text-center">EDIFICIO <?php echo strtoupper($presupuesto['Edificio']['nombre']); ?></h3>
    <h2 class="text-center">PLAN ANUAL OPERATIVO <?= $presupuesto['Presupuesto']['gestion'] ?></h2>
    <h2 class="text-center text-success page-header">INGRESOS</h2>
    <div class="form-horizontal form-bordered">
        <?php echo $this->Form->create('Presupuesto', array('action' => 'guarda_ingreso', $presupuesto['Presupuesto']['id'], 'id' => 'form-ingresos')); ?>
        <?php echo $this->Form->hidden('Ingreso.presupuesto_id', array('value' => $presupuesto['Presupuesto']['id'])); ?>
        <div class="form-group">
            <div class="col-md-3">
                <div id="concepto-select">
                    <label>Concepto ingreso 
                        <a href="javascript:" class="label label-primary" onclick="cargarmodal('<?= $this->Html->url(array('controller' => 'Conceptos', 'action' => 'subconcepto')) ?>');">Nuevo</a> 
                        <a href="javascript:" class="label label-warning" id="gene-x-ambiente" onclick="ir_pre_ambientes();">Generar</a>
                    </label>
                    <?php echo $this->Form->select('Ingreso.subconcepto_id', $subconceptos, array('class' => 'form-control f-subconcepto', 'empty' => 'Seleccione el sub-concepto', 'required', 'id' => 'sel-subconcepto')); ?>
                </div>
                <div id="d_ajax_ges">
                </div>
            </div>
            <div class="col-md-1">
                <label>%</label>
                <?php echo $this->Form->text('Ingreso.porcentaje', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'max' => 1, 'placeholder' => '0.00', 'id' => 'c-porcentaje')); ?>
            </div>
            <div class="col-md-2">
                <label>Ingreso anual</label>
                <?php echo $this->Form->text('Ingreso.ingreso', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00', 'id' => 'c-ingreso')); ?>
            </div>
            <div class="col-md-2">
                <label>Presupuesto anterior</label>
                <?php echo $this->Form->text('Ingreso.pres_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
            <div class="col-md-2">
                <label>Ejecutado anterior</label>
                <?php echo $this->Form->text('Ingreso.ejec_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
            <div class="col-md-2">
                <label>Presupuesto</label>
                <?php echo $this->Form->text('Ingreso.presupuesto', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00', 'id' => 'c-presupuesto')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <button class="btn btn-alt btn-primary col-md-12" type="submit">REGISTRAR</button>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter table-condensed table-bordered dataTable no-footer">
            <thead>
                <tr>
                    <th>Detalle Ingresos</th>
                    <th>%</th>
                    <th>Ingreso Anual</th>
                    <th>Presupuesto Anterior</th>
                    <th>Ejecutado Anterior</th>
                    <th>Presupuesto</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tot_i['ingreso'] = 0.00;
                $tot_i['pres_anterior'] = 0.00;
                $tot_i['ejec_anterior'] = 0.00;
                $tot_i['presupuesto'] = 0.00;
                ?>
                <?php foreach ($tingresos as $tin): ?>
                  <?php
                  $tot_i['ingreso'] = $tot_i['ingreso'] + $tin[0]['ingreso'];
                  $tot_i['pres_anterior'] = $tot_i['pres_anterior'] + $tin[0]['pres_anterior'];
                  $tot_i['ejec_anterior'] = $tot_i['ejec_anterior'] + $tin[0]['ejec_anterior'];
                  $tot_i['presupuesto'] = $tot_i['presupuesto'] + $tin[0]['presupuesto'];
                  ?>
                  <tr class="text-success text-uppercase success" style="font-weight: bold; font-size: 15px;">
                      <td><?php echo $tin['Subconcepto']['tipo'] ?></td>
                      <td></td>
                      <td><?php echo $tin[0]['ingreso'] ?></td>
                      <td><?php echo $tin[0]['pres_anterior'] ?></td>
                      <td><?php echo $tin[0]['ejec_anterior'] ?></td>
                      <td><?php echo $tin[0]['presupuesto'] ?></td>
                      <td></td>
                  </tr>
                  <?php
                  $ingresos = $this->requestAction(array('action' => 'get_ingresos', $presupuesto['Presupuesto']['id'], $tin['Subconcepto']['tipo']));
                  ?>
                  <?php foreach ($ingresos as $in): ?>
                    <tr>
                        <td>
                            <?php
                            if (!empty($in['Subconcepto']['nombre'])) {
                              echo $in['Subconcepto']['nombre'];
                            } else {
                              echo $in['Concepto']['nombre'];
                            }
                            ?>
                        </td>
                        <td><?php echo $in['Ingreso']['porcentaje'] ?></td>
                        <td><?php echo $in['Ingreso']['ingreso'] ?></td>
                        <td><?php echo $in['Ingreso']['pres_anterior'] ?></td>
                        <td><?php echo $in['Ingreso']['ejec_anterior'] ?></td>
                        <td><?php echo $in['Ingreso']['presupuesto'] ?></td>
                        <td>
                            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ingreso', $in['Ingreso']['id'])) ?>');" class="btn btn-sm btn-primary" title="Editar"><i class="gi gi-edit"></i></a> 
                            <?php echo $this->Html->link('<i class="gi gi-remove_2"></i>', array('action' => 'elimina_ingreso', $in['Ingreso']['id']), array('class' => 'btn btn-sm btn-danger', 'title' => 'Eliminar', 'confirm' => 'Esta seguro de eliminar el ingreso??', 'escape' => FALSE)) ?>
                        </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endforeach; ?>
                <tr class="text-uppercase" style="font-weight: bold; font-size: 15px;">
                    <td>TOTAL GENERAL INGRESOS</td>
                    <td></td>
                    <td><?php echo $tot_i['ingreso'] ?></td>
                    <td><?php echo $tot_i['pres_anterior'] ?></td>
                    <td><?php echo $tot_i['ejec_anterior'] ?></td>
                    <td><?php echo $tot_i['presupuesto'] ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <h2 class="text-center text-warning page-header">EGRESOS</h2>
    <div class="form-horizontal form-bordered">
        <?php echo $this->Form->create('Presupuesto', array('action' => 'guarda_egreso', $presupuesto['Presupuesto']['id'])); ?>
        <?php echo $this->Form->hidden('Egreso.presupuesto_id', array('value' => $presupuesto['Presupuesto']['id'])); ?>
        <div class="form-group">

            <div class="col-md-6">
                <div id="gasto-select">
                    <label>Gasto egreso <a href="javascript:" class="label label-primary" onclick="muestra_form_c_g();">Nuevo</a></label>
                    <?php echo $this->Form->select('Egreso.subgasto_id', $subgastos, array('class' => 'form-control f-subgasto', 'empty' => 'Seleccione el sub-gasto', 'required')); ?>
                </div>
                <div id="gasto-form" style="background-color: gainsboro; display: none;">

                    <div class="form-group">
                        <div class="col-md-12">
                            <div id="c_gasto_t_g" style="display: none;">
                                <label>Gasto <a href="javascript:" onclick="muestra_c_gasto_s_g();" class="label label-success">Seleccionar</a> <a href="javascript:" onclick="muestra_select_c_g();" class="label label-primary">Seleccionar sub-gasto</a></label>
                                <?php echo $this->Form->text('Egreso.nombre_gasto', array('class' => 'form-control c-gasto-t-g', 'placeholder' => 'Ingrese el gasto')); ?>
                            </div>
                            <div id="c_gasto_s_g">
                                <label>Tipo <a href="javascript:" onclick="muestra_c_gasto_t_g();" class="label label-success">Nuevo</a> <a href="javascript:" onclick="muestra_select_c_g();" class="label label-primary">Seleccionar sub-gasto</a></label>
                                <?php echo $this->Form->select('Egreso.gasto_id', $gastos, array('class' => 'form-control f-n-gasto c-gasto-s-g', 'empty' => 'Seleccione el gasto')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div id="c_tipo_t_g" style="display: none;">
                                <label>Tipo <a href="javascript:" onclick="muestra_c_tipo_s_g();" class="label label-success">Seleccionar</a></label>
                                <?php echo $this->Form->text('Egreso.nombre_tipo', array('class' => 'form-control c-tipo-t-g', 'placeholder' => 'Ingrese el tipo')); ?>
                            </div>
                            <div id="c_tipo_s_g">
                                <label>Tipo <a href="javascript:" onclick="muestra_c_tipo_t_g();" class="label label-success">Nuevo</a></label>
                                <?php echo $this->Form->select('Egreso.tipo', $gtipos, array('class' => 'form-control f-n-gasto c-tipo-s-g', 'empty' => 'Seleccione el tipo')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Nombre Sub-Gasto</label>
                            <?php echo $this->Form->text('Egreso.nombre_subgasto', array('class' => 'form-control f-n-gasto', 'placeholder' => 'Ingrese nombre del subgasto')); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <label>Presupuesto anterior</label>
                <?php echo $this->Form->text('Egreso.pres_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
            <div class="col-md-2">
                <label>Ejecutado anterior</label>
                <?php echo $this->Form->text('Egreso.ejec_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
            <div class="col-md-2">
                <label>Presupuesto</label>
                <?php echo $this->Form->text('Egreso.presupuesto', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <button class="btn btn-alt btn-primary col-md-12" type="submit">REGISTRAR</button>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter table-condensed table-bordered dataTable no-footer">
            <thead>
                <tr>
                    <th>Detalle Egresos</th>
                    <th>Presupuesto Anterior</th>
                    <th>Ejecutado Anterior</th>
                    <th>Presupuesto</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tot_e['pres_anterior'] = 0.00;
                $tot_e['ejec_anterior'] = 0.00;
                $tot_e['presupuesto'] = 0.00;
                ?>
                <?php foreach ($pgastos as $gas): ?>
                  <tr class="text-info text-uppercase info" style="font-weight: bold; font-size: 15px;">
                      <td><?php echo $gas['Gasto']['nombre'] ?></td>

                      <td><?php echo $gas[0]['pres_anterior'] ?></td>
                      <td><?php echo $gas[0]['ejec_anterior'] ?></td>
                      <td><?php echo $gas[0]['presupuesto'] ?></td>
                      <td></td>
                  </tr>
                  <?php
                  $tegresos = $this->requestAction(array('action' => 'get_tegresos', $presupuesto['Presupuesto']['id'], $gas['Gasto']['id']));
                  ?>
                  <?php foreach ($tegresos as $teg): ?>
                    <?php
                    $tot_e['pres_anterior'] = $tot_e['pres_anterior'] + $teg[0]['pres_anterior'];
                    $tot_e['ejec_anterior'] = $tot_e['ejec_anterior'] + $teg[0]['ejec_anterior'];
                    $tot_e['presupuesto'] = $tot_e['presupuesto'] + $teg[0]['presupuesto'];
                    ?>
                    <tr class="text-warning text-uppercase warning" style="font-weight: bold; font-size: 15px;">
                        <td><?php echo $teg['Subgasto']['tipo'] ?></td>
                        <td><?php echo $teg[0]['pres_anterior'] ?></td>
                        <td><?php echo $teg[0]['ejec_anterior'] ?></td>
                        <td><?php echo $teg[0]['presupuesto'] ?></td>
                        <td></td>
                    </tr>
                    <?php
                    $egresos = $this->requestAction(array('action' => 'get_egresos', $presupuesto['Presupuesto']['id'], $gas['Gasto']['id'], $teg['Subgasto']['tipo']));
                    ?>
                    <?php foreach ($egresos as $eg): ?>
                      <tr>
                          <td>
                              <?php
                              if (!empty($eg['Subgasto']['nombre'])) {
                                echo $eg['Subgasto']['nombre'];
                              } else {
                                echo $eg['Gasto']['nombre'];
                              }
                              ?>
                          </td>
                          <td><?php echo $eg['Egreso']['pres_anterior'] ?></td>
                          <td><?php echo $eg['Egreso']['ejec_anterior'] ?></td>
                          <td><?php echo $eg['Egreso']['presupuesto'] ?></td>
                          <td>
                              <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'egreso', $eg['Egreso']['id'])) ?>');" class="btn btn-sm btn-primary" title="Editar"><i class="gi gi-edit"></i></a> 
                              <?php echo $this->Html->link('<i class="gi gi-remove_2"></i>', array('action' => 'elimina_egreso', $eg['Egreso']['id']), array('class' => 'btn btn-sm btn-danger', 'title' => 'Eliminar', 'confirm' => 'Esta seguro de eliminar el Egreso??', 'escape' => FALSE)) ?>
                          </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                <?php endforeach; ?>
                <tr class="text-uppercase" style="font-weight: bold; font-size: 15px;">
                    <td>TOTAL EGRESOS</td>
                    <td><?php echo $tot_e['pres_anterior'] ?></td>
                    <td><?php echo $tot_e['ejec_anterior'] ?></td>
                    <td><?php echo $tot_e['presupuesto'] ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>


</div>
<script>

  //---------------- INGRESOS --------------//
  /*function muestra_form_c() {
   $('#concepto-select').toggle(400);
   $('#concepto-form').toggle(400);
   $('.f-n-concepto').each(function (i, val) {
   $(val).prop('required', true);
   });
   $('.f-subconcepto').each(function (i, val) {
   $(val).prop('required', false).val('');
   });
   }
   function muestra_select_c() {
   $('#concepto-select').toggle(400);
   $('#concepto-form').toggle(400);
   $('.f-n-concepto').each(function (i, val) {
   $(val).prop('required', false).val('');
   });
   $('.f-subconcepto').each(function (i, val) {
   $(val).prop('required', true);
   });
   }
   function muestra_c_tipo_t() {
   $('#c_tipo_s').toggle(400);
   $('#c_tipo_t').toggle(400);
   $('.c-tipo-t').each(function (i, val) {
   $(val).prop('required', true);
   });
   $('.c-tipo-s').each(function (i, val) {
   $(val).prop('required', false).val('');
   });
   }
   function muestra_c_tipo_s() {
   $('#c_tipo_t').toggle(400);
   $('#c_tipo_s').toggle(400);
   $('.c-tipo-t').each(function (i, val) {
   $(val).prop('required', false).val('');
   });
   $('.c-tipo-s').each(function (i, val) {
   $(val).prop('required', true);
   });
   }*/


  $('#sel-subconcepto').change(function () {
      $('#d_ajax_ges').load('<?= $this->Html->url(array('controller' => 'Conceptos', 'action' => 'ajax_subges')) ?>/' + $('#sel-subconcepto').val());
  });

  var porcentaje = 0.00;
  var ingreso = 0.00;
  var presupuesto = 0.00;
  $('#c-porcentaje').keyup(function () {
      if ($('#c-porcentaje').val() != '') {
          porcentaje = parseFloat($('#c-porcentaje').val());
      } else {
          porcentaje = 0.00;
      }
      presupuesto = Math.round(porcentaje * ingreso * 100) / 100;
      $('#c-presupuesto').val(presupuesto);
  });
  $('#c-ingreso').keyup(function () {
      if ($('#c-ingreso').val() != '') {
          ingreso = parseFloat($('#c-ingreso').val());
      } else {
          ingreso = 0.00;
      }
      presupuesto = Math.round(porcentaje * ingreso * 100) / 100;
      $('#c-presupuesto').val(presupuesto);
  });
  //--------------- TERMINA INGRESOS ----------- //

  //---------------- EGRESOS --------------------//
  function muestra_form_c_g() {
      $('#gasto-select').hide(400);
      $('#gasto-form').show(400);
      $('.f-n-gasto').each(function (i, val) {
          $(val).prop('required', true);
      });
      $('.f-subgasto').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
  }
  function muestra_select_c_g() {
      $('#gasto-select').show(400);
      $('#gasto-form').hide(400);
      $('.f-n-gasto').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
      $('.f-subgasto').each(function (i, val) {
          $(val).prop('required', true);
      });
      muestra_c_tipo_s_g();
      muestra_c_gasto_s_g();
  }
  function muestra_c_tipo_t_g() {
      $('#c_tipo_s_g').hide(400);
      $('#c_tipo_t_g').show(400);
      $('.c-tipo-t-g').each(function (i, val) {
          $(val).prop('required', true);
      });
      $('.c-tipo-s-g').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
  }
  function muestra_c_tipo_s_g() {
      $('#c_tipo_t_g').hide(400);
      $('#c_tipo_s_g').show(400);
      $('.c-tipo-t-g').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
      $('.c-tipo-s-g').each(function (i, val) {
          $(val).prop('required', true);
      });
  }
  function muestra_c_gasto_t_g() {
      $('#c_gasto_s_g').hide(400);
      $('#c_gasto_t_g').show(400);
      $('.c-gasto-t-g').each(function (i, val) {
          $(val).prop('required', true);
      });
      $('.c-gasto-s-g').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
  }
  function muestra_c_gasto_s_g() {
      $('#c_gasto_t_g').hide(400);
      $('#c_gasto_s_g').show(400);
      $('.c-gasto-t-g').each(function (i, val) {
          $(val).prop('required', false).val('');
      });
      $('.c-gasto-s-g').each(function (i, val) {
          $(val).prop('required', true);
      });
  }
  function ir_pre_ambientes() {
      subges = $('#sel-subges').val();
      subconcepto = $('.f-subconcepto').val();
      window.location.href = '<?= $this->Html->url(array('action' => 'pre_ambientes', $presupuesto['Presupuesto']['id'])); ?>/' + subconcepto + '/' + subges;
  }
  /*$('.f-subconcepto').change(function () {
   
   var postData = $("#form-ingresos").serializeArray();
   var formURL = '<?= $this->Html->url(array('action' => 'get_ing_anu')); ?>';
   $.ajax(
   {
   url: formURL,
   type: "POST",
   data: postData,
   success: function (data, textStatus, jqXHR)
   {
   console.log($.parseJSON(data).sub);
   if (data == 1) {
   alert("si");
   $('#gene-x-ambiente').attr('href', '<?= $this->Html->url(array('action' => 'pre_ambientes')); ?>/' + $.parseJSON(data).sub);
   } else {
   $('#gene-x-ambiente').attr('href', '<?= $this->Html->url(array('action' => 'pre_ambientes')); ?>/' + $.parseJSON(data).sub);
   }
   //$('#c-ingreso').val($.parseJSON(data).monto);
   //data: return data from server
   //$("#parte").html(data);
   }
   });
   
   });*/
  //-------------------- TERMINA EGRESOS -------------------//
</script>