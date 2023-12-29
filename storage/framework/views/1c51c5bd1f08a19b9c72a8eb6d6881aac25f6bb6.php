
<?php $__env->startSection("content"); ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
               <?php echo e((!empty(@$data['res']->id)) ?'Edit' : 'Add'); ?> Mail Template
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="history.back()" title="Back" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-arrow-left btn-icon-wrapper"></i> Back
            </button>
        </div>
    </div>
</div>
<form action="/administrator/mail/save" method="post" class="form-horizontal">
    <?php echo csrf_field(); ?>
    <!-- Alert message (start) -->
      <?php if(Session::has('message')): ?>
      <div class="alert <?php echo e(Session::get('alert-class')); ?>">
         <?php echo e(Session::get('message')); ?>

      </div>
      <?php endif; ?>  
      <input type="hidden" name="id" value="<?php echo e(@$data['id']); ?>">
    <div class="main-card mb-3 card">
        <div class="card-header">Mail Information</div>
        <div class="card-body">
            <div class="row">

                <div class="form-group col-md-6">
                    <label for="title" class="col-form-label">Title<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="title" id="title"  value="<?php echo e(@$data['res']->title); ?>">
                        <?php if($errors->has('title')): ?>
                            <span class="text-danger"><?php echo e($errors->first('title')); ?></span>
                        <?php endif; ?>
                </div>

                <div class="form-group col-md-6">
                    <label for="subject" class="col-form-label">Subject<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="subject" id="subject"  value="<?php echo e(@$data['res']->subject); ?>">
                        <?php if($errors->has('subject')): ?>
                            <span class="text-danger"><?php echo e($errors->first('subject')); ?></span>
                        <?php endif; ?>
                </div>
                <div class="form-group col-md-6" >
                    <label for="sent_to" class="col-form-label">Sent Email(Reciver Email )<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sent_to" id="sent_to"  value="<?php echo e(@$data['res']->sent_to); ?>">
                    <?php if($errors->has('sent_to')): ?>
                        <span class="text-danger"><?php echo e($errors->first('sent_to')); ?></span>
                    <?php endif; ?>

                    
                </div>
                <div class="form-group col-md-6">
                    <label for="from_name" class="col-form-label">From Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="from_name" id="from_name"  value="<?php echo e(@$data['res']->from_name); ?>">
                    <?php if($errors->has('from_name')): ?>
                        <span class="text-danger"><?php echo e($errors->first('from_name')); ?></span>
                    <?php endif; ?>
                    
                    
                </div>
                <div class="form-group col-md-6">
                    <label for="from_email" class="col-form-label">From Email<span class="text-danger">*</span></label>
                   
                     <input type="text" class="form-control" name="from_email" id="from_email"  value="<?php echo e(@$data['res']->from_email); ?>">
                    <?php if($errors->has('from_email')): ?>
                        <span class="text-danger"><?php echo e($errors->first('from_email')); ?></span>
                    <?php endif; ?>
                    
                </div>

                 <div class="form-group col-md-6" style="display:none">
                    <label for="reply_to" class="col-form-label">Reply From Email<span class="text-danger">*</span></label>
                   
                      <input type="text" class="form-control" name="reply_from" id="reply_from"  value="<?php echo env('MAIL_REPLY_TO'); ?>">
                        <?php if($errors->has('reply_from')): ?>
                            <span class="text-danger"><?php echo e($errors->first('reply_from')); ?></span>
                        <?php endif; ?>
                    
                </div>
                <div class="form-group col-md-6">
                    <label for="is_active" class="col-form-label">Status<span class="text-danger">*</span></label>
                   
                        <select name="is_active" placeholder="" class="form-control">
                            <option value="1" 
                                <?php echo e(old('is_active',@$data['res']->is_active)==1 ? 'selected' : ''); ?>

                          >Active</option>
                           <option value="0" 
                                <?php echo e(old('is_active',@$data['res']->is_active)==0 ? 'selected' : ''); ?>

                          >In-Active</option> 

                      
                        </select>
                </div>


               
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="message" class="col-form-label">Mail Content <span class="text-danger">*</span></label>
                    <br>Variables: <?php echo e(@$data['res']->variables); ?>

                    <textarea class="ckeditor form-control" cols="80" name="message" id="message" rows="10"><?php echo e(@$data['res']->message); ?></textarea>

                    <?php if($errors->has('message')): ?>
                        <span class="text-danger"><?php echo e($errors->first('message')); ?></span>
                    <?php endif; ?>
                    
            </div>    
             
        </div>
    </div>
    
    <button class="mt-1 mb-3 btn btn-primary">Save</button>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('externalJavascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/select2/dist/js/select2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/@chenfengyuan/datepicker/dist/datepicker.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('javascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/js/coupon.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/ckeditor/ckeditor.js')); ?>"></script>
<script type="text/javascript">
CKEDITOR.replace('message', {
     allowedContent: true,
    enterMode: CKEDITOR.ENTER_BR
});
</script>
<?php $__env->stopPush(); ?>  
<?php $__env->startPush('stylesheets'); ?>
<link href="<?php echo e(asset('/backend/summernote/summernote-lite.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('externalJavascripts'); ?>
<script src="<?php echo e(asset('/backend/summernote/summernote-lite.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts'); ?>
<script>
    $('#coupon_description').summernote({
        height: 300,
        minHeight: null,
        maxHeight: null,
        dialogsInBody: true
    });
</script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/admin/mail/add.blade.php ENDPATH**/ ?>