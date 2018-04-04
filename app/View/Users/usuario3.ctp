<div class="modal-header">
 <h2 class="modal-title"><i class="fa fa-user"></i></i>Usuario</h2>
 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
 </button>
</div>
<?php echo $this->Form->create('User',array('action' => 'guarda_usuario'));?>

<div class="modal-body">        
    <div class="form-group">
        <label class="control-label">Nombre</label>                
        <?php echo $this->Form->hidden('User.id'); ?>
        <?php echo $this->Form->hidden('User.role', array('value' => 'Administrador')) ?>
        <?php echo $this->Form->hidden('User.edificio_id') ?>
        <?php echo $this->Form->text('User.nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de Propietario', 'required')); ?>                
    </div>
    <div class="form-group">
        <label class="control-label" for="user-settings-email">Telefonos</label>

        <?php echo $this->Form->text('User.telefonos', array('class' => 'form-control', 'placeholder' => 'Ingrese los telefonos', 'required')); ?>

    </div>
    <div class="form-group">
        <label class="control-label" for="user-settings-email">Direccion</label>

        <?php echo $this->Form->text('User.direccion', array('class' => 'form-control', 'placeholder' => 'Ingrese la direccion')); ?>

    </div>
    <div class="form-group">
        <label class="control-label" for="user-settings-email">E-mail</label>                
        <?php echo $this->Form->text('User.email', array('class' => 'form-control', 'placeholder' => 'Ingrese correo electronico')); ?>                
    </div>
    <div class="form-group">
        <label class="control-label" for="user-settings-email">Usuario</label>                
        <?php echo $this->Form->text('User.username', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de usuario', 'required')); ?>                
    </div>
    <div class="form-group">
        <label class="control-label" for="user-settings-email">Contrase&ntilde;a</label>                
        <?php echo $this->Form->password('User.password2', array('class' => 'form-control', 'placeholder' => 'Ingrese un password')); ?>                
    </div>      
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-danger btn-primary">Guardar</button>
</div>
<?php echo $this->Form->end();?>