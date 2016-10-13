<?php
	get_header();

	get_template_part( 'partials/content', 'slider' );
	get_template_part( 'partials/content', 'main-featuredfighter' );
?>
	<section id="home-main-container">
		<div class="container ">
			<?php
				get_template_part( 'partials/content', 'featured-gym' );
			?>
			<div class="row padding-10">
				<div class="col-sm-3 col-md-2 margin-bottom-20 main-section-container hidden-xs">
					<?php dynamic_sidebar('ads-home-left')?>
				</div>
				<div id="container-featured-news" class="col-sm-9 col-md-6 margin-bottom-20 main-section-container">

					<div id="news-nav-container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation"><a href="#onefc" aria-controls="onefc" role="tab" data-toggle="tab">ONEFC</a></li>
							<li role="presentation" class="active"><a href="#ufc" aria-controls="ufc" role="tab" data-toggle="tab">UFC</a></li>
							<li role="presentation"><a href="#pxc" aria-controls="pxc" role="tab" data-toggle="tab">PXC</a></li>
							<li role="presentation"><a href="#urcc" aria-controls="urcc" role="tab" data-toggle="tab">URCC</a></li>
						</ul>
						<!-- Nav tabs end -->
					</div>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane" id="onefc">.asdasd</div>
						<div role="tabpanel" class="tab-pane active" id="ufc">
							<div class="featured-news-row">
								<div class="row">
									<div class="col-md-4">event</div>
									<div class="col-md-4">news content</div>
									<div class="col-md-4">news thumb</div>
								</div>
							</div>
							<div class="other-news-row">
								<div class="uppercase section-title text-white text-center weight-700 size-17 margin-bottom-10">Inside The Cage</div>
								<div class="latest-news-container margin-bottom-10">
									<img src="/wp-content/themes/cagegladiators/assets/img/sample-news-1.png" alt="" style="width: 100%;height: auto;">
									<div class="latest-news-details">
										<div><span class="latest-news-date uppercase">OCT 12</span><span class="latest-news-category uppercase">UFC NEWS</span></div>
										<div class="latest-news-title uppercase weight-700">UFC 204 Talking Points: Bisping, Hendo, Mousasi &amp; more</div>
									</div>
								</div>
								<div class="other-news-container row">
									<div class="col-sm-4">
										<figure class="box-shadow-8">
											<img class="img-responsive" src="/wp-content/themes/cagegladiators/assets/img/sample-news-2.png" alt="" />
										</figure>
										<div class="other-news-title margin-top-10 size-13"><a href="#">UFC 204 Bonus Recap</a></div>
									</div>
									<div class="col-sm-4">
										<figure class="box-shadow-8">
											<img class="img-responsive" src="/wp-content/themes/cagegladiators/assets/img/sample-news-3.png" alt="" />
										</figure>
										<div class="other-news-title margin-top-10 size-13"><a href="#">UFC 204 final results and news</a></div>
									</div>
									<div class="col-sm-4">
										<figure class="box-shadow-8">
											<img class="img-responsive" src="/wp-content/themes/cagegladiators/assets/img/sample-news-4.png" alt="" />
										</figure>
										<div class="other-news-title size-13"><a href="#">Perry KOs Roberts in terrific UFC FIGHT PASS featured fight</a></div>
									</div>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="pxc">...</div>
						<div role="tabpanel" class="tab-pane" id="urcc">...</div>
					</div>
					<!-- Tab panes end -->
					<div id="container-cage-corner">
						<div class="uppercase section-title text-white text-center weight-700 size-17">Cage Corner</div>
						<div class="content-cage-corner">
							<div>
								<div class="uppercase content-category text-white">Invest or divest</div>
								<div class="uppercase content-category-label text-white">Learn from the best</div>
								<div class="uppercase content-fighter text-white">
									<label>Elite MMA Trainer</label>
									<h1 class="text-white">Brock Lesnar</h1>
								</div>
								<div class="content-button"><button type="button" class="btn btn-danger">CLICK HERE</button></div>
							</div>
							<img src="/wp-content/themes/cagegladiators/assets/img/cage-corner-fighter-1.png" alt="" style="width: 50%;height: auto;">
						</div>
					</div>
				</div>
				<div id="container-side-featuredfighter" class="col-sm-12 col-md-4 margin-bottom-20 main-section-container">
					<?php
						get_template_part( 'partials/content', 'side-featuredfighter' );
					?>
				</div>
			</div>
		</div>
	</section>
<?php
	get_template_part( 'partials/content', 'featuredfighter' );
	get_footer();
?>
