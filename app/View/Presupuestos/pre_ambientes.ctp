<div class="block">
    <h3 class="text-center">EDIFICIO <?php echo strtoupper($this->Session->read('Auth.User.Edificio.nombre')); ?></h3>
    <h4 class="text-center">
        SUB-CONCEPTO <?= $subconcepto['Subconcepto']['nombre']; ?>
        <?php
        if (!empty($subcGes)) {
          echo '(' . $subcGes['SubcGestione']['nombre'] . ')';
        }
        ?>
    </h4>
    <div class="form-horizontal form-bordered">
        <?php echo $this->Form->create('Presupuesto', array('action' => 'guarda_ingreso', $presupuesto['Presupuesto']['id'], 'id' => 'form-ingresos')); ?>
        <?php if (!empty($subcGes)): ?>
          <?php echo $this->Form->hidden('Ingreso.subge_id', array('value' => $subcGes['SubcGestione']['id'])); ?>
        <?php endif; ?>
        <?php echo $this->Form->hidden('Ingreso.presupuesto_id', array('value' => $presupuesto['Presupuesto']['id'])); ?>
        <?php echo $this->Form->hidden('Ingreso.subconcepto_id', array('value' => $subconcepto['Subconcepto']['id'])); ?>
        <?php echo $this->Form->hidden('Ingreso.concepto_id', array('value' => $subconcepto['Subconcepto']['concepto_id'])); ?>
        <div class="form-group">

            <div class="col-md-1">
                <label>%</label>
                <?php echo $this->Form->text('Ingreso.porcentaje', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'max' => 1, 'placeholder' => '0.00', 'id' => 'c-porcentaje')); ?>
            </div>
            <div class="col-md-2">
                <label>Ingreso anual</label>
                <?php echo $this->Form->text('Ingreso.ingreso', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00', 'id' => 'c-ingreso')); ?>
            </div>
            <div class="col-md-2">
                <label>Presupuesto anterior</label>
                <?php echo $this->Form->text('Ingreso.pres_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
            <div class="col-md-2">
                <label>Ejecutado anterior</label>
                <?php echo $this->Form->text('Ingreso.ejec_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
            </div>
            <div class="col-md-2">
                <label>Presupuesto</label>
                <?php echo $this->Form->text('Ingreso.presupuesto', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00', 'id' => 'c-presupuesto')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <button class="btn btn-alt btn-primary col-md-12" type="submit">REGISTRAR</button>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="table-responsive">

        <?php if ($subconcepto['Subconcepto']['gestiones_anteriores'] != 1): ?>
          <table class="table table-vcenter table-condensed table-bordered dataTable no-footer">
              <thead>
                  <tr>
                      <th>Ambiente</th>
                      <th>Piso</th>
                      <th>Representante</th>
                      <th>Monto</th>
                      <th></th>
                      <th>Cantidad</th>
                      <th>Total</th>
                  </tr>
              </thead>
              <tbody id="ambientes-a">
                  <?php $i = 0; ?>
                  <?php foreach ($nomenclaturas as $no): ?>
                    <tr>
                        <td colspan="7" class="info text-center"><h4><?= $no['Nomenclatura']['nombre']; ?></h4></td>
                    </tr>

                    <?php
                    $ambientes = $this->requestAction(array('action' => 'get_amb_nom', $no['Nomenclatura']['id'], $subconcepto['Subconcepto']['concepto_id']));
                    ?>

                    <?php foreach ($ambientes as $am): ?>
                      <?php $i++; ?>
                      <tr>
                          <td><?= $am['Ambiente']['nombre'] ?></td>
                          <td><?= $am['NomenclaturasAmbiente']['piso'] ?></td>
                          <td><?= $am['NomenclaturasAmbiente']['representante'] ?></td>
                          <td><?= $this->Form->text("Aux.$i.monto", array('class' => 'form-control c-monto', 'onkeyup' => 'calcula();', 'value' => $am['NomenclaturasAmbiente']['monto'], 'numero' => $i, 'id' => 'c-monto-' . $i)); ?></td>
                          <td>X</td>
                          <td><?= $this->Form->text("Aux.$i.cantidad", array('class' => 'form-control', 'onkeyup' => 'calcula();', 'value' => 12, 'numero' => $i, 'id' => 'c-cantida-' . $i)); ?></td>
                          <td><?= $this->Form->text("Aux.$i.total", array('class' => 'form-control e-total', 'onkeyup' => 'calcula();', 'numero' => $i, 'id' => 'c-total-' . $i)); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
              </tbody>
          </table>
        <?php else: ?>
          <?php
          //$ambientes = $this->requestAction(array('action' => 'get_deudas_subg', $idSubconcepto, $idSubcGes));
          ?>
          <table class="table table-vcenter table-condensed table-bordered dataTable no-footer">
              <thead>
                  <tr>
                      <th>Ambiente</th>
                      <th>Piso</th>
                      <th>Representante</th>
                      <th>Gestion</th>
                      <th>Total</th>
                      <th></th>
                  </tr>
              </thead>  
              <tbody>
                  <?php $i = 0; ?>
                  <?php foreach ($nomenclaturas as $no): ?>
                    <tr>
                        <td colspan="6" class="info text-center"><h4><?= $no['Nomenclatura']['nombre']; ?></h4></td>
                    </tr>
                    <?php
                    $ambientes = $this->requestAction(array('action' => 'get_deudas_subg', $no['Nomenclatura']['id'], $subconcepto['Subconcepto']['concepto_id'], $idSubcGes));
                    ?>
                    <?php foreach ($ambientes as $am): ?>

                      <tr class="warning"  id="tr-oc-p-<?= $no['Nomenclatura']['id'] . '-' . $am['Pago']['ambiente_id'] . '-' . $am['Pago']['gestion']; ?>">
                          <td><?= $am['Ambiente']['nombre'] ?></td>
                          <td><?= $am['Pago']['piso'] ?></td>
                          <td><?= $am['Pago']['representante'] ?></td>
                          <td><?= $am['Pago']['gestion'] ?></td>
                          <td id="mon-to-n-<?= $no['Nomenclatura']['id'] . '-' . $am['Pago']['ambiente_id'] . '-' . $am['Pago']['gestion']; ?>"><?= $am['Pago']['monto_total'] ?></td>
                          <td>
                              <button class="btn btn-info btn-sm" title="Detalle de Pagos" type="button" onclick="$('#tr-oc-<?= $no['Nomenclatura']['id'] . '-' . $am['Pago']['ambiente_id'] . '-' . $am['Pago']['gestion']; ?>').toggle(200);"><i class="gi gi-list"></i></button> 
                              <button class="btn btn-warning btn-sm" title="Quitar del presupuesto"  onclick="$('#tr-oc-p-<?= $no['Nomenclatura']['id'] . '-' . $am['Pago']['ambiente_id'] . '-' . $am['Pago']['gestion']; ?>').addClass('danger');
                                        $('#tr-oc-p-<?= $no['Nomenclatura']['id'] . '-' . $am['Pago']['ambiente_id'] . '-' . $am['Pago']['gestion']; ?>').fadeOut(600, function () {
                                          $('#tr-oc-p-<?= $no['Nomenclatura']['id'] . '-' . $am['Pago']['ambiente_id'] . '-' . $am['Pago']['gestion']; ?>').remove();
                                          $('#tr-oc-<?= $no['Nomenclatura']['id'] . '-' . $am['Pago']['ambiente_id'] . '-' . $am['Pago']['gestion']; ?>').remove();
                                          suma_todo();
                                        });"type="button"><i class="gi gi-remove"></i></button>

                          </td>
                      </tr>
                      <?php
                      $pagos_am = $this->requestAction(array('action' => 'get_pagos_amb', $am['Pago']['ambiente_id'], $am['Pago']['concepto_id'], $am['Pago']['gestion']));
                      ?>
                      <tr style="display: none;" id="tr-oc-<?= $no['Nomenclatura']['id'] . '-' . $am['Pago']['ambiente_id'] . '-' . $am['Pago']['gestion']; ?>">
                          <td colspan="6">
                              <table class="table table-bordered"  id="ambientes-a">
                                  <?php foreach ($pagos_am as $pa): ?>
                                    <?php $i++; ?>
                                    <tr id="tr-registro-<?= $i ?>">
                                        <td style="width: 15%;"><?= $pa['Pago']['fecha'] ?></td>
                                        <td style="width: 40%;"><?= $pa['Concepto']['nombre'] ?></td>
                                        <td style="width: 20%;"><?= $this->Form->text("Aux.$i.monto", array('class' => 'form-control e-total e-total-' . $no['Nomenclatura']['id'] . '-' . $am['Pago']['ambiente_id'] . '-' . $am['Pago']['gestion'], 'onkeyup' => 'suma_parcial(' . $no['Nomenclatura']['id'] . ',' . $am['Pago']['ambiente_id'] . ',' . $am['Pago']['gestion'] . ');', 'value' => $pa['Pago']['monto_total'], 'numero' => $i, 'id' => 'c-monto-' . $i)); ?></td>
                                        <td align="center">
                                            <button class="btn btn-success btn-sm" title="Editar monto de este Pago" type="button" onclick="cargarmodal('<?= $this->Html->url(array('controller' => 'Pagos', 'action' => 'edit_monto', $pa['Pago']['id'])) ?>');"><i class="gi gi-edit"></i></button> 
                                            <button class="btn btn-warning btn-sm" title="Quitar del presupuesto" onclick="$('#tr-registro-<?= $i ?>').addClass('danger');
                                                        $('#tr-registro-<?= $i ?>').fadeOut(600, function () {
                                                          remover_registro(<?= $i ?>);
                                                          suma_parcial(<?= $no['Nomenclatura']['id'] ?>,<?= $am['Pago']['ambiente_id'] ?>,<?= $am['Pago']['gestion'] ?>);
                                                        });" type="button"><i class="gi gi-remove"></i></button>
                                                <?= $this->Html->link('<i class="gi gi-bin"></i>', array('controller' => 'Pagos', 'action' => 'eliminar', $pa['Pago']['id']), array('class' => 'btn btn-danger btn-sm', 'confirm' => 'Esta seguro de eliminar el pago??', 'escape' => FALSE)) ?>
                                        </td>
                                    </tr>
                                  <?php endforeach; ?>
                              </table>
                          </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
              </tbody>
          </table>
        <?php endif; ?>

    </div>
</div>
<script>
  var total = 0.00;
  function calcula() {
      $('#ambientes-a .c-monto').each(function (i, elemento) {
          //console.log($(elemento).attr('numero'));
          //console.log($(elemento).val()*$('#c-cantida-'+$(elemento).attr('numero')).val());
          var monto_to = $(elemento).val() * $('#c-cantida-' + $(elemento).attr('numero')).val();
          if (isNaN(monto_to)) {
              $('#c-total-' + $(elemento).attr('numero')).val(0);
          } else {
              $('#c-total-' + $(elemento).attr('numero')).val(monto_to);
          }
      });
      suma_todo();
  }
  calcula();
  function suma_todo() {
      total = 0.00;
      $('#ambientes-a .e-total').each(function (i, elemento) {
          total += parseFloat($(elemento).val());
      });
      $('#c-ingreso').val(total);
  }
  function remover_registro(i) {
      //$('#tr-registro-'+i).hide(200);
      $('#tr-registro-' + i).remove();
  }
  function suma_parcial(id1, id2, gestion) {
      total = 0.00;
      $('#ambientes-a .e-total-' + id1 + '-' + id2 + '-' + gestion).each(function (i, elemento) {
          total += parseFloat($(elemento).val());
      });
      $('#mon-to-n-' + id1 + '-' + id2 + '-' + gestion).html(total);
      //alert('#mon-to-n-'+id1+'-'+id2);
      suma_todo();
  }
  $('#c-porcentaje').keyup(function () {
      calc_presupuesto();
  });
  $('#c-ingreso').keyup(function () {
      calc_presupuesto();
  });
  function calc_presupuesto() {
      if ($('#c-ingreso').val() != '') {
          ingreso = parseFloat($('#c-ingreso').val());
      } else {
          ingreso = 0.00;
      }
      if ($('#c-porcentaje').val() != '') {
          porcentaje = parseFloat($('#c-porcentaje').val());
      } else {
          porcentaje = 0.00;
      }
      presupuesto = Math.round(porcentaje * ingreso * 100) / 100;
      $('#c-presupuesto').val(presupuesto);
  }
  calc_presupuesto();
</script>