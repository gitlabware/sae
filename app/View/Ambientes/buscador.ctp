<!-- Example Block -->
<div class="row">

    <!-- Interactive Block -->
    <div class="block">
        <!-- Interactive Title -->
        <div class="block-title">
            <h2><strong>Listado de Ambientes</strong> pagos</h2>
            <div class="table-responsive">
                <table id="tabla-json" class="table table-vcenter table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Ambiente</th>
                            <th>Propietario</th>
                            <th>Inquilinos</th>
                            <th>Piso</th>
                            <th>Accion</th>
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
  urljsontablatrab = '<?php echo $this->Html->url(array('action' => 'buscador.json')); ?>';
  
  function ir_pagos(idAmbiente){
    window.location = '<?php echo $this->Html->url(array('action' => 'pay'));?>/'+idAmbiente;
  }
</script>