<!-- Dashboard Header -->
<!-- For an image header add the class 'content-header-media' and an image as in the following example -->
<div class="content-header content-header-media">
    <div class="header-section">
        <div class="row">
            <!-- Main Title (hidden on small devices for the statistics to fit) -->
            <div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
                <h1>Bienvenido <strong><?php echo $this->Session->read('Auth.User.nombre'); ?></strong><br><small>Sistema de Administracion</small></h1>
            </div>
            <!-- END Main Title -->

            <!-- Top Stats -->
            <div class="col-md-8 col-lg-6">
                <div class="row text-center">
                    <h2 class="animation-hatch">
                        <strong>EDIFICIO <?php echo strtoupper($edificio['Edificio']['nombre']); ?></strong><br>

                    </h2>
                </div>
            </div>
            <!-- END Top Stats -->
        </div>
    </div>
    <!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
    <img src="<?php echo $this->webroot; ?>img/41236569.jpg" alt="header image" class="animation-pulseSlow">
</div>
<!-- END Dashboard Header -->

<div class="row">
    <div class="col-md-3">
        <a href="javascript:" class="widget widget-hover-effect1">
            <div class="widget-simple">
                <div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
                    <i class="fa fa-navicon"></i>
                </div>
                <h3 class="widget-content text-right animation-pullDown">
                    <?php echo $nro_pisos;?> <strong>Pisos</strong><br>
                </h3>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="<?php echo $this->Html->url(array('controller' => 'Ambientes', 'action' => 'edificio',$this->Session->read('Auth.User.edificio_id')));?>" class="widget widget-hover-effect1">
            <div class="widget-simple">
                <div class="widget-icon pull-left themed-background-amethyst animation-fadeIn">
                    <i class="gi gi-tags"></i>
                </div>
                <h3 class="widget-content text-right animation-pullDown">
                    <?php echo $nro_ambientes;?> <strong>Ambientes</strong>
                    <small>Total</small>
                </h3>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Edificios','action' => 'usuarios', $this->Session->read('Auth.User.edificio_id'))); ?>');" class="widget widget-hover-effect1">
            <div class="widget-simple">
                <div class="widget-icon pull-left themed-background-fire animation-fadeIn">
                    <i class="fa fa-users"></i>
                </div>
                <h3 class="widget-content text-right animation-pullDown">
                    5 <strong>Usuarios</strong>
                    <small>Support Center</small>
                </h3>
            </div>
        </a>
    </div>
    <div class="col-md-3">

        <a href="javascript:" class="widget widget-hover-effect1">
            <div class="widget-simple">
                <div class="widget-icon pull-left themed-background-spring animation-fadeIn">
                    <i class="gi gi-usd"></i>
                </div>
                <h3 class="widget-content text-right animation-pullDown">
                    + <strong>250%</strong><br>
                    <small>Pagos servicios</small>
                </h3>
            </div>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-extra themed-background-dark">
                <div class="widget-options">
                    <div class="btn-group btn-group-xs">
                        <a href="javascript:void(0)" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Edificios','action' => 'edificio', $edificio['Edificio']['id'])); ?>');" class="btn btn-default" data-toggle="tooltip" title="Quick Settings"><i class="fa fa-cog"></i></a>
                    </div>
                </div>
                <h3 class="widget-content-light">
                     <strong>Informacion</strong>
                </h3>
            </div>
            <div class="widget-extra">
                <div class="row">
                    <table class="table table-bordered">
                        <tr>
                            <td>NOMBRE: </td>
                            <td><?php echo $edificio['Edificio']['nombre']?></td>
                        </tr>
                        <tr>
                            <td>Telefonos: </td>
                            <td><?php echo $edificio['Edificio']['telefonos']?></td>
                        </tr>
                        <tr>
                            <td>Direccion: </td>
                            <td><?php echo $edificio['Edificio']['direccion']?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>