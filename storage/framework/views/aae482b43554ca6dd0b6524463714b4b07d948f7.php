<?php $__env->startSection('content'); ?>

<div class="">
    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
        <a class="btn btn-success" href="<?php echo e(htmlspecialchars($url)); ?>">Add Accounts</a>
    </div>
</div>
<div class="d-flex justify-content-center">
    <?php if(isset($pages) && $pages): ?>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <form id="frmAddAccounts" name="frmAddAccounts" method="post">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <select class="js-example-basic-multiple form-control" name="facebookaccounts[]" multiple="multiple">
                                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($page['id']); ?>"><?php echo e($page['name']); ?> - <?php echo e($page['category']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <input name="id" id="id" type="hidden" value="<?php echo e($id); ?>" >
                    <div class="form-group">
                        <div class="form-check text-right">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_content">
            <div class="table-responsive">
                <table id="jstable" name="jstable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="display: table-cell;">Date Time</th>
                            <th class="column-title" style="display: table-cell;">App Name</th>
                            <th class="column-title" style="display: table-cell;">Instagram Business ID</th>
                            <th class="column-title" style="display: table-cell;">Facebook ID</th>
                            <th class="bulk-actions" colspan="7" style="display: none;">
                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt">1 Records Selected</span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = \App\BusinessAccounts::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="even pointer">
                            <td class=" "><?php echo e($account->created_at); ?></td>
                            <td class=" "><?php echo e($account->facebookauth->account_name); ?></td>
                            <td class=" "><?php echo e($account->instagram_business_id); ?></td>
                            <td class=" "><?php echo e($account->facebook_page_id); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    $('#frmAddAccounts').submit(function(e) {
        e.preventDefault();
        var data = new FormData(this);
        $.ajax({
            url: base + "/account/callback/addaccounts",
            type: 'post',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(respond) {
                if (respond.success) {
                    alert('Success');
                    window.location.href = base + '/account'
                } else {
                    alert('An error occured! Please contact the venodr or try again in a few minutes');
                }
            },
            complete: function() {}
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>