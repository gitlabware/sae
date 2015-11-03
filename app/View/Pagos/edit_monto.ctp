<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-edit"></i> <?php echo $this->request->data['Concepto']['nombre'] . ' de ' . $this->request->data['Pago']['fecha'] ?></h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body" id="idmodal-contenido">
    <?php echo $this->Form->create('Pago', array( 'class' => 'form-horizontal form-bordered', 'id' => 'ajaxformusuario')); ?>
    <fieldset>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label">Monto</label>
                <?php echo $this->Form->hidden('Pago.id') ?>
                <?php echo $this->Form->text('Pago.monto', array('class' => 'form-control', 'required', 'type' => 'number', 'step' => 'any', 'min' => 0, 'id' => 'idedimonto','onkeyup' => 'edi_calc_total();')); ?>
            </div>
        </div>
        <div class="form-group" >
            <div class="col-md-12">
                <button class="btn btn-success col-md-12" type="submit">Registrar</button>
            </div>
        </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
