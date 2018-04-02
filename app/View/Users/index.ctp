<!-- END Blank Header -->
<!-- Example Block -->
<div class="col-md-6 col-8 align-self-center">
    <h2 class="text-themecolor m-b-0 m-t-0">Listado de Usuarios</h2>

</div>



<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">
                <!-- Example Content -->
                <div class="table-responsive">
                <table id="general-table" class="table table-vcenter table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Edificio</th>
                                <th class="text-nowrap">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $us): ?>
                                <tr>
                                    <td><?php echo $us['User']['nombre']; ?></td>
                                    <td><?php echo $us['User']['username']; ?></td>
                                    <td><?php echo $us['User']['role']; ?></td>
                                    <td><?php echo $us['Edificio']['nombre']; ?></td>
                                    <td class="text-nowrap">
                                        
                                            <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'usuario2',$us['User']['id'])); ?>');" title="Editar Usuario">
                                            <i class="fa fa-pencil"></i></a>
                                            <?php echo $this->Html->link('<i class="fa fa-close text-danger"></i>',array('action' => 'eliminar',$us['User']['id']),array('class' => 'btn btn-danger','title' => 'Eliminar Usuario','confirm' => 'Esta seguro de eliminar al usuario '.$us['User']['username'].'??','escape' => FALSE))?>
                                        
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <!-- END Example Content -->
            </div>
        </div>
        <!-- END Example Content -->
    </div>
</div>
<!-- END Example Block -->