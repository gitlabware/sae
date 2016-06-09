<!-- END Blank Header -->
<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de Usuarios</h2>
    </div>    
    <!-- Example Content -->
    <div class="table-responsive">
        <table id="general-table" class="table table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Username</th>
                    <th>Telefonos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $us): ?>
                    <tr>
                        <td><?php echo $us['User']['nombre']; ?></td>
                        <td><?php echo $us['User']['username']; ?></td>
                        <td><?php echo $us['User']['telefonos']; ?></td>
                        <td class="text-center">
                            <div class="btn-group btn-group-xs">
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'usuario3',$us['User']['id'])); ?>');" title="Editar Usuario" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>',array('action' => 'eliminar',$us['User']['id']),array('class' => 'btn btn-danger','title' => 'Eliminar Usuario','confirm' => 'Esta seguro de eliminar al usuario '.$us['User']['username'].'??','escape' => FALSE))?>
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