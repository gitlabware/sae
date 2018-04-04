
<div class="modal-header">
    <h2 class="modal-title"><i class="fa fa-money"></i> Egreso</h2>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>

<?php echo $this->Form->create('Egreso', array('class' => 'form-horizontal form-bordered', 'id' => 'ajaxform')); ?>
<div class="modal-body">

    <?php echo $this->Form->hidden('Cuentasegreso.id'); ?>
    <div class="form-group">
        <div class="row">

            <label class="col-md-4 control-label" for="user-settings-email">Detalle</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('Cuentasegreso.detalle', array('class' => 'form-control', 'required','placeholder' => 'Ingrese el detalle del egreso')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">

            <label class="col-md-4 control-label" for="user-settings-email">Proveedor</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('Cuentasegreso.proveedor', array('class' => 'form-control','placeholder' => 'Ingrese el Proveedor')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">

            <label class="col-md-4 control-label" for="user-settings-email">Tipo de Egreso</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('Cuentasegreso.nomenclatura_id', $nomenclaturas, array('class' => 'select-chosen' , 'id'=>'requ','empty' => 'Seleccione el tipo de egreso')); ?>
            </div>
        </div>

    </div>
    <div class="form-group">
        <div class="row">

            <label class="col-md-4 control-label" for="user-settings-email">Caja/Banco</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('Cuentasegreso.banco_id', $bancos, array('class' => 'form-control', 'required','empty' => 'Seleccione la Caja/Banco')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">

            <label class="col-md-4 control-label" for="user-settings-email">Cuenta</label>
            <div class="col-md-8">
                <?php echo $this->Form->select('Cuentasegreso.cuenta_id', $cuentas, array('class' => 'form-control', 'required','empty' => 'Seleccione la cuenta')); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">

            <label class="col-md-4 control-label" for="user-settings-email">Fecha</label>
            <div class="col-md-8">
                <?php echo $this->Form->date('Cuentasegreso.fecha', array('class' => 'form-control', 'required','value' => date('Y-m-d'))); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">

            <label class="col-md-4 control-label" for="user-settings-email">Importe Total</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('Cuentasegreso.monto', array('class' => 'form-control', 'required','placeholder' => 'Ingrese el monto', 'type' => 'number', 'step' => 'any', 'min' => 0)); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">

            <label class="col-md-4 control-label" for="user-settings-email">Doc.Respaldo</label>
            <div class="col-md-8">
                <?php echo $this->Form->text('Cuentasegreso.referencia', array('class' => 'form-control','placeholder' => 'Ejemplo: Pago con cheque numero: 8896')); ?>
            </div>
        </div>
    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-danger waves-effect waves-light">Registrar</button>
</div>
<?php echo $this->Form->end(); ?>
<!-- END Modal Body -->

<script>

 $('.select-chosen').chosen({width: "100%"});
// $(document).ready(function(){
//     $( "#ajaxform" ).on("submit",function() {
//       alert( "Handler for .submit() called." );

//   });
// });

$("#ajaxform").submit(function(e){
    if($("#requ").val()==''){
        $('#requ_chosen').after('<span id="texto_requ" style="color: red;">Es necesario el Tipo de Egreso</span>');
        
        e.preventDefault();
    }else{
        $("#texto_requ").remove() ;
    }    
    
});


</script>


