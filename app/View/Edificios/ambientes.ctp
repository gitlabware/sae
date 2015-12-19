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
            <h2><strong>Listado de Ambientes</strong></h2>
            <div class="table-responsive">
                <table id="tabla-json" class="table table-vcenter table-condensed table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th id="piso">Piso</th>
                            <th id="ambiente">Ambiente</th>
                            <th id="propietario">Propietario</th>
                            <th id="inquilinos">Inquilinos</th>
                            <th id="representante">Representante</th>
                            <th id="acciones">Accion</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Interactive Title -->
    </div>
</div>
<script>
  var idEdificio = <?php echo $this->Session->read('Auth.User.edificio_id');?>;
  urljsontablatrab = '<?php echo $this->Html->url(array('action' => 'ambientes.json')); ?>';
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
  
  function ir_pagos(idAmbiente){
    window.location = '<?php echo $this->Html->url(array('controller' => 'Ambientes','action' => 'pay'));?>/'+idAmbiente;
  }
  
  function xcobrar(idAmbiente){
    window.location = '<?php echo $this->Html->url(array('controller' => 'Ambientes','action' => 'xcobrar'));?>/'+idAmbiente;
  }


  filtro_c = [
      {type: "text"},
      {type: "text"},
      {type: "text"},
      {type: "text"},
      {type: "text"}
  ];
</script>