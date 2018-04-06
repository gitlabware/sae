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
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-building"></i><span class="hide-menu">Edificios </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo $this->Html->url(array('controller' => 'Edificios', 'action' => 'index')); ?>">Listado</a></li>
                        <li><a href=javascript:"  onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Edificios', 'action' => 'edificio')); ?>',true);">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Usuarios </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'index')); ?>">Listado</a></li>
                        <li><a href=javascript:"  onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'usuario')); ?>');">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Categorias Ambiente </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo $this->Html->url(array('controller' => 'GenCategoriasambientes', 'action' => 'index')); ?>">Listado</a></li>
                        <li><a href=javascript:"  onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'GenCategoriasambientes', 'action' => 'gencategoria')); ?>');">Nuevo</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Categorias Pagos </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="<?php echo $this->Html->url(array('controller' => 'GenCategoriaspagos', 'action' => 'index')); ?>">Listado</a></li>
                        <li><a href=javascript:"  onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'GenCategoriaspagos', 'action' => 'gencategoriapago')); ?>');">Nuevo</a></li>
                    </ul>
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