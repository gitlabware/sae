<!-- Modal Header -->
<div class="modal-header">
 <h2 class="modal-title"><i class="fa fa-user"></i>Nuevo Inquilino o Propietario</h2>
 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
 </button>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<?php echo $this->Form->create('Usuario',array('action' => 'registra_usuario'));?>
<div class="modal-body">
    <div class="form-group">
        <label class="control-label">Nombre</label>

        <?php echo $this->Form->hidden('User.id');?>
        <?php echo $this->Form->text('User.nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de usuario', 'required')); ?>

    </div>
    <div class="form-group">
        <label class="control-label">C.I.:</label>

        <?php echo $this->Form->text('User.ci', array('class' => 'form-control','type' => 'number', 'placeholder' => 'Ingrese el C.I.:', 'required')); ?>
    </div>

    <div class="form-group">
        <label class="control-label" for="user-settings-email">Telefonos</label>

        <?php echo $this->Form->text('User.telefonos', array('class' => 'form-control','type' => 'number', 'placeholder' => 'Ingrese los telefonos')); ?>
    </div>

    <div class="form-group">
        <label class="control-label" for="user-settings-email">Direccion</label>

        <?php echo $this->Form->text('User.direccion', array('class' => 'form-control','placeholder' => 'Ingrese la direccion')); ?>
    </div>

    <div class="form-group">
        <label class="control-label" for="user-settings-email">E-mail</label>

        <?php echo $this->Form->text('User.email', array('class' => 'form-control', 'type' => 'email','placeholder' => 'Ingrese correo electronico')); ?>
    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-danger btn-primary">Guardar</button>
</div>

<?php echo $this->Form->end();?>
<!-- END Modal Body -->