<?php if (!empty($datos['Ambiente']['id'])): ?>
  <button type="button" class="btn btn-info btn-block" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'comboselect_amb1', $campoform, $div)); ?>');"><?php echo $datos['Ambiente']['nombre']; ?></button>
  <?php echo $this->Form->hidden($campoform, array('value' => $datos['Ambiente']['id'])); ?>
<?php else: ?>
  <button type="button" class="btn btn-info btn-block" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Reportes', 'action' => 'comboselect_amb1', $campoform, $div)); ?>');"><?php echo 'SELECCIONE EL AMBIENTE'; ?></button>
  <?php echo $this->Form->hidden($campoform, array('value' => null)); ?>
<?php endif; ?>
