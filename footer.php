		<?php
			get_template_part( 'partials/content', 'vip-subscriber' );
		?>
		<section id="sec-footer">
		<!-- FOOTER -->
		<footer id="footer">
			<div class="container padding-20 margin-bottom-0">
				<div class="text-center">
					<a href="<?=site_url()?>" class="text-white underline">
						<img src="<?=get_stylesheet_directory_uri();?>/assets/img/footer-logo.png" class="width-150">
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
				<div class="row footer-navcc">
					<div class="col-md-6 col-sm-12 margin-bottom-10 cont-cc">
						&copy; 2016 Cage Gladiators. All rights reserved
					</div>
					<div class="col-md-6 col-sm-12 margin-bottom-10 cont-nav">
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
		</section>
	</div>
	<!-- /wrapper -->
	
<!-- SCROLL TO TOP -->
<a href="#" id="toTop"></a>


<!-- PRELOADER -->
<div id="preloader">
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

</body>

</html>