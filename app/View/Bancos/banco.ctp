<div class="modal-header">
    <h2 class="modal-title"><i class="fa fa-bank"></i>Banco/caja</h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
    </button>
</div>

<?php echo $this->Form->create('Banco', array('action' => 'registra', 'id' => 'form-edificio', 'enctype' => 'multipart/form-data'));?>

<div class="modal-body">            
    <div class="form-group">
        <label class="col-md-4 control-label">Codigo</label>

        <?php echo $this->Form->hidden('id');?>
        <?php echo $this->Form->text('codigo_cuenta', array('class' => 'form-control', 'placeholder' => 'Ingrese el codigo de cuenta '));?>      
    </div>
    <div class="form-group">
        <label class="col-md-10 control-label" for="user-settings-email">Nombre</label>

        <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre', 'required'));?>
    </div>
    <div class="form-group">
        <label class="col-md-10 control-label" for="user-settings-email">Plan de Cuentas</label>

        <?php echo $this->Form->select('nomenclatura_id',$nomenclaturas, array('class' => 'form-control', 'empty' => 'Seleccione el Plan de Cuenta','required'));?>                   
    </div>
    <div class="form-group">
        <label class="col-md-10 control-label" for="user-settings-email">Numero de cuenta</label>

        <?php echo $this->Form->text('numero_cuenta', array('class' => 'form-control', 'placeholder' => 'Ingrese el numero de cuenta'));?>                    
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" for="user-settings-email">Fondo</label>

        <?php echo $this->Form->select('cuenta_id',$cuentas, array('class' => 'form-control', 'empty' => 'Seleccione Fondo'));?>    
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" for="user-settings-email">Monto</label>

        <?php echo $this->Form->text('monto', array('class' => 'form-control', 'placeholder' => 'Monto en caja/banco','step' => 'any','type' => 'number','required'));?>   
    </div>



</div>

<div class="form-group modal-footer">

    <button type="button" class="btn btn-white waves-effectt" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>

</div>


<?php echo $this->Form->end();?>
<!-- Plan de Cuentas  
php echo $this->Form->select(array('class' => ' select-chosen', 'empty' => 'Seleccione el Plan de Cuenta','required')) -->

<script>
    $('.select-chosen').chosen({width: "100%"});
</script>