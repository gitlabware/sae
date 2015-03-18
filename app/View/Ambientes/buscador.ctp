<!-- Example Block -->
<div class="row">

    <!-- Interactive Block -->
    <div class="block">
        <!-- Interactive Title -->
        <div class="block-title">
            <!-- Interactive block controls (initialized in js/app.js -> interactiveBlocks()) -->
            <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-content"><i class="fa fa-arrows-v"></i></a>
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-toggle-fullscreen"><i class="fa fa-desktop"></i></a>
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-primary" data-toggle="block-hide"><i class="fa fa-times"></i></a>
            </div>
            <h2><strong>Formularios de</strong> Busqueda</h2>
        </div>
        <!-- END Interactive Title -->

        <!-- Interactive Content -->
        <!-- The content you will put inside div.block-content, will be toggled -->
        <div class="block-content">
            <div class="col-sm-4">
                <div class="block">
                    <div class="block-title"><h4>Por Ambiente</h4></div>
                    <?php echo $this->Form->create('Ambiente', array('action' => 'ajaxresultados', 'class' => 'form-horizontal form-bordered', 'id' => 'crtform')); ?>  
                    <div class="form-group">
                        <div class="col-md-12">   
                            <div class="input-group">
                                <input type="text" id="example-input2-group2" name="data[Ambiente][criterio]" class="form-control" placeholder="Ingrese el Ambiente">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </span>
                            </div>
                            <?php //echo $this->Form->text('criterio', array('class' => 'form-control', 'required')) ?>
                            <?php echo $this->Form->hidden('opcion', array('value' => '1')); ?>
                        </div>                        
                    </div>            


                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="block">
                    <div class="block-title"><h4>Por Propietario</h4></div>
                    <div class="form-group">
                        <div class="col-md-12">                
                            <?php echo $this->Form->text('criterio', array('class' => 'form-control', 'id' => 'txtpropietario', 'required')) ?>                            
                        </div>                        
                    </div>            
                    <div id="listadoPropietarios">
                        &nbsp;    
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="block">
                    <div class="block-title"><h4>Por Inquilino</h4></div>
                    <div class="form-group">
                        <div class="col-md-12">                
                            <?php echo $this->Form->text('criterio', array('class' => 'form-control', 'id' => 'txtpinquilino', 'required')) ?>                            
                        </div>                        
                    </div>            
                    <div id="listadoPropietarios">
                        &nbsp;    
                    </div>
                </div>
            </div>            
        </div>
        <p class="text-muted">You can also have content that ignores toggling..</p>
        <!-- END Interactive Content -->
    </div>
    <!-- END Interactive Block -->
</div>

<div class="row">   
    <div class="col-sm-12">
        <!-- Input Groups - Dropdowns Block -->
        <div class="block">
            <!-- Input Groups - Dropdowns Title -->
            <div class="block-title">
                <h2><strong>Resultados</strong> </h2>
            </div>
            <!-- END Input Groups - Dropdowns Title -->
            <div id="ajax_loader">
                Seleccione un criterio de busqueda
                <p>&nbsp;</p>
            </div>  

        </div>
        <!-- END Input Groups - Dropdowns Block -->
    </div>
</div>

<script type="text/javascript">
//<![CDATA[
  $("#txtpropietario").bind("keyup", function (event) {
      $.ajax({
          async: true,
          data: $("#txtpropietario").serialize(),
          dataType: "html",
          success: function (data, textStatus) {
              $("#listadoPropietarios").html(data);
          }, type: "post", url: "<?php echo $this->Html->url(array('action' => 'ajaxbuscapropietario')); ?>"});
      return false;
  });
//]]>
</script>

<script>
  $('#crtform').submit(function () { //en el evento submit del fomulario

      event.preventDefault();  //detenemos el comportamiento por default
      //alert('hola');
      var url = $(this).attr('action');  //la url del action del formulario
      var datos = $(this).serialize(); // los datos del formulario
      $.ajax({
          type: 'POST',
          url: url,
          data: datos,
          //beforeSend: mostrarLoader, //funciones que definimos más abajo
          success: mostrarRespuesta  //funciones que definimos más abajo
      });

  });

  function mostrarLoader() {
      $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
  }
  ;

  function mostrarRespuesta(responseText) {
      $('#ajax_loader').html(responseText);
      //alert("Mensaje enviado: " + responseText);  //responseText es lo que devuelve la página contacto.php. Si en contacto.php hacemos echo "Hola" , la variable responseText = "Hola" . Aca hago un alert con el valor de response text
      //$("#loader_gif").fadeOut("slow"); // Hago desaparecer el loader de ajax
      //$("#ajax_loader").append("<br>Mensaje: " + responseText); // Aca utilizo la función append de JQuery para añadir el responseText  dentro del div "ajax_loader"
  }
  ;
</script>