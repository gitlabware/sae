<!-- Example Block -->
<div class="row">
    <!-- Interactive Block -->
    <div class="block">
        <!-- Interactive Title -->
        <div class="block-title">
            <h2><strong>Listado de Comprobantes Pendientes (No combrobados)</strong></h2>

        </div>
        <div class="table-responsive">
            <table id="example-datatable" class="table table-bordered">
                <thead>
                    <tr>
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
                    <?php foreach ($comprobantes as $com): ?>

                      <?php
                      $clase = "";
                      if ($com['Comprobante']['tipo'] == 'Ingreso') {
                        $clase = 'class="success"';
                      }elseif ($com['Comprobante']['tipo'] == 'Egreso') {
                        $clase = 'class="warning"';
                      }
                      ?>
                      <tr <?php echo $clase; ?>>
                          <td><?php echo $com['Comprobante']['id']; ?></td>
                          <td><?php echo $com['Comprobante']['fecha'] ?></td>
                          <td><?php echo $com['Comprobante']['tipo'] ?></td>
                          <td><?php echo $com['Comprobante']['concepto'] ?></td>
                          <td><?php echo $com['Comprobante']['nombre'] ?></td>
                          <td><?php echo $com['Comprobante']['monto_total'] ?></td>
                          <td>
                              <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'eliminar', $com['Comprobante']['id']), array('class' => 'btn btn-info', 'title' => 'Editar', 'escape' => FALSE)) ?>
                              <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $com['Comprobante']['id']), array('class' => 'btn btn-danger', 'title' => 'Eliminar Edificio', 'confirm' => 'Esta seguro de eliminar el comprobante ' . $com['Comprobante']['id'] . '??', 'escape' => FALSE)) ?>
                          </td>
                      </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- END Interactive Title -->

    </div>
</div>
