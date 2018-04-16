<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="GOGHU">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"
          href="<?php echo $this->webroot; ?>template/assets/images/favicon.png">
    <title>Sistema</title>
    <!-- Bootstrap Core CSS -->
    <?php echo $this->Session->flash(); ?>
    <link href="<?php echo $this->webroot; ?>template/assets/plugins/bootstrap/css/bootstrap.min.css"
          rel="stylesheet">
    <?= $this->fetch('campo_css_ant') ?>
<!--    <link href="--><?php //echo $this->webroot; ?><!--template/assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">-->
    <!--alerts CSS -->
    <link href="<?php echo $this->webroot; ?>template/assets/plugins/sweetalert/sweetalert.css"
          rel="stylesheet" type="text/css">

    <?= $this->fetch('campo_css') ?>


    <!-- Custom CSS -->
    <link href="<?php echo $this->webroot; ?>template/main/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo $this->webroot; ?>template/main/css/colors/green-dark.css" id="theme"
          rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .modal-content {
            max-height: calc(100vh - 100px);
            overflow-y: auto;
        }

        @media print{
            aside.left-sidebar{
                display: none;
            }
        }
    </style>
</head>

<body class="fix-header card-no-border">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <?php $role = $this->Session->read('Auth.User.role'); ?>

    <?php
    if ($role == "Super Administrador") {
        echo $this->element("menu/super_administrador");
    } elseif ($role == 'Administrador') {
        echo $this->element("menu/administrador");
    }
    ?>

    <?php
    if ($role == "Super Administrador") {
        echo $this->element("sidebar/super_administrador");
    } elseif ($role == 'Administrador') {
        echo $this->element("sidebar/administrador");
    } elseif ($role == 'Propietario' || $role == "Inquilino") {
        echo $this->element("sidebar/usuarios");
    }
    ?>



    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid" id="page-content">

            <?php echo $this->fetch('content'); ?>

            <?= $this->fetch('dcontenido') ?>

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2017 Sistema por goghu.net
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<div class="lanzador"></div>

<!-- sample modal content -->
<div id="myModal" class="modal fade" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="div_barra_cargando">
                <div class="progress">
                    <div class="progress-bar bg-info progress-bar-striped" role="progressbar"
                         aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                         style="width:100%;height:10px;"><span class="sr-only"></span></div>
                </div>
            </div>
            <div id="divmodal" style="display: none;">

            </div>

        </div>
    </div>
</div>
<!-- /.modal -->

<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?php echo $this->webroot; ?>template/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo $this->webroot; ?>template/assets/plugins/bootstrap/js/popper.min.js"></script>
<!--<script src="--><?php //echo $this->webroot; ?><!--template/assets/plugins/bootstrap/js/tether.min.js"></script>-->
<script src="<?php echo $this->webroot; ?>template/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- slimscrollbar scrollbar JavaScript -->
<script src="<?php echo $this->webroot; ?>template/main/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?php echo $this->webroot; ?>template/main/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo $this->webroot; ?>template/main/js/sidebarmenu.js"></script>
<!--stickey kit -->
<script src="<?php echo $this->webroot; ?>template/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo $this->webroot; ?>template/main/js/custom.min.js"></script>


<?php echo $this->fetch('campo_js_ant') ?>
<script src="<?php echo $this->webroot; ?>template/main/js/validation.js"></script>
<!-- Sweet-Alert  -->
<script src="<?php echo $this->webroot; ?>template/assets/plugins/sweetalert/sweetalert.min.js"></script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<!--<script src="-->
<?php //echo $this->webroot; ?><!--template/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>-->


<script>


    var sw_modal = false;
    $('#myModal').on('show.bs.modal', function (e) {
        sw_modal = true;
    });
    $('#myModal').on('hide.bs.modal', function (e) {
        sw_modal = false;
    });

    function cargarmodal(urll, silargo) {
        if (silargo) {
            $("#myModal").find('.modal-dialog').attr('class', 'modal-dialog modal-lg');
        } else {
            $("#myModal").find('.modal-dialog').attr('class', 'modal-dialog modal-md');
        }

        $("#div_barra_cargando").show();

        if (!sw_modal) {
            $("#myModal").modal({
            });
        }


        $("#divmodal").show();

        $("#divmodal").load(urll, function (responseText, textStatus, req) {
            if (textStatus == "error") {
                $("#divmodal").hide();
                alert("error!!!");
            }
            else {
                $("#div_barra_cargando").hide(800);
            }
        });

    }

    !function ($) {
        "use strict";

        var SweetAlert = function () {
        };

        //examples
        SweetAlert.prototype.init = function () {
            //Success Message


        },
            //init
            $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert


    }(window.jQuery),


//initializing
        function ($) {
            "use strict";
            $.SweetAlert.init()
        }(window.jQuery);

    function alertabn(mensaje) {
        swal({
            title: "Excelente!",
            text: mensaje,
            type: 'success'
        }, function () {
            $(".lanzador").trigger("click");
        })
    }

    function alertaer(mensaje) {
        swal("Error!", mensaje, 'error')
    }


    $('#sa-params').click(function () {

    });

    function pregunta(urll, texto) {
        swal({
            title: "Esta seguro?",
            text: texto,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax(
                    {
                        url: urll,
                        type: "POST",
                        success: function (data, textStatus, jqXHR) {
                            if ($.parseJSON(data).estado) {
                                alertabn($.parseJSON(data).respuesta);
                                $(".lanzador").trigger("click");
                            } else {
                                alertaer($.parseJSON(data).respuesta);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            //if fails
                            alert("error");
                        }
                    });

            } else {
                swal("Cancelado", "(DE " + texto + ')', "error");
            }
        });
    }


    function notifyMe(usuario,texto) {
        options = {
            body: texto,
            icon: '<?php echo $this->webroot.'template/assets/images/logo-icon.png' ?>'
        };
        // Let's check if the browser supports notifications
        if (!("Notification" in window)) {
            alert("This browser does not support desktop notification");
        }

        // Let's check whether notification permissions have already been granted
        else if (Notification.permission === "granted") {
            // If it's okay let's create a notification
            var notification = new Notification(usuario,options);
        }

        // Otherwise, we need to ask the user for permission
        else if (Notification.permission !== "denied") {
            Notification.requestPermission(function (permission) {
                // If the user accepts, let's create a notification



                if (permission === "granted") {
                    var notification = new Notification(usuario,options);
                }
            });
        }

        // At last, if the user has denied notifications, and you
        // want to be respectful there is no need to bother them any more.
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
<?= $this->fetch('campo_js') ?>

</body>

</html>
