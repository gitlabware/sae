<!-- Blank Header -->
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-brush"></i>Cuentas<br>
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <div class="block">
            <!-- Example Title -->
            <div class="block-title">
                <div class="block-options pull-right">
                    
                    <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-success" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Cuentas', 'action' => 'cuenta')); ?>');" title="Nueva Cuenta"><i class="fa fa-plus"></i></a>
                </div>
                <h2>Listado de cuentas</h2>
            </div>
            <div class="row">
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
                                  <a class="btn btn-sm btn-info" title="Editar" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'cuenta', $cu['Cuenta']['id'])); ?>');" title="Editar"> <i class="fa fa-edit"></i> </a> 
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

        <div class="block">
            <!-- Example Title -->
            <div class="block-title">
                <div class="block-options pull-right">
                    <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-info" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Bancos', 'action' => 'movimiento')); ?>');" title="Movimiento entre Bancos/Cajas"><i class="fa fa-exchange"></i></a>
                    <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-success" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Bancos', 'action' => 'banco')); ?>');" title="Nuevo Banco/Caja"><i class="fa fa-plus"></i></a>
                </div>
                <h2>Listado de Cajas/Bancos</h2>
            </div>
            <div class="row">
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
                                  <a class="btn btn-sm btn-info" title="Editar" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Bancos', 'action' => 'banco', $ba['Banco']['id'])); ?>');" title="Editar"> <i class="fa fa-edit"></i> </a> 
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
    <div class="col-md-7">
        <div class="block">
            <!-- Example Title -->
            <div class="block-title">
                <h2>Conceptos</h2>
            </div>
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre de Concepto</th>
                            <th>Descripcion</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($conceptos as $con): ?>
                          <tr>
                              <td><?php echo $con['Concepto']['nombre'] ?></td>
                              <td><?php echo $con['Concepto']['descripcion'] ?></td>
                              <td>
                                  <a class="btn btn-info" title="Editar" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'cuentas_porcentajes', $con['Concepto']['id'])); ?>');"> <i class="gi gi-edit"></i> </a>  
                              </td>
                          </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <br>
        </div>
        <div class="block">
            <!-- Example Title -->
            <div class="block-title">
                <h2>Sub-Conceptos</h2>
            </div>
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre de Sub-Concepto</th>
                            <th>Tipo</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subconceptos as $con): ?>
                          <tr>
                              <td><?php echo $con['Subconcepto']['nombre'] ?></td>
                              <td><?php echo $con['Subconcepto']['tipo'] ?></td>
                              <td>
                                  <a class="btn btn-info" title="Editar" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'cuentas_porcentajes_s', $con['Subconcepto']['id'])); ?>');"> <i class="gi gi-edit"></i> </a>  
                              </td>
                          </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <br>
        </div>
    </div>
</div>

