<div class="row">
  <div class="col-6 col-8 align-self-center">
    <h2 class="text-themecolor m-b-0 m-t-0">Listado de Comprobantes Pendientes (No combrobados)</h2>
  </div>
</div>


<div class="row" >
  <div class="col-12">

    <div class="btn-group btn-group-sm pull-right">

      <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-success" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Comprobantes', 'action' => 'opciones1')); ?>');" title="Opciones Marcados"><i class="fa fa-tasks"></i></a>
    </div>

  </div>
</div>


<?php echo $this->Form->create('Comprobante', array('action' => 'union_comprobantes', 'id' => 'f-comprobantes')); ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
       <div class="table-responsive m-t-40">
        <table id="general-table" class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" name="marcados" id="marca-todos"></th>
              <th>Id</th>
              <th>Fecha</th>
              <th>Tipo</th>
              <th>Concepto</th>
              <th>Recibido de/Pagado a</th>
              <th>Monto</th>
              <th>Accion</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($comprobantes as $key => $com): ?>

              <?php
              $clase = "";
              if ($com['Comprobante']['tipo'] == 'Ingreso') {
                $clase = 'success';
              } elseif ($com['Comprobante']['tipo'] == 'Egreso') {
                $clase = 'warning';
              }
              ?>
              <tr class="<?php echo $clase; ?> text-center">
                <td>
                  <?php echo $this->Form->hidden("comprobantes.$key.id", array('value' => $com['Comprobante']['id'])) ?>
                  <?php echo $this->Form->hidden("comprobantes.$key.tipo", array('value' => $com['Comprobante']['tipo'])) ?>
                  <?php echo $this->Form->checkbox("comprobantes.$key.marcado") ?>
                </td>
                <td><?php echo $com['Comprobante']['id']; ?></td>
                <td><?php echo $com['Comprobante']['fecha'] ?></td>
                <td><?php echo $com['Comprobante']['tipo'] ?></td>
                <td><?php echo substr($com['Comprobante']['concepto'], 0, 30) ?></td>
                <td><?php echo $com['Comprobante']['nombre'] ?></td>
                <td><?php echo $com['Comprobante']['monto_total'] ?></td>
                <td>
                  <?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'comprobante', $com['Comprobante']['id']), array('class' => 'btn btn-secondary btn-sm', 'title' => 'Editar', 'escape' => FALSE)) ?>
                  <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $com['Comprobante']['id']), array('class' => 'btn btn-danger btn-sm', 'title' => 'Eliminar Edificio', 'confirm' => 'Esta seguro de eliminar el comprobante ' . $com['Comprobante']['id'] . '??', 'escape' => FALSE)) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php echo $this->Form->hidden("Comprobante.comprobante_id", array('id' => 's-comprobante-id')) ?>      
      <!-- END Interactive Title -->

    </div>
  </div>
</div>
</div>
<?php echo $this->Form->end(); ?>


