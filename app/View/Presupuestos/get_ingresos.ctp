<?php 
$formato_num[0] = 2;
$formato_num[1] = ",";
$formato_num[2] = ".";
?>
<?php if (!empty($ingresos)): ?>
    <?php $total_m = 0.00; ?>
    <?php foreach ($ingresos as $tin): ?>
        <?php
        if ($tin[0]['ejecutado_actual'] != '-') {
            $total_m = $tin[0]['ejecutado_actual'] + $total_m;
            //debug($tin[0]['ejecutado_actual']);exit;
        }
        $clase = "";
        if (!$sw) {
            $clase = "text-warning warning";
        }
        ?>
        <tr class="<?php echo $clase; ?> text-uppercase" id="a-ajax-ing-<?php echo $tin[0]['idsub'] . '-' . $tin['ingresos']['subge_id'] ?>" style="font-size: 14px;">
            <td><?php echo $tin[0]['codigo'] ?></td>
            <td>
                <?php
                echo $tin[0]['nombre'];

                if (!empty($tin['SubcGestione']['gestion_ini'])) {
                    if ($tin['SubcGestione']['gestion_ini'] == $tin['SubcGestione']['gestion_fin']) {
                        echo ' (' . $tin['SubcGestione']['gestion_ini'] . ')';
                    } else {
                        echo ' (' . $tin['SubcGestione']['gestion_ini'] . ' - ' . $tin['SubcGestione']['gestion_fin'] . ')';
                    }
                }
                ?>
            </td>
            <td><?php echo number_format($tin[0]['porcentaje'],$formato_num[0],$formato_num[1],$formato_num[2]) ?></td>
            <td><?php echo number_format($tin[0]['ingreso'],$formato_num[0],$formato_num[1],$formato_num[2]) ?></td>
            <td><?php echo number_format($tin[0]['pres_anterior'],$formato_num[0],$formato_num[1],$formato_num[2]) ?></td>
            <td><?php echo number_format($tin[0]['ejec_anterior'],$formato_num[0],$formato_num[1],$formato_num[2]) ?></td>
            <td><?php echo number_format($tin[0]['presupuesto'],$formato_num[0],$formato_num[1],$formato_num[2]) ?></td>
            <td id="total-in-<?php echo $tin[0]['idsub'] ?>"><?php echo number_format($tin[0]['ejecutado_actual'],$formato_num[0],$formato_num[1],$formato_num[2]) ?></td>
            <td>
                <?php //if ($tin[0]['porcentaje'] != ''): ?>
                <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'ingreso', $tin['ingresos']['id'])) ?>');" class="btn btn-sm btn-primary" title="Editar"><i class="gi gi-edit"></i></a> 
                    <?php echo $this->Html->link('<i class="gi gi-remove_2"></i>', array('action' => 'elimina_ingreso', $tin['ingresos']['id']), array('class' => 'btn btn-sm btn-danger', 'title' => 'Eliminar', 'confirm' => 'Esta seguro de eliminar el ingreso??', 'escape' => FALSE)) ?>
                    <?php //endif; ?>
            </td>
        </tr>
        <script>
            $.get('<?php echo $this->Html->url(array('action' => 'get_ingresos', $presupuesto['Presupuesto']['id'], $tin[0]['idsub'], true)); ?>', function (data) { // Loads content into the 'data' variable.
                $('#a-ajax-ing-<?php echo $tin[0]['idsub'] . '-' . $tin['ingresos']['subge_id'] ?>').after(data); // Injects 'data' after the #mydiv element.
            });
        </script>
    <?php endforeach; ?>
    <?php
//number_format($total_m,',','.');
    ?>
    <script>
        

        var total_aux23 = parseFloat('<?php echo $total_m; ?>');
        $('#total-in-<?php echo $idSubconcepto ?>').html(currencyFormatDE(total_aux23));
        //console.log(<?php echo $total_m ?>);
    <?php if (!empty($subconcepto['Subconcepto']['subconcepto_id'])): ?>
            var aux_total = parseFloat($('#total-in-<?php echo $subconcepto['Subconcepto']['subconcepto_id'] ?>').html());
            aux_total = <?php echo $total_m ?> + aux_total;
            aux_total = Math.round(aux_total * 100) / 100;
            $('#total-in-<?php echo $subconcepto['Subconcepto']['subconcepto_id'] ?>').html(currencyFormatDE(aux_total));
    <?php endif; ?>


        ttejecutado_i = parseFloat($('#ttejecutado_i').html().replace(".","").replace(",",'.'));
        ttejecutado_i = <?php echo $total_m ?> + ttejecutado_i;
        ttejecutado_i = (Math.round(ttejecutado_i * 100) / 100);
        console.log($('#ttejecutado_i').html());
        var numero_ejecutado = currencyFormatDE(ttejecutado_i);
        $('#ttejecutado_i').html(numero_ejecutado);
        //console.log(ttejecutado_i);
    </script>
<?php endif; ?>
