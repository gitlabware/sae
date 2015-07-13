<div class="row">
    <div class="col-md-4">
        <!-- Advanced Active Theme Color Widget Alternative -->
        <div class="widget">
            <div class="widget-advanced widget-advanced-alt">
                <!-- Widget Header -->
                <div class="widget-header text-center themed-background-dark">                    
                    <a href="page_ready_user_profile.html">
                        <img src="<?php echo $this->webroot; ?>img/placeholders/avatars/iconFolder.jpg" alt="avatar" class="widget-image img-circle">
                    </a>
                    <h4 class="widget-content-light">
                        <a href="page_ready_user_profile.html">Nombre: <?php echo $datosAmbiente['Ambiente']['nombre']; ?></a>
                        &nbsp;&nbsp;
                        Propietario: <?php echo $datosAmbiente['User']['nombre']; ?>
                        <br>
                        <small><i class="gi gi-pin"></i>Piso: <?php echo $datosAmbiente['Piso']['nombre']; ?></small>
                    </h4>
                </div>
                <!-- END Widget Header -->

                <!-- Widget Main -->
                <div class="widget-main">
                    <div class="list-group remove-margin">
                        <a href="javascript:void(0)" class="list-group-item">
                            <span class="pull-right"><strong id="manteminientoAmbiente"></strong></span>
                            <h4 class="list-group-item-heading remove-margin" onclick="ocultapagos();"> <b>Ultimas Deudas Mantenimiento</b></h4>
                        </a>
                        <?php foreach ($ultimas_deudas_man as $ul): ?>
                          <a href="javascript:void(0)" class="list-group-item">
                              <span class="pull-right"><strong id="manteminientoAmbiente"><?php echo $ul['Pago']['monto']; ?></strong></span>
                              <h4 class="list-group-item-heading remove-margin"><i class="fa fa-money fa-fw"></i> <?php echo $ul['Pago']['fecha']; ?></h4>
                          </a>
                        <?php endforeach; ?>
                        <a href="javascript:void(0)" class="list-group-item">
                            <span class="pull-right"><strong id="manteminientoAmbiente"></strong></span>
                            <h4 class="list-group-item-heading remove-margin" onclick="ocultapagos();"> <b>Ultimas Deudas Alquileres</b></h4>
                        </a>
                        <?php foreach ($ultimas_deudas_alq as $ul): ?>
                          <a href="javascript:void(0)" class="list-group-item">
                              <span class="pull-right"><strong id="manteminientoAmbiente"><?php echo $ul['Pago']['monto']; ?></strong></span>
                              <h4 class="list-group-item-heading remove-margin"><i class="fa fa-money fa-fw"></i> <?php echo $ul['Pago']['fecha']; ?></h4>
                          </a>
                        <?php endforeach; ?>

                        <!-- pagos -->
                        <a href="javascript:void(0)" class="list-group-item">
                            <span class="pull-right"><strong id="manteminientoAmbiente"></strong></span>
                            <h4 class="list-group-item-heading remove-margin" onclick="ocultapagos();"> <b>Ultimos Pagos</b></h4>
                        </a>

                        <div id="muestra-pagos" style="display: block;">
                            <?php foreach ($ultimos_pagos as $ul): ?>
                              <a href="javascript:void(0)" class="list-group-item">
                                  <span class="pull-right"><strong id="manteminientoAmbiente"><?php echo ' |Rec. ' . $ul['Recibo']['numero'] . ' | ' . $ul['Pago']['monto']; ?></strong></span>
                                  <h4 class="list-group-item-heading remove-margin"><i class="fa fa-money fa-fw"></i> <?php echo $ul['Pago']['fecha']; ?></h4>
                              </a>
                            <?php endforeach; ?>
                        </div>    
                        <!-- fin pagos -->
                    </div>

                </div>
                <!-- END Widget Main -->
            </div>
        </div>
        <!-- END Advanced Active Theme Color Widget Alternative -->        
    </div>

    <div class="col-md-8">

        <div class="row">
            <?php echo $this->Form->create('Ambiente', array('action' => 'registra_pagos', 'class' => 'form-horizontal form-bordered', 'id' => 'crtform')); ?> 
            <?php echo $this->Form->hidden('id', array('value' => $idAmbiente)); ?>
            <?php echo $this->Form->hidden('propietario_id', array('value' => $datosAmbiente['Ambiente']['user_id'])); ?>
            <?php if (!empty($conceptos[10])): ?>
              <div class="col-md-12">
                  <!-- Input Grid Block -->
                  <div class="block">
                      <div class="form-horizontal form-bordered">
                          <div class="form-group">
                              <label class="col-md-3 control-label">Inquilino: </label>
                              <div class="col-md-9">
                                  <select class="form-control" name="data[Pago][inquilino_id]">
                                      <option value="">Seleccione al inquilino</option>
                                      <?php foreach ($inquilinos as $inq): ?>
                                        <option value="<?php echo $inq['Inquilino']['id']; ?>"><?php echo $inq['User']['nombre'] ?></option>
                                      <?php endforeach; ?>
                                  </select>
                                  <?php //echo $this->Form->select('Pago.inquilino_id', $inquilinos, array('class' => 'form-control')); ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-md-12">
                  <!-- Input Grid Block -->
                  <div class="block">
                      <!-- Input Grid Title -->   
                      <div class="block-title">  
                          <div class="block-options pull-right">
                              <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-content1" onclick="oculta(1)"><i class="fa fa-arrows-v"></i></a>                            
                          </div>
                          <h2>Pago por Mantenimiento</h2> <label class="text-success">Monto mensual: <?php echo $conceptos[10] ?></label> <label class="text-info">Retencion: <?php echo round($conceptos[10] * ($this->Session->read('Auth.User.Edificio.retencion') / 100), 2) ?></label>
                      </div>
                      <!-- END Input Grid Title -->
                      <!-- Block Tabs Title -->
                      <div class="block-content-1" style="display: none;">

                          <?php echo $this->Form->hidden('Mantenimiento.referencia_mantenimiento', array('value' => $conceptos[10], 'id' => 'idrefer_mantenimiento')); ?>
                          <div class="form-group">                    
                              <div class="col-md-3">
                                  <label for="monto-pe">Monto</label>
                                  <input type="number" step="any" class="form-control" id="monto-pe-mantenimiento" name="data[Mantenimiento][monto]" placeholder="Introdusca el monto" onkeyup="calcula_cuotas();">
                              </div>
                              <div class="col-md-2">
                                  <label for="crt2">Reten.</label>
                                  <input type="text" class="form-control" disabled="true" id="retencion-pe-mantenimiento" name="data[Mantenimiento][cuotas]" placeholder="0" onkeyup="calcula_monto();" value="0">
                              </div>
                              <div class="col-md-2">
                                  <label for="crt2"># Cuotas</label>
                                  <input type="text" class="form-control" id="cantidad-pe-mantenimiento" name="data[Mantenimiento][cuotas]" placeholder="0" onkeyup="calcula_monto();">
                              </div>
                              <div class="col-md-2">
                                  <label for="crt2">Cambio</label>
                                  <input type="text" class="form-control" id="cambio-pe-mantenimiento" name="data[Mantenimiento][cambio]" placeholder="0">
                              </div>
                              <div class="col-md-3">
                                  <label for="crt2">Fecha</label>
                                  <?php echo $this->Form->date('Mantenimiento.fecha_inicio', array('class' => 'form-control', 'value' => $fecha_mantenimiento)); ?>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6">
                                  <div class="checkbox">
                                      <label for="mantenimiento">
                                          <input type="checkbox" id="mantenimiento-pagar" name="data[Mantenimiento][pagar]"  onclick="calcula_total();"> Pagar Mantenimiento
                                      </label>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="checkbox">
                                      <label for="mantenimiento">
                                          <input type="checkbox" id="mantenimiento-retencion" name="data[Mantenimiento][retencion]" onclick="calc_ret_man();"> RETENCION
                                      </label>
                                  </div>
                              </div>
                          </div>

                      </div>
                  </div>
                  <!-- END Input Grid Block -->
              </div>
            <?php endif; ?>

            <?php if (!empty($conceptos[11])): ?>
              <div class="col-md-12">
                  <!-- Input Grid Block -->
                  <div class="block">
                      <!-- Input Grid Title -->            
                      <div class="block-title">  
                          <div class="block-options pull-right">
                              <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-content1" onclick="oculta(2)"><i class="fa fa-arrows-v"></i></a>                            
                          </div>
                          <h2>Pago por Alquileres</h2> <label class="text-success">Monto mensual: <?php echo $conceptos[11] ?></label> <label class="text-info">Retencion: <?php echo round($conceptos[11] * ($this->Session->read('Auth.User.Edificio.retencion') / 100), 2) ?></label>
                      </div>
                      <!-- END Input Grid Title -->
                      <!-- Block Tabs Title -->
                      <div class="block-content-2" style="display: none;">
                          <?php echo $this->Form->hidden('Alquiler.referencia_alquileres', array('value' => $conceptos[11], 'id' => 'idrefer_alquiler')); ?>
                          <div class="form-group">                    
                              <div class="col-md-3">
                                  <label for="monto-pe">Monto</label>
                                  <input type="number" step="any" class="form-control" id="monto-pe-alquiler" name="data[Alquiler][monto]" placeholder="Introdusca el monto" onkeyup="calcula_cuotas_alqui();">
                              </div>
                              <div class="col-md-2">
                                  <label for="crt2">Reten.</label>
                                  <input type="text" class="form-control" disabled="true" id="retencion-pe-alquiler" name="data[Alquiler][cuotas]" placeholder="0" onkeyup="calcula_monto();" value="0">
                              </div>
                              <div class="col-md-2">
                                  <label for="crt2"># Cuotas</label>
                                  <input type="text" class="form-control" id="cantidad-pe-alquiler" name="data[Alquiler][cuotas]" placeholder="0" onkeyup="calcula_monto_alqui();">
                              </div>
                              <div class="col-md-2">
                                  <label for="crt2">Cambio</label>
                                  <input type="text" class="form-control" id="cambio-pe-alquiler" name="data[Alquiler][cambio]" placeholder="0">
                              </div>
                              <div class="col-md-3">
                                  <label for="crt2">Fecha</label>
                                  <?php echo $this->Form->date('Alquiler.fecha_inicio', array('class' => 'form-control', 'value' => $fecha_alquiler)); ?>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-md-6">
                                  <div class="checkbox">
                                      <label for="mantenimiento">
                                          <input type="checkbox" id="alquiler-pagar" name="data[Alquiler][pagar]" onclick="calcula_total();"> Pagar ALquiler
                                      </label>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="checkbox">
                                      <label for="mantenimiento">
                                          <input type="checkbox" id="alquiler-retencion" name="data[Alquiler][retencion]" onclick="calc_ret_alq();"> RETENCION
                                      </label>
                                  </div>
                              </div>
                          </div>

                      </div>
                  </div>
                  <!-- END Input Grid Block -->
              </div>
            <?php endif; ?>



            <div class="col-md-12">
                <!-- Input Grid Block -->
                <div class="block">
                    <!-- Input Grid Title -->            
                    <div class="block-title">
                        <div class="block-options pull-right">
                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-content" onclick="ocultaf(1)"><i class="fa fa-arrows-v"></i></a>                            
                        </div>                
                        <h2>Pago por Intereses</h2>
                    </div>
                    <div id="form-1" style="display: none;">
                        <div class="form-group">                    
                            <div class="col-md-6">
                                <label for="monto-pe">Monto</label>
                                <input type="number" step="any" class="form-control" id="monto-pe-interes" name="data[Interes][monto]" placeholder="Introdusca el monto" onkeyup="calcula_total();">
                            </div>
                            <div class="col-md-6">
                                <label for="crt2">Reten.</label>
                                <input type="text" class="form-control" disabled="true" id="retencion-pe-interes" name="data[Interes][cuotas]" placeholder="0" onkeyup="calcula_monto();" value="0">
                            </div>
                        </div>  
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label for="mantenimiento">
                                        <input type="checkbox" id="interes-pagar" name="data[Interes][pagar]" onclick="calcula_total();"> Pagar Intereses
                                    </label>
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label for="mantenimiento">
                                        <input type="checkbox" id="interes-retencion" name="data[Interes][retencion]" onclick="calc_ret_int();"> RETENCION
                                    </label>
                                </div>  
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END Input Grid Block -->
            </div> 
            <?php if (!empty($conceptos[13])): ?>
              <div class="col-md-12">
                  <!-- Input Grid Block -->
                  <div class="block">
                      <!-- Input Grid Title -->            
                      <div class="block-title">
                          <div class="block-options pull-right">
                              <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-content" onclick="ocultaf(2)"><i class="fa fa-arrows-v"></i></a>                            
                          </div>                
                          <h2>Pago por Ascensor y Traslados</h2> <label class="text-info">Monto: <?php echo $conceptos[13] ?></label>
                      </div>
                      <div id="form-2" style="display: none;">
                          <div class="form-group">                    
                              <div class="col-md-3">
                                  <label for="monto-pe">Monto</label>
                                  <input type="number" step="any" class="form-control" id="monto-pe-ascensor" name="data[Ascensor][monto]" placeholder="Introdusca el monto" onkeyup="calcula_total();">
                              </div>
                              <div class="col-md-2">
                                  <label for="crt2">Reten.</label>
                                  <input type="text" class="form-control" disabled="true" id="retencion-pe-ascensor" name="data[Ascensor][cuotas]" placeholder="0" onkeyup="calcula_monto();" value="0">
                              </div>
                              <div class="col-md-7">
                                  <label for="crt2">Observacion</label>
                                  <input type="text" class="form-control" id="observacion-pe-ascensor" name="data[Ascensor][onservacion]" placeholder="Ingrese una observacion">
                              </div>
                          </div>  
                          <div class="form-group">
                              <div class="col-md-6">
                                  <div class="checkbox">
                                      <label for="mantenimiento">
                                          <input type="checkbox" id="ascensor-pagar" name="data[Ascensor][pagar]" onclick="calcula_total();"> Pagar Ascensor
                                      </label>
                                  </div> 
                              </div>
                              <div class="col-md-6">
                                  <div class="checkbox">
                                      <label for="mantenimiento">
                                          <input type="checkbox" id="ascensor-retencion" name="data[Ascensor][retencion]"> RETENCION
                                      </label>
                                  </div> 
                              </div>
                          </div>

                      </div>
                  </div>
                  <!-- END Input Grid Block -->
              </div>
            <?php endif; ?>
            <?php if (!empty($conceptos[14])): ?>
              <div class="col-md-12">
                  <!-- Input Grid Block -->
                  <div class="block">
                      <!-- Input Grid Title -->            
                      <div class="block-title">
                          <div class="block-options pull-right">
                              <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-content" onclick="ocultaf(3)"><i class="fa fa-arrows-v"></i></a>                            
                          </div>                
                          <h2>Multas Inasistencias Asamblea</h2>
                      </div>
                      <div id="form-3" style="display: none;">
                          <div class="form-group">                    
                              <div class="col-md-3">
                                  <label for="monto-pe">Monto</label>
                                  <input type="number" step="any" class="form-control" id="monto-pe-multas" name="data[Multas][monto]" placeholder="Introdusca el monto" onkeyup="calcula_total();">
                              </div>
                              <div class="col-md-2">
                                  <label for="crt2">Reten.</label>
                                  <input type="text" class="form-control" disabled="true" id="retencion-pe-multas" name="data[Multas][cuotas]" placeholder="0" onkeyup="calcula_monto();" value="0">
                              </div>
                              <div class="col-md-7">
                                  <label for="crt2">Observacion</label>
                                  <input type="text" class="form-control" id="observacion-pe-multas" name="data[Multas][onservacion]" placeholder="Ingrese una observacion">
                              </div>
                          </div>  
                          <div class="form-group">
                              <div class="col-md-6">
                                  <div class="checkbox">
                                      <label for="mantenimiento">
                                          <input type="checkbox" id="multas-pagar" name="data[Multas][pagar]" onclick="calcula_total();"> Pagar Multas
                                      </label>
                                  </div> 
                              </div>
                              <div class="col-md-6">
                                  <div class="checkbox">
                                      <label for="mantenimiento">
                                          <input type="checkbox" id="multas-retencion" name="data[Multas][retencion]"> RETENCION
                                      </label>
                                  </div> 
                              </div>
                          </div>

                      </div>
                  </div>
                  <!-- END Input Grid Block -->
              </div>
            <?php endif; ?>
            <?php if (!empty($conceptos[15])): ?>
              <div class="col-md-12">
                  <!-- Input Grid Block -->
                  <div class="block">
                      <!-- Input Grid Title -->            
                      <div class="block-title">
                          <div class="block-options pull-right">
                              <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-content" onclick="ocultaf(4)"><i class="fa fa-arrows-v"></i></a>                            
                          </div>                
                          <h2>Otros</h2>
                      </div>

                      <div id="form-4" style="display: none;">
                          <div class="form-group">                    
                              <div class="col-md-3">
                                  <label for="monto-pe">Monto</label>
                                  <input type="number" step="any" class="form-control" id="monto-pe-otros" name="data[Otros][monto]" placeholder="Introdusca el monto" onkeyup="calcula_total();">
                              </div>
                              <div class="col-md-2">
                                  <label for="crt2">Reten.</label>
                                  <input type="text" class="form-control" disabled="true" id="retencion-pe-otros" name="data[Otros][cuotas]" placeholder="0" onkeyup="calcula_monto();" value="0">
                              </div>
                              <div class="col-md-7">
                                  <label for="crt2">Observacion</label>
                                  <input type="text" class="form-control" id="observacion-pe-otros" name="data[Otros][onservacion]" placeholder="Ingrese una observacion">
                              </div>
                          </div>  
                          <div class="form-group">
                              <div class="col-md-6">
                                  <div class="checkbox">
                                      <label for="mantenimiento">
                                          <input type="checkbox" id="otros-pagar" name="data[Otros][pagar]" onclick="calcula_total();"> Pagar Otros
                                      </label>
                                  </div> 
                              </div>
                              <div class="col-md-6">
                                  <div class="checkbox">
                                      <label for="mantenimiento">
                                          <input type="checkbox" id="otros-retencion" name="data[Otros][retencion]"> RETENCION
                                      </label>
                                  </div>
                              </div>
                          </div>

                      </div>
                  </div>
                  <!-- END Input Grid Block -->
              </div> 
            <?php endif; ?>
            <div class="col-md-12">
                <!-- Input Grid Block -->
                <div class="block">
                    <!-- Input Grid Title -->            
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="text-success">Total: <span id="idtotal">0.00</span></h4>
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-info">Cambio T.: <span id="id_cambio_total">0.00</span></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-block btn-primary" type="submit">Pagar</button>
                <!--<a href="<?php echo $this->Html->url(array('action' => 'listadopago')); ?>" type="submit" class="btn btn-block btn-primary">Pagar</a>-->
            </div>
        </div>
    </div>

