<div class="col-md-6 col-8 align-self-center">
    <h2 class="text-themecolor m-b-0 m-t-0">Listado de Administradores</h2>
</div>
<div class="row">
    <!-- Example Title -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive m-t-40">                   
                    <table id="general-table" class="table table-bordered">
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
                                        <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'usuario3',$us['User']['id'])); ?>');" title="Editar Usuario" class="btn btn-secondary btn-sm "><i class="fa fa-pencil"></i></a>
                                            <?php echo $this->Html->link('<i class="fa fa-times"></i>',array('action' => 'eliminar',$us['User']['id']),array('class' => 'btn btn-danger btn-sm','title' => 'Eliminar Usuario','confirm' => 'Esta seguro de eliminar al usuario '.$us['User']['username'].'??','escape' => FALSE))?>
                                        </div>
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