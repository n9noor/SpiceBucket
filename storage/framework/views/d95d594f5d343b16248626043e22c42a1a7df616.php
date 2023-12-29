
<?php $__env->startSection("content"); ?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Pages
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="window.location.href='/administrator/add-static-page'" title="Add New Page" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-plus btn-icon-wrapper"></i>Add Page
            </button>
        </div>
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Active</th>
                        <th>Title</th>
                        <th>Slug</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/administrator/edit-static-pages/header"><i class="btn-icon-wrapper fa fa-user"></i>Edit Page</a>
                        </td>
                        <td><input data-column="is_active" data-type="static_pages" data-id="" type="checkbox" data-toggle="toggle" data-on="Active" data-off="active" data-onstyle="success" data-offstyle="danger"></td>
                        <td>Header</td>
                        <td>header</td>
                    </tr>
                    <tr>
                        <td>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/administrator/edit-static-pages/home"><i class="btn-icon-wrapper fa fa-user"></i>Edit Page</a>
                        </td>
                        <td><input data-column="is_active" data-type="static_pages" data-id="" type="checkbox" data-toggle="toggle" data-on="Active" data-off="active" data-onstyle="success" data-offstyle="danger"></td>
                        <td>Home</td>
                        <td>home</td>
                    </tr>
                    <tr>
                        <td>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/administrator/edit-static-pages/mobile-app-home-page"><i class="btn-icon-wrapper fa fa-user"></i>Edit Page</a>
                        </td>
                        <td><input data-column="is_active" data-type="static_pages" data-id="" type="checkbox" data-toggle="toggle" data-on="Active" data-off="active" data-onstyle="success" data-offstyle="danger"></td>
                        <td>Mobile App Home Page</td>
                        <td>mobile-app-home</td>
                    </tr>
                    <tr>
                        <td>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/administrator/edit-static-pages/footer"><i class="btn-icon-wrapper fa fa-user"></i>Edit Page</a>
                        </td>
                        <td><input data-column="is_active" data-type="static_pages" data-id="" type="checkbox" data-toggle="toggle" data-on="Active" data-off="active" data-onstyle="success" data-offstyle="danger"></td>
                        <td>Footer</td>
                        <td>footer</td>
                    </tr>
                    <tr>
                        <td>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/administrator/edit-static-pages/contact-us"><i class="btn-icon-wrapper fa fa-user"></i>Edit Page</a>
                        </td>
                        <td><input data-column="is_active" data-type="static_pages" data-id="" type="checkbox" data-toggle="toggle" data-on="Active" data-off="active" data-onstyle="success" data-offstyle="danger"></td>
                        <td>Contact Us</td>
                        <td>contact-us</td>
                    </tr>
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/administrator/edit-static-page/<?php echo e($page->id); ?>"><i class="btn-icon-wrapper fa fa-user"></i>Edit Page</a>
                        </td>
                        <td><input data-column="is_active" data-type="static_pages" data-id="<?php echo e($page->id); ?>" type="checkbox" <?php echo e($page->is_active == true ? " checked='checked'" : ""); ?> data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger"></td>
                        <td><?php echo e($page->title); ?></td>
                        <td><?php echo e($page->url); ?></td>
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
<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/staticpage/index.blade.php ENDPATH**/ ?>