</div>

<script>
  var retencion = 0.00;
<?php if (!empty($this->Session->read('Auth.User.Edificio.retencion'))): ?>
    retencion = <?php echo $this->Session->read('Auth.User.Edificio.retencion') ?> / 100;
<?php endif; ?>
  function calcula_cuotas() {
      $('#cantidad-pe-mantenimiento').val(parseInt($('#monto-pe-mantenimiento').val() / $('#idrefer_mantenimiento').val()));
      var cambio = $('#monto-pe-mantenimiento').val() - ($('#cantidad-pe-mantenimiento').val() * $('#idrefer_mantenimiento').val());
      $('#cambio-pe-mantenimiento').val(Math.round(cambio * 100) / 100);
      calc_ret_man();
      calcula_total();
  }
  function calc_ret_man() {
      if ($('#mantenimiento-retencion').prop('checked')) {
          var cambio = $('#monto-pe-mantenimiento').val() - ($('#cantidad-pe-mantenimiento').val() * $('#idrefer_mantenimiento').val());
          $('#cambio-pe-mantenimiento').val(Math.round(cambio * 100) / 100);
          $('#retencion-pe-mantenimiento').val(Math.round((($('#cantidad-pe-mantenimiento').val() * $('#idrefer_mantenimiento').val()) * retencion) * 100) / 100);
          cambio = parseFloat($('#cambio-pe-mantenimiento').val()) - parseFloat($('#retencion-pe-mantenimiento').val());
          if (cambio < 0) {
              var monto = parseFloat($('#monto-pe-mantenimiento').val()) + (cambio) * (-1);
              $('#monto-pe-mantenimiento').val(Math.round(monto * 100) / 100);
          } else {
              $('#cambio-pe-mantenimiento').val(Math.round(cambio * 100) / 100);
          }
      } else {
          $('#retencion-pe-mantenimiento').val(0);
          var cambio = $('#monto-pe-mantenimiento').val() - ($('#cantidad-pe-mantenimiento').val() * $('#idrefer_mantenimiento').val());
          $('#cambio-pe-mantenimiento').val(Math.round(cambio * 100) / 100);
      }
      calcula_total();
  }

  function calcula_monto() {
      $('#monto-pe-mantenimiento').val($('#cantidad-pe-mantenimiento').val() * $('#idrefer_mantenimiento').val());
      $('#cambio-pe-mantenimiento').val(0);
      calc_ret_man();
      calcula_total();
  }

  function calcula_cuotas_alqui() {

      $('#cantidad-pe-alquiler').val(parseInt($('#monto-pe-alquiler').val() / $('#idrefer_alquiler').val()));
      var cambio = $('#monto-pe-alquiler').val() - ($('#cantidad-pe-alquiler').val() * $('#idrefer_alquiler').val());
      $('#cambio-pe-alquiler').val(Math.round(cambio * 100) / 100);
      calc_ret_alq();
      calcula_total();
  }

  function calc_ret_alq() {
      if ($('#alquiler-retencion').prop('checked')) {
          var cambio = $('#monto-pe-alquiler').val() - ($('#cantidad-pe-alquiler').val() * $('#idrefer_alquiler').val());
          $('#cambio-pe-alquiler').val(Math.round(cambio * 100) / 100);
          $('#retencion-pe-alquiler').val(Math.round((($('#cantidad-pe-alquiler').val() * $('#idrefer_alquiler').val()) * retencion) * 100) / 100);
          cambio = parseFloat($('#cambio-pe-alquiler').val()) - parseFloat($('#retencion-pe-alquiler').val());
          if (cambio < 0) {
              var monto = parseFloat($('#monto-pe-alquiler').val()) + (cambio) * (-1);
              $('#monto-pe-alquiler').val(Math.round(monto * 100) / 100);
          } else {
              $('#cambio-pe-alquiler').val(Math.round(cambio * 100) / 100);
          }
      } else {
          $('#retencion-pe-alquiler').val(0);
          var cambio = $('#monto-pe-alquiler').val() - ($('#cantidad-pe-alquiler').val() * $('#idrefer_alquiler').val());
          $('#cambio-pe-alquiler').val(Math.round(cambio * 100) / 100);
      }
      calcula_total();
  }

  function calcula_monto_alqui() {
      $('#monto-pe-alquiler').val($('#cantidad-pe-alquiler').val() * $('#idrefer_alquiler').val());
      $('#cambio-pe-alquiler').val(0);
      calc_ret_alq();
      calcula_total();
  }
  
  function calc_ret_int() {
      if ($('#alquiler-retencion').prop('checked')) {
          var cambio = $('#monto-pe-alquiler').val() - ($('#cantidad-pe-alquiler').val() * $('#idrefer_alquiler').val());
          $('#cambio-pe-alquiler').val(Math.round(cambio * 100) / 100);
          $('#retencion-pe-alquiler').val(Math.round((($('#cantidad-pe-alquiler').val() * $('#idrefer_interes').val()) * retencion) * 100) / 100);
          cambio = parseFloat($('#cambio-pe-alquiler').val()) - parseFloat($('#retencion-pe-alquiler').val());
          if (cambio < 0) {
              var monto = parseFloat($('#monto-pe-alquiler').val()) + (cambio) * (-1);
              $('#monto-pe-alquiler').val(Math.round(monto * 100) / 100);
          } else {
              $('#cambio-pe-alquiler').val(Math.round(cambio * 100) / 100);
          }
      } else {
          $('#retencion-pe-alquiler').val(0);
          var cambio = $('#monto-pe-alquiler').val() - ($('#cantidad-pe-alquiler').val() * $('#idrefer_alquiler').val());
          $('#cambio-pe-alquiler').val(Math.round(cambio * 100) / 100);
      }
      calcula_total();
  }

  function calcula_total() {
      var suma_total = 0.00;
      var sum_cam_tot = 0.00;
      if ($('#mantenimiento-pagar').prop('checked')) {
          if ($('#monto-pe-mantenimiento').val() != null && $('#monto-pe-mantenimiento').val() != '') {
              suma_total = suma_total + parseFloat($('#cantidad-pe-mantenimiento').val() * $('#idrefer_mantenimiento').val());
          }
          if ($('#mantenimiento-retencion').prop('checked')) {
              suma_total = suma_total + parseFloat($('#retencion-pe-mantenimiento').val());
          }
          if ($('#cambio-pe-mantenimiento').val() != null && $('#cambio-pe-mantenimiento').val() != '') {
              sum_cam_tot = sum_cam_tot + parseFloat($('#cambio-pe-mantenimiento').val());
          }
      }

      if ($('#alquiler-pagar').prop('checked')) {
          if ($('#monto-pe-alquiler').val() != null && $('#monto-pe-alquiler').val() != '') {
              suma_total = suma_total + parseFloat($('#cantidad-pe-alquiler').val() * $('#idrefer_alquiler').val());
          }
          if ($('#alquiler-retencion').prop('checked')) {
              suma_total = suma_total + parseFloat($('#retencion-pe-alquiler').val());
          }
          if ($('#cambio-pe-alquiler').val() != null && $('#cambio-pe-alquiler').val() != '') {
              sum_cam_tot = sum_cam_tot + parseFloat($('#cambio-pe-alquiler').val());
          }
      }
      if ($('#interes-pagar').prop('checked')) {
          if ($('#monto-pe-interes').val() != null && $('#monto-pe-interes').val() != '') {
              suma_total = suma_total + parseFloat($('#monto-pe-interes').val());
          }
      }
      if ($('#ascensor-pagar').prop('checked')) {
          if ($('#monto-pe-ascensor').val() != null && $('#monto-pe-ascensor').val() != '') {
              suma_total = suma_total + parseFloat($('#monto-pe-ascensor').val());
          }
      }
      if ($('#multas-pagar').prop('checked')) {
          if ($('#monto-pe-multas').val() != null && $('#monto-pe-multas').val() != '') {
              suma_total = suma_total + parseFloat($('#monto-pe-multas').val());
          }
      }
      if ($('#otros-pagar').prop('checked')) {
          if ($('#monto-pe-otros').val() != null && $('#monto-pe-otros').val() != '') {
              suma_total = suma_total + parseFloat($('#monto-pe-otros').val());
          }
      }
      sum_cam_tot = Math.round(sum_cam_tot * 100) / 100;
      suma_total = Math.round(suma_total * 100) / 100;
      $('#idtotal').html(suma_total);
      $('#id_cambio_total').html(sum_cam_tot);
      $('#id_dat_cambio').val(sum_cam_tot);
  }

  function ocultapagos() {
      console.log('Hizo click');
      $('#muestra-pagos').toggle('slow');
  }
  function oculta(numero) {
      console.log('este es el numero ' + numero);
      $('.block-content-' + numero).toggle('slow');
  }

  function ocultaf(numero) {
      console.log('este es el numero ' + numero);
      $('#form-' + numero).toggle('slow');
  }
</script>

<script>
  $("#cantidad-pc").keyup(function () {
      cantidadPc = $(this).val();
      montoPc = cantidadPc * mA;
      $('#monto-pc').val(montoPc);
      //console.log( mA + "======" + montoPe + "========" + cantidadCuota );
  });
</script>