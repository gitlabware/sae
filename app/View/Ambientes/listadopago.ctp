<?php
App::import('Model', 'Pago');
$Pago = new Pago();
?>
<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Detalle de Pagos</h2>
    </div>
    <center><h1>RECIBO # <?php echo $recibo['Recibo']['numero'] ?></h1></center>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Nombre del Pagador: </label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('Recibo.pagador', array('class' => 'form-control', 'value' => $recibo['Recibo']['pagador'], 'required', 'placeholder' => 'Ingrese el nombre del pagador')); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <b>Fecha: </b>2015-03-17<br />
        </div>
    </div>

    <!-- Example Content -->
    <?php echo $this->Form->create('Ambiente', array('action' => 'recibo/' . $recibo['Recibo']['id'] . '/1')); ?>
    <b>Listado y detalle de pagos </b>
    <div class="table-responsive">
        <table id="general-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Ambiente</th>
                    <th>Concepto</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody> 
                <?php $total = array(); ?>
                <?php foreach ($recibo_m as $key => $rm): ?>
                  <?php
                  $pagos = $Pago->find('all', array(
                    'conditions' => array('Pago.recibo_id' => $recibo['Recibo']['id'], 'Pago.ambiente_id' => $rm['Pago']['ambiente_id'])
                  ));
                  ?>
                  <?php $total[$key] = 0.00; ?>
                  <?php foreach ($pagos as $ik => $man): ?>
                    <tr class="warning">    
                        <td><?php echo $ik+1?></td>
                        <td><a href="javascript:"><?php echo $man['Ambiente']['nombre']; ?></a></td>
                        <td><?php echo $man['Concepto']['nombre']; ?></td>
                        <td>
                            <?php
                            if ($man['Pago']['concepto_id'] == 12) {
                              if ($man['Pago']['porcentaje_interes'] != null) {
                                $man['Pago']['monto_total'] = $man['Pago']['monto_total'] * ($man['Pago']['porcentaje_interes'] / 100);
                              }
                            }
                            ?>
                            <?php echo $man['Pago']['monto_total']; ?>
                        </td>
                        <td><a href="javascript:void(0)" class="label label-warning"><?php echo $man['Pago']['fecha']; ?></a></td>
                        <td class="text-center">
                            <?php echo $man['Pago']['estado']; ?>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-primary" type="button" title="Editar Monto" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'editar_monto', $man['Pago']['id'], $recibo['Recibo']['id'])); ?>');"><i class="gi gi-pencil"></i></button>
                            <?php echo $this->Html->link('<i class="gi gi-remove"></i>', ['action' => 'quita_pago', $man['Pago']['id']], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Esta seguro de quitar pago?', 'escape' => FALSE, 'title' => 'Quitar pago']) ?>
                        </td>
                    </tr>
                    <?php $total[$key] = $total[$key] + $man['Pago']['monto_total']; ?>
                  <?php endforeach; ?>
                  <tr class="info">
                      <td></td>
                      <td></td>
                      <td>TOTAL:</td>
                      <td><?php echo $total[$key]; ?></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr class="success">
                      <?php
                      $saldo = 0.00;
                      if (empty($rm['Ambiente']['saldo'])) {
                        $saldo = 0.00;
                      } else {
                        $saldo = $rm['Ambiente']['saldo'];
                      }
                      ?>
                      <td></td>
                      <td>MONTO: </td>
                      <td><?php echo $this->Form->text("Recibo.ambiente.$key.monto", array('class' => 'form-control submonto', 'id' => 'dato-monto-' . $key, 'value' => $rm['Pago']['monto_tmp'], 'type' => 'number', 'step' => 'any', 'min' => 0, 'required')); ?></td>
                      <td>GUARDAR CAMBIO: </td>
                      <td><?php echo $this->Form->text("Dato.ambiente.$key.cambio", array('class' => 'form-control subcambio', 'id' => 'dato-cambio-' . $key, 'value' => ( round($rm['Pago']['monto_tmp'] + $saldo,2)- round($total[$key],2)), 'type' => 'number', 'step' => 'any', 'required', 'min' => 0)); ?></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <?php echo $this->Form->hidden("Dato.ambiente.$key.ambiente_id", array('value' => $rm['Pago']['ambiente_id'])); ?>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td>MONTO TOTAL: </td>
                    <td><?php echo $this->Form->text("Recibo.monto", array('class' => 'form-control', 'id' => 'dato-monto', 'type' => 'number', 'step' => 'any', 'min' => 0, 'required', 'disabled')); ?></td>
                    <td>CAMBIO TOTAL: </td>
                    <td><?php echo $this->Form->text("Dato.cambio", array('class' => 'form-control', 'id' => 'dato-cambio', 'type' => 'number', 'step' => 'any', 'required', 'min' => 0, 'disabled')); ?></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- END Example Content -->
    <?php //echo $this->Form->create('Ambiente', ['action' => 'recibo/' . $recibo['Recibo']['id'] . '/1']); ?>
    <!--<div class="row">
        <div class="col-md-4">
            <label>Total</label>
    <?php //echo $this->Form->text('Dato.total', ['class' => 'form-control', 'id' => 'idformtotal', 'type' => 'number', 'step' => 'any']); ?>
        </div>
        <div class="col-md-4">
            <label>Cambio</label>
    <?php //echo $this->Form->text('Dato.total', ['class' => 'form-control', 'id' => 'idformtotal', 'type' => 'number', 'step' => 'any']); ?>
        </div>
        <div class="col-md-4">
            <label>&nbsp;</label>
            <div class="checkbox">
                <label for="mantenimiento">
                    <input type="checkbox" id="idformquedcambio" name="data[Dato][quedar_cambio]"> Quedar Cambio
                </label>
            </div>
        </div>
    </div><br>-->
    <div class="row">
        <div class="col-md-4">
            <button class="btn btn-block btn-primary" type="button" onclick="window.location = '<?php echo $this->Html->url(array('controller' => 'Edificios','action' => 'ambientes')); ?>'">Ambientes</button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-block btn-danger" type="button" onclick="if (confirm('Esta seguro de cancelar los pagos de este recibo??')) {
                      window.location = '<?php echo $this->Html->url(array('action' => 'cancelar_pago', $recibo['Recibo']['id'])); ?>';
                  }">Cancelar Pagos</button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-block btn-success" type="submit">Terminar Pago</button>
        </div>
    </div>
    
    <?php echo $this->Form->end(); ?>
</div>
<!-- END Example Block -->

<script>
  var saldo = [];
  var total = [];
<?php foreach ($recibo_m as $key => $rm): ?>
    saldo[<?php echo $key; ?>] = 0.00;
  <?php if (!empty($rm['Ambiente']['saldo'])): ?>
      saldo[<?php echo $key; ?>] = <?php echo $rm['Ambiente']['saldo']; ?>;
  <?php endif; ?>
    total[<?php echo $key ?>] = <?php echo $total[$key]; ?>;

    $('#dato-monto-<?php echo $key; ?>').keyup(function () {
        var valor_monto = parseFloat($(this).val());
        var cambio = valor_monto + saldo[<?php echo $key; ?>] - total[<?php echo $key; ?>];
        $('#dato-cambio-<?php echo $key; ?>').val(Math.round(cambio * 100) / 100);
    });
<?php endforeach; ?>

  function suma_total() {
      var total_t = 0.00;
      var cambio_t = 0.00;
      $('.submonto').each(function (i, val) {
          if ($(val).val() != '') {
              total_t = total_t + parseFloat($(val).val());
          }
      });
      $('.subcambio').each(function (i, val) {
          if ($(val).val() != '') {
              cambio_t = cambio_t + parseFloat($(val).val());
          }
      });
      $('#dato-monto').val(total_t);
      $('#dato-cambio').val(cambio_t);
  }
  suma_total();

  $('.submonto ,.subcambio').keyup(function () {
      suma_total();

  });

</script>