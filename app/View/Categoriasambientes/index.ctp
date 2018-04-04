<div class="col-md-6 col-8 align-self-center">
    <h2 class="text-themecolor m-b-0 m-t-0">Listado de Categorias Ambiente</h2>
</div><!-- Blank Header -->

<!-- END Blank Header -->
<!-- Example Block -->

<div class="row">
    <div class="col-12">
     <div class="btn-group btn-group-sm pull-right">
        <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'categoria')); ?>');" class="btn btn-rounded btn-block btn-warning" title="Adicionar nueva Categoria Ambiente">NUEVA CATEGORIA</a>
    </div>
</div>
<div class="col-12">
    <div class="card">
        <div class="card-body">
           <div class="table-responsive m-t-40">
            <table id="general-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Constante</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $ca): ?>
                        <tr>
                            <td><?php echo $ca['Categoriasambiente']['nombre']; ?></td>
                            <td><?php echo $ca['Categoriasambiente']['constante']; ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-xs">
                                    <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'categoria',$ca['Categoriasambiente']['id'])); ?>');" title="Editar Categoria" class="btn btn-secondary btn-sm"><i class="fa fa-pencil"></i></a>
                                    <?php echo $this->Html->link('<i class="fa fa-times"></i>',array('action' => 'eliminar',$ca['Categoriasambiente']['id']),array('class' => 'btn btn-danger btn-sm','title' => 'Eliminar Categoria','confirm' => 'Esta seguro de eliminar la categoria '.$ca['Categoriasambiente']['nombre'].'??','escape' => FALSE))?>
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
<!-- END Example Content -->
</div>
<?php $this->start('campo_js') ?>
<script src="<?php echo $this->webroot; ?>template/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!--<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>-->
<script>
    $('#general-table').DataTable();
</script>
<?php $this->end() ?>
<!-- END Example Block -->