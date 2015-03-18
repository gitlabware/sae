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
                </div>
                <!-- END Widget Main -->
            </div>
        </div>
        <!-- END Advanced Active Theme Color Widget Alternative -->        
    </div>

    <div class="col-md-8">

        <div class="row">

            <div class="col-md-12">
                <!-- Input Grid Block -->
                <div class="block">
                    <!-- Input Grid Title -->            
                    <div class="block-title">  
                        <div class="block-options pull-right">
                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-content1" onclick="oculta(1)"><i class="fa fa-arrows-v"></i></a>                            
                        </div>
                        <h2>Pago por Mantenimiento</h2>
                    </div>
                    <!-- END Input Grid Title -->
                    <!-- Block Tabs Title -->
                    <div class="block-content-1" style="display: none;">
                        <div class="block-title">                
                            <ul class="nav nav-tabs" data-toggle="tabs">
                                <li class="active"><a href="#11">Monto Efectivo</a></li>
                                <li class=""><a href="#12">Cantidad Cuotas</a></li>                    
                            </ul>
                        </div>
                        <!-- END Block Tabs Title -->
                        <!-- Tabs Content -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="11">
                                <?php echo $this->Form->create('Ambiente', array('action' => 'ajaxresultados', 'class' => 'form-horizontal form-bordered', 'id' => 'crtform')); ?>  
                                <div class="form-group">                    
                                    <div class="col-md-4">
                                        <label for="monto-pe">Monto</label>
                                        <input type="number" class="form-control" id="monto-pe" name="monto-pe" placeholder="Introdusca el monto">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="crt2">Cantidad Cuotas</label>
                                        <input type="text" class="form-control" id="cantidad-pe" placeholder="0">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="crt2">Cambio</label>
                                        <input type="text" class="form-control" id="cambio-pe" placeholder="0">
                                    </div>
                                </div>          

                                </form>
                            </div>
                            <div class="tab-pane" id="12">
                                <?php echo $this->Form->create('Ambiente', array('action' => 'ajaxresultados', 'class' => 'form-horizontal form-bordered', 'id' => 'crtform')); ?>  
                                <div class="form-group">                                            

                                    <div class="col-md-4">
                                        <label for="crt2">Cantidad Cuotas</label>
                                        <input type="text" class="form-control" id="cantidad-pc" placeholder="Ingrese la cantidad">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="crt2">Monto</label>
                                        <input type="text" class="form-control" id="monto-pc" placeholder="0">
                                    </div>
                                </div>           

                                </form>
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

            <div class="col-md-12">
                <!-- Input Grid Block -->
                <div class="block">
                    <!-- Input Grid Title -->            
                    <div class="block-title">
                        <div class="block-options pull-right">
                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-content" onclick="oculta(2)"><i class="fa fa-arrows-v"></i></a>                            
                        </div>
                        <h2>Pago por Alquileres</h2>
                    </div>
                    <!-- END Input Grid Title -->
                    <!-- Block Tabs Title -->
                    <div class="block-content-2" style="display: none;">
                        <div class="block-title">                
                            <ul class="nav nav-tabs" data-toggle="tabs">
                                <li class="active"><a href="#21">Monto Efectivo</a></li>
                                <li class=""><a href="#22">Cantidad Cuotas</a></li>                    
                            </ul>
                        </div>
                        <!-- END Block Tabs Title -->
                        <!-- Tabs Content -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="21">
                                <?php echo $this->Form->create('Ambiente', array('action' => 'ajaxresultados', 'class' => 'form-horizontal form-bordered', 'id' => 'crtform')); ?>  
                                <div class="form-group">                    
                                    <div class="col-md-4">
                                        <label for="monto-pe">Monto</label>
                                        <input type="number" class="form-control" id="monto-pe" name="monto-pe" placeholder="Introdusca el monto">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="crt2">Cantidad Cuotas</label>
                                        <input type="text" class="form-control" id="cantidad-pe" placeholder="0">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="crt2">Cambio</label>
                                        <input type="text" class="form-control" id="cambio-pe" placeholder="0">
                                    </div>
                                </div>          

                                </form>
                            </div>
                            <div class="tab-pane" id="22">
                                <?php echo $this->Form->create('Ambiente', array('action' => 'ajaxresultados', 'class' => 'form-horizontal form-bordered', 'id' => 'crtform')); ?>  
                                <div class="form-group">                                            

                                    <div class="col-md-4">
                                        <label for="crt2">Cantidad Cuotas</label>
                                        <input type="text" class="form-control" id="cantidad-pc" placeholder="Ingrese la cantidad">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="crt2">Monto</label>
                                        <input type="text" class="form-control" id="monto-pc" placeholder="0">
                                    </div>
                                </div>           


                                </form>
                            </div>                
                        </div>

                        <div class="checkbox">
                            <label for="alquiler">
                                <input type="checkbox" id="alquiler" name="alquiler" value="option1"> Pagar Alquiler
                            </label>
                        </div>     
                        <!-- END Tabs Content -->
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
                <a href="<?php echo $this->Html->url(array('action'=>'listadopago')); ?>" type="submit" class="btn btn-block btn-primary">Pagar</a>
            </div>
        </div>
    </div>

</div>

<script>
  var montoPe;
  var mA = $('#manteminientoAmbiente').text();
  var cantidadCuota = 0;
  var cambioPe = 0;
  var aux;
  $("#monto-pe").keyup(function () {
      montoPe = $(this).val();
      cantidadCuota = Math.round(montoPe / mA);
      aux = cantidadCuota * mA;
      cambioPe = Math.abs(aux - montoPe);
      $('#cantidad-pe').val(cantidadCuota);
      $('#cambio-pe').val(cambioPe);
      //console.log( mA + "======" + montoPe + "========" + cantidadCuota );
  });

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