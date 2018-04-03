<!-- Modal Header -->
<div class="modal-header">
<h2 class="modal-title"><i class="fa fa-user"></i>Usuario</h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
    </button>
</div><!-- END Modal Header -->

<!-- Modal Body -->
<?php echo $this->Form->create('User',array('action' => 'guarda_usuario','class' => 'form-horizontal form-bordered'));?>
<div class="modal-body">             

    <div class="form-group"> 
        <label class="control-label">Nombre</label>

        <?php echo $this->Form->hidden('id');?>
        <?php echo $this->Form->text('nombre', array('class' => 'form-control', 'placeholder' => 'Ingrese el nombre de usuario', 'required')); ?>
    </div>

    <div class="form-group"> 
        <label class="control-label" for="user-settings-email">Nombre de usuario</label>

        <?php echo $this->Form->text('username', array('class' => 'form-control', 'placeholder' => 'Ingrese el Username', 'required')); ?>
    </div>

    <div class="form-group"> 
        <label class="control-label" for="user-settings-email">Role</label>

        <?php echo $this->Form->select('role', array('Super Administrador' => 'Super Administrador','Administrador' => 'Administrador'), array('class' => 'form-control', 'required')); ?>
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
        <label class="control-label" for="user-settings-email">Contrase&ntilde;a</label>

        <?php echo $this->Form->password('password', array('class' => 'form-control', 'placeholder' => $placeholder,$required,'value' => '')); ?>
    </div>
</div>


<div class="modal-footer">

    <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-danger btn-primary">Guardar</button>
    
</div>
<?php echo $this->Form->end();?>

<!-- END Modal Body -->