<div class="row">
  <div class="col-md-4">
    <div class="row">
      <div class="col-md-12">
        <button class="btn btn-info btn-block" onclick="cargarmodal('<?= $this->Html->url(array('controller' => 'Ambientes','action' => 'pago',$idAmbiente))?>');">GENERAR UN PAGO</button>
      </div>
    </div><br>
    <div class="card">
      <div class="card-header">

        <span><b>Genera Pagos Mensuales</b></span>
      </div>
      <div class="card-body">
        <?php echo $this->Form->create("Ambiente"); ?>
        <div class="form-horizontal form-bordered">
          <div class="form-group">
            <div class="row">

              <div class="col-md-6">
                <label>Fecha Inicio</label>
                <?php echo $this->Form->date("Dato.fecha_ini", array('required', 'class' => 'form-control')); ?>
              </div>
              <div class="col-md-6">
                <label>Fecha Fin</label>
                <?php echo $this->Form->date("Dato.fecha_fin", array('required', 'class' => 'form-control')); ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">

              <div class="col-md-6">
                <label>Tipo</label>
                <?php echo $this->Form->select("Dato.concepto", $conceptos, array('required', 'class' => 'form-control', 'id' => 'concepto')); ?>
              </div>
              <div class="col-md-6">
                <label>Monto</label>
                <?php echo $this->Form->text("Dato.monto", ['class' => 'form-control', 'type' => 'number', 'step' => 'any', 'id' => 'monto', 'required']); ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">

              <div class="col-md-6">
                <label>Interes</label>
                <?php echo $this->Form->text("Dato.interes", ['class' => 'form-control', 'type' => 'number', 'step' => 'any', 'id' => 'monto', 'required', 'max' => 100, 'min' => 0]); ?>
              </div>
              <div class="col-md-6">
                <label>&nbsp;</label>
                <?php echo $this->Form->submit("Generar", array('class' => 'btn btn-primary col-md-12')); ?>
              </div>
            </div>
          </div>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>

    </div>
    <?php echo $this->Form->create('Ambiente', array('action' => 'registra_pagos_mark', 'id' => 'formpagos')); ?>
    <?php echo $this->Form->hidden('Ambiente.id', array('value' => $ambiente['Ambiente']['id'])) ?>
    <?php echo $this->Form->hidden('Recibo.pagador', array('value' => $ambiente['Representante']['nombre'])) ?>
    <div class="card">
      <div class="card-header">

        <span><b>Pagar</b></span>
      </div>
      <div class="card-body">
        <div class="form-horizontal form-bordered">
          <div class="form-group">
            <div class="row">

              <div class="col-md-12">
                <label>Recibo</label>
                <?php echo $this->Form->select("Recibo.id", $recibos, ['class' => 'form-control', 'empty' => 'Nuevo Recibo']); ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">

              <div class="col-md-6">
                <label>Pago total</label>
                <?php echo $this->Form->text("Dato.total_to", ['class' => 'form-control', 'type' => 'number', 'step' => 'any', 'id' => 'total_to', 'required', 'min' => 0, 'value' => 0]); ?>
              </div>
              <div class="col-md-6">
                <label>Cambio total</label>
                <?php echo $this->Form->text("Dato.cambio_to", ['class' => 'form-control', 'type' => 'number', 'step' => 'any', 'id' => 'cambio_to', 'required', 'min' => 0, 'value' => $ambiente['Ambiente']['saldo']]); ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">

              <div class="col-md-12">
                <button type="submit" class="btn btn-success col-md-12">PAGAR MARCADOS</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php echo $this->Form->end(); ?>

    <div class="row">
      <div class="col-md-12">
        <!-- Advanced Active Theme Color Widget Alternative -->
        <div class="">
          <div class="card">

            <!-- Widget Main -->
            <div class="card-body">
              <div class="">
                <a href="javascript:void(0)" class="list-group-item">
                  <span class="pull-right"><strong id="manteminientoAmbiente"></strong></span>
                  <h4 class="list-group-item-heading remove-margin" onclick="ocultapagos();"> <b>Deuda Mantenimientos</b></h4>
                </a>
                <a href="javascript:" class="list-group-item" onclick="return windowpop('<?php echo $this->Html->url(array('controller' => 'Pagos', 'action' => 'pre_aviso', $idAmbiente, 10)); ?>', 600, 433)">
                  <span class="pull-right"><strong id="manteminientoAmbiente">
                    <?php
                    if (!empty($deuda_tot_man[0][0]['total_alq'])) {
                      echo $deuda_tot_man[0][0]['total_alq'];
                    }
                    ?>
                  </strong></span>
                  <h4 class="list-group-item-heading remove-margin"><i class="fa fa-money fa-fw"></i> <?php echo 'Total Mantenimiento'; ?></h4>
                </a>
                <a href="javascript:void(0)" class="list-group-item">
                  <span class="pull-right"><strong id="manteminientoAmbiente"></strong></span>
                  <h4 class="list-group-item-heading remove-margin" onclick="ocultapagos();"> <b>Deuda Alquileres</b></h4>
                </a>
                <a href="javascript:" class="list-group-item" onclick="return windowpop('<?php echo $this->Html->url(array('controller' => 'Pagos', 'action' => 'pre_aviso', $idAmbiente, 11)); ?>', 600, 433)">
                  <span class="pull-right"><strong id="manteminientoAmbiente">
                    <?php
                    if (!empty($deuda_tot_alq[0][0]['total_alq'])) {
                      echo $deuda_tot_alq[0][0]['total_alq'];
                    }
                    ?>
                  </strong></span>
                  <h4 class="list-group-item-heading remove-margin"><i class="fa fa-money fa-fw"></i> <?php echo 'Total Alquileres'; ?></h4>
                </a>
              </div>

            </div>
            <!-- END Widget Main -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <!-- Example Title -->
      <div class="card-header">

        <h4>Listado de Pagos por cobrar <?php echo strtoupper("Ambiente " . $ambiente['Ambiente']['nombre'] . ", piso " . $ambiente['Piso']['nombre']); ?></h4>
      </div>
      <!-- Example Content -->

      <div class="card-body">
        <?php echo $this->Form->create('Ambiente', array('action' => 'registra_pagos_mark', 'id' => 'formmarcados', 'class' => 'form-horizontal form-bordered')); ?>

        <?php foreach ($gpagos as $key1 => $gp): ?>
          <div class="form-group">
            <div class="row">

              <div class="col-md-12">
                <button class="btn btn-info col-md-12" onclick="$('#gestion-<?php echo $gp[0]['gestion'] ?>').toggle(200);"  style="font-size: 18px; font-weight: bold;" type="button">
                  GESTION <?php echo $gp[0]['gestion'] ?>
                  -- (TOTAL: 
                  <span id="tf_total-<?php echo $gp[0]['gestion'] ?>" class="p_total">
                    0
                  </span>
                  )
                </button>
                <div class="table-responsive">
                  <table class="table table-bordered" id="gestion-<?php echo $gp[0]['gestion'] ?>" style="display:none;">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 5%;">
                          <?php
                          echo $this->Form->checkbox("todos", array('class' => ' todos-' . $gp[0]['gestion']));
                          ?>
                        </th>
                        <th>Fecha</th>
                        <th>Concepto</th>
                        <th>Monto</th>
                        <th style="width: 15%;">
                          <?php
                          echo $this->Form->text("todos_retencion", array('min' => 0, 'class' => 'form-control', 'type' => 'number', 'step' => 'any', 'id' => 'ret_todos-' . $gp[0]['gestion'], 'placeholder' => 'Retencion', ''));
                          ?>
                        </th>

                        <th>M. total</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $pagos = $this->requestAction(array('action' => 'get_pagos_ges', $ambiente['Ambiente']['id'], $gp[0]['gestion']));
                      ?>
                      <?php foreach ($pagos as $key => $pa): ?>
                        <tr>
                          <td class="text-center">
                            <?php
                            echo $this->Form->checkbox("Dato.gestion.$key1.pagos.$key.marca", array('class' => ' marca-' . $gp[0]['gestion'], 'midato' => $pa['Pago']['monto'], 'idret' => 'retencion-' . $pa['Pago']['id']));
                            echo $this->Form->hidden("Dato.gestion.$key1.pagos.$key.pago_id", array('value' => $pa['Pago']['id']))
                            ?>
                          </td>
                          <td><?php echo $pa['Pago']['fecha']; ?></td>
                          <td class="warning"><?php echo $pa['Concepto']['nombre']; ?></td>
                          <td><?php echo $pa['Pago']['monto']; ?></td>
                          <td>
                            <?php
                            $retencion_aux = 0.00;
                            if ($pa['Pago']['concepto_id'] == 10) {
                              $retencion_aux = $edificio['Edificio']['retencion_mantenimiento'];
                              echo $this->Form->text("Dato.gestion.$key1.pagos.$key.retencion", array('value' => $edificio['Edificio']['retencion_mantenimiento'], 'min' => 0, 'class' => 'form-control reten-' . $gp[0]['gestion'], 'type' => 'number', 'step' => 'any', 'id' => 'retencion-' . $pa['Pago']['id'], 'onkeyup' => 'suma_mar(' . $gp[0]['gestion'] . ');'));
                            } elseif ($pa['Pago']['concepto_id'] == 11) {
                              $retencion_aux = $edificio['Edificio']['retencion_alquiler'];
                              echo $this->Form->text("Dato.gestion.$key1.pagos.$key.retencion", array('value' => $edificio['Edificio']['retencion_alquiler'], 'min' => 0, 'class' => 'form-control reten-' . $gp[0]['gestion'], 'type' => 'number', 'step' => 'any', 'style' => 'width: 80px;', 'id' => 'retencion-' . $pa['Pago']['id'], 'onkeyup' => 'suma_mar(' . $gp[0]['gestion'] . ');'));
                            }
                            ?>
                          </td>
                          <td class="success">
                            <?php echo ($pa['Pago']['monto'] + (($retencion_aux / 100) * $pa['Pago']['monto'])); ?>
                          </td>
                          <td>
                            <button class="btn btn-success btn-sm" title="Editar monto de este Pago" type="button" onclick="cargarmodal('<?= $this->Html->url(array('controller' => 'Pagos', 'action' => 'edit_monto', $pa['Pago']['id'])) ?>');"><i class="fa fa-edit"></i></button> 
                            <?= $this->Html->link('<i class="fa fa-remove"></i>', array('controller' => 'Pagos', 'action' => 'eliminar', $pa['Pago']['id']), array('class' => 'btn btn-danger btn-sm', 'confirm' => 'Esta seguro de eliminar el pago??', 'escape' => FALSE)) ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>

                    </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div>
          <?php $this->append('campo_js')?>
          <script>

            $('.todos-<?php echo $gp[0]['gestion']; ?>').click(function () {
              if ($(this).prop('checked')) {
                $('.marca-<?php echo $gp[0]['gestion']; ?>').prop('checked', true);
              } else {
                $('.marca-<?php echo $gp[0]['gestion']; ?>').prop('checked', false);
              }
              suma_mar(<?php echo $gp[0]['gestion']; ?>);
            });

            $('.marca-<?php echo $gp[0]['gestion']; ?>').click(function () {
              suma_mar(<?php echo $gp[0]['gestion']; ?>);
            });
            $('#ret_todos-<?php echo $gp[0]['gestion']; ?>').keyup(function () {
              $('.reten-<?php echo $gp[0]['gestion']; ?>').val($('#ret_todos-<?php echo $gp[0]['gestion']; ?>').val());
              suma_mar(<?php echo $gp[0]['gestion']; ?>);
            });
          </script>
          <?php $this->end() ?>
        <?php endforeach; ?>
        <?php echo $this->Form->end(); ?>
      </div>
      <!-- END Example Content -->
    </div>
  </div>

