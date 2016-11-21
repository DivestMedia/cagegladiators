<?

global $_navClass;

$_navClass ='sticky header-md clearfix';
get_header();

?>


<section class="page-header dark page-header-xs">

	<div class="container">

		<h1 class="uppercase">Error: 
			<span class="word-rotator" data-delay="2000">
				<span class="items">
					<span>PAGE NOT FOUND</span>
					<span>404</span>
				</span>
			</span>
		</h1>
		
	</div>
</section>



			<!-- -->
			<section class="padding-xlg">
				<div class="container">
					
					<div class="row">

						<div class="col-md-6 col-sm-6 hidden-xs">
							
							<div class="error-404 text-red">
								#404
							</div>
						
						</div>

						<div class="col-md-6 col-sm-6">
						
							<h3 class="nomargin">Sorry, <strong>The page you requested can not be found!</strong></h3>
							<p class="nomargin-top size-20 font-lato text-muted">Please, search again using more specific keywords.</p>

							<!-- INLINE SEARCH -->
							<div class="inline-search clearfix margin-bottom-60">
								<form action="<?=site_url();?>" method="get" class="widget_search">
									<input type="search" placeholder="Search..." id="s" name="s" class="serch-input">
									<button type="submit">
										<i class="fa fa-search"></i>
									</button>
									<div class="clear"></div>
								</form>
							</div>
							<!-- /INLINE SEARCH -->

							<div class="divider nomargin-bottom"><!-- divider --></div>

							<a class="size-16 font-lato error-link-text" href="<?=site_url();?>"><i class="glyphicon glyphicon-menu-left margin-right-10 size-12"></i> back to <? bloginfo('name');?> homepage now!</a>

						</div>

					</div>
					
				</div>
			</section>
			<!-- / -->



			
			

<?

get_footer();
			
			