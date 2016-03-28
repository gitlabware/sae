<?php if (!empty($egresos)): ?>
  <?php $total_m = 0.00; ?>
  <?php foreach ($egresos as $teg): ?>

    <?php
    if ($teg[0]['ejecutado_actual'] != '-') {
      $total_m = $teg[0]['ejecutado_actual'] + $total_m;
    }

    $clase = "";
    if (!$sw) {
      $clase = "text-warning warning";
    }
    ?>
    <tr class="<?php echo $clase; ?> text-uppercase" id="a-ajax-eg-<?php echo $teg[0]['idsub'] ?>" style="font-weight: bold; font-size: 15px;">
        <td><?php echo $teg[0]['codigo'] ?></td>
        <td>
            <?php echo $teg[0]['nombre']; ?>
        </td>
        <td><?php echo $teg[0]['pres_anterior'] ?></td>
        <td><?php echo $teg[0]['ejec_anterior'] ?></td>
        <td><?php echo $teg[0]['presupuesto'] ?></td>
        <td id="total-eg-<?php echo $teg[0]['idsub'] ?>"><?php echo $teg[0]['ejecutado_actual'] ?></td>
        <td>
            <?php if ($teg[0]['idsub'] == $teg['egresos']['subconcepto_id']): ?>
              <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'egreso', $teg['egresos']['id'])) ?>');" class="btn btn-sm btn-primary" title="Editar"><i class="gi gi-edit"></i></a> 
                  <?php echo $this->Html->link('<i class="gi gi-remove_2"></i>', array('action' => 'elimina_egreso', $teg['egresos']['id']), array('class' => 'btn btn-sm btn-danger', 'title' => 'Eliminar', 'confirm' => 'Esta seguro de eliminar el Egreso??', 'escape' => FALSE)) ?>
                <?php endif; ?>
        </td>
    </tr>
    <script>
      $.get('<?php echo $this->Html->url(array('action' => 'get_egresos', $presupuesto['Presupuesto']['id'], $teg[0]['idsub'], true)); ?>', function (data) { // Loads content into the 'data' variable.
          $('#a-ajax-eg-<?php echo $teg[0]['idsub'] ?>').after(data); // Injects 'data' after the #mydiv element.
      });
    </script>
  <?php endforeach; ?>
  <script>
    $('#total-eg-<?php echo $idSubconcepto ?>').html('<?php echo $total_m ?>');
    //console.log()
  <?php if (!empty($subconcepto['Subconcepto']['subconcepto_id'])): ?>
   var aux_total = parseFloat($('#total-eg-<?php echo $subconcepto['Subconcepto']['subconcepto_id'] ?>').html()); ;
   //console.log(aux_total);
   aux_total = <?php echo $total_m ?> + aux_total;
   aux_total = Math.round(aux_total* 100) / 100;
   $('#total-eg-<?php echo $subconcepto['Subconcepto']['subconcepto_id'] ?>').html(aux_total);
  <?php endif; ?>
    
    ttejecutado_e = parseFloat($('#ttejecutado_e').html());
    ttejecutado_e = <?php echo $total_m ?> + ttejecutado_e;
    ttejecutado_e = Math.round(ttejecutado_e * 100) / 100;
    $('#ttejecutado_e').html(ttejecutado_e);
  </script>
<?php endif; ?>
