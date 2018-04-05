<!-- Modal Header -->
<div class="modal-header">
    <h2 class="modal-title"><i class="fa fa-building"></i>Cuenta</h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
    </button>
</div>
 <?php echo $this->Form->create('Cuenta', array('action' => 'guarda_cuenta', 'id' => 'form-cuenta')); ?>

<div class="modal-body">
            
                <legend>Informacion de Edificio </legend>
                <div class="form-group">
                    <label class="col-md-4 control-label">Nombre</label>
                    
                        <?php echo $this->Form->hidden('id'); ?>
                        <?php echo $this->Form->hidden('edificio_id',array('value' => $this->Session->read('Auth.User.edificio_id'))); ?>
                        <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la cuenta', 'required')); ?>
                    
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Monto</label>
                    
                        <?php echo $this->Form->text('monto', array('class' => 'form-control', 'placeholder' => 'Ingrese el monto', 'required','type' => 'number','step' => 'any')); ?>
                    
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Descripcion</label>
                    
                        <?php echo $this->Form->text('descripcion', array('class' => 'form-control', 'placeholder' => 'Ingrese una descripcion')); ?>
                    
                </div>
            
        </div>
    
    <div class="form-group modal-footer">
        
            <button type="button" class="btn btn-white waves-effectt" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
        
    </div>

</div>

    <?php echo $this->Form->end(); ?>
<!-- END Modal Body -->

