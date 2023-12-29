
<?php $__env->startSection("content"); ?>

<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> FAQ
            </div>
        </div>
    </div>
    <div class="container">
        <section class="mt-60 mb-60">
            <div class="ck-content">
                <div>
                    <div class="faqs-list">
                        <h4>Frequenty Asked Questions</h4>
                        <div id="faq-accordion-0" class="accordion">
                            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card">
                                <div id="heading-faq-0-<?php echo e($faq->id); ?>" class="card-header">
                                    <h2 class="mb-0"  ><button type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-0-<?php echo e($faq->id); ?>"  aria-expanded="false" aria-controls="collapse-faq-0-<?php echo e($faq->id); ?>" class="btn-link btn-block text-left collapsed"><?php echo e($faq->question); ?></button></h2>
                                </div>
                                <div id="collapse-faq-0-<?php echo e($faq->id); ?>" aria-labelledby="heading-faq-0-<?php echo e($faq->id); ?>" data-parent="#faq-accordion-0" class="collapse">
                                    <div class="card-body"><?php echo e($faq->answer); ?></div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>


<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/faq.blade.php ENDPATH**/ ?>