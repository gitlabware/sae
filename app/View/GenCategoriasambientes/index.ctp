<div class="col-md-6 col-8 align-self-center">
    <h2 class="text-themecolor m-b-0 m-t-0">Listado de Categorias Ambiente</h2>
</div>

<!-- END Blank Header -->
<!-- Example Block -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
               <div class="table-responsive m-t-40">
                <table id="general-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($gen_ambientes as $gen): ?>
                            <tr>
                                <td><?php echo $gen['GenCategoriasambiente']['nombre'] ?></td>
                                <td><?php echo $gen['GenCategoriasambiente']['descripcion']; ?></td>
                                <td class="text-center">
                                    
                                        <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'gencategoria', $gen['GenCategoriasambiente']['id'])); ?>');" title="Editar Categoria" class="btn btn-secondary btn-sm"><i class="fa fa-pencil"></i></a>
                                        <?php echo $this->Html->link('<i class="fa fa-times"></i>', array('action' => 'delete', $gen['GenCategoriasambiente']['id']), array('class' => 'btn btn-danger btn-sm', 'title' => 'Eliminar Categoria', 'confirm' => 'Esta seguro de eliminar la categoria ' . $gen['GenCategoriasambiente']['nombre'] . '??', 'escape' => FALSE)) ?>
                                    
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
<!-- END Example Block -->

