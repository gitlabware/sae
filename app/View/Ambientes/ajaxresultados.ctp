<?php //debug($ambientes);  ?>
<?php
//App::import('Model', 'Piso');
//$modeloPiso = new Piso();
App::import('Model', 'Inquilino');
$modeloInquilino = new Inquilino();
?>
<div class="table-responsive">
    <table class="table table-vcenter table-striped">
        <thead>
            <tr>
                <th style="width: 150px;" class="text-center">Nombre</th>
                <th><div id="pro">Propietario</div></th>
                <th>Inquilino(s)</th>
                <th>Piso</th>                
                <th style="width: 150px;" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ambientes as $a): ?>            
              <tr>
                  <td class="text-center"><?php echo $a['Ambiente']['nombre']; ?></td>
                  <td><a href="#"><?php echo $a['User']['nombre']; ?></a></td>
                  <td>
                      <?php
                      $idAmbiente = $a['Ambiente']['id'];
                      $inquilinos = $modeloInquilino->find('all', array(
                        'recursive' => 0,
                        'conditions' => array(
                          'ISNULL(Inquilino.deleted)',
                          'Inquilino.ambiente_id' => $idAmbiente
                        )
                      ));
                      //debug($inquilinos);
                      ?>
                      <?php if (!empty($inquilinos)): ?>  
                        <?php foreach ($inquilinos as $i): ?>
                          <?php echo $i['User']['nombre']; ?>
                          <br />
                        <?php endforeach; ?>  
                      <?php else: ?>
                        N/T
                      <?php endif; ?>  
                  </td>
                  <td><a href="javascript:void(0)" class="label label-warning"><?php echo $a['Piso']['nombre']; ?></a></td>
                  <td class="text-center">
                      <div class="btn-group btn-group-sm">
                          <a href="<?php echo $this->Html->url(array('action'=>'pay', $idAmbiente)); ?>" data-toggle="tooltip" title="Pagos" class="btn btn-success"><i class="fa fa-dollar"></i></a>
                          <!--<a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-danger"><i class="fa fa-times"></i></a>-->
                      </div>
                  </td>
              </tr>
            <?php endforeach; ?>            
        </tbody>
    </table>
</div>
<script>
  $('#pro').click(function(){
    console.log('si funciona ajax');
  });
</script>  