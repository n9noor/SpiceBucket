@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Add Department
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="history.back()" title="Back" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-arrow-left btn-icon-wrapper"></i>Back
            </button>
        </div>
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="card-body">
        <form action="/administrator/save-role" method="post" class="form-horizontal">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="rolename" class="form-label">Name</label>
                        <input type="text" class="form-control" name="rolename" id="rolename" placeholder="Enter rolename" />
                        @error('rolename')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="parent" class="form-label">Parent</label>
                        <select class="form-control" name="parent" id="parent" placeholder="Enter Firstname">
                            <option value="0"></option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->rolename}}</option>
                            @endforeach
                        </select>
                        @error('parent')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Enter description"></textarea>
                        @error('description')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
			<fieldset>
				<legend>Permission</legend>
				<div class="row mb-3">
					<div class="col-md-3"><strong>Web Setting</strong></div>
					<div class="col-md-9">
						<label class="control-label mb-2">Vendor Required Document</label>
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[vendor-required-document-view]" value="1" id="permission-vendor-required-document-view">
								<input type="checkbox" id="vendor-required-document-view" checked="checked" autocomplete="off">
								<label class="control-label" for="vendor-required-document-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[vendor-required-document-add]" value="1" id="permission-vendor-required-document-add">
								<input type="checkbox" id="vendor-required-document-add" checked="checked" autocomplete="off">
								<label class="control-label" for="vendor-required-document-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[vendor-required-document-edit]" value="1" id="permission-vendor-required-document-edit">
								<input type="checkbox" id="vendor-required-document-edit" checked="checked" autocomplete="off">
								<label class="control-label" for="vendor-required-document-edit">Edit</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[vendor-required-document-delete]" value="1" id="permission-vendor-required-document-delete">
								<input type="checkbox" id="vendor-required-document-delete" checked="checked" autocomplete="off">
								<label class="control-label" for="vendor-required-document-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[vendor-required-document-active]" value="1" id="permission-vendor-required-document-active">
								<input type="checkbox" id="vendor-required-document-active" checked="checked" autocomplete="off">
								<label class="control-label" for="vendor-required-document-active">Active</label>
							</div>
						</div>
						<div class="clearfix mb-2"></div>
					</div>
				</div>
				<hr />
				<div class="row mb-3">
					<div class="col-md-3"><strong>Users</strong></div>
					<div class="col-md-9">
						<label class="control-label mb-2">List</label>
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[users-list-view]" value="1" id="permission-users-list-view">
								<input type="checkbox" id="users-list-view" checked="checked" autocomplete="off">
								<label class="control-label" for="users-list-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-list-add]" value="1" id="permission-users-list-add">
								<input type="checkbox" id="users-list-add" checked="checked" autocomplete="off">
								<label class="control-label" for="users-list-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-list-edit]" value="1" id="permission-users-list-edit">
								<input type="checkbox" id="users-list-edit" checked="checked" autocomplete="off">
								<label class="control-label" for="users-list-edit">Edit</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-list-delete]" value="1" id="permission-users-list-delete">
								<input type="checkbox" id="users-list-delete" checked="checked" autocomplete="off">
								<label class="control-label" for="users-list-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-list-active]" value="1" id="permission-users-list-active">
								<input type="checkbox" id="users-list-active" checked="checked" autocomplete="off">
								<label class="control-label" for="users-list-active">Active</label>
							</div>
						</div>
						<hr />
						<div class="clearfix mb-2"></div>
						<label class="control-label mb-2">Department</label>
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[users-department-view]" value="1" id="permission-users-department-view">
								<input type="checkbox" id="users-department-view" checked="checked" autocomplete="off">
								<label class="control-label" for="users-department-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-department-add]" value="1" id="permission-users-department-add">
								<input type="checkbox" id="users-department-add" checked="checked" autocomplete="off">
								<label class="control-label" for="users-department-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-department-edit]" value="1" id="permission-users-department-edit">
								<input type="checkbox" id="users-department-edit" checked="checked" autocomplete="off">
								<label class="control-label" for="users-department-edit">Edit</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-department-delete]" value="1" id="permission-users-department-delete">
								<input type="checkbox" id="users-department-delete" checked="checked" autocomplete="off">
								<label class="control-label" for="users-department-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-department-active]" value="1" id="permission-users-department-active">
								<input type="checkbox" id="users-department-active" checked="checked" autocomplete="off">
								<label class="control-label" for="users-department-active">Active</label>
							</div>
						</div>
					</div>
				</div>
				<hr />
				<div class="row mb-3">
					<div class="col-md-3"><strong>Seller</strong></div>
					<div class="col-md-9">
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[seller-view]" value="1" id="permission-seller-view">
								<input type="checkbox" id="seller-view" checked="checked" autocomplete="off">
								<label class="control-label" for="seller-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-add]" value="1" id="permission-seller-add">
								<input type="checkbox" id="seller-add" checked="checked" autocomplete="off">
								<label class="control-label" for="seller-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-edit]" value="1" id="permission-seller-edit">
								<input type="checkbox" id="seller-edit" checked="checked" autocomplete="off">
								<label class="control-label" for="seller-edit">View Details</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-delete]" value="1" id="permission-seller-delete">
								<input type="checkbox" id="seller-delete" checked="checked" autocomplete="off">
								<label class="control-label" for="seller-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-active]" value="1" id="permission-seller-active">
								<input type="checkbox" id="seller-active" checked="checked" autocomplete="off">
								<label class="control-label" for="seller-active">Active</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-approve]" value="1" id="permission-seller-approve">
								<input type="checkbox" id="seller-approve" checked="checked" autocomplete="off">
								<label class="control-label" for="seller-approve">Approval</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-gst-verify]" value="1" id="permission-seller-gst-verify">
								<input type="checkbox" id="seller-gst-verify" checked="checked" autocomplete="off">
								<label class="control-label" for="seller-gst-verify">Verify GST</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-qac-assignment]" value="1" id="permission-seller-qac-assignment">
								<input type="checkbox" id="seller-qac-assignment" checked="checked" autocomplete="off">
								<label class="control-label" for="seller-qac-assignment">QAC Assignment</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-tab-assignment]" value="1" id="permission-seller-tab-assignment">
								<input type="checkbox" id="seller-tab-assignment" checked="checked" autocomplete="off">
								<label class="control-label" for="seller-tab-assignment">Tab Assignment</label>
							</div>
						</div>
						<div class="clearfix mb-2"></div>
					</div>
				</div>
				<hr />
				<div class="row mb-3">
					<div class="col-md-3"><strong>Product Category</strong></div>
					<div class="col-md-9">
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[product-category-view]" value="1" id="permission-product-category-view">
								<input type="checkbox" id="product-category-view" checked="checked" autocomplete="off">
								<label class="control-label" for="product-category-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-category-add]" value="1" id="permission-product-category-add">
								<input type="checkbox" id="product-category-add" checked="checked" autocomplete="off">
								<label class="control-label" for="product-category-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-category-edit]" value="1" id="permission-product-category-edit">
								<input type="checkbox" id="product-category-edit" checked="checked" autocomplete="off">
								<label class="control-label" for="product-category-edit">View Details</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-category-delete]" value="1" id="permission-product-category-delete">
								<input type="checkbox" id="product-category-delete" checked="checked" autocomplete="off">
								<label class="control-label" for="product-category-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-category-active]" value="1" id="permission-product-category-active">
								<input type="checkbox" id="product-category-active" checked="checked" autocomplete="off">
								<label class="control-label" for="product-category-active">Active</label>
							</div>
						</div>
						<div class="clearfix mb-2"></div>
					</div>
				</div>
				<hr />
				<div class="row mb-3">
					<div class="col-md-3"><strong>Product</strong></div>
					<div class="col-md-9">
						<label class="control-label mb-2">List</label>
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[product-list-view]" value="1" id="permission-product-list-view">
								<input type="checkbox" id="product-list-view" checked="checked" autocomplete="off">
								<label class="control-label" for="product-list-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-list-add]" value="1" id="permission-product-list-add">
								<input type="checkbox" id="product-list-add" checked="checked" autocomplete="off">
								<label class="control-label" for="product-list-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-list-edit]" value="1" id="permission-product-list-edit">
								<input type="checkbox" id="product-list-edit" checked="checked" autocomplete="off">
								<label class="control-label" for="product-list-edit">View Detail</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-list-delete]" value="1" id="permission-product-list-delete">
								<input type="checkbox" id="product-list-delete" checked="checked" autocomplete="off">
								<label class="control-label" for="product-list-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-list-active]" value="1" id="permission-product-list-active">
								<input type="checkbox" id="product-list-active" checked="checked" autocomplete="off">
								<label class="control-label" for="product-list-active">Active</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-list-approve]" value="1" id="permission-product-list-approve">
								<input type="checkbox" id="product-list-approve" checked="checked" autocomplete="off">
								<label class="control-label" for="product-list-approve">Approve</label>
							</div>
						</div>
						<hr />
						<div class="clearfix mb-2"></div>
						<label class="control-label mb-2">Variant</label>
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[variant-view]" value="1" id="permission-variant-view">
								<input type="checkbox" id="variant-view" checked="checked" autocomplete="off">
								<label class="control-label" for="variant-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[variant-add]" value="1" id="permission-variant-add">
								<input type="checkbox" id="variant-add" checked="checked" autocomplete="off">
								<label class="control-label" for="variant-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[variant-edit]" value="1" id="permission-variant-edit">
								<input type="checkbox" id="variant-edit" checked="checked" autocomplete="off">
								<label class="control-label" for="variant-edit">Edit</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[variant-delete]" value="1" id="permission-variant-delete">
								<input type="checkbox" id="variant-delete" checked="checked" autocomplete="off">
								<label class="control-label" for="variant-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[variant-active]" value="1" id="permission-variant-active">
								<input type="checkbox" id="variant-active" checked="checked" autocomplete="off">
								<label class="control-label" for="variant-active">Active</label>
							</div>
						</div>
					</div>
				</div>
				<hr />
				<div class="row mb-3">
					<div class="col-md-3"><strong>Report</strong></div>
					<div class="col-md-9">
						<label class="control-label mb-2">Order Details</label>
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[order-details-report-view]" value="1" id="permission-order-details-report-view">
								<input type="checkbox" id="order-details-report-view" checked="checked" autocomplete="off">
								<label class="control-label" for="order-details-report-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[order-single-report-view]" value="1" id="permission-order-single-report-view">
								<input type="checkbox" id="order-single-report-view" checked="checked" autocomplete="off">
								<label class="control-label" for="order-single-report-view">View Detail</label>
							</div>
						</div>
						<hr />
						<div class="clearfix mb-2"></div>
						<label class="control-label mb-2">Invoice Tax Details</label>
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[invoice-tax-view]" value="1" id="permission-invoice-tax-view">
								<input type="checkbox" id="invoice-tax-view" checked="checked" autocomplete="off">
								<label class="control-label" for="invoice-tax-view">View</label>
							</div>
						</div>
						<hr />
						<div class="clearfix mb-2"></div>
						<label class="control-label mb-2">Sale Summary</label>
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[sale-summary-view]" value="1" id="permission-sale-summary-view">
								<input type="checkbox" id="sale-summary-view" checked="checked" autocomplete="off">
								<label class="control-label" for="sale-summary-view">View</label>
							</div>
						</div>
					</div>
				</div>
				<hr />
				<div class="row mb-3">
					<div class="col-md-3"><strong>Order</strong></div>
					<div class="col-md-9">
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[order-details-view]" value="1" id="permission-order-details-view">
								<input type="checkbox" id="order-details-view" checked="checked" autocomplete="off">
								<label class="control-label" for="order-details-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[order-single-view]" value="1" id="permission-order-single-view">
								<input type="checkbox" id="order-single-view" checked="checked" autocomplete="off">
								<label class="control-label" for="order-single-view">View Detail</label>
							</div>
						</div>
						<div class="clearfix mb-2"></div>
					</div>
				</div>
				<hr />
				<div class="row mb-3">
					<div class="col-md-3"><strong>Customer</strong></div>
					<div class="col-md-9">
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[customer-view]" value="1" id="permission-customer-view">
								<input type="checkbox" id="customer-view" checked="checked" autocomplete="off">
								<label class="control-label" for="customer-view">View</label>
							</div>
						</div>
						<div class="clearfix mb-2"></div>
					</div>
				</div>
				<hr />
				<div class="row mb-3">
					<div class="col-md-3"><strong>Offers</strong></div>
					<div class="col-md-9">
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[offer-view]" value="1" id="permission-offer-view">
								<input type="checkbox" id="offer-view" checked="checked" autocomplete="off">
								<label class="control-label" for="offer-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[offer-add]" value="1" id="permission-offer-add">
								<input type="checkbox" id="offer-add" checked="checked" autocomplete="off">
								<label class="control-label" for="offer-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[offer-edit]" value="1" id="permission-offer-edit">
								<input type="checkbox" id="offer-edit" checked="checked" autocomplete="off">
								<label class="control-label" for="offer-edit">Edit</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[offer-delete]" value="1" id="permission-offer-delete">
								<input type="checkbox" id="offer-delete" checked="checked" autocomplete="off">
								<label class="control-label" for="offer-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[offer-active]" value="1" id="permission-offer-active">
								<input type="checkbox" id="offer-active" checked="checked" autocomplete="off">
								<label class="control-label" for="offer-active">Active</label>
							</div>
						</div>
						<div class="clearfix mb-2"></div>
					</div>
				</div>
				<hr />
				<div class="row mb-3">
					<div class="col-md-3"><strong>Discount Coupon</strong></div>
					<div class="col-md-9">
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[discount-coupon-view]" value="1" id="permission-discount-coupon-view">
								<input type="checkbox" id="discount-coupon-view" checked="checked" autocomplete="off">
								<label class="control-label" for="discount-coupon-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[discount-coupon-add]" value="1" id="permission-discount-coupon-add">
								<input type="checkbox" id="discount-coupon-add" checked="checked" autocomplete="off">
								<label class="control-label" for="discount-coupon-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[discount-coupon-delete]" value="1" id="permission-discount-coupon-delete">
								<input type="checkbox" id="discount-coupon-delete" checked="checked" autocomplete="off">
								<label class="control-label" for="discount-coupon-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[discount-coupon-active]" value="1" id="permission-discount-coupon-active">
								<input type="checkbox" id="discount-coupon-active" checked="checked" autocomplete="off">
								<label class="control-label" for="discount-coupon-active">Active</label>
							</div>
						</div>
						<div class="clearfix mb-2"></div>
					</div>
				</div>
				<hr />
				<div class="row mb-3">
					<div class="col-md-3"><strong>Static Page</strong></div>
					<div class="col-md-9">
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[static-page-view]" value="1" id="permission-static-page-view">
								<input type="checkbox" id="static-page-view" checked="checked" autocomplete="off">
								<label class="control-label" for="static-page-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[static-page-add]" value="1" id="permission-static-page-add">
								<input type="checkbox" id="static-page-add" checked="checked" autocomplete="off">
								<label class="control-label" for="static-page-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[static-page-edit]" value="1" id="permission-static-page-edit">
								<input type="checkbox" id="static-page-edit" checked="checked" autocomplete="off">
								<label class="control-label" for="static-page-edit">Edit</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[static-page-active]" value="1" id="permission-static-page-active">
								<input type="checkbox" id="static-page-active" checked="checked" autocomplete="off">
								<label class="control-label" for="static-page-active">Active</label>
							</div>
						</div>
						<div class="clearfix mb-2"></div>
					</div>
				</div>
				<hr />
				<div class="row mb-3">
					<div class="col-md-3"><strong>FAQs</strong></div>
					<div class="col-md-9">
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[faq-view]" value="1" id="permission-faq-view">
								<input type="checkbox" id="faq-view" checked="checked" autocomplete="off">
								<label class="control-label" for="faq-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[faq-add]" value="1" id="permission-faq-add">
								<input type="checkbox" id="faq-add" checked="checked" autocomplete="off">
								<label class="control-label" for="faq-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[faq-edit]" value="1" id="permission-faq-edit">
								<input type="checkbox" id="faq-edit" checked="checked" autocomplete="off">
								<label class="control-label" for="faq-edit">Edit</label>
							</div>
						</div>
						<div class="clearfix mb-2"></div>
					</div>
				</div>
				<hr />
			</fieldset>
            <button class="mt-1 btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
@push('javascripts')
<script>
$(document).ready(function(){
	$('input[type="checkbox"]').change(function(){
		if($(this).is(":checked")){
			$(this).val(1);
		} else {
			$(this).val(0);
		}
	});
});
</script>
@endpush