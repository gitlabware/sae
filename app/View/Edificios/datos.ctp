<style type="text/css">
.social-profile {
    background: #2c773e5e !important;
}
</style>
<div class="col-md-12">
    <div class="card" style="height: 220px;"> <img class="card-img" style="height: 220px; width: 100%;" src="<?php echo $this->webroot; ?>img/41236569.jpg" alt="Card image"  >
        <div class="card-img-overlay card-inverse social-profile d-flex ">
            <div class="align-self-center" style="width: 100%;">
                <h1 class="card-title">Bienvenido <strong><?php echo $this->Session->read('Auth.User.nombre'); ?></strong><br><small>Sistema de Administracion</small></h1>
                <h3 class="card-subtitle">EDIFICIO <?php echo strtoupper($edificio['Edificio']['nombre']); ?></strong></h3>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pisos</h4>
                <div class="text-right">
                    <h2 class="font-light m-b-0"><i class="fa fa-navicon text-success"></i> <?php echo $nro_pisos;?></h2>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ambientes</h4>
                <div class="text-right">
                    <h2 class="font-light m-b-0"><i class="fa fa-tags text-info"></i> <?php echo $nro_ambientes;?></h2>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Usuarios</h4>
                <div class="text-right">
                    <h2 class="font-light m-b-0"><i class="fa fa-tags text-danger"></i> <?php echo $nro_usuarios;?></h2>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pagos servicios</h4>
                <div class="text-right">
                    <h2 class="font-light m-b-0"><i class="fa fa-dollar text-warning"></i> 250%</h2>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>


</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline-inverse">
            <div class="card-header">
                <h4 class="m-b-0 text-white">
                 <strong>Informacion</strong>
             </h4>
         </div>
         <div class="card-body">
            <div class="row">
                <table class="table table-bordered">
                    <tbody>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>