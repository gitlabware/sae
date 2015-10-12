<!-- END Blank Header -->
<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de Bancos/Cajas</h2>
    </div>    
    <!-- Example Content -->
    <div class="table-responsive">
        <table id="general-table" class="table table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Numero Cta.</th>
                    <th>Fondo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bancos as $key => $ba): ?>
                  <tr>
                      <td><?php echo $key + 1; ?></td>
                      <td><?php echo $ba['Banco']['codigo_cuenta']; ?></td>
                      <td><?php echo $ba['Banco']['nombre']; ?></td>
                      <td><?php echo $ba['Banco']['numero_cuenta']; ?></td>
                      <td><?php echo $ba['Cuenta']['nombre']?></td>
                      <td class="text-center">
                          <div class="btn-group btn-group-xs">
                              <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'banco', $ba['Banco']['id'])); ?>');" title="Editar Usuario" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                  <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $ba['Banco']['id']), array('class' => 'btn btn-danger', 'title' => 'Eliminar', 'confirm' => 'Esta seguro de eliminar el Banco/caja' . $ba['Banco']['nombre'] . '??', 'escape' => FALSE)) ?>
                          </div>
                      </td>
                  </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
    <!-- END Example Content -->
</div>
<!-- END Example Block -->