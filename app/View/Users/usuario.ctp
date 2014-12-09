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
            <div class="form-group">
                <label class="col-md-4 control-label">Nombre</label>
                <div class="col-md-8">
                    <?php echo $this->Form->hidden('id');?>
                    <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de usuario', 'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Nombre de usuario</label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('username', array('class' => 'form-control', 'placeholder' => 'Ingrese el Username', 'required')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Role</label>
                <div class="col-md-8">
                    <?php echo $this->Form->select('role', array('Administrador' => 'Administrador'), array('class' => 'form-control', 'required')); ?>
                </div>
            </div>
            <?php
            $required = '';
            $placeholder = 'Ingrese nuevo password';
            if (empty($this->request->data['User']['id'])) {
                $required = 'required';
                $placeholder = 'Ingrese un password';
            }
            ?>
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Contrase&ntilde;a</label>
                <div class="col-md-8">
                    <?php echo $this->Form->password('password', array('class' => 'form-control', 'placeholder' => $placeholder,$required,'value' => '')); ?>
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