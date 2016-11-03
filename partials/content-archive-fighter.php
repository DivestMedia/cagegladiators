<?php
	$hide_old = 1;
	$featured_fighter = get_posts([
						'posts_per_page'   => 6,
						'orderby'          => 'rand',
						'post_type'        => 'fighter',
						'post_status'      => 'publish',
				        'meta_query' => array(
							array(
								'key' => '_is_featured',
								'value' => '1',
							)
						),
						'suppress_filters' => true
					]);

	$current_page_info = get_queried_object();
	// if(!empty($current_page_info->slug)){
	// 	$fighters = get_posts([
	// 					'posts_per_page'   => 12,
	// 					'paged' 			=> get_query_var('paged') ?: 1,
	// 					'orderby'          => 'title',
	// 					'order'            => 'ASC',
	// 					'post_type'        => 'fighter',
	// 					'post_status'      => 'publish',
	// 					'tax_query' => array(
	// 			            array(
	// 			                'taxonomy' => 'fighters',
	// 			                'field' => 'slug',
	// 			                'terms' => $current_page_info->slug,
	// 			            )
	// 			        ),
	// 			        'meta_query' => array(
	// 			        	'relation' => 'OR',
	// 						array(
	// 							'key' => '_is_featured',
	// 							'value' => '0',
	// 						),
	// 						array(
	// 							'key' => '_is_featured',
	// 							'compare' => 'NOT EXISTS'
	// 						),
	// 					),
	// 					'suppress_filters' => true
	// 				]);
	// }else{
	// 	$fighters = get_posts([
	// 					'posts_per_page'   => 12,
	// 					'paged' 			=> get_query_var('paged') ?: 1,
	// 					'orderby'          => 'title',
	// 					'order'            => 'ASC',
	// 					'post_type'        => 'fighter',
	// 					'post_status'      => 'publish',
	// 					'tax_query' => array(
	// 			            array(
	// 			                'taxonomy' => 'fighters',
	// 			                'field' => 'slug',
	// 			                'operator' => 'EXISTS'
	// 			            )
	// 			        ),
	// 			        'meta_query' => array(
	// 			        	'relation' => 'OR',
	// 						array(
	// 							'key' => '_is_featured',
	// 							'value' => '0',
	// 						),
	// 						array(
	// 							'key' => '_is_featured',
	// 							'compare' => 'NOT EXISTS'
	// 						),
	// 					),
	// 					'suppress_filters' => true
	// 				]);
	// }

	// $fighter_categories = get_terms( array(
	//     'taxonomy' => 'fighters',
	//     'hide_empty' => false,
	// ) );

	if(empty($fighters)){
		// die();
	}
	if(empty($current_page_info->slug)&&get_query_var('paged')==0){
?>

<section class="dark section-fighters mod-section-fighters">
	<div class="featured-figter-container">
		<div class="container">
			<header class="text-center margin-bottom-30">
				<h2 class="section-title"><strong>Featured <span>Fighters</span></strong></h2>
			</header>
			<div class="row">
			<?php
				foreach ($featured_fighter as $fighter) {
	    			$_r_win = get_post_meta( $fighter->ID, '_uf_win', true );
	    			$_r_loss = get_post_meta( $fighter->ID, '_uf_loss', true );
	    			$_r_draw = get_post_meta( $fighter->ID, '_uf_draw', true );
	    			$_image_right = get_post_meta( $fighter->ID, '_uf_image_right', true );

	    			$record = $_r_win.'-'.$_r_loss.'-'.$_r_draw;
	    			$_r_fighter_terms = get_the_terms($fighter->ID,'fighters');
	    			$f_weight_class = '';
	    			$f_weight_class_slug = '';
					if(!empty($_r_fighter_terms[0])){
						$f_weight_class = $_r_fighter_terms[0]->name;
						$f_weight_class_slug = $_r_fighter_terms[0]->slug;
					}
			?>	
					<div class="col-md-4 margin-bottom-30 mod-container-fighters">
						<div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
							<div class="front">
								<div class="box1 noradius padding-0">
									<div class="thumbnail">
										<img class="img-responsive" src="<?=wp_get_attachment_image_src($_image_right,'full')[0]?>" alt="" style="height: 400px; width: auto;" />
										<div class="caption">
											<h3 class="margin-bottom-10"><strong><?=$fighter->post_title?></strong></h3 class="margin-bottom-10"></a>
											<small class="block lbl-weightclass"><strong><?=$f_weight_class?></strong></small>
											<small class="record-cont"><?=$record?></small>
										</div>
									</div>								</div>
							</div>

							<div class="back">
								<div class="box2">
									<a href="<?=get_permalink($fighter->ID)?>"><h4 class="margin-bottom-10"><strong><?=$fighter->post_title?></strong></h4></a>
									<small class="block lbl-weightclass"><strong><?=$f_weight_class?></strong></small>
									<small class="record-cont"><?=$record?></small>
									<hr />
									<p><?=trim_text($fighter->post_content,500)?></p>
									<a href="<?=get_permalink($fighter->ID)?>" class="btn btn-translucid btn-lg btn-block btn-red noradius btn-sm">View Profile</a>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="col-sm-6 col-md-4 container-fighters">
						<a href="<?=get_permalink($fighter->ID)?>">
							<div class="thumbnail nopadding-bottom margin-bottom-0 noradius">
								<img class="img-responsive noradius" src="<?=wp_get_attachment_image_src(get_post_thumbnail_id($fighter->ID),'full')[0]?>" alt="" />
							</div>
						</a>
						<div class="fighter-details">
							<a href="<?=get_permalink($fighter->ID)?>"><h4 class="margin-bottom-0"><strong><?=$fighter->post_title?></strong></h4></a>
							<a href="<?=site_url('/fighters/'.$f_weight_class_slug)?>"><small class="block lbl-weightclass"><strong><?=$f_weight_class?></strong></small></a>
							<small class="record-cont"><?=$record?></small>
						</div>
					</div> -->
			<?php
				}
			?>
			</div>
		</div>
	</div>
</section>
<?php }
if(!$hide_old){
?>

<section id="section-fighters" class="section-fighters">
	
	<div class="container">
		
		<header class="text-center margin-bottom-30">
			<h2 class="section-title"><strong><?=$current_page_info->name!='fighter'?$current_page_info->name:'All'?> Fighters</strong></h2>
		</header>
		<div class="row">
			<div class="col-sm-3 col-md-2">
				<!-- side navigation -->
				<div class="side-nav margin-bottom-60">

					<div class="side-nav-head">
						<button class="fa fa-bars"></button>
						<h4 class="uppercase">Weight Class</h4>
					</div>

					<ul class="list-group list-unstyled">
						<li class="list-group-item <?=empty($current_page_info->slug)?'active':''?>"><a href="<?=site_url('/fighter')?>">All Fighters</a></li>
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
				<div class="hidden-xs">
					<?php dynamic_sidebar('ads-home-left')?>
				</div>
			</div>
			<div class="col-sm-9 col-md-10">
				<div class="row">
				<?php
					$cnt = count($fighters);
					foreach ($fighters as $fighter) {
            			$_r_win = get_post_meta( $fighter->ID, '_uf_win', true );
            			$_r_loss = get_post_meta( $fighter->ID, '_uf_loss', true );
            			$_r_draw = get_post_meta( $fighter->ID, '_uf_draw', true );
            			$record = $_r_win.'-'.$_r_loss.'-'.$_r_draw;
            			$_r_fighter_terms = get_the_terms($fighter->ID,'fighters');
            			$f_weight_class_slug = '';
						if(!empty($_r_fighter_terms[0])){
							$f_weight_class = $_r_fighter_terms[0]->name;
							$f_weight_class_slug = $_r_fighter_terms[0]->slug;
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
								<a href="<?=site_url('/fighters/'.$f_weight_class_slug)?>"><small class="block lbl-weightclass"><?=$f_weight_class?></small></a>
								<small><?=$record?></small>
							</div>
						</div>
				<?php
					}
				?>
				</div>
				<div class="pagination block"><?=posts_pagination(12,$cnt)?></div>
			</div>
		</div>
	</div>
</section>
<?php }?>