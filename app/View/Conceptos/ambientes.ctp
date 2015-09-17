<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Ambientes</h2>
    </div>    
    <!-- Example Content -->
    <?php echo $this->Form->create("Ambiente"); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-bordered">
                <div class="form-group">
                    <div class="col-md-3">
                        <label>Concepto</label>
                        <?php echo $this->Form->select("Dato.concepto_id", $conceptos, array('required', 'class' => 'form-control', 'required', 'id' => 'concepto')); ?>
                    </div>
                    <div class="col-md-3">
                        <label>Sub-Concepto</label>
                        <?php echo $this->Form->select("Dato.subconcepto_id", $subconceptos, array('required', 'class' => 'form-control', 'id' => 'subconcepto')); ?>
                    </div>
                    <div class="col-md-3">
                        <label>Monto</label>
                        <?php echo $this->Form->text("Dato.monto", ['class' => 'form-control', 'type' => 'number', 'step' => 'any', 'id' => 'monto', 'required']); ?>
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <?php echo $this->Form->submit("Generar", array('class' => 'btn btn-sm btn-primary col-md-12')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="table-responsive">
        <table id="example-datatable" class="table table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    <th>
                        <?php
                        echo $this->Form->checkbox("todos", array('class' => 'form-control', 'id' => 'todos'));
                        ?>
                    </th>
                    <th>Ambiente</th>
                    <th>Piso</th>
                    <th>Representante</th>
                    <th>servicios</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ambientes as $key => $amb): ?>
                  <tr>
                      <td>
                          <?php
                          echo $this->Form->checkbox("Dato.ambientes.$key.marca", array('class' => 'form-control marca'));
                          echo $this->Form->hidden("Dato.ambientes.$key.ambiente_id", array('value' => $amb['Ambiente']['id']))
                          ?>
                      </td>
                      <td><?php echo $amb['Ambiente']['nombre'] ?></td>
                      <td><?php echo $amb['Piso']['nombre'] ?></td>
                      <td><?php echo $amb['Representante']['nombre'] ?></td>

                      <td>
                          <?php
                          $conceptos = $this->requestAction(array('action' => 'get_conceptos_a', $amb['Ambiente']['id']));
                          ?>
                          <table>
                              <?php foreach ($conceptos as $con): ?>
                                <tr>
                                    <td><?php echo $con['Concepto']['nombre']; ?></td>
                                    <td><?php echo $con['Ambienteconcepto']['monto']; ?></td>
                                </tr>
                              <?php endforeach; ?>
                          </table>

                      </td>
                  </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->Form->end(); ?>
    </div>
    <!-- END Example Content -->
</div>
<!-- END Example Block -->

<script>
  filtro_c = [
      null,
      {type: "text"},
      {type: "text"},
      {type: "text"}
  ];
  var subconceptos = [];
<?php foreach ($subconceptos_aux as $key => $sub): ?>
    subconceptos[<?php echo $key; ?>] = <?php echo $sub; ?>;
<?php endforeach; ?>

  $('#subconcepto').change(function () {
      $('#concepto').val(subconceptos[$('#subconcepto').val()]);
  });

  $('#concepto').change(function () {
      $('#subconcepto').val('');
  });

  $('#todos').click(function () {
      if ($(this).prop('checked')) {
          $('.marca').prop('checked', true);
      } else {
          $('.marca').prop('checked', false);
      }
  });

</script>