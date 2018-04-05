<div class="row">
    <div class="col-md-12">
        <!-- Basic Form Elements Block -->
        <div class="card">
            <!-- Basic Form Elements Title -->
            <div class="card-header">
                <h4>REPORTE DE BALANCE GENERAL</h4>
            </div>
            <div class="card-body">
                <div class="form-horizontal form-bordered">
                    <?php echo $this->Form->create('Presupuesto'); ?>
                    <div class="form-group no-imrprime-p">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">Fecha_Inicio</label>
                                <?php echo $this->Form->date('Dato.fecha_ini', array('class' => 'form-control no-imrprime-p', 'required')); ?>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Fecha_Fin</label>
                                <?php echo $this->Form->date('Dato.fecha_fin', array('class' => 'form-control no-imrprime-p', 'required', 'value' => date('Y-m-d'))); ?>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Nivel</label>
                                <?php echo $this->Form->select('Dato.nivel', array(0 => 1, 1 => 2, 2 => 3, 3 => 4, 4 => 5, 5 => 6, 6 => 7), array('class' => 'form-control', 'empty' => false, 'required')); ?>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary form-control text-white">GENERAR</button>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12" id="divtablapagos">
                                <?php if (!empty($hijos)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-vcenter">
                                            <thead>
                                                <tr>
                                                    <td>Codigo</td>
                                                    <td>Nombre</td>
                                                    <td>Bolivianos</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($hijos as $hi): ?>
                                                    <tr>
                                                        <td><?php echo $hi['Nomenclatura']['codigo_completo'] ?></td>
                                                        <td><?php echo $hi['Nomenclatura']['espacios'] . ' ' . $hi['Nomenclatura']['nombre'] ?></td>
                                                        <td><?php echo $hi['Nomenclatura']['total'] ?></td>
                                                    </tr>
                                                    <?php foreach ($hi['Nomenclatura']['ambientes'] as $am): ?>
                                                        <tr>
                                                            <td><?php echo $hi['Nomenclatura']['codigo_completo'].'-'.$am['NomenclaturasAmbiente']['codigo'] ?></td>
                                                            <td><?php echo $hi['Nomenclatura']['espacios'] . '----' . $am['NomenclaturasAmbiente']['nombre_ambiente'] ?></td>
                                                            <td><?php echo $am['NomenclaturasAmbiente']['total'] ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
