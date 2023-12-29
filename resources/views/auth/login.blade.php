@extends('layout')
@section('content')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Login
            </div>
        </div>
    </div>
    <div class="page-content pt-10 pb-10">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <img class="border-radius-15" src="assets/imgs/page/login-1.png" alt="" />
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h1 class="mb-5">Login</h1>
                                        <!-- <p class="mb-30">Don't have an account? <a href="page-register.html">Create here</a></p> -->
                                    </div>
                                    <div class="new-login-area">
                                        <form action="/login-process" method="post">
											@if(Session::has('message'))
											<p class="alert alert-danger">{{ Session::get('message') }}</p>
											@endif
                                            <div id='sign-in' class='login-setup-section'>
												@csrf
												<h3 class="request-otp-header">Please Enter Your Mobile Number or Email ID to Get the OTP</h3>
												<div class="form-group login-label">
													<input type="text" name="email" class="form-control input-edit" placeholder='Enter mobile number/Email ID' id="email" value="{{old('email')}}">
												</div>
												<button type="button" class="btn btn-default btn-lg btn-block request-otp" id='send-otp'>Get OTP</button>                                                
                                            </div>
                                            <div id='verify-otp' class="login-setup-section">
                                                <div class="back-bt-login"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
                                                <h3 class="request-otp-header">Verify OTP</h3>
                                                <div class="form-group login-label">
                                                    <input type="text" name="password" class="form-control input-edit" placeholder='Enter OTP' id="password">
                                                    <label style="cursor:pointer;
                                                    " class="pull-right resend-otp" id='resend-otp' >Resend otp</label>
                                                </div>

                                                <button type="submit" id="verify-otp" class="btn btn-default btn-lg btn-block request-otp ">Verify</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('javascript')
<script>
$(document).ready(function() {
    $('#email').keypress(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            if ($.trim($('#email').val()).length == 0) {
                $('#email').addClass('is-invalid');
                $('#email').attr('aria-describedby', 'email-error');
                $('#email').attr('aria-invalid', 'true');
                $('#email').parent().append("<em id='email-error' class='error invalid-feedback'>Email ID or Phone is required.</em>");
            } else {
                $('#send-otp').trigger('click');
            }
        }
    });
    $('#password').keypress(function(event) {
        if (event.keyCode == 13) {
            $('#verify-otp').trigger('click');
        }
    });
	@if(Session::has('message'))
	$('#sign-in').hide();
	$('#verify-otp').show();
	@endif
});
</script>
@endpush