</div>
<!-- Example Block -->

<!-- END Example Block -->
<?php $this->start('campo_js')?>
<script>
  var conceptos = [];
  <?php foreach ($conceptos_mon as $key => $co): ?>
  conceptos[<?php echo $key ?>] = <?php echo $co; ?>;
  <?php endforeach; ?>

  $('#concepto').change(function () {
    var monto = conceptos[$(this).val()];
    $('#monto').val(monto);
  });
</script>

<script>

  var saldo_c = $('#cambio_to').val();

  function suma_mar(gestion) {
    var s_total = 0.00;
    var monto = 0.00;
    var retencion = 0.00;
    $('.marca-' + gestion).each(function (i, val) {
      if ($(val).prop('checked')) {
        monto = parseFloat($(val).attr('midato'));

        monto = Math.round(monto * 100) / 100;
        if ($('#' + $(val).attr('idret')).val() !== undefined && $('#' + $(val).attr('idret')).val() !== '') {
          retencion = parseFloat($('#' + $(val).attr('idret')).val());
          retencion = (Math.round(retencion * 100) / 100) / 100;
        }

        s_total = s_total + monto + (monto * retencion);
      }
    });
    s_total = Math.round(s_total * 100) / 100;
    $('#tf_total-' + gestion).html(s_total);
    ;
    suma_total();
  }

  function suma_total() {
    var s_total = 0.00;
    var monto = 0.00;
    $('.p_total').each(function (i, val) {
      if ($(val).html() != '') {
        monto = parseFloat($(val).html());
        monto = Math.round(monto * 100) / 100;
        s_total = s_total + monto;
      }
    });
      //alert(s_total);

      //alert(saldo_c);
      var saldo_aux = saldo_c;
      if (saldo_aux <= s_total) {
        s_total = s_total - saldo_aux;
        saldo_aux = 0.00;
      } else {
        saldo_aux = saldo_aux - s_total;
        s_total = 0.00;
      }
      saldo_aux = Math.round(saldo_aux * 100) / 100;
      s_total = Math.round(s_total * 100) / 100;
      $('#cambio_to').val(saldo_aux);
      $('#total_to').val(s_total);
    }



    function windowpop(url, width, height) {
      var leftPosition, topPosition;
      //Allow for borders.
      leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
      //Allow for title and status bars.
      topPosition = (window.screen.height / 2) - ((height / 2) + 50);
      //Open the window.
      window.open(url, "Window2", "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no");
    }

    $('#formpagos').submit(function (e) {
      $('#formmarcados :input').not(':submit').clone().hide().appendTo('#formpagos');
    });


  </script>
  <?php $this->end() ?>