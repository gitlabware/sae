<?php if (!empty($datos['Inquilino']['id'])): ?>
  <button type="button" class="btn btn-info btn-block" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'comboselect_inq1', $campoform, $div)); ?>');"><?php echo $datos['User']['nombre']; ?></button>
  <?php echo $this->Form->hidden($campoform, array('value' => $datos['User']['nombre'])); ?>
<?php else: ?>
  <button type="button" class="btn btn-info btn-block" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Reportes', 'action' => 'comboselect_inq1', $campoform, $div)); ?>');"><?php echo 'SELECCIONE EL INQUILINO'; ?></button>
  <?php echo $this->Form->hidden($campoform, array('value' => null)); ?>
<?php endif; ?>
