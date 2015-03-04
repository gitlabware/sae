<!-- Blank Header -->
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-brush"></i>Buscador de Ambientes<br>
        </h1>
    </div>
</div>

<!-- END Blank Header -->
<!-- Example Block -->

<!-- END Example Title -->
<div class="col-sm-4">
    <!-- Input Groups - Dropdowns Block -->
    <div class="block">
        <!-- Input Groups - Dropdowns Title -->
        <div class="block-title">
            <h2><strong>Dropdowns</strong> Groups</h2>
        </div>
        <!-- END Input Groups - Dropdowns Title -->

        <!-- Input Groups - Dropdowns Content -->

        <?php echo $this->Form->create('Ambiente', array('action' => 'ajaxresultados', 'class' => 'form-horizontal form-bordered', 'id' => 'crtform')); ?>  
        <div class="form-group">
            <div class="col-md-7">
                <input type="text" class="form-control" required="">
            </div>
            <div class="col-md-5">
                <select id="example-select" name="tipo" class="form-control" size="1">
                    <option value="0">Seleccione</option>
                    <option value="1">Ambiente</option>
                    <option value="2">Inquilino</option>
                    <option value="3">Propietario</option>
                </select>
            </div>
        </div>            

        <div class="form-group form-actions">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Buscar </button>
            </div>
        </div>
        </form>
        <!-- END Input Groups - Dropdowns Content -->
    </div>
    <!-- END Input Groups - Dropdowns Block -->
</div>

<div class="col-sm-8">
    <!-- Input Groups - Dropdowns Block -->
    <div class="block">
        <!-- Input Groups - Dropdowns Title -->
        <div class="block-title">
            <h2><strong>Dropdowns</strong> Groups</h2>
        </div>
        <!-- END Input Groups - Dropdowns Title -->
        <div id="ajax_loader">Aqui</div>  

    </div>
    <!-- END Input Groups - Dropdowns Block -->
</div>

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