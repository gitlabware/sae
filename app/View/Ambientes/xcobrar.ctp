<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de Pagos por cobrar</h2>
    </div>
    <h3><?php echo strtoupper("Ambiente " . $ambiente['Ambiente']['nombre'] . ", piso " . $ambiente['Piso']['nombre']); ?></h3>
    <?php echo $this->Form->create("Ambiente"); ?>
    <?php //echo $this->Form->hidden("Dato.ambiente",array('value' => $ambiente['Ambiente']['id']));?>
    <div class="form-bordered">
        <div class="form-group">
            <div class="col-md-2">
                <label>Fecha Inicio</label>
                <?php echo $this->Form->date("Dato.fecha_ini", array('required', 'class' => 'form-control')); ?>
            </div>
            <div class="col-md-2">
                <label>Fecha Fin</label>
                <?php echo $this->Form->date("Dato.fecha_fin", array('required', 'class' => 'form-control')); ?>
            </div>
            <div class="col-md-2">
                <label>Tipo</label>
                <?php echo $this->Form->select("Dato.concepto", $conceptos, array('required', 'class' => 'form-control', 'id' => 'concepto')); ?>
            </div>
            <div class="col-md-2">
                <label>Monto</label>
                <?php echo $this->Form->text("Dato.monto",['class' => 'form-control','type' => 'number','step' => 'any','id' => 'monto','required']);?>
            </div>
            <div class="col-md-2">
                <label>Interes</label>
                <?php echo $this->Form->text("Dato.interes",['class' => 'form-control','type' => 'number','step' => 'any','id' => 'monto','required','max' => 100,'min' => 0]);?>
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label>
                <?php echo $this->Form->submit("Generar", array('class' => 'btn btn-sm btn-primary col-md-12')); ?>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>

    <!-- Example Content -->
    <div class="table-responsive">
        <table class="table table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0.00; ?>
                <?php foreach ($pagos as $pa): ?>
                  <?php $total = $total + $pa['Pago']['monto']; ?>
                  <tr>
                      <td><?php echo $pa['Pago']['fecha']; ?></td>
                      <td><?php echo $pa['Concepto']['nombre']; ?></td>
                      <td><?php echo $pa['Pago']['monto']; ?></td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td>TOTAL</td>
                    <td><?php echo $total; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- END Example Content -->
</div>
<!-- END Example Block -->

<script>
  var conceptos = [];
<?php foreach ($conceptos_mon as $key => $co): ?>
    conceptos[<?php echo $key ?>] = <?php echo $co; ?>;
<?php endforeach; ?>

  $('#concepto').change(function () {
      var monto = conceptos[$(this).val()];
      $('#monto').val(monto);
  });
</script>