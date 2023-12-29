
<?php $__env->startSection("content"); ?>
<div class="app-page-title">
<div class="page-title-wrapper">
<div class="page-title-heading">
<div class="page-title-icon">
<i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
</div>
<div>
Roles
<div class="page-title-subheading">&nbsp;</div>
</div>
</div>
<div class="page-title-actions">
<button type="button" onclick="window.location.href='/sellers/add-role'" title="Add New Role" class="btn-icon btn-shadow me-3 btn btn-dark">
<i class="fa fa-plus btn-icon-wrapper"></i>Add Role
</button>
</div>
</div>
</div>
<div class="main-card mb-3 card">
<div class="g-0 row pt-3 pb-2 px-3">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead><tr><th>#</th><th>Name</th><th>Description</th></tr></thead>
<tbody>
<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td>
<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/sellers/edit-role/<?php echo e($role->id); ?>"><i class="btn-icon-wrapper fa fa-user"></i>Edit Role</a>
<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="/sellers/delete-role/<?php echo e($role->id); ?>"><i class="btn-icon-wrapper fa fa-trash"></i>Delete Role</a>
</td>
<td><?php echo e($role->rolename); ?></td>
<td><?php echo e($role->description); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/roles/vendor_list.blade.php ENDPATH**/ ?>