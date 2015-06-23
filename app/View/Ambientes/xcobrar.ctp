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
            <div class="col-md-3">
                <label>Fecha Inicio</label>
                <?php echo $this->Form->date("Dato.fecha_ini", array('required', 'class' => 'form-control')); ?>
            </div>
            <div class="col-md-3">
                <label>Fecha Fin</label>
                <?php echo $this->Form->date("Dato.fecha_fin", array('required', 'class' => 'form-control')); ?>
            </div>
            <div class="col-md-3">
                <label>Tipo</label>
                <?php echo $this->Form->select("Dato.concepto", $conceptos, array('required', 'class' => 'form-control')); ?>
            </div>
            <div class="col-md-3">
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