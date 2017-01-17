<?php
$args = array(
    'post_parent' => $post->post_parent,
    'post_type'   => 'page', 
    'numberposts' => -1,
    'post_status' => 'any' 
);

$children = get_children( $args );
$fighters = get_posts([
    'posts_per_page'   => 3,
    'orderby'          => 'rand',
    'post_type'        => 'fighter',
    'post_status'      => 'publish',
    'tag'              => strtoupper($post->post_name),
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

?>
<section class="alternate section-fighters section-organizations-child" id="section-organizations" data-cat="<?=$post->post_name?>">
    <div class="container">
        <div class="row tab-v3">
            <div class="col-md-3 hidden-xs hidden-sm">
                <!-- side navigation -->
                <div class="side-nav margin-top-50 nav-container">
                    <?php if(!empty($children)): ?>
                        <div class="side-nav-head">
                            <button class="fa fa-bars"></button>
                            <h4>Organizations</h4>
                        </div>
                        <ul class="list-group list-group-bordered list-group-noicon uppercase">
                            <?php foreach ($children as $category): 
                            ?>
                                <li class="list-group-item <?=!strcasecmp($category->ID, $post->ID)?'active cur_active':''?>">
                                    <a class="dropdown-toggle" href="<?=get_permalink($category->ID)?>"><?=$category->post_title?></a>
                                    <ul>
                                        <li class="active">
                                            <a href="<?=get_permalink($category->ID)?>/fighters">Fighters</a>
                                            <ul class="fighter-category">
                                            <?php
                                                $fighter_categories = get_terms('fighters');
                                                if(!empty($fighter_categories)){
                                                    foreach ($fighter_categories as $_cat) {
                                            ?>
                                                <li><a href="<?=get_permalink($category->ID).'fighters/'.$_cat->slug?>"><?=$_cat->name?></a></li>
                                            <?php
                                                    }
                                                }
                                            ?>
                                            </ul>
                                        </li>
                                        <li>
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
            <div class="col-md-9">
                <header class="text-center margin-bottom-50 tiny-line">
                    <h2 class="font-proxima uppercase"><?=$post->post_title?></h2>
                </header>
                <article id="post-<?=$post->ID?>">
                    <div class="text-black size-14 entry-content post-<?=get_post_format($post->ID);?>">
                        <?=$post->post_content?>
                    </div>
                </article>
                
                <div class="row margin-top-30">
                 <?php
                    if(!empty($fighters)){
                        ?>
                        <div class="heading-title heading-line-double">
                            <h2><?=strtoupper($post->post_title)?> <span>Fighters</span></h2>
                        </div>
                        <?php
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
                ?>
                    <div class="text-right">
                        <a href="<?=get_permalink($post->ID)?>fighters"><button class="btn btn-red btn-sm noradius"><strong>View more fighters</strong></button></a>
                    </div>
                <?php
                    }
                ?>
                </div>
                <div class="row margin-top-30">
                    <div class="heading-title heading-line-double">
                        <h2><?=strtoupper($post->post_title)?> <span>News</span></h2>
                    </div>
                    <div id="news-row">


                    </div>
                    <div class="text-right">
                        <a href="<?=get_permalink($post->ID)?>news"><button class="btn btn-red btn-sm noradius"><strong>View more news</strong></button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>