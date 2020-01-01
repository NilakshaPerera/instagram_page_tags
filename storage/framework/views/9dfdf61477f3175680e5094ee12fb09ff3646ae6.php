<?php $__env->startSection('content'); ?>

<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <div class="x_panel">
                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <h1>Login Form</h1>
                    <div  class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                        <!--<input type="text" class="form-control"required="" />-->
                        <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus  placeholder="Username" >
                        <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div  class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                        <input id="password" type="password" class="form-control" name="password" required  placeholder="Password" >
                        <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me
                        </label>
                    </div>
                    <div>

                        <button type="submit" class="btn btn-default submit">
                            Login
                        </button>

                        <button type="button" class="btn btn-default submit"  onclick="location.href='<?php echo e(route('password.request')); ?>'">
                            Forgot Your Password?
                        </button>
                    </div>

                    <div class="clearfix"></div>

                </form>
            </div>
        </section>
    </div>

</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>