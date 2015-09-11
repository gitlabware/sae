<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-calendar"></i> Presupuesto</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Presupuesto', array('action' => 'guarda_gestion', 'class' => 'form-horizontal form-bordered')); ?>
    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <legend>Informacion de Gestion </legend>
                <div class="form-group">
                    <label class="col-md-4 control-label">A&ntilde;o</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->hidden('id'); ?>
                        <?php $idEdificio =  $this->Session->read('Auth.User.edificio_id')?>
                        <?php echo $this->Form->hidden('edificio_id',array('value' => $idEdificio)); ?>
                        <?php echo $this->Form->text('gestion', array('class' => 'form-control', 'placeholder' => 'Ingrese el año', 'required','type' => 'number','min' => 1900,'max' => 2050)); ?>
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