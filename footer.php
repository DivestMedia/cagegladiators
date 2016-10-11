		<?php
			get_template_part( 'partials/content', 'vip-subscriber' );
		?>
		<!-- FOOTER -->
		<footer id="footer">
			<div class="container padding-20 margin-bottom-10">
				<div class="text-center">
					<a href="<?=site_url()?>" class="text-white underline">
						<img src="<?=get_stylesheet_directory_uri();?>/assets/img/mmc-logo-light.png" class="width-150">
					</a>
					<!-- Social Icons -->
					<div class="text-center margin-top-0">
						<a href="https://www.facebook.com/marketmasterclasscom-1657855544470731/" target="_blank" class="social-icon social-icon-round social-icon-border social-facebook noborder" data-toggle="tooltip" data-placement="top" title="Facebook">

							<i class="icon-facebook"></i>
							<i class="icon-facebook"></i>
						</a>

						<a href="https://twitter.com/MyMarketMaster" target="_blank" class="social-icon social-icon-round social-icon-border social-twitter noborder" data-toggle="tooltip" data-placement="top" title="Twitter">
							<i class="icon-twitter"></i>
							<i class="icon-twitter"></i>
						</a>

						<a href="https://pinterest.com/MyMarketMaster" class="social-icon social-icon-round social-icon-border social-gplus noborder" data-toggle="tooltip" data-placement="top" title="Pinterest">
							<i class="fa fa-pinterest "></i>
							<i class="fa fa-pinterest "></i>
						</a>

						<a href="https://instagram.com/MyMarketMaster" class="social-icon social-icon-round social-icon-border social-instagram noborder" data-toggle="tooltip" data-placement="top" title="Instagram">
							<i class="icon-instagram"></i>
							<i class="icon-instagram"></i>
						</a>

						<a href="https://www.youtube.com/channel/UCI4UNi7DBZMHRYoaszF_CdA" target="_blank" class="social-icon social-icon-round social-icon-border social-youtube noborder" data-toggle="tooltip" data-placement="top" title="Youtube">
							<i class="icon-youtube"></i>
							<i class="icon-youtube"></i>
						</a>
					</div>
					<!-- /Social Icons -->
					<p>
						Cage Gladiators is part of the <a href="http://www.divestmedia.com" style="color: #0072bc;font-weight: bold;">Divest Media Network</a>
					</p>
				</div>
				<hr/>
				<div class="row ">
					<div class="col-sm-6">
						&copy; 2016 Cage Gladiators. All rights reserved
					</div>
					<div class="col-sm-6 text-right">
						<?php
						if(!empty(wp_get_nav_menu_items('Footer Navigation'))){
							$footer_menu = [];
							foreach (wp_get_nav_menu_items('Footer Navigation') as $f) {
								array_push($footer_menu , '<a href="'.$f->url.'">'.$f->title.'</a>');
							}
						}
						print_r(implode(' | ', $footer_menu));
						?>
					</div>
				</div>
			</div>
		</footer>
		<!-- /FOOTER -->
	</div>
	<!-- /wrapper -->
	
<!-- SCROLL TO TOP -->
<a href="#" id="toTop"></a>


<!-- PRELOADER -->
<div id="preloaderx">
	<div class="inner">
		<span class="loader"></span>
	</div>
</div><!-- /PRELOADER -->


<!-- JAVASCRIPT FILES -->
<?php
wp_footer();
global $_footers;
echo $_footers;

if(is_home()){
	?>

	<script src="<?=get_stylesheet_directory_uri();?>/assets/js/master-slider/masterslider/masterslider.js"></script>
	<script src="<?=get_stylesheet_directory_uri();?>/assets/js/slider.js"></script>
	<?php
}
?>

<script src="<?=get_stylesheet_directory_uri();?>/assets/js/jquery.matchHeight-min.js"></script>
<script>
$(function() {

	$('.box').matchHeight(true);

	/** Sparkline Graph

	USAGE

	<div class="sparkline" data-plugin-options='{"type":"bar","barColor":"#2E363F","height":"26px","barWidth":"5","barSpacing":"2"}'>
	9,6,5,6,6,7,7,6,7,8,9,7
	</div>

	PLugin options
	http://omnipotent.net/jquery.sparkline/#s-docs
	**************************************************************** **/
	if(jQuery(".sparkline").length > 0) {

		loadScript(plugin_path + 'chart.sparkline/jquery.sparkline.min.js', function() {

			if(jQuery().sparkline) {
				jQuery('.sparkline').each(function() {
					jQuery(this).sparkline('html', jQuery(this).data("plugin-options"));
				});
			}
			var sparkcount = 0;
			var sparkactive = 0;
			var sparkInterval = setInterval(function(){
				sparkcount = jQuery('.sparkline').length;
				sparkactive = jQuery('.sparkline canvas').length;
				jQuery('.sparkline').each(function() {
					if($(this).find('canvas').length==0){
						jQuery(this).sparkline('html', jQuery(this).data("plugin-options"));
					}
				});
				if(sparkcount==sparkactive){
					clearInterval(sparkInterval);
				}
			},1000);
		});
	}




	xyrLoadImg();



});
</script>


<?php


$post_slug = basename(get_permalink());
if(!empty($post_slug)):
	if(in_array($post_slug,[
		'subscriptions',
		'webinars',
		'stockfocus',
		'stockwatch',
		'dummies-guide',
		'find-a-broker',
		'celebrity-watch',
		])){
			if(empty($_COOKIE['dm-intro-vid-'.$post_slug])){

				$intros = [
					'subscriptions' => 'https://www.youtube.com/watch?v=_fqUtePTPj8',
					'webinars' => 'https://www.youtube.com/watch?v=Bw2PD_9BF9Y',
					'stockfocus' => 'https://www.youtube.com/watch?v=54cQar5LDrU',
					'stockwatch' => 'https://www.youtube.com/watch?v=637TJ_9XMak',
					'dummies-guide' => 'https://www.youtube.com/watch?v=y3_21xTqOhg',
					'find-a-broker' => 'https://www.youtube.com/watch?v=0IOrhWs9SKg',
					'celebrity-watch' => 'https://www.youtube.com/watch?v=VxrZ2w4Ad0I',
				];

				if(!empty($intros[$post_slug])){

					?>
					<!-- ANDY PENDER VIDEOS -->
					<script>
					function setCookie(c_name, value, exdays) {
						var exdate = new Date();
						exdate.setDate(exdate.getDate() + exdays);
						var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
						document.cookie = c_name + "=" + c_value;
					}

					loadScript(plugin_path + 'magnific-popup/jquery.magnific-popup.min.js', function() {

						if(typeof(jQuery.magnificPopup) == "undefined") {
							return false;
						}
						jQuery.magnificPopup.open({
							"preloader" : true,
							"type":"iframe",
							"closeOnBgClick":false,
							"autoload":true,
							"autoload-delay":2000,
							"items": {
								src: "<?=($intros[$post_slug])?>"
							},
							callbacks : {
								afterClose: function() {
									setCookie('<?=('dm-intro-vid-'.$post_slug)?>','true',7);
								}
							}
						});

					});

					</script>


					<?php
				}
			}
		}
	endif;
	?>




</body>

</html>