<!-- Blank Header -->
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-brush"></i>Edificios<br>
        </h1>
    </div>
</div>
<!-- END Blank Header -->
<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de Edificios</h2>
    </div>
    <!-- END Example Title -->
    <div class="table-options clearfix">
        <div class="btn-group btn-group-sm pull-right">
            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'edificio')); ?>');" class="btn btn-primary" title="Adicionar nuevo Usuario">NUEVO</a>
        </div>
    </div>
    <!-- Example Content -->
    <div class="table-responsive">
        <table id="general-table" class="table table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Telefonos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($edificios as $ed): ?>
                    <tr>
                        <td><?php echo $ed['Edificio']['nombre']; ?></td>
                        <td><?php echo $ed['Edificio']['direccion']; ?></td>
                        <td><?php echo $ed['Edificio']['telefonos']; ?></td>
                        <td class="text-center">
                            <div class="btn-group btn-group-xs">
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'edificio', $ed['Edificio']['id'])); ?>');" title="Editar Edificio" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Conceptos','action' => 'eservicios', $ed['Edificio']['id'])); ?>');" title="Servicios" class="btn btn-info"><i class="fa fa-briefcase"></i></a>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'usuarios', $ed['Edificio']['id'])); ?>');" title="Usuarios" class="btn btn-success"><i class="fa fa-users"></i></a>
                                    <?php echo $this->Html->link('<i class="fa fa-tags"></i>', array('controller' => 'Ambientes', 'action' => 'edificio', $ed['Edificio']['id']), array('class' => 'btn btn-info', 'title' => 'Ambientes', 'escape' => FALSE)) ?>
                                    <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $ed['Edificio']['id']), array('class' => 'btn btn-danger', 'title' => 'Eliminar Edificio', 'confirm' => 'Esta seguro de eliminar al edificio ' . $ed['Edificio']['nombre'] . '??', 'escape' => FALSE)) ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- END Example Content -->
</div>
<!-- END Example Block -->