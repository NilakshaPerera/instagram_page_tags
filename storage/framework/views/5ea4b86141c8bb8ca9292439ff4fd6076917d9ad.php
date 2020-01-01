<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo e(url('images/favicon.png')); ?>" type="image/ico" />
    <title></title>
    <!-- Bootstrap <?php echo e(url('')); ?>-->
    <link href="<?php echo e(url('vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo e(url('vendors/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo e(url('vendors/nprogress/nprogress.css')); ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo e(url('vendors/iCheck/skins/flat/green.css')); ?>" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo e(url('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')); ?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo e(url('vendors/jqvmap/dist/jqvmap.min.css')); ?>" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo e(url('vendors/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet">
    <!-- Selectize -->
    <!--<link href="vendors/selectize.js-master/dist/css/selectize.css" rel="stylesheet">-->
    <link href="<?php echo e(url('vendors/selectize.js-master/dist/css/selectize.default.css')); ?>" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo e(url('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

    <link href="<?php echo e(url('css/custom.min.css')); ?>" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    <div style="margin-top: 10px;" class="navbar nav_title" style="border: 0;"></div>
                    <div class="clearfix"></div>
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_info text-left">
                            <span><strong>Welcome,</strong></span>
                            <h2><strong><?php echo e(Auth::user()->name); ?></strong></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">

                                <li><a><i class="fa fa-dashboard"></i> Dashboards <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo e(url('/dashboard')); ?>">Instagram Feed</a></li>
                                        <li><a href="<?php echo e(url('/account')); ?>">Set Account</a></li>
                                        <!--<li><a href="{ url('/dashboardinprg') }}"> In Progress Run </a></li>-->
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-footer hidden-small text-center">
                        <p class="sidebar-notifications">

                        </p>
                    </div>
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i style="margin: 0 5px" class="fa fa-user"></i><?php echo e(Auth::user()->name); ?>

                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a data-toggle="modal" data-target="#myModal" href="javascript:void(alert(0)">Settings</a></li>
                                    <li><a href="<?php echo e(route('changePassword')); ?>">Change Password</a></li>
                                    <li><a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo e(csrf_field()); ?>

            </form>
            <!-- /top navigation -->
            <div class="right_col" role="main">
                <!-- page content -->


                <div class="row">
                    <div id="alertSuccess" name="alertSuccess" class="alert alert-success alert-dismissible text-center" style=" z-index:9000; right: 0; bottom: 0; position: fixed; display: none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>SUCCESS!</strong>
                    </div>
                    <div id="alertWarning" name="alertWarning" class="alert alert-warning alert-dismissible text-center" style=" z-index:9000; right: 0; bottom: 0; position: fixed; display: none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Warning!</strong> <span id="alertWarningMessage"></span>
                    </div>
                    <div id="alertError" name="alertError" class="alert alert-danger alert-dismissible text-center" style=" z-index:9000; right: 0; bottom: 0; position: fixed; display: none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Error!</strong> <span id="alertErrorMessage"></span>
                    </div>
                </div>

                <?php echo $__env->yieldContent('content'); ?>
                <!-- /page content -->
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Settings</h4>
                        </div>
                        <form id="formSettings" name="formSettings" method="POST" class="form-horizontal" action="">
                            <?php echo e(csrf_field()); ?>

                            <div class="modal-body">

                                <?php foreach (App\Setting::all() as $setting) { ?>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-4 control-label"> <?php echo e($setting->display_name); ?></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="<?php echo e($setting->setting); ?>" name="<?php echo e($setting->setting); ?>" value="<?php echo e($setting->data); ?>">
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Created by <a href="http://www.enfection.com/">ENFECTION</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <script>
        var base = '<?php echo e(url('/')); ?>';
    </script>

    <!-- jQuery -->
    <script src="<?php echo e(url('vendors/jquery/dist/jquery.min.js')); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo e(url('vendors/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo e(url('vendors/fastclick/lib/fastclick.js')); ?>"></script>
    <!-- NProgress -->
    <script src="<?php echo e(url('vendors/nprogress/nprogress.js')); ?>"></script>
    <!-- Chart.js -->
    <script src="<?php echo e(url('vendors/Chart.js/dist/Chart.min.js')); ?>"></script>
    <!-- gauge.js -->
    <script src="<?php echo e(url('vendors/gauge.js/dist/gauge.min.js')); ?>"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo e(url('vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')); ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo e(url('vendors/iCheck/icheck.min.js')); ?>"></script>
    <!-- Skycons -->
    <script src="<?php echo e(url('vendors/skycons/skycons.js')); ?>"></script>
    <!-- Flot -->
    <script src="<?php echo e(url('vendors/Flot/jquery.flot.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/Flot/jquery.flot.pie.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/Flot/jquery.flot.time.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/Flot/jquery.flot.stack.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/Flot/jquery.flot.resize.js')); ?>"></script>
    <!-- Flot plugins -->
    <script src="<?php echo e(url('vendors/flot.orderbars/js/jquery.flot.orderBars.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/flot-spline/js/jquery.flot.spline.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/flot.curvedlines/curvedLines.js')); ?>"></script>
    <!-- DateJS -->
    <script src="<?php echo e(url('vendors/DateJS/build/date.js')); ?>"></script>
    <!-- JQVMap -->
    <script src="<?php echo e(url('vendors/jqvmap/dist/jquery.vmap.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/jqvmap/dist/maps/jquery.vmap.world.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')); ?>"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo e(url('vendors/moment/min/moment.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
    <!-- Parsley -->
    <script src="<?php echo e(url('vendors/parsleyjs/dist/parsley.min.js')); ?>"></script>
    <!-- Selectize -->
    <script src="<?php echo e(url('vendors/selectize.js-master/dist/js/standalone/selectize.min.js')); ?>"></script>
    <!-- Datatables -->
    <script src="<?php echo e(url('vendors/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/datatables.net-buttons/js/buttons.flash.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/datatables.net-buttons/js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/datatables.net-buttons/js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/jszip/dist/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/pdfmake/build/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(url('vendors/pdfmake/build/vfs_fonts.js')); ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script src="<?php echo e(url('js/custom.min.js')); ?>"></script>
</body>

</html>

<script>
    $(document).ready(function() {
        init_DataTables();

        function init_DataTables() {
            if (typeof($.fn.DataTable) === 'undefined') {
                return;
            }
            var handleDataTableButtons = function() {
                if ($(".jstable").length) {
                    $(".jstable").DataTable({
                        dom: "Blfrtip",
                        keys: true,
                        buttons: [{
                                extend: "copy",
                                className: "btn-sm"
                            },
                            {
                                extend: "csv",
                                className: "btn-sm"
                            },
                            {
                                extend: "excel",
                                className: "btn-sm"
                            },
                            {
                                extend: "pdfHtml5",
                                className: "btn-sm"
                            },
                            {
                                extend: "print",
                                className: "btn-sm"
                            },
                        ],
                        responsive: true,
                        lengthMenu: [
                            [50, 75, 100],
                            [50, 75, 100]
                        ]
                    });
                }
            };

            TableManageButtons = function() {
                "use strict";
                return {
                    init: function() {
                        handleDataTableButtons();
                    }
                };
            }();
            TableManageButtons.init();
        };

        $('#formSettings').submit(function(e) {
            e.preventDefault();
            var data = $('#formSettings').serialize();
            $.ajax({
                url: "admin/save-settings",
                type: 'post',
                data: data,
                success: function(respond) {
                    if (respond.success) {
                        alertMessage(1);
                    } else {
                        alert('An error occured! Please contact the venodr or try again in a few minutes');
                    }
                },
                complete: function() {}
            });
        });

    });

    function alertMessage(type, message = "", sustainPeriod = 1000) {
        switch (type) {
            case 1:
                $('#alertSuccess').fadeIn(sustainPeriod, function() {});
                $('#alertSuccess').fadeOut(sustainPeriod, function() {});
                break;
            case 2:
                $('#alertWarningMessage').text(message);
                $('#alertWarning').fadeIn(sustainPeriod, function() {});
                break;
            case 2:
                $('#alertErrorMessage').text(message);
                $('#alertError').fadeIn(sustainPeriod, function() {});
                break;
        }
    }

    $(function() {
        var $wrapper = $('#wrapper');
        // display scripts on the page
        $('script', $wrapper).each(function() {
            var code = this.text;
            if (code && code.length) {
                var lines = code.split('\n');
                var indent = null;
                for (var i = 0; i < lines.length; i++) {
                    if (/^[	 ]*$/.test(lines[i]))
                        continue;
                    if (!indent) {
                        var lineindent = lines[i].match(/^([ 	]+)/);
                        if (!lineindent)
                            break;
                        indent = lineindent[1];
                    }
                    lines[i] = lines[i].replace(new RegExp('^' + indent), '');
                }
                var code = $.trim(lines.join('\n')).replace(/	/g, '    ');
                var $pre = $('<pre>').addClass('js').text(code);
                $pre.insertAfter(this);
            }
        });

        $('select.selectized,input.selectized', $wrapper).each(function() {
            var hiddenInput = $('<input>').prop('type', 'hidden').prop('name', 'covercities').prop('id', 'covercities');
            var $input = $(this);
            var update = function(e) {
                hiddenInput.val((JSON.stringify($input.val())));
            }
            $(this).on('change', update);
            update();
            hiddenInput.insertAfter($input);
        });
    });
</script>


<?php echo $__env->yieldContent('scripts'); ?>