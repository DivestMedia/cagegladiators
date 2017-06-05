<section class="section-fighters mod-section-fighters">
    <?php
    $featured_fighter_month = get_posts([
        'posts_per_page'   => 8,
        'orderby'          => 'rand',
        'post_type'        => 'iod_video',
        'post_status'      => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'iod_category',
                'field' => 'name',
                'terms' => 'Events',
            )
        ),
        'suppress_filters' => true
    ]);
    if(!empty($featured_fighter_month)){
        ?>

        <div class="featured-figter-container-month">
            <div class="container">
                <header class="text-center margin-bottom-30">
                    <h2 class="section-title"><strong class="text-black">Events in <span>Asia</span></strong></h2>
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

                        ?>

                        <div class="col-md-4 col-sm-6 col-xs-12 margin-top-20">
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
