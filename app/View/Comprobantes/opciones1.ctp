<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-tasks"></i> Realizar Marcados</h2>
</div>
<!-- END Modal Header -->

<!-- Modal Body -->
<div class="modal-body">
    <div id="idmensaje">

    </div>
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label">Unir al comprobante:</label>
            <div class="col-md-4">
                <?php echo $this->Form->select('Aux.comprobante_id', $comprobantes, array('class' => 'form-control', 'empty' => 'Comprobante ID','id' => 'a-comprobantes')); ?>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-block btn-success" onclick="$('#f-comprobantes').submit();">Unir</button>
            </div>
        </div>



    </fieldset>
    <br>
    <div class="form-group form-actions">
        <div class="col-xs-12 text-right">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    </div>

</div>
<script>
  $('#a-comprobantes').change(function(){
    $('#s-comprobante-id').val($('#a-comprobantes').val());
  });
</script>

