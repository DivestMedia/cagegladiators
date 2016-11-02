
<section class="page-header dark page-header-xs">

    <div class="container">

        <h1><? the_title();?></h1>
        <?php edit_post_link('<span class="font-lato size-18 weight-300 text-white"></i> '. __( 'Edit Page', XYR_SMARTY ) .'</span>' ); ?>
        <!-- breadcrumbs -->
        <ol class="breadcrumb">
            <li><a href="<?=site_url();?>">Home</a></li>
            <?php 
                $parents = get_post_ancestors($post->ID);
                if(!empty($parents)){
                    $parents = array_reverse($parents);
                    foreach ($parents as $p) {
                        $parent = get_post( $p );
                        if(!empty($parent))
                            echo '<li><a href="'.get_permalink($parent->ID).'">'.$parent->post_title.'</a></li>';
                    }
                }
            ?>
            <li class="active"><? the_title();?></li>
        </ol><!-- /breadcrumbs -->

    </div>
</section>
<section id="section-dummies-guide">
    <div class="container">
        <div class="row">
            <!-- LEFT -->
            <div class="col-md-8 col-sm-8">
                <?php
                global $wp_query, $query_string;
                while ( have_posts() ) : the_post();
                    if(in_category(['news'])):?>
                    <ul class="blog-post-info list-inline">
                        <li>
                            <a href="#">
                                <i class="fa fa-clock-o"></i>
                                <span class="font-lato"><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?=get_comments_link()?>">
                                <i class="fa fa-comment-o"></i>
                                <span class="font-lato"><?=(comments_number( 'No Comments yet', 'One Comment', '% Comments' ))?></span>
                            </a>
                        </li>
                        <?php
                        $categories = get_the_category_list(',');
                        if(!empty($categores)){
                            ?>
                            <li>
                                <i class="fa fa-folder-open-o"></i>
                                <?=$categories?>
                            </li>
                            <?php
                        }
                        ?>

                    </ul>
                <?php endif; ?>
                <figure class="margin-bottom-20">
                    <?=get_the_post_thumbnail(get_the_ID(),'horizontal-image',['class'=>'img-responsive'])?>
                </figure>
                <!-- article content -->
                <?php the_content();?>
                <!-- /article content -->

                <?php
                $args = array(
					'post_parent' => get_the_ID(),
					'post_type'   => 'page', 
					'numberposts' => -1,
					'post_status' => 'any',
					'orderby' => 'menu_order',
					'order'          => 'ASC',
				);
				$children = get_children( $args );

                ?>
                <div class="row">
                	<?php
                		if(!empty($children)){
                			foreach ($children as $child) {
    				?>
    						<div class="blog-post-item col-md-6 col-sm-6">
								<figure class="margin-bottom-20">
									<a href="<?=get_the_permalink($child->ID)?>" title="<?=get_the_title($child->ID)?>">
	                    				<?=get_the_post_thumbnail($child->ID,'main-image',['class'=>'img-responsive'])?>
	                    			</a>
	                    		</figure>

								<h2><a href="<?=get_the_permalink($child->ID)?>"><?=get_the_title($child->ID)?></a></h2>

								<a href="<?=get_the_permalink($child->ID)?>" class="btn btn-reveal btn-red">
									<i class="fa fa-plus"></i>
									<span>Read More</span>
								</a>

							</div>
    				<?php
                			}
                		}
                	?>
                	
                </div>
                <div class="divider divider-dotted"><!-- divider --></div>

            <?php endwhile; // end of the loop. ?>
            <?php wp_reset_query(); ?>

            <!-- SHARE POST -->
            <div class="clearfix margin-top-30">

                <span class="pull-left margin-top-6 bold hidden-xs">
                    Share Post:
                </span>

                <a href="#" class="social-icon social-icon-sm social-icon-transparent social-facebook pull-right" data-toggle="tooltip" data-placement="top" title="Facebook">
                    <i class="icon-facebook"></i>
                    <i class="icon-facebook"></i>
                </a>

                <a href="#" class="social-icon social-icon-sm social-icon-transparent social-twitter pull-right" data-toggle="tooltip" data-placement="top" title="Twitter">
                    <i class="icon-twitter"></i>
                    <i class="icon-twitter"></i>
                </a>

                <a href="#" class="social-icon social-icon-sm social-icon-transparent social-gplus pull-right" data-toggle="tooltip" data-placement="top" title="Google plus">
                    <i class="icon-gplus"></i>
                    <i class="icon-gplus"></i>
                </a>

                <a href="#" class="social-icon social-icon-sm social-icon-transparent social-linkedin pull-right" data-toggle="tooltip" data-placement="top" title="Linkedin">
                    <i class="icon-linkedin"></i>
                    <i class="icon-linkedin"></i>
                </a>

                <a href="#" class="social-icon social-icon-sm social-icon-transparent social-pinterest pull-right" data-toggle="tooltip" data-placement="top" title="Pinterest">
                    <i class="icon-pinterest"></i>
                    <i class="icon-pinterest"></i>
                </a>

                <a href="#" class="social-icon social-icon-sm social-icon-transparent social-call pull-right" data-toggle="tooltip" data-placement="top" title="Email">
                    <i class="icon-email3"></i>
                    <i class="icon-email3"></i>
                </a>

            </div>
            <!-- /SHARE POST -->

            <div class="divider"><!-- divider --></div>
           

        </div>

        <!-- RIGHT -->
        <div class="col-md-4 col-sm-4">
            <form id="custom-search-form" role="search" method="get" class="search-form" action="<?=site_url()?>">
                <input type="search" class="search-field" placeholder="Search …" value="" name="s">
                <button class="search-submit" value="Search"><i class="fa fa-search"></i></button>
            </form>
            <br><br>
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="hidden-xs size-16 margin-bottom-10 text-uppercase">Latest News</h3>
                    <?php get_template_part("partials/widget",'latest-news');?>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- / -->
