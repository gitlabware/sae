<!-- Modal Header -->
<div class="modal-header">
    <h2 class="modal-title"><i class="fa fa-tasks"></i> Realizar Marcados</h2>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<!-- END Modal Header -->

<!-- Modal Body -->
<div class="modal-body">
    <div id="idmensaje">

    </div>

    <div class="form-group">
        <div class="row">

            <label class="col-md-4 control-label">Unir al comprobante:</label>
            <div class="col-md-4">
                <?php echo $this->Form->select('Aux.comprobante_id', $comprobantes, array('class' => 'form-control', 'empty' => 'Comprobante ID','id' => 'a-comprobantes')); ?>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-block btn-success" onclick="$('#f-comprobantes').submit();">Unir</button>
            </div>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
</div>
<script>
  $('#a-comprobantes').change(function(){
    $('#s-comprobante-id').val($('#a-comprobantes').val());
});
</script>

