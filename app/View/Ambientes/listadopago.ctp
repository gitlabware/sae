<?php
App::import('Model', 'Pago');
$Pago = new Pago();
App::import('Model', 'NomenclaturasAmbiente');
$NomenclaturasAmbiente = new NomenclaturasAmbiente();
?>

<div class="card">
    <div class="card-header">
        <h4>Detalle de Pagos</h4>
    </div>
    <div class="card-body">
        <center><h1>RECIBO # <?php echo $recibo['Recibo']['numero'] ?></h1></center>
        <?php echo $this->Form->create('Ambiente', array('action' => 'recibo_pdf/' . $recibo['Recibo']['id'] . '/1')); ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="row">

                        <label class="col-md-4 control-label" for="user-settings-email">Nombre del Pagador: </label>
                        <div class="col-md-8">
                            <?php echo $this->Form->text('Recibo.pagador', array('class' => 'form-control', 'value' => $recibo['Recibo']['pagador'], 'required', 'placeholder' => 'Ingrese el nombre del pagador')); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <b>Fecha: </b>2015-03-17<br />
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div class="row">

                        <label class="col-md-4 control-label" for="user-settings-email">Banco/Caja: </label>
                        <div class="col-md-8">
                            <?php echo $this->Form->select('Recibo.banco_id', $bancos, array('class' => 'form-control', 'required', 'empty' => 'Seleccione Banco/Caja')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="row">

                        <label class="col-md-4 control-label" for="user-settings-email">Doc. Respaldo: </label>
                        <div class="col-md-8">
                            <?php echo $this->Form->text('Recibo.doc_respaldo', array('class' => 'form-control', 'placeholder' => 'Documento de Respaldo')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Example Content -->

        <b>Listado y detalle de pagos </b>
        <div class="table-responsive">
            <table id="general-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Piso</th>
                        <th>Ambiente</th>
                        <th>Concepto</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Categoria</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php $total = array(); ?>
                    <?php
                /* $Pago->virtualFields = array(
                  'piso' => "(SELECT pisos.nombre FROM pisos WHERE pisos.id = Ambiente.piso_id)"
              ); */
              ?>
              <?php $ji = 0; ?>
              <?php foreach ($recibo_m as $key => $rm): ?>

                <?php
                $pagos = $Pago->find('all', array(
                    'conditions' => array('ISNULL(Pago.deleted)','Pago.recibo_id' => $recibo['Recibo']['id'], 'Pago.ambiente_id' => $rm['Pago']['ambiente_id'])
                ));
                    //debug($pagos);exit;
                ?>
                <?php $total[$key] = 0.00; ?>
                <?php foreach ($pagos as $ik => $man): ?>
                    <?php $ji++; ?>
                    <tr class="warning">    
                        <td><?php echo $ik + 1 ?></td>
                        <td><?php echo $this->requestAction(array('action' => 'get_piso', $man['Ambiente']['piso_id'])); ?></td>
                        <td><a href="javascript:"><?php echo $man['Ambiente']['nombre']; ?></a></td>
                        <td><?php echo $man['Concepto']['nombre']; ?></td>
                        <td>
                            <?php
                            if ($man['Pago']['concepto_id'] == 12) {
                                if ($man['Pago']['porcentaje_interes'] != null) {
                                    $man['Pago']['monto_total'] = $man['Pago']['monto_total'] * ($man['Pago']['porcentaje_interes'] / 100);
                                }
                            }
                            ?>
                            <?php echo $man['Pago']['monto_total']; ?>
                        </td>
                        <?php
                        $nomenclaturas = $NomenclaturasAmbiente->find('list', array(
                            'recursive' => 0,
                            'conditions' => array('ISNULL(NomenclaturasAmbiente.deleted)','NomenclaturasAmbiente.ambiente_id' => $man['Ambiente']['id'], 'Nomenclatura.concepto_id' => $man['Pago']['concepto_id']),
                            'fields' => array('Nomenclatura.id', 'Nomenclatura.nombre')
                        ));
                        $c_seleccion = '';

                        $ant_nomen = $NomenclaturasAmbiente->find('first', array(
                            'recursive' => 0,
                            'conditions' => array(
                                'ISNULL(NomenclaturasAmbiente.deleted)',
                                '(EXISTS(SELECT * FROM subconceptos WHERE subconceptos.id = Nomenclatura.subconcepto_id AND subconceptos.gestiones_anteriores = 1))',
                                'NomenclaturasAmbiente.ambiente_id' => $man['Ambiente']['id'],
                                'Nomenclatura.concepto_id' => $man['Pago']['concepto_id']
                            ),
                            'fields' => array('Nomenclatura.id')
                        ));
                        if (split('-', $man['Pago']['fecha'])[0] < date('Y')) {
                            if (!empty($ant_nomen)) {
                                $c_seleccion = $ant_nomen['Nomenclatura']['id'];
                            }
                        } elseif (!empty($ant_nomen)) {

                            $nomenclatura_aux = $NomenclaturasAmbiente->find('first', array(
                                'recursive' => 0,
                                'conditions' => array('ISNULL(NomenclaturasAmbiente.deleted)','NomenclaturasAmbiente.id != ' => $ant_nomen['Nomenclatura']['id'], 'Nomenclatura.id !=' => $ant_nomen['Nomenclatura']['id'], 'Nomenclatura.concepto_id' => $man['Pago']['concepto_id']),
                                'fields' => array('Nomenclatura.id')
                            ));

                            if (!empty($nomenclatura_aux)) {
                                $c_seleccion = $nomenclatura_aux['Nomenclatura']['id'];
                            } else {
                                if (!empty($nomenclaturas)) {
                                    $c_seleccion = key($nomenclaturas);
                                }
                            }
                                //debug($c_seleccion);exit;
                        } else {
                            if (!empty($nomenclaturas)) {
                                $c_seleccion = key($nomenclaturas);
                            }
                        }

                            //debug();exit;
                            //debug($nomenclaturas);exit;
                        ?>
                        <td><a href="javascript:void(0)" class="label label-warning"><?php echo $man['Pago']['fecha']; ?></a></td>
                        <td class="text-center">
                            <?php echo $man['Pago']['estado']; ?>
                        </td>
                        <td>
                            <?php echo $this->Form->select("Pagos.$ji.nomenclatura_id", $nomenclaturas, array('class' => 'form-control', 'value' => $c_seleccion, 'required')) ?>
                            <?php echo $this->Form->hidden("Pagos.$ji.pago_id", array('value' => $man['Pago']['id'])); ?>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-primary" type="button" title="Editar Monto" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'editar_monto', $man['Pago']['id'], $recibo['Recibo']['id'])); ?>');"><i class="fa fa-pencil"></i></button>
                            <?php echo $this->Html->link('<i class="fa fa-remove"></i>', ['action' => 'quita_pago', $man['Pago']['id']], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Esta seguro de quitar pago?', 'escape' => FALSE, 'title' => 'Quitar pago']) ?>
                        </td>
                    </tr>
                    <?php $total[$key] = $total[$key] + $man['Pago']['monto_total']; ?>
                <?php endforeach; ?>
                <tr class="info">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>TOTAL:</td>
                    <td><?php echo $total[$key]; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="success">
                    <?php
                    $saldo = 0.00;
                    if (empty($rm['Ambiente']['saldo'])) {
                        $saldo = 0.00;
                    } else {
                        $saldo = $rm['Ambiente']['saldo'];
                    }
                    ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>MONTO: </td>
                    <td><?php echo $this->Form->text("Recibo.ambiente.$key.monto", array('class' => 'form-control submonto', 'id' => 'dato-monto-' . $key, 'value' => round($rm['Pago']['monto_tmp'], 2), 'type' => 'number', 'step' => 'any', 'min' => 0, 'required')); ?></td>
                    <td><span style="display: none;">GUARDAR CAMBIO: </span></td>
                    <td>
                        <div style="display: none;">
                            <?php
                                //echo $this->Form->text("Dato.ambiente.$key.cambio", array('class' => 'form-control subcambio', 'id' => 'dato-cambio-' . $key, 'value' => round( round($rm['Pago']['monto_tmp'] + $saldo, 2) - round($total[$key], 2),2), 'type' => 'number', 'step' => 'any', 'required', 'min' => 0)); 
                            echo $this->Form->text("Dato.ambiente.$key.cambio", array('class' => 'form-control', 'value' => 0, 'type' => 'number', 'step' => 'any', 'required', 'min' => 0));
                            ?>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <?php echo $this->Form->hidden("Dato.ambiente.$key.ambiente_id", array('value' => $rm['Pago']['ambiente_id'])); ?>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>MONTO TOTAL: </td>
                <td><?php echo $this->Form->text("Recibo.monto", array('class' => 'form-control', 'id' => 'dato-monto', 'type' => 'number', 'step' => 'any', 'min' => 0, 'required', 'disabled')); ?></td>
                <td>
                    <div style="display: none;" >
                        CAMBIO TOTAL: 
                    </div>
                </td>
                <td>
                    <div style="display: none;">

                        <?php echo $this->Form->text("Dato.cambio", array('class' => 'form-control', 'id' => 'dato-cambio', 'type' => 'number', 'step' => 'any', 'required', 'min' => 0, 'disabled')); ?>
                    </div>
                </td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
<!-- END Example Content -->
<?php //echo $this->Form->create('Ambiente', ['action' => 'recibo/' . $recibo['Recibo']['id'] . '/1']);    ?>
    <!--<div class="row">
        <div class="col-md-4">
            <label>Total</label>
    <?php //echo $this->Form->text('Dato.total', ['class' => 'form-control', 'id' => 'idformtotal', 'type' => 'number', 'step' => 'any']);    ?>
        </div>
        <div class="col-md-4">
            <label>Cambio</label>
    <?php //echo $this->Form->text('Dato.total', ['class' => 'form-control', 'id' => 'idformtotal', 'type' => 'number', 'step' => 'any']);    ?>
        </div>
        <div class="col-md-4">
            <label>&nbsp;</label>
            <div class="checkbox">
                <label for="mantenimiento">
                    <input type="checkbox" id="idformquedcambio" name="data[Dato][quedar_cambio]"> Quedar Cambio
                </label>
            </div>
        </div>
    </div><br>-->
    <br>
    <div class="row">
        <div class="col-md-4">
            <button class="btn btn-block btn-primary" type="button" onclick="window.location = '<?php echo $this->Html->url(array('controller' => 'Edificios', 'action' => 'ambientes')); ?>'">Ambientes</button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-block btn-danger" type="button" onclick="if (confirm('Esta seguro de cancelar los pagos de este recibo??')) {
                window.location = '<?php echo $this->Html->url(array('action' => 'cancelar_pago', $recibo['Recibo']['id'])); ?>';
            }">Cancelar Pagos</button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-block btn-success" type="submit">Terminar Pago</button>
        </div>
    </div>
</div>

<?php echo $this->Form->end(); ?>
</div>
<!-- END Example Block -->

<script>
    var saldo = [];
    var total = [];
    <?php foreach ($recibo_m as $key => $rm): ?>
    saldo[<?php echo $key; ?>] = 0.00;
    <?php if (!empty($rm['Ambiente']['saldo'])): ?>
    saldo[<?php echo $key; ?>] = <?php echo $rm['Ambiente']['saldo']; ?>;
    <?php endif; ?>
    total[<?php echo $key ?>] = <?php echo $total[$key]; ?>;

    $('#dato-monto-<?php echo $key; ?>').keyup(function () {
        var valor_monto = parseFloat($(this).val());
        var cambio = valor_monto + saldo[<?php echo $key; ?>] - total[<?php echo $key; ?>];
        $('#dato-cambio-<?php echo $key; ?>').val(Math.round(cambio * 100) / 100);
    });
    <?php endforeach; ?>

    function suma_total() {
        var total_t = 0.00;
        var cambio_t = 0.00;
        $('.submonto').each(function (i, val) {
            if ($(val).val() != '') {
                total_t = total_t + parseFloat($(val).val());
            }
        });
        $('.subcambio').each(function (i, val) {
            if ($(val).val() != '') {
                cambio_t = cambio_t + parseFloat($(val).val());
            }
        });
        $('#dato-monto').val(total_t);
        $('#dato-cambio').val(cambio_t);
    }
    suma_total();

    $('.submonto ,.subcambio').keyup(function () {
        suma_total();

    });

</script>