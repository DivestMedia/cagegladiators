<?php
	$hide_old = 1;
	$team_cage_fighter = get_posts([
						'posts_per_page'   => 6,
						'meta_key'          => '_uf_win',
						'orderby'          => 'meta_value',
						'order'       		=> 'DESC',
						'meta_type'       		=> 'NUMERIC',
						'post_type'        => 'fighter',
						'post_status'      => 'publish',
						'tag'              => 'team-cage',
				        'meta_query' => array(
							array(
								'key' => '_is_featured',
								'value' => '1',
							)
						),
						'suppress_filters' => true
					]);
	$cg_tag = get_term_by('slug', 'team-cage', 'post_tag');

	$featured_fighter = get_posts([
						'posts_per_page'   => 8,
						'orderby'          => 'rand',
						'post_type'        => 'fighter',
						'post_status'      => 'publish',
						'tag__not_in'      => [$cg_tag->term_id],
				        'meta_query' => array(
							array(
								'key' => '_is_featured',
								'value' => '1',
							)
						),
						'suppress_filters' => true
					]);

	$current_page_info = get_queried_object();

	if(empty($current_page_info->slug)&&get_query_var('paged')==0){
?>

<section class="dark section-fighters mod-section-fighters">
	<div class="featured-figter-container">
		<div class="container">
			<header class="text-center margin-bottom-30">
				<h2 class="section-title"><strong>Cage Gladiators <span>Sponsored Fighters</span></strong></h2>
			</header>
			<div class="row">
			<?php
				foreach ($team_cage_fighter as $fighter) {
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
					<div class="col-sm-6 col-md-3 margin-bottom-30 mod-container-fighters">
						<div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
							<div class="front">
								<div class="box1 noradius padding-0">
									<div class="thumbnail">
										<img class="img-responsive" src="<?=wp_get_attachment_image_src($_image_right,'full')[0]?>" alt="" style="height: 420px; width: auto;" />
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
									<p><?=trim_text($fighter->post_content,470)?></p>
									<a href="<?=get_permalink($fighter->ID)?>" class="btn btn-translucid btn-lg btn-block btn-red noradius btn-sm">View Profile</a>
								</div>
							</div>
						</div>
					</div>
			<?php
				}
			?>
			</div>
		</div>
	</div>
</section>
<section class="section-fighters mod-section-fighters">
<?php
	$featured_fighter_month = get_posts([
						'posts_per_page'   => 8,
						'orderby'          => 'rand',
						'post_type'        => 'iod_video',
						'post_status'      => 'publish',
						'tag__not_in'      => [$cg_tag->term_id],
				        'tax_query' => array(
				            array(
				                'taxonomy' => 'iod_category',
				                'field' => 'name',
				                'terms' => 'Fighter Of The Month',
				            )
				        ),
						'suppress_filters' => true
					]);
	if(!empty($featured_fighter_month)){
?>

	<div class="featured-figter-container-month">
		<div class="container">
			<header class="text-center margin-bottom-30">
				<h2 class="section-title"><strong class="text-black">Featured  <span>Fighters</span> of the Month</strong></h2>
			</header>
			<div class="row margin-bottom-20 ">
			<?php
					foreach ($featured_fighter_month as $ffm) {
						$video = $ffm;
						$iod_video = json_decode(get_post_meta( $video->ID, '_iod_video',true))->embed->url;
						$ytpattern = '/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/';
						if(preg_match($ytpattern,$iod_video,$vid_id)){
							$vid_id = end($vid_id);
							$iod_video_thumbnail = 'http://img.youtube.com/vi/'.$vid_id.'/mqdefault.jpg';
						}else{
							$iod_video_thumbnail = 'http://www.askgamblers.com/uploads/original/isoftbet-2-5474883270a0f81c4b8b456b.png';
						};

						$fighter_id = get_post_meta($video->ID,'fighter_id',true);
						$c_fighter = get_post($fighter_id);
						$association = get_post_meta( $fighter_id, '_uf_association', true );
						$_uf_wintko = get_post_meta( $fighter_id, '_uf_wintko', true );
						$_uf_winsubmissions = get_post_meta( $fighter_id, '_uf_winsubmissions', true );
						$_uf_windecisions = get_post_meta( $fighter_id, '_uf_windecisions', true );
						$_r_win = get_post_meta( $fighter_id, '_uf_win', true );
                        $_r_loss = get_post_meta( $fighter_id, '_uf_loss', true );
                        $_r_draw = get_post_meta( $fighter_id, '_uf_draw', true );
                        $record = $_r_win.' - '.$_r_loss.' - '.$_r_draw;
                        $_r_fighter_terms = get_the_terms($fighter_id,'fighters');
                        $f_weight_class_slug = '';
                        if(!empty($_r_fighter_terms[0])){
                            $f_weight_class = $_r_fighter_terms[0]->name;
                            $f_weight_class_slug = $_r_fighter_terms[0]->slug;
                        }
			?>
						
							<div class="col-md-6 col-sm-6 col-xs-12 margin-top-20">
								<div class="col-md-12 margin-bottom-10">
									<a class="embed-responsive-item main-box lightbox cc-watch-now-container" href="https://www.youtube.com/watch?v=<?=$vid_id?>" data-plugin-options='{"type":"iframe"}'>
										<span class="image-hover-icon image-hover-dark">
											<i class="fa fa-play-circle"></i>
										</span>
										<img src="http://i3.ytimg.com/vi/<?=$vid_id?>/maxresdefault.jpg" alt="..." class="img-responsive">
									</a>
								</div>
								<div class="col-md-12 col-sm-12 fighter-details">
		                           <div class="col-xs-12"><a href="<?=get_permalink($fighter_id)?>"><h4 class="margin-bottom-0 text-black"><?=$c_fighter->post_title?></h4></a></div>
		                            <div class="col-xs-12"><small class="block lbl-weightclass margin-bottom-10"><?=$f_weight_class?></small></div>
	                                <div class="col-md-5 col-xs-12"><label><strong>Record</strong>: <?=$record?></label></div>
	                                <div class="col-md-7 col-xs-12"><label><strong>Association</strong>: <?=$association?:'NA'?></label></div>
	                                <div class="col-md-4 col-xs-12"><label><strong>TKO</strong>: <?=$_uf_wintko?:'NA'?></label></div>
	                                <div class="col-md-4 col-xs-12"><label><strong>Submission</strong>: <?=$_uf_winsubmissions?:'NA'?></label></div>
	                                <div class="col-md-4 col-xs-12"><label><strong>Decision</strong>: <?=$_uf_windecisions?:'NA'?></label></div>
	                            </div>
	                            
							</div>
							

			<?php

					}
			?>
						</div>

		</div>
	</div>
	<div class="container">
		<div class="divider double-line"><!-- divider --></div>
	</div>
	<?php
		}
	?>
	<div class="featured-figter-container">
		<div class="container">
			<!-- <header class="text-center margin-bottom-30">
				<h2 class="section-title"><strong class="text-black">Featured  <span>Fighters</span></strong></h2>
			</header> -->
			<div class="row">
				<div class="fighter_container" data-nextselector="#inf-load-next-fighter" data-itemselector=".inline-page">
                <?php
                    if(!empty($featured_fighter)){
                        ?>
                        <div class="row inline-page page-<?=$page?>" data-page="<?=$page?>">
                        <?php
                        foreach ($featured_fighter as $fighter) {
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
                            <div class="col-sm-6 col-md-3 container-fighters <?=strtolower($f_weight_class)?>">
                                <a href="<?=get_permalink($fighter->ID)?>">
                                    <div class="thumbnail nopadding-bottom margin-bottom-0 noradius">
                                        <img class="img-responsive noradius" src="<?=wp_get_attachment_image_src(get_post_thumbnail_id($fighter->ID),'full')[0]?>" alt="" />
                                    </div>
                                </a>
                                <div class="fighter-details">
                                    <a href="<?=get_permalink($fighter->ID)?>"><h4 class="margin-bottom-0 text-black"><?=$fighter->post_title?></h4></a>
                                    <small class="block lbl-weightclass"><?=$f_weight_class?></small>
                                    <small><?=$record?></small>
                                </div>
                            </div>
                <?php
                        }
                ?>
                    </div>

                <?php
                    }
                ?>
                        
                     <?php if(empty($featured_fighter)){?>
                        <div class="margin-bottom-30 text-center">
                             <h2 class="text-gray">No fighter available</h2>
                        </div>
                    <?php }?>
                </div>
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