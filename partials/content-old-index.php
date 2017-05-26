<div class="row padding-10">
    <div class="col-sm-3 col-md-2 margin-bottom-20 main-section-container hidden-xs">
        <?php dynamic_sidebar('ads-home-left')?>
    </div>
    <div id="container-featured-news" class="col-sm-9 col-md-6 margin-bottom-20 main-section-container">

        <?php
        $leagues = [
            'ufc' => [
                'rssid' => 2113,
                'rsstitle' => 'UFC Latest News',
                'name' => 'UFC',
            ],
            'pxc' => [
                'rssid' => 2112,
                'rsstitle' => 'PXC Latest News',
                'name' => 'PXC',
            ],
            'urcc' => [
                'rssid' => 2111,
                'rsstitle' => 'URCC Latest News',
                'name' => 'URCC',
            ]
        ];

        ?>

        <div id="news-nav-container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <?php foreach($leagues as $key => $league): ?>
                <li role="presentation" class="<?=($key=='ufc' ? 'active' : '')?>"><a href="#<?=$key?>" aria-controls="<?=$key?>" role="tab" data-toggle="tab"><?=$league['name']?></a></li>
            <?php endforeach; ?>

            </ul>
            <!-- Nav tabs end -->
        </div>
        <!-- Tab panes -->
        <div class="tab-content">
            <?php foreach ($leagues as $key => $league): ?>
            <div role="tabpanel" class="tab-pane <?=($key=='ufc' ? 'active' : '')?>" id="<?=$key?>">
                <div class="featured-news-row">
                    <div class="row">
                        <div class="col-md-4">event</div>
                        <div class="col-md-4">news content</div>
                        <div class="col-md-4">news thumb</div>
                    </div>
                </div>
                <div class="other-news-row">
                    <div class="uppercase section-title text-white text-center weight-700 size-17 margin-bottom-10">Inside The Cage</div>
                    <?php
                    $news = [];

                    $results = $wpdb->get_results( 'SELECT * FROM `wp_feed_items_urls` WHERE `rss_id` = '.$league['rssid'].' ORDER BY `date_created` DESC LIMIT 4', OBJECT );
                    if(!empty($results[0])):
                        $RSSFIRUL = new RSSFIRUL();
                        $res = $RSSFIRUL->getFeedItemsByUrl($league['rsstitle'],1,1,[
                            (object)['id'=>$results[0]->id,'url'=>$results[0]->url,'title'=>$results[0]->title,'name'=>$results[0]->name]
                            ]);
                        if(!empty($res[0])){
                                    $res = $res[0];
                                }
                            ?>
                            <div class="latest-news-container margin-bottom-10" data-news-id="<?=$res['post-id']?>" style="background-image: url('<?=$res['post-thumbnail']?>')">
                                <!-- <img src="<?=$res['post-thumbnail']?>" alt="" style="width: 100%;height: auto;"> -->
                                <div class="latest-news-details">
                                    <div><span class="latest-news-date uppercase"><?=(date('M j',strtotime(isset($res['published-date']) ? $res['published-date'] : $results[0]->date_created)))?></span><span class="latest-news-category uppercase"><?=$league['name']?> NEWS</span></div>
                                    <div class="latest-news-title uppercase weight-700"><a href="<?=site_url('news/'.$results[0]->id.'/'.$results[0]->name)?>"><?=trim_text(($res['post-title']),50)?></a></div>
                                </div>
                            </div>

                        <?php endif;?>

                        <div class="other-news-container row">
                            <?php for($i=1; $i<4;$i++): if(!isset($results[$i])) continue; ?>
                                <?php
                                $RSSFIRUL = new RSSFIRUL();
                                $res = $RSSFIRUL->getFeedItemsByUrl($league['rsstitle'],1,1,[
                                    (object)['id'=>$results[$i]->id,'url'=>$results[$i]->url,'title'=>$results[$i]->title,'name'=>$results[$i]->name]
                                    ]);
                                if(!empty($res[0])){
                                    $res = $res[0];
                                }
                                    ?>
                                    <div class="col-sm-4">
                                        <figure class="box-shadow-8" data-id="<?=$res['post-id']?>" style="background-image: url('<?=$res['post-thumbnail']?>')">
                                            <!-- <img class="img-responsive" src="<?=$res['post-thumbnail']?>" alt="" /> -->
                                        </figure>
                                        <div class="other-news-title margin-top-10 size-13"><a href="<?=site_url('news/'.$results[$i]->id.'/'.$results[$i]->name)?>"><?=trim_text(($res['post-title']),50)?></a></div>
                                    </div>
                                <?php endfor;?>

                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>

                </div>
                <!-- Tab panes end -->
                <div id="container-cage-corner">
                    <div class="uppercase section-title text-white text-center weight-700 size-17">Cage Corner</div>
                    <div class="content-cage-corner">
                        <div>
                            <div class="uppercase content-category text-white">Invest or divest</div>
                            <div class="uppercase content-category-label text-white">Learn from the best</div>
                            <div class="uppercase content-fighter text-white">
                                <label>Elite MMA Trainer</label>
                                <h1 class="text-white">Brock Lesnar</h1>
                            </div>
                            <div class="content-button"><button type="button" class="btn btn-danger">CLICK HERE</button></div>
                        </div>
                        <img src="/wp-content/themes/cagegladiators/assets/img/cage-corner-fighter-1.png" alt="" style="width: 50%;height: auto;">
                    </div>
                </div>
            </div>
            <div id="container-side-featuredfighter" class="col-sm-12 col-md-4 margin-bottom-20 main-section-container">
                <?php
                get_template_part( 'partials/content', 'side-featuredfighter' );
                ?>
            </div>
        </div>
