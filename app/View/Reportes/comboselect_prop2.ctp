<?php if (!empty($lista)): ?>
  <table class="table table-striped table-bordered">
      <thead>
          <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Ambiente</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($lista as $li): ?>
            <tr style="cursor: pointer;" onclick="$('#<?php echo $div; ?>').load('<?php echo $this->Html->url(array('action' => 'comboselect_prop3', $campoform, $div, $li['User']['id'])); ?>');
                $('#myModal').modal('toggle');" >
                <td><?php echo $li['User']['id']; ?></td>
                <td><?php echo $li['User']['nombre']; ?></td>
                <td><?php echo $li['User']['ambiente']?></td>
            </tr>
  <?php endforeach; ?>
      </tbody>
  </table>
<?php else: ?>
  <h4 style="color: blue;">No hay registros!!!</h4>
<?php endif; ?>
