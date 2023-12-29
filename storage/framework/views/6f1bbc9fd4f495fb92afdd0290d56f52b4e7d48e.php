
<?php $__env->startSection("content"); ?>
<main id="static-page-<?php echo e($page->id); ?>" class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <?php echo e(ucwords($page->title)); ?>

            </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container">
            <div class="row mb-30">
                <?php echo $page->description; ?>

            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascripts'); ?>
<script>

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make("layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/staticpage.blade.php ENDPATH**/ ?>