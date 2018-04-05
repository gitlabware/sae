<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title "><i class="fa fa-cubes"></i>Reparticion de Cuentas - <?php echo $subconcepto['Subconcepto']['nombre']; ?></h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
    </button>
</div>

<!-- END Modal Header -->
<!-- Modal Body -->
<?php echo $this->Form->create('Cuenta', array('action' => 'guarda_porcentaje','id' => 'form-cuenta')); ?>
<div class="modal-body">    
    
        <div class="col-md-12">
            <table class="table table-bordered">
                <?php foreach ($cuentas as $key => $cu): ?>
                  <?php
                  if (!empty(array_column(array_column($porcentajes, 'Cuentasporcentaje'), 'cuenta_id'))) {
                    $key2 = array_search($cu['Cuenta']['id'], array_column(array_column($porcentajes, 'Cuentasporcentaje'), 'cuenta_id'));
                    if($key2 != FALSE){
                      $this->request->data['Cuentasporcentaje'][$key]['id'] = $porcentajes[$key2]['Cuentasporcentaje']['id'];
                      $this->request->data['Cuentasporcentaje'][$key]['porcentaje'] = $porcentajes[$key2]['Cuentasporcentaje']['porcentaje'];
                    }
                  }
                  ?>
                  <tr>
                      <td class="text-center"><?php echo $cu['Cuenta']['nombre'] ?></td>
                      <td style="width: 40%;">
                          <?php echo $this->Form->hidden("Cuentasporcentaje.$key.id") ?>
                          <?php echo $this->Form->hidden("Cuentasporcentaje.$key.subconcepto_id", array('value' => $subconcepto['Subconcepto']['id'])) ?>
                          <?php echo $this->Form->hidden("Cuentasporcentaje.$key.cuenta_id", array('value' => $cu['Cuenta']['id'])) ?>
                          <?php echo $this->Form->text("Cuentasporcentaje.$key.porcentaje", array('class' => 'form-control', 'placeholder' => '% Porcentaje', 'required', '')); ?>
                      </td>
                  </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        
            <button type="button" class="btn btn-white waves-effectt" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
        
    </div>
   
</div>
 <?php echo $this->Form->end(); ?>

