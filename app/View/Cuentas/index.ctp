<div class="col-md-6 col-8 align-self-center">
  <h1 class="text-themecolor m-b-0 m-t-0">Cuentas</h1>
</div>

<div class="row">
  <div class="col-5">
    <div class="block-options pull-right">
      <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-warning" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Cuentas', 'action' => 'cuenta')); ?>');" title="Nueva Cuenta"><i class="fa fa-plus"></i></a>
    </div>
    <h3>Listado de cuentas</h3>


    <div class="card">
      <div class="card-body">
        <div class="table-responsive m-t-40">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nombre de cuenta</th>
                <th>Monto</th>
                <th>Accion</th>
              </tr>
            </thead>
            <tbody>
              <?php $total_c = 0.00; ?>
              <?php foreach ($cuentas as $cu): ?>
                <?php $total_c+=$cu['Cuenta']['monto']; ?>
                <tr>
                  <td><?php echo $cu['Cuenta']['nombre'] ?></td>
                  <td><?php echo $cu['Cuenta']['monto'] ?></td>
                  <td>
                    <a class="btn btn-secondary btn-sm" title="Editar" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'cuenta', $cu['Cuenta']['id'])); ?>');" title="Editar"> <i class="fa fa-pencil"></i> </a> 
                    <?php echo $this->Html->link('<i class="fa fa-money"></i>', array('action' => 'ingresos', $cu['Cuenta']['id']), array('class' => 'btn btn-sm btn-success', 'escape' => FALSE, 'title' => 'Ingresos')); ?>
                    <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $cu['Cuenta']['id']), array('class' => 'btn btn-sm btn-danger', 'escape' => FALSE, 'title' => 'Eliminar Cuenta','confirm' => 'Esta seguro de eliminar la cuenta '.$cu['Cuenta']['nombre'].'??')); ?>
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td>TOTAL:</td>
                <td><?= $total_c; ?></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <br>
      </div>
    </div>



    <div class="block-options pull-right">
      <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-info" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Bancos', 'action' => 'movimiento')); ?>');" title="Movimiento entre Bancos/Cajas"><i class="fa fa-exchange"></i></a>
      <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-warning" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Bancos', 'action' => 'banco')); ?>');" title="Nuevo Banco/Caja"><i class="fa fa-plus"></i></a>
    </div>
    <h3>Listado de Cajas/Bancos</h3>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive m-t-40">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Monto</th>
                <th>Accion</th>
              </tr>
            </thead>
            <tbody>
              <?php $total_c = 0.00; ?>
              <?php foreach ($bancos as $ba): ?>
                <?php $total_c+=$ba['Banco']['monto']; ?>
                <tr>
                  <td><?php echo $ba['Banco']['nombre'] ?></td>
                  <td><?php echo $ba['Banco']['monto'] ?></td>
                  <td>
                    <a class="btn btn-sm btn-secondary" title="Editar" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Bancos', 'action' => 'banco', $ba['Banco']['id'])); ?>');" title="Editar"> <i class="fa fa-pencil"></i> </a> 
                    <?php echo $this->Html->link('<i class="fa fa-money"></i>', array('controller' => 'Bancos', 'action' => 'estado', $ba['Banco']['id']), array('class' => 'btn btn-sm btn-success', 'escape' => FALSE, 'title' => 'Ingresos')); ?>
                    <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('controller' => 'Bancos', 'action' => 'eliminar', $ba['Banco']['id']), array('class' => 'btn btn-sm btn-danger', 'escape' => FALSE, 'title' => 'Eliminar Cuenta','confirm' => 'Esta seguro de eliminar la cuenta '.$ba['Banco']['nombre'].'??')); ?>
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td>TOTAL:</td>
                <td><?= $total_c; ?></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        <br>        
      </div>
    </div>
  </div>



<div class="col-md-7">
    <!-- Example Title -->
    <div class="block-title">
      <h2>Sub-Conceptos</h2>
    </div>
    <div class="card">
      <div class="card-body">
       <div class="table-responsive m-t-40">
        <table id="general-table" class="table table-bordered">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Nombre de Sub-Concepto</th>
              <th>Tipo</th>
              <th>Accion</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($subconceptos as $con): ?>
              <tr>
                <td><?php echo $con['Subconcepto']['codigo'] ?></td>
                <td><?php echo $con['Subconcepto']['nombre'] ?></td>
                <td><?php echo $con['Subconcepto']['tipo'] ?></td>
                <td>
                  <a class="btn btn-secondary" title="Editar" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'cuentas_porcentajes_s', $con['Subconcepto']['id'])); ?>');"> <i class="fa fa-pencil"></i> </a>  
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
</div>

<?php $this->start('campo_js') ?>
<script src="<?php echo $this->webroot; ?>template/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!--<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>-->
<script>
    $('#general-table').DataTable();
</script>
<?php $this->end() ?>