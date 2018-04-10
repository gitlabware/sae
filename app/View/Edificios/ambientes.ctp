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
<div class="row">
<div class="col-8 align-self-center">
    <h2 class="text-themecolor m-b-0 m-t-0">Listado de Ambientes</h2>
</div>
    
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">              
                <div class="table-responsive m-t-40">
                    <table id="tabla-json" class="table table-bordered ">
                        <thead>
                        <tr>
                            <th class="busqda">Piso</th>
                            <th class="busqda">Ambiente</th>
                            <th class="busqda">Propietario</th>
                            <th class="busqda">Inquilino</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th id="piso">Piso</th>
                            <th id="ambiente">Ambiente</th>
                            <th id="propietario">Propietario</th>
                            <th id="inquilinos">Inquilino</th>
                            <th id="acciones">Accion</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
  var idEdificio = <?php echo $this->Session->read('Auth.User.edificio_id');?>;
  urljsontablatrab = '<?php echo $this->Html->url(array('action' => 'ambientes.json')); ?>';
  function editar(idPiso, idAmbiente) {
      cargarmodal('<?php echo $this->Html->url(array('controller' => 'Ambientes', 'action' => 'ambiente')); ?>/' + idPiso + '/' + idAmbiente,true);
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
      {type: "text"}
  ];
</script>

<?php $this->start('campo_js'); ?>
<script src="<?php echo $this->request->webroot; ?>template/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script>


    $('#tabla-json thead th.busqda').each(function() {
        var title = $('#tabla-articulos thead th').eq($(this).index()).text();
        $(this).html('<input type="text" class="form-control" placeholder="Buscar ' + title + '" />');
    });


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
    /*table5.columns().eq(0).each(function (colIdx) {
        $('input', table5.column(colIdx).header()).on('keyup change', function () {
            table5
                .column(colIdx)
                .search(this.value)
                .draw();
        });
    });*/
    table5.columns().every(function (index) {
        $('#tabla-json thead tr th:eq(' + index + ') input').on('keyup change', function () {
            table5.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();
        });
    });


</script>
<?php $this->end(); ?>