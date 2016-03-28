
<div class="block">
    <h3 class="text-center">EDIFICIO <?php echo strtoupper($this->Session->read('Auth.User.Edificio.nombre')); ?></h3>
    <h2 class="text-center">PLAN ANUAL OPERATIVO</h2>
    <h2 class="text-center text-success page-header">INGRESOS</h2>


    <div class="table-responsive" style="overflow: auto;overflow-y: hidden;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Concepto/Subconcepto</th>
                    <th>Aprox</th>
                    <th>Ingreso Anual</th>
                    <th>Presupuesto Anual</th>
                    <th>Enero</th>
                    <th>Febre</th>
                    <th>Marzo</th>
                    <th>Abril</th>
                    <th>Mayo</th>
                    <th>Junio</th>
                    <th>Julio</th>
                    <th>Agost</th>
                    <th>Septi</th>
                    <th>Octub</th>
                    <th>Novie</th>
                    <th>Dicie</th>
                </tr>
            </thead>
            <tbody>
                <?php $cont = 0.00; ?>
                <?php foreach ($conceptos as $con): ?>
                  <?php $cont++; ?>
                  <tr>
                      <td><?= $cont ?></td>
                      <td><?= $con['Concepto']['nombre'] ?></td>
                      <td>
                          <?= $this->Form->text("Item.$cont.ing_aproximados", array('class' => 'form-control aproximado', 'type' => 'number', 'step' => 'any', 'max' => 1, 'min' => 0, 'numero' => $cont, 'id' => 'aproximado-' . $cont)); ?>
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.ingreso_anual", array('class' => 'form-control ing-anual', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont, 'id' => 'ing-anual-' . $cont)); ?>
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.presupuesto_anual", array('class' => 'form-control  pre-anual', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont, 'id' => 'pre-anual-' . $cont)); ?>
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.enero", array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont)); ?> 
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.febrero", array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont)); ?> 
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.marzo", array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont)); ?> 
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.abril", array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont)); ?> 
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.mayo", array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont)); ?> 
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.junio", array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont)); ?> 
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.julio", array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont)); ?> 
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.agosto", array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont)); ?> 
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.septiembre", array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont)); ?> 
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.octubre", array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont)); ?> 
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.noviembre", array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont)); ?> 
                      </td>
                      <td>
                          <?= $this->Form->text("Item.$cont.diciembre", array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'numero' => $cont)); ?> 
                      </td>
                  </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</div>
<script>


  $('.aproximado').keyup(function () {
      var porcentaje = 0.00;
      var ingreso = 0.00;
      var numero = $(this).attr('numero');
      if ($(this).val() != '') {
          porcentaje = parseFloat($(this).val());
      }
      if ($('#ing-anual-' + numero).val() != '') {
          ingreso = $('#ing-anual-' + numero).val();
      }
      var presupuesto = Math.round(porcentaje * ingreso * 100) / 100;
      $('#pre-anual-' + numero).val(presupuesto);
  });
  $('.ing-anual').keyup(function () {
      var porcentaje = 0.00;
      var ingreso = 0.00;
      var numero = $(this).attr('numero');
      if ($(this).val() != '') {
          ingreso = parseFloat($(this).val());
      }
      if ($('#aproximado-' + numero).val() != '') {
          porcentaje = $('#aproximado-' + numero).val();
      }

      var presupuesto = Math.round(porcentaje * ingreso * 100) / 100;
      $('#pre-anual-' + numero).val(presupuesto);
  });

</script>