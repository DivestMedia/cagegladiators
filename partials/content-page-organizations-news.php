<?php
get_header();
$parent = get_page_by_path('organizations');
$args = array(
    'post_parent' => $parent->ID,
    'post_type'   => 'page', 
    'numberposts' => -1,
    'post_status' => 'any' 
);

$children = get_children( $args );

?>
<section class="alternate" id="section-organizations-news" data-cat="<?=$_org?>">
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
                    <h2 class="font-proxima uppercase"><?=$_org?> News</h2>
                </header>
                <div class="row margin-top-30" id="news-row">

                </div>
                <div class="text-center">
                    <button class="btn btn-red btn-sm btn-showmorenews noradius"  style="display: none;"><strong>Show More</strong></button>
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();