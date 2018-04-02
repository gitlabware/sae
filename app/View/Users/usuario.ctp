<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-user"></i> Usuario</h2>
</div>
<!-- END Modal Header -->

<!-- Modal Body -->
<div class="modal-body">
    <?php echo $this->Form->create('User',array('action' => 'guarda_usuario','class' => 'form-horizontal form-bordered'));?>
        <fieldset>
            <legend>Informacion de Usuario</legend>

            
                <label class="col-md-12 control-label">Nombre</label>
                <div class="col-md-12">
                    <?php echo $this->Form->hidden('id');?>
                    <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de usuario', 'required')); ?>
                </div><br>
            
            
                <label class="col-md-12 control-label" for="user-settings-email">Nombre de usuario</label>
                <div class="col-md-12">
                    <?php echo $this->Form->text('username', array('class' => 'form-control', 'placeholder' => 'Ingrese el Username', 'required')); ?>
                </div><br>
            
            
                <label class="col-md-12 control-label" for="user-settings-email">Role</label>
                <div class="col-md-12">
                    <?php echo $this->Form->select('role', array('Super Administrador' => 'Super Administrador','Administrador' => 'Administrador'), array('class' => 'form-control', 'required')); ?>
                </div><br>
            
            <?php
            $required = '';
            $placeholder = 'Ingrese nuevo password';
            if (empty($this->request->data['User']['id'])) {
                $required = 'required';
                $placeholder = 'Ingrese un password';
            }
            ?>
            
                <label class="col-md-12 control-label" for="user-settings-email">Contrase&ntilde;a</label>
                <div class="col-md-12">
                    <?php echo $this->Form->password('password', array('class' => 'form-control', 'placeholder' => $placeholder,$required,'value' => '')); ?>
                </div><br>
            
        </fieldset>
        <div class="form-group form-actions">
            <div class="col-xs-12 text-right">
                <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger btn-primary">Guardar</button>
            </div>
        </div>
    <?php echo $this->Form->end();?>
</div>
<!-- END Modal Body -->