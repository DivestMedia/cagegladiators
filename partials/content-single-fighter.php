<?php
$option_fields = [
    'fighter_details' => [
        '_uf_firstname',
        '_uf_lastname',
        '_uf_nickname',
        '_uf_hometown',
        '_uf_age',
        '_uf_height',
        '_uf_weight',
        '_uf_reach',
        '_uf_leg_reach',
        '_uf_win',
        '_uf_loss',
        '_uf_draw',
        '_uf_summary',
        '_uf_takedown',
        '_uf_takedownattempts',
        '_uf_takedowndefense',
        '_uf_striking',
        '_uf_strikingattempts',
        '_uf_strikingdefense',
        '_uf_submission',
        '_uf_rank',
        '_uf_birthday',
        '_uf_association',
        '_uf_wintko',
        '_uf_winsubmissions',
        '_uf_windecisions',
        '_uf_windq',
        '_uf_losstko',
        '_uf_losssubmissions',
        '_uf_lossdecisions',
        '_uf_lossdq',
    ],
    'fighter_images' => [
        '_uf_image',
        '_uf_image_left',
        '_uf_image_right',
        '_uf_bio_image'
    ]
];
$fighter_details  = [];
foreach ($option_fields['fighter_details'] as $field) {
    $fighter_details[$field] = get_post_meta( $post->ID, $field, true );
}

$fighter_images  = [];
foreach ($option_fields['fighter_images'] as $field) {
    $fighter_images[$field] = get_post_meta( $post->ID, $field, true );
}
$media_gallery = [];
if(!empty($fighter_images['_uf_image'])){
    $_t_images = explode(',', $fighter_images['_uf_image']);
    $media_gallery = array_slice($_t_images,3);
}

$fighter_videos = get_post_meta( $post->ID, '_uf_video', true );

