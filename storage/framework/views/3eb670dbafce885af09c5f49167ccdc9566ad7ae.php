
<?php $__env->startSection("content"); ?>


<main id="main-section" class="main ">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <div class="breadcrumb-item d-inline-block"><a href="/" title="Home"> Home </a></div><span></span>
                <div class="breadcrumb-item d-inline-block active">
                    <div itemprop="item"> Our Seller </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        
       
        <section class="mt-10">
            <div class="container">
                <div class="row">
                    <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-2 col-lg-2">
                        <div class="contact-info-section">
                            <?php $imagearray=array('path_folder'=>'/images/vendors/','image'=>$vendor->image,'size'=>[150,150]);
                               
                            ?> 
                             <a href="/brand/<?php echo e($vendor->slug); ?>">
                             <img class="default-img" src="<?php echo e(ImageRender($imagearray)); ?>" alt="<?php echo e($vendor->vendor_alias); ?>"> 

                            </a>
                            <p> <a href="/brand/<?php echo e($vendor->slug); ?>"><?php echo e($vendor->vendor_alias); ?></a></p>
                            
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </div>
            </div>
        </section>
        <section id="contact-bottom-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 pl0">
                        <div class="contact-bottom-f-text">
                            <h4>Need to Contact Spice Bucket Seller Support Team</h4>
                            <p><strong>Email us</strong>:- <a href="mailto:sellersupport@spicebucket.com">sellersupport@spicebucket.com</a></p>
                            <p><strong>Call us</strong>:- <a href="tel:+91 7247247070">+91 7247247070</a></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-footer-right">
                            <img src="/assets/imgs/left-image-seller.png" alt="Contact Us">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <p></p>
    </div>

    </div>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/our_sellers.blade.php ENDPATH**/ ?>