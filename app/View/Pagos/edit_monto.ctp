<!-- Modal Header -->
<div class="modal-header">
    <h2 class="modal-title"><i class="fa fa-edit"></i> <?php echo $this->request->data['Concepto']['nombre'] . ' de ' . $this->request->data['Pago']['fecha'] ?></h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<?php echo $this->Form->create('Pago', array( 'class' => 'form-horizontal form-bordered', 'id' => 'ajaxformusuario')); ?>
<div class="modal-body" id="idmodal-contenido">

    <div class="form-group">
        <div class="row">

            <div class="col-md-12">
                <label class="control-label">Monto</label>
                <?php echo $this->Form->hidden('Pago.id') ?>
                <?php echo $this->Form->text('Pago.monto', array('class' => 'form-control', 'required', 'type' => 'number', 'step' => 'any', 'min' => 0, 'id' => 'idedimonto','onkeyup' => 'edi_calc_total();')); ?>
            </div>
        </div>
    </div>
    
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-danger waves-effect waves-light">Guardar</button>
</div>
<?php echo $this->Form->end(); ?>
