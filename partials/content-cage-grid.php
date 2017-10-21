<div class="row margin-top-30">
    <div id="container-side-featuredfighter" class="col-md-10 nopadding">
        <div class="col-md-6">
            <div class="content-side-featuredfighter col-md-12 col-sm-6" style="padding: 0;">
                <figure>
                    <a href="<?=site_url('gladiators-profile')?>"><img class="img-responsive" src="<?=get_stylesheet_directory_uri()?>/assets/img/gladiators_profile.jpg" alt=""></a>
                </figure>
            </div>
        </div>
        <div class="col-md-6">
            <div class="content-side-featuredfighter col-md-12 col-sm-6" style="padding: 0;">
                <figure>
                    <a href="<?=site_url('gladiators-talk')?>"><img class="img-responsive" src="<?=get_stylesheet_directory_uri()?>/assets/img/gladiators_talk.jpg" alt=""></a>
                </figure>
            </div>
        </div>
        <div class="col-md-6">
            <div class="content-side-featuredfighter col-md-12 col-sm-6" style="padding: 0;">
                <figure>
                    <a href="<?=site_url('events-in-asia')?>"><img class="img-responsive" src="<?=get_stylesheet_directory_uri()?>/assets/img/events_in_asia.jpg" alt=""></a>
                </figure>
            </div>
        </div>
        <div class="col-md-6">
            <div class="content-side-featuredfighter col-md-12 col-sm-6" style="padding: 0;">
                <figure>
                    <a href="#"><img class="img-responsive" src="<?=get_stylesheet_directory_uri()?>/assets/img/organizations.jpg" alt=""></a>
                </figure>
            </div>
        </div>
        <div class="col-md-6">
            <div class="content-side-featuredfighter col-md-12 col-sm-6" style="padding: 0;">
                <figure>
                    <a href="<?=site_url('one-championship')?>"><img class="img-responsive" src="<?=get_stylesheet_directory_uri()?>/assets/img/one.jpg" alt=""></a>
                </figure>
            </div>
        </div>
        <div class="col-md-6">
            <div class="content-side-featuredfighter col-md-12 col-sm-6" style="padding: 0;">
                <figure>
                    <a href="#"><img class="img-responsive" src="<?=get_stylesheet_directory_uri()?>/assets/img/ugb.jpg" alt=""></a>
                </figure>
            </div>
        </div>
        <div id="container-featured-news" class="col-md-12">
            <div id="container-cage-corner">
                <div class="uppercase section-title text-white text-center weight-700 size-17">MMA News in Asia</div>
                <div class="content-cage-corner" style="position:relative;display:block;">
                    <div class="owl-carousel owl-padding-10 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"4", "autoPlay": 4000, "navigation": true, "pagination": false}'>
                        <?php
                        $starting_out = get_posts([
                            'posts_per_page'   => 10,
                            'category_name'    => 'ufc-latest-news,urcc-latest-news,pxc-latest-news',
                            'orderby'          => 'date',
                            'order'            => 'DESC',
                            'post_type'        => 'post',
                            'post_status'      => 'publish',
                            'suppress_filters' => true
                        ]);
                        if(count($starting_out)):
                            foreach($starting_out as $post):
                                ?>
                                <div class="news-item img-hover">
                                    <a href="<?=get_the_permalink()?>">
                                        <?php if ( has_post_thumbnail() ): ?>
                                            <img class="img-responsive" src="<?=the_post_thumbnail_url("mid-image")?>" alt="">
                                        <?php else: ?>
                                            <img class="img-responsive" src="<?=site_url("/wp-content/uploads/2017/05/news-placeholder.jpg")?>" alt="">
                                        <?php endif;?>
                                    </a>

                                    <h4 class="text-left margin-top-20"><a href="<?=get_the_permalink()?>"><?=trim_text(get_the_title(),50)?></a></h4>
                                    <p class="text-left"><small><?=time_elapsed_string(get_the_date('Y-m-d H:i:s'))?></small><br><br><?=trim_text(strip_tags(html_entity_decode(get_the_excerpt())),150)?></p>
                                </div>

                                <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div id="container-invest-divest">
            <div class="uppercase section-title text-white text-center weight-700 size-17" style="width: 145px; min-width: 0; margin: 0 10px 10px auto; display: block;">Coming Soon</div>
            <figure>
                <a href="#">
                    <img class="img-responsive" src="<?=get_stylesheet_directory_uri()?>/assets/img/road_to_mma.jpg" alt="">
                </a>
            </figure>
            <figure>
                <a href="#">
                    <img class="img-responsive" src="<?=get_stylesheet_directory_uri()?>/assets/img/fatass2badass.jpg" alt="">
                </a>
            </figure>
            <figure>
                <a href="#">
                    <img class="img-responsive" src="<?=get_stylesheet_directory_uri()?>/assets/img/Cage corner_thumbnail.jpg" alt="">
                </a>
            </figure>
        </div>
    </div>
</div>
