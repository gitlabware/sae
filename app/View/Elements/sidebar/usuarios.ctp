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
                    <a href="javascript:" data-toggle="tooltip" data-placement="bottom" title="Perfil" onclick="cargarmodal('<?php echo $this->Html->url(array('controller' => 'Usuarios', 'action' => 'usuario', $this->Session->read('Auth.User.id'))) ?>');"><i class="gi gi-user"></i></a>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'salir')); ?>" data-toggle="tooltip" data-placement="bottom" title="Cerrar"><i class="gi gi-exit"></i></a>
                </div>
            </div>
            <!-- END User Info -->

            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Usuarios', 'action' => 'ambientes')); ?>"><i class="gi gi-charts sidebar-nav-icon"></i>Inicio</a>
                </li>
            </ul>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Main Sidebar -->