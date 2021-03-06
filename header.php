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
	<link rel='stylesheet' id='main-css' href='<?=get_stylesheet_directory_uri();?>/assets/css/general.css?<?=date('Ymd')?>' type='text/css' media='all' />

	<link rel="apple-touch-icon" sizes="57x57" href="<?=get_stylesheet_directory_uri();?>/assets/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?=get_stylesheet_directory_uri();?>/assets/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?=get_stylesheet_directory_uri();?>/assets/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?=get_stylesheet_directory_uri();?>/assets/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?=get_stylesheet_directory_uri();?>/assets/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?=get_stylesheet_directory_uri();?>/assets/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?=get_stylesheet_directory_uri();?>/assets/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?=get_stylesheet_directory_uri();?>/assets/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?=get_stylesheet_directory_uri();?>/assets/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?=get_stylesheet_directory_uri();?>/assets/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?=get_stylesheet_directory_uri();?>/assets/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?=get_stylesheet_directory_uri();?>/assets/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=get_stylesheet_directory_uri();?>/assets/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?=get_stylesheet_directory_uri();?>/assets/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?=get_stylesheet_directory_uri();?>/assets/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-76666609-7', 'auto');
		ga('send', 'pageview');

	</script>
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

	<div id="header" class="dark header-md clearfix noshadow sticky">
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
							<form action="<?php echo site_url();?>/search" method="get">
								<div class="input-group">
									<input type="text" name="keyword" id="s" placeholder="Search" class="form-control" />
									<span class="input-group-btn">
										<button class="btn btn-danger btn-red" type="submit">Search</button>
									</span>
								</div>
							</form>
						</div>
					</li>
					<!-- /SEARCH -->


				</ul>
				<!-- /BUTTONS -->

				<!-- Logo -->
				<a class="custom-logo pull-left" href="<?=site_url()?>">
					<img src="<?=get_stylesheet_directory_uri();?>/assets/img/header-logo-light.png" alt="" />
				</a>

				<!--
				Top Nav

				AVAILABLE CLASSES:
				submenu-dark = dark sub menu
			-->
			<div class="navbar-collapse pull-right nav-main-collapse collapse submenu-dark">
				<nav class="nav-main">
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
