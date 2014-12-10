<!-- Main Sidebar -->
<div id="sidebar">
    <!-- Wrapper for scrolling functionality -->
    <div class="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Brand -->
            <a href="index.html" class="sidebar-brand">
                <i class="gi gi-flash"></i><strong>Pro</strong>UI
            </a>
            <!-- END Brand -->
            
            <!-- User Info -->
            <div class="sidebar-section sidebar-user clearfix">
                <div class="sidebar-user-avatar">
                    <a href="page_ready_user_profile.html">
                        <img src="img/placeholders/avatars/avatar2.jpg" alt="avatar">
                    </a>
                </div>
                <div class="sidebar-user-name">John Doe</div>
                <div class="sidebar-user-links">
                    <a href="page_ready_user_profile.html" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
                    <a href="page_ready_inbox.html" data-toggle="tooltip" data-placement="bottom" title="Messages"><i class="gi gi-envelope"></i></a>
                    <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.html in PHP version) -->
                    <a href="#modal-user-settings" data-toggle="modal" class="enable-tooltip" data-placement="bottom" title="Settings"><i class="gi gi-cogwheel"></i></a>
                    <a href="login.html" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="gi gi-exit"></i></a>
                </div>
            </div>
            <!-- END User Info -->

            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Edificios','action' => 'index'));?>"><i class="gi gi-building sidebar-nav-icon"></i>Edificios</a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Categoriasambiente','action' => 'index'));?>"><i class="gi gi-vector_path_all sidebar-nav-icon"></i>Categoria de Ambiente</a>
                </li>
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'Users','action' => 'index'));?>"><i class="gi gi-user sidebar-nav-icon"></i>Usuarios</a>
                </li>
            </ul>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</div>
<!-- END Main Sidebar -->