<?php

add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );

function backstage_smarty_setup() {
    add_image_size( 'main-image', 600, 400, true ); // Hard Crop Mode
    add_image_size( 'mid-image', 450, 300, true ); // Hard Crop Mode
    add_image_size( 'thumb-image', 150, 99, true ); // Hard Crop Mode
    add_image_size( 'horizontal-image',500,200, true ); // Hard Crop Mode
    add_image_size( 'ratio-image',400,400, false ); // Hard Crop False
    add_image_size( 'ratio-image-crop',400,400, true ); // Hard Crop False
    add_image_size( 'tiny-image',50,50, true ); // Hard Crop False
    add_image_size( 'mid-ratio-image',400,800, false ); // Hard Crop False - poster
    add_image_size( 'mini-ratio-image',100,100, true ); // Hard Crop False
    add_theme_support('post-thumbnails');
}
add_action( 'after_setup_theme', 'backstage_smarty_setup' );

function backstage_smarty_scripts() {

    // THEME MAIN CSS;
    wp_enqueue_script( 'mmc-smarty-main-js', get_stylesheet_directory_uri() . '/assets/js/general.js',['jquery'],null,true);
    wp_enqueue_script( 'mmc-smarty-main-js-mobile', get_stylesheet_directory_uri() . '/assets/js/jquery.browser.mobile.js',['jquery'],null,true);
    wp_enqueue_style( 'mmc-smarty-main-css', get_stylesheet_directory_uri() . '/assets/css/general.css');
    //

}
add_action( 'wp_enqueue_scripts', 'backstage_smarty_scripts' ,11);

function xyrthumb_columns_css(){
    echo '
    <style>
    .column-featured_image{width:150px;}
    </style>
    ';

}
add_action( 'admin_head' , 'xyrthumb_columns_css' );

function xyrthumb_columns( $columns ) {

    $new_columns = array('cb' => '<input type="checkbox" />', 'featured_image' => 'Image');
    return array_merge($new_columns, $columns);
}
add_filter('manage_posts_columns' , 'xyrthumb_columns');

function xyrthumb_columns_data( $column, $post_id ) {
    switch ( $column ) {
        case 'featured_image':
        echo the_post_thumbnail( 'thumb-image' );
        break;
    }
}
add_action( 'manage_posts_custom_column' , 'xyrthumb_columns_data', 10, 2 );

add_action( 'widgets_init', 'backstage_smarty_widgets_init' );

function backstage_smarty_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', XYR_SMARTY),
        'id' => 'sidebar-single',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', XYR_SMARTY ),
        'before_widget' => '<div id="%1$s" class="row widget %2$s"><div class="col-sm-12 col-md-12 col-lg-12">',
        'after_widget'  => '</div></div>',
        'before_title'  => '',
        'after_title'   => '',
    ));
    register_sidebar( array(
        'name' => __( 'Ads Sidebar', XYR_SMARTY),
        'id' => 'sidebar-ads',
        'description' => __( 'Widgets in this area will be shown on the right most side of single pages.', XYR_SMARTY ),
        'before_widget' => '<div id="%1$s" class="row widget %2$s"><div class="col-sm-12 col-md-12 col-lg-12">',
        'after_widget'  => '</div></div>',
        'before_title'  => '',
        'after_title'   => '',
    ));
}



function posts_pagination($_limit=false) {
    global $wp_query,$query_string;
    $total_page = $wp_query->max_num_pages;
    if(!empty($_limit)){
        $total_page = ceil($wp_query->found_posts/$_limit);
    }

    $big = 999999999;
    $pages = paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?page=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $total_page,
        'prev_next' => false,
        'type' => 'array',
        'prev_next' => TRUE,
        'prev_text' => '&larr; Prev',
        'next_text' => 'Next &rarr;',
    ));


    if (is_array($pages)) {
        $current_page = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<ul class="pagination">';
        foreach ($pages as $i => $page) {
            if ($current_page == 1 && $i == 0) {
                echo "<li class='active'>$page</li>";
            } else {
                if ($current_page != 1 && $current_page == $i) {
                    echo "<li class='active'>$page</li>";
                } else {
                    echo "<li>$page</li>";
                }
            }
        }
        echo '</ul>';
    }
}


function pre_get_vid_post_type($query) {

    if ( !is_admin() && $query->is_main_query() && is_tax('iod_category')) {
        $query->set('post_type', array( 'iod_video') );
    }
    if ( !is_admin() && $query->is_main_query() && is_post_type_archive('iod_video')) {
        $query->set('post_type', array( 'iod_video') );
    }
}

add_action('pre_get_posts','pre_get_vid_post_type');

class custom_xyren_smarty_walker_nav_menu extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }



    // add main/sub classes to li's and links
    //  function start_el( &$output, $item, $depth, $args ) {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        // depth dependent classes
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );




        $active = $item->current ? ' active' : '';

        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // build html
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . ' '. $active .'">';

        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

        $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
        if( !empty($children )){
            $attributes .= ' class="dropdown-toggle"';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '#';
        }else{
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
        }

        if(!is_array($args)){
            $args = (array)$args;
        }

        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args['before'],
        $attributes,
        $args['link_before'],
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args['link_after'],
        $args['after']
    );

    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}

