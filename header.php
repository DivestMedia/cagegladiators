<?php

flush();

?><!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?php wp_title( '|', true, 'right' ); ?><? bloginfo();?></title>
	<meta name="keywords" content="HTML5,CSS3,Template" />
	<meta name="description" content="" />

	<!-- mobile settings -->
	<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

	<? wp_head();?>
	<link rel="stylesheet" href="<?=get_stylesheet_directory_uri();?>/assets/js/master-slider/masterslider/style/masterslider.css">
	<link rel='stylesheet' id='main-css' href='<?=get_stylesheet_directory_uri();?>/assets/css/general.css' type='text/css' media='all' />

	<meta name="theme-color" content="#ffffff">

</head>

<!--
AVAILABLE BODY CLASSES:

smoothscroll 			= create a browser smooth scroll
enable-animation		= enable WOW animations

bg-grey					= grey background
grain-grey				= grey grain background
grain-blue				= blue grain background
grain-green				= green grain background
grain-blue				= blue grain background
grain-orange			= orange grain background
grain-yellow			= yellow grain background

boxed 					= boxed layout
pattern1 ... patern11	= pattern background
menu-vertical-hide		= hidden, open on click

BACKGROUND IMAGE [together with .boxed class]
data-background="assets/images/boxed_background/1.jpg"
-->
<body class="smoothscroll enable-animation">
	<!-- wrapper -->
	<div id="wrapper">
				<!--
			AVAILABLE HEADER CLASSES

			Default nav height: 96px
			.header-md 		= 70px nav height
			.header-sm 		= 60px nav height

			.noborder 		= remove bottom border (only with transparent use)
			.transparent	= transparent header
			.translucent	= translucent header
			.sticky			= sticky header
			.static			= static header
			.dark			= dark header
			.bottom			= header on bottom

			shadow-before-1 = shadow 1 header top
			shadow-after-1 	= shadow 1 header bottom
			shadow-before-2 = shadow 2 header top
			shadow-after-2 	= shadow 2 header bottom
			shadow-before-3 = shadow 3 header top
			shadow-after-3 	= shadow 3 header bottom

			.clearfix		= required for mobile menu, do not remove!

			Example Usage:  class="clearfix sticky header-sm transparent noborder"
		-->
		<div id="header" class="dark header-md <?=(is_front_page()&&strrpos($_SERVER['REQUEST_URI'],'accounts')===FALSE)?'transparent':''?> clearfix noshadow sticky">
			<!-- TOP NAV -->
			<header id="topNav" class="noshadow">
				<div class="container">

					<!-- Mobile Menu Button -->
					<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
						<i class="fa fa-bars"></i>
					</button>

					<!-- BUTTONS -->
					<ul class="pull-right nav nav-pills nav-second-main">

						<!-- SEARCH -->
						<li class="search">
							<a href="javascript:;">
								<i class="fa fa-search"></i>
							</a>
							<div class="search-box">
								<form action="<?php echo site_url();?>" method="get">
									<div class="input-group">
										<input type="text" name="s" id="s" placeholder="Search" class="form-control" />
										<span class="input-group-btn">
											<button class="btn btn-primary" type="submit">Search</button>
										</span>
									</div>
								</form>
							</div>
						</li>
						<!-- /SEARCH -->


					</ul>
					<!-- /BUTTONS -->

					<!-- Logo -->
					<a class="logo pull-left" href="<?=site_url()?>">
						<img src="<?=get_stylesheet_directory_uri();?>/assets/img/header-logo-light.png" alt="" />
					</a>

					<!--
					Top Nav

					AVAILABLE CLASSES:
					submenu-dark = dark sub menu
				-->
				<div class="navbar-collapse pull-right nav-main-collapse collapse">
					<nav class="nav-main">

						<!--
						NOTE

						For a regular link, remove "dropdown" class from LI tag and "dropdown-toggle" class from the href.
						Direct Link Example:

						<li>
						<a href="#">HOME</a>
					</li>
				-->
				<?php

				$_menu = wp_nav_menu(array(
					'menu' => 'Main menu',
					'walker' => new custom_xyren_smarty_walker_nav_menu(),
					'menu_id'=>'topMain',
					'container' =>'ul',
					'menu_class' =>'nav nav-pills nav-main has-topBar',
					'echo' => false
				));

				echo $_menu;
				?>
			</nav>
		</div>

	</div>
	</header>
	<!-- /Top Nav -->

	</div>