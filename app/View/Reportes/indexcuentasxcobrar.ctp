<div class="row">
    <div class="col-md-12">
        <!-- Basic Form Elements Block -->
        <div class="card">
            <!-- Basic Form Elements Title -->
            <div class="card-header">
                <H4>ESTADO DE CUENTAS SEGUN TIPO POR GESTION EN MORA</H4>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create('Reporte', array('action' => 'xgestionmora')); ?>
                <div class="form-group">
                    <div class="row">

                        <div class="col-md-4">
                            <label class="control-label">Hasta fecha</label>
                            <?php echo $this->Form->date('fecha', array('class' => 'form-control', 'required')); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Tipo</label>
                            <?php echo $this->Form->select('tipo',array('Debe' => 'Por Cobrar','Pagado' => 'Pagado'),array('empty' => 'Seleccione el tipo de pago','class' => 'form-control','required','value' => 'Debe'))?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">&nbsp;</label>
                            <button class="btn btn-primary form-control text-white">GENERAR</button>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>

        <div class="card">
            <!-- Basic Form Elements Title -->
            <div class="card-header">
                <H4>CUOTAS DE MANTENIMIENTO SEGUN TIPO</H4>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create('Reporte', array('action' => 'manteoxcobrar')); ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Hasta fecha</label>
                            <?php echo $this->Form->date('fecha', array('class' => 'form-control', 'required')); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Tipo</label>
                            <?php echo $this->Form->select('tipo',array('Debe' => 'Por Cobrar','Pagado' => 'Pagado'),array('empty' => 'Seleccione el tipo de pago','class' => 'form-control','required','value' => 'Debe'))?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">&nbsp;</label>
                            <button class="btn btn-primary form-control text-white">GENERAR</button>
                        </div>
                    </div>
                    
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
        
        <div class="card">
            <!-- Basic Form Elements Title -->
            <div class="card-header">
                <H4>CUOTAS DE MANTENIMIENTO SEGUN TIPO Y GESTION</H4>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create('Reporte', array('action' => 'manteoxcobrarges')); ?>
                <div class="form-group">
                    <div class="row">

                        <div class="col-md-4">
                            <label class="control-label">Tipo</label>
                            <?php echo $this->Form->select('tipo',array('Debe' => 'Por Cobrar','Pagado' => 'Pagado'),array('empty' => 'Seleccione el tipo de pago','class' => 'form-control','required','value' => 'Debe'))?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Gestion</label>
                            <?php echo $this->Form->select('gestion',$gestiones,array('empty' => 'Seleccione la gestion','class' => 'form-control','required'))?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">&nbsp;</label>
                            <button class="btn btn-primary form-control text-white">GENERAR</button>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>

        <div class="card">
            <!-- Basic Form Elements Title -->
            <div class="card-header">
                <H4>CUOTAS SEGUN TIPO POR AMBIENTE</H4>
            </div>
            <div class="card-body">
                <?php echo $this->Form->create('Reporte', array('action' => 'xcobrarambiente')); ?>
                <div class="form-group">
                    <div class="row">

                        <div class="col-md-4">
                            <label class="control-label">Hasta fecha</label>
                            <?php echo $this->Form->date('fecha', array('class' => 'form-control', 'required')); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Tipo</label>
                            <?php echo $this->Form->select('tipo',array('Debe' => 'Por Cobrar','Pagado' => 'Pagado'),array('empty' => 'Seleccione el tipo de pago','class' => 'form-control','required','value' => 'Debe'))?>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">&nbsp;</label>
                            <button class="btn btn-primary form-control text-white">GENERAR</button>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>