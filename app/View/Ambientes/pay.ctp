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
                            <span class="pull-right"><strong id="manteminientoAmbiente"><?php echo $datosAmbiente['Ambiente']['mantenimiento']; ?></strong></span>
                            <h4 class="list-group-item-heading remove-margin"><i class="fa fa-money fa-fw"></i> Mantenimiento</h4>
                        </a>
                        <a href="javascript:void(0)" class="list-group-item">
                            <span class="pull-right">
                                <strong>
                                    <?php if (!empty($ultimoPago)): ?>
                                      <?php
                                      echo $ultimoPago['Pago']['created'];
                                      ?>
                                    <?php else: ?>
                                      N/T
                                    <?php endif; ?>
                                </strong>
                            </span>
                            <h4 class="list-group-item-heading remove-margin"><i class="fa fa-money fa-fw"></i> Ultimo Pago</h4>
                            <p class="list-group-item-text"></p>
                        </a>

                        <!-- pagos -->
                        <a href="javascript:void(0)" class="list-group-item">
                            <span class="pull-right"><strong id="manteminientoAmbiente"></strong></span>
                            <h4 class="list-group-item-heading remove-margin" onclick="ocultapagos();"> <b>Ultimos Pagos</b></h4>
                        </a>

                        <div id="muestra-pagos" style="display: block;">
                            <a href="javascript:void(0)" class="list-group-item">
                                <span class="pull-right"><strong id="manteminientoAmbiente">234</strong></span>
                                <h4 class="list-group-item-heading remove-margin"><i class="fa fa-money fa-fw"></i> 2014-10-12</h4>
                            </a>
                            <a href="javascript:void(0)" class="list-group-item">
                                <span class="pull-right"><strong id="manteminientoAmbiente">245</strong></span>
                                <h4 class="list-group-item-heading remove-margin"><i class="fa fa-money fa-fw"></i> 2014-09-08</h4>
                            </a>
                            <a href="javascript:void(0)" class="list-group-item">
                                <span class="pull-right"><strong id="manteminientoAmbiente">234</strong></span>
                                <h4 class="list-group-item-heading remove-margin"><i class="fa fa-money fa-fw"></i> 2014-08-10</h4>
                            </a>
                            <a href="javascript:void(0)" class="list-group-item">
                                <span class="pull-right"><strong id="manteminientoAmbiente">254</strong></span>
                                <h4 class="list-group-item-heading remove-margin"><i class="fa fa-money fa-fw"></i> 2014-07-09</h4>
                            </a>
                        </div>    
                        <!-- fin pagos -->
                    </div>
                    <br>
                    <div class="form-horizontal form-bordered">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Inquilino: </label>
                            <div class="col-md-9">
                                <?php echo $this->Form->select('Inquilino.id', $inquilinos, array('class' => 'form-control')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Widget Main -->
            </div>
        </div>
        <!-- END Advanced Active Theme Color Widget Alternative -->        
    </div>
    
    <div class="col-md-8">

        <div class="row">
            <?php echo $this->Form->create('Ambiente', array('action' => 'registra_pagos', 'class' => 'form-horizontal form-bordered')); ?>  
            <?php if (!empty($conceptos[10])): ?>
              <div class="col-md-12">
                  <!-- Input Grid Block -->
                  <div class="block">
                      <!-- Input Grid Title -->            
                      <div class="block-title">  
                          <div class="block-options pull-right">
                              <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-content1" onclick="oculta(1)"><i class="fa fa-arrows-v"></i></a>                            
                          </div>
                          <h2>Pago por Mantenimiento</h2> <label class="text-info">Monto mensual: <?php echo $conceptos[10] ?></label>
                      </div>
                      <!-- END Input Grid Title -->
                      <!-- Block Tabs Title -->
                      <div class="block-content-1" style="display: none;">
                          <div class="block-title">                
                              <ul class="nav nav-tabs" data-toggle="tabs">
                                  <li class="active"><a href="#11">Monto Efectivo</a></li>                    
                              </ul>
                          </div>
                          <!-- END Block Tabs Title -->
                          <!-- Tabs Content -->
                          <div class="tab-content">
                              <div class="tab-pane active" id="11">
                                  <?php //echo $this->Form->create('Ambiente', array('action' => 'ajaxresultados', 'class' => 'form-horizontal form-bordered', 'id' => 'crtform')); ?>  
                                  <?php echo $this->Form->hidden('Pago.referencia_mantenimiento', array('value' => $conceptos[10], 'id' => 'idrefer_mantenimiento')); ?>
                                  <div class="form-group">                    
                                      <div class="col-md-4">
                                          <label for="monto-pe">Monto</label>
                                          <input type="number" class="form-control" id="monto-pe-mantenimiento" name="data[Pago][]" placeholder="Introdusca el monto" onkeyup="calcula_cuotas();">
                                      </div>
                                      <div class="col-md-4">
                                          <label for="crt2">Cantidad Cuotas</label>
                                          <input type="text" class="form-control" id="cantidad-pe-mantenimiento" placeholder="0" onkeyup="calcula_monto();">
                                      </div>
                                      <div class="col-md-4">
                                          <label for="crt2">Cambio</label>
                                          <input type="text" class="form-control" id="cambio-pe-mantenimiento" placeholder="0">
                                      </div>
                                  </div>
                              </div>               
                          </div>
                          <div class="checkbox">
                              <label for="mantenimiento">
                                  <input type="checkbox" id="mantenimiento" name="mantenimiento" value="option1"> Pagar Mantenimiento
                              </label>
                          </div>                
                          <!-- END Tabs Content -->
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
                          <h2>Pago por Alquileres</h2> <label class="text-info">Monto mensual: <?php echo $conceptos[10] ?></label>
                      </div>
                      <!-- END Input Grid Title -->
                      <!-- Block Tabs Title -->
                      <div class="block-content-2" style="display: none;">
                          <div class="block-title">                
                              <ul class="nav nav-tabs" data-toggle="tabs">
                                  <li class="active"><a href="#21">Monto Efectivo</a></li>                    
                              </ul>
                          </div>
                          <!-- END Block Tabs Title -->
                          <!-- Tabs Content -->
                          <div class="tab-content">
                              <div class="tab-pane active" id="21">
                                  
                                  <?php echo $this->Form->hidden('Pago.referencia_mantenimiento', array('value' => $conceptos[11], 'id' => 'idrefer_alquiler')); ?>
                                  <div class="form-group">                    
                                      <div class="col-md-4">
                                          <label for="monto-pe">Monto</label>
                                          <input type="number" class="form-control" id="monto-pe-alquiler" name="monto-pe-alquiler" placeholder="Introdusca el monto" onkeyup="calcula_cuotas_alqui();">
                                      </div>
                                      <div class="col-md-4">
                                          <label for="crt2">Cantidad Cuotas</label>
                                          <input type="text" class="form-control" id="cantidad-pe-alquiler" placeholder="0" onkeyup="calcula_monto_alqui();">
                                      </div>
                                      <div class="col-md-4">
                                          <label for="crt2">Cambio</label>
                                          <input type="text" class="form-control" id="cambio-pe-alquiler" placeholder="0">
                                      </div>
                                  </div>
                              </div>               
                          </div>
                          <div class="checkbox">
                              <label for="mantenimiento">
                                  <input type="checkbox" id="mantenimiento" name="mantenimiento" value="option1"> Pagar Mantenimiento
                              </label>
                          </div>                
                          <!-- END Tabs Content -->
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
                                <input type="number" class="form-control" id="monto-pe" name="monto-pe" placeholder="Introdusca el monto">
                            </div>

                            <div class="col-md-6">
                                <label for="crt2">Cambio</label>
                                <input type="text" class="form-control" id="cambio-pe" placeholder="0">
                            </div>
                        </div>  
                        <p>&nbsp;</p>
                        <div class="checkbox">
                            <label for="mantenimiento">
                                <input type="checkbox" id="mantenimiento" name="mantenimiento" value="option1"> Pagar Intereses
                            </label>
                        </div>  
                    </div>
                </div>
                <!-- END Input Grid Block -->
            </div> 

            <div class="col-md-12">
                <!-- Input Grid Block -->
                <div class="block">
                    <!-- Input Grid Title -->            
                    <div class="block-title">
                        <div class="block-options pull-right">
                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-content" onclick="ocultaf(2)"><i class="fa fa-arrows-v"></i></a>                            
                        </div>                
                        <h2>Pago por Ascensor y Traslados</h2>
                    </div>
                    <div id="form-2" style="display: none;">
                        <div class="form-group">                    
                            <div class="col-md-6">
                                <label for="monto-pe">Monto</label>
                                <input type="number" class="form-control" id="monto-pe" name="monto-pe" placeholder="Introdusca el monto">
                            </div>

                            <div class="col-md-6">
                                <label for="crt2">Cambio</label>
                                <input type="text" class="form-control" id="cambio-pe" placeholder="0">
                            </div>
                        </div>  

                        <p>&nbsp;</p>
                        <div class="checkbox">
                            <label for="mantenimiento">
                                <input type="checkbox" id="mantenimiento" name="mantenimiento" value="option1"> Pagar Intereses
                            </label>
                        </div> 
                    </div>
                </div>
                <!-- END Input Grid Block -->
            </div>

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
                            <div class="col-md-6">
                                <label for="monto-pe">Monto</label>
                                <input type="number" class="form-control" id="monto-pe" name="monto-pe" placeholder="Introdusca el monto">
                            </div>

                            <div class="col-md-6">
                                <label for="crt2">Cambio</label>
                                <input type="text" class="form-control" id="cambio-pe" placeholder="0">
                            </div>
                        </div>  

                        <p>&nbsp;</p>
                        <div class="checkbox">
                            <label for="mantenimiento">
                                <input type="checkbox" id="mantenimiento" name="mantenimiento" value="option1"> Pagar Intereses
                            </label>
                        </div> 
                    </div>
                </div>
                <!-- END Input Grid Block -->
            </div> 

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
                            <div class="col-md-6">
                                <label for="monto-pe">Monto</label>
                                <input type="number" class="form-control" id="monto-pe" name="monto-pe" placeholder="Introdusca el monto">
                            </div>

                            <div class="col-md-6">
                                <label for="crt2">Cambio</label>
                                <input type="text" class="form-control" id="cambio-pe" placeholder="0">
                            </div>
                        </div>  

                        <p>&nbsp;</p>
                        <div class="checkbox">
                            <label for="mantenimiento">
                                <input type="checkbox" id="mantenimiento" name="mantenimiento" value="option1"> Pagar Intereses
                            </label>
                        </div> 
                    </div>
                </div>
                <!-- END Input Grid Block -->
            </div> 

            <div class="col-md-12">
                <a href="<?php echo $this->Html->url(array('action' => 'listadopago')); ?>" type="submit" class="btn btn-block btn-primary">Pagar</a>
            </div>
        </div>
    </div>

</div>

<script>

  function calcula_cuotas() {

      $('#cantidad-pe-mantenimiento').val(parseInt($('#monto-pe-mantenimiento').val() / $('#idrefer_mantenimiento').val()));
      var cambio = $('#monto-pe-mantenimiento').val() - ($('#cantidad-pe-mantenimiento').val() * $('#idrefer_mantenimiento').val());
      $('#cambio-pe-mantenimiento').val(cambio);
  }

  function calcula_monto() {
      $('#monto-pe-mantenimiento').val($('#cantidad-pe-mantenimiento').val() * $('#idrefer_mantenimiento').val());
      $('#cambio-pe-mantenimiento').val(0);
  }
  
  function calcula_cuotas_alqui() {

      $('#cantidad-pe-alquiler').val(parseInt($('#monto-pe-alquiler').val() / $('#idrefer_alquiler').val()));
      var cambio = $('#monto-pe-alquiler').val() - ($('#cantidad-pe-alquiler').val() * $('#idrefer_alquiler').val());
      $('#cambio-pe-alquiler').val(cambio);
  }

  function calcula_monto_alqui() {
      $('#monto-pe-alquiler').val($('#cantidad-pe-alquiler').val() * $('#idrefer_alquiler').val());
      $('#cambio-pe-alquiler').val(0);
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