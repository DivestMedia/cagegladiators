<style>
body{
    background: #111111!important;
}
</style>
<section id="home-main-container">
    <div class="container">
        <div id="container-featured-news" class="col-md-12">
            <div id="container-cage-corner">
                <div class="uppercase section-title text-white text-center weight-700 size-17">MMA News from One Championship</div>
                <div class="content-cage-corner" style="position:relative;display:block;">
                    <div class="owl-carousel owl-padding-10 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"4", "autoPlay": 4000, "navigation": true, "pagination": false}'>
                        <?php
                        $starting_out = get_posts([
                            'posts_per_page'   => 10,
                            'category_name'    => 'onefc-latest-news',
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
                                    <p class="text-left"><small><?=time_elapsed_string(get_the_date('Y-m-d H:i:s'))?></small><br><br><?=trim_text(strip_tags(html_entity_decode($post->post_content)),100)?></p>
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
</section>
