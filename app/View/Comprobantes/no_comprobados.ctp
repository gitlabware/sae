<!-- Example Block -->
<div class="row">
    <!-- Interactive Block -->
    <div class="block">
        <!-- Interactive Title -->
        <div class="block-title">
            <div class="block-options pull-right">

                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-success" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Comprobantes', 'action' => 'opciones1')); ?>');" title="Opciones Marcados"><i class="fa fa-tasks"></i></a>
            </div>
            <h2><strong>Listado de Comprobantes Pendientes (No combrobados)</strong></h2>
        </div>
        <?php echo $this->Form->create('Comprobante', array('action' => 'union_comprobantes', 'id' => 'f-comprobantes')); ?>
        <div class="table-responsive">
            <table id="example-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center"><input type="checkbox" name="marcados" id="marca-todos"></th>
                        <th>Id</th>
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
                          <td>
                              <?php echo $this->Form->hidden("comprobantes.$key.id", array('value' => $com['Comprobante']['id'])) ?>
                              <?php echo $this->Form->hidden("comprobantes.$key.tipo", array('value' => $com['Comprobante']['tipo'])) ?>
                              <?php echo $this->Form->checkbox("comprobantes.$key.marcado") ?>
                          </td>
                          <td><?php echo $com['Comprobante']['id']; ?></td>
                          <td><?php echo $com['Comprobante']['fecha'] ?></td>
                          <td><?php echo $com['Comprobante']['tipo'] ?></td>
                          <td><?php echo $com['Comprobante']['concepto'] ?></td>
                          <td><?php echo $com['Comprobante']['nombre'] ?></td>
                          <td><?php echo $com['Comprobante']['monto_total'] ?></td>
                          <td>
                              <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'comprobante', $com['Comprobante']['id']), array('class' => 'btn btn-info', 'title' => 'Editar', 'escape' => FALSE)) ?>
                              <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $com['Comprobante']['id']), array('class' => 'btn btn-danger', 'title' => 'Eliminar Edificio', 'confirm' => 'Esta seguro de eliminar el comprobante ' . $com['Comprobante']['id'] . '??', 'escape' => FALSE)) ?>
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
