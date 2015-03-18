<div class="block full">
    <div class="row">

        <div class="col-md-8">
            <div>
                <h2>Pagos del Ambiente <?php echo $ambiente['Ambiente']['nombre']; ?></h2>
                <br>
                <div class="table-responsive">
                    <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th>Concepto</th>
                                <th>Mes</th>
                                <th>Monto Total</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pagos as $pa): ?>
                                <tr>
                                    <td><?php echo $pa['Concepto']['descripcion'] ?></td>
                                    <td><?php echo $pa['Pago']['fecha'] ?></td>
                                    <td><?php echo $pa[0]['totalmonto']; ?></td>
                                    <td><a href="javascript:" class="btn btn-xs btn-primary" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'detalles_pago', $pa['Pago']['fecha'], $pa['Pago']['concepto_id'], $ambiente['Ambiente']['id'])) ?>');">Detalle</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-alt btn-xs btn-primary" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'pago', $ambiente['Ambiente']['id'])) ?>');">Registrar Nuevo</button>
        </div>
    </div>
</div>

