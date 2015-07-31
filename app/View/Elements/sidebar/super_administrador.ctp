<!-- Main Sidebar -->
<div id="sidebar">
    <!-- Wrapper for scrolling functionality -->
    <div class="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Brand -->
            <a href="index.html" class="sidebar-brand">
                <i class="gi gi-flash"></i><strong>ME</strong>SI
            </a>
            <!-- END Brand -->

            <!-- User Info -->
            <div class="sidebar-section sidebar-user clearfix">
                <div class="sidebar-user-avatar">
                    <a href="page_ready_user_profile.html">
                        <img src="<?php echo $this->webroot; ?>img/placeholders/avatars/avatar2.jpg" alt="avatar">
                    </a>
                </div>
                <div class="sidebar-user-name"><?php echo $this->Session->read('Auth.User.username'); ?></div>
                <div class="sidebar-user-links">
                    <a href="javascript:" data-toggle="tooltip" data-placement="bottom" title="Perfil" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'usuario', $this->Session->read('Auth.User.id'))) ?>');"><i class="gi gi-user"></i></a>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'salir')); ?>" data-toggle="tooltip" data-placement="bottom" title="Cerrar"><i class="gi gi-exit"></i></a>
                </div>
            </div>
            <!-- END User Info -->

            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="gi gi-building sidebar-nav-icon"></i>Edificios</a>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Edificios', 'action' => 'index')); ?>">Listado</a>
                        </li>
                        <li>                            
                            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Edificios', 'action' => 'edificio')); ?>');">Nuevo</a>
                        </li>
                    </ul>    
                </li>
                <li>
                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="gi gi-user sidebar-nav-icon"></i>Usuarios</a>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'index')); ?>">Listado</a>
                        </li>
                        <li>                            
                            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'usuario')); ?>');">Nuevo</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="gi gi-building sidebar-nav-icon"></i>Categorias Ambiente</a>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'GenCategoriasambientes', 'action' => 'index')); ?>">Listado</a>
                        </li>
                        <li>                            
                            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'GenCategoriasambientes', 'action' => 'gencategoria')); ?>');">Nuevo</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator"></i><i class="gi gi-building sidebar-nav-icon"></i>Categorias Pagos</a>
                    <ul>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'GenCategoriaspagos', 'action' => 'index')); ?>">Listado</a>
                        </li>
                        <li>                            
                            <a href="javascript:" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'GenCategoriaspagos', 'action' => 'gencategoriapago')); ?>');">Nuevo</a>
                        </li>
                    </ul>
                </li>

            </ul>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Main Sidebar -->