    <?php
    foreach ($data as $item) {
            $caption = $item->caption;
?>
            <div class="col-md-3 col-sm-12 col-xs-12 insta-item">
                <a target="_blank" href="<?php echo e($item->permalink); ?>">
                    <img class="insta-item-media" style="background-image: url('<?php echo e($item->media_url); ?>')">
                    <div class="insta-caption" title="<?php echo e($caption); ?>">
                        <?php
                        if (mb_strlen($caption) > 40) {
                            $caption = mb_substr($caption, 0, 36);
                        }
                        echo $caption . '...';
                        ?>
                        <br>
                        - <?php echo e($item->username); ?>

                    </div>
                    <div class="insta-action-pane">
                        <input id="<?php echo e($class); ?>-<?php echo e($item->id); ?>" class="<?php echo e($class); ?>" value="<?php echo e($item->id); ?>" type="checkbox">
                        <span><?php echo e($item->timestamp); ?></span>
                    </div>
                </a>
            </div>
<?php
        }
    ?>


<?php if($class == 'insta-delete-selected' ): ?>
<script>
    var deletearray = [];
    $(document).ready(function() {
        $('.insta-delete-selected').change(function() {
            deletearray = [];
            $('.insta-delete-selected').each(function() {
                if ($(this).prop('checked')) {
                    deletearray.push($(this).val());
                }
            });
        });
    });
</script>
<?php endif; ?>
<?php if($class == 'insta-selected' ): ?>
<script>
    var selectedarray = [];
    $(document).ready(function() {
        $('.insta-selected').change(function() {
            selectedarray = [];
            $('.insta-selected').each(function() {
                if ($(this).prop('checked')) {
                    selectedarray.push($(this).val());
                }
            });
        });

    });
</script>
<?php endif; ?>