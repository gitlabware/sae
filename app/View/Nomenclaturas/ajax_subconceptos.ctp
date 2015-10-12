<label class="col-md-4 control-label" for="user-settings-email">Sub-concepto</label>
<div class="col-md-8">
    <?php echo $this->Form->select('Nomenclatura.subconcepto_id', $subconceptos, array('class' => 'form-control', 'empty' => 'Ninguno')); ?>
</div>
