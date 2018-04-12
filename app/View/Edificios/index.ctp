<div class="row">
<div class="col-8 align-self-center">
    <h2 class="text-themecolor m-b-0 m-t-0">Listado de Edificios</h2>
</div>
    
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">               
                <div class="table-responsive m-t-40">
                    <table id="general-table" class="table table-striped table-bordered ">
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
                                    <a href="javascript:void(0)"
                                       onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'edificio', $ed['Edificio']['id'])); ?>');"
                                       title="Editar Edificio" class="btn btn-secondary btn-sm"><i
                                                class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0)"
                                       onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'usuarios', $ed['Edificio']['id'])); ?>');"
                                       title="Usuarios" class="btn btn-success btn-sm"><i class="fa fa-users"></i></a>
                                    <?php echo $this->Html->link('<i class="fa fa-tags"></i>', array('controller' => 'Ambientes', 'action' => 'edificio', $ed['Edificio']['id']), array('class' => 'btn btn-info btn-sm', 'title' => 'Ambientes', 'escape' => FALSE)) ?>
                                    <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'eliminar', $ed['Edificio']['id']), array('class' => 'btn btn-danger btn-sm', 'title' => 'Eliminar Edificio', 'confirm' => 'Esta seguro de eliminar al edificio ' . $ed['Edificio']['nombre'] . '??', 'escape' => FALSE)) ?>
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