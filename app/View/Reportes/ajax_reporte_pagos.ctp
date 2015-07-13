<div class="table-responsive">
    <table class="table table-striped table-vcenter">
        <thead>
            <tr>
                <td>#</td>
                <td>Ambiente</td>
                <td>Piso</td>
                <td>Propietario</td>
                <td>Inquilinos</td>
                <td>Fecha</td>
                <td>Concepto</td>
                <td>Estado</td>
                <td>Costo</td>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0.00;?>
            <?php foreach ($pagos as $pag): ?>
              <?php $i = 0; ?>
              <?php foreach ($pag['Pago']['pagos'] as $pa): ?>
                <?php $i++; ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $pa['Ambiente']['nombre']; ?></td>
                    <td><?php echo $pa['Pago']['piso']; ?></td>
                    <td><?php echo $pa['Propietario']['nombre']; ?></td>
                    <td><?php echo $pa['Ambiente']['lista_inquilinos']; ?></td>
                    <td><?php echo $pa['Pago']['fecha']; ?></td>
                    <td><?php echo $pa['Concepto']['nombre']; ?></td>
                    <td><?php echo $pa['Pago']['estado']; ?></td>
                    <td><?php echo $pa['Pago']['monto']; ?></td>
                </tr>
              <?php endforeach; ?>
                <tr>
                    <td style="background: paleturquoise"></td>
                    <td style="background: paleturquoise"></td>
                    <td style="background: paleturquoise"></td>
                    <td style="background: paleturquoise"></td>
                    <td style="background: paleturquoise"></td>
                    <td style="background: paleturquoise"></td>
                    <td style="background: paleturquoise"></td>
                    <td style="background: paleturquoise">SUBTOTAL</td>
                    <td style="background: paleturquoise"><?php echo $pag[0]['monto_total']?></td>
                </tr>
                <?php $total = $total + $pag[0]['monto_total'];?>
            <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>TOTAL</td>
                    <td><?php echo $total;?></td>
                </tr>
        </tbody>
    </table>
</div>