<!-- Main Sidebar -->
<div id="sidebar">
    <!-- Wrapper for scrolling functionality -->
    <div class="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Brand -->
            <a href="<?php echo $this->Html->url(array('controller' => 'Edificios', 'action' => 'datos')); ?>" class="sidebar-brand">
                <i class="gi gi-flash"></i><strong>SAE</strong>lw
            </a>
            <!-- END Brand -->

            <!-- User Info -->
            <div class="sidebar-section sidebar-user clearfix">
                <div class="sidebar-user-avatar">
                    <a href="javascript:">
                        <img src="<?php echo $this->webroot; ?>img/placeholders/avatars/avatar2.jpg" alt="avatar">
                    </a>
                </div>
                <div class="sidebar-user-name"><?php echo $this->Session->read('Auth.User.username'); ?></div>
                <div class="sidebar-user-links">
                    <a href="javascript:" data-toggle="tooltip" data-placement="bottom" title="Perfil" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'usuario', $this->Session->read('Auth.User.id'))) ?>');"><i class="gi gi-user"></i></a>
                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Configuraciones"  onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Edificios', 'action' => 'edificio', $this->Session->read('Auth.User.edificio_id'))); ?>');"><i class="fa fa-cog"></i></a>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'salir')); ?>" data-toggle="tooltip" data-placement="bottom" title="Cerrar"><i class="gi gi-exit"></i></a>
                </div>
            </div>
            <!-- END User Info -->

            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Edificios', 'action' => 'datos')); ?>"><i class="gi gi-charts sidebar-nav-icon"></i>Panel de Control</a>
                </li>
                <li>
                    <a  href="javascript:" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="gi gi-settings sidebar-nav-icon"></i>Configuraciones</a>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Categoriasambientes', 'action' => 'index')); ?>">Categoria de Ambiente</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Categoriaspagos', 'action' => 'index')); ?>">Categoria de Pagos</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a  href="javascript:" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="gi gi-tags sidebar-nav-icon"></i>Ambientes</a>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Ambientes', 'action' => 'edificio', $this->Session->read('Auth.User.edificio_id'))); ?>">Ambientes Piso</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Edificios', 'action' => 'ambientes')); ?>">Listado de ambientes</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a  href="javascript:" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="gi gi-money sidebar-nav-icon"></i>Pagos</a>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Pagos', 'action' => 'excels')); ?>">Adeudos - Excel</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Pagos', 'action' => 'preavisos')); ?>">Pre-avisos</a>
                        </li>
                        <li>
                            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Egresos', 'action' => 'egresocuenta')); ?>');">Registro de Egreso</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Egresos', 'action' => 'multi_egreso')); ?>">Registro de Egreso Var.</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Cuentas', 'action' => 'index')); ?>">Cuentas - Bancos/Cajas</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Nomenclaturas', 'action' => 'lista_nomenclaturas')); ?>">Nomenclatura de Cuentas</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Presupuestos', 'action' => 'index')); ?>">Listado de Presupuestos</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Comprobantes', 'action' => 'index')); ?>">Listado de Comprobantes</a>
                        </li>
                    </ul>
                </li>
                <!--<li>
                    <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Conceptos', 'action' => 'eservicios', $this->Session->read('Auth.User.edificio_id'))); ?>');"><i class="gi gi-briefcase sidebar-nav-icon"></i>Servicios</a>
                </li>-->
                <!--<li>
                    <a  href="<?php echo $this->Html->url(array('controller' => 'Categoriasambientes', 'action' => 'index')); ?>"><i class="gi gi-vector_path_all sidebar-nav-icon"></i>Categoria de Ambiente</a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Categoriaspagos', 'action' => 'index')); ?>"><i class="gi gi-money sidebar-nav-icon"></i>Categoria de Pagos</a>
                </li>-->
                <li>
                    <a href="javascript:" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="gi gi-notes_2 sidebar-nav-icon"></i>Reportes</a>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Reportes', 'action' => 'reporte_pagos')); ?>">Reporte de pagos</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Reportes', 'action' => 'reporte_pagos_a')); ?>">Reporte de pagos agrupados</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Reportes', 'action' => 'reporte_pagos_totales')); ?>">Reporte de pagos totales</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Reportes', 'action' => 'indexcuentasxcobrar')); ?>">Cuentas por cobrar</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Reportes', 'action' => 'reporte_egresos_ban')); ?>">Reporte de Egresos</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Reportes', 'action' => 'reporte_auxiliares')); ?>">Reporte de Auxiliares</a>
                        </li> 
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Reportes', 'action' => 'comprobantes_pago_meses')); ?>">Reporte de Auxiliares por meses</a>
                        </li> 
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Reportes', 'action' => 'comprobantes_pago_gestiones')); ?>">Reporte de Auxiliares por gestiones</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="gi gi-user sidebar-nav-icon"></i>Usuarios</a>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Usuarios', 'action' => 'usuarios')); ?>">Listado Inquilinos/Propietarios</a>
                        </li>
                        <li>
                            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Usuarios', 'action' => 'usuario')); ?>');">Nuevo Inquilino/Propietario</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'lista_usuarios')); ?>" >Administradores</a>
                        </li>
                        <li>
                            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'usuario3')); ?>');">Nuevo Administrador</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="gi gi-sort sidebar-nav-icon"></i>Conceptos</a>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Conceptos', 'action' => 'ambientes')); ?>">Asignacion de conceptos</a>

                        </li>
                        <li>
                            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Conceptos', 'action' => 'subconcepto')); ?>');">Nuevo Sub-Concepto</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Conceptos', 'action' => 'subconceptos')); ?>">Subconceptos</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Recibos', 'action' => 'index')); ?>"><i class="gi gi-notes sidebar-nav-icon"></i>Recibos</a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Tutoriales', 'action' => 'index')); ?>"><i class="gi gi-film sidebar-nav-icon"></i>Tutoriales</a>
                </li>
            </ul>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Main Sidebar -->