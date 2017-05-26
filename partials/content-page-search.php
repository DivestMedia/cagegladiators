<?php
$query_args = [
    's' => $_GET['keyword'],
    'post_type' => 'fighter'
];

if(!empty($_GET['division']) && strtolower($_GET['division'])!='any division'){


    $query_args['tax_query'] = [
        [
            'taxonomy' => 'fighters',
            'field' => 'name',
            'terms' => $_GET['division']
        ]
    ];
}

query_posts($query_args);

?>


<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9 col-md-push-3 col-sm-push-3">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php
                        $fighter_ID = get_the_ID();
                        $_r_win = get_post_meta( $fighter_ID, '_uf_win', true ) ?: '-';
                        $_r_loss = get_post_meta( $fighter_ID, '_uf_loss', true ) ?: '-';
                        $_r_draw = get_post_meta( $fighter_ID, '_uf_draw', true ) ?: '-';
                        $_r_fighter_terms = get_the_terms($fighter_ID,'fighters');
                        $record = $_r_win.'-'.$_r_loss.'-'.$_r_draw;
                        $f_weight_class = '';
                        $f_weight_class_slug = '';
                        if(!empty($_r_fighter_terms[0])){
                            $f_weight_class = $_r_fighter_terms[0]->name;
                            $f_weight_class_slug = $_r_fighter_terms[0]->slug;
                        }
                        ?>
                        <div class="clearfix search-result"><!-- item -->
                            <h4 class="margin-bottom-0"><a href="<?=get_the_permalink()?>"><?=get_the_title()?></a><a href="<?=get_the_permalink()?>" class="text-danger fsize12 pull-right"><small>View Fighter Profile</small></a></h4>
                            <small class="text-muted"><?=$f_weight_class?></small>
                            <span class="clearfix"></span>
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="<?=wp_get_attachment_image_src(get_post_thumbnail_id($fighter_ID),'full')[0]?>" alt="" width="90">
                                    <ul class="nav nav-pills nav-stacked" style="max-width: 260px;">
                                        <li> <span class="badge pull-right" style="margin-left:15px;"><?=$_r_win?></span> Win </li>
                                        <li> <span class="badge pull-right" style="margin-left:15px;"><?=$_r_loss?></span> Loss </li>
                                        <li> <span class="badge pull-right" style="margin-left:15px;"><?=$_r_draw?></span> Draw </li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <ul class="nav nav-pills nav-stacked" style="max-width: 260px;">
                                        <li>
                                            <span class="badge pull-right" style="margin-left:15px;">
                                                <?=(get_post_meta( $fighter_ID, '_uf_height', true ) ?: '-')?>
                                            </span> Height
                                        </li>
                                        <li>
                                            <span class="badge pull-right" style="margin-left:15px;">
                                                <?=(get_post_meta( $fighter_ID, '_uf_weight', true ) ?: '-')?>
                                            </span> Weight
                                        </li>
                                        <li>
                                            <span class="badge pull-right" style="margin-left:15px;">
                                                <?=(get_post_meta( $fighter_ID, '_uf_age', true ) ?: '-')?>
                                            </span> Age
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <?php

                                    $fighter_videos = get_post_meta( $fighter_ID , '_uf_video', true ) ?: [];

                                    if(!empty($fighter_videos)){
                                        $fighter_videos = explode(',', $fighter_videos);
                                    }
                                    if(!empty($fighter_videos)){
                                        $fighter_videos = array_reverse($fighter_videos);
                                    }

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

                                                <div class="embed-responsive embed-responsive-16by9" style="border-bottom: 5px solid #ce0505;">
                                                    <a class="embed-responsive-item main-box lightbox" href="https://www.youtube.com/watch?v=<?=$vid_id?>" data-plugin-options='{"type":"iframe"}'>
                                                        <span class="image-hover-icon image-hover-dark">
                                                            <i class="fa fa-play-circle"></i>
                                                        </span>
                                                        <img src="<?=$iod_video_thumbnail?>" alt="..." class="img-responsive">
                                                    </a>
                                                </div>
                                                <?php break; }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <h3>No results found</h3>
                    <?php endif; ?>
                </div>
                <div class="col-md-3 col-sm-3 col-md-pull-9 col-sm-pull-9">
                    <h4>Refine search</h4>
                    <form action="/search/" method="GET">
                        <input type="text" class="form-control" name="keyword" placeholder="Keywords" value="<?=$_GET['keyword']?>">

                        <label class="size-12 margin-top-10">Weight Division</label>
                        <select class="form-control" name="division">
                            <option>Any Division</option>
                            <?php
                            $fighter_categories = get_terms('fighters');
                            if(!empty($fighter_categories)){
                                foreach ($fighter_categories as $_cat) {
                                    ?>
                                    <option <?=(!empty($_GET['division']) && $_GET['division']==$_cat->name ? 'selected' : '')?>><?=(ucwords(strtolower($_cat->name)))?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <!--
                        <label class="size-12 margin-top-10">Order By</label>
                        <select class="form-control">
                        <option value="">Last Updated</option>
                        <option value="">Recent Fight</option>
                        <option value="">Fighter Name</option>
                        <option value="">Fight Count</option>
                        <option value="">Win Loss</option>
                    </select> -->
                    <hr />
                    <button type="submit" class="btn btn-sm btn-default">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
</section>
