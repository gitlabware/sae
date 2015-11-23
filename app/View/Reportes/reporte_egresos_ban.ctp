<div class="row">
    <div class="col-md-12">
        <!-- Basic Form Elements Block -->
        <div class="block">
            <!-- Basic Form Elements Title -->
            <div class="block-title">
                <h2>REPORTE DE EGRESOS SEGUN BANCO/CAJA</h2>
            </div>
            <div class="form-horizontal form-bordered">
                <?php echo $this->Form->create('Reporte', array('id' => 'ajaxform')); ?>
                <div class="form-group">
                    <div class="col-md-3">
                        <label class="control-label">Fecha_Inicio</label>
                        <?php echo $this->Form->date('fecha_ini', array('class' => 'form-control', 'required')); ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Fecha_Fin</label>
                        <?php echo $this->Form->date('fecha_fin', array('class' => 'form-control', 'required')); ?>
                    </div>

                    <div class="col-md-4">
                        <label class="control-label">Banco/Caja</label>
                        <?php echo $this->Form->select('banco_id', $bancos, array('class' => 'form-control', 'requied')); ?>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label">&nbsp;</label>
                        <button class="btn btn-primary form-control">BUSCAR</button>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
                <div class="form-group">
                    <div class="col-md-12" id="divtablapagos">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Fecha</th>
                                    <th>Referencia</th>
                                    <th>Proveedor</th>
                                    <th>Detalle</th>
                                    <th>Tipo Cuenta</th>
                                    <th>Monto</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($egresos as $key => $eg): ?>
                                  <tr>
                                      <td><?php echo $key ?></td>
                                      <td><?php echo $eg['Egreso'] ?></td>
                                  </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
