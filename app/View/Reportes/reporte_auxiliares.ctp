
<script>
  function cargardetalles(idAmbiente, idComprobante) {
      if ($('#comp-' + idAmbiente + '-' + idComprobante).attr('data-sw') == 'FALSE') {
          //alert($('#comp-' + idAmbiente + '-' + idComprobante).attr('data-sw'));
          $.get('<?php echo $this->Html->url(array('action' => 'get_detalles_comp', $fecha_ini, $fecha_fin)); ?>/' + idAmbiente + '/' + idComprobante, function (data) { // Loads content into the 'data' variable.
              $('#comp-' + idAmbiente + '-' + idComprobante).after(data); // Injects 'data' after the #mydiv element.
          });
          $('#comp-' + idAmbiente + '-' + idComprobante).attr('data-sw', 'TRUE');
      } else {
          $('tr[data-clase="comp-c-' + idAmbiente + '-' + idComprobante + '"]').remove();
          $('#comp-' + idAmbiente + '-' + idComprobante).attr('data-sw', 'FALSE');
      }


  }
</script>
<div class="row">
    <div class="col-md-12">
        <!-- Basic Form Elements Block -->
        <div class="block">
            <!-- Basic Form Elements Title -->
            <div class="block-title">
                <h2>REPORTE AUXILIARES</h2>
            </div>
            <div class="form-horizontal form-bordered">
                <?php echo $this->Form->create('Reporte', array('id' => 'ajaxform')); ?>
                <div class="form-group no-imprime">
                    <div class="col-md-4">
                        <label class="control-label">Propietario</label>
                        <div id="divselectpropietario">
                            <button type="button" class="btn btn-info col-md-12" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'comboselect_prop1', 'Reporte.propietario_id', 'divselectpropietario')); ?>');">

                                <?php
                                if (!empty($this->request->data['Reporte']['propietario_id'])) {
                                  echo $propietario['User']['nombre'];
                                  $this->Form->hidden('Reporte.propietario_id', array('value' => $this->request->data['Reporte']['propietario_id']));
                                } else {
                                  echo 'SELECCIONE EL PROPIETARIO';
                                }
                                ?>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Inquilino</label>
                        <div id="divselectinquilino">
                            <button type="button" class="btn btn-info col-md-12" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'comboselect_inq1', 'Reporte.inquilino_id', 'divselectinquilino')); ?>');">

                                <?php
                                if (!empty($this->request->data['Reporte']['inquilino_id'])) {
                                  echo $inquilino['User']['nombre'];
                                  $this->Form->hidden('Reporte.inquilino_id', array('value' => $this->request->data['Reporte']['inquilino_id']));
                                } else {
                                  echo 'SELECCIONE EL INQUILINO';
                                }
                                ?>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label">Ambiente</label>
                        <div id="divselectambiente">
                            <button type="button" class="btn btn-info col-md-12" onclick="cargarmodal('<?php echo $this->Html->url(array('action' => 'comboselect_amb1', 'Reporte.ambiente_id', 'divselectambiente')); ?>');">
                                <?php
                                if (!empty($this->request->data['Reporte']['ambiente_id'])) {
                                  echo $ambiente['Ambiente']['nombre'];
                                  $this->Form->hidden('Reporte.ambiente_id', array('value' => $this->request->data['Reporte']['ambiente_id']));
                                } else {
                                  echo 'SELECCIONE EL AMBIENTE';
                                }
                                ?>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group no-imprime">
                    <div class="col-md-3">
                        <label class="control-label">Auxiliar</label>
                        <?php echo $this->Form->text('auxiliar', array('class' => 'form-control')); ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Fecha_Inicio</label>
                        <?php echo $this->Form->date('fecha_ini', array('class' => 'form-control', 'required')); ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Fecha_Fin</label>
                        <?php echo $this->Form->date('fecha_fin', array('class' => 'form-control', 'required')); ?>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">&nbsp;</label>
                        <button class="btn btn-primary form-control">BUSCAR</button>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
                <div class="form-group">
                    <div class="col-md-12" id="divtablapagos">
                        <?php if (!empty($pagos)): ?>
                          <h2 class="text-center text-success">REPORTE DE AUXILIARES DEL EDIFICIO <?php echo strtoupper($this->Session->read('Auth.User.Edificio.nombre')); ?></h2>
                          <h3 class="text-center"> <?php echo 'DESDE FECHA: ' . $this->request->data['Reporte']['fecha_ini'] . ' HASTA FECHA: ' . $this->request->data['Reporte']['fecha_fin'] ?></h3>
                          <h4 class="text-center">
                              <?php
                              if (!empty($propietario)) {
                                echo '&nbsp;&nbsp;PROPIETARIO: ' . $propietario['User']['nombre'];
                              }
                              if (!empty($inquilino)) {
                                echo '&nbsp;&nbsp;INQUILINO: ' . $inquilino['User']['nombre'];
                              }
                              if (!empty($ambiente)) {
                                echo '&nbsp;&nbsp;AMBIENTE: ' . $ambiente['Ambiente']['nombre'] . '/' . $ambiente['Piso']['nombre'];
                              }
                              if (!empty($this->request->data['Reporte']['auxiliar'])) {
                                echo '&nbsp;&nbsp;AUXILIAR: ' . $this->request->data['Reporte']['auxiliar'];
                              }
                              ?>
                          </h4>  
                          <div class="table-responsive">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>Fecha</th>
                                          <th>N. Com.</th>
                                          <th>Cod.Pres.</th>
                                          <th>Cod.Cont.</th>
                                          <th>Cta. Contable</th>
                                          <?php if (empty($ambiente)): ?>
                                            <th>Ambiente</th>
                                            <th>Piso</th>
                                          <?php endif; ?>
                                          <th>Auxiliar</th>
                                          <?php if (empty($propietario)): ?>
                                            <th>Propietario</th>
                                          <?php endif; ?>
                                          <th>Inquilinos</th>
                                          <th>Importe</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $total = 0.00; ?>

                                      <?php foreach ($pagos as $pag): ?>
                                        <?php $total = $total + $pag[0]['importe_total']; ?>
                                        <tr style="cursor:pointer;"  class="warning text-success" data-sw="FALSE" id="comp-<?php echo $pag['Comprobantescuenta']['ambiente_id'] . '-' . $pag['Comprobantescuenta']['nomenclatura_id'] ?>" onclick="cargardetalles(<?php echo $pag['Comprobantescuenta']['ambiente_id'] . ',' . $pag['Comprobantescuenta']['nomenclatura_id'] ?>);">
                                            <td><?php echo $pag['Comprobante']['fecha'] ?></td>
                                            <td><?php //echo $pag['Comprobante']['numero']     ?></td>
                                            <td><?php echo $pag['Comprobantescuenta']['codigo_subc'] ?></td>
                                            <td><?php echo $pag['Comprobantescuenta']['codigo'] ?></td>
                                            <td><?php echo $pag['Comprobantescuenta']['cta_ctable'] ?></td>
                                            <?php if (empty($ambiente)): ?>
                                              <td><?php echo $pag['Ambiente']['nombre'] ?></td>
                                              <td><?php echo $pag['Comprobantescuenta']['piso'] ?></td>
                                            <?php endif; ?>
                                            <td><?php //echo $pag['Comprobantescuenta']['auxiliar']     ?></td>
                                            <?php if (empty($propietario)): ?>
                                              <td><?php echo $pag['Comprobantescuenta']['propietario'] ?></td>
                                            <?php endif; ?>
                                            <td><?php echo $pag['Ambiente']['lista_inquilinos'] ?></td>
                                            <td><?php echo $pag[0]['importe_total'] ?></td>
                                        </tr>
                                    <script>
                                      //cargardetalles(<?php //echo $pag['Comprobantescuenta']['ambiente_id'] . ',' . $pag['Comprobantescuenta']['nomenclatura_id']    ?>);
                                    </script>
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
                                      <td><?php echo $total; ?></td>
                                  </tr>
                                  </tbody>
                              </table>
                          </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



