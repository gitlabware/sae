<?php
$pagador = "";
if ($this->request->data['Comprobante']['tipo'] == 'Ingreso') {
  $pagador = "Recibido de: ";
}elseif ($this->request->data['Comprobante']['tipo'] == 'Egreso') {
  $pagador = "Beneficiario: ";
}elseif($this->request->data['Comprobante']['tipo'] == 'Ingreso de Banco'){
  $pagador = "Recibido de: ";
}
?>
<div class="block">
    <!-- Example Title -->
    <div class="block-title">
        <h2>Comprobante de Pago</h2>
    </div>
    <center><h1>COMPROBANTE DE  <?php echo strtoupper($this->request->data['Comprobante']['tipo']); ?></h1></center>
    <?php echo $this->Form->create('Comprobante'); ?>
    <?php echo $this->Form->hidden('Comprobante.id'); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email"><?php echo "$pagador " ?> </label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('Comprobante.nombre', array('class' => 'form-control', 'required', 'placeholder' => 'Ingrese el nombre del pagador o beneficiario')); ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <label class="col-md-4 control-label" for="user-settings-email">Fecha:  </label>
            <div class="col-md-8">
                <?php echo $this->Form->date('Comprobante.fecha', array('class' => 'form-control', 'required', 'placeholder' => 'Fecha del Comprobante')); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Por Concepto:  </label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('Comprobante.concepto', array('class' => 'form-control', 'required', 'placeholder' => 'Ingrese el nombre del pagador o beneficiario')); ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <label class="col-md-4 control-label" for="user-settings-email">T/C:  </label>
            <div class="col-md-8">
                <?php echo $this->Form->text('Comprobante.tc_ufv', array('class' => 'form-control', 'required', 'placeholder' => 'Tipo de Cambio')); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label class="col-md-4 control-label" for="user-settings-email">Documento de Respaldo:  </label>
                <div class="col-md-8">
                    <?php echo $this->Form->text('Comprobante.nota', array('class' => 'form-control', 'placeholder' => 'Ejemplo: Cheque con numero: 5536')); ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            
        </div>
    </div>

    <!-- Example Content -->


    <div class="table-responsive">
        <table id="general-table" class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 12%;">Codigo</th>
                    <th style="width: 30%;">Cuenta Contable</th>
                    <th style="width: 30%;">Auxiliar</th>
                    <th style="width: 10%;">Debe</th>
                    <th style="width: 10%;">Haber</th>
                    <th style="width: 8%;"></th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach ($c_comprobantes as $key => $co): ?>
                  <?php echo $this->Form->hidden("comprobantes.$key.id", array('value' => $co['Comprobantescuenta']['id'])); ?>
                  <?php
                  $clase = 'class="warning"';
                  if (!empty($co['Comprobantescuenta']['debe'])) {
                    $clase = 'class="success"';
                  }
                  ?>
                  <tr <?php echo $clase ?>>
                      <td><?php echo $this->Form->text("comprobantes.$key.codigo", array('class' => 'form-control', 'value' => $co['Comprobantescuenta']['codigo'])); ?></td>
                      <td><?php echo $this->Form->text("comprobantes.$key.cta_ctable", array('class' => 'form-control', 'value' => $co['Comprobantescuenta']['cta_ctable'])); ?></td>
                      <td><?php echo $this->Form->text("comprobantes.$key.auxiliar", array('class' => 'form-control', 'value' => $co['Comprobantescuenta']['auxiliar'])); ?></td>
                      <td><?php echo $this->Form->text("comprobantes.$key.debe", array('class' => 'form-control debe', 'value' => $co['Comprobantescuenta']['debe'])); ?></td>
                      <td><?php echo $this->Form->text("comprobantes.$key.haber", array('class' => 'form-control haber', 'value' => $co['Comprobantescuenta']['haber'])); ?></td>
                      <td class="text-center"><a class="btn btn-sm btn-info" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Comprobantes', 'action' => 'opciones', $co['Comprobantescuenta']['id'])); ?>');" title="Opciones"> <i class="fa fa-tasks"></i> </a> </td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td>TOTAL Bs.:</td>
                    <td id="total-debe"></td>
                    <td id="total-haber"></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-4">
            <button class="btn btn-block btn-primary" type="button" onclick="window.location = '<?php echo $this->Html->url(array('controller' => 'Comprobantes', 'action' => 'index')); ?>'">IR A COMPROBANTES</button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-block btn-danger" type="button" onclick="if (confirm('Esta seguro de eliminar el comprobante??')) {
                      window.location = '<?php echo $this->Html->url(array('action' => 'eliminar', $this->request->data['Comprobante']['id'])); ?>';
                  }">Eliminar Comprobante
            </button>
        </div>
        <div class="col-md-4">
            <button class="btn btn-block btn-success" type="submit">Generar Comprobante</button>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>
</div>
<!-- END Example Block -->

<script>
  $('.debe').keyup(function () {
      sum_debe();
  });
  function sum_debe() {
      var debe = 0.00;
      $('.debe').each(function (e, valor) {
        if($(valor).val() != ''){
          debe += parseFloat($(valor).val());
        }
      });
      $('#total-debe').html(Math.round(debe * 100) / 100);
  }
  sum_debe();
  
  $('.haber').keyup(function () {
      sum_haber();
  });
  function sum_haber() {
      var haber = 0.00;
      $('.haber').each(function (e, valor) {
        if($(valor).val() != ''){
          haber += parseFloat($(valor).val());
        }
      });
      $('#total-haber').html(Math.round(haber * 100) / 100);
  }
  sum_haber();
</script>
