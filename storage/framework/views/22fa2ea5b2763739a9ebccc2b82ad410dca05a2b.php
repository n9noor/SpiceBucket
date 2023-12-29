
<?php $__env->startSection("content"); ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Message Manager
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="window.location.href='/administrator/message/add'" title="Add Message" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-plus btn-icon-wrapper"></i> Add Message
            </button>
        </div>
    </div>
</div>
<?php if(Session::has('message')): ?>
<div class="alert alert-success"><?php echo e(Session::get('message')); ?></div>
<?php endif; ?>

<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Sl.no</th>

                        <th class="text-center">Subject</th>
                        <th class="text-center">Message</th>
                         
                         <th class="text-center">Status</th> 
                         <th class="text-center">Action</th> 
                         
                    </tr>
                </thead>
                <tbody> 
                    
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        
                       
                        <td nowrap class="text-center"><strong><?php echo e($key+1); ?></strong></td>
                        <td nowrap class="text-center"><strong><?php echo e($message->subject); ?></strong></td>
                        <td nowrap class="text-center"><strong><?php echo e(substr($message->message, 0, 100)); ?>..</strong></td>
                        <td nowrap class="text-center"><strong><?php echo e($message->is_active?'Active':'In-Active'); ?></strong></td>
                        <td nowrap class="text-center delete-button">
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="/administrator/message/<?php echo e(md5($message->id)); ?>/edit"><i class="btn-icon-wrapper fa fa-edit"></i></a>
                        </td>  
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

 <?php $__env->stopSection(); ?>

<?php $__env->startPush('externalJavascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js')); ?>"></script>
 
<?php $__env->stopPush(); ?>
<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/admin/message/index.blade.php ENDPATH**/ ?>