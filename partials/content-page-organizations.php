<?php

$args = array(
    'post_parent' => $post->ID,
    'post_type'   => 'page', 
    'numberposts' => -1,
    'post_status' => 'any' 
);

$children = get_children( $args );

?>
<section class="alternate" id="section-organizations">
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
                                <li class="list-group-item">
                                    <a class="dropdown-toggle" href="#"><?=$category->post_title?></a>
                                    <ul>
                                        <li>
                                            <a href="<?=get_permalink($category->ID)?>/fighters">Fighters</a>
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
                    if(!empty($children)){
                        foreach ($children as $category){
                ?>
                    <div class="col-md-6 margin-bottom-30">

                        <div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
                            <div class="front">
                                <div class="box1 noradius padding-0">
                                    <figure style="background-image: url('<?=get_the_post_thumbnail_url($category->ID,'mid-image')?>');background-size: cover;background-repeat: no-repeat;height: 250px;background-position: center;"></figure>
                                    <div class="organization-content padding-10 text-left">
                                        <h4 class="title upppercase font-proximanova size-25"><strong><?=$category->post_title?></strong></h4>
                                        <label><?=trim_text($category->post_content,150)?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="back">
                            <a href="<?=get_the_permalink($category->ID)?>">
                                <div class="box2 noradius">
                                    <h4 class="font-proximanova size-25"><strong><?=$category->post_title?></strong></h4>
                                    <hr />
                                    <p><?=trim_text($category->post_content,500)?></p>
                                    
                                </div>
                                </a>
                            </div>
                        </div>

                    </div>
                <?php
                        }
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</section>