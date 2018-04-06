<!-- Modal Header -->
<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-calendar"></i>Presupuesto</h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
    </button>
</div>

<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Presupuesto', array('action' => 'guarda_gestion', 'class' => 'form-horizontal form-bordered')); ?>
    <div class="row">
        <div class="col-12">
            <fieldset>
                <legend>Informacion de Gestion </legend>
                <div class="form-group">
                    <label class="col-4 control-label">A&ntilde;o</label>
                    <div class="col-8">
                        <?php echo $this->Form->hidden('id'); ?>
                        <?php $idEdificio =  $this->Session->read('Auth.User.edificio_id')?>
                        <?php echo $this->Form->hidden('edificio_id',array('value' => $idEdificio)); ?>
                        <?php echo $this->Form->text('gestion', array('class' => 'form-control', 'placeholder' => 'Ingrese el año', 'required','type' => 'number','min' => 1900,'max' => 2050)); ?>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="modal-footer">
        
            <button type="button" class="btn btn-white waves-effectt" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
        
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<!-- END Modal Body -->