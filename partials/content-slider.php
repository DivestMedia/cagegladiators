<?php
	$_banners = json_decode(do_shortcode( '[SM_GET_BANNER]' ));
?>
<!-- OWL SLIDER -->
<section id="slider">
<a id="YTPlayer" class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=w8fGK7Ubfxk',containment:'#slider-vid-1',autoPlay:true, mute:true, startAt:0, stopAt:39, opacity:1, loop:1, showControls:false}"></a>
    <div class="owl-carousel buttons-autohide controlls-over nomargin" data-plugin-options='{"singleItem": true, "items":"3", "autoPlay": true, "navigation": true, "pagination": true, "transitionStyle":"fade"}'>
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
</section>
<!-- /OWL SLIDER -->

