<!-- Blank Header -->
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-brush"></i>Gestiones<br>
        </h1>
    </div>
</div>
<!-- END Blank Header -->
<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Listado de Presupuestos</h2>
    </div>
    <!-- END Example Title -->
    <div class="table-options clearfix">
        <div class="btn-group btn-group-sm pull-right">
            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'gestion')); ?>');" class="btn btn-primary" title="Adicionar nuevo Usuario">NUEVO</a>
        </div>
    </div>
    <!-- Example Content -->
    <div class="table-responsive">
        <table id="general-table" class="table table-striped table-vcenter table-hover">
            <thead>
                <tr>
                    <th>Gestion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gestiones as $ges): ?>
                    <tr>
                        <td><?php echo $ges['Gestione']['ano']; ?></td>
                        <td class="text-center">
                            <div class="btn-group btn-group-xs">
                                <?php echo $this->Html->link('<i class="fa fa-table"></i>',array('action' => 'presupuestos',$ges['Gestione']['id']),array('class' => 'btn btn-info','title' => 'Presupuesto','escape' => FALSE));?>
                                <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'gestion',$ges['Gestione']['id'])); ?>');" title="Editar Usuario" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                <?php echo $this->Html->link('<i class="fa fa-times"></i>',array('action' => 'eliminar',$ges['Gestione']['id']),array('class' => 'btn btn-danger','title' => 'Eliminar Edificio','confirm' => 'Esta seguro de eliminar al edificio '.$ges['Gestione']['ano'].'??','escape' => FALSE))?>
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