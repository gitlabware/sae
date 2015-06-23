<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de Ambientes</h2>
    </div>    
    <!-- Example Content -->
    <div class="table-responsive">
        <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
            <thead>
                <tr>
                    <th>Ambiente</th>
                    <th>Piso</th>
                    <th>Propietario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ambientes as $am): ?>
                  <tr>
                      <td><?php echo $am['Ambiente']['nombre']; ?></td>
                      <td><?php echo $am['Piso']['nombre']; ?></td>
                      <td><?php echo $am['User']['nombre']; ?></td>
                      <td>
                          <?php echo $this->Html->link("Por cobrar",array('action' => 'xcobrar',$am['Ambiente']['id']),array('class' => 'label label-warning'))?>
                      </td>
                  </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- END Example Content -->
</div>
<!-- END Example Block -->