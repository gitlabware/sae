<div class="col-md-6 col-8 align-self-center">
    <h2 class="text-themecolor m-b-0 m-t-0">Listado de Recibos</h2>
</div>
<div class="row">
<div class="col-12">
 <div class="card">
            <div class="card-body">
             <div class="table-responsive m-t-40">
        <table id="general-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Fecha</th>
                    <th>Pagador</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recibos as $re): ?>
                    <tr>
                        <td><?php echo $re['Recibo']['numero']; ?></td>
                        <td><?php echo $re['Recibo']['modified']; ?></td>
                        <td><?php echo $re['Recibo']['pagador']?></td>
                        <td><?php echo $re['Recibo']['estado']; ?></td>
                        <td class="text-center">
                            <div class="btn-group btn-group-xs">
                                <a href="<?php echo $this->Html->url(array('controller' => 'Ambientes','action' => 'recibo_pdf',$re['Recibo']['id'],0)); ?>" title="Ver Recibo" class="btn btn-info btn-sm" target="_blanck"><i class="fa fa-eye"></i></a>
                                <?php if($re['Recibo']['estado'] != 'Terminado'):?>
                                <a href="<?php echo $this->Html->url(array('controller' => 'Ambientes','action' => 'listadopago',$re['Recibo']['id'])); ?>" title="Modificar" class="btn btn-secondary btn-sm"><i class="fa fa-pencil"></i></a>
                                <?php endif;?>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>',array('action' => 'eliminar',$re['Recibo']['id']),array('class' => 'btn btn-danger btn-sm','title' => 'Eliminar Recibo','confirm' => 'Esta seguro de eliminar el recibo '.$re['Recibo']['numero'].'??','escape' => FALSE))?>
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