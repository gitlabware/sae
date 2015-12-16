<?php if (!empty($subgestiones)): ?>
  <div class="form-group">
      <div class="col-md-12">
          <label>Gestion</label>
          <?php echo $this->Form->select('Ingreso.subge_id', $subgestiones, array('class' => 'form-control', 'empty' => 'Seleccione la gestion','id' => 'sel-subges')); ?>
      </div>
  </div>

<?php endif; ?>