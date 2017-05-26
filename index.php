<?php
global $wpdb;
get_header();
get_template_part( 'partials/content', 'slider' );
get_template_part( 'partials/content', 'main-featuredfighter' );
?>
<section id="home-main-container">
	<div class="container ">
		<?php
		get_template_part( 'partials/content', 'featured-gym' );
		get_template_part( 'partials/content', 'cage-grid' );
		?>

	</div>
</section>
<?php
get_template_part( 'partials/content', 'featuredfighter' );
get_footer();
?>
