@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Edit Role
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
        <form action="/administrator/update-role/{{$role->id}}" method="post" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="rolename" class="form-label">Name</label>
                        <input type="text" class="form-control" name="rolename" id="rolename" placeholder="Enter rolename" value="{{$role->rolename}}" />
                        @error('rolename')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="parent" class="form-label">Parent</label>
                        <select class="form-control" disabled name="parent" id="parent" placeholder="Enter Firstname">
                            <option value="0"></option>
                            @foreach($roles as $selectrole)
                            <option value="{{$selectrole->id}}" {{$role->parent == $selectrole->id ? "selected='selected'" : ""}}>{{$role->rolename}}</option>
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
                        <textarea class="form-control" name="description" id="description" placeholder="Enter description">{{$role->description}}</textarea>
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
								<input type="hidden" name="permission[vendor-required-document-view]" value="{{$permission['vendor-required-document-view']}}" id="permission-vendor-required-document-view">
								<input type="checkbox" id="vendor-required-document-view" autocomplete="off">
								<label class="control-label" for="vendor-required-document-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[vendor-required-document-add]" value="{{$permission['vendor-required-document-add']}}" id="permission-vendor-required-document-add">
								<input type="checkbox" id="vendor-required-document-add" autocomplete="off">
								<label class="control-label" for="vendor-required-document-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[vendor-required-document-edit]" value="{{$permission['vendor-required-document-edit']}}" id="permission-vendor-required-document-edit">
								<input type="checkbox" id="vendor-required-document-edit" autocomplete="off">
								<label class="control-label" for="vendor-required-document-edit">Edit</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[vendor-required-document-delete]" value="{{$permission['vendor-required-document-delete']}}" id="permission-vendor-required-document-delete">
								<input type="checkbox" id="vendor-required-document-delete" autocomplete="off">
								<label class="control-label" for="vendor-required-document-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[vendor-required-document-active]" value="{{$permission['vendor-required-document-active']}}" id="permission-vendor-required-document-active">
								<input type="checkbox" id="vendor-required-document-active" autocomplete="off">
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
								<input type="hidden" name="permission[users-list-view]" value="{{$permission['users-list-view']}}" id="permission-users-list-view">
								<input type="checkbox" id="users-list-view" autocomplete="off">
								<label class="control-label" for="users-list-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-list-add]" value="{{$permission['users-list-add']}}" id="permission-users-list-add">
								<input type="checkbox" id="users-list-add" autocomplete="off">
								<label class="control-label" for="users-list-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-list-edit]" value="{{$permission['users-list-edit']}}" id="permission-users-list-edit">
								<input type="checkbox" id="users-list-edit" autocomplete="off">
								<label class="control-label" for="users-list-edit">Edit</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-list-delete]" value="{{$permission['users-list-delete']}}" id="permission-users-list-delete">
								<input type="checkbox" id="users-list-delete" autocomplete="off">
								<label class="control-label" for="users-list-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-list-active]" value="{{$permission['users-list-active']}}" id="permission-users-list-active">
								<input type="checkbox" id="users-list-active" autocomplete="off">
								<label class="control-label" for="users-list-active">Active</label>
							</div>
						</div>
						<hr />
						<div class="clearfix mb-2"></div>
						<label class="control-label mb-2">Department</label>
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[users-department-view]" value="{{$permission['users-department-view']}}" id="permission-users-department-view">
								<input type="checkbox" id="users-department-view" autocomplete="off">
								<label class="control-label" for="users-department-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-department-add]" value="{{$permission['users-department-add']}}" id="permission-users-department-add">
								<input type="checkbox" id="users-department-add" autocomplete="off">
								<label class="control-label" for="users-department-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-department-edit]" value="{{$permission['users-department-edit']}}" id="permission-users-department-edit">
								<input type="checkbox" id="users-department-edit" autocomplete="off">
								<label class="control-label" for="users-department-edit">Edit</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-department-delete]" value="{{$permission['users-department-delete']}}" id="permission-users-department-delete">
								<input type="checkbox" id="users-department-delete" autocomplete="off">
								<label class="control-label" for="users-department-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[users-department-active]" value="{{$permission['users-department-active']}}" id="permission-users-department-active">
								<input type="checkbox" id="users-department-active" autocomplete="off">
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
								<input type="hidden" name="permission[seller-view]" value="{{$permission['seller-view']}}" id="permission-seller-view">
								<input type="checkbox" id="seller-view" autocomplete="off">
								<label class="control-label" for="seller-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-add]" value="{{$permission['seller-add']}}" id="permission-seller-add">
								<input type="checkbox" id="seller-add" autocomplete="off">
								<label class="control-label" for="seller-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-edit]" value="{{$permission['seller-edit']}}" id="permission-seller-edit">
								<input type="checkbox" id="seller-edit" autocomplete="off">
								<label class="control-label" for="seller-edit">View Details</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-delete]" value="{{$permission['seller-delete']}}" id="permission-seller-delete">
								<input type="checkbox" id="seller-delete" autocomplete="off">
								<label class="control-label" for="seller-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-active]" value="{{$permission['seller-active']}}" id="permission-seller-active">
								<input type="checkbox" id="seller-active" autocomplete="off">
								<label class="control-label" for="seller-active">Active</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-approve]" value="{{$permission['seller-approve']}}" id="permission-seller-approve">
								<input type="checkbox" id="seller-approve" autocomplete="off">
								<label class="control-label" for="seller-approve">Approval</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-gst-verify]" value="{{$permission['seller-gst-verify']}}" id="permission-seller-gst-verify">
								<input type="checkbox" id="seller-gst-verify" autocomplete="off">
								<label class="control-label" for="seller-gst-verify">Verify GST</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-qac-assignment]" value="{{$permission['seller-qac-assignment']}}" id="permission-seller-qac-assignment">
								<input type="checkbox" id="seller-qac-assignment" autocomplete="off">
								<label class="control-label" for="seller-qac-assignment">QAC Assignment</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[seller-tab-assignment]" value="{{$permission['seller-tab-assignment']}}" id="permission-seller-tab-assignment">
								<input type="checkbox" id="seller-tab-assignment" autocomplete="off">
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
								<input type="hidden" name="permission[product-category-view]" value="{{$permission['product-category-view']}}" id="permission-product-category-view">
								<input type="checkbox" id="product-category-view" autocomplete="off">
								<label class="control-label" for="product-category-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-category-add]" value="{{$permission['product-category-add']}}" id="permission-product-category-add">
								<input type="checkbox" id="product-category-add" autocomplete="off">
								<label class="control-label" for="product-category-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-category-edit]" value="{{$permission['product-category-edit']}}" id="permission-product-category-edit">
								<input type="checkbox" id="product-category-edit" autocomplete="off">
								<label class="control-label" for="product-category-edit">View Details</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-category-delete]" value="{{$permission['product-category-delete']}}" id="permission-product-category-delete">
								<input type="checkbox" id="product-category-delete" autocomplete="off">
								<label class="control-label" for="product-category-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-category-active]" value="{{$permission['product-category-active']}}" id="permission-product-category-active">
								<input type="checkbox" id="product-category-active" autocomplete="off">
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
								<input type="hidden" name="permission[product-list-view]" value="{{$permission['product-list-view']}}" id="permission-product-list-view">
								<input type="checkbox" id="product-list-view" autocomplete="off">
								<label class="control-label" for="product-list-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-list-add]" value="{{$permission['product-list-add']}}" id="permission-product-list-add">
								<input type="checkbox" id="product-list-add" autocomplete="off">
								<label class="control-label" for="product-list-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-list-edit]" value="{{$permission['product-list-edit']}}" id="permission-product-list-edit">
								<input type="checkbox" id="product-list-edit" autocomplete="off">
								<label class="control-label" for="product-list-edit">View Detail</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-list-delete]" value="{{$permission['product-list-delete']}}" id="permission-product-list-delete">
								<input type="checkbox" id="product-list-delete" autocomplete="off">
								<label class="control-label" for="product-list-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-list-active]" value="{{$permission['product-list-active']}}" id="permission-product-list-active">
								<input type="checkbox" id="product-list-active" autocomplete="off">
								<label class="control-label" for="product-list-active">Active</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[product-list-approve]" value="{{$permission['product-list-approve']}}" id="permission-product-list-approve">
								<input type="checkbox" id="product-list-approve" autocomplete="off">
								<label class="control-label" for="product-list-approve">Approve</label>
							</div>
						</div>
						<hr />
						<div class="clearfix mb-2"></div>
						<label class="control-label mb-2">Variant</label>
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[variant-view]" value="{{$permission['variant-view']}}" id="permission-variant-view">
								<input type="checkbox" id="variant-view" autocomplete="off">
								<label class="control-label" for="variant-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[variant-add]" value="{{$permission['variant-add']}}" id="permission-variant-add">
								<input type="checkbox" id="variant-add" autocomplete="off">
								<label class="control-label" for="variant-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[variant-edit]" value="{{$permission['variant-edit']}}" id="permission-variant-edit">
								<input type="checkbox" id="variant-edit" autocomplete="off">
								<label class="control-label" for="variant-edit">Edit</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[variant-delete]" value="{{$permission['variant-delete']}}" id="permission-variant-delete">
								<input type="checkbox" id="variant-delete" autocomplete="off">
								<label class="control-label" for="variant-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[variant-active]" value="{{$permission['variant-active']}}" id="permission-variant-active">
								<input type="checkbox" id="variant-active" autocomplete="off">
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
								<input type="hidden" name="permission[order-details-report-view]" value="{{$permission['order-details-report-view']}}" id="permission-order-details-report-view">
								<input type="checkbox" id="order-details-report-view" autocomplete="off">
								<label class="control-label" for="order-details-report-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[order-single-report-view]" value="{{$permission['order-single-report-view']}}" id="permission-order-single-report-view">
								<input type="checkbox" id="order-single-report-view" autocomplete="off">
								<label class="control-label" for="order-single-report-view">View Detail</label>
							</div>
						</div>
						<hr />
						<div class="clearfix mb-2"></div>
						<label class="control-label mb-2">Invoice Tax Details</label>
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[invoice-tax-view]" value="{{$permission['invoice-tax-view']}}" id="permission-invoice-tax-view">
								<input type="checkbox" id="invoice-tax-view" autocomplete="off">
								<label class="control-label" for="invoice-tax-view">View</label>
							</div>
						</div>
						<hr />
						<div class="clearfix mb-2"></div>
						<label class="control-label mb-2">Sale Summary</label>
						<div class="row">
							<div class="col">
								<input type="hidden" name="permission[sale-summary-view]" value="{{$permission['sale-summary-view']}}" id="permission-sale-summary-view">
								<input type="checkbox" id="sale-summary-view" autocomplete="off">
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
								<input type="hidden" name="permission[order-details-view]" value="{{$permission['order-details-view']}}" id="permission-order-details-view">
								<input type="checkbox" id="order-details-view" autocomplete="off">
								<label class="control-label" for="order-details-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[order-single-view]" value="{{$permission['order-single-view']}}" id="permission-order-single-view">
								<input type="checkbox" id="order-single-view" autocomplete="off">
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
								<input type="hidden" name="permission[customer-view]" value="{{$permission['customer-view']}}" id="permission-customer-view">
								<input type="checkbox" id="customer-view" autocomplete="off">
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
								<input type="hidden" name="permission[offer-view]" value="{{$permission['offer-view']}}" id="permission-offer-view">
								<input type="checkbox" id="offer-view" autocomplete="off">
								<label class="control-label" for="offer-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[offer-add]" value="{{$permission['offer-add']}}" id="permission-offer-add">
								<input type="checkbox" id="offer-add" autocomplete="off">
								<label class="control-label" for="offer-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[offer-edit]" value="{{$permission['offer-edit']}}" id="permission-offer-edit">
								<input type="checkbox" id="offer-edit" autocomplete="off">
								<label class="control-label" for="offer-edit">Edit</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[offer-delete]" value="{{$permission['offer-delete']}}" id="permission-offer-delete">
								<input type="checkbox" id="offer-delete" autocomplete="off">
								<label class="control-label" for="offer-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[offer-active]" value="{{$permission['offer-active']}}" id="permission-offer-active">
								<input type="checkbox" id="offer-active" autocomplete="off">
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
								<input type="hidden" name="permission[discount-coupon-view]" value="{{$permission['discount-coupon-view']}}" id="permission-discount-coupon-view">
								<input type="checkbox" id="discount-coupon-view" autocomplete="off">
								<label class="control-label" for="discount-coupon-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[discount-coupon-add]" value="{{$permission['discount-coupon-add']}}" id="permission-discount-coupon-add">
								<input type="checkbox" id="discount-coupon-add" autocomplete="off">
								<label class="control-label" for="discount-coupon-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[discount-coupon-delete]" value="{{$permission['discount-coupon-delete']}}" id="permission-discount-coupon-delete">
								<input type="checkbox" id="discount-coupon-delete" autocomplete="off">
								<label class="control-label" for="discount-coupon-delete">Delete</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[discount-coupon-active]" value="{{$permission['discount-coupon-active']}}" id="permission-discount-coupon-active">
								<input type="checkbox" id="discount-coupon-active" autocomplete="off">
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
								<input type="hidden" name="permission[static-page-view]" value="{{$permission['static-page-view']}}" id="permission-static-page-view">
								<input type="checkbox" id="static-page-view" autocomplete="off">
								<label class="control-label" for="static-page-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[static-page-add]" value="{{$permission['static-page-add']}}" id="permission-static-page-add">
								<input type="checkbox" id="static-page-add" autocomplete="off">
								<label class="control-label" for="static-page-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[static-page-edit]" value="{{$permission['static-page-edit']}}" id="permission-static-page-edit">
								<input type="checkbox" id="static-page-edit" autocomplete="off">
								<label class="control-label" for="static-page-edit">Edit</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[static-page-active]" value="{{$permission['static-page-active']}}" id="permission-static-page-active">
								<input type="checkbox" id="static-page-active" autocomplete="off">
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
								<input type="hidden" name="permission[faq-view]" value="{{$permission['faq-view']}}" id="permission-faq-view">
								<input type="checkbox" id="faq-view" autocomplete="off">
								<label class="control-label" for="faq-view">View</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[faq-add]" value="{{$permission['faq-add']}}" id="permission-faq-add">
								<input type="checkbox" id="faq-add" autocomplete="off">
								<label class="control-label" for="faq-add">Add</label>
							</div>
							<div class="col">
								<input type="hidden" name="permission[faq-edit]" value="{{$permission['faq-edit']}}" id="permission-faq-edit">
								<input type="checkbox" id="faq-edit" autocomplete="off">
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
	$('input[type="hidden"][name^="permission"]').each(function(){
		if($(this).val() == "1"){
			$('#'+$(this).attr('id').replace("permission-", "")).attr('checked', true);
		} else {
			$('#'+$(this).attr('id').replace("permission-", "")).attr('checked', false);
		}
	});
	$('input[type="checkbox"]').change(function(){
		if($(this).is(":checked")){
			$('#permission-' + $(this).attr('id')).val(1);
		} else {
			$('#permission-' + $(this).attr('id')).val(0);
		}
	});
});
</script>
@endpush