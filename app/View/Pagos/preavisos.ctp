<!-- Example Block -->
<div class="row">
    <style>
        .table {
            width: 100% !important;
        }
        #piso{
            width: 12% !important;
        }
        #ambiente{
            width: 15% !important;
        }
        #acciones{
            width: 20% !important;
        }
    </style>
    <!-- Interactive Block -->
    <div class="block">
        <!-- Interactive Title -->
        <div class="block-title">
            <h2><strong>Listado de Pre-avisos por ambientes</strong></h2>
            <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" title="Generar preavisos de mantenimiento" onclick="$('#idconcepto').val(10);$('#form-preavisos').submit();"><i class="fa fa-clipboard"></i></a>
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-success" title="Generar preavisos de alquiler" onclick="$('#idconcepto').val(11);$('#form-preavisos').submit();"><i class="fa fa-clipboard"></i></a>
            </div>
        </div>
        <div class="block-content" >
            <?php echo $this->Form->create('Pago',array('action' => 'genera_preavisos','id' => 'form-preavisos'));?>
            <?php echo $this->Form->hidden('concepto_id',array('id' => 'idconcepto'));?>
            <div class="table-responsive">
                <table id="tabla-json" class="table table-vcenter table-condensed table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>
                                
                            </th>
                            <th id="piso">Piso</th>
                            <th id="ambiente">Ambiente</th>
                            <th id="propietario">Representante</th>
                            <th id="acciones">Deuda Mantenimiento</th>
                            <th id="acciones2">Deuda Alquiler</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <?php echo $this->Form->end();?>
        </div>
        <!-- END Interactive Title -->
    </div>
</div>
<script>
    var idEdificio = <?php echo $this->Session->read('Auth.User.edificio_id'); ?>;
    urljsontablatrab = '<?php echo $this->Html->url(array('action' => 'preavisos.json')); ?>';
    function editar(idPiso, idAmbiente) {
        cargarmodal('<?php echo $this->Html->url(array('controller' => 'Ambientes', 'action' => 'ambiente')); ?>/' + idPiso + '/' + idAmbiente);
    }
    function servicios(idAmbiente) {
        cargarmodal('<?php echo $this->Html->url(array('controller' => 'Conceptos', 'action' => 'aservicios')); ?>/' + idAmbiente + '/' + idEdificio);
    }
    function inquilinos(idAmbiente, idPiso) {
        cargarmodal('<?php echo $this->Html->url(array('controller' => 'Ambientes', 'action' => 'inquilinos')); ?>/' + idAmbiente + '/' + idPiso);
    }
    function eliminar(idAmbiente) {
        if (confirm('Esta seguro de eliminar el ambiente??')) {
            window.location.href = '<?php echo $this->Html->url(array('controller' => 'Ambientes', 'action' => 'eliminar')) ?>/' + idAmbiente;
        }
    }

    function ir_pagos(idAmbiente) {
        window.location = '<?php echo $this->Html->url(array('controller' => 'Ambientes', 'action' => 'pay')); ?>/' + idAmbiente;
    }

    function xcobrar(idAmbiente) {
        window.location = '<?php echo $this->Html->url(array('controller' => 'Ambientes', 'action' => 'xcobrar')); ?>/' + idAmbiente;
    }


    filtro_c = [
        null,
        {type: "text"},
        {type: "text"},
        {type: "text"},
        {type: "text"},
        {type: "text"}
    ];
</script>