@extends("layout")
@section("content")

<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> About us
            </div>
        </div>
    </div>
    <div class="page-content pt-50" id="about-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <section class="row align-items-center mb-50">
                        <div class="col-lg-6">
                            <img {{array_key_exists('sideimage', $about) && strlen($about['sideimage']) > 0 ? "src=" . (env('APP_ENV') == "production" ? url('/public/images/staticImages/about-us.png' . $about['sideimage']) : url('/images/staticImages/about-us.png' . $about['sideimage'])) : "src='assets/imgs/page/about-1.png'"}} alt="" class="border-radius-15 mb-md-3 mb-lg-0 mb-sm-4"  />
						
							<img src='http://spicebucket.net/images/staticImages/what-we-do.png' />
                        </div>
                        <div class="col-lg-6">
                            <div class="pl-25 about-head">
                                <h2 class="mb-10">{{array_key_exists('title', $about) && strlen($about['title']) > 0 ? $about['title'] : 'Welcome to Spice Bucket'}}</h2>
								@if(array_key_exists('description', $about) && strlen($about['description']) > 0)
								{!! $about['description']; !!}
								@else
								<p class="mb-25">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate id est laborum.</p>
							@endif
                            </div>
                        </div>
                    </section>
                    <section class="text-center">
                        <h2 class="title style-3">{{array_key_exists('maintitle', $about) && strlen($about['maintitle']) > 0 ? $about['maintitle'] : 'What We Provide?'}}</h2>
                        <div class="row">
                            @if(array_key_exists('boxtitle', $about))
                            @for($i=0; $i<count($about['boxtitle']); $i++)
                            @if(!is_null($about['boxtitle'][$i]))
                            <div class="col-lg-4 col-md-6 mb-24">
                                <div class="featured-card">
                                <img (array_key_exists($i, $about) && array_key_exists('boximage', $about[$i]) && strlen($about[$i]['boximage']) > 0) ?  src="{{(env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $about[$i]['boximage']) : url('/images/staticImages/' . $about[$i]['boximage']))}}" : src="assets/imgs/theme/icons/icon-1.svg" alt="" />
								
                                    <h4> {{$about['boxtitle'][$i]}}</h4>
                                    <p>{{$about['boxsubtitle'][$i]}}</p>
                                </div>
                            </div>
                            @endif
                            @endfor
                            @endif
                        </div>
                    </section>
                    <section class="row align-items-center mb-50">
                        <div class="row mb-50 align-items-center">
                            <div class="col-lg-7 pr-30">
                                <img src="{{array_key_exists('firstimage', $about) && strlen($about['firstimage']) > 0 ? (env('APP_ENV') == "production" ? url('/public/images/staticImages/' . $about['firstimage']) : url('/images/staticImages/' . $about['firstimage'])) : ""}}" alt="" class="mb-md-3 mb-lg-0 mb-sm-4" />
									<img src='http://spicebucket.net/images/staticImages/about-us.png' />
                            </div>
                            <div class="col-lg-5">
                                <h4 class="mb-20 text-muted">{{array_key_exists('optitle', $about) && strlen($about['optitle']) > 0 ? $about['optitle'] : 'Our performance'}}</h4>
                                <h1 class="heading-1 mb-40">{{array_key_exists('opsubtitle', $about) && strlen($about['opsubtitle']) > 0 ? $about['opsubtitle'] : 'Your Partner for e-commerce grocery solution'}}</h1>
                                <p class="mb-30">{{array_key_exists('opdescription', $about) && strlen($about['opdescription']) > 0 ? $about['opdescription'] : 'Ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto'}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 pr-30 mb-md-5 mb-lg-0 mb-sm-5">
                                <h3 class="mb-30">{{array_key_exists('wwatitle', $about) && strlen($about['wwatitle']) > 0 ? $about['wwatitle'] : 'Who we are'}}</h3>
                                <p>{{array_key_exists('wwadescription', $about) && strlen($about['wwadescription']) > 0 ? $about['wwadescription'] : 'Volutpat diam ut venenatis tellus in metus. Nec dui nunc mattis enim ut tellus eros donec ac odio orci ultrices in. ellus eros donec ac odio orci ultrices in.'}}</p>
                            </div>
                            <div class="col-lg-4 pr-30 mb-md-5 mb-lg-0 mb-sm-5">
                                <h3 class="mb-30">{{array_key_exists('ohtitle', $about) && strlen($about['ohtitle']) > 0 ? $about['ohtitle'] : 'Our history'}}</h3>
                                <p>{{array_key_exists('ohdescription', $about) && strlen($about['ohdescription']) > 0 ? $about['ohdescription'] : 'Volutpat diam ut venenatis tellus in metus. Nec dui nunc mattis enim ut tellus eros donec ac odio orci ultrices in. ellus eros donec ac odio orci ultrices in.'}}</p>
                            </div>
                            <div class="col-lg-4">
                                <h3 class="mb-30">{{array_key_exists('omtitle', $about) && strlen($about['omtitle']) > 0 ? $about['omtitle'] : 'Our mission'}}</h3>
                                <p>{{array_key_exists('omdescription', $about) && strlen($about['omdescription']) > 0 ? $about['omdescription'] : 'Volutpat diam ut venenatis tellus in metus. Nec dui nunc mattis enim ut tellus eros donec ac odio orci ultrices in. ellus eros donec ac odio orci ultrices in.'}}</p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <section class="container mb-50 d-none d-md-block">
            <div class="row about-count">
                <div class="col-lg-1-5 col-md-6 text-center mb-lg-0 mb-md-5">
                    <h1 class="heading-1"><span class="count">{{array_key_exists('rating1', $about) && strlen($about['rating1']) > 0 ? $about['rating1'] : '12'}}</span>+</h1>
                    <h4>{{array_key_exists('ratingtext1', $about) && strlen($about['ratingtext1']) > 0 ? $about['ratingtext1'] : 'Glorious years'}}</h4>
                </div>
                <div class="col-lg-1-5 col-md-6 text-center">
                    <h1 class="heading-1"><span class="count">{{array_key_exists('rating2', $about) && strlen($about['rating2']) > 0 ? $about['rating2'] : '36'}}</span>+</h1>
                    <h4>{{array_key_exists('ratingtext2', $about) && strlen($about['ratingtext2']) > 0 ? $about['ratingtext2'] : 'Happy clients'}}</h4>
                </div>
                <div class="col-lg-1-5 col-md-6 text-center">
                    <h1 class="heading-1"><span class="count">{{array_key_exists('rating3', $about) && strlen($about['rating3']) > 0 ? $about['rating3'] : '58'}}</span>+</h1>
                    <h4>{{array_key_exists('ratingtext3', $about) && strlen($about['ratingtext3']) > 0 ? $about['ratingtext3'] : 'Projects complete'}}</h4>
                </div>
                <div class="col-lg-1-5 col-md-6 text-center">
                    <h1 class="heading-1"><span class="count">{{array_key_exists('rating4', $about) && strlen($about['rating4']) ? $about['rating4'] : '24'}}</span>+</h1>
                    <h4>{{array_key_exists('ratingtext4', $about) && strlen($about['ratingtext4']) ? $about['ratingtext4'] : 'Team advisor'}}</h4>
                </div>
                <div class="col-lg-1-5 text-center d-none d-lg-block">
                    <h1 class="heading-1"><span class="count">{{array_key_exists('rating5', $about) && strlen($about['rating5']) ? $about['rating5'] : '26'}}</span>+</h1>
                    <h4>{{array_key_exists('ratingtext5', $about) && strlen($about['ratingtext5']) ? $about['ratingtext5'] : 'Products Sale'}}</h4>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <section class="mb-50">
                        <h2 class="title style-3 mb-40 text-center">Our Team</h2>
                        <div class="row">
                            <div class="col-lg-4 mb-lg-0 mb-md-5 mb-sm-5">
                                <h6 class="mb-5 text-brand">Our Team</h6>
                                <h1 class="mb-30">Meet Our Expert Team</h1>
                                <p class="mb-30">Proin ullamcorper pretium orci. Donec necscele risque leo. Nam massa dolor imperdiet neccon sequata congue idsem. Maecenas malesuada faucibus finibus.</p>
                                <p class="mb-30">Proin ullamcorper pretium orci. Donec necscele risque leo. Nam massa dolor imperdiet neccon sequata congue idsem. Maecenas malesuada faucibus finibus.</p>
                                <a href="#" class="btn">View All Members</a>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="team-card">
                                            <img src="assets/imgs/page/about-6.png" alt="" />
                                            <div class="content text-center">
                                                <h4 class="mb-5">H. Merinda</h4>
                                                <span>CEO & Co-Founder</span>
                                                <div class="social-network mt-20">
                                                    <a href="#"><img src="assets/imgs/theme/icons/icon-facebook-brand.svg" alt="" /></a>
                                                    <a href="#"><img src="assets/imgs/theme/icons/icon-twitter-brand.svg" alt="" /></a>
                                                    <a href="#"><img src="assets/imgs/theme/icons/icon-instagram-brand.svg" alt="" /></a>
                                                    <a href="#"><img src="assets/imgs/theme/icons/icon-youtube-brand.svg" alt="" /></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="team-card">
                                            <img src="assets/imgs/page/about-8.png" alt="" />
                                            <div class="content text-center">
                                                <h4 class="mb-5">Dilan Specter</h4>
                                                <span>Head Engineer</span>
                                                <div class="social-network mt-20">
                                                    <a href="#"><img src="assets/imgs/theme/icons/icon-facebook-brand.svg" alt="" /></a>
                                                    <a href="#"><img src="assets/imgs/theme/icons/icon-twitter-brand.svg" alt="" /></a>
                                                    <a href="#"><img src="assets/imgs/theme/icons/icon-instagram-brand.svg" alt="" /></a>
                                                    <a href="#"><img src="assets/imgs/theme/icons/icon-youtube-brand.svg" alt="" /></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection