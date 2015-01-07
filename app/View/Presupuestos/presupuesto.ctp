<?php 
$meses = array(
    'Enero' => 'Enero','Febrero' => 'Febrero','Marzo' => 'Marzo','Abril' => 'Abril','Mayo' => 'Mayo','Junio' => 'Junio','Julio' => 'Julio',
    'Agosto' => 'Agosto','Septiembre' => 'Septiembre','Octubre' => 'Octubre','Noviembre' => 'Noviembre','Diciembre' => 'Diciembre'
);
?>
<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-calendar"></i> Presupuesto</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Presupuesto', array('action' => 'guarda_presupuesto', 'class' => 'form-horizontal form-bordered')); ?>
    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <legend>Informacion de Presupuesto gestion <?php echo $gestion['Gestione']['ano'];?></legend>
                <div class="form-group">
                    <label class="col-md-3 control-label">Concepto</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->hidden('id'); ?>
                        <?php $idEdificio =  $this->Session->read('Auth.User.edificio_id')?>
                        <?php echo $this->Form->hidden('edificio_id',array('value' => $idEdificio)); ?>
                        <?php echo $this->Form->hidden('gestione_id',array('value' => $gestion['Gestione']['id'])); ?>
                        <?php echo $this->Form->select('concepto_id',$conceptos,array('class' => 'form-control', 'required')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tipo</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->select('tipo',array('Egreso' => 'Egreso','Ingreso' => 'Ingreso'),array('class' => 'form-control','required'));?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Monto</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->text('monto',array('class' => 'form-control','required','type' => 'number','min' => 0,'step' => 'any'));?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Mes</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->select('mes',$meses,array('class' => 'form-control','required'));?>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="form-group form-actions">
        <div class="col-xs-12 text-right">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<!-- END Modal Body -->