<div class="row">
    <div class="col-md-12">
        <!-- Basic Form Elements Block -->
        <div class="block">
            <!-- Basic Form Elements Title -->
            <div class="block-title">
                <h2>CUENTAS POR COBRAR POR GESTION EN MORA</h2>
            </div>
            <div class="form-horizontal form-bordered">
                <?php echo $this->Form->create('Reporte', array('action' => 'xgestionmora')); ?>
                <div class="form-group">
                    <div class="col-md-4">
                        <label class="control-label">Hasta fecha</label>
                        <?php echo $this->Form->date('fecha', array('class' => 'form-control', 'required')); ?>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">&nbsp;</label>
                        <button class="btn btn-primary form-control">GENERAR</button>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
        
        <div class="block">
            <!-- Basic Form Elements Title -->
            <div class="block-title">
                <h2>CUOTAS DE MANTENIMIENTO POR COBRAR</h2>
            </div>
            <div class="form-horizontal form-bordered">
                <?php echo $this->Form->create('Reporte', array('action' => 'manteoxcobrar')); ?>
                <div class="form-group">
                    <div class="col-md-4">
                        <label class="control-label">Hasta fecha</label>
                        <?php echo $this->Form->date('fecha', array('class' => 'form-control', 'required')); ?>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">&nbsp;</label>
                        <button class="btn btn-primary form-control">GENERAR</button>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
        
        <div class="block">
            <!-- Basic Form Elements Title -->
            <div class="block-title">
                <h2>CUOTAS POR COBRAR POR AMBIENTE</h2>
            </div>
            <div class="form-horizontal form-bordered">
                <?php echo $this->Form->create('Reporte', array('action' => 'xcobrarambiente')); ?>
                <div class="form-group">
                    <div class="col-md-4">
                        <label class="control-label">Hasta fecha</label>
                        <?php echo $this->Form->date('fecha', array('class' => 'form-control', 'required')); ?>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">&nbsp;</label>
                        <button class="btn btn-primary form-control">GENERAR</button>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>