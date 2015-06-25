<div class="table-responsive">
    <table id="general-table" class="table table-striped table-vcenter table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>C.I:</th>
                <th>NOMBRE</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $us): ?>
              <tr class="">
                  <td><?php echo $us['User']['id'] ?></td>
                  <td><?php echo $us['User']['ci'] ?></td>
                  <td><?php echo $us['User']['nombre'] ?></td>
                  <td>
                      <a href="javascript:" onclick="cambia_usuario(<?php echo $us['User']['id']; ?>);" class="label label-success">Seleccionar</a>
                  </td>
              </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>