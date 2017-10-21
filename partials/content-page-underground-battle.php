<section id="main-featured-fighter" class="fighter-solo-section">
    <div class="fighter-background-image"></div>
        <div class="overlay dark-7"><!-- dark overlay [0 to 9 opacity] --></div>
        <a id="YTPlayer" class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=bvsNtw-PvTI',containment:'#main-featured-fighter',autoPlay:true, mute:true, startAt:0, stopAt:30, opacity:1, loop:1, showControls:false}">youtube</a>
        <div class="ff-bg-red" style="top: -79px;!important"></div>
        <div class="ff-bg-gray">
            <div class="container">
                <div class="row fighter-solo">
                    <div class="col-md-3 hidden-sm hidden-xs text-right fighter-details margin-bottom-20">
                        <?php if(!empty($post->post_excerpt)){?>
                            <p class="text-white size-18 fighter-profile-motto font-proximanova"><?=$post->post_excerpt?></p>
                            <?php }?>
                        </div>
                        <div class="col-md-9 fighter-details">
                            <div>
                            </div>
                            <div class="fighter-name">
                                <h3 class="uppercase nomargin weight-900 font-proximanova <?=!empty($vid_id)?'text-white':'text-black'?>">Organization Profile</h3>
                                <h1 class="text-white uppercase name-line-1" style="    text-shadow: 0 0 15px rgba(0,0,0,0.5);">UnderGround Battle MMA</h1> </div>
                            <img class="fighter-image" src="<?=site_url('/wp-content/uploads/2017/06/ugb.png')?>" alt="" style="    height: 250px!important; top: 65px; left: -270px!important;">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="content" class="content-single-fighter nopadding">
            <div class="container fighter-parent-container">
                <div class="row">
                    <div class="col-md-3 hidden-sm hidden-xs">
                        <div id="list-fighter-nav" class="fighter-details-block profile-nav">
                            <ul class="nav nav-pills nav-stacked" role="tablist">
                                <li><a href="#sec-fight-footage">Fight Footages</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">

                        <div id="sec-fight-footage" class="fighter-details-block fighter-videos row">
                            <div class="col-md-12">
                                <h3 class="header-red">Fight Footage</h3>
                                <?php
                                $fighter_videos = get_posts([
                                    'posts_per_page'   => 8,
                                    'orderby'          => 'rand',
                                    'post_type'        => 'iod_video',
                                    'post_status'      => 'publish',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'iod_category',
                                            'field' => 'name',
                                            'terms' => 'UGB Fight Videos',
                                        )
                                    ),
                                    'suppress_filters' => true
                                ]);

                                if(!empty($fighter_videos)){?>
                                    <div class="row">

                                        <div id="sec-profile-vid" class="fighter-details-block fighter-videos row">
                                            <?php


                                            foreach ($fighter_videos as $key => $pv) {

                                                        $video = $pv;
                                                        $iod_video = json_decode(get_post_meta( $video->ID, '_iod_video',true))->embed->url;
                                                        $ytpattern = '/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/';
                                                        if(preg_match($ytpattern,$iod_video,$vid_id)){
                                                            $vid_id = end($vid_id);
                                                            $iod_video_thumbnail = 'http://img.youtube.com/vi/'.$vid_id.'/mqdefault.jpg';
                                                        }else{
                                                            $iod_video_thumbnail = 'http://www.askgamblers.com/uploads/original/isoftbet-2-5474883270a0f81c4b8b456b.png';
                                                        }
                                                        // http://i3.ytimg.com/vi/$vid_id/maxresdefault.jpg
                                                        $iod_video_thumbnail = get_the_post_thumbnail_url($video,"full");
                                                        ?>
                                                        <div class="col-sm-6">
                                                            <div class="embed-responsive embed-responsive-16by9" style="border-bottom: 5px solid #ce0505;margin-bottom:10px;">
                                                                <a class="embed-responsive-item main-box lightbox" href="https://www.youtube.com/watch?v=<?=$vid_id?>" data-plugin-options='{"type":"iframe"}'>
                                                                    <span class="image-hover-icon image-hover-dark">
                                                                        <i class="fa fa-play-circle"></i>
                                                                    </span>
                                                                    <img src="<?=$iod_video_thumbnail?>" alt="..." class="img-responsive">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <?php

                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <?php }else{
                                        ?>
                                        <div class="text-center">
                                            <h2 class="text-gray">Coming Soon</h2>
                                        </div>
                                        <?php
                                    }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php

                include get_stylesheet_directory() . '/partials/content-featuredfighter.php';
                ?>
