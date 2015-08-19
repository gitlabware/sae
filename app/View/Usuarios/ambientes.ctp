<!-- END Blank Header -->
<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Ambientes del usuario</h2>
    </div>    
    <!-- Example Content -->
    <div class="table-responsive">
        <table id="general-table" class="table table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    <th>Ambiente</th>
                    <th>Piso</th>
                    <th></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ambientes_inq as $am): ?>
                  <tr>
                      <td><?php echo $am['Ambiente']['nombre']; ?></td>
                      <td><?php echo $am['Inquilino']['piso'] ?></td>
                      <td>Inquilino</td>
                      <td>
                          <?php echo $this->Html->link("Pagados",array('action' => 'pagados',$am['Ambiente']['id']),array('class' => 'label label-success'));?> 
                          <?php echo $this->Html->link("No pagados",array('action' => 'nopagados',$am['Ambiente']['id']),array('class' => 'label label-info'));?>
                      </td>
                  </tr>
                <?php endforeach; ?>
                  <?php foreach ($ambientes_prop as $am): ?>
                  <tr>
                      <td><?php echo $am['Ambiente']['nombre']; ?></td>
                      <td><?php echo $am['Piso']['nombre'] ?></td>
                      <td>Propietario</td>
                      <td>
                          <?php echo $this->Html->link("Pagados",array('action' => 'pagados',$am['Ambiente']['id']),array('class' => 'label label-success'));?> 
                          <?php echo $this->Html->link("No pagados",array('action' => 'nopagados',$am['Ambiente']['id']),array('class' => 'label label-info'));?>
                      </td>
                  </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
    <!-- END Example Content -->
</div>
<!-- END Example Block -->