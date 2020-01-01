<?php $__env->startSection('content'); ?>

<div id="top-kattiya" class="insta-wall" style="background: url('<?php echo e(url('/images/insta-wall-bg.png')); ?>')">
    <div class="container">
        <div class="row insta-tiles">
            <?php $__currentLoopData = \App\Post::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 insta-tile" >
                <a target="_blank" href="<?php echo e($post->permalink); ?>">
                    <div style="background-image: url('<?php echo e($post->media_url); ?>'); height: 260px; width: 100%; background-size: cover; background-position:center center ">
                    </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>