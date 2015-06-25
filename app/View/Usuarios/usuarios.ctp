<!-- Example Block -->
<div class="row">
    <!-- Interactive Block -->
    <div class="block">
        <!-- Interactive Title -->
        <div class="block-title">
            <h2><strong>Listado de inquilinos y propietarios</strong></h2>
            <div class="table-responsive">
                <table id="tabla-json" class="table table-vcenter table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Email</th>
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
  urljsontablatrab = '<?php echo $this->Html->url(array('action' => 'usuarios.json')); ?>';
  function editar(idUsuario){
    cargarmodal('<?php echo $this->Html->url(array('action' => 'usuario'))?>/'+idUsuario);
  }
</script>