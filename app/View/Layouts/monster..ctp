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
          href="<?php echo $this->request->webroot; ?>template/assets/images/favicon.png">
    <title>Sistema</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $this->request->webroot; ?>template/assets/plugins/bootstrap/css/bootstrap.min.css"
          rel="stylesheet">

    <!--alerts CSS -->
    <link href="<?php echo $this->request->webroot; ?>template/assets/plugins/sweetalert/sweetalert.css"
          rel="stylesheet" type="text/css">

    <?= $this->fetch('campo_css') ?>

    <!-- Custom CSS -->
    <link href="<?php echo $this->request->webroot; ?>template/main/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo $this->request->webroot; ?>template/main/css/colors/green-dark.css" id="theme"
          rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
    <?php
    $role = $this->request->session()->read('Auth.User.role');
    ?>
    <?php if ($role == 'Administrador'): ?>
        <?php echo $this->element('menu/admin'); ?>
        <?php echo $this->element('sidebar/admin'); ?>
    <?php elseif ($role == 'Admin Edificio'): ?>
        <?php echo $this->element('menu/admin_edif'); ?>
        <?php echo $this->element('sidebar/admin_edif'); ?>
    <?php endif; ?>


    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">

            <?= $this->fetch('content') ?>
            <!-- sample modal content -->
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="<?php echo $this->request->webroot; ?>template/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo $this->request->webroot; ?>template/assets/plugins/bootstrap/js/tether.min.js"></script>
<script src="<?php echo $this->request->webroot; ?>template/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="<?php echo $this->request->webroot; ?>template/main/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?php echo $this->request->webroot; ?>template/main/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo $this->request->webroot; ?>template/main/js/sidebarmenu.js"></script>
<!--stickey kit -->
<script src="<?php echo $this->request->webroot; ?>template/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo $this->request->webroot; ?>template/main/js/custom.min.js"></script>


<script src="<?php echo $this->request->webroot; ?>template/main/js/validation.js"></script>
<!-- Sweet-Alert  -->
<script src="<?php echo $this->request->webroot; ?>template/assets/plugins/sweetalert/sweetalert.min.js"></script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="<?php echo $this->request->webroot; ?>template/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

<?= $this->fetch('campo_js') ?>

<script>


    function cargarmodal(urll,silargo) {
        if(silargo){
            $("#myModal").find('.modal-dialog').attr('class','modal-dialog modal-lg');
        }else{
            $("#myModal").find('.modal-dialog').attr('class','modal-dialog modal-md');
        }

        $("#div_barra_cargando").show();
        $("#myModal").modal({
            //backdrop: 'static',
            //keyboard: false
        });
        $("#divmodal").show();

        /*$.ajax({
            type: 'GET',
            url: urll,
            success: function(data){
                $("#divmodal").append(data);
                $("#div_barra_cargando").hide(800);
            },
            error: function(){
                alert("Error!!");
            }
        });*/

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
        swal("Excelente!", mensaje, 'success')
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
                        /*beforeSend:function (XMLHttpRequest) {
                         alert("antes de enviar");
                         },
                         complete:function (XMLHttpRequest, textStatus) {
                         alert('despues de enviar');
                         },*/
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


</script>
</body>

</html>
