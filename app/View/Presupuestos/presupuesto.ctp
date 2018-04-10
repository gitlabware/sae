<style>
table.tsinf th{
    font-size: 15px !important;
}
</style>
<div class="card">
    <div class="card-header">
        <h3 class="text-center">EDIFICIO <?php echo strtoupper($presupuesto['Edificio']['nombre']); ?></h3>
    </div>
    <div class="card-body">
        <h2 class="text-center">PLAN ANUAL OPERATIVO <?= $presupuesto['Presupuesto']['gestion'] ?></h2>

        <h2 class="text-center text-success page-header" style="cursor: pointer;" onclick="$('#div-ingresos-o').toggle(400);">INGRESOS</h2>
        <div style="display: none;" id="div-ingresos-o">
            <div class="form-horizontal form-bordered">
                <?php echo $this->Form->create('Presupuesto', array('action' => 'guarda_ingreso', $presupuesto['Presupuesto']['id'], 'id' => 'form-ingresos')); ?>
                <?php echo $this->Form->hidden('Ingreso.presupuesto_id', array('value' => $presupuesto['Presupuesto']['id'])); ?>
                <div class="form-group">
                    <div class="row">    
                        <div class="col-md-3">
                            <div id="concepto-select">
                                <label>Concepto ingreso 
                                    <a href="javascript:" class="label label-primary" onclick="cargarmodal('<?= $this->Html->url(array('controller' => 'Conceptos', 'action' => 'subconcepto')) ?>');">Nuevo</a> 
                                    <a href="javascript:" class="label label-warning" id="gene-x-ambiente" onclick="ir_pre_ambientes();">Generar</a>
                                </label>
                                <?php echo $this->Form->select('Ingreso.subconcepto_id', $subconceptos, array('class' => 'select2 f-subconcepto', 'empty' => 'Seleccione el sub-concepto', 'required', 'id' => 'sel-subconcepto','style' => 'width:100%;')); ?>
                            </div>
                            <div id="d_ajax_ges">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <label>%<br><br></label>
                            <?php echo $this->Form->text('Ingreso.porcentaje', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'max' => 1, 'placeholder' => '0.00', 'id' => 'c-porcentaje')); ?>
                        </div>
                        <div class="col-md-2">
                            <label>Ingreso <br>anual</label>
                            <?php echo $this->Form->text('Ingreso.ingreso', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00', 'id' => 'c-ingreso')); ?>
                        </div>
                        <div class="col-md-2">
                            <label>Presupuesto <br>anterior</label>
                            <?php echo $this->Form->text('Ingreso.pres_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
                        </div>
                        <div class="col-md-2">
                            <label>Ejecutado <br>anterior</label>
                            <?php echo $this->Form->text('Ingreso.ejec_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
                        </div>
                        <div class="col-md-2">
                            <label>Presupuesto <br><br></label>
                            <?php echo $this->Form->text('Ingreso.presupuesto', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00', 'id' => 'c-presupuesto')); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">    
                        <div class="col-md-12">
                            <button class="btn btn-alt btn-primary col-md-12" type="submit">REGISTRAR</button>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
            <?php
            $formato_num[0] = 2;
            $formato_num[1] = ",";
            $formato_num[2] = ".";
            ?>
            <div class="table-responsive">
                <table class="table table-vcenter table-condensed table-bordered dataTable no-footer tsinf">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Detalle Ingresos</th>
                            <th>%</th>
                            <th>Ingreso Anual</th>
                            <th>Presupuesto Anterior</th>
                            <th>Ejecutado Anterior</th>
                            <th>Presupuesto</th>
                            <th>Ejecutado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <script>
                        var ttejecutado = 0.00;
                    </script>
                    <tbody>
                        <?php
                        $tot_i['ingreso'] = 0.00;
                        $tot_i['pres_anterior'] = 0.00;
                        $tot_i['ejec_anterior'] = 0.00;
                        $tot_i['presupuesto'] = 0.00;
                        $tot_i['ejecutado'] = 0.00;
                        $ttejecutado = 0.00;
                        ?>
                        <script>
                            var ttejecutado_i = 0.00;
                        </script>
                        <?php foreach ($tingresos as $key => $tin): ?>
                            <?php $tejecutado = 0.00; ?>
                            <?php
                            $tot_i['ingreso'] = $tot_i['ingreso'] + $tin[0]['ingreso'];
                            $tot_i['pres_anterior'] = $tot_i['pres_anterior'] + $tin[0]['pres_anterior'];
                            $tot_i['ejec_anterior'] = $tot_i['ejec_anterior'] + $tin[0]['ejec_anterior'];
                            $tot_i['presupuesto'] = $tot_i['presupuesto'] + $tin[0]['presupuesto'];
                            $tot_i['ejecutado'] = $tot_i['ejecutado'] + $tin[0]['ejecutado_actual'];
                            ?>

                            <tr class="text-success text-uppercase success" id="a-ajax-ing-<?php echo $tin[0]['idsub'] . '-' . $tin['ingresos']['subge_id'] ?>" style="font-size: 14px;">
                                <td><?php echo $tin[0]['codigo'] ?></td>
                                <td><?php echo $tin[0]['nombre'] ?></td>
                                <td><?php echo $tin[0]['porcentaje'] ?></td>
                                <td><?php echo number_format($tin[0]['ingreso'], $formato_num[0], $formato_num[1], $formato_num[2]); ?></td>
                                <td><?php echo number_format($tin[0]['pres_anterior'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                                <td><?php echo number_format($tin[0]['ejec_anterior'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                                <td><?php echo number_format($tin[0]['presupuesto'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                                <td id="total-in-<?php echo $tin[0]['idsub'] ?>"><?php echo number_format($tin[0]['ejecutado_actual'], $formato_num[0], $formato_num[1], $formato_num[2]); ?></td>
                                <td></td>
                            </tr>
                            <?php
                    //$ingresos = $this->requestAction();
                            ?>
                            <?php $this->append('campo_js') ?>
                            <script>
                        $.get('<?php echo $this->Html->url(array('action' => 'get_ingresos', $presupuesto['Presupuesto']['id'], $tin[0]['idsub'])); ?>', function (data) { // Loads content into the 'data' variable.
                            $('#a-ajax-ing-<?php echo $tin[0]['idsub'] . '-' . $tin['ingresos']['subge_id'] ?>').after(data); // Injects 'data' after the #mydiv element.
                        });
                    </script>
                    <?php $this->end() ?>

                <?php endforeach; ?>
                <tr class="text-uppercase" style="font-size: 14px;">
                    <td></td>
                    <td>TOTAL GENERAL INGRESOS</td>
                    <td></td>
                    <td><?php echo number_format($tot_i['ingreso'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                    <td><?php echo number_format($tot_i['pres_anterior'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                    <td><?php echo number_format($tot_i['ejec_anterior'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                    <td><?php echo number_format($tot_i['presupuesto'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                    <td id="ttejecutado_i">0</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<h2 class="text-center text-warning page-header" style="cursor: pointer;" onclick="$('#div-egresos-o').toggle(400);">EGRESOS</h2>
<div style="display: none;" id="div-egresos-o">
    <div class="form-horizontal form-bordered">
        <?php echo $this->Form->create('Presupuesto', array('action' => 'guarda_egreso', $presupuesto['Presupuesto']['id'])); ?>
        <?php echo $this->Form->hidden('Egreso.presupuesto_id', array('value' => $presupuesto['Presupuesto']['id'])); ?>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <div id="gasto-select">
                        <label>Gasto<br> egreso</label>
                        <?php echo $this->Form->select('Egreso.subconcepto_id', $subconceptos_e, array('class' => 'select2 f-subgasto', 'empty' => 'Seleccione el subconcepto', 'required','style' => 'width:100%;')); ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Presupuesto<br> anterior</label>
                    <?php echo $this->Form->text('Egreso.pres_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
                </div>
                <div class="col-md-2">
                    <label>Ejecutado<br> anterior</label>
                    <?php echo $this->Form->text('Egreso.ejec_anterior', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
                </div>
                <div class="col-md-2">
                    <label>Presupuesto<br><br></label>
                    <?php echo $this->Form->text('Egreso.presupuesto', array('class' => 'form-control', 'type' => 'number', 'step' => 'any', 'min' => 0, 'placeholder' => '0.00')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">    
                <div class="col-md-12">
                    <button class="btn btn-alt btn-primary col-md-12" type="submit">REGISTRAR</button>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter table-condensed table-bordered dataTable no-footer tsinf">
            <thead>
                <tr>
                    <th></th>
                    <th>Detalle Egresos</th>
                    <th>Presupuesto Anterior</th>
                    <th>Ejecutado Anterior</th>
                    <th>Presupuesto</th>
                    <th>Ejecutado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tot_e['pres_anterior'] = 0.00;
                $tot_e['ejec_anterior'] = 0.00;
                $tot_e['presupuesto'] = 0.00;
                $tot_e['ejecutado'] = 0.00;
                ?>
                <script>
                    var ttejecutado_e = 0.00;
                </script>
                <?php foreach ($tegresos as $gas): ?>
                    <?php
                    $tot_e['pres_anterior'] = $tot_e['pres_anterior'] + $gas[0]['pres_anterior'];
                    $tot_e['ejec_anterior'] = $tot_e['ejec_anterior'] + $gas[0]['ejec_anterior'];
                    $tot_e['presupuesto'] = $tot_e['presupuesto'] + $gas[0]['presupuesto'];
                    $tot_e['ejecutado'] = $tot_e['ejecutado'] + $gas[0]['ejecutado_actual'];
                    ?>
                    <tr class="text-info text-uppercase info" id="a-ajax-eg-<?php echo $gas[0]['idsub'] ?>" style=" font-size: 14px;">
                        <td><?php echo $gas[0]['codigo'] ?></td>
                        <td>
                            <?php echo $gas[0]['nombre']; ?>
                        </td>
                        <td><?php echo number_format($gas[0]['pres_anterior'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                        <td><?php echo number_format($gas[0]['ejec_anterior'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                        <td><?php echo number_format($gas[0]['presupuesto'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                        <td id="total-eg-<?php echo $gas[0]['idsub'] ?>"> <?php echo number_format($gas[0]['ejecutado_actual'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                        <td></td>
                    </tr>
<?php $this->append('campo_js') ?>
                    <script>
                        $.get('<?php echo $this->Html->url(array('action' => 'get_egresos', $presupuesto['Presupuesto']['id'], $gas[0]['idsub'])); ?>', function (data) { // Loads content into the 'data' variable.
                            $('#a-ajax-eg-<?php echo $gas[0]['idsub'] ?>').after(data); // Injects 'data' after the #mydiv element.
                        });
                    </script>
<?php $this->end() ?>

                <?php endforeach; ?>
                <tr class="text-uppercase" style=" font-size: 14px;">
                    <td></td>
                    <td>TOTAL EGRESOS</td>
                    <td><?php echo number_format($tot_e['pres_anterior'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                    <td><?php echo number_format($tot_e['ejec_anterior'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                    <td><?php echo number_format($tot_e['presupuesto'], $formato_num[0], $formato_num[1], $formato_num[2]) ?></td>
                    <td id="ttejecutado_e">0</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

<?php $this->start('campo_css') ?>
<link href="<?php echo $this->webroot; ?>template/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $this->end() ?>
<?php $this->start('campo_js') ?>
<script src="<?php echo $this->webroot; ?>template/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script>
$('.select2').select2();
    //---------------- INGRESOS --------------//
    /*function muestra_form_c() {
     $('#concepto-select').toggle(400);
     $('#concepto-form').toggle(400);
     $('.f-n-concepto').each(function (i, val) {
     $(val).prop('required', true);
     });
     $('.f-subconcepto').each(function (i, val) {
     $(val).prop('required', false).val('');
     });
     }
     function muestra_select_c() {
     $('#concepto-select').toggle(400);
     $('#concepto-form').toggle(400);
     $('.f-n-concepto').each(function (i, val) {
     $(val).prop('required', false).val('');
     });
     $('.f-subconcepto').each(function (i, val) {
     $(val).prop('required', true);
     });
     }
     function muestra_c_tipo_t() {
     $('#c_tipo_s').toggle(400);
     $('#c_tipo_t').toggle(400);
     $('.c-tipo-t').each(function (i, val) {
     $(val).prop('required', true);
     });
     $('.c-tipo-s').each(function (i, val) {
     $(val).prop('required', false).val('');
     });
     }
     function muestra_c_tipo_s() {
     $('#c_tipo_t').toggle(400);
     $('#c_tipo_s').toggle(400);
     $('.c-tipo-t').each(function (i, val) {
     $(val).prop('required', false).val('');
     });
     $('.c-tipo-s').each(function (i, val) {
     $(val).prop('required', true);
     });
 }*/


 $('#sel-subconcepto').change(function () {
    $('#d_ajax_ges').load('<?= $this->Html->url(array('controller' => 'Conceptos', 'action' => 'ajax_subges')) ?>/' + $('#sel-subconcepto').val());
});

 var porcentaje = 0.00;
 var ingreso = 0.00;
 var presupuesto = 0.00;
 $('#c-porcentaje').keyup(function () {
    if ($('#c-porcentaje').val() != '') {
        porcentaje = parseFloat($('#c-porcentaje').val());
    } else {
        porcentaje = 0.00;
    }
    presupuesto = Math.round(porcentaje * ingreso * 100) / 100;
    $('#c-presupuesto').val(presupuesto);
});
 $('#c-ingreso').keyup(function () {
    if ($('#c-ingreso').val() != '') {
        ingreso = parseFloat($('#c-ingreso').val());
    } else {
        ingreso = 0.00;
    }
    presupuesto = Math.round(porcentaje * ingreso * 100) / 100;
    $('#c-presupuesto').val(presupuesto);
});
    //--------------- TERMINA INGRESOS ----------- //

    //---------------- EGRESOS --------------------//
    function muestra_form_c_g() {
        $('#gasto-select').hide(400);
        $('#gasto-form').show(400);
        $('.f-n-gasto').each(function (i, val) {
            $(val).prop('required', true);
        });
        $('.f-subgasto').each(function (i, val) {
            $(val).prop('required', false).val('');
        });
    }
    function muestra_select_c_g() {
        $('#gasto-select').show(400);
        $('#gasto-form').hide(400);
        $('.f-n-gasto').each(function (i, val) {
            $(val).prop('required', false).val('');
        });
        $('.f-subgasto').each(function (i, val) {
            $(val).prop('required', true);
        });
        muestra_c_tipo_s_g();
        muestra_c_gasto_s_g();
    }
    function muestra_c_tipo_t_g() {
        $('#c_tipo_s_g').hide(400);
        $('#c_tipo_t_g').show(400);
        $('.c-tipo-t-g').each(function (i, val) {
            $(val).prop('required', true);
        });
        $('.c-tipo-s-g').each(function (i, val) {
            $(val).prop('required', false).val('');
        });
    }
    function muestra_c_tipo_s_g() {
        $('#c_tipo_t_g').hide(400);
        $('#c_tipo_s_g').show(400);
        $('.c-tipo-t-g').each(function (i, val) {
            $(val).prop('required', false).val('');
        });
        $('.c-tipo-s-g').each(function (i, val) {
            $(val).prop('required', true);
        });
    }
    function muestra_c_gasto_t_g() {
        $('#c_gasto_s_g').hide(400);
        $('#c_gasto_t_g').show(400);
        $('.c-gasto-t-g').each(function (i, val) {
            $(val).prop('required', true);
        });
        $('.c-gasto-s-g').each(function (i, val) {
            $(val).prop('required', false).val('');
        });
    }
    function muestra_c_gasto_s_g() {
        $('#c_gasto_t_g').hide(400);
        $('#c_gasto_s_g').show(400);
        $('.c-gasto-t-g').each(function (i, val) {
            $(val).prop('required', false).val('');
        });
        $('.c-gasto-s-g').each(function (i, val) {
            $(val).prop('required', true);
        });
    }
    function ir_pre_ambientes() {
        subges = $('#sel-subges').val();
        subconcepto = $('.f-subconcepto').val();
        window.location.href = '<?= $this->Html->url(array('action' => 'pre_ambientes', $presupuesto['Presupuesto']['id'])); ?>/' + subconcepto + '/' + subges;
    }
    /*$('.f-subconcepto').change(function () {
     
     var postData = $("#form-ingresos").serializeArray();
     var formURL = '<?= $this->Html->url(array('action' => 'get_ing_anu')); ?>';
     $.ajax(
     {
     url: formURL,
     type: "POST",
     data: postData,
     success: function (data, textStatus, jqXHR)
     {
     console.log($.parseJSON(data).sub);
     if (data == 1) {
     alert("si");
     $('#gene-x-ambiente').attr('href', '<?= $this->Html->url(array('action' => 'pre_ambientes')); ?>/' + $.parseJSON(data).sub);
     } else {
     $('#gene-x-ambiente').attr('href', '<?= $this->Html->url(array('action' => 'pre_ambientes')); ?>/' + $.parseJSON(data).sub);
     }
     //$('#c-ingreso').val($.parseJSON(data).monto);
     //data: return data from server
     //$("#parte").html(data);
     }
     });
     
 });*/
    //-------------------- TERMINA EGRESOS -------------------//


    function currencyFormatDE(num) {
        return num
                .toFixed(2) // always two decimal digits
                .replace(".", ",") // replace decimal point character with ,
                .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."); // use . as a separator
            }
            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            }

        </script>


        <?php $this->end() ?>