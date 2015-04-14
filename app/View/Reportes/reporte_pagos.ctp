<div class="row">
    <div class="col-md-12">
        <!-- Basic Form Elements Block -->
        <div class="block">
            <!-- Basic Form Elements Title -->
            <div class="block-title">
                <h2>REPORTE GENERAL DE PAGOS</h2>
            </div>
            <div class="form-horizontal form-bordered">
                <?php echo $this->Form->create('Reporte', array('action' => 'ajax_reporte_pagos','id' => 'ajaxform')); ?>
                <div class="form-group">
                    <div class="col-md-2">
                        <label class="control-label">Fecha_Inicio</label>
                        <?php echo $this->Form->date('fecha_ini', array('class' => 'form-control', 'required')); ?>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label">Fecha_Fin</label>
                        <?php echo $this->Form->date('fecha_fin', array('class' => 'form-control', 'required')); ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Tipo</label>
                        <?php echo $this->Form->select('tipo', array('Debe' => 'Debe', 'Pagado' => 'Pagado','Todos' => 'Todos'), array('class' => 'form-control')); ?>
                    </div>

                    <div class="col-md-3">
                        <label class="control-label">Concepto</label>
                        <?php echo $this->Form->select('concepto_id', $conceptos, array('class' => 'form-control')); ?>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label">&nbsp;</label>
                        <button class="btn btn-primary form-control">BUSCAR</button>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
                <div class="form-group">
                    <div class="col-md-12" id="divtablapagos">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  $("#ajaxform").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        /*beforeSend:function (XMLHttpRequest) {
            alert("antes de enviar");
        },
        complete:function (XMLHttpRequest, textStatus) {
            alert('despues de enviar');
        },*/
        success:function(data, textStatus, jqXHR) 
        {
            //data: return data from server
            $("#divtablapagos").html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if fails   
            alert("error");
        }
    });
    e.preventDefault(); //STOP default action
    //e.unbind(); //unbind. to stop multiple form submit.
});
</script>