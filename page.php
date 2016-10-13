<?php
global $post;
get_header();
get_template_part("partials/content", locate_template('partials/content-page-'.basename(get_permalink()).'.php')!='' ? 'page-'.basename(get_permalink()) : 'single' );
get_footer();
