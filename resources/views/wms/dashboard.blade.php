@extends("wms.layout")
@section("content")
<div class="app-page-title">
<div class="page-title-wrapper">
<div class="page-title-heading">
<div class="page-title-icon">
<i class="pe-7s-rocket icon-gradient bg-sunny-morning"></i>
</div>
<div>
Dashboard
<div class="page-title-subheading">&nbsp;</div>
</div>
</div>
<div class="page-title-actions">
<div class="d-inline-block dropdown"></div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-6 col-xl-4">
<div class="mb-3 card">
<div class="card-header-tab card-header">
<div class="card-header-title font-size-lg text-capitalize fw-normal">
<i class="header-icon lnr-shirt me-3 text-muted opacity-6"></i>
Top Sellers
</div>
<div class="btn-actions-pane-right actions-icon-btn">
<div class="btn-group dropdown">
<button type="button" data-bs-toggle="dropdown" aria-haspopup="true"
aria-expanded="false" class="btn-icon btn-icon-only btn btn-link">
<i class="pe-7s-menu btn-icon-wrapper"></i>
</button>
<div tabindex="-1" role="menu" aria-hidden="true"
class="dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
<h6 tabindex="-1" class="dropdown-header">Header</h6>
<button type="button" tabindex="0" class="dropdown-item">
<i class="dropdown-icon lnr-inbox"></i>
<span>Menus</span>
</button>
<button type="button" tabindex="0" class="dropdown-item">
<i class="dropdown-icon lnr-file-empty"></i>
<span>Settings</span>
</button>
<button type="button" tabindex="0" class="dropdown-item">
<i class="dropdown-icon lnr-book"></i>
<span>Actions</span>
</button>
<div tabindex="-1" class="dropdown-divider"></div>
<div class="p-1 text-end">
<button class="me-2 btn-shadow btn-sm btn btn-link">View Details</button>
<button class="me-2 btn-shadow btn-sm btn btn-primary">Action</button>
</div>
</div>
</div>
</div>
</div>
<div class="widget-chart widget-chart2 text-start p-0">
<div class="widget-chat-wrapper-outer">
<div class="widget-chart-content widget-chart-content-lg">
<div class="widget-chart-flex">
<div class="widget-title opacity-5 text-muted text-uppercase">New accounts since 2018</div>
</div>
<div class="widget-numbers">
<div class="widget-chart-flex">
<div>
<span class="opacity-10 text-success pe-2">
<i class="fa fa-angle-up"></i>
</span>
<span>9</span>
<small class="opacity-5 ps-1">%</small>
</div>
<div class="widget-title ms-2 font-size-lg fw-normal text-muted">
<span class="text-danger ps-2">+14% failed</span>
</div>
</div>
</div>
</div>
<div class="widget-chart-wrapper widget-chart-wrapper-xlg opacity-10 m-0">
<div id="dashboard-sparkline-3"></div>
</div>
</div>
</div>
<div class="pt-2 pb-0 card-body">
<h6 class="text-muted text-uppercase font-size-md opacity-9 mb-2 fw-normal">Authors</h6>
<div class="scroll-area-md shadow-overflow">
<div class="scrollbar-container">
<ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<img width="38" class="rounded-circle"
src="images/avatars/1.jpg" alt="">
</div>
<div class="widget-content-left">
<div class="widget-heading">Viktor Martin</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$152</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
<span>752</span>
<small class="text-warning ps-2">
<i class="fa fa-angle-down"></i>
</small>
</div>
</div>
</div>
</div>
</li>
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<img width="38" class="rounded-circle"
src="images/avatars/2.jpg" alt="">
</div>
<div class="widget-content-left">
<div class="widget-heading">Denis Delgado</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$53</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
<span>587</span>
<small class="text-danger ps-2">
<i class="fa fa-angle-up"></i>
</small>
</div>
</div>
</div>
</div>
</li>
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<img width="38" class="rounded-circle"
src="images/avatars/3.jpg" alt="">
</div>
<div class="widget-content-left">
<div class="widget-heading">Shawn Galloway</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$239</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
<span>163</span>
<small class="text-muted ps-2">
<i class="fa fa-angle-down"></i>
</small>
</div>
</div>
</div>
</div>
</li>
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<img width="38" class="rounded-circle"
src="images/avatars/4.jpg" alt="">
</div>
<div class="widget-content-left">
<div class="widget-heading">Latisha Allison</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$21</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
653
<small class="text-primary ps-2">
<i class="fa fa-angle-up"></i>
</small>
</div>
</div>
</div>
</div>
</li>
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<img width="38" class="rounded-circle"
src="images/avatars/5.jpg" alt="">
</div>
<div class="widget-content-left">
<div class="widget-heading">Lilly-Mae White</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$381</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
629
<small class="text-muted ps-2">
<i class="fa fa-angle-up"></i>
</small>
</div>
</div>
</div>
</div>
</li>
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<img width="38" class="rounded-circle"
src="images/avatars/8.jpg" alt="">
</div>
<div class="widget-content-left">
<div class="widget-heading">Julie Prosser</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$74</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
462
<small class="text-muted ps-2">
<i class="fa fa-angle-down"></i>
</small>
</div>
</div>
</div>
</div>
</li>
<li class="border-bottom-0 list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<img width="38" class="rounded-circle"
src="images/avatars/8.jpg" alt="">
</div>
<div class="widget-content-left">
<div class="widget-heading">Amin Hamer</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$7</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
956
<small class="text-success ps-2">
<i class="fa fa-angle-up"></i>
</small>
</div>
</div>
</div>
</div>
</li>
</ul>
</div>
</div>
</div>
<div class="d-block text-center rm-border card-footer">
<button class="btn btn-primary">
View complete report
<span class="text-white ps-2 opacity-3">
<i class="fa fa-arrow-right"></i>
</span>
</button>
</div>
</div>
</div>
<div class="col-lg-6 col-xl-4">
<div class="mb-3 card">
<div class="card-header-tab card-header">
<div class="card-header-title font-size-lg text-capitalize fw-normal">
<i class="header-icon lnr-laptop-phone me-3 text-muted opacity-6"></i>
Best Selling Products
</div>
<div class="btn-actions-pane-right actions-icon-btn">
<div class="btn-group dropdown">
<button data-bs-toggle="dropdown" type="button" aria-haspopup="true"
aria-expanded="false" class="btn-icon btn-icon-only btn btn-link">
<i class="pe-7s-menu btn-icon-wrapper"></i>
</button>
<div tabindex="-1" role="menu" aria-hidden="true"
class="dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
<h6 tabindex="-1" class="dropdown-header">Header</h6>
<button type="button" tabindex="0" class="dropdown-item">
<i class="dropdown-icon lnr-inbox"></i>
<span>Menus</span>
</button>
<button type="button" tabindex="0" class="dropdown-item">
<i class="dropdown-icon lnr-file-empty"></i>
<span>Settings</span>
</button>
<button type="button" tabindex="0" class="dropdown-item">
<i class="dropdown-icon lnr-book"></i>
<span>Actions</span>
</button>
<div tabindex="-1" class="dropdown-divider"></div>
<div class="p-1 text-end">
<button class="me-2 btn-shadow btn-sm btn btn-link">View Details</button>
<button class="me-2 btn-shadow btn-sm btn btn-primary">Action</button>
</div>
</div>
</div>
</div>
</div>
<div class="widget-chart widget-chart2 text-start p-0">
<div class="widget-chat-wrapper-outer">
<div class="widget-chart-content widget-chart-content-lg">
<div class="widget-chart-flex">
<div class="widget-title opacity-5 text-muted text-uppercase">
Toshiba Laptops
</div>
</div>
<div class="widget-numbers">
<div class="widget-chart-flex">
<div>
<span class="opacity-10 text-warning pe-2">
<i class="fa fa-dot-circle"></i>
</span>
<span>$984</span>
</div>
<div class="widget-title ms-2 font-size-lg fw-normal text-muted">
<span class="text-success ps-2">+14</span>
</div>
</div>
</div>
</div>
<div class="widget-chart-wrapper widget-chart-wrapper-xlg opacity-10 m-0">
<div id="dashboard-sparkline-2"></div>
</div>
</div>
</div>
<div class="pt-2 pb-0 card-body">
<h6 class="text-muted text-uppercase font-size-md opacity-9 mb-2 fw-normal">
Top Performing
</h6>
<div class="scroll-area-md shadow-overflow">
<div class="scrollbar-container">
<ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<div class="icon-wrapper m-0">
<div class="progress-circle-wrapper">
<div class="progress-circle-wrapper">
<div class="circle-progress circle-progress-gradient">
<small></small>
</div>
</div>
</div>
</div>
</div>
<div class="widget-content-left">
<div class="widget-heading">Asus Laptop</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$152</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
<span>752</span>
<small class="text-warning ps-2">
<i class="fa fa-angle-down"></i>
</small>
</div>
</div>
</div>
</div>
</li>
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<div class="icon-wrapper m-0">
<div class="progress-circle-wrapper">
<div class="progress-circle-wrapper">
<div class="circle-progress circle-progress-danger">
<small></small>
</div>
</div>
</div>
</div>
</div>
<div class="widget-content-left">
<div class="widget-heading">Dell Inspire</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$53</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
<span>587</span>
<small class="text-danger ps-2">
<i class="fa fa-angle-up"></i>
</small>
</div>
</div>
</div>
</div>
</li>
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<div class="icon-wrapper m-0">
<div class="progress-circle-wrapper">
<div class="progress-circle-wrapper">
<div class="circle-progress circle-progress-primary">
<small></small>
</div>
</div>
</div>
</div>
</div>
<div class="widget-content-left">
<div class="widget-heading">Lenovo IdeaPad</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$239</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
<span>163</span>
<small class="text-muted ps-2">
<i class="fa fa-angle-down"></i>
</small>
</div>
</div>
</div>
</div>
</li>
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<div class="icon-wrapper m-0">
<div class="progress-circle-wrapper">
<div class="progress-circle-wrapper">
<div class="circle-progress circle-progress-info">
<small></small>
</div>
</div>
</div>
</div>
</div>
<div class="widget-content-left">
<div class="widget-heading">Asus Vivobook</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$21</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
653
<small class="text-primary ps-2">
<i class="fa fa-angle-up"></i>
</small>
</div>
</div>
</div>
</div>
</li>
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<div class="icon-wrapper m-0">
<div class="progress-circle-wrapper">
<div class="progress-circle-wrapper">
<div class="circle-progress circle-progress-warning">
<small></small>
</div>
</div>
</div>
</div>
</div>
<div class="widget-content-left">
<div class="widget-heading">Apple Macbook</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$381</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
629
<small class="text-muted ps-2">
<i class="fa fa-angle-up"></i>
</small>
</div>
</div>
</div>
</div>
</li>
<li class="list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<div class="icon-wrapper m-0">
<div class="progress-circle-wrapper">
<div class="progress-circle-wrapper">
<div class="circle-progress circle-progress-dark">
<small></small>
</div>
</div>
</div>
</div>
</div>
<div class="widget-content-left">
<div class="widget-heading">HP Envy 13"</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$74</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
462
<small class="text-muted ps-2">
<i class="fa fa-angle-down"></i>
</small>
</div>
</div>
</div>
</div>
</li>
<li class="border-bottom-0 list-group-item">
<div class="widget-content p-0">
<div class="widget-content-wrapper">
<div class="widget-content-left me-3">
<div class="icon-wrapper m-0">
<div class="progress-circle-wrapper">
<div class="progress-circle-wrapper">
<div class="circle-progress circle-progress-alternate">
<small></small>
</div>
</div>
</div>
</div>
</div>
<div class="widget-content-left">
<div class="widget-heading">Gaming Laptop HP</div>
<div class="widget-subheading mt-1 opacity-10">
<div class="badge rounded-pill bg-dark">$7</div>
</div>
</div>
<div class="widget-content-right">
<div class="fsize-1 text-focus">
<small class="opacity-5 pe-1">$</small>
956
<small class="text-success ps-2">
<i class="fa fa-angle-up"></i>
</small>
</div>
</div>
</div>
</div>
</li>
</ul>
</div>
</div>
</div>
<div class="d-block text-center rm-border card-footer">
<button class="btn btn-primary">
View all participants
<span class="text-white ps-2 opacity-3">
<i class="fa fa-arrow-right"></i>
</span>
</button>
</div>
</div>
</div>
</div>
<div class="main-card mb-3 card">
<div class="g-0 row">
<div class="col-md-6 col-xl-4">
<div class="widget-content">
<div class="widget-content-wrapper">
<div class="widget-content-right ms-0 me-3">
<div class="widget-numbers text-success">1896</div>
</div>
<div class="widget-content-left">
<div class="widget-heading">Total Orders</div>
<div class="widget-subheading">Last year expenses</div>
</div>
</div>
</div>
</div>
<div class="col-md-6 col-xl-4">
<div class="widget-content">
<div class="widget-content-wrapper">
<div class="widget-content-right ms-0 me-3">
<div class="widget-numbers text-warning">$ 14M</div>
</div>
<div class="widget-content-left">
<div class="widget-heading">Products Sold</div>
<div class="widget-subheading">Total revenue streams</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection