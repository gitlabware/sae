
<?php if (!empty($subconceptos)): ?>
  <?php
  $clase_r = 'table-warning';
  if ($sw == 1) {
    $clase_r = '';
  }
  ?>
<table class="table table-bordered" style="margin-bottom: 0px;">

      <?php foreach ($subconceptos as $sub): ?>
        <tr class="<?php echo $clase_r ?>">
            <td style="width: 10%;"><?php echo $sub['Subconcepto']['codigo'] ?></td>
            <td style="width: 45%;"><?php echo $sub['Subconcepto']['nombre'] ?></td>
            <td style="width: 10%;"><?php echo $sub['Subconcepto']['tipo'] ?></td>
            <td style="width: 20%;"><?php echo $sub['Concepto']['nombre'] ?></td>
            <td style="width: 15%;">
                <a class="btn btn-secondary btn-sm" href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'subconcepto', $sub['Subconcepto']['id'])); ?>');"> <i class="fa fa-pencil"></i> </a>  
                <?php echo $this->Html->link('<i class="fa fa-remove"></i>', array('action' => 'eliminar_subconcepto', $sub['Subconcepto']['id']), array('class' => 'btn btn-danger btn-sm', 'escape' => FALSE, 'confirm' => 'Esta seguro de quitar el subconcepto!!', 'title' => 'Quitar subconcepto')) ?> 

            </td>
        </tr>
        <tr>
            <td style="padding: 0px;" colspan="5" id="subconcepto-<?php echo $sub['Subconcepto']['id']; ?>">

            </td>
        </tr>

        <script>
          $('#subconcepto-<?php echo $sub['Subconcepto']['id']; ?>').load('<?php echo $this->Html->url(array('action' => 'ajax_subconceptos', $sub['Subconcepto']['id'], 1)) ?>');
        </script>
      <?php endforeach; ?>
  </table>
<?php endif; ?>