<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile">
            <!-- User profile image -->
            <div class="profile-img"><img src="<?php echo $this->request->webroot; ?>img/user.jpg" alt="user"/></div>
            <!-- User profile text-->
            <div class="profile-text"><a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown"
                                         role="button" aria-haspopup="true"
                                         aria-expanded="true"><?php echo $this->Session->read('Auth.User.nombre') ?>
                    <span class="caret"></span></a>
                <div class="dropdown-menu animated flipInY">
                    <a href="javascript:"
                       onclick="cargarmodal('<?php echo $this->Html->url(['controller' => 'Users', 'action' => 'usuario', $this->Session->read('Auth.User.id')]) ?>');"
                       class="dropdown-item"><i class="ti-user"></i> Mi cuenta</a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= $this->Html->url(['controller' => 'Users', 'action' => 'salir']); ?>"
                       class="dropdown-item"><i class="fa fa-power-off"></i> Salir</a>
                </div>
            </div>
        </div>
        <!-- Sidebar navigation Administrador-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap"></li>



                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Edificios', 'action' => 'datos')); ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Panel de Control</span></a>
                </li>
                <li>
                    <a  href="javascript:" class="has-arrow" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Configuraciones</span></a>
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
                    <a  href="javascript:" class="has-arrow" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Ambientes</span></a>
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
                    <a  href="javascript:" class="has-arrow" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Pagos</span></a>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Pagos', 'action' => 'excels')); ?>">Adeudos - Excel</a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Pagos', 'action' => 'preavisos')); ?>">Pre-avisos</a>
                        </li>
                        <li>
                            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Egresos', 'action' => 'egresocuenta')); ?>',true);">Registro de Egreso</a>
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

                <li>
                    <a href="javascript:" class="has-arrow" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Reportes</span></a>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Presupuestos', 'action' => 'reporte_balance')); ?>">Reporte de Balance</a>
                        </li>
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
                    <a href="javascript:" class="has-arrow" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Usuarios</span></a>
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
                    <a href="javascript:" class="has-arrow" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Conceptos</span></a>
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
                    <a href="<?php echo $this->Html->url(array('controller' => 'Recibos', 'action' => 'index')); ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Recibos</span></a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Tutoriales', 'action' => 'index')); ?>"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Tutoriales</span></a>
                </li>


            </ul>
        </nav>
        <!-- End Sidebar navigation Administrador -->
    </div>
    <!-- End Sidebar scroll-->

</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

