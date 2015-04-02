<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-edit"></i> <?php echo $this->request->data['Concepto']['nombre'].' de '.$this->request->data['Pago']['fecha']?></h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body" id="idmodal-contenido">
    <?php echo $this->Form->create('Ambiente', array('action' => 'registra_monto_pago/'.$idRecibo, 'class' => 'form-horizontal form-bordered', 'id' => 'ajaxformusuario')); ?>
    <fieldset>
        <div class="form-group">
            <label class="col-md-2 control-label" onclick="$('#divformusuario').toggle(400);" title="Nuevo Usuario">Monto</label>
            <div class="col-md-6">
                <?php echo $this->Form->hidden('Pago.id') ?>
                <?php echo $this->Form->text('Pago.monto', array('class' => 'form-control', 'required','type' => 'number','step' => 'any','min' => 0)); ?>
            </div>
            <div class="col-md-4">
                <button class="btn btn-success" type="submit">Registrar</button>
            </div>
        </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
    
</div>

