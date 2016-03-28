<!-- Modal Header -->
<div class="modal-header text-center">
    <h2 class="modal-title"><i class="fa fa-user"></i> Pago en el ambiente <?php echo $ambiente['Ambiente']['nombre']?></h2>
</div>
<!-- END Modal Header -->
<!-- Modal Body -->
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <h3><?php echo $concepto['Concepto']['descripcion']." en ".$fecha?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Inquilino</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pagosd as $pa):?>
                    <tr>
                        <td><?php echo $pa['User']['nombre'];?></td>
                        <td><?php echo $pa['Pago']['monto'];?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END Modal Body -->

