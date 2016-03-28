
<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de Presupuestos</h2>
    </div>
    <!-- END Example Title -->
    <div class="table-options clearfix">
        <div class="btn-group btn-group-sm pull-right">
            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'gestion')); ?>');" class="btn btn-primary" title="Adicionar nuevo Usuario">NUEVO</a>
        </div>
    </div>
    <!-- Example Content -->
    <div class="table-responsive" style="font-size: 20px;">
        <table id="general-table" class="table table-striped">
            <thead>
                <tr class="warning">
                    <th>Gestion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($presupuestos as $pre): ?>
                  <tr class="success">
                      <td><?php echo $pre['Presupuesto']['gestion']; ?></td>
                      <td class="text-center">
                          <a href="<?php echo $this->Html->url(array('action' => 'presupuesto', $pre['Presupuesto']['id'])); ?>" title="Editar" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                              <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $pre['Presupuesto']['id']), array('class' => 'btn btn-danger', 'title' => 'Eliminar Edificio', 'confirm' => 'Esta seguro de eliminar al edificio ' . $pre['Presupuesto']['gestion'] . '??', 'escape' => FALSE)) ?>
                      </td>
                  </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- END Example Content -->
</div>
<!-- END Example Block -->