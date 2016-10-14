<?php
global $post;
get_header();
get_template_part("partials/content", locate_template('partials/content-single-'.get_post_type().'.php')!='' ? 'single-'.get_post_type() : 'single' );
get_footer();
