<div class="row">
    <div class="col-md-4">
        <div class="block">
            <div class="block-title">
                <div class="block-options pull-right">
                    <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-content"><i class="fa fa-arrows-v"></i></a>
                </div>
                <h2>Genera Pagos</h2>
            </div>
            <div class="block-content">
                <?php echo $this->Form->create("Ambiente"); ?>
                <div class="form-horizontal form-bordered">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label>Fecha Inicio</label>
                            <?php echo $this->Form->date("Dato.fecha_ini", array('required', 'class' => 'form-control')); ?>
                        </div>
                        <div class="col-md-6">
                            <label>Fecha Fin</label>
                            <?php echo $this->Form->date("Dato.fecha_fin", array('required', 'class' => 'form-control')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label>Tipo</label>
                            <?php echo $this->Form->select("Dato.concepto", $conceptos, array('required', 'class' => 'form-control', 'id' => 'concepto')); ?>
                        </div>
                        <div class="col-md-6">
                            <label>Monto</label>
                            <?php echo $this->Form->text("Dato.monto", ['class' => 'form-control', 'type' => 'number', 'step' => 'any', 'id' => 'monto', 'required']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label>Interes</label>
                            <?php echo $this->Form->text("Dato.interes", ['class' => 'form-control', 'type' => 'number', 'step' => 'any', 'id' => 'monto', 'required', 'max' => 100, 'min' => 0]); ?>
                        </div>
                        <div class="col-md-6">
                            <label>&nbsp;</label>
                            <?php echo $this->Form->submit("Generar", array('class' => 'btn btn-sm btn-primary col-md-12')); ?>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>

        </div>
        <?php echo $this->Form->create('Ambiente', array('action' => 'registra_pagos_mark', 'id' => 'formmarcados')); ?>
        <?php echo $this->Form->hidden('Ambiente.id', array('value' => $ambiente['Ambiente']['id'])) ?>
        <div class="block">
            <div class="block-title">
                <div class="block-options pull-right">
                    <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-content"><i class="fa fa-arrows-v"></i></a>
                </div>
                <h2>Pagar</h2>
            </div>
            <div class="block-content">
                <div class="form-horizontal form-bordered">
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success col-md-12" onclick="$('#formmarcados').submit();">PAGAR MARCADOS</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Active Theme Color Widget Alternative -->
                <div class="widget">
                    <div class="widget-advanced widget-advanced-alt">

                        <!-- Widget Main -->
                        <div class="widget-main">
                            <div class="list-group remove-margin">
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
        <div class="block">
            <!-- Example Title -->
            <div class="block-title">

                <h2>Listado de Pagos por cobrar <?php echo strtoupper("Ambiente " . $ambiente['Ambiente']['nombre'] . ", piso " . $ambiente['Piso']['nombre']); ?></h2>
            </div>
            <!-- Example Content -->

            <div class="table-responsive">
                <table id="example-datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <?php
                                echo $this->Form->checkbox("todos", array('class' => 'form-control', 'id' => 'todos'));
                                ?>
                            </th>
                            <th>Fecha</th>
                            <th>Concepto</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pagos as $key => $pa): ?>
                          <tr>
                              <td class="text-center">
                                  <?php
                                  echo $this->Form->checkbox("Dato.pagos.$key.marca", array('class' => 'form-control marca', 'midato' => $pa['Pago']['monto']));
                                  echo $this->Form->hidden("Dato.pagos.$key.pago_id", array('value' => $pa['Pago']['id']))
                                  ?>
                              </td>
                              <td><?php echo $pa['Pago']['fecha']; ?></td>
                              <td><?php echo $pa['Concepto']['nombre']; ?></td>
                              <td><?php echo $pa['Pago']['monto']; ?></td>
                          </tr>
                        <?php endforeach; ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>TOTAL</td>
                            <td id="tf_total"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <!-- END Example Content -->

        </div>
    </div>
    
</div>
<!-- Example Block -->

<!-- END Example Block -->

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

  $('#todos').click(function () {
      if ($(this).prop('checked')) {
          $('.marca').prop('checked', true);
      } else {
          $('.marca').prop('checked', false);
      }
      suma_mar();
  });

  $('.marca').click(function () {
      suma_mar();
  });

  function suma_mar() {
      var s_total = 0.00;
      var monto = 0.00;
      $('.marca').each(function (i, val) {
          if ($(val).prop('checked')) {
              monto = parseFloat($(val).attr('midato'));
              monto = Math.round(monto * 100) / 100;
              s_total = s_total + monto;
          }
      });
      s_total = Math.round(s_total * 100) / 100;
      $('#tf_total').html(s_total);
      ;
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
</script>