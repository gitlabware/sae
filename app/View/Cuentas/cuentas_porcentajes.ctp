<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-building"></i> Reparticion de cuentas - <?php echo $concepto['Concepto']['nombre']; ?></h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Cuenta', array('action' => 'guarda_porcentaje', 'class' => 'form-horizontal form-bordered', 'id' => 'form-cuenta')); ?>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
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
                          <?php echo $this->Form->hidden("Cuentasporcentaje.$key.concepto_id", array('value' => $concepto['Concepto']['id'])) ?>
                          <?php echo $this->Form->hidden("Cuentasporcentaje.$key.cuenta_id", array('value' => $cu['Cuenta']['id'])) ?>
                          <?php echo $this->Form->text("Cuentasporcentaje.$key.porcentaje", array('class' => 'form-control', 'placeholder' => '% Porcentaje', 'required', '')); ?>
                      </td>
                  </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="form-group form-actions">
        <div class="col-xs-12 text-right">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<!-- END Modal Body -->


