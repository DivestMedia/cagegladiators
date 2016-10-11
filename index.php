<?php
	get_header();

	get_template_part( 'partials/content', 'slider' );
	get_template_part( 'partials/content', 'main-featuredfighter' );
?>
	<section id="home-main-container">
		<div class="container">
			<?php
				get_template_part( 'partials/content', 'featured-gym' );
			?>	
			<div class="row">
				<div class="col-md-2">
					ads
				</div>
				<div class="col-md-6">
					news
				</div>
				<div class="col-md-4">
					featured fighter side
				</div>
			</div>
		</div>
	</section>
<?php
	get_footer();
?>