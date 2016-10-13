<?php
$featuredFighter = get_posts([
	'posts_per_page' => 2,
	'paged' => 1,
	'post_type' => [
		'fighter'
	],
	'meta_key' => '_is_featured',
	'orderby' => '_is_featured',
	'order' => 'DESC',
	'meta_query' => [
		[
			'key' => '_is_featured',
			'compare' => 'LIKE',
		]
	],
	'post_status'      => 'publish',
	]) ?: [];
	?>
	<?php if(count($featuredFighter)): ?>
		<?php foreach ($featuredFighter as $key => $fighter):
			$imagesrc = '';
			$sideview = get_post_meta($fighter->ID,'_uf_image_right',true) ?: false;
			if($sideview){
				$imagesrc = wp_get_attachment_image_src($sideview,'full');
			}

			if(empty($imagesrc)){
				$imagesrc = wp_get_attachment_image_src(get_post_thumbnail_id($fighter->ID),'full');
			}

			?>
			<div class="content-side-featuredfighter col-md-12 col-sm-6">
				<div>
					<div class="uppercase section-title text-white text-center weight-700 size-12">Featured Fighter</div>
					<h3 class="side-featuredfighter-title text-white uppercase size-17"><?=$fighter->post_title?></h3>
				</div>
				<figure style="background-image: url('<?=$imagesrc[0]?>')" class="<?=($sideview ? 'sideview' : 'defaultimage')?>">
					<!-- <img class="img-responsive <?=($sideview ? 'sideview' : 'thumbnail')?>" src="<?=$imagesrc[0]?>" alt="" /> -->
				</figure>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
