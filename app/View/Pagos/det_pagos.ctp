<!-- END Blank Header -->
<!-- Example Block -->
<div class="card card-outline-inverse">
    <!-- Example Title -->
    <div class="card-header">
        <h4 class="m-b-0 text-white">Detalle de pagos por cobrar de <?php echo $excel['Excel']['nombre']?></h4>
    </div>    
    <!-- Example Content -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="general-table" class="table table-bordered table-vcenter table-hover">
                <thead>
                    <tr>
                        <th>Piso</th>
                        <th>Ambiente</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pagos as $pa): ?>
                        <tr>
                            <td><?php echo $pa['Pago']['piso']?></td>
                            <td><?php echo $pa['Ambiente']['nombre']?></td>
                            <td><?php echo $pa['Pago']['fecha']?></td>
                            <td><?php echo $pa['Pago']['monto']?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
    <!-- END Example Content -->
</div>
<!-- END Example Block -->