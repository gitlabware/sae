<!-- Example Block -->
<div class="row">
    <!-- Interactive Block -->
    <div class="block">
        <!-- Interactive Title -->
        <div class="block-title">
            <div class="block-options pull-right">

                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-success" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Comprobantes', 'action' => 'opciones1')); ?>');" title="Opciones Marcados"><i class="fa fa-tasks"></i></a>
            </div>
            <h2><strong>Listado de Comprobantes</strong></h2>
        </div>
        <?php echo $this->Form->create('Comprobante', array('action' => 'union_comprobantes', 'id' => 'f-comprobantes')); ?>
        <div class="table-responsive">
            <table id="example-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Concepto</th>
                        <th>Recibido de/Pagado a</th>
                        <th>Monto</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comprobantes as $key => $com): ?>

                      <?php
                      $clase = "";
                      if ($com['Comprobante']['tipo'] == 'Ingreso') {
                        $clase = 'success';
                      } elseif ($com['Comprobante']['tipo'] == 'Egreso') {
                        $clase = 'warning';
                      }
                      ?>
                      <tr class="<?php echo $clase; ?> text-center">
                          <td><?php echo $com['Comprobante']['numero']; ?></td>
                          <td><?php echo $com['Comprobante']['fecha'] ?></td>
                          <td><?php echo $com['Comprobante']['tipo'] ?></td>
                          <td><?php echo $com['Comprobante']['concepto'] ?></td>
                          <td><?php echo $com['Comprobante']['nombre'] ?></td>
                          <td><?php echo $com['Comprobante']['monto_total'] ?></td>
                          <td>
                              <?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('action' => 'ver', $com['Comprobante']['id']), array('class' => 'btn btn-info', 'title' => 'Ver Comprobante', 'escape' => FALSE)) ?>
                              <?php echo $this->Html->link('<i class="fa fa-ban"></i>', array('action' => 'anular', $com['Comprobante']['id']), array('class' => 'btn btn-danger', 'title' => 'Anular Comprobante', 'confirm' => 'Esta seguro de anular el comprobante nuemero ' . $com['Comprobante']['numero'] . '??', 'escape' => FALSE)) ?>
                          </td>
                      </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php echo $this->Form->hidden("Comprobante.comprobante_id", array('id' => 's-comprobante-id')) ?>
        <?php echo $this->Form->end(); ?>
        <!-- END Interactive Title -->

    </div>
</div>
