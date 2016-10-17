<?php
$featuredFighter = get_posts([
	'posts_per_page' => 1,
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

	<?php
	$fatAss2BadAsses = get_posts([
		'post_status' => 'publish',
		'posts_per_page' => 1,
		'posts_per_archive_page' => 1,
		'orderby' => 'rand',
		'category_name' => 'fatass-to-badass'
	]);
	if(count($fatAss2BadAsses)):
		foreach ($fatAss2BadAsses as $key => $fatAss2BadAss) :
			$imagesrc = wp_get_attachment_image_src(get_post_thumbnail_id($fatAss2BadAss->ID),'full');
			?>
			<!-- POST ITEM -->
			<div class="featured-side-article-item blog-post-item col-md-12 nopadding margin-bottom-20">
				<!-- IMAGE -->
				<figure>
						<img class="img-responsive" src="<?=$imagesrc[0]?>" alt="">
				</figure>
				<p class="nomargin">
					<?=trim_text($fatAss2BadAss->post_content,150)?>
					<br>
					<!-- <a href="<?=get_the_permalink($fatAss2BadAss->ID)?>" class="btn btn-red noradius uppercase margin-top-10" disabled> -->
					<a href="#" class="btn btn-red noradius uppercase margin-top-10 disabled">
						<span>Coming Soon</span>
					</a>
				</p>
			</div>
			<!-- /POST ITEM -->
		<?php endforeach; ?>
	<?php endif; ?>


	<?php
	$featuredVideo = get_posts([
		'post_type'   => 'iod_video',
		'post_status' => 'publish',
		'posts_per_page' => 1,
		'posts_per_archive_page' => 1,
		'orderby' => 'rand',
		'meta_key'   => '_is_featured',
		'meta_value' => 1,
		'exclude' => []
	]);
	if(count($featuredVideo)):
		foreach ($featuredVideo as $key => $video) :
			$iod_video = json_decode(get_post_meta( $video->ID, '_iod_video',true))->embed->url;
			$ytpattern = '/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/';
			if(preg_match($ytpattern,$iod_video,$vid_id)){
				$vid_id = end($vid_id);
				$iod_video_thumbnail = 'http://img.youtube.com/vi/'.$vid_id.'/mqdefault.jpg';
			}else{
				$iod_video_thumbnail = 'http://www.askgamblers.com/uploads/original/isoftbet-2-5474883270a0f81c4b8b456b.png';
			};
			?>
			<div class="col-md-12 nopadding">
				<div id="container-invest-divest">
					<div class="uppercase section-title text-white text-center weight-700 size-17">Invest or Divest</div>
					<div class="embed-responsive embed-responsive-16by9">
						<a class="embed-responsive-item image-hover main-box lightbox" href="https://www.youtube.com/watch?v=<?=$vid_id?>" data-plugin-options='{"type":"iframe"}'>
							<span class="image-hover-icon image-hover-dark">
								<i class="fa fa-play-circle"></i>
							</span>
							<img src="http://i3.ytimg.com/vi/<?=$vid_id?>/maxresdefault.jpg" alt="..." class="img-responsive">
						</a>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
