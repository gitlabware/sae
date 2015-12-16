<?php $total = 0.00;?>
<?php foreach ($pagos as $pag): ?>
<?php $total = $total + $pag['Comprobantescuenta']['haber']?>
  <tr id="comp-<?php echo $pag['Comprobantescuenta']['ambiente_id'] . '-' . $pag['Comprobantescuenta']['nomenclatura_id'] ?>" onclick="cargardetalles(<?php echo $pag['Comprobantescuenta']['ambiente_id'] . ',' . $pag['Comprobantescuenta']['nomenclatura_id'] ?>);">
      <td><?php echo $pag['Comprobante']['fecha'] ?></td>
      <td><?php echo $pag['Comprobante']['numero'] ?></td>
      <td><?php echo $pag['Comprobantescuenta']['codigo_subc'] ?></td>
      <td><?php echo $pag['Comprobantescuenta']['codigo'] ?></td>
      <td><?php echo $pag['Comprobantescuenta']['cta_ctable'] ?></td>
      <?php if (empty($ambiente)): ?>
        <td><?php echo $pag['Ambiente']['nombre'] ?></td>
        <td><?php echo $pag['Comprobantescuenta']['piso'] ?></td>
      <?php endif; ?>
      <td><?php echo $pag['Comprobantescuenta']['auxiliar'] ?></td>
      <?php if (empty($propietario)): ?>
        <td><?php echo $pag['Comprobantescuenta']['propietario'] ?></td>
      <?php endif; ?>
      <td><?php echo $pag['Ambiente']['lista_inquilinos'] ?></td>
      <td><?php echo $pag['Comprobantescuenta']['haber'] ?></td>
  </tr>
<?php endforeach; ?>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <?php if (empty($ambiente)): ?>
      <td></td>
      <td></td>
    <?php endif; ?>
    <td></td>
    <?php if (empty($propietario)): ?>
      <td></td>
    <?php endif; ?>
    <td>TOTAL</td>
    <td><?php echo $total ?></td>
</tr>