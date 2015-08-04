<!-- END Blank Header -->
<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de Recibos</h2>
    </div>    
    <!-- Example Content -->
    <div class="table-responsive">
        <table id="general-table" class="table table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recibos as $re): ?>
                    <tr>
                        <td><?php echo $re['Recibo']['numero']; ?></td>
                        <td><?php echo $re['Recibo']['modified']; ?></td>
                        <td>
                          <?php
                        if(!empty($re['Propietario']['nombre'])){
                          echo $re['Propietario']['nombre'];
                        }else{
                          echo $re['Inquilino']['nombre'];
                        }
                        ?>
                        </td>
                        <td><?php echo $re['Recibo']['estado']; ?></td>
                        <td class="text-center">
                            <div class="btn-group btn-group-xs">
                                <a href="<?php echo $this->Html->url(array('controller' => 'Ambientes','action' => 'listadopago',$re['Recibo']['id'])); ?>" title="Ver recibo" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>',array('action' => 'eliminar',$re['Recibo']['id']),array('class' => 'btn btn-danger','title' => 'Eliminar Recibo','confirm' => 'Esta seguro de eliminar el recibo '.$re['Recibo']['numero'].'??','escape' => FALSE))?>
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