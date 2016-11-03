<?php
global $post;
$parent = get_page_by_path('organizations');
if(!empty($parent)){
	if($post->post_parent == $parent->ID){
		get_header();
		get_template_part("partials/content", 'page-organizations-child' );
		get_footer();
		die();
	}
}

get_header();
get_template_part("partials/content", locate_template('partials/content-page-'.basename(get_permalink()).'.php')!='' ? 'page-'.basename(get_permalink()) : 'page' );
get_footer();
