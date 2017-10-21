<?php

$current_page_info = get_queried_object();
if(!empty($current_page_info)){
	get_header();
	if($current_page_info->name=='fighter'){
		get_template_part("partials/content", locate_template('partials/content-archive-fighter.php')!='' ? 'archive-fighter' : 'archive' );
	}
	if($current_page_info->name=='iod_video'){
		get_template_part("partials/content", locate_template('partials/content-archive-iod_video.php')!='' ? 'archive-iod_video' : 'archive' );
	}

	get_footer();
}else{
	// global $wp_query;
	// $wp_query->set_404();
	// status_header( 404 );
	// get_template_part( 404 );
}
