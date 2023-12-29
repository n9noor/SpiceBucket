
<?php $__env->startSection("content"); ?>
<div class="page-header mt-30 mb-75">
	<div class="container">
		<div class="archive-header">
			<div class="row align-items-center">
				<div class="col-xl-3">
					<h1 class="mb-15">Blog</h1>
					<div class="breadcrumb">
						<a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
						<span></span> Blog
					</div>
				</div>
				<!--
				<div class="col-xl-9 text-end d-none d-xl-block">
					<ul class="tags-list">
						<li class="hover-up">
							<a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Shopping</a>
						</li>
						<li class="hover-up active">
							<a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Recips</a>
						</li>
						<li class="hover-up">
							<a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Kitchen</a>
						</li>
						<li class="hover-up">
							<a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>News</a>
						</li>
						<li class="hover-up mr-0">
							<a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Food</a>
						</li>
					</ul>
				</div>
				-->
			</div>
		</div>
	</div>
</div>
<div class="page-content mb-50">
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<div class="shop-product-fillter mb-50 pr-30">
					<!--<div class="totall-product">
						<h2>
							<img class="w-36px mr-10" src="assets/imgs/theme/icons/category-1.svg" alt="" />
							Recent Articles
						</h2>
					</div>-->
					<!--
					<div class="sort-by-product-area">
						<div class="sort-by-cover mr-10">
							<div class="sort-by-product-wrap">
								<div class="sort-by">
									<span><i class="fi-rs-apps"></i>Show:</span>
								</div>
								<div class="sort-by-dropdown-wrap">
									<span> 50 <i class="fi-rs-angle-small-down"></i></span>
								</div>
							</div>
							<div class="sort-by-dropdown">
								<ul>
									<li><a class="active" href="#">50</a></li>
									<li><a href="#">100</a></li>
									<li><a href="#">150</a></li>
									<li><a href="#">200</a></li>
									<li><a href="#">All</a></li>
								</ul>
							</div>
						</div>
						<div class="sort-by-cover">
							<div class="sort-by-product-wrap">
								<div class="sort-by">
									<span><i class="fi-rs-apps-sort"></i>Sort:</span>
								</div>
								<div class="sort-by-dropdown-wrap">
									<span>Featured <i class="fi-rs-angle-small-down"></i></span>
								</div>
							</div>
							<div class="sort-by-dropdown">
								<ul>
									<li><a class="active" href="#">Featured</a></li>
									<li><a href="#">Newest</a></li>
									<li><a href="#">Most comments</a></li>
									<li><a href="#">Release Date</a></li>
								</ul>
							</div>
						</div>
					</div>
					-->
				</div>
				<div class="loop-grid pr-30">
					<div class="row">
						<?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<article class="col-xl-6 col-lg-6 col-md-6 col-sm-4 text-center hover-up mb-30 animated">
							<div class="post-thumb">
								<a href="/blog/<?php echo e($blog->category_slug); ?>/<?php echo e($blog->slug); ?>">
									<img class="border-radius-15" src="<?php echo e(!is_null($blog->featured_image) ? (env('APP_ENV') == 'production' ? url('/public/images/blogs/' . $blog->featured_image) : url('/images/blogs/' . $blog->featured_image)) : url('/assets/imgs/no-image-placeholder.png')); ?>" alt="" />
								</a>
								<div class="entry-meta">
									<!--<a class="entry-meta meta-2" href="/blog/<?php echo e($blog->category_slug); ?>/<?php echo e($blog->slug); ?>"><i class="fi-rs-heart"></i></a>-->
								</div>
							</div>
							<div class="entry-content-2">
								<h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="/blog/<?php echo e($blog->category_slug); ?>"><?php echo e($blog->categoryname); ?></a></h6>
								<h4 class="post-title mb-15">
									<a href="/blog/<?php echo e($blog->category_slug); ?>/<?php echo e($blog->slug); ?>"><?php echo e($blog->title); ?></a>
								</h4>
								<div class="entry-meta font-xs color-grey mt-10 pb-10">
									<div>
										<span class="post-on mr-10"><?php echo e(date('d F Y', strtotime($blog->created_at))); ?></span>
										<!--<span class="hit-count has-dot mr-10">126k Views</span>
										<span class="hit-count has-dot">4 mins read</span>-->
									</div>
								</div>
							</div>
						</article>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
				<!--
				<div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
					<nav aria-label="Page navigation example">
						<ul class="pagination justify-content-start">
							<li class="page-item">
								<a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
							</li>
							<li class="page-item"><a class="page-link" href="#">1</a></li>
							<li class="page-item active"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item"><a class="page-link dot" href="#">...</a></li>
							<li class="page-item"><a class="page-link" href="#">6</a></li>
							<li class="page-item">
								<a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
							</li>
						</ul>
					</nav>
				</div>
				-->
			</div>
			<div class="col-lg-3 primary-sidebar sticky-sidebar">
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
							<?php $__currentLoopData = $headercategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $headercategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li>
								<a href="/blog/<?php echo e($headercategory['slug']); ?>"> <img src="<?php echo e(env('APP_ENV') == 'production' ? url('/public/images/products/' . $headercategory['image']) : url('/images/products/' . $headercategory['image'])); ?>" alt="" /><?php echo e($headercategory['name']); ?></a><!--<span class="count"></span>-->
							</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</div>
					<!-- Product sidebar Widget -->
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/spicebucket/resources/views/blogs/frontend.blade.php ENDPATH**/ ?>