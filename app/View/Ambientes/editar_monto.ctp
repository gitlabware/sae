<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-edit"></i> <?php echo $this->request->data['Concepto']['nombre'] . ' de ' . $this->request->data['Pago']['fecha'] ?></h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body" id="idmodal-contenido">
    <?php echo $this->Form->create('Ambiente', array('action' => 'registra_monto_pago/' . $idRecibo, 'class' => 'form-horizontal form-bordered', 'id' => 'ajaxformusuario')); ?>
    <fieldset>
        <div class="form-group">
            <div class="col-md-4">
                <label class="control-label">Monto</label>
                <?php echo $this->Form->hidden('Pago.id') ?>
                <?php echo $this->Form->text('Pago.monto', array('class' => 'form-control', 'required', 'type' => 'number', 'step' => 'any', 'min' => 0, 'id' => 'idedimonto','onkeyup' => 'edi_calc_total();')); ?>
            </div>
            <div class="col-md-4">
                <label class="control-label">Retencion</label>
                <?php echo $this->Form->text('Pago.retencion', array('class' => 'form-control', 'required', 'type' => 'number', 'step' => 'any', 'min' => 0, 'max' => 100, 'id' => 'idediretencion','onkeyup' => 'edi_calc_total();')); ?>
            </div>
            <div class="col-md-4">
                <?php
                $monto = $this->request->data['Pago']['monto'];
                $retencion = $this->request->data['Pago']['retencion'];
                if (empty($retencion)) {
                  $retencion = 0.00;
                } else {
                  $retencion = $retencion / 100;
                }
                $total = $monto + ($monto * $retencion);
                ?>
                <label class="control-label col-md-12">Total</label>
                <label class="control-label col-md-12" id="ideditotal"><?php echo $total; ?></label>
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

<script>
  function edi_calc_total() {
      var edi_monto = $('#idedimonto').val();
      var edi_retencion = $('#idediretencion').val();
      if(edi_monto == null && edi_monto == ''){
        edi_monto = 0.00;
      }
      if(edi_retencion == null && edi_retencion == ''){
        edi_retencion = 0.00;
      }else{
        edi_retencion = edi_retencion/100;
      }
      var edi_total = parseFloat(edi_monto) + parseFloat(edi_monto*edi_retencion);
      edi_total = Math.round(edi_total * 100) / 100;
      $('#ideditotal').html(edi_total);
  }
</script>