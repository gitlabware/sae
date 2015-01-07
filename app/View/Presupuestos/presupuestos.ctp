<!-- Blank Header -->
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-brush"></i>Presupuestos <?php echo $gestion['Gestione']['ano']?><br>
        </h1>
    </div>
</div>
<!-- END Blank Header -->
<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de Ingresos y Egresos</h2>
    </div>
    <!-- END Example Title -->
    <div class="table-options clearfix">
        <div class="btn-group btn-group-sm pull-right">
            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'presupuesto', $idGestion)); ?>');" class="btn btn-primary" title="Adicionar nuevo Presupuesto">NUEVO</a>
        </div>
    </div>
    <!-- Example Content -->
    <?php $enero = $this->requestAction(array('action' => 'eingresos', $idGestion, 'Enero')) ?>
    <?php if (!empty($enero)): ?>
        <h3>ENERO</h3>
        <div class="table-responsive">
            <table id="general-table" class="table table-striped table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
<?php $totalmes = 0.00; ?>
                <tbody>
                    <?php foreach ($enero as $pre): ?>
                        <tr>
                            
                            <td><?php echo $pre['Concepto']['nombre']; ?></td>
                            <td><?php echo $pre['Presupuesto']['tipo']; ?></td>
                            <td><?php echo $pre['Presupuesto']['monto']; ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'presupuesto', $idGestion,$pre['Presupuesto']['id'])); ?>');" title="Editar Presupuesto" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $pre['Presupuesto']['id']), array('class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar Presupuesto', 'confirm' => 'Esta seguro de eliminar el presupuesto ' . $pre['Concepto']['nombre'] . '??', 'escape' => FALSE)) ?>
                            </td>
                        </tr>
                        <?php $totalmes = $totalmes + $pre['Presupuesto']['monto']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $totalmes; ?></td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <!-- END Example Content -->
    <!-- Example Content -->
    <?php $febrero = $this->requestAction(array('action' => 'eingresos', $idGestion, 'Febrero')) ?>
    <?php if (!empty($febrero)): ?>
        <h3>FEBRERO</h3>
        <div class="table-responsive">
            <table id="general-table" class="table table-striped table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead><?php $totalmes = 0.00; ?>
                <tbody>
                    <?php foreach ($febrero as $pre): ?>
                        <tr>
                            
                            <td><?php echo $pre['Concepto']['nombre']; ?></td>
                            <td><?php echo $pre['Presupuesto']['tipo']; ?></td>
                            <td><?php echo $pre['Presupuesto']['monto']; ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'presupuesto', $idGestion,$pre['Presupuesto']['id'])); ?>');" title="Editar Presupuesto" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $pre['Presupuesto']['id']), array('class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar Presupuesto', 'confirm' => 'Esta seguro de eliminar el presupuesto ' . $pre['Concepto']['nombre'] . '??', 'escape' => FALSE)) ?>
                            </td>
                        </tr>
                        <?php $totalmes = $totalmes + $pre['Presupuesto']['monto']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $totalmes; ?></td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <!-- END Example Content -->
    <!-- Example Content -->
    <?php $marzo = $this->requestAction(array('action' => 'eingresos', $idGestion, 'Marzo')) ?>
    <?php if (!empty($marzo)): ?>
        <h3>MARZO</h3>
        <div class="table-responsive">
            <table id="general-table" class="table table-striped table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody><?php $totalmes = 0.00; ?>
                    <?php foreach ($marzo as $pre): ?>
                        <tr>
                            
                            <td><?php echo $pre['Concepto']['nombre']; ?></td>
                            <td><?php echo $pre['Presupuesto']['tipo']; ?></td>
                            <td><?php echo $pre['Presupuesto']['monto']; ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'presupuesto', $idGestion,$pre['Presupuesto']['id'])); ?>');" title="Editar Presupuesto" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $pre['Presupuesto']['id']), array('class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar Presupuesto', 'confirm' => 'Esta seguro de eliminar el presupuesto ' . $pre['Concepto']['nombre'] . '??', 'escape' => FALSE)) ?>
                            </td>
                        </tr>
                        <?php $totalmes = $totalmes + $pre['Presupuesto']['monto']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $totalmes; ?></td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <!-- END Example Content -->
    <!-- Example Content -->
    <?php $abril = $this->requestAction(array('action' => 'eingresos', $idGestion, 'Abril')) ?>
    <?php if (!empty($abril)): ?>
        <h3>ABRIL</h3>
        <div class="table-responsive">
            <table id="general-table" class="table table-striped table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody><?php $totalmes = 0.00; ?>
                    <?php foreach ($abril as $pre): ?>
                        <tr>
                            
                            <td><?php echo $pre['Concepto']['nombre']; ?></td>
                            <td><?php echo $pre['Presupuesto']['tipo']; ?></td>
                            <td><?php echo $pre['Presupuesto']['monto']; ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'presupuesto', $idGestion,$pre['Presupuesto']['id'])); ?>');" title="Editar Presupuesto" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $pre['Presupuesto']['id']), array('class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar Presupuesto', 'confirm' => 'Esta seguro de eliminar el presupuesto ' . $pre['Concepto']['nombre'] . '??', 'escape' => FALSE)) ?>
                            </td>
                        </tr>
                        <?php $totalmes = $totalmes + $pre['Presupuesto']['monto']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $totalmes; ?></td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <!-- END Example Content -->
    <!-- Example Content -->
    <?php $mayo = $this->requestAction(array('action' => 'eingresos', $idGestion, 'Mayo')) ?>
    <?php if (!empty($mayo)): ?>
        <h3>MAYO</h3>
        <div class="table-responsive">
            <table id="general-table" class="table table-striped table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody><?php $totalmes = 0.00; ?>
                    <?php foreach ($mayo as $pre): ?>
                        <tr>
                            
                            <td><?php echo $pre['Concepto']['nombre']; ?></td>
                            <td><?php echo $pre['Presupuesto']['tipo']; ?></td>
                            <td><?php echo $pre['Presupuesto']['monto']; ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'presupuesto', $idGestion,$pre['Presupuesto']['id'])); ?>');" title="Editar Presupuesto" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $pre['Presupuesto']['id']), array('class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar Presupuesto', 'confirm' => 'Esta seguro de eliminar el presupuesto ' . $pre['Concepto']['nombre'] . '??', 'escape' => FALSE)) ?>
                            </td>
                        </tr>
                        <?php $totalmes = $totalmes + $pre['Presupuesto']['monto']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $totalmes; ?></td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <!-- END Example Content -->
    <!-- Example Content -->
    <?php $junio = $this->requestAction(array('action' => 'eingresos', $idGestion, 'Junio')) ?>
    <?php if (!empty($junio)): ?>
        <h3>JUNIO</h3>
        <div class="table-responsive">
            <table id="general-table" class="table table-striped table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody><?php $totalmes = 0.00; ?>
                    <?php foreach ($junio as $pre): ?>
                        <tr>
                            
                            <td><?php echo $pre['Concepto']['nombre']; ?></td>
                            <td><?php echo $pre['Presupuesto']['tipo']; ?></td>
                            <td><?php echo $pre['Presupuesto']['monto']; ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'presupuesto', $idGestion,$pre['Presupuesto']['id'])); ?>');" title="Editar Presupuesto" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $pre['Presupuesto']['id']), array('class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar Presupuesto', 'confirm' => 'Esta seguro de eliminar el presupuesto ' . $pre['Concepto']['nombre'] . '??', 'escape' => FALSE)) ?>
                            </td>
                        </tr>
                        <?php $totalmes = $totalmes + $pre['Presupuesto']['monto']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $totalmes; ?></td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <!-- END Example Content -->
    <!-- Example Content -->
    <?php $julio = $this->requestAction(array('action' => 'eingresos', $idGestion, 'Julio')) ?>
    <?php if (!empty($julio)): ?>
        <h3>JULIO</h3>
        <div class="table-responsive">
            <table id="general-table" class="table table-striped table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody><?php $totalmes = 0.00; ?>
                    <?php foreach ($julio as $pre): ?>
                        <tr>
                            
                            <td><?php echo $pre['Concepto']['nombre']; ?></td>
                            <td><?php echo $pre['Presupuesto']['tipo']; ?></td>
                            <td><?php echo $pre['Presupuesto']['monto']; ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'presupuesto', $idGestion,$pre['Presupuesto']['id'])); ?>');" title="Editar Presupuesto" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $pre['Presupuesto']['id']), array('class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar Presupuesto', 'confirm' => 'Esta seguro de eliminar el presupuesto ' . $pre['Concepto']['nombre'] . '??', 'escape' => FALSE)) ?>
                            </td>
                        </tr>
                        <?php $totalmes = $totalmes + $pre['Presupuesto']['monto']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $totalmes; ?></td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <!-- END Example Content -->
    <!-- Example Content -->
    <?php $agosto = $this->requestAction(array('action' => 'eingresos', $idGestion, 'Agosto')) ?>
    <?php if (!empty($agosto)): ?>
        <h3>AGOSTO</h3>
        <div class="table-responsive">
            <table id="general-table" class="table table-striped table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody><?php $totalmes = 0.00; ?>
                    <?php foreach ($agosto as $pre): ?>
                        <tr>
                            
                            <td><?php echo $pre['Concepto']['nombre']; ?></td>
                            <td><?php echo $pre['Presupuesto']['tipo']; ?></td>
                            <td><?php echo $pre['Presupuesto']['monto']; ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'presupuesto', $idGestion,$pre['Presupuesto']['id'])); ?>');" title="Editar Presupuesto" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $pre['Presupuesto']['id']), array('class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar Presupuesto', 'confirm' => 'Esta seguro de eliminar el presupuesto ' . $pre['Concepto']['nombre'] . '??', 'escape' => FALSE)) ?>
                            </td>
                        </tr>
                        <?php $totalmes = $totalmes + $pre['Presupuesto']['monto']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $totalmes; ?></td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <!-- END Example Content -->
    <!-- Example Content -->
    <?php $septiembre = $this->requestAction(array('action' => 'eingresos', $idGestion, 'Septiembre')) ?>
    <?php if (!empty($septiembre)): ?>
        <h3>SEPTIEMBRE</h3>
        <div class="table-responsive">
            <table id="general-table" class="table table-striped table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody><?php $totalmes = 0.00; ?>
                    <?php foreach ($septiembre as $pre): ?>
                        <tr>
                            
                            <td><?php echo $pre['Concepto']['nombre']; ?></td>
                            <td><?php echo $pre['Presupuesto']['tipo']; ?></td>
                            <td><?php echo $pre['Presupuesto']['monto']; ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'presupuesto', $idGestion,$pre['Presupuesto']['id'])); ?>');" title="Editar Presupuesto" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $pre['Presupuesto']['id']), array('class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar Presupuesto', 'confirm' => 'Esta seguro de eliminar el presupuesto ' . $pre['Concepto']['nombre'] . '??', 'escape' => FALSE)) ?>
                            </td>
                        </tr>
                        <?php $totalmes = $totalmes + $pre['Presupuesto']['monto']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $totalmes; ?></td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <!-- END Example Content -->
    <!-- Example Content -->
    <?php $octubre = $this->requestAction(array('action' => 'eingresos', $idGestion, 'Octubre')) ?>
    <?php if (!empty($octubre)): ?>
        <h3>OCTUBRE</h3>
        <div class="table-responsive">
            <table id="general-table" class="table table-striped table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody><?php $totalmes = 0.00; ?>
                    <?php foreach ($octubre as $pre): ?>
                        <tr>
                            
                            <td><?php echo $pre['Concepto']['nombre']; ?></td>
                            <td><?php echo $pre['Presupuesto']['tipo']; ?></td>
                            <td><?php echo $pre['Presupuesto']['monto']; ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'presupuesto', $idGestion,$pre['Presupuesto']['id'])); ?>');" title="Editar Presupuesto" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $pre['Presupuesto']['id']), array('class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar Presupuesto', 'confirm' => 'Esta seguro de eliminar el presupuesto ' . $pre['Concepto']['nombre'] . '??', 'escape' => FALSE)) ?>
                            </td>
                        </tr>
                        <?php $totalmes = $totalmes + $pre['Presupuesto']['monto']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $totalmes; ?></td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <!-- END Example Content -->
    <!-- Example Content -->
    <?php $noviembre = $this->requestAction(array('action' => 'eingresos', $idGestion, 'Noviembre')) ?>
    <?php if (!empty($noviembre)): ?>
        <h3>NOVIEMBRE</h3>
        <div class="table-responsive">
            <table id="general-table" class="table table-striped table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody><?php $totalmes = 0.00; ?>
                    <?php foreach ($noviembre as $pre): ?>
                        <tr>
                            
                            <td><?php echo $pre['Concepto']['nombre']; ?></td>
                            <td><?php echo $pre['Presupuesto']['tipo']; ?></td>
                            <td><?php echo $pre['Presupuesto']['monto']; ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'presupuesto', $idGestion,$pre['Presupuesto']['id'])); ?>');" title="Editar Presupuesto" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $pre['Presupuesto']['id']), array('class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar Presupuesto', 'confirm' => 'Esta seguro de eliminar el presupuesto ' . $pre['Concepto']['nombre'] . '??', 'escape' => FALSE)) ?>
                            </td>
                        </tr>
                        <?php $totalmes = $totalmes + $pre['Presupuesto']['monto']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $totalmes; ?></td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <!-- END Example Content -->
    <!-- Example Content -->
    <?php $diciembre = $this->requestAction(array('action' => 'eingresos', $idGestion, 'Diciembre')) ?>
    <?php if (!empty($diciembre)): ?>
        <h3>DICIEMBRE</h3>
        <div class="table-responsive">
            <table id="general-table" class="table table-striped table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody><?php $totalmes = 0.00; ?>
                    <?php foreach ($diciembre as $pre): ?>
                        <tr>
                            
                            <td><?php echo $pre['Concepto']['nombre']; ?></td>
                            <td><?php echo $pre['Presupuesto']['tipo']; ?></td>
                            <td><?php echo $pre['Presupuesto']['monto']; ?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'presupuesto', $idGestion,$pre['Presupuesto']['id'])); ?>');" title="Editar Presupuesto" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $pre['Presupuesto']['id']), array('class' => 'btn btn-danger btn-xs', 'title' => 'Eliminar Presupuesto', 'confirm' => 'Esta seguro de eliminar el presupuesto ' . $pre['Concepto']['nombre'] . '??', 'escape' => FALSE)) ?>
                            </td>
                        </tr>
                        <?php $totalmes = $totalmes + $pre['Presupuesto']['monto']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td><?php echo $totalmes; ?></td>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <!-- END Example Content -->
</div>
<!-- END Example Block -->