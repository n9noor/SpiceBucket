@extends("layout")
@section("content")


<main id="main-section" class="main ">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <div class="breadcrumb-item d-inline-block"><a href="/" title="Home"> Home </a></div><span></span>
                <div class="breadcrumb-item d-inline-block active">
                    <div itemprop="item"> Contact </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <!--<section class="mb-60">
            <div class="ck-content">
                <p></p>
                <div class="page_speed_1180448002">
                    <div class="page_speed_661564668">
				<!--	<iframe width="100%" height="500" src="{{array_key_exists('googlemaplink', $contact) && strlen($contact['googlemaplink']) > 0 ? $contact['googlemaplink'] : 'https://maps.google.com/maps?q=502 New Street, Brighton VIC, Australia%20&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed'}}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
				
				-->

        <!--</div>
                </div>
                <div class="mt-50 pb-50">
                    <div class="row">
                        @php $count=array_key_exists('officename', $contact) ? count($contact['officename']) : 0; @endphp
                        @for($i=0; $i<($count); $i++) <div class="col-md-4 mb-4 mb-md-0">
                            <h4 class="mb-15 text-muted">{{array_key_exists('officename', $contact) && strlen($contact['officename'][$i]) > 0 ? $contact['officename'][$i] : 'Head Office'}}</h4>{{array_key_exists('officeaddress', $contact) && strlen($contact['officeaddress'][$i]) > 0 ? $contact['officeaddress'][$i] : '205 North Michigan Avenue, Suite 810, Chicago, 60601, USA'}}<br><abbr title="Phone">Phone: </abbr>{{array_key_exists('officephone', $contact) && strlen($contact['officephone'][$i]) > 0 ? $contact['officephone'][$i] : '(+01) 234 567'}}<br><abbr title="Email">Email: </abbr>{{array_key_exists('officeemail', $contact) && strlen($contact['officeemail'][$i]) > 0 ? $contact['officeemail'][$i] : 'office@botble.com'}}<br><a href="{{array_key_exists('officemapurl', $contact) && strlen($contact['officemapurl'][$i]) > 0 ? $contact['officemapurl'][$i] : 'https://maps.google.com/?q=205+North+Michigan+Avenue%2C+Suite+810%2C+Chicago%2C+60601%2C+USA'}}" class="btn btn-outline btn-sm btn-brand-outline font-weight-bold text-brand bg-white text-hover-white mt-20 border-radius-5 btn-shadow-brand hover-up"><i class="fa fa-map text-muted mr-15"></i>View map</a>
                    </div>
                    @endfor
                </div>
            </div>
            </section>-->
        <p></p>
        <p></p>
        <section class="mt-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="contact_page_Heading">
                            <h3 class="mb-10 text-center">Drop Us a Line</h3>
                            <p class="text-muted mb-30 text-center font-sm">

                            <!-- Contact Us For Any Query -->
                        </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="contact-info-section">
                            <img src="/assets/imgs/contact-us.png" alt="Contact Us">
                            <!--<ul>
									<li><a href="mailto:info@spicebucket.com">Email:- info@spicebucket.com</a></li>
									<li><a href="tel:+91 120 4268011">Support:-  +91 120 4268011</a> | <a href="tel:+91 7247247070">+91 7247247070</a></li>
								</ul>-->
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="contact-from-area padding-20-row-col wow tmFadeInUp animated page_speed_1653790491 animated" style="visibility: visible;">
                            <form method="POST" action="/customer-enquiry" accept-charset="UTF-8" class="contact-form-style text-center contact-form">
                                @if(Session::has('message'))
                                <p class="alert alert-success">{{ Session::get('message') }}</p>
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20"><input name="name" id="name" value="" placeholder="Name" type="text">
                                            @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20"><input type="email" id="email" name="email" value="" placeholder="Email">
                                            @error('email')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20"><input name="address" id="address" value="" placeholder="Address" type="text">
                                            @error('address')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20"><input name="phone" id="phone" value="" placeholder="Phone" type="tel">
                                            @error('phone')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20"><input name="subject" id="subject" value="" placeholder="Subject" type="text">
                                            @error('subject')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="contact-radio">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type" id="type-customer" value="customer">
                                                <label class="form-check-label" for="type-customer">I am Customer</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type" id="type-seller" value="seller">
                                                <label class="form-check-label" for="type-seller">I am Seller</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="textarea-style mb-20"><textarea rows="2" name="content" id="content" placeholder="Message"></textarea>
                                            @error('content')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12"><button type="submit" class="submit submit-auto-width">Send message</button></div>
                                </div>
                                <div class="form-group text-left">
                                    <div class="contact-message contact-success-message mt-30 page_speed_396253282"></div>
                                    <div class="contact-message contact-error-message mt-30 page_speed_396253282"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact-bottom-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 pl0">
                        <div class="contact-bottom-f-text">
                            <h4>Need to Contact Spice Bucket Seller Support Team</h4>
                            <p><strong>Email us</strong>:- <a href="mailto:sellersupport@spicebucket.com">sellersupport@spicebucket.com</a></p>
                            <p><strong>Call us</strong>:- <a href="tel:+91 7247247070">+91 7247247070</a></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-footer-right">
                            <img src="/assets/imgs/left-image-seller.png" alt="Contact Us">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <p></p>
    </div>

    </div>
</main>

@endsection