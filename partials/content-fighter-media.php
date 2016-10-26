<?php
	get_header();
?>
	<section id="section-media-gallery" class="dark">
		<div class="container">
			<div class="row">
				<!-- <div class="col-md-2 container-fighter-info">
					<h1><?=$fighter->post_title?></h1>
					<img class="img-responsive noradius" src="<?=wp_get_attachment_image_src(get_post_meta( $fighter->ID, '_uf_image_left', true ),'full')[0]?>" alt="" />
					<p><?=$fighter->post_content?></p>
				</div>  -->
				<div class="col-md-9">
					<h3 class="header-red"><?=$fighter->post_title?> Media Gallery</h3>
                        <?php if(!empty($media_gallery)){?>
                        <div class="masonry-gallery columns-4 margin-bottom-20 clearfix lightbox" data-img-big="1" data-plugin-options='{"delegate": "a", "gallery": {"enabled": true}}'>
                            <?php
                                foreach ($media_gallery as $key => $img) {
                            ?>
                                    <a class="image-hover" href="<?=wp_get_attachment_image_src($img,'medium')[0]?>">
                                        <img src="<?=wp_get_attachment_image_src($img,'medium')[0]?>" alt="...">
                                    </a>
                            <?php
                                }
                            ?>
                        </div>
                        <?php }?>
				</div>
				<div class="col-md-2 hidden-sm hidden-xs">
					<?php dynamic_sidebar('ads-home-left')?>
				</div>
			</div>
		</div>
	</section>
<?php
	get_footer();