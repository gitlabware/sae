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
    <b>Propietario: </b><?php echo $recibo['Propietario']['nombre'] ?><br />
    <?php if (!empty($recibo['Recibo']['inquilino_id'])): ?>
      <b>Pagador: </b><?php echo $recibo['Inquilino']['User']['nombre'] ?><br />
    <?php else: ?>
      <b>Pagador: </b><?php echo $recibo['Propietario']['nombre'] ?><br />
    <?php endif; ?>
    <b>Fecha: </b>2015-03-17<br />
    <p>&nbsp;</p>
    <?php
    $pagos = $Pago->find('all', array(
      'conditions' => array('Pago.recibo_id' => $recibo['Recibo']['id'])
    ));
    ?>
    <!-- Example Content -->
    <?php echo $this->Form->create('Ambiente', array('action' => 'recibo/' . $recibo['Recibo']['id'] . '/1')); ?>
    <b>Listado y detalle de pagos </b>
    <div class="table-responsive">
        <table id="general-table" class="table table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    <th>Ambiente</th>
                    <th>Concepto</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody> 
                <?php $total = 0.00; ?>
                <?php foreach ($pagos as $man): ?>
                  <tr>                                        
                      <td><a href="page_ready_user_profile.html"><?php echo $man['Ambiente']['nombre']; ?></a></td>
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
                  <?php $total = $total + $man['Pago']['monto_total']; ?>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td>TOTAL:</td>
                    <td><?php echo $total; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <?php
                    $saldo = 0.00;
                    if (empty($ambiente['Ambiente']['saldo'])) {
                      $saldo = 0.00;
                    } else {
                      $saldo = $ambiente['Ambiente']['saldo'];
                    }
                    ?>
                    <td>MONTO: </td>
                    <td><?php echo $this->Form->text('Recibo.monto', array('class' => 'form-control', 'id' => 'dato-monto', 'value' => $monto_tmp, 'type' => 'number', 'step' => 'any', 'min' => 0, 'required')); ?></td>
                    <td>GUARDAR CAMBIO: </td>
                    <td><?php echo $this->Form->text('Dato.cambio', array('class' => 'form-control', 'id' => 'dato-cambio', 'value' => ($monto_tmp + $saldo - round($total,2)), 'type' => 'number', 'step' => 'any', 'required')); ?></td>
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
            <button class="btn btn-block btn-primary" type="button" onclick="window.location = '<?php echo $this->Html->url(array('action' => 'buscador')); ?>'">Ir a pagos</button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-block btn-danger" type="button" onclick="if (confirm('Esta seguro de cancelar los pagos de este recibo??')) {
                      window.location = '<?php echo $this->Html->url(array('action' => 'cancelar_pago', $recibo['Recibo']['id'])); ?>'
                  }">Cancelar Pagos</button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-block btn-success" type="submit">Terminar Pago</button>
        </div>
    </div>
    <?php echo $this->Form->hidden('Dato.ambiente_id', array('value' => $idAmbiente)); ?>
    <?php echo $this->Form->end(); ?>
</div>
<!-- END Example Block -->

<script>
  var saldo = 0.00;
<?php if (!empty($ambiente['Ambiente']['saldo'])): ?>
    saldo = <?php echo $ambiente['Ambiente']['saldo']; ?>;
<?php endif; ?>
  var total = <?php echo $total; ?>;
  $('#dato-monto').keyup(function () {
      var valor_monto = parseFloat($(this).val());
      var cambio = valor_monto + saldo - total;
      $('#dato-cambio').val(Math.round(cambio * 100) / 100);
  });
</script>