<?php
	$_banners = json_decode(do_shortcode( '[SM_GET_BANNER]' ));

    $comingsoon = get_posts([
        'post_type'   => 'iod_video',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'posts_per_archive_page' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'iod_category',
                'field' => 'name',
                'terms' => 'Coming Soon'
            )
        )
    ]);
    if(!empty($comingsoon)){
        $comingsoon = $comingsoon[0];
        $iod_video = json_decode(get_post_meta( $comingsoon->ID, '_iod_video',true))->embed->url;
        $ytpattern = '/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/';
        if(preg_match($ytpattern,$iod_video,$vid_id)){
            $iod_video_thumbnail = 'http://img.youtube.com/vi/'.end($vid_id).'/mqdefault.jpg';
        }else{
            $iod_video_thumbnail = 'http://www.askgamblers.com/uploads/original/isoftbet-2-5474883270a0f81c4b8b456b.png';
        };
    }
?>
<!-- OWL SLIDER -->
<section id="slider">
<a id="YTPlayer" class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=nBjKRUkSRGo',containment:'#slider-vid-1',autoPlay:true, mute:true, startAt:0, stopAt:39, opacity:1, loop:1, showControls:false}"></a>
    <div class="owl-carousel buttons-autohide controlls-over nomargin hidden-xs" data-plugin-options='{"singleItem": true, "items":"3", "autoPlay": true, "navigation": true, "pagination": true, "transitionStyle":"fade"}'>
    	<?php
    		if(!empty($_banners)){
    			foreach ($_banners as $banner) {
    				$_banner_url = wp_get_attachment_url($banner->banner_id);
    	?>
    		<div>
	            <a href="<?=$banner->link?>"><img class="img-responsive" src="<?=$_banner_url?>" alt=""></a>
	        </div>
    	<?php
    			}
    		}
		?>
        <div id="slider-vid-1" style="height: 573px;">

        </div>
    </div>
    <div class="owl-carousel buttons-autohide controlls-over nomargin visible-xs" data-plugin-options='{"singleItem": true, "items":"3", "autoPlay": true, "navigation": true, "pagination": true, "transitionStyle":"fade"}'>
        <?php
            if(!empty($_banners)){
                foreach ($_banners as $banner) {
                    $_banner_url = wp_get_attachment_url($banner->banner_id);
        ?>
            <div>
                <a href="<?=$banner->link?>"><img class="img-responsive" src="<?=$_banner_url?>" alt=""></a>
            </div>
        <?php
                }
            }
            if(!empty($comingsoon)){
        ?>
            <div>
                <a class="embed-responsive-item main-box lightbox cc-watch-now-container" href="https://www.youtube.com/watch?v=<?=$vid_id[1]?>" data-plugin-options='{"type":"iframe"}'><img class="img-responsive" src="<?=$iod_video_thumbnail?>" width="100%" alt=""></a>
            </div>
        <?php
            }
        ?>

    </div>
</section>
<!-- /OWL SLIDER -->
