<div class="col-md-6 col-8 align-self-center">
    <h2 class="text-themecolor m-b-0 m-t-0">Listado de inquilinos y propietarios</h2>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Example Content -->
                <div class="table-responsive m-t-40">
                    <table id="tabla-json" class="table table-bordered">
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
    urljsontablatrab = '<?php echo $this->Html->url(array('action' => 'usuarios.json')); ?>';
    var table5 = $('#tabla-json').DataTable({
        "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [-1]
        }],
        "oLanguage": {
            "oPaginate": {
                "sPrevious": "Anterior",
                "sNext": "Siguiente"
            },
            "sSearch": "Buscar",
            "sLengthMenu": "Mostrar _MENU_ registros"
        },
        "iDisplayLength": 10,
        "aLengthMenu": [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "Todos"]
        ],
        'order': [],
        "sDom": '<"dt-panelmenu clearfix" lfr>t<"dt-panelfooter clearfix"ip>',
        'bProcessing': true,
        'sAjaxSource': urljsontablatrab,
        "bServerSide": true,
        "aaSorting": [],

        //dom: 'Bfrtip',

    });
</script>



<script>

  function editar(idUsuario){
    cargarmodal('<?php echo $this->Html->url(array('action' => 'usuario'))?>/'+idUsuario);
}
function eliminar(idUsuario){
    if(confirm('Esta seguro de eliminar??')){
      window.location.href = '<?php echo $this->Html->url(array('action' => 'elimina_usuario'))?>/'+idUsuario;
  }
}
</script>
<?php $this->end() ?>