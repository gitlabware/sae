<?php
$pagador = "";
if ($this->request->data['Comprobante']['tipo'] == 'Ingreso') {
  $pagador = "Recibido de: ";
} elseif ($this->request->data['Comprobante']['tipo'] == 'Egreso') {
  $pagador = "Beneficiario: ";
} elseif ($this->request->data['Comprobante']['tipo'] == 'Ingreso de Banco') {
  $pagador = "Recibido de: ";
}
?>

<div class="row">
  <div class="col-6 col-8 align-self-center">
    <h2 class="text-themecolor m-b-0 m-t-0">Comprobante de Pago</h2>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <center><h3 class="text-center">COMPROBANTE DE  <?php echo strtoupper($this->request->data['Comprobante']['tipo']); ?></h3></center>
  </div>  
</div>
<?php echo $this->Form->create('Comprobante'); ?>
<?php echo $this->Form->hidden('Comprobante.id'); ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            <div class="form-group">
              <label class="control-label" for="user-settings-email"><?php echo "$pagador " ?> </label>
              <div class="">
                <?php echo $this->Form->text('Comprobante.nombre', array('class' => 'form-control', 'required', 'placeholder' => 'Ingrese el nombre del pagador o beneficiario')); ?>
              </div>
            </div>
          </div>
          <div class="col-4">
            <label class="" for="user-settings-email">Fecha:  </label>
            
            <?php echo $this->Form->date('Comprobante.fecha', array('class' => 'form-control', 'required', 'placeholder' => 'Fecha del Comprobante')); ?>
            
          </div>
        </div>
        


        <div class="row">
          <div class="col-8">
            <div class="form-group">
              <label class="control-label" for="user-settings-email">Documento de Respaldo:  </label>
              <div>
                <?php echo $this->Form->text('Comprobante.nota', array('class' => 'form-control', 'placeholder' => 'Ejemplo: Cheque con numero: 5536')); ?>
              </div>
            </div>
          </div>
          <div class="col-4">
            <label class=" control-label" for="user-settings-email">T/C UFV:  </label>
            
            <?php echo $this->Form->text('Comprobante.tc_ufv', array('class' => 'form-control', 'required', 'placeholder' => 'Tipo de Cambio UFV')); ?>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8">
            <div class="form-group">

            </div>
          </div>
          <div class="col-4">
            <label class="control-label" for="user-settings-email">T/C DOLAR:  </label>
            
            <?php echo $this->Form->text('Comprobante.tc_dolar', array('class' => 'form-control', 'required', 'placeholder' => 'Tipo de Cambio DOLAR')); ?>
            
          </div>
        </div>
      </div></div></div></div>

      <!-- Example Content -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">

              <div class="table-responsive m-t-40">
                <table id="general-table" class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 9%;">Cod.Ap.</th>
                      <th style="width: 9%;">Codigo</th>
                      <th style="width: 27%;">Cuenta Contable</th>
                      <th style="width: 27%;">Auxiliar</th>
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
                        <td><?php echo $this->Form->text("comprobantes.$key.codigo_subc", array('class' => 'form-control', 'value' => $co['Comprobantescuenta']['codigo_subc'])); ?></td>
                        <td><?php echo $this->Form->text("comprobantes.$key.codigo", array('class' => 'form-control', 'value' => $co['Comprobantescuenta']['codigo'])); ?></td>
                        <td><?php echo $this->Form->text("comprobantes.$key.cta_ctable", array('class' => 'form-control', 'value' => $co['Comprobantescuenta']['cta_ctable'])); ?></td>
                        <td><?php echo $this->Form->text("comprobantes.$key.auxiliar", array('class' => 'form-control', 'value' => $co['Comprobantescuenta']['auxiliar'])); ?></td>
                        <td><?php echo $this->Form->text("comprobantes.$key.debe", array('class' => 'form-control debe', 'value' => $co['Comprobantescuenta']['debe'])); ?></td>
                        <td><?php echo $this->Form->text("comprobantes.$key.haber", array('class' => 'form-control haber', 'value' => $co['Comprobantescuenta']['haber'])); ?></td>
                        <td class="text-center">
                          <div class="btn-group btn-group-xs">
                            <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Comprobantes', 'action' => 'opciones', $co['Comprobantescuenta']['id'])); ?>');" title="Opciones" class="btn btn-secondary "> <i class="fa fa-qrcode"></i> </a> 
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>TOTAL Bs.:</td>
                      <td id="total-debe"></td>
                      <td id="total-haber"></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div></div></div></div></div>
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">

                     <div class="row">

                         <div class="col-1 " align="right"><h4>Glosa: </h4> </div>

                         <div class="col-11">
                          <?php echo $this->Form->textarea('Comprobante.concepto', array('class' => 'form-control', 'required', 'placeholder' => 'Ingrese el nombre del pagador o beneficiario', 'id' => 'tglosa')); ?>
                        </div>
                      

                    </div>
                    <br>
                    <div class="row">
                      <div class="col-4">
                        <button class="btn btn-block btn-primary" type="button" onclick="window.location = '<?php echo $this->Html->url(array('controller' => 'Comprobantes', 'action' => 'index')); ?>'">IR A COMPROBANTES</button>
                      </div>
                      <div class="col-4">
                        <button class="btn btn-block btn-danger" type="button" onclick="if (confirm('Esta seguro de eliminar el comprobante??')) {
                          window.location = '<?php echo $this->Html->url(array('action' => 'eliminar', $this->request->data['Comprobante']['id'])); ?>';
                        }">Eliminar Comprobante
                      </button>
                    </div>
                    <div class="col-4">
                      <button class="btn btn-block btn-success" type="submit">Generar Comprobante</button>
                    </div>
                  </div>


                  <br>
                </div>
              </div>
            </div>
          </div>
          <!-- END Example Block -->
          <?php echo $this->Form->end(); ?>
          <script>

            $('.debe').keyup(function () {
              sum_debe();
            });
            function sum_debe() {
              var debe = 0.00;
              $('.debe').each(function (e, valor) {
                if ($(valor).val() != '') {
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
                if ($(valor).val() != '') {
                  haber += parseFloat($(valor).val());
                }
              });
              $('#total-haber').html(Math.round(haber * 100) / 100);
            }
            sum_haber();

  /*$('#tglosa').keyup(function () {
   console.log($('#tglosa').val());
 });*/

</script>
