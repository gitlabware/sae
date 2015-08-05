<!-- END Blank Header -->
<!-- Example Block -->
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Detalle de pagos por cobrar de <?php echo $excel['Excel']['nombre']?></h2>
    </div>    
    <!-- Example Content -->
    <div class="table-responsive">
        <table id="general-table" class="table table-striped table-vcenter table-hover">
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
    <!-- END Example Content -->
</div>
<!-- END Example Block -->