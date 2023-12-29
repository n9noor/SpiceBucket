
<?php $__env->startSection("content"); ?>
 
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Product
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <?php if(session('admin-logged-in') == true): ?>
            <button type="button" onclick="$('#variant_value_id').val(0);$('#variant_id').val('');$('#variant_value').val('');" data-bs-toggle="modal" data-bs-target="#add-variant-value-modal" title="Add Variant Value" class="btn-icon btn-shadow me-3 btn btn-dark"><i class="fa fa-plus btn-icon-wrapper"></i> Add Variant Value
            </button>
            <button type="button" onclick="$('#variant_type_id').val(0);$('#variant_type').val('');" data-bs-toggle="modal" data-bs-target="#add-variant-type-modal" title="Add Variant Type" class="btn-icon btn-shadow me-3 btn btn-dark"><i class="fa fa-plus btn-icon-wrapper"></i> Add Variant Type
            </button>
            <?php elseif(session('vendor-logged-in') == true): ?>
            <button type="button" onclick="window.location.href='/products/add-product'" title="Add Product" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-plus btn-icon-wrapper"></i> Add Product
            </button>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a data-bs-toggle="tab" href="#tab-content-product" class="border-0 btn-pill btn-wide btn-transition active btn btn-outline-danger">Product</a>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="tab" href="#tab-content-variant" class="border-0 btn-pill btn-wide btn-transition btn btn-outline-danger">Variant</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-content-product" role="tabpanel">
                <form method="post" id="product-search-frm" class="form-horizontal mx-2">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
								<label for="category" class="form-label">Select Date:</label><br>
                                <button type="button" class="btn btn-primary" id="daterange" style="width: 100%;">
                                    <i class="fa fa-calendar pe-1"></i>
                                    <span></span>
                                    <i class="fa ps-1 fa-caret-down"></i>
                                </button>
                                <input type="hidden" class="form-control" name="fromdate" id="fromdate" placeholder="Enter From Date" value="<?php echo e(old('formdate')); ?>">
                                <input type="hidden" class="form-control" name="todate" id="todate" placeholder="Enter to date" value="<?php echo e(old('todate')); ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative mb-3">
                                <label for="category" class="form-label">Category:</label>
                                <select class="form-control" name="category" id="category">
                                    <option value="">Choose Category</option>
                                    <?php $__currentLoopData = $maincategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category') == $category->id ? "selected='selected'":""); ?>><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative mb-3">
                                <label for="name" class="form-label">Seller Name:</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Seller Name" value="<?php echo e(old('name')); ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative mb-3">
                                <label for="approve_status" class="form-label">Approve Status:</label>
                                <select class="form-control" name="approve_status" id="approve_status">
                                    <option value="">Select Status</option>
                                    <option value="approved" <?php echo e(old('approve_status') == 'approved' ? "selected='selected'":""); ?>>Approved</option>
                                    <option value="disapproved" <?php echo e(old('approve_status') == 'disapproved' ? "selected='selected'":""); ?>>Disapproved</option>
                                    <option value="pending" <?php echo e(old('approve_status') == 'pending' ? "selected='selected'":""); ?>>Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="position-relative mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">Product Status</option>
                                    <option value="active" <?php echo e(old('status') == 'active' ? "selected='selected'":""); ?>>Active</option>
                                    <option value="inactive" <?php echo e(old('status') == 'inactive' ? "selected='selected'":""); ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1 mt-4">
                            <button type="submit" name="search-product" id="search-product" class="btn btn-secondary">Search</button>
                        </div>
                    </div>
                </form>
                <?php if(Session::get('vendor-logged-in') == true || (Session::get('admin-logged-in') == true && Session::get('admin-loggedin-property')['product-list-view'] == 1)): ?>
                <div class="table-responsive">
                    <table id="products-table" class="table table-bordered table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="no-sort">#</th>
                                <th class="no-sort">Active</th>
                                <th class="no-sort">Approved</th>
                                <?php if(session('admin-logged-in') == true): ?>
                                <th>Seller</th>
                                <?php endif; ?>
                                <th class="default-sort">Name</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td nowrap="">
                                    <?php if(session('vendor-logged-in') == true): ?>
                                    <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/products/edit-product/<?php echo e($product->id); ?>"><i class="btn-icon-wrapper fa fa-edit"></i></a>
                                    <?php endif; ?>
                                    <?php if(Session::get('admin-logged-in') == true && Session::get('admin-loggedin-property')['product-list-edit'] == 1): ?>
                                    <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="/products/view-product/<?php echo e($product->id); ?>"><i class="btn-icon-wrapper fa fa-edit"></i></a>
                                    <?php endif; ?>
                                    <a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" href="/products/delete-product/<?php echo e($product->id); ?>"><i class="btn-icon-wrapper fa fa-trash"></i></a>


                                    <a target="_blank" class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-warning" href="/products/view-live-product/<?php echo e($product->id); ?>"><i class="btn-icon-wrapper fa fa-eye"></i></a>
                                </td>
                                <td><input data-column="is_active" data-type="product" data-id="<?php echo e($product->id); ?>" type="checkbox" <?php echo e($product->is_active == true ? " checked='checked'" : ""); ?> data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger"></td>
                                <?php if(session('admin-logged-in') == true && Session::get('admin-loggedin-property')['product-list-approve'] == 1): ?>
                                <?php if($product->is_approved == 0): ?>
                                <td>

                                    <a data-id='<?php echo e($product->id); ?>' class="btn-icon btn-shadow btn-outline-2x btn btn-outline-success product-approve" href="javascript:void(0)"><i class="fa fa-check"></i></a>
                                    <a onclick="$('#product').val(<?php echo e($product->id); ?>);" data-bs-toggle="modal" data-bs-target="#decline-comment-modal" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-danger product-not-approve" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                                </td>
                                <?php elseif($product->is_approved == 1): ?>
                                <td>
                                    <div class="badge bg-success">Approved</div>
                                </td>
                                <?php elseif($product->is_approved == 2): ?>
                                <td>
                                    <div class="badge bg-danger">Disapproved</div>
                                </td>
                                <?php endif; ?>
                                <?php else: ?>
                                <?php if($product->is_approved == 1): ?>
                                <td>
                                    <div class="badge bg-success">Approved</div>
                                </td>
                                <?php elseif($product->is_approved == 2): ?>
                                <td>
                                    <div class="badge bg-danger">Disapproved</div>
                                </td>
                                <?php else: ?>
                                <td>
                                    <div class="badge bg-warning">Pending</div>
                                </td>
                                <?php endif; ?>
                                <?php endif; ?>
                                <?php if(session('admin-logged-in') == true): ?>
                                <td nowrap=""><?php echo e($product->vendor); ?></td>
                                <?php endif; ?>
                                <td><?php echo e($product->name); ?></td>
                                <td><?php echo e($product->categoryname); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="tab-pane" id="tab-content-variant" role="tabpanel">
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item">
                        <a data-bs-toggle="tab" href="#tab-variant-type" class="nav-link active">Type</a>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="tab" href="#tab-variant-value" class="nav-link">Values</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-variant-type" role="tabpanel">
                        <div class="table-responsive">
                            <table id="product-variant-type-table" class="table table-striped table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="no-sort">#</th>
                                        <th class="no-sort">Active</th>
                                        <th class="default-sort">Variant Type Name</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-variant-value" role="tabpanel">
                        <div class="table-responsive">
                            <table id="product-variant-value-table" class="table table-striped table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="no-sort">#</th>
                                        <th class="no-sort">Active</th>
                                        <th class="default-sort">Variant Type Name</th>
                                        <th>Variant Type Value</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('stylesheets'); ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/vendors/datatables.net-buttons/css/bootstrap4.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('externalJavascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/bootstrap-table/dist/bootstrap-table.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/vfs_fonts.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/datatables.net-buttons/js/pdfmake.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/moment/moment.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/@chenfengyuan/datepicker/dist/datepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/daterangepicker/daterangepicker.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('javascripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('backend/vendors/select2/dist/js/select2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/product-variant.js')); ?>"></script>

