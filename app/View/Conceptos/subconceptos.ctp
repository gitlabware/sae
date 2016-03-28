<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de Sub-conceptos</h2>
    </div>    
    <!-- Example Content -->
    <div class="table-responsive">
        <table id="general-table" class="table table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    <th>Subconcepto</th>
                    <th>Concepto</th>
                    <th>Tipo</th>
                    <th>Quitar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subconceptos as $sub): ?>
                  <tr>
                      <td><?php echo $sub['Subconcepto']['nombre'] ?></td>
                      <td><?php echo $sub['Concepto']['nombre'] ?></td>
                      <td><?php echo $sub['Subconcepto']['tipo'] ?></td>
                      <td>
                          <a class="btn btn-info" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'subconcepto', $sub['Subconcepto']['id'])); ?>');"> <i class="gi gi-edit"></i> </a>  
                          <?php echo $this->Html->link('<i class="gi gi-circle_remove"></i>', array('action' => 'eliminar_subconcepto', $sub['Subconcepto']['id']), array('class' => 'btn btn-danger', 'escape' => FALSE, 'confirm' => 'Esta seguro de quitar el subconcepto!!', 'title' => 'Quitar subconcepto')) ?> 

                      </td>
                  </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- END Example Content -->
</div>
