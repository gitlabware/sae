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
                </tr>
            </thead>
            <tbody> 
                <?php $total = 0.00;?>
                <?php foreach ($pagos as $man): ?>
                  <tr>                                        
                      <td><a href="page_ready_user_profile.html"><?php echo $man['Ambiente']['nombre']; ?></a></td>
                      <td><?php echo $man['Concepto']['nombre'];?></td>
                      <td><?php echo $man['Pago']['monto']; ?></td>
                      <td><a href="javascript:void(0)" class="label label-warning"><?php echo $man['Pago']['fecha']; ?></a></td>
                      <td class="text-center">
                          <?php echo $man['Pago']['estado'];?>
                      </td>
                  </tr>
                  <?php $total = $total + $man['Pago']['monto'];?>
                <?php endforeach; ?>
                  <tr>
                      <td></td>
                      <td>TOTAL:</td>
                      <td><?php echo $total;?></td>
                      <td></td>
                      <td></td>
                  </tr>
            </tbody>
        </table>
    </div>
    <!-- END Example Content -->
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-block btn-primary" type="button" onclick="window.location = '<?php echo $this->Html->url(array('action' => 'buscador'));?>'">Ir a pagos</button>
        </div>
        <div class="col-md-6">
            <button class="btn btn-block btn-success" type="button" onclick="window.location = '<?php echo $this->Html->url(array('action' => 'recibo',$recibo['Recibo']['id'],1));?>'">Terminar Pago</button>
        </div>
    </div>
</div>
<!-- END Example Block -->