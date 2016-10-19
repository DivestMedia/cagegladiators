<?php
$current_page_info = get_queried_object();
if(!empty($current_page_info)){
	$weight_class = ['bantamweight','featherweight','flyweight','heavyweight','light_heavyweight','lightweight','middleweight','welterweight','women_bantamweight','women_strawweight'];
	get_header();
	if($current_page_info->name=='fighter'||in_array($current_page_info->slug, $weight_class)){
		get_template_part("partials/content", locate_template('partials/content-archive-fighter.php')!='' ? 'archive-fighter' : 'archive' );
	}
	get_footer();
}else{
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 );
}