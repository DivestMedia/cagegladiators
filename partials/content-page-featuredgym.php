<section class="section-fighters mod-section-fighters">
    <?php
    $featured_fighter_month = get_posts([
        'posts_per_page'   => -1,
        'orderby'          => 'rand',
        'post_type'        => 'iod_video',
        'post_status'      => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'iod_category',
                'field' => 'name',
                'terms' => 'Featured Gym',
            )
        ),
        'suppress_filters' => true
    ]);
    if(!empty($featured_fighter_month)){
        ?>

        <div class="featured-figter-container-month">
            <div class="container">
                <header class="text-center margin-bottom-30">
                    <h2 class="section-title"><strong class="text-black">Featured  <span>Training</span> Gym</strong></h2>
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
                                    <img src="http://i3.ytimg.com/vi/<?=$vid_id?>/0.jpg" alt="..." class="img-responsive">
                                </a>
                            </div>
                            <div class="col-md-12 col-sm-12 fighter-details">
                                <div class="col-xs-12"><a href="#"><h4 class="margin-bottom-0 text-black"><?=$ffm->post_title?></h4></a></div>
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
</section>