function render_side_bar_widget(){
    get_template_part( 'partials/content', 'sidebar-widget' );
}


/**
* trims text to a space then adds ellipses if desired
* @param string $input text to trim
* @param int $length in characters to trim to
* @param bool $ellipses if ellipses (...) are to be added
* @param bool $strip_html if html tags are to be stripped
* @return string
*/
function trim_text($input, $length, $ellipses = true, $strip_html = true) {


    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }

    //trim whitespace
    $input = preg_replace('/\s+/', ' ', $input);

    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }

    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);

    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= '...';
    }

    return $trimmed_text;
}

add_action( 'json_api', function( $controller, $method )
{
    # DEBUG
// wp_die( "To target only this method use <pre><code>add_action('$controller-$method', function(){ /*YOUR-STUFF*/ });</code></pre>" );

header( "Access-Control-Allow-Origin: *" );
}, 10, 2 );


function file_get_contents_curl($url){

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Linux; Android 6.0.1; MotoG3 Build/MPI24.107-55) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.81 Mobile Safari/537.36");
    // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);
    // Execute
    $result=curl_exec($ch);
    // Closing
    curl_close($ch);

    return $result;
}


add_filter( 'wp_get_attachment_image_src' , 'wp_get_attachment_image_src_cb' , 10,4 );
function wp_get_attachment_image_src_cb($image = [],$attachment_id,$size,$icon){

    // Get Parent Post Data
    $post = wp_get_post_parent_id($attachment_id);
    $postCategory = get_the_category($post);
    $isnews = false;
    if(count($postCategory)){
        foreach ($postCategory as $term) {
            if($term->slug=='news'){
                $isnews = true;
                break;
            }
        }
    }

    if($isnews){
        if(empty($image[0]) || checkIfDefaultFileName($image[0])){
            $tags = get_the_tags($$post);
            $tag = 'default';
            if(!empty($tags)){
                $tag = $tags[array_rand($tags)]->slug;
            }

            $imagefile = pickdefaultimage($tag);
            $imagepath = NEWSBASEURL . $imagefile;
            // $imagepath = wp_upload_dir()['basedir'] . str_replace('wp-content/uploads','',$imagefile);
            if(is_readable($imagepath)){
                $imageurl = site_url($imagefile);
                list($width, $height) = getimagesize($imagepath);
                return [$imageurl,$width,$height,true];
            }else{

                $imagefile = 'wp-content/uploads/2016/09/gen-news-2.jpg';
                $imagepath = wp_upload_dir()['basedir'] . str_replace('wp-content/uploads','',$imagefile);
                $imageurl = site_url($imagefile);
                list($width, $height) = getimagesize($imagepath);
                return [$imageurl,$width,$height,true];

            }
        }else{
            return $image;
        }
    }else{
        return $image;
    }

    if($image && isset($image[0])) return $image;
    return false;
}

function slug_get_post_tags( $post, $field_name, $request ) {
    return get_the_tags($post['id']);
}


function in_array_strpos($word, $array){
    foreach($array as $a){
        if (strpos($word,$a) !== false) {
            return true;
        }
    }
    return false;
}

function checkIfDefaultFileName($url){
    $fnd = 0;
    $terms = [
        'comrssmarketwatch',
        'invlogosinv',
        'ft-news',
        'Default_Image',
        'vc_gitem_image',
        'moneycontrol_logo',
        'cms-59',
        'v2imagesreuters',
        'default',
        'bbc_news_logo',
        'cnnmoney_logo',
        'rcom-default',
        'mw_logo_social',
        '6325547',
    ];
    if(in_array_strpos($url,$terms)){
        $fnd++;
    }
    return $fnd;
}



function unhook_thematic_functions() {
    remove_action( 'template_redirect', 'xyren_smarty_search_url_redirect' );
    if (function_exists('w3tc_pgcache_flush')) {
        w3tc_pgcache_flush();
    }
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

add_action( 'init', 'unhook_thematic_functions' );

add_action( 'init', 'blockusers_init' );
function blockusers_init() {
    // If accessing the admin panel and not an admin
    if ( is_admin() && current_user_can('subscriber') && !current_user_can('administrator') && !current_user_can('editor') && !current_user_can('moderator') ) {
        // Redirect to the homepage
        wp_redirect( home_url() );
        exit;
    }

    if(is_user_logged_in()){
        setcookie( 'dm-user-last-activity', time(), 30 * DAY_IN_SECONDS, '/' , '.marketmasterclass.com' );
    }
}




add_action( 'wp_ajax_nopriv_save_user_preferences', 'save_user_preferences');
add_action( 'wp_ajax_save_user_preferences', 'save_user_preferences' );

function save_user_preferences(){
    $tags = $_POST['tags'];
    if(!empty($tags) && is_user_logged_in()){
        update_user_meta( get_current_user_id(), 'preferred_news', $tags);
    }
}
