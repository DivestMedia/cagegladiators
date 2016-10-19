<?php

	$current_page_info = get_queried_object();
	if(!empty($current_page_info->slug)){
		$fighters = get_posts([
						'posts_per_page'   => 12,
						'paged' 			=> get_query_var('paged') ?: 1,
						'orderby'          => 'date',
						'order'            => 'DESC',
						'post_type'        => 'fighter',
						'post_status'      => 'publish',
						'tax_query' => array(
				            array(
				                'taxonomy' => 'fighters',
				                'field' => 'slug',
				                'terms' => $current_page_info->slug,
				            )
				        ),
						'suppress_filters' => true
					]);
	}else{
		$fighters = get_posts([
						'posts_per_page'   => 12,
						'paged' 			=> get_query_var('paged') ?: 1,
						'orderby'          => 'date',
						'order'            => 'DESC',
						'post_type'        => 'fighter',
						'post_status'      => 'publish',
						'suppress_filters' => true
					]);
	}

	$fighter_categories = get_terms( array(
	    'taxonomy' => 'fighters',
	    'hide_empty' => false,
	) );

	if(empty($fighters)){
		// die();
	}
?>

<section id="section-fighters">
	<div class="container">
		<div class="row">
			<div class="col-sm-3 col-md-2">
				<!-- side navigation -->
				<div class="side-nav margin-bottom-60">

					<div class="side-nav-head">
						<button class="fa fa-bars"></button>
						<h4 class="uppercase">Weight Class</h4>
					</div>

					<ul class="list-group list-unstyled">
						<?php
							if(!empty($fighter_categories)){
								foreach ($fighter_categories as $category) {
									$isactive = '';
									if(!empty($current_page_info->name)){
										if($current_page_info->name == $category->name)
											$isactive = 'active';
									}
						?>
									<li class="list-group-item <?=$isactive?>"><a href="<?=get_term_link($category->term_id)?>"><?=$category->name?></a></li>
						<?php
								}
							}
						?>
					</ul>

				</div>
				<!-- /side navigation -->
			</div>
			<div class="col-sm-9 col-md-8">
				<?php
					foreach ($fighters as $fighter) {
            			$_r_win = get_post_meta( $fighter->ID, '_uf_win', true );
            			$_r_loss = get_post_meta( $fighter->ID, '_uf_loss', true );
            			$_r_draw = get_post_meta( $fighter->ID, '_uf_draw', true );
            			$record = $_r_win.'-'.$_r_loss.'-'.$_r_draw;
            			$_r_fighter_terms = get_the_terms($fighter->ID,'fighters');
            			$f_weight_class = '';
						if(!empty($_r_fighter_terms[0])){
							$f_weight_class = $_r_fighter_terms[0]->name;
						}
				?>	
						<div class="col-sm-6 col-md-4 container-fighters">
							<a href="<?=get_permalink($fighter->ID)?>">
								<div class="thumbnail nopadding-bottom margin-bottom-0 noradius">
									<img class="img-responsive noradius" src="<?=wp_get_attachment_image_src(get_post_thumbnail_id($fighter->ID),'full')[0]?>" alt="" />
								</div>
							</a>
							<div class="fighter-details">
								<a href="<?=get_permalink($fighter->ID)?>"><h4 class="margin-bottom-0"><?=$fighter->post_title?></h4></a>
								<small class="block lbl-weightclass"><?=$f_weight_class?></small>
								<small><?=$record?></small>
							</div>
						</div>
				<?php
					}
				?>
				<div class="pagination block"><?=posts_pagination(12)?></div>
			</div>
			<div class="col-md-2 hidden-sm hidden-xs"><?php dynamic_sidebar('ads-home-left')?></div>
		</div>
	</div>
</section>