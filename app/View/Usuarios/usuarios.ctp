<div class="col-md-6 col-8 align-self-center">
    <h2 class="text-themecolor m-b-0 m-t-0">Listado de inquilinos y propietarios</h2>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Example Content -->
                <div class="table-responsive m-t-40">
                <table id="general-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>C.I.</th>
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
</div>


<?php $this->start('campo_js') ?>
<script src="<?php echo $this->webroot; ?>template/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!--<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>-->
<script>
    $('#general-table').DataTable();
</script>
<?php $this->end() ?>


<script>
  urljsontablatrab = '<?php echo $this->Html->url(array('action' => 'usuarios.json')); ?>';
  function editar(idUsuario){
    cargarmodal('<?php echo $this->Html->url(array('action' => 'usuario'))?>/'+idUsuario);
  }
  function eliminar(idUsuario){
    if(confirm('Esta seguro de eliminar??')){
      window.location.href = '<?php echo $this->Html->url(array('action' => 'elimina_usuario'))?>/'+idUsuario;
    }
  }
</script>