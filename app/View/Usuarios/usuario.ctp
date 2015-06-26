<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-user"></i> Usuario</h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('Usuario',array('action' => 'registra_usuario','class' => 'form-horizontal form-bordered'));?>
        <fieldset>
            <legend>Informacion de Usuario</legend>
            <div class="form-group">
                <label class="col-md-4 control-label">Nombre</label>
                <div class="col-md-8">
                    <?php echo $this->Form->hidden('User.id');?>
                    <?php echo $this->Form->text('User.nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de usuario', 'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">C.I.:</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('User.ci', array('class' => 'form-control', 'placeholder' => 'Ingrese el C.I.:', 'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Telefonos</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('User.telefonos', array('class' => 'form-control', 'placeholder' => 'Ingrese los telefonos')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Direccion</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('User.direccion', array('class' => 'form-control','placeholder' => 'Ingrese la direccion')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">E-mail</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('User.email', array('class' => 'form-control', 'placeholder' => 'Ingrese correo electronico')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Nombre de usuario</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('User.username', array('class' => 'form-control', 'placeholder' => 'Ingrese el Username')); ?>
                </div>
            </div>
            <?php if($this->Session->read('Auth.User.role') == "Administrator"):?>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Role</label>
                <div class="col-md-8">
                    <?php echo $this->Form->select('User.role', array('Propietario' => 'Propietario','Inquilino' => 'Inquilino'), array('class' => 'form-control')); ?>
                </div>
            </div>
            <?php endif;?>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Contrase&ntilde;a</label>
                <div class="col-md-8">
                    <?php echo $this->Form->password('User.password2', array('class' => 'form-control', 'placeholder' => "Ingrese un nuevo password",'value' => '')); ?>
                </div>
            </div>
        </fieldset>
        <div class="form-group form-actions">
            <div class="col-xs-12 text-right">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
            </div>
        </div>
    <?php echo $this->Form->end();?>
</div>
<!-- END Modal Body -->