<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>Mesi Gestion Edificios</title>

        <meta name="description" content="MESI">
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

        <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <script src="<?php echo $this->webroot; ?>js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!-- Login Background -->
        <div id="login-background">
            <!-- For best results use an image with a resolution of 2560x400 pixels (prefer a blurred image for smaller file size) -->
            <img src="<?php echo $this->webroot; ?>img/placeholders/headers/login_header.jpg" alt="Login Background">
        </div>
        <!-- END Login Background -->
        <!-- Login Container -->
        <div id="login-container" class="animation-fadeIn">
            <?php echo $this->Session->flash(); ?>
            <!-- Login Title -->
            <div class="login-title text-center">
                <h1><i class="gi gi-flash"></i> <strong>MESI</strong><br><small>Ingrese <strong>Usuario</strong> y <strong>Password</strong></small></h1>
            </div>
            <!-- END Login Title -->
            
            <?php echo $this->fetch('content'); ?>

            <!-- Footer -->
            <footer class="text-muted text-center">
                <small><span id="year-copy"></span> &copy; <a href="http://www.mesi.co" target="_blank">Mesi</a></small>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Login Container -->


        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.1.min.js"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
        <script src="<?php echo $this->webroot; ?>js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo $this->webroot; ?>js/plugins.js"></script>
        <script src="<?php echo $this->webroot; ?>js/app.js"></script>

        <!-- Load and execute javascript code used only in this page -->
        <script src="<?php echo $this->webroot; ?>js/pages/login.js"></script>
        <script>$(function () {
                Login.init();
            });</script>
    </body>
</html>