if(!empty($fighter_videos)){
    $fighter_videos = explode(',', $fighter_videos);
}
// $featuredVideo = get_posts([
//     'post_type'   => 'iod_video',
//     'post_status' => 'publish',
//     'posts_per_page' => 1,
//     'posts_per_archive_page' => 1,
//     'orderby' => 'rand',
//     'tax_query' => array(
//         array(
//             'taxonomy' => 'iod_category',
//             'field' => 'name',
//             'terms' => 'Fight Footage'
//         )
//     ),
//     'exclude' => []
// ]);
$fight_footage = [];
$profile_vid = $fighter_videos;
if(!empty($profile_vid)){
    if(count($profile_vid)>1){
        $fight_footage = array_pop($profile_vid);
    }

    // $video = $fighter_videos[0];
    // $iod_video = json_decode(get_post_meta( $video, '_iod_video',true))->embed->url;
    // $ytpattern = '/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/';
    // if(preg_match($ytpattern,$iod_video,$vid_id)){
    //     $vid_id = end($vid_id);
    //     $iod_video_thumbnail = 'http://img.youtube.com/vi/'.$vid_id.'/mqdefault.jpg';
    // }else{
    //     $iod_video_thumbnail = 'http://www.askgamblers.com/uploads/original/isoftbet-2-5474883270a0f81c4b8b456b.png';
    // };
}
$vid_id = 0;
if(!empty($fight_footage)){
    $video = $fight_footage;
    $iod_video = json_decode(get_post_meta( $video, '_iod_video',true))->embed->url;
    $ytpattern = '/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/';
    if(preg_match($ytpattern,$iod_video,$vid_id)){
        $vid_id = end($vid_id);
        $iod_video_thumbnail = 'http://img.youtube.com/vi/'.$vid_id.'/mqdefault.jpg';
    }else{
        $iod_video_thumbnail = 'http://www.askgamblers.com/uploads/original/isoftbet-2-5474883270a0f81c4b8b456b.png';
    };
}
if(!empty($fighter_videos)){
    $fighter_videos = array_reverse($fighter_videos);
}
?>
<section id="main-featured-fighter" class="fighter-solo-section">
    <div class="fighter-background-image"></div>
    <?php if(!empty($vid_id)){?>
        <div class="overlay dark-2"><!-- dark overlay [0 to 9 opacity] --></div>
        <a id="YTPlayer" class="player" data-property="{videoURL:'http://www.youtube.com/watch?v=<?=$vid_id?>',containment:'#main-featured-fighter',autoPlay:true, mute:true, startAt:0, stopAt:30, opacity:1, loop:1, showControls:false}">youtube</a>
        <?php }?>
        <div class="ff-bg-red"></div>
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
                                <h3 class="uppercase nomargin weight-900 font-proximanova <?=!empty($vid_id)?'text-white':'text-black'?>">Fighter Profile</h3>
                                <h1 class="text-white uppercase name-line-1"><?=$fighter_details['_uf_firstname']?></h1>
                                <h1 class="uppercase name-line-2" style=""><?=$fighter_details['_uf_lastname']?></h1>
                            </div>
                            <img class="fighter-image" src="<?=wp_get_attachment_image_src($fighter_images['_uf_image_right'],'full')[0]?>" alt="">
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
                                <?php if(!empty($vid_id)){?><li class="active"><a href="#sec-profile-vid">Fighter Videos</a></li><?php }?>
                                <li <?=empty($vid_id)?'class="active"':''?>><a href="#sec-profile">Profile</a></li>
                                <li><a href="#sec-mediagallery">Media Gallery</a></li>
                                <li><a href="#sec-fight-footage">Fight Footage</a></li>
                                <li><a href="#sec-road-to-glory">Road to Glory</a></li>
                                <li><a href="#sec-biography">Biography</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <?php
                        if(!empty($fighter_videos)){
                            ?>
                            <div id="sec-profile-vid" class="fighter-details-block fighter-videos row">
                                <?php
                                foreach ($fighter_videos as $key => $pv) {
                                    $_terms = get_the_terms($pv,'iod_category');
                                    if(!empty($_terms[0]->name)){
                                        if(!strcasecmp('Profile Videos', $_terms[0]->name)){
                                            $video = $pv;
                                            $iod_video = json_decode(get_post_meta( $video, '_iod_video',true))->embed->url;
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
                                                <div class="embed-responsive embed-responsive-16by9" style="border-bottom: 5px solid #ce0505;">
                                                    <a class="embed-responsive-item main-box lightbox" href="https://www.youtube.com/watch?v=<?=$vid_id?>" data-plugin-options='{"type":"iframe"}'>
                                                        <span class="image-hover-icon image-hover-dark">
                                                            <i class="fa fa-play-circle"></i>
                                                        </span>
                                                        <img src="<?=$iod_video_thumbnail?>" alt="..." class="img-responsive">
                                                    </a>
                                                </div>
                                            </div>
                                            <?php }
                                        }
                                    }?>
                                </div>

                                <?php }?>
                                <div id="sec-profile" class="fighter-details-block fighter-stats row">
                                    <!-- H3 -->
                                    <div class="heading-title heading-border-bottom margin-bottom-30">
                                        <div class="share-fighter pull-right">
                                            <a href="#">
                                                <i class="icon-twitter"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                            <a href="#">
                                                <i class="icon-facebook"></i>
                                            </a>
                                        </div>
                                        <h3 class=" uppercase weight-700 size-20">Fighter Stats</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="col-xs-6">
                                                <div class="piechart nomargin" data-color="#e60f0f" data-size="100" data-percent="100" data-width="3" data-animate="1000">
                                                    <span class="countTo font-raleway" data-speed="1000"><?=$fighter_details['_uf_win']?></span>
                                                    <label>WINS</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="piechart nomargin" data-color="#999999" data-size="100" data-percent="100" data-width="3" data-animate="1000">
                                                    <span class="countTo font-raleway" data-speed="1000"><?=$fighter_details['_uf_loss']?></span>
                                                    <label>LOSSES</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <table class="table margin-top-10 table-stats">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <strong><?=$fighter_details['_uf_wintko']?:0?></strong>TKO/KO
                                                            </td>
                                                            <td>
                                                                <strong><?=$fighter_details['_uf_losstko']?:0?></strong>TKO/KO
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong><?=$fighter_details['_uf_winsubmissions']?:0?></strong>SUBMISSIONS
                                                            </td>
                                                            <td>
                                                                <strong><?=$fighter_details['_uf_losssubmissions']?:0?></strong>SUBMISSIONS
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong><?=$fighter_details['_uf_windecisions']?:0?></strong>DECISION
                                                            </td>
                                                            <td>
                                                                <strong><?=$fighter_details['_uf_lossdecisions']?:0?></strong>DECISION
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong><?=$fighter_details['_uf_windq']?:0?></strong>DQ
                                                            </td>
                                                            <td>
                                                                <strong><?=$fighter_details['_uf_lossdq']?:0?></strong>DQ
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <strong>0</strong>NO CONTEST
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="row">
                                                <div class="col-xs-4 fighter-info">
                                                    <label>HEIGHT</label>
                                                    <strong><?=$fighter_details['_uf_height']?></strong>
                                                </div>
                                                <div class="col-xs-4 fighter-info">
                                                    <label>WEIGHT</label>
                                                    <strong><?=$fighter_details['_uf_weight']?></strong>
                                                </div>
                                                <div class="col-xs-4 fighter-info">
                                                    <label>BORN</label>
                                                    <strong><?=!empty($fighter_details['_uf_birthday'])?date('m/d/Y',strtotime($fighter_details['_uf_birthday'])):'NA'?></strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 fighter-info">
                                                    <label>ASSOCIATION</label>
                                                    <strong><?=$fighter_details['_uf_association']?:'NA'?></strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 fighter-info">
                                                    <label>HOMETOWN</label>
                                                    <strong><?=$fighter_details['_uf_hometown']?:'NA'?></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="sec-mediagallery" class="fighter-details-block fighter-gallery row">
                                    <div class="col-md-12">
                                        <h3 class="header-red">Media Gallery</h3>
                                        <?php if(!empty($media_gallery)){?>
                                            <div class="masonry-gallery columns-3 margin-bottom-20 clearfix lightbox" data-img-big="8" data-plugin-options='{"delegate": "a", "gallery": {"enabled": true}}'>
                                                <?php
                                                foreach ($media_gallery as $key => $img) {
                                                    $ishidden = false;
                                                    if($key>=7){
                                                        $ishidden = true;
                                                    }
                                                    ?>
                                                    <a class="image-hover media-item <?=$ishidden===true?'hidden':''?>" href="<?=wp_get_attachment_image_src($img,'full')[0]?>" >
                                                        <img src="<?=wp_get_attachment_image_src($img,'medium')[0]?>" alt="...">
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <a href="<?php global $wp; echo home_url(add_query_arg(array(),$wp->request).'/media-gallery');?>"><button class="btn btn-black noradius">VIEW MORE</button></a>
                                            <?php }else{?>
                                                <div class="margin-bottom-30 text-center"><!-- DANGER -->
                                                    <h2 class="text-gray">No media available</h2>
                                                </div>

                                                <?php }?>
                                            </div>
                                        </div>
                                        <div id="sec-fight-footage" class="fighter-details-block fighter-videos row">
                                            <div class="col-md-12">
                                                <h3 class="header-red">Fight Footage</h3>
                                                <?php
                                                // $vid_id = 0;
                                                // if(!empty($fight_footage)){
                                                //     $video = $fight_footage;
                                                //     $iod_video = json_decode(get_post_meta( $video, '_iod_video',true))->embed->url;
                                                //     $ytpattern = '/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/';
                                                //     if(preg_match($ytpattern,$iod_video,$vid_id)){
                                                //         $vid_id = end($vid_id);
                                                //         $iod_video_thumbnail = 'http://img.youtube.com/vi/'.$vid_id.'/mqdefault.jpg';
                                                //     }else{
                                                //         $iod_video_thumbnail = 'http://www.askgamblers.com/uploads/original/isoftbet-2-5474883270a0f81c4b8b456b.png';
                                                //     };
                                                // }
                                                ?>
                                                <?php if(!empty($fighter_videos)){?>
                                                    <div class="row">

                                                        <div id="sec-profile-vid" class="fighter-details-block fighter-videos row">
                                                            <?php

                                                            foreach ($fighter_videos as $key => $pv) {
                                                                $_terms = get_the_terms($pv,'iod_category');
                                                                if(!empty($_terms[0]->name)){
                                                                    if(!strcasecmp('Fight Footage', $_terms[0]->name)){
                                                                        $video = $pv;
                                                                        $iod_video = json_decode(get_post_meta( $video, '_iod_video',true))->embed->url;
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
                                                                            <div class="embed-responsive embed-responsive-16by9" style="border-bottom: 5px solid #ce0505;">
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
                                                                }
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
                                            <div id="sec-road-to-glory" class="fighter-details-block fighter-gallery row">
                                                <div class="col-md-12">
                                                    <h3 class="header-red">Road to Glory</h3>
                                                    <div class="row">

                                                        <div id="sec-profile-vid" class="fighter-details-block fighter-videos row">
                                                            <?php
                                                            foreach ($fighter_videos as $key => $pv) {
                                                                $_terms = get_the_terms($pv,'iod_category');
                                                                if(!empty($_terms[0]->name)){
                                                                    if(!strcasecmp('Road to Glory', $_terms[0]->name)){
                                                                        $video = $pv;
                                                                        $iod_video = json_decode(get_post_meta( $video, '_iod_video',true))->embed->url;
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
                                                                            <div class="embed-responsive embed-responsive-16by9" style="border-bottom: 5px solid #ce0505;">
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
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <?php
                                                        $events = get_posts([
                                                            'posts_per_page'   => -1,
                                                            'meta_key'          => '_ed_date',
                                                            'orderby'          => 'meta_value_datetime',
                                                            'order'            => 'ASC',
                                                            'post_type'        => 'events',
                                                            'post_status'      => 'publish',
                                                            'meta_query' => array(
                                                                'relation' => 'OR',
                                                                array(
                                                                    'key' => '_ed_fighter_id',
                                                                    'value' => $post->ID,
                                                                    'compare' => '=',
                                                                ),
                                                                array(
                                                                    'key' => '_ed_opponent_id',
                                                                    'value' => $post->ID,
                                                                    'compare' => '=',
                                                                )
                                                            ),
                                                            'suppress_filters' => true
                                                        ]);


                                                        if(!empty($events)){
                                                            $gen_events = [];
                                                            foreach ($events as $key => $event) {

                                                                $edate = get_post_meta($event->ID,'_ed_date',true);

                                                                $result = get_post_meta($event->ID,'_ed_result',true);
                                                                $span_color = ['draw'=>'info','loss'=>'danger','win'=>'success','no contest'=>'primary','na'=>'default'];

                                                                $location = get_post_meta($event->ID,'_ed_location',true);
                                                                $decision = get_post_meta($event->ID,'_ed_decision',true);

                                                                $opponent = get_post_meta($event->ID,'_ed_opponent',true);
                                                                $opponentid = get_post_meta($event->ID,'_ed_opponent_id',true);

                                                                if($post->ID==$opponentid){
                                                                    $opponent = get_post_meta($event->ID,'_ed_fighter',true);
                                                                    $opponentid = get_post_meta($event->ID,'_ed_fighter_id',true);
                                                                    if($result=='Win')
                                                                    $result='Loss';
                                                                    elseif($result=='Loss')
                                                                    $result='Win';
                                                                }

                                                                if(!empty($result)){
                                                                    if(!strcasecmp($result, 'NA'))
                                                                    $result = '<span class="label label-'.$span_color[strtolower($result)].'">'.$result.'</span>';
                                                                    else
                                                                    $result = '<span class="label label-'.$span_color[strtolower($result)].'">'.$result.' | '.$decision.'</span>';
                                                                }else{
                                                                    $result = '<span class="label label-default">NA</span>';
                                                                }
                                                                $gen_events[strtotime($edate)] = [
                                                                    'ID' => $event->ID,
                                                                    'title'=>get_the_title($event->ID),
                                                                    'date'=>$edate,
                                                                    'opponent'=>'<a href="'.get_permalink($opponentid).'">'.$opponent.'</a>',
                                                                    'location'=>$location?:'N/A',
                                                                    'result'=>$result,
                                                                ];
                                                            }
                                                            krsort($gen_events);
                                                            ?>
                                                            <table class="table table-hover table-event paginated">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Title</th>
                                                                        <th>Date</th>
                                                                        <th>Opponent</th>
                                                                        <th>Location</th>
                                                                        <th>Result</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    foreach ($gen_events as $event) {

                                                                        ?>
                                                                        <tr data-id="<?=$event['ID']?>">
                                                                            <td><?=$event['title']?></td>
                                                                            <td><?=$event['date']?></td>
                                                                            <td><?=$event['opponent']?></td>
                                                                            <td><?=$event['location']?></td>
                                                                            <td><?=$event['result']?></td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <div class="margin-bottom-30 text-center"><!-- DANGER -->
                                                                <h2 class="text-gray">No event available</h2>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="sec-biography" class="fighter-details-block fighter-biography row">
                                                <div class="col-md-12">
                                                    <h3 class="header-red">Biography</h3>
                                                    <p>

                                                        <figure class="pull-right text-center" style="padding-left:20px;padding-bottom:20px;">
                                                            <img src="<?=wp_get_attachment_image_src($fighter_images['_uf_bio_image'],'full')[0]?>" class="thumbnail "/>
                                                            <small>

                                                            </small>
                                                        </figure>

                                                        <?=nl2br($post->post_content)?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <?php

                                include get_stylesheet_directory() . '/partials/content-featuredfighter.php';
                                ?>
