<!-- Example Block -->
<div class="row">

    <!-- Interactive Block -->
    <div class="block">
        <!-- Interactive Title -->
        <div class="block-title">
            <h2><strong>Listado de Ambientes</strong></h2>
            <div class="table-responsive">
                <table id="tabla-json" class="table table-vcenter table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Piso</th>
                            <th>Ambiente</th>
                            <th>Propietario</th>
                            <th>Inquilinos</th>
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
  urljsontablatrab = '<?php echo $this->Html->url(array('action' => 'ambientes.json')); ?>';
  function editar(idPiso, idAmbiente) {
      cargarmodal('<?php echo $this->Html->url(array('controller' => 'Ambientes', 'action' => 'ambiente')); ?>/' + idPiso + '/' + idAmbiente);
  }
  function eliminar(idAmbiente) {
      if (confirm('Esta seguro de eliminar el ambiente??')) {
          window.location.href = '<?php echo $this->Html->url(array('controller' => 'Ambientes', 'action' => 'eliminar')) ?>/' + idAmbiente;
      }
  }


  filtro_c = [
      {type: "text"},
      {type: "text"},
      {type: "text"},
      {type: "text"}
  ];
</script>