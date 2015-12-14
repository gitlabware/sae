<div class="col-md-12">
    <?php if (!empty($ambientes)): ?>
      <div class="table-responsive">
          <table class="table table-striped table-borderless table-bordered">
              <thead>
                  <tr>
                      <th>
                          <?php echo $this->Form->checkbox("todos", array('id' => 'todos')); ?>
                      </th>
                      <th>Ambiente</th>
                      <th>Representante</th>
                      <th style="width: 20%;">Codigo</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($ambientes as $key => $am): ?>
                    <tr>
                        <td>
                            <?php echo $this->Form->checkbox("Dato.$key.marca", array('class' => 'marcado')); ?>
                            <?php echo $this->Form->hidden("Dato.$key.ambiente_id", array('value' => $am['Ambiente']['id'])); ?>
                        </td>
                        <td><?php echo $am['Ambiente']['nombre'] ?></td>
                        <td><?php echo $am['Representante']['nombre'] ?></td>
                        <td>
                            <?php echo $this->Form->text("Dato.$key.codigo", array('class' => 'form-control')); ?>
                        </td>
                    </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
      </div>
    <?php else: ?>
      <h3 class="text-danger">
          No se ha encontrado ambientes para adicionar
      </h3>
    <?php endif; ?>
</div>

<script>
  $('#todos').click(function () {
      if ($('#todos').prop('checked')) {
          $('.marcado').prop('checked', true);
      } else {
          $('.marcado').prop('checked', false);
      }
  });
</script>