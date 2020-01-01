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
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- Bootstrap -->
        <link href="<?php echo e(url('vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo e(url('vendors/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo e(url('vendors/nprogress/nprogress.css')); ?>" rel="stylesheet">
        <!-- Animate.css -->
        <link href="<?php echo e(url('vendors/animate.css/animate.min.css')); ?>" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="<?php echo e(url('css/custom.min.css')); ?>" rel="stylesheet">
    </head>

    <body class="login">
        <div>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo e(csrf_field()); ?>

            </form>
            <?php echo $__env->yieldContent('content'); ?>
            <!-- Scripts -->
            <script src="<?php echo e(asset('js/app.js')); ?>"></script>
        </div>
    </body>
</html>