<div class="modal" id="add-variant-type-modal" tabindex="-1" role="dialog" aria-labelledby="add-variant-type-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-variant-type-modal-label">Variant Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="variant_type_id" id="variant_type_id" />
                <div class="position-relative mb-3">
                    <label for="variant_type" class="form-label">Variant Type</label>
                    <input type="text" class="form-control" name="variant_type" id="variant_type" placeholder="Enter variant type" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="save-variant-type" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="add-variant-value-modal" tabindex="-1" role="dialog" aria-labelledby="add-variant-value-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-variant-value-modal-label">Variant Value</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="variant_value_id" id="variant_value_id" />
                <div class="position-relative mb-3">
                    <label for="variant_id" class="form-label">Variant Type</label>
                    <select class="multiselect-dropdown form-control" name="variant_id" id="variant_id"></select>
                </div>
                <div class="position-relative mb-3">
                    <label for="variant_value" class="form-label">Variant value</label>
                    <input type="text" class="form-control" name="variant_value" id="variant_value" placeholder="Enter variant value" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="save-variant-value" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="decline-comment-modal" tabindex="-1" role="dialog" aria-labelledby="decline-comment-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="decline-comment-modal-title">Decline Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="product" id="product" />
                <div class="position-relative mb-3">
                    <label for="comment" class="form-label">Comment for Decline</label>
                    <textarea class="form-control" name="comment" id="comment" placeholder="Enter Decline Comment"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="save-decline-comment" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopPush(); ?>
<?php echo $__env->make("wms.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/products/list.blade.php ENDPATH**/ ?>