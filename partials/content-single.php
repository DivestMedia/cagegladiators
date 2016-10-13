<!-- -->
<section id="content">
    <div class="container">
        <div class="row">


            <!-- LEFT -->
            <div class="col-md-8 col-sm-8">
                <?php
                global $wp_query, $query_string;
                while ( have_posts() ) : the_post();
                ?>
                <?php if(in_category(['news'])):?>
                    <h1 class="blog-post-title"><? the_title();?></h1>
                <?php else: ?>
                    <div class="heading-title heading-line-double">
                        <h1 class="blog-post-title"><? the_title();?></h1>
                    </div>
                <?php endif; ?>
                <?php if(in_category(['news'])):?>
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
                <!-- article content -->
                <?php the_content();?>
                <!-- /article content -->
                <?php if(in_category(['news'])):?>
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-3d btn-reveal btn-black pull-right" href="<?=site_url('category/news')?>">
                                <i class="fa fa-newspaper-o"></i>
                                <span>Go Back to All News</span>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="divider divider-dotted"><!-- divider --></div>

            <?php endwhile; // end of the loop. ?>
            <?php wp_reset_query(); ?>
            <!-- TAGS -->
            <?php
            $terms = get_terms('post_tag',array('hide_empty'=>false));
            foreach($terms as $t) {
                ?>
                <a class="tag" href="#">
                    <span class="txt"><?=$t->name?></span>
                    <span class="num"><?=$t->count?></span>
                </a>
                <?php
            }
            ?>
            <!-- /TAGS -->

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
            <?
            echo wp_link_pages(array(
                'before' => '<div class="divider"></div><ul class="pager">',
                'after' => '</ul><div class="divider"></div>',
                'link_before' => '&larr;',
                'link_after' => '&rarr;',
            ));

            ?>

            <?php comments_template(); ?>

        </div>

        <!-- RIGHT -->
        <div class="col-md-4 col-sm-4">
            <?php dynamic_sidebar('sidebar-single')?>
        </div>
    </div>
</div>
</section>
<!-- / -->
