@extends("wms.layout")

@section("content")

<div class="app-inner-layout">

    <div class="app-page-title app-page-title-simple">

        <div class="page-title-wrapper">

            <div class="page-title-heading">

                <div>

                    <div class="page-title-head center-elem">

                        <span class="d-inline-block pe-2">

                            <i class="lnr-apartment icon-gradient bg-mean-fruit"></i>

                        </span>

                        <span class="d-inline-block">Dashboard</span>
						<div> 


						</div>

                    </div>

                    <div class="page-title-subheading opacity-10">

                        <nav class="" aria-label="breadcrumb">

                            <ol class="breadcrumb">

                                <li class="breadcrumb-item">

                                    <a>

                                        <i aria-hidden="true" class="fa fa-home"></i>

                                    </a>

                                </li>

                                <li class="active breadcrumb-item">

                                    <a>Dashboard</a>

                                </li>
								 </ol>
								<br/>
								<div class="wellmess">
<marquee>
<p>Welcome to Spice Bucket Dashboard, India's First Online Spice &amp; Food Items Store &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Welcome to Spice Bucket Dashboard, India's First Online Spice &amp; Food Items Store </p>
</marquee>
						
</div>
                           

                        </nav>

                    </div>

                </div>

            </div>

            <!--

            <div class="page-title-actions">

                <div class="d-inline-block pe-3">

                    <select id="custom-inp-top" type="select" class="form-select">

                        <option>Select period...</option>

                        <option>Last Week</option>

                        <option>Last Month</option>

                        <option>Last Year</option>

                    </select>

                </div>

                <button type="button" data-bs-toggle="tooltip" data-bs-placement="left" class="btn btn-dark" title="Show a Toastr Notification!">

                    <i class="fa fa-battery-three-quarters"></i>

                </button>

            </div>

            -->

        </div>

    </div>

    <!-- <div class="mb-3 card"> -->

    <!--

        <div class="tabs-lg-alternate card-header">

            <ul class="nav nav-justified">

                <li class="nav-item">

                    <a href="#tab-minimal-1" data-bs-toggle="tab" class="nav-link minimal-tab-btn-1">

                        <div class="widget-number">

                            <span>$15,065</span>

                        </div>

                        <div class="tab-subheading">

                            <span class="pe-2 opactiy-6">

                                <i class="fa fa-comment-dots"></i>

                            </span>

                            Totals

                        </div>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="#tab-minimal-2" data-bs-toggle="tab" class="nav-link active minimal-tab-btn-2">

                        <div class="widget-number">

                            <span class="pe-2 text-success">

                                <i class="fa fa-angle-up"></i>

                            </span>

                            <span>4531</span>

                        </div>

                        <div class="tab-subheading">Products</div>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="#tab-minimal-3" data-bs-toggle="tab" class="nav-link minimal-tab-btn-3">

                        <div class="widget-number text-danger">

                            <span>$6,784.0</span>

                        </div>

                        <div class="tab-subheading">

                            <span class="pe-2 opactiy-6">

                                <i class="fa fa-bullhorn"></i>

                            </span>

                            Income

                        </div>

                    </a>

                </li>

            </ul>

        </div>

        <div class="tab-content">

            <div class="tab-pane" id="tab-minimal-1">

                <div class="card-body">

                    <div id="chart-combined-tab"></div>

                </div>

            </div>

            <div class="tab-pane fade active show" id="tab-minimal-2">

                <div class="card-body">

                    <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">

                        <div id="chart-apex-negative"></div>

                    </div>

                    <h5 class="card-title">Target Sales</h5>

                    <div class="mt-3 row">

                        <div class="col-sm-12 col-md-4">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-numbers text-dark">65%</div>

                                        </div>

                                    </div>

                                    <div class="widget-progress-wrapper mt-1">

                                        <div class="progress-bar-xs progress-bar-animated-alt progress">

                                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%;">

                                            </div>

                                        </div>

                                        <div class="progress-sub-label">

                                            <div class="sub-label-left font-size-md">Sales</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-sm-12 col-md-4">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-numbers text-dark">22%</div>

                                        </div>

                                    </div>

                                    <div class="widget-progress-wrapper mt-1">

                                        <div class="progress-bar-xs progress-bar-animated-alt progress">

                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" style="width: 22%;">

                                            </div>

                                        </div>

                                        <div class="progress-sub-label">

                                            <div class="sub-label-left font-size-md">Profiles</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-sm-12 col-md-4">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-numbers text-dark">83%</div>

                                        </div>

                                    </div>

                                    <div class="widget-progress-wrapper mt-1">

                                        <div class="progress-bar-xs progress-bar-animated-alt progress">

                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="83" aria-valuemin="0" aria-valuemax="100" style="width: 83%;">

                                            </div>

                                        </div>

                                        <div class="progress-sub-label">

                                            <div class="sub-label-left font-size-md">Tickets</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="tab-pane fade" id="tab-minimal-3">

                <div class="rm-border card-header">

                    <div>

                        <h5 class="menu-header-title text-capitalize text-primary">Income Report</h5>

                    </div>

                    <div class="btn-actions-pane-right text-capitalize">

                        <div class="btn-group dropdown">

                            <button type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-wide me-1 dropdown-toggle btn btn-outline-focus btn-sm">

                                Options

                            </button>

                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-lg rm-pointers dropdown-menu dropdown-menu-right">

                                <div class="dropdown-menu-header">

                                    <div class="dropdown-menu-header-inner bg-primary">

                                        <div class="menu-header-image" style="background-image: url('images/dropdown-header/abstract2.jpg');"></div>

                                        <div class="menu-header-content">

                                            <div>

                                                <h5 class="menu-header-title">Settings</h5>

                                                <h6 class="menu-header-subtitle">Example Dropdown Menu</h6>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="scroll-area-xs">

                                    <div class="scrollbar-container">

                                        <ul class="nav flex-column">

                                            <li class="nav-item-header nav-item">Activity</li>

                                            <li class="nav-item">

                                                <a href="javascript:void(0);" class="nav-link">

                                                    Chat

                                                    <div class="ms-auto badge rounded-pill bg-info">8</div>

                                                </a>

                                            </li>

                                            <li class="nav-item">

                                                <a href="javascript:void(0);" class="nav-link">Recover Password</a>

                                            </li>

                                            <li class="nav-item-header nav-item">My Account</li>

                                            <li class="nav-item">

                                                <a href="javascript:void(0);" class="nav-link">

                                                    Settings

                                                    <div class="ms-auto badge bg-success">New</div>

                                                </a>

                                            </li>

                                            <li class="nav-item">

                                                <a href="javascript:void(0);" class="nav-link">

                                                    Messages

                                                    <div class="ms-auto badge bg-warning">512</div>

                                                </a>

                                            </li>

                                            <li class="nav-item">

                                                <a href="javascript:void(0);" class="nav-link">Logs</a>

                                            </li>

                                        </ul>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card-body p-2">

                    <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">

                        <div style="height: 274px;">

                            <div id="chart-combined-tab-3"></div>

                        </div>

                    </div>

                </div>

                <div class="border-top bg-light card-header">

                    <div class="actions-icon-btn mx-auto">

                        <div>

                            <div role="group" class="btn-group-lg btn-group nav">

                                <button type="button" data-bs-toggle="tab" href="#tab-content-income" class="btn-pill ps-3 active btn btn-focus">

                                    Income

                                </button>

                                <button type="button" data-bs-toggle="tab" href="#tab-content-expenses" class="btn-pill pe-3  btn btn-focus">

                                    Expenses

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <div class="tab-content">

                        <div class="tab-pane active fade show" id="tab-content-income" role="tabpanel">

                            <h5 class="menu-header-title">Target Sales</h5>

                            <h6 class="menu-header-subtitle opacity-6">Total performance for this month</h6>

                            <div class="mt-3 row">

                                <div class="col-sm-12 col-md-6">

                                    <div class="card-border mb-sm-3 mb-md-0 border-light no-shadow card">

                                        <div class="widget-content">

                                            <div class="widget-content-outer">

                                                <div class="widget-content-wrapper">

                                                    <div class="widget-content-left">

                                                        <div class="widget-heading">Orders</div>

                                                    </div>

                                                    <div class="widget-content-right">

                                                        <div class="widget-numbers line-height-1 text-primary">

                                                            <span>366</span>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="widget-progress-wrapper mt-1">

                                                    <div class="progress-bar-xs progress">

                                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100" style="width: 76%;">

                                                        </div>

                                                    </div>

                                                    <div class="progress-sub-label">

                                                        <div class="sub-label-left">Monthly Target</div>

                                                        <div class="sub-label-right">100%</div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-sm-12 col-md-6">

                                    <div class="card-border border-light no-shadow card">

                                        <div class="widget-content">

                                            <div class="widget-content-outer">

                                                <div class="widget-content-wrapper">

                                                    <div class="widget-content-left">

                                                        <div class="widget-heading">Income</div>

                                                    </div>

                                                    <div class="widget-content-right">

                                                        <div class="widget-numbers line-height-1 text-success">

                                                            <span>$2797</span>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="widget-progress-wrapper mt-1">

                                                    <div class="progress-bar-xs progress-bar-animated progress">

                                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;">

                                                        </div>

                                                    </div>

                                                    <div class="progress-sub-label">

                                                        <div class="sub-label-left">Monthly Target</div>

                                                        <div class="sub-label-right">100%</div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="tab-pane fade" id="tab-content-expenses" role="tabpanel">

                            <h5 class="menu-header-title">Tabbed Content</h5>

                            <h6 class="menu-header-subtitle opacity-6">

                                Example of various options built with

                                ArchitectUI

                            </h6>

                            <div class="mt-3 row">

                                <div class="col-sm-12 col-md-6">

                                    <div class="card-hover-shadow-2x mb-sm-3 mb-md-0 widget-chart widget-chart2 bg-premium-dark text-start card">

                                        <div class="widget-chart-content text-white">

                                            <div class="widget-chart-flex">

                                                <div class="widget-title">Sales</div>

                                                <div class="widget-subtitle opacity-7">Monthly Goals</div>

                                            </div>

                                            <div class="widget-chart-flex">

                                                <div class="widget-numbers text-success">

                                                    <small>$</small>

                                                    976

                                                    <small class="opacity-8 ps-2">

                                                        <i class="fa fa-angle-up"></i>

                                                    </small>

                                                </div>

                                                <div class="widget-description ms-auto opacity-7">

                                                    <i class="fa fa-angle-up"></i>

                                                    <span class="ps-1">175%</span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-sm-12 col-md-6">

                                    <div class="card-hover-shadow-2x widget-chart widget-chart2 bg-premium-dark text-start card">

                                        <div class="widget-chart-content text-white">

                                            <div class="widget-chart-flex">

                                                <div class="widget-title">Clients</div>

                                                <div class="widget-subtitle text-warning">Returning</div>

                                            </div>

                                            <div class="widget-chart-flex">

                                                <div class="widget-numbers text-warning">

                                                    84

                                                    <small>%</small>

                                                    <small class="opacity-8 ps-2">

                                                        <i class="fa fa-angle-down"></i>

                                                    </small>

                                                </div>

                                                <div class="widget-description ms-auto text-warning">

                                                    <span class="pe-1">45</span>

                                                    <i class="fa fa-angle-up"></i>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-sm-12 col-md-7">

            <div class="row">

                <div class="col-sm-12 col-md-6">

                    <div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-start card">

                        <div class="widget-chat-wrapper-outer">

                            <div class="widget-chart-content">

                                <h6 class="widget-subheading">Income</h6>

                                <div class="widget-chart-flex">

                                    <div class="widget-numbers mb-0 w-100">

                                        <div class="widget-chart-flex">

                                            <div class="fsize-4">

                                                <small class="opacity-5">$</small>

                                                5,456

                                            </div>

                                            <div class="ms-auto">

                                                <div class="widget-title ms-auto font-size-lg fw-normal text-muted">

                                                    <span class="text-success ps-2">+14%</span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-sm-12 col-md-6">

                    <div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-start card">

                        <div class="widget-chat-wrapper-outer">

                            <div class="widget-chart-content">

                                <h6 class="widget-subheading">Expenses</h6>

                                <div class="widget-chart-flex">

                                    <div class="widget-numbers mb-0 w-100">

                                        <div class="widget-chart-flex">

                                            <div class="fsize-4 text-danger">

                                                <small class="opacity-5 text-muted">$</small>

                                                4,764

                                            </div>

                                            <div class="ms-auto">

                                                <div class="widget-title ms-auto font-size-lg fw-normal text-muted">

                                                    <span class="text-danger ps-2">

                                                        <span class="pe-1">

                                                            <i class="fa fa-angle-up"></i>

                                                        </span>

                                                        8%

                                                    </span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-sm-12 col-md-6">

                    <div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-start card">

                        <div class="widget-chat-wrapper-outer">

                            <div class="widget-chart-content">

                                <h6 class="widget-subheading">Spendings</h6>

                                <div class="widget-chart-flex">

                                    <div class="widget-numbers mb-0 w-100">

                                        <div class="widget-chart-flex">

                                            <div class="fsize-4">

                                                <span class="text-success pe-2">

                                                    <i class="fa fa-angle-down"></i>

                                                </span>

                                                <small class="opacity-5">$</small>

                                                1.5M

                                            </div>

                                            <div class="ms-auto">

                                                <div class="widget-title ms-auto font-size-lg fw-normal text-muted">

                                                    <span class="text-success ps-2">

                                                        <span class="pe-1">

                                                            <i class="fa fa-angle-down"></i>

                                                        </span>

                                                        15%

                                                    </span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-sm-12 col-md-6">

                    <div class="card-shadow-primary mb-3 widget-chart widget-chart2 text-start card">

                        <div class="widget-chat-wrapper-outer">

                            <div class="widget-chart-content">

                                <h6 class="widget-subheading">Totals</h6>

                                <div class="widget-chart-flex">

                                    <div class="widget-numbers mb-0 w-100">

                                        <div class="widget-chart-flex">

                                            <div class="fsize-4">

                                                <small class="opacity-5">$</small>

                                                31,564

                                            </div>

                                            <div class="ms-auto">

                                                <div class="widget-title ms-auto font-size-lg fw-normal text-muted">

                                                    <span class="text-warning ps-2">+76%</span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-sm-12 col-md-5">

            <div class="mb-3 card">

                <div class="card-body">

                    <div class="widget-chart widget-chart2 text-start p-0">

                        <div class="widget-chat-wrapper-outer">

                            <div class="widget-chart-content">

                                <div class="widget-chart-flex">

                                    <div class="widget-numbers mt-0">

                                        <div class="widget-chart-flex">

                                            <div>

                                                <small class="opacity-5">$</small>

                                                <span>628</span>

                                            </div>

                                            <div class="widget-title ms-2 opacity-5 font-size-lg text-muted">Total Expenses Today</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">

                                <div id="dashboard-sparkline-carousel-3"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="mbg-3 h-auto ps-0 pe-0 bg-transparent no-border card-header">

        <div class="card-header-title fsize-2 text-capitalize fw-normal">Target Section</div>

        <div class="btn-actions-pane-right text-capitalize actions-icon-btn">

            <button class="btn btn-link btn-sm">View Details</button>

        </div>

    </div>

    <div class="row">

        <div class="col-md-6 col-lg-3">

            <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-start card">

                <div class="widget-content p-0 w-100">

                    <div class="widget-content-outer">

                        <div class="widget-content-wrapper">

                            <div class="widget-content-left pe-2 fsize-1">

                                <div class="widget-numbers mt-0 fsize-3 text-danger">71%</div>

                            </div>

                            <div class="widget-content-right w-100">

                                <div class="progress-bar-xs progress">

                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100" style="width: 71%;">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="widget-content-left fsize-1">

                            <div class="text-muted opacity-6">Income Target</div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-lg-3">

            <div class="card-shadow-success mb-3 widget-chart widget-chart2 text-start card">

                <div class="widget-content p-0 w-100">

                    <div class="widget-content-outer">

                        <div class="widget-content-wrapper">

                            <div class="widget-content-left pe-2 fsize-1">

                                <div class="widget-numbers mt-0 fsize-3 text-success">54%</div>

                            </div>

                            <div class="widget-content-right w-100">

                                <div class="progress-bar-xs progress">

                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="widget-content-left fsize-1">

                            <div class="text-muted opacity-6">Expenses Target</div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-lg-3">

            <div class="card-shadow-warning mb-3 widget-chart widget-chart2 text-start card">

                <div class="widget-content p-0 w-100">

                    <div class="widget-content-outer">

                        <div class="widget-content-wrapper">

                            <div class="widget-content-left pe-2 fsize-1">

                                <div class="widget-numbers mt-0 fsize-3 text-warning">32%</div>

                            </div>

                            <div class="widget-content-right w-100">

                                <div class="progress-bar-xs progress">

                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: 32%;">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="widget-content-left fsize-1">

                            <div class="text-muted opacity-6">Spendings Target</div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-lg-3">

            <div class="card-shadow-info mb-3 widget-chart widget-chart2 text-start card">

                <div class="widget-content p-0 w-100">

                    <div class="widget-content-outer">

                        <div class="widget-content-wrapper">

                            <div class="widget-content-left pe-2 fsize-1">

                                <div class="widget-numbers mt-0 fsize-3 text-info">89%</div>

                            </div>

                            <div class="widget-content-right w-100">

                                <div class="progress-bar-xs progress">

                                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="widget-content-left fsize-1">

                            <div class="text-muted opacity-6">Totals Target</div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="main-card mb-3 card">

        <div class="card-header">

            <div class="card-header-title font-size-lg text-capitalize fw-normal">

                Company Agents Status

            </div>

            <div class="btn-actions-pane-right">

                <button type="button" id="PopoverCustomT-1" class="btn-icon btn-wide btn-outline-2x btn btn-outline-focus btn-sm">

                    Actions Menu

                    <span class="ps-2 align-middle opactiy-7">

                        <i class="fa fa-angle-down"></i>

                    </span>

                </button>

            </div>

        </div>

        <div class="table-responsive">

            <table class="align-middle text-truncate mb-0 table table-borderless table-hover">

                <thead>

                    <tr>

                        <th class="text-center">#</th>

                        <th class="text-center">Avatar</th>

                        <th class="text-center">Name</th>

                        <th class="text-center">Company</th>

                        <th class="text-center">Status</th>

                        <th class="text-center">Due Date</th>

                        <th class="text-center">Target Achievement</th>

                        <th class="text-center">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td class="text-center text-muted" style="width: 80px;">#54</td>

                        <td class="text-center" style="width: 80px;">

                            <img width="40" class="rounded-circle" src="images/avatars/1.jpg" alt="">

                        </td>

                        <td class="text-center">

                            <a href="javascript:void(0)">Juan C. Cargill</a>

                        </td>

                        <td class="text-center">

                            <a href="javascript:void(0)">Micro Electronics</a>

                        </td>

                        <td class="text-center">

                            <div class="badge rounded-pill bg-danger">Canceled</div>

                        </td>

                        <td class="text-center">

                            <span class="pe-2 opacity-6">

                                <i class="fa fa-business-time"></i>

                            </span>

                            12 Dec

                        </td>

                        <td class="text-center" style="width: 200px;">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left pe-2">

                                            <div class="widget-numbers fsize-1 text-danger">71%</div>

                                        </div>

                                        <div class="widget-content-right w-100">

                                            <div class="progress-bar-xs progress">

                                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100" style="width: 71%;">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </td>

                        <td class="text-center">

                            <div role="group" class="btn-group-sm btn-group">

                                <button class="btn-shadow btn btn-primary">Hire</button>

                                <button class="btn-shadow btn btn-primary">Fire</button>

                            </div>

                        </td>

                    </tr>

                    <tr>

                        <td class="text-center text-muted" style="width: 80px;">#55</td>

                        <td class="text-center" style="width: 80px;">

                            <img width="40" class="rounded-circle" src="images/avatars/2.jpg" alt="">

                        </td>

                        <td class="text-center">

                            <a href="javascript:void(0)">Johnathan Phelan</a>

                        </td>

                        <td class="text-center">

                            <a href="javascript:void(0)">Hatchworks</a>

                        </td>

                        <td class="text-center">

                            <div class="badge rounded-pill bg-info">On Hold</div>

                        </td>

                        <td class="text-center">

                            <span class="pe-2 opacity-6">

                                <i class="fa fa-business-time"></i>

                            </span>

                            12 Dec

                        </td>

                        <td class="text-center" style="width: 200px;">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left pe-2">

                                            <div class="widget-numbers fsize-1 text-warning">54%</div>

                                        </div>

                                        <div class="widget-content-right w-100">

                                            <div class="progress-bar-xs progress">

                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100" style="width: 54%;">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </td>

                        <td class="text-center">

                            <div role="group" class="btn-group-sm btn-group">

                                <button class="btn-shadow btn btn-primary">Hire</button>

                                <button class="btn-shadow btn btn-primary">Fire</button>

                            </div>

                        </td>

                    </tr>

                    <tr>

                        <td class="text-center text-muted" style="width: 80px;">#56</td>

                        <td class="text-center" style="width: 80px;">

                            <img width="40" class="rounded-circle" src="images/avatars/3.jpg" alt="">

                        </td>

                        <td class="text-center">

                            <a href="javascript:void(0)">Darrell Lowe</a>

                        </td>

                        <td class="text-center">

                            <a href="javascript:void(0)">Riddle Electronics</a>

                        </td>

                        <td class="text-center">

                            <div class="badge rounded-pill bg-warning">In Progress</div>

                        </td>

                        <td class="text-center">

                            <span class="pe-2 opacity-6">

                                <i class="fa fa-business-time"></i>

                            </span>

                            12 Dec

                        </td>

                        <td class="text-center" style="width: 200px;">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left pe-2">

                                            <div class="widget-numbers fsize-1 text-success">97%</div>

                                        </div>

                                        <div class="widget-content-right w-100">

                                            <div class="progress-bar-xs progress">

                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="97" aria-valuemin="0" aria-valuemax="100" style="width: 97%;">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </td>

                        <td class="text-center">

                            <div role="group" class="btn-group-sm btn-group">

                                <button class="btn-shadow btn btn-primary">Hire</button>

                                <button class="btn-shadow btn btn-primary">Fire</button>

                            </div>

                        </td>

                    </tr>

                    <tr>

                        <td class="text-center text-muted" style="width: 80px;">#56</td>

                        <td class="text-center" style="width: 80px;">

                            <img width="40" class="rounded-circle" src="images/avatars/4.jpg" alt="">

                        </td>

                        <td class="text-center">

                            <a href="javascript:void(0)">George T. Cottrell</a>

                        </td>

                        <td class="text-center">

                            <a href="javascript:void(0)">Pixelcloud</a>

                        </td>

                        <td class="text-center">

                            <div class="badge rounded-pill bg-success">Completed</div>

                        </td>

                        <td class="text-center">

                            <span class="pe-2 opacity-6">

                                <i class="fa fa-business-time"></i>

                            </span>

                            12 Dec

                        </td>

                        <td class="text-center" style="width: 200px;">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left pe-2">

                                            <div class="widget-numbers fsize-1 text-info">88%</div>

                                        </div>

                                        <div class="widget-content-right w-100">

                                            <div class="progress-bar-xs progress">

                                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100" style="width: 88%;">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </td>

                        <td class="text-center">

                            <div role="group" class="btn-group-sm btn-group">

                                <button class="btn-shadow btn btn-primary">Hire</button>

                                <button class="btn-shadow btn btn-primary">Fire</button>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        <div class="d-block p-4 text-center card-footer">

            <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-dark btn-lg">

                <span class="me-2 opacity-7">

                    <i class="fa fa-cog fa-spin"></i>

                </span>

                <span class="me-1">View Complete Report</span>

            </button>

        </div>

    </div>

    <div class="row">

        <div class="col-sm-12 col-lg-6">

            <div class="mb-3 card">

                <div class="card-header-tab card-header">

                    <div class="card-header-title font-size-lg text-capitalize fw-normal">Daily Sales</div>

                    <div class="btn-actions-pane-right text-capitalize">

                        <button class="btn-wide btn-outline-2x btn btn-outline-focus btn-sm">View All</button>

                    </div>

                </div>

                <div class="card-body">

                    <div id="bar-vertical-candle"></div>

                </div>

                <div class="p-0 d-block card-footer">

                    <div class="grid-menu grid-menu-2col">

                        <div class="g-0 row">

                            <div class="p-2 col-sm-6">

                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">

                                    <i class="lnr-apartment text-dark opacity-7 btn-icon-wrapper mb-2"></i>

                                    Overview

                                </button>

                            </div>

                            <div class="p-2 col-sm-6">

                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">

                                    <i class="lnr-database text-dark opacity-7 btn-icon-wrapper mb-2"></i>

                                    Support

                                </button>

                            </div>

                            <div class="p-2 col-sm-6">

                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">

                                    <i class="lnr-printer text-dark opacity-7 btn-icon-wrapper mb-2"></i>

                                    Activities

                                </button>

                            </div>

                            <div class="p-2 col-sm-6">

                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">

                                    <i class="lnr-store text-dark opacity-7 btn-icon-wrapper mb-2"></i>

                                    Marketing

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-sm-12 col-lg-6">

            <div class="mb-3 card">

                <div class="card-header-tab card-header">

                    <div class="card-header-title font-size-lg text-capitalize fw-normal">

                        Total Expenses

                    </div>

                    <div class="btn-actions-pane-right text-capitalize">

                        <button class="btn-wide btn-outline-2x btn btn-outline-primary btn-sm">View All</button>

                    </div>

                </div>

                <div class="card-body">

                    <div id="chart-col-2"></div>

                </div>

                <div class="p-0 d-block card-footer">

                    <div class="grid-menu grid-menu-2col">

                        <div class="g-0 row">

                            <div class="p-2 col-sm-6">

                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-success">

                                    <i class="lnr-lighter text-success opacity-7 btn-icon-wrapper mb-2"></i>

                                    Accounts

                                </button>

                            </div>

                            <div class="p-2 col-sm-6">

                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-warning">

                                    <i class="lnr-construction text-warning opacity-7 btn-icon-wrapper mb-2"></i>

                                    Contacts

                                </button>

                            </div>

                            <div class="p-2 col-sm-6">

                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-info">

                                    <i class="lnr-bus text-info opacity-7 btn-icon-wrapper mb-2"></i>

                                    Products

                                </button>

                            </div>

                            <div class="p-2 col-sm-6">

                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-alternate">

                                    <i class="lnr-gift text-alternate opacity-7 btn-icon-wrapper mb-2"></i>

                                    Services

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="app-wrapper-footer">

        <div class="app-footer">

            <div class="app-footer__inner">

                <div class="app-footer-left">

                    <div class="footer-dots">

                        <div class="dropdown">

                            <a aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown" class="dot-btn-wrapper">

                                <i class="dot-btn-icon lnr-bullhorn icon-gradient bg-mean-fruit"></i>

                                <div class="badge badge-dot badge-abs badge-dot-sm bg-danger">Notifications</div>

                            </a>

                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu">

                                <div class="dropdown-menu-header mb-0">

                                    <div class="dropdown-menu-header-inner bg-deep-blue">

                                        <div class="menu-header-image opacity-1" style="background-image: url('images/dropdown-header/city3.jpg');"></div>

                                        <div class="menu-header-content text-dark">

                                            <h5 class="menu-header-title">Notifications</h5>

                                            <h6 class="menu-header-subtitle">You have

                                                <b>21</b> unread messages

                                            </h6>

                                        </div>

                                    </div>

                                </div>

                                <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">

                                    <li class="nav-item">

                                        <a role="tab" class="nav-link active" data-bs-toggle="tab" href="#tab-messages-header1">

                                            <span>Messages</span>

                                        </a>

                                    </li>

                                    <li class="nav-item">

                                        <a role="tab" class="nav-link" data-bs-toggle="tab" href="#tab-events-header1">

                                            <span>Events</span>

                                        </a>

                                    </li>

                                    <li class="nav-item">

                                        <a role="tab" class="nav-link" data-bs-toggle="tab" href="#tab-errors-header1">

                                            <span>System Errors</span>

                                        </a>

                                    </li>

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="tab-messages-header1" role="tabpanel">

                                        <div class="scroll-area-sm">

                                            <div class="scrollbar-container">

                                                <div class="p-3">

                                                    <div class="notifications-box">

                                                        <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">

                                                            <div class="vertical-timeline-item dot-danger vertical-timeline-element">

                                                                <div>

                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>

                                                                    <div class="vertical-timeline-element-content bounce-in">

                                                                        <h4 class="timeline-title">All Hands Meeting</h4>

                                                                        <span class="vertical-timeline-element-date"></span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="vertical-timeline-item dot-warning vertical-timeline-element">

                                                                <div>

                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>

                                                                    <div class="vertical-timeline-element-content bounce-in">

                                                                        <p>

                                                                            Yet another one, at

                                                                            <span class="text-success">15:00 PM</span>

                                                                        </p>

                                                                        <span class="vertical-timeline-element-date"></span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="vertical-timeline-item dot-success vertical-timeline-element">

                                                                <div>

                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>

                                                                    <div class="vertical-timeline-element-content bounce-in">

                                                                        <h4 class="timeline-title">

                                                                            Build the production release

                                                                            <span class="badge bg-danger ms-2">NEW</span>

                                                                        </h4>

                                                                        <span class="vertical-timeline-element-date"></span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="vertical-timeline-item dot-primary vertical-timeline-element">

                                                                <div>

                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>

                                                                    <div class="vertical-timeline-element-content bounce-in">

                                                                        <h4 class="timeline-title">

                                                                            Something not important

                                                                            <div class="avatar-wrapper mt-2 avatar-wrapper-overlap">

                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">

                                                                                    <div class="avatar-icon">

                                                                                        <img src="images/avatars/1.jpg" alt="">

                                                                                    </div>

                                                                                </div>

                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">

                                                                                    <div class="avatar-icon">

                                                                                        <img src="images/avatars/2.jpg" alt="">

                                                                                    </div>

                                                                                </div>

                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">

                                                                                    <div class="avatar-icon">

                                                                                        <img src="images/avatars/3.jpg" alt="">

                                                                                    </div>

                                                                                </div>

                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">

                                                                                    <div class="avatar-icon">

                                                                                        <img src="images/avatars/4.jpg" alt="">

                                                                                    </div>

                                                                                </div>

                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">

                                                                                    <div class="avatar-icon">

                                                                                        <img src="images/avatars/5.jpg" alt="">

                                                                                    </div>

                                                                                </div>

                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">

                                                                                    <div class="avatar-icon">

                                                                                        <img src="images/avatars/9.jpg" alt="">

                                                                                    </div>

                                                                                </div>

                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">

                                                                                    <div class="avatar-icon">

                                                                                        <img src="images/avatars/7.jpg" alt="">

                                                                                    </div>

                                                                                </div>

                                                                                <div class="avatar-icon-wrapper avatar-icon-sm">

                                                                                    <div class="avatar-icon">

                                                                                        <img src="images/avatars/8.jpg" alt="">

                                                                                    </div>

                                                                                </div>

                                                                                <div class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">

                                                                                    <div class="avatar-icon">

                                                                                        <i>+</i>

                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                        </h4>

                                                                        <span class="vertical-timeline-element-date"></span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="vertical-timeline-item dot-info vertical-timeline-element">

                                                                <div>

                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>

                                                                    <div class="vertical-timeline-element-content bounce-in">

                                                                        <h4 class="timeline-title">This dot has an info state</h4>

                                                                        <span class="vertical-timeline-element-date"></span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="vertical-timeline-item dot-danger vertical-timeline-element">

                                                                <div>

                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>

                                                                    <div class="vertical-timeline-element-content bounce-in">

                                                                        <h4 class="timeline-title">All Hands Meeting</h4>

                                                                        <span class="vertical-timeline-element-date"></span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="vertical-timeline-item dot-warning vertical-timeline-element">

                                                                <div>

                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>

                                                                    <div class="vertical-timeline-element-content bounce-in">

                                                                        <p>

                                                                            Yet another one, at

                                                                            <span class="text-success">15:00 PM</span>

                                                                        </p>

                                                                        <span class="vertical-timeline-element-date"></span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="vertical-timeline-item dot-success vertical-timeline-element">

                                                                <div>

                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>

                                                                    <div class="vertical-timeline-element-content bounce-in">

                                                                        <h4 class="timeline-title">

                                                                            Build the production release

                                                                            <span class="badge bg-danger ms-2">NEW</span>

                                                                        </h4>

                                                                        <span class="vertical-timeline-element-date"></span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="vertical-timeline-item dot-dark vertical-timeline-element">

                                                                <div>

                                                                    <span class="vertical-timeline-element-icon bounce-in"></span>

                                                                    <div class="vertical-timeline-element-content bounce-in">

                                                                        <h4 class="timeline-title">This dot has a dark state</h4>

                                                                        <span class="vertical-timeline-element-date"></span>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="tab-pane" id="tab-events-header1" role="tabpanel">

                                        <div class="scroll-area-sm">

                                            <div class="scrollbar-container">

                                                <div class="p-3">

                                                    <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">

                                                        <div class="vertical-timeline-item vertical-timeline-element">

                                                            <div>

                                                                <span class="vertical-timeline-element-icon bounce-in">

                                                                    <i class="badge badge-dot badge-dot-xl bg-success"></i>

                                                                </span>

                                                                <div class="vertical-timeline-element-content bounce-in">

                                                                    <h4 class="timeline-title">All Hands Meeting</h4>

                                                                    <p>

                                                                        Lorem ipsum dolor sic amet, today at

                                                                        <a href="javascript:void(0);">12:00 PM</a>

                                                                    </p>

                                                                    <span class="vertical-timeline-element-date"></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="vertical-timeline-item vertical-timeline-element">

                                                            <div>

                                                                <span class="vertical-timeline-element-icon bounce-in">

                                                                    <i class="badge badge-dot badge-dot-xl bg-warning"></i>

                                                                </span>

                                                                <div class="vertical-timeline-element-content bounce-in">

                                                                    <p>

                                                                        Another meeting today, at

                                                                        <b class="text-danger">12:00 PM</b>

                                                                    </p>

                                                                    <p>Yet another one, at

                                                                        <span class="text-success">15:00 PM</span>

                                                                    </p>

                                                                    <span class="vertical-timeline-element-date"></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="vertical-timeline-item vertical-timeline-element">

                                                            <div>

                                                                <span class="vertical-timeline-element-icon bounce-in">

                                                                    <i class="badge badge-dot badge-dot-xl bg-danger"></i>

                                                                </span>

                                                                <div class="vertical-timeline-element-content bounce-in">

                                                                    <h4 class="timeline-title">Build the production release</h4>

                                                                    <p>

                                                                        Lorem ipsum dolor sit amit,consectetur eiusmdd tempor

                                                                        incididunt ut labore et dolore magna elit enim at

                                                                        minim veniam quis nostrud

                                                                    </p>

                                                                    <span class="vertical-timeline-element-date"></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="vertical-timeline-item vertical-timeline-element">

                                                            <div>

                                                                <span class="vertical-timeline-element-icon bounce-in">

                                                                    <i class="badge badge-dot badge-dot-xl bg-primary"></i>

                                                                </span>

                                                                <div class="vertical-timeline-element-content bounce-in">

                                                                    <h4 class="timeline-title text-success">Something not important</h4>

                                                                    <p>

                                                                        Lorem ipsum dolor sit amit,consectetur elit enim at

                                                                        minim veniam quis nostrud

                                                                    </p>

                                                                    <span class="vertical-timeline-element-date"></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="vertical-timeline-item vertical-timeline-element">

                                                            <div>

                                                                <span class="vertical-timeline-element-icon bounce-in">

                                                                    <i class="badge badge-dot badge-dot-xl bg-success"></i>

                                                                </span>

                                                                <div class="vertical-timeline-element-content bounce-in">

                                                                    <h4 class="timeline-title">All Hands Meeting</h4>

                                                                    <p>

                                                                        Lorem ipsum dolor sic amet, today at

                                                                        <a href="javascript:void(0);">12:00 PM</a>

                                                                    </p>

                                                                    <span class="vertical-timeline-element-date"></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="vertical-timeline-item vertical-timeline-element">

                                                            <div>

                                                                <span class="vertical-timeline-element-icon bounce-in">

                                                                    <i class="badge badge-dot badge-dot-xl bg-warning"></i>

                                                                </span>

                                                                <div class="vertical-timeline-element-content bounce-in">

                                                                    <p>

                                                                        Another meeting today, at

                                                                        <b class="text-danger">12:00 PM</b>

                                                                    </p>

                                                                    <p>Yet another one, at

                                                                        <span class="text-success">15:00 PM</span>

                                                                    </p>

                                                                    <span class="vertical-timeline-element-date"></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="vertical-timeline-item vertical-timeline-element">

                                                            <div>

                                                                <span class="vertical-timeline-element-icon bounce-in">

                                                                    <i class="badge badge-dot badge-dot-xl bg-danger"></i>

                                                                </span>

                                                                <div class="vertical-timeline-element-content bounce-in">

                                                                    <h4 class="timeline-title">Build the production release</h4>

                                                                    <p>

                                                                        Lorem ipsum dolor sit amit,consectetur eiusmdd tempor

                                                                        incididunt ut labore et dolore magna elit enim at

                                                                        minim veniam quis nostrud

                                                                    </p>

                                                                    <span class="vertical-timeline-element-date"></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="vertical-timeline-item vertical-timeline-element">

                                                            <div>

                                                                <span class="vertical-timeline-element-icon bounce-in">

                                                                    <i class="badge badge-dot badge-dot-xl bg-primary"></i>

                                                                </span>

                                                                <div class="vertical-timeline-element-content bounce-in">

                                                                    <h4 class="timeline-title text-success">Something not important</h4>

                                                                    <p>

                                                                        Lorem ipsum dolor sit amit,consectetur elit enim at

                                                                        minim veniam quis nostrud

                                                                    </p>

                                                                    <span class="vertical-timeline-element-date"></span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="tab-pane" id="tab-errors-header1" role="tabpanel">

                                        <div class="scroll-area-sm">

                                            <div class="scrollbar-container">

                                                <div class="no-results pt-3 pb-0">

                                                    <div class="swal2-icon swal2-success swal2-animate-success-icon">

                                                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>

                                                        <span class="swal2-success-line-tip"></span>

                                                        <span class="swal2-success-line-long"></span>

                                                        <div class="swal2-success-ring"></div>

                                                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>

                                                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>

                                                    </div>

                                                    <div class="results-subtitle">All caught up!</div>

                                                    <div class="results-title">There are no system errors!</div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <ul class="nav flex-column">

                                    <li class="nav-item-divider nav-item"></li>

                                    <li class="nav-item-btn text-center nav-item">

                                        <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View Latest Changes</button>

                                    </li>

                                </ul>

                            </div>

                        </div>

                        <div class="dots-separator"></div>

                        <div class="dropdown">

                            <a class="dot-btn-wrapper" aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false">

                                <i class="dot-btn-icon lnr-earth icon-gradient bg-happy-itmeo"></i>

                            </a>

                            <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu">

                                <div class="dropdown-menu-header">

                                    <div class="dropdown-menu-header-inner pt-4 pb-4 bg-focus">

                                        <div class="menu-header-image opacity-05" style="background-image: url('images/dropdown-header/city2.jpg');"></div>

                                        <div class="menu-header-content text-center text-white">

                                            <h6 class="menu-header-subtitle mt-0"> Choose Language</h6>

                                        </div>

                                    </div>

                                </div>

                                <h6 tabindex="-1" class="dropdown-header"> Popular Languages</h6>

                                <button type="button" tabindex="0" class="dropdown-item">

                                    <span class="me-3 opacity-8 flag large US"></span>

                                    USA

                                </button>

                                <button type="button" tabindex="0" class="dropdown-item">

                                    <span class="me-3 opacity-8 flag large CH"></span>

                                    Switzerland

                                </button>

                                <button type="button" tabindex="0" class="dropdown-item">

                                    <span class="me-3 opacity-8 flag large FR"></span>

                                    France

                                </button>

                                <button type="button" tabindex="0" class="dropdown-item">

                                    <span class="me-3 opacity-8 flag large ES"></span>

                                    Spain

                                </button>

                                <div tabindex="-1" class="dropdown-divider"></div>

                                <h6 tabindex="-1" class="dropdown-header">Others</h6>

                                <button type="button" tabindex="0" class="dropdown-item active">

                                    <span class="me-3 opacity-8 flag large DE"></span>

                                    Germany

                                </button>

                                <button type="button" tabindex="0" class="dropdown-item">

                                    <span class="me-3 opacity-8 flag large IT"></span>

                                    Italy

                                </button>

                            </div>

                        </div>

                        <div class="dots-separator"></div>

                        <div class="dropdown">

                            <a class="dot-btn-wrapper dd-chart-btn-2" aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false">

                                <i class="dot-btn-icon lnr-pie-chart icon-gradient bg-love-kiss"></i>

                                <div class="badge badge-dot badge-abs badge-dot-sm badge-warning">Notifications</div>

                            </a>

                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu">

                                <div class="dropdown-menu-header">

                                    <div class="dropdown-menu-header-inner bg-premium-dark">

                                        <div class="menu-header-image" style="background-image: url('images/dropdown-header/abstract4.jpg');"></div>

                                        <div class="menu-header-content text-white">

                                            <h5 class="menu-header-title">Users Online</h5>

                                            <h6 class="menu-header-subtitle">Recent Account Activity Overview</h6>

                                        </div>

                                    </div>

                                </div>

                                <div class="widget-chart">

                                    <div class="widget-chart-content">

                                        <div class="icon-wrapper rounded-circle">

                                            <div class="icon-wrapper-bg opacity-9 bg-focus"></div>

                                            <i class="lnr-users text-white"></i>

                                        </div>

                                        <div class="widget-numbers">

                                            <span>344k</span>

                                        </div>

                                        <div class="widget-subheading pt-2"> Profile views since last login</div>

                                        <div class="widget-description text-danger">

                                            <span class="pe-1">

                                                <span>176%</span>

                                            </span>

                                            <i class="fa fa-arrow-left"></i>

                                        </div>

                                    </div>

                                    <div class="widget-chart-wrapper">

                                        <div id="dashboard-sparkline-carousel-4-pop"></div>

                                    </div>

                                </div>

                                <ul class="nav flex-column">

                                    <li class="nav-item-divider mt-0 nav-item"></li>

                                    <li class="nav-item-btn text-center nav-item">

                                        <button class="btn-shine btn-wide btn-pill btn btn-warning btn-sm">

                                            <i class="fa fa-cog fa-spin me-2"></i>

                                            View Details

                                        </button>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="app-footer-right">

                    <ul class="header-megamenu nav">

                        <li class="nav-item">

                            <a data-bs-placement="top" rel="popover-focus" data-offset="300" data-toggle="popover-custom" class="nav-link">

                                Footer Menu

                                <i class="fa fa-angle-up ms-2 opacity-8"></i>

                            </a>

                            <div class="rm-max-width rm-pointers">

                                <div class="d-none popover-custom-content">

                                    <div class="dropdown-mega-menu dropdown-mega-menu-sm">

                                        <div class="grid-menu grid-menu-2col">

                                            <div class="g-0 row">

                                                <div class="col-sm-6 col-xl-6">

                                                    <ul class="nav flex-column">

                                                        <li class="nav-item-header nav-item">Overview</li>

                                                        <li class="nav-item">

                                                            <a class="nav-link">

                                                                <i class="nav-link-icon lnr-inbox"></i>

                                                                <span>Contacts</span>

                                                            </a>

                                                        </li>

                                                        <li class="nav-item">

                                                            <a class="nav-link">

                                                                <i class="nav-link-icon lnr-book"></i>

                                                                <span>Incidents</span>

                                                                <div class="ms-auto badge rounded-pill bg-danger">5</div>

                                                            </a>

                                                        </li>

                                                        <li class="nav-item">

                                                            <a class="nav-link">

                                                                <i class="nav-link-icon lnr-picture"></i>

                                                                <span>Companies</span>

                                                            </a>

                                                        </li>

                                                        <li class="nav-item">

                                                            <a disabled="" class="nav-link disabled">

                                                                <i class="nav-link-icon lnr-file-empty"></i>

                                                                <span>Dashboards</span>

                                                            </a>

                                                        </li>

                                                    </ul>

                                                </div>

                                                <div class="col-sm-6 col-xl-6">

                                                    <ul class="nav flex-column">

                                                        <li class="nav-item-header nav-item">Sales &amp; Marketing</li>

                                                        <li class="nav-item">

                                                            <a class="nav-link">Queues</a>

                                                        </li>

                                                        <li class="nav-item">

                                                            <a class="nav-link">Resource Groups</a>

                                                        </li>

                                                        <li class="nav-item">

                                                            <a class="nav-link">

                                                                Goal Metrics

                                                                <div class="ms-auto badge bg-warning">3</div>

                                                            </a>

                                                        </li>

                                                        <li class="nav-item">

                                                            <a class="nav-link">Campaigns</a>

                                                        </li>

                                                    </ul>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </li>

                        <li class="nav-item">

                            <a data-bs-placement="top" rel="popover-focus" data-offset="300" data-toggle="popover-custom" class="nav-link">

                                Grid Menu

                                <div class="badge bg-dark ms-0 ms-1">

                                    <small>NEW</small>

                                </div>

                                <i class="fa fa-angle-up ms-2 opacity-8"></i>

                            </a>

                            <div class="rm-max-width rm-pointers">

                                <div class="d-none popover-custom-content">

                                    <div class="dropdown-menu-header">

                                        <div class="dropdown-menu-header-inner bg-tempting-azure">

                                            <div class="menu-header-image opacity-1" style="background-image: url('images/dropdown-header/city5.jpg');"></div>

                                            <div class="menu-header-content text-dark">

                                                <h5 class="menu-header-title">Two Column Grid</h5>

                                                <h6 class="menu-header-subtitle">Easy grid navigation inside popovers</h6>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="grid-menu grid-menu-2col">

                                        <div class="g-0 row">

                                            <div class="col-sm-6">

                                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">

                                                    <i class="lnr-lighter text-dark opacity-7 btn-icon-wrapper mb-2"></i>

                                                    Automation

                                                </button>

                                            </div>

                                            <div class="col-sm-6">

                                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">

                                                    <i class="lnr-construction text-danger opacity-7 btn-icon-wrapper mb-2"></i>

                                                    Reports

                                                </button>

                                            </div>

                                            <div class="col-sm-6">

                                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-success">

                                                    <i class="lnr-bus text-success opacity-7 btn-icon-wrapper mb-2"></i>

                                                    Activity

                                                </button>

                                            </div>

                                            <div class="col-sm-6">

                                                <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-focus">

                                                    <i class="lnr-gift text-focus opacity-7 btn-icon-wrapper mb-2"></i>

                                                    Settings

                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                    <ul class="nav flex-column">

                                        <li class="nav-item-divider nav-item"></li>

                                        <li class="nav-item-btn clearfix nav-item">

                                            <div class="float-start">

                                                <button class="btn btn-link btn-sm">Link Button</button>

                                            </div>

                                            <div class="float-end">

                                                <button class="btn-shadow btn btn-info btn-sm">Info Button</button>

                                            </div>

                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        -->

    <div class="card no-shadow bg-transparent no-border rm-borders mb-3">

        <div class="card">

            <div class="g-0 row">
				<div class="col-md-4 ">
					<ul class="list-group list-group-flush">
					
					
					
	<li class="bg-transparent list-group-item vli4">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-heading">Today's Order</div>

                                            <div class="widget-subheading"></div>

                                        </div>

                                        <div class="widget-content-right">

                                            <div class="widget-numbers text-primary">{{$todaysOrders}}</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </li>
					
					
					
					
					
						
					</ul>
				</div>
				
				<div class="col-md-4">
				<ul class="list-group list-group-flush">
			
			<li class="bg-transparent list-group-item vli1">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-heading">Total Orders</div>

                                            <div class="widget-subheading"></div>

                                        </div>

                                        <div class="widget-content-right">

                                            <div class="widget-numbers text-success">{{$totalOrders}}</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </li>
			
			
			
			
						</ul>
				</div>
				
				<div class="col-md-4">
				<ul class="list-group list-group-flush">
					
					<li class="bg-transparent list-group-item vli2">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-heading">Pending Order</div>

                                            <div class="widget-subheading"></div>

                                        </div>

                                        <div class="widget-content-right">

                                            <div class="widget-numbers text-danger">{{$pendingOrders}}</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </li>
					
					
					
					
				</ul>
		</div>
				</div>
			</div>
		</div>
			
			<div class="card no-shadow bg-transparent no-border rm-borders mb-3">

        <div class="card">
			<div class="row">
				
				<div class="col-md-6 pr0">
				<ul class="list-group list-group-flush">
				<!--today order-->
				
				<li class="bg-transparent list-group-item vli3">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-heading">Cancel Order</div>

                                            <div class="widget-subheading"></div>

                                        </div>

                                        <div class="widget-content-right">

                                            <div class="widget-numbers text-warning">{{$cancelOrders}}</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </li>
				</ul>
		</div>
				
				
				<div class="col-md-6">
				<ul class="list-group list-group-flush">
					<li class="bg-transparent list-group-item vli5">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-heading">Return Order</div>

                                            <div class="widget-subheading"></div>

                                        </div>

                                        <div class="widget-content-right">

                                            <div class="widget-numbers text-success">0</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </li>
					</ul>
		</div>
				
			</div>	
			

        </div>

    </div>

    <div class="card no-shadow bg-transparent no-border rm-borders mb-3">

        <div class="card">

            <div class="g-0 row">

                <div class="col-md-12 col-lg-3">

                    <ul class="list-group list-group-flush">

                        <li class="bg-transparent list-group-item vli6">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-heading">Total Listing</div>

                                            <div class="widget-subheading"></div>

                                        </div>

                                        <div class="widget-content-right">

                                            <div class="widget-numbers text-success">{{$totalProducts}}</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </li>

                    </ul>

                </div>
				

                <div class="col-md-12 col-lg-3">

                    <ul class="list-group list-group-flush">

                        <li class="bg-transparent list-group-item vli7">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-heading">Active Listing</div>

                                            <div class="widget-subheading"></div>

                                        </div>

                                        <div class="widget-content-right">

                                            <div class="widget-numbers text-primary">{{$activeProducts}}</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </li>

                    </ul>

                </div>

                <div class="col-md-12 col-lg-3">

                    <ul class="list-group list-group-flush">

                        <li class="bg-transparent list-group-item vli8">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-heading">Inactive Listing</div>

                                            <div class="widget-subheading"></div>

                                        </div>

                                        <div class="widget-content-right">

                                            <div class="widget-numbers text-primary">{{$inactiveProducts}}</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </li>

                    </ul>

                </div>

                <div class="col-md-12 col-lg-3">

                    <ul class="list-group list-group-flush">

                        <li class="bg-transparent list-group-item vli9">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-heading">Pending Listing</div>

                                            <div class="widget-subheading"></div>

                                        </div>

                                        <div class="widget-content-right">

                                            <div class="widget-numbers text-primary">{{$pendingProducts}}</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

    <div class="card no-shadow bg-transparent no-border rm-borders mb-3">

        <div class="card">

            <div class="g-0 row">

               

                <div class="col-md-12 col-lg-6">

                    <ul class="list-group list-group-flush">

                        <li class="bg-transparent list-group-item vli11">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-heading">Today's Income </div>


 
                                            <div class="widget-subheading"></div>

                                        </div>

                                        <div class="widget-content-right">

                                           <div class="widget-numbers text-primary"><i class="fa fa-rupee-sign"></i> {{number_format($todayincome, 2)}}</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </li>

                    </ul>

                </div>
				
				 <div class="col-md-12 col-lg-6">

                    <ul class="list-group list-group-flush">

                        <li class="bg-transparent list-group-item vli10">

                            <div class="widget-content p-0">

                                <div class="widget-content-outer">

                                    <div class="widget-content-wrapper">

                                        <div class="widget-content-left">

                                            <div class="widget-heading">Total Income</div>

                                            <div class="widget-subheading"></div>

                                        </div>

                                        <div class="widget-content-right">

                                            <div class="widget-numbers text-success"><i class="fa fa-rupee-sign"></i> {{number_format($totalincome, 2)}}</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

    <!-- </div> -->

</div>

@endsection