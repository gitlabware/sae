<div class="card card-outline-inverse">
    <div class="card-header">
        <h4 class="m-b-0 text-white">Excel por cobrar</h4>
    </div>
    <div class="card-body">
        <?php echo $this->Form->create('Pago', array('class' => 'form-horizontal form-bordered', 'action' => 'registra_excel', 'enctype' => 'multipart/form-data')); ?>

        <div class="form-group">
            <div class="row">
                
                <div class="col-md-6">
                    <?php echo $this->Form->file('Excel.excel', array('class' => 'form-control', 'accept' => '.xlsx', 'placeholder' => 'Seleccione el archivo excel', 'required')) ?>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">SUBIR EXCEL</button>
                    <a href="<?php echo $this->webroot; ?>img/formatos/excel-xcobrar2.png" data-toggle="lightbox-image" title="Formato para poder cargar registros de excel" class="gallery-link btn btn-success"><i class="fa fa-eye"></i> Ver Formato excel</a>
                    <a href="<?php echo $this->webroot; ?>img/formatos/formato-excel1.xlsx" title="Descargar formato" class="gallery-link btn btn-success"><i class="fa fa-download"></i> Descargar Formato</a>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>


</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter table-hover">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Excel</th>
                                <th>Gestion</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($excels as $ex): ?>
                              <tr>
                                  <td><?php echo $ex['Excel']['modified']; ?></td>
                                  <td><?php echo $ex['Excel']['nombre']; ?></td>
                                  <td><?php echo $ex['Excel']['gestion']; ?></td>
                                  <td>
                                    <?php echo $this->Html->link('Ver excel',array('action' => 'det_pagos',$ex['Excel']['id']),array('class' => 'btn btn-sm btn-primary'))?>
                                    <?php echo $this->Html->link('Eliminar',array('action' => 'elimina_excel',$ex['Excel']['id']),array('class' => 'btn btn-sm btn-danger','confirm' => 'Esta seguro de eliminar??'))?>
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