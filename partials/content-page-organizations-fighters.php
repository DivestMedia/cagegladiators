<?php

$_limit = 12;

$parent = get_page_by_path('organizations');
$args = array(
    'post_parent' => $parent->ID,
    'post_type'   => 'page', 
    'numberposts' => -1,
    'post_status' => 'any' 
);

$children = get_children( $args );


$fighters = get_posts([
    'posts_per_page'   => $_limit,
    'paged'             => get_query_var('c_paged') ?: 1,
    'orderby'          => 'title',
    'order'            => 'ASC',
    'post_type'        => 'fighter',
    'post_status'      => 'publish',
    'tag'              => strtoupper($_org),
    'tax_query' => array(
        array(
            'taxonomy' => 'fighters',
            'field' => 'slug',
            'operator' => 'EXISTS'
        )
    ),
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key' => '_is_featured',
            'value' => '0',
        ),
        array(
            'key' => '_is_featured',
            'compare' => 'NOT EXISTS'
        ),
    ),
    'suppress_filters' => true
]);

get_header();

?>
<section class="alternate section-fighters" id="section-organizations-fighters" data-cat="<?=$_org?>">
    <div class="container">
        <div class="row tab-v3">
            <div class="col-sm-3 col-md-2 hidden-xs">
                <!-- side navigation -->
                <div class="side-nav margin-top-50 nav-container">
                    <?php if(!empty($children)): ?>
                        <div class="side-nav-head">
                            <button class="fa fa-bars"></button>
                            <h4>Organizations</h4>
                        </div>
                        <ul class="list-group list-group-bordered list-group-noicon uppercase">
                            <?php foreach ($children as $category): 
                                $active = [];
                                if(!empty($_org==$category->post_name)){
                                    $active[$_type] = 'cur_active';
                                }
                            ?>
                                <li class="list-group-item <?=!strcasecmp($category->post_title, $_org)?'active':''?>">
                                    <a class="dropdown-toggle" href="#"><?=$category->post_title?></a>
                                    <ul>
                                        <li class="<?=(!empty($active[$_type])&&!strcasecmp($_type, 'fighters'))?$active[$_type]:''?>">
                                            <a href="<?=get_permalink($category->ID)?>/fighters">Fighters</a>
                                        </li>
                                        <li class="<?=(!empty($active[$_type])&&!strcasecmp($_type, 'news'))?$active[$_type]:''?>">
                                            <a href="<?=get_permalink($category->ID)?>/news">News</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    <?php endif;?>
                </div>
                <!-- /side navigation -->
            </div>
            <div class="col-sm-9 col-md-10">
                <header class="text-center margin-bottom-50 tiny-line">
                    <h2 class="font-proxima uppercase"><?=$_org?> Fighters</h2>
                </header>
                <div class="row">
                <?php
                    if(!empty($fighters)){
                        foreach ($fighters as $fighter) {
                            $_r_win = get_post_meta( $fighter->ID, '_uf_win', true );
                            $_r_loss = get_post_meta( $fighter->ID, '_uf_loss', true );
                            $_r_draw = get_post_meta( $fighter->ID, '_uf_draw', true );
                            $record = $_r_win.'-'.$_r_loss.'-'.$_r_draw;
                            $_r_fighter_terms = get_the_terms($fighter->ID,'fighters');
                            $f_weight_class_slug = '';
                            if(!empty($_r_fighter_terms[0])){
                                $f_weight_class = $_r_fighter_terms[0]->name;
                                $f_weight_class_slug = $_r_fighter_terms[0]->slug;
                            }
                ?>  
                            <div class="col-sm-6 col-md-4 container-fighters">
                                <a href="<?=get_permalink($fighter->ID)?>">
                                    <div class="thumbnail nopadding-bottom margin-bottom-0 noradius">
                                        <img class="img-responsive noradius" src="<?=wp_get_attachment_image_src(get_post_thumbnail_id($fighter->ID),'full')[0]?>" alt="" />
                                    </div>
                                </a>
                                <div class="fighter-details">
                                    <a href="<?=get_permalink($fighter->ID)?>"><h4 class="margin-bottom-0"><?=$fighter->post_title?></h4></a>
                                    <a href="<?=site_url('/fighters/'.$f_weight_class_slug)?>"><small class="block lbl-weightclass"><?=$f_weight_class?></small></a>
                                    <small><?=$record?></small>
                                </div>
                            </div>
                <?php
                        }
                    }else{
                ?>
                        <div class="margin-bottom-30 text-center">
                             <h2 class="text-gray">No fighter available</h2>
                        </div>
                <?php
                    }
                ?>
                </div>
                <div class="pagination block">
                <?php 
                    $currentpage  = get_query_var('c_paged') ?: 1;
                    $_rtotal = get_term_by('slug', $_org, 'post_tag');
                    if(!empty($_rtotal->count)){
                        $_rtotal = ceil($_rtotal->count/$_limit);
                        $pages = paginate_links(array(
                         'base'               => '/organizations/'.$_org.'/fighters/%_%',
                         'format'             => '%#%',
                         'total'              => $_rtotal,
                         'current'            =>  $currentpage,
                         'show_all'           => false,
                         'prev_next'          => true,
                         'prev_text'         => '&larr; Prev',
                            'next_text'      => 'Next &rarr;',
                         'type'               => 'array',
                         'add_args'           => false,
                        ));      
                        if (is_array($pages)) {
                            echo '<ul class="pagination">';
                            foreach ($pages as $i => $page) {
                                if ($currentpage == 1 && $i == 0) {
                                    echo "<li class='active'>$page</li>";
                                } else {
                                    if ($currentpage != 1 && $currentpage == $i) {
                                        echo "<li class='active'>$page</li>";
                                    } else {
                                        echo "<li>$page</li>";
                                    }
                                }
                            }
                            echo '</ul>';
                        }
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();