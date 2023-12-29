@extends("layout")
@section("content")
<div class="page-header breadcrumb-wrap">
	<div class="container">
		<div class="breadcrumb">
			<a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
			<span></span> <a href="/blog">Blog</a> <span></span> {{$blog->title}}
		</div>
	</div>
</div>
<div class="page-content mb-50">
	<div class="container">
		<div class="row">
			<div class="col-xl-11 col-lg-12 m-auto">
				<div class="row">
					<div class="col-lg-9">
						<div class="single-page pt-50 pr-30">
							<div class="single-header style-2">
								<div class="row">
									<div class="col-xl-10 col-lg-12">
										<h6 class="mb-10"><a href="/blog">Blog</a></h6>
										<h2 class="mb-10">{{$blog->title}}</h2>
										<div class="single-header-meta">
											<div class="entry-meta meta-1 font-xs mt-15 mb-15">
												<a class="author-avatar" href="#">
													<img class="img-circle" src="/backend/images/avatars/1.jpg" alt="" />
												</a>
												<span class="post-by">By <a href="#">{{$blog->created_by}}</a></span>
												<span class="post-on has-dot">{{date('d F Y H:i A', strtotime($blog->created_at))}}</span>
												<!--<span class="time-reading has-dot">8 mins read</span>-->
											</div>
											<!--
											<div class="social-icons single-share">
												<ul class="text-grey-5 d-inline-block">
													<li class="mr-5">
														<a href="#"><img src="assets/imgs/theme/icons/icon-bookmark.svg" alt="" /></a>
													</li>
													<li>
														<a href="#"><img src="assets/imgs/theme/icons/icon-heart-2.svg" alt="" /></a>
													</li>
												</ul>
											</div>
											-->
										</div>
									</div>
								</div>
							</div>
							<figure class="single-thumbnail">
								<img src="{{ !is_null($blog->featured_image) ? (env('APP_ENV') == 'production' ? url('/public/images/blogs/' . $blog->featured_image) : url('/images/blogs/' . $blog->featured_image)) : url('/assets/imgs/no-image-placeholder.png') }}" alt="" />
							</figure>
							<div class="single-content">
								<div class="row">
									<div class="col-xl-10 col-lg-12">
										{!! $blog->description !!}
										<!--Entry bottom-->
										<!--
										<div class="entry-bottom mt-50 mb-30">
											<div class="tags w-50 w-sm-100">
												<a href="blog-category-big.html" rel="tag" class="hover-up btn btn-sm btn-rounded mr-10">deer</a>
												<a href="blog-category-big.html" rel="tag" class="hover-up btn btn-sm btn-rounded mr-10">nature</a>
												<a href="blog-category-big.html" rel="tag" class="hover-up btn btn-sm btn-rounded mr-10">conserve</a>
											</div>
											<div class="social-icons single-share">
												<ul class="text-grey-5 d-inline-block">
													<li><strong class="mr-10">Share this:</strong></li>
													<li class="social-facebook">
														<a href="#"><img src="assets/imgs/theme/icons/icon-facebook.svg" alt="" /></a>
													</li>
													<li class="social-twitter">
														<a href="#"><img src="assets/imgs/theme/icons/icon-twitter.svg" alt="" /></a>
													</li>
													<li class="social-instagram">
														<a href="#"><img src="assets/imgs/theme/icons/icon-instagram.svg" alt="" /></a>
													</li>
													<li class="social-linkedin">
														<a href="#"><img src="assets/imgs/theme/icons/icon-pinterest.svg" alt="" /></a>
													</li>
												</ul>
											</div>
										</div>
										-->
										<!--Author box-->
										<!--
										<div class="author-bio p-30 mt-50 border-radius-15 bg-white">
											<div class="author-image mb-30">
												<a href="author.html"><img src="assets/imgs/blog/author-1.png" alt="" class="avatar" /></a>
												<div class="author-infor">
													<h5 class="mb-5">Barbara Cartland</h5>
													<p class="mb-0 text-muted font-xs">
														<span class="mr-10">306 posts</span>
														<span class="has-dot">Since 2012</span>
													</p>
												</div>
											</div>
											<div class="author-des">
												<p>Hi there, I am a veteran food blogger sharing my daily all kinds of healthy and fresh recipes. I find inspiration in nature, on the streets and almost everywhere. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Amet id enim, libero sit. Est donec lobortis cursus amet, cras elementum libero</p>
											</div>
										</div>
										-->
										<!--Comment form-->
										<!--
										<div class="comment-form">
											<h3 class="mb-15">Leave a Comment</h3>
											<div class="product-rate d-inline-block mb-30"></div>
											<div class="row">
												<div class="col-lg-9 col-md-12">
													<form class="form-contact comment_form mb-50" action="#" id="commentForm">
														<div class="row">
															<div class="col-12">
																<div class="form-group">
																	<textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="form-group">
																	<input class="form-control" name="name" id="name" type="text" placeholder="Name" />
																</div>
															</div>
															<div class="col-sm-6">
																<div class="form-group">
																	<input class="form-control" name="email" id="email" type="email" placeholder="Email" />
																</div>
															</div>
															<div class="col-12">
																<div class="form-group">
																	<input class="form-control" name="website" id="website" type="text" placeholder="Website" />
																</div>
															</div>
														</div>
														<div class="form-group">
															<button type="submit" class="button button-contactForm">Post Comment</button>
														</div>
													</form>
													<div class="comments-area">
														<h3 class="mb-30">Comments</h3>
														<div class="comment-list">
															<div class="single-comment justify-content-between d-flex mb-30">
																<div class="user justify-content-between d-flex">
																	<div class="thumb text-center">
																		<img src="assets/imgs/blog/author-2.png" alt="" />
																		<a href="#" class="font-heading text-brand">Sienna</a>
																	</div>
																	<div class="desc">
																		<div class="d-flex justify-content-between mb-10">
																			<div class="d-flex align-items-center">
																				<span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
																			</div>
																			<div class="product-rate d-inline-block">
																				<div class="product-rating" style="width: 80%"></div>
																			</div>
																		</div>
																		<p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
																	</div>
																</div>
															</div>
															<div class="single-comment justify-content-between d-flex mb-30 ml-30">
																<div class="user justify-content-between d-flex">
																	<div class="thumb text-center">
																		<img src="assets/imgs/blog/author-3.png" alt="" />
																		<a href="#" class="font-heading text-brand">Brenna</a>
																	</div>
																	<div class="desc">
																		<div class="d-flex justify-content-between mb-10">
																			<div class="d-flex align-items-center">
																				<span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
																			</div>
																			<div class="product-rate d-inline-block">
																				<div class="product-rating" style="width: 80%"></div>
																			</div>
																		</div>
																		<p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
																	</div>
																</div>
															</div>
															<div class="single-comment justify-content-between d-flex">
																<div class="user justify-content-between d-flex">
																	<div class="thumb text-center">
																		<img src="assets/imgs/blog/author-4.png" alt="" />
																		<a href="#" class="font-heading text-brand">Gemma</a>
																	</div>
																	<div class="desc">
																		<div class="d-flex justify-content-between mb-10">
																			<div class="d-flex align-items-center">
																				<span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
																			</div>
																			<div class="product-rate d-inline-block">
																				<div class="product-rating" style="width: 80%"></div>
																			</div>
																		</div>
																		<p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										-->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 primary-sidebar sticky-sidebar pt-50">
						<div class="widget-area">
							<!--
							<div class="sidebar-widget-2 widget_search mb-50">
								<div class="search-form">
									<form action="#">
										<input type="text" placeholder="Search…" />
										<button type="submit"><i class="fi-rs-search"></i></button>
									</form>
								</div>
							</div>
							-->
							<div class="sidebar-widget widget-category-2 mb-50">
								<h5 class="section-title style-1 mb-30">Category</h5>
								<ul>
									@foreach($headercategories as $headercategory)
									<li>
										<a href="/blog/{{$headercategory['slug']}}"> <img src="{{ env('APP_ENV') == 'production' ? url('/public/images/products/' . $headercategory['image']) : url('/images/products/' . $headercategory['image']) }}" alt="" />{{ $headercategory['name'] }}</a><!--<span class="count"></span>-->
									</li>
									@endforeach
								</ul>
							</div>
							<!-- Product sidebar Widget -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection