<?php if (!empty($lista)): ?>
  <table class="table table-striped table-bordered">
      <thead>
          <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Piso</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($lista as $li): ?>
            <tr style="cursor: pointer;" onclick="$('#<?php echo $div; ?>').load('<?php echo $this->Html->url(array('action' => 'comboselect_amb3', $campoform, $div, $li['Ambiente']['id'])); ?>');
                $('#myModal').modal('toggle');" >
                <td><?php echo $li['Ambiente']['id']; ?></td>
                <td><?php echo $li['Ambiente']['nombre']; ?></td>
                <td><?php echo $li['Piso']['nombre']?></td>
            </tr>
  <?php endforeach; ?>
      </tbody>
  </table>
<?php else: ?>
  <h4 style="color: blue;">No hay registros!!!</h4>
<?php endif; ?>
