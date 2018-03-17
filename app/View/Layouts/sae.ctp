<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>Mesi Gestion Edificios</title>

        <meta name="description" content="Mesi">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo $this->webroot; ?>img/favicon.ico">
        <link rel="apple-touch-icon" href="<?php echo $this->webroot; ?>img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="<?php echo $this->webroot; ?>img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="<?php echo $this->webroot; ?>img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="<?php echo $this->webroot; ?>img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="<?php echo $this->webroot; ?>img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="<?php echo $this->webroot; ?>img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="<?php echo $this->webroot; ?>img/icon152.png" sizes="152x152">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/bootstrap.min.css">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/main.css">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="<?php echo $this->webroot; ?>css/themes.css">

        <!-- END Stylesheets -->

        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.1.min.js"%3E%3C/script%3E'));</script>-->
        <script src="<?php echo $this->webroot; ?>js/vendor/jquery-1.11.1.min.js"></script>
        <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <script src="<?php echo $this->webroot; ?>js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
        <script>
            var urljsontablatrab = '';
            var filtro_c = [];
        </script>
        <!--<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/cssprint.css" media="print"> -->
    </head>
    <!-- In the PHP version you can set the following options from inc/config file -->
    <!--
        Available body classes:

        'page-loading'      enables page preloader
    -->
    <body>

        <!-- Preloader -->
        <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
        <!-- Used only if page preloader is enabled from inc/config (PHP version) or the class 'page-loading' is added in body element (HTML version) -->
        <div class="preloader themed-background">
            <h1 class="push-top-bottom text-light text-center"><strong>ME</strong>SI</h1>
            <div class="inner">
                <h3 class="text-light visible-lt-ie9 visible-lt-ie10"><strong>Loading..</strong></h3>
                <div class="preloader-spinner hidden-lt-ie9 hidden-lt-ie10"></div>
            </div>
        </div>
        <!-- END Preloader -->

        <!-- Page Container -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!--
            Available #page-container classes:

            '' (None)                                       for a full main and alternative sidebar hidden by default (> 991px)

            'sidebar-visible-lg'                            for a full main sidebar visible by default (> 991px)
            'sidebar-partial'                               for a partial main sidebar which opens on mouse hover, hidden by default (> 991px)
            'sidebar-partial sidebar-visible-lg'            for a partial main sidebar which opens on mouse hover, visible by default (> 991px)

            'sidebar-alt-visible-lg'                        for a full alternative sidebar visible by default (> 991px)
            'sidebar-alt-partial'                           for a partial alternative sidebar which opens on mouse hover, hidden by default (> 991px)
            'sidebar-alt-partial sidebar-alt-visible-lg'    for a partial alternative sidebar which opens on mouse hover, visible by default (> 991px)

            'sidebar-partial sidebar-alt-partial'           for both sidebars partial which open on mouse hover, hidden by default (> 991px)

            'sidebar-no-animations'                         add this as extra for disabling sidebar animations on large screens (> 991px) - Better performance with heavy pages!

            'style-alt'                                     for an alternative main style (without it: the default style)
            'footer-fixed'                                  for a fixed footer (without it: a static footer)

            'disable-menu-autoscroll'                       add this to disable the main menu auto scrolling when opening a submenu

            'header-fixed-top'                              has to be added only if the class 'navbar-fixed-top' was added on header.navbar
            'header-fixed-bottom'                           has to be added only if the class 'navbar-fixed-bottom' was added on header.navbar
        -->
        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
            <!-- Alternative Sidebar -->
            <div id="sidebar-alt">
                <!-- Wrapper for scrolling functionality -->
                <div class="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Chat -->
                        <!-- Chat demo functionality initialized in js/app.js -> chatUi() -->
                        <a href="page_ready_chat.html" class="sidebar-title">
                            <i class="gi gi-comments pull-right"></i> <strong>Chat</strong>UI
                        </a>
                        <!-- Chat Users -->


                        <!-- Chat Talk -->
                        <div class="chat-talk display-none">
                            <!-- Chat Info -->
                            <div class="chat-talk-info sidebar-section">

                                <strong>John</strong> Doe
                                <button id="chat-talk-close-btn" class="btn btn-xs btn-default pull-right">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <!-- END Chat Info -->

                            <!-- Chat Messages -->
                            <ul class="chat-talk-messages">
                                <li class="text-center"><small>Yesterday, 18:35</small></li>
                                <li class="chat-talk-msg animation-slideRight">Hey admin?</li>
                                <li class="chat-talk-msg animation-slideRight">How are you?</li>
                                <li class="text-center"><small>Today, 7:10</small></li>
                                <li class="chat-talk-msg chat-talk-msg-highlight themed-border animation-slideLeft">I'm fine, thanks!</li>
                            </ul>
                            <!-- END Chat Messages -->

                            <!-- Chat Input -->
                            <form action="index.html" method="post" id="sidebar-chat-form" class="chat-form">
                                <input type="text" id="sidebar-chat-message" name="sidebar-chat-message" class="form-control form-control-borderless" placeholder="Type a message..">
                            </form>
                            <!-- END Chat Input -->
                        </div>
                        <!--  END Chat Talk -->
                        <!-- END Chat -->

                        <!-- Activity -->
                        <a href="javascript:void(0)" class="sidebar-title">
                            <i class="fa fa-globe pull-right"></i> <strong>Activity</strong>UI
                        </a>
                        <div class="sidebar-section">
                            <div class="alert alert-danger alert-alt">
                                <small>just now</small><br>
                                <i class="fa fa-thumbs-up fa-fw"></i> Upgraded to Pro plan
                            </div>
                            <div class="alert alert-info alert-alt">
                                <small>2 hours ago</small><br>
                                <i class="gi gi-coins fa-fw"></i> You had a new sale!
                            </div>
                            <div class="alert alert-success alert-alt">
                                <small>3 hours ago</small><br>
                                <i class="fa fa-plus fa-fw"></i> <a href="page_ready_user_profile.html"><strong>John Doe</strong></a> would like to become friends!<br>
                                <a href="javascript:void(0)" class="btn btn-xs btn-primary"><i class="fa fa-check"></i> Accept</a>
                                <a href="javascript:void(0)" class="btn btn-xs btn-default"><i class="fa fa-times"></i> Ignore</a>
                            </div>
                            <div class="alert alert-warning alert-alt">
                                <small>2 days ago</small><br>
                                Running low on space<br><strong>18GB in use</strong> 2GB left<br>
                                <a href="page_ready_pricing_tables.html" class="btn btn-xs btn-primary"><i class="fa fa-arrow-up"></i> Upgrade Plan</a>
                            </div>
                        </div>
                        <!-- END Activity -->

                        <!-- Messages -->
                        <a href="page_ready_inbox.html" class="sidebar-title">
                            <i class="fa fa-envelope pull-right"></i> <strong>Messages</strong>UI (5)
                        </a>
                        <div class="sidebar-section">
                            <div class="alert alert-alt">
                                Debra Stanley<small class="pull-right">just now</small><br>
                                <a href="page_ready_inbox_message.html"><strong>New Follower</strong></a>
                            </div>
                            <div class="alert alert-alt">
                                Sarah Cole<small class="pull-right">2 min ago</small><br>
                                <a href="page_ready_inbox_message.html"><strong>Your subscription was updated</strong></a>
                            </div>
                            <div class="alert alert-alt">
                                Bryan Porter<small class="pull-right">10 min ago</small><br>
                                <a href="page_ready_inbox_message.html"><strong>A great opportunity</strong></a>
                            </div>
                            <div class="alert alert-alt">
                                Jose Duncan<small class="pull-right">30 min ago</small><br>
                                <a href="page_ready_inbox_message.html"><strong>Account Activation</strong></a>
                            </div>
                            <div class="alert alert-alt">
                                Henry Ellis<small class="pull-right">40 min ago</small><br>
                                <a href="page_ready_inbox_message.html"><strong>You reached 10.000 Followers!</strong></a>
                            </div>
                        </div>
                        <!-- END Messages -->
                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
            <!-- END Alternative Sidebar -->
            <?php $role = $this->Session->read('Auth.User.role'); ?>
            <?php
            if ($role == "Super Administrador") {
                echo $this->element("sidebar/super_administrador");
            } elseif ($role == 'Administrador') {
                echo $this->element("sidebar/administrador");
            } elseif ($role == 'Propietario' || $role == "Inquilino") {
                echo $this->element("sidebar/usuarios");
            }
            ?>
            <!-- Main Container -->
            <div id="main-container">
                <?php
                if ($role == "Super Administrador") {
                    echo $this->element("menu/super_administrador");
                } elseif ($role == 'Administrador') {
                    echo $this->element("menu/administrador");
                }
                ?>
                <!-- END Header -->

                <!-- Page content -->
                <style>
                    #tabla-json input{
                        width: 100%;
                    }
                </style>
                <div id="page-content">
                    <?php echo $this->fetch('content'); ?>
                </div>
                <!-- END Page Content -->

                <!-- Footer -->
                <footer class="clearfix">
                    <div class="pull-right">
                        Derechos Reservados <i class="fa fa-heart text-danger"></i> para Mesi <a href="#" target="_blank"></a>
                    </div>
                    <div class="pull-left">
                        <span id="year-copy"></span> &copy; <a href="#" target="_blank">VirtualWare</a>
                    </div>
                </footer>
                <!-- END Footer -->
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>
        <style>
            .modal .modal-body {
                max-height: 500px;
                overflow-y: auto;
                overflow-x: hidden;
            }
        </style>
        <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div  id="div_barra_cargando">
                        <div class="progress progress-striped active progress-sm">
                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="45" role="progressbar" class="progress-bar progress-bar-success">

                            </div>
                        </div>
                    </div>
                    <div id="divmodal" style="display: none;">

                    </div>
                </div>
            </div>
        </div>
        <!-- END User Settings -->

        <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
        <div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div  id="div_barra_cargando2">
                        <div class="progress progress-striped active progress-sm">
                            <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="45" role="progressbar" class="progress-bar progress-bar-success">

                            </div>
                        </div>
                    </div>
                    <div id="divmodal2" style="display: none;">

                    </div>
                </div>
            </div>
        </div>
        <!-- END User Settings -->      

        <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
        <script src="<?php echo $this->webroot; ?>js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo $this->webroot; ?>js/plugins.js"></script>
        <script src="<?php echo $this->webroot; ?>js/app.js"></script>
        <script type="text/javascript" src="<?php echo $this->webroot; ?>js/jquery.scrollTo.js"></script>

        <script src="<?php echo $this->webroot; ?>js/pages/tablesDatatables.js"></script>
        <script src="<?php echo $this->webroot; ?>js/jquery.dataTables.columnFilter.js"></script>


        <script>$(function () {
                TablesDatatables.init();

            });</script>
        <script>
            $('#form-edificio').validate();
        </script>
        <script>
            function cargarmodal(urll)
            {
                $("#div_barra_cargando").show();
                $("#myModal").modal({
                    //backdrop: 'static',
                    //keyboard: false
                });
                $("#divmodal").show();
                $("#divmodal").load(urll, function (responseText, textStatus, req) {
                    if (textStatus == "error")
                    {
                        $("#divmodal").hide();
                        alert("error!!!");
                    }
                    else {
                        $("#div_barra_cargando").hide(800);
                    }
                });

            }

        </script>

        <script>
            function cargarmodal2(urll)
            {
                $("#div_barra_cargando2").show();
                $("#myModal2").modal('show');
                $("#divmodal2").show();
                $("#divmodal2").load(urll, function (responseText, textStatus, req) {
                    if (textStatus == "error")
                    {
                        $("#divmodal2").hide();
                        alert("error!!!");
                    }
                    else {
                        $("#div_barra_cargando2").hide(800);
                    }
                });

            }
            function pop_print() {
                w = window.open(null, 'Print_Page', 'scrollbars=yes');
                var myStyle = '<link rel="stylesheet" href="<?php echo $this->webroot; ?>css/cssprint.css" />';
                w.document.write('<button class="no-imrprime-p" type="button" onclick="window.print();">Imprimir</button>');
                w.document.write(myStyle + jQuery('#page-content').html());
                w.document.close();
                //w.print();
            }
        </script>
        <?php echo $this->fetch('addscript') ?>
        <?php echo $this->Session->flash(); ?>
        
    </body>
</html>
