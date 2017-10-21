<!-- -->
<section id="content">
    <div class="container">
        <div class="row">


            <!-- LEFT -->
            <div class="col-md-8 col-sm-8">
                <?php
                global $wp_query, $query_string;
                while ( have_posts() ) : the_post();

                $iod_video = json_decode(get_post_meta( get_the_ID(), '_iod_video',true))->embed->url;
                $ytpattern = '/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/';
                if(preg_match($ytpattern,$iod_video,$vid_id)){
                    $vid_id = end($vid_id);
                    $iod_video_thumbnail = 'http://img.youtube.com/vi/'.$vid_id.'/maxresdefault.jpg';
                }else{
                    $iod_video_thumbnail = 'http://www.askgamblers.com/uploads/original/isoftbet-2-5474883270a0f81c4b8b456b.png';
                };
                ?>
                <header class="text-left margin-bottom-30">
                    <h2 class="section-title"><strong class="text-black"><?=get_the_title()?></strong></h2>
                </header>
                <!-- article content -->
                <figure>
                    <div class="embed-responsive embed-responsive-16by9" style="border-bottom: 5px solid #ce0505;">
                        <a class="embed-responsive-item main-box lightbox" href="https://www.youtube.com/watch?v=<?=$vid_id?>" data-plugin-options='{"type":"iframe"}'>
                            <img src="<?=$iod_video_thumbnail?>" alt="..." class="img-responsive">
                            <span class="image-hover-icon image-hover-dark" style="opacity:1!important;">
                                <i class="fa fa-play-circle"></i>
                            </span>
                        </a>
                    </div>
                </figure>
                <div class="post-content <?=!strcasecmp(get_cat_name($_parentcat),'Articles')?'isarticle':''?>">
                    <?=wpautop($post->post_content)?>
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
