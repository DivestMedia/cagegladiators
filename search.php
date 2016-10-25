<?php 
  get_header();  
  $_tag = $wp_query->query;

  global $wpdb;
  $fiu = $wpdb->prefix.'feed_items_urls';
  if(!empty($_tag['s'])){
    $search_query = explode(' ', $_tag['s']);
    $c_where = [];
    $c_order = ['WHEN title LIKE "%'.$_tag['s'].'%" THEN 1'];
    $case = [];
    foreach ($search_query as $s) {
      $tq = ['(title LIKE "%'.$s.'%")','(description LIKE "%'.$s.'%")'];
      $tq = '('.implode(' OR ', $tq).')';
      array_push($c_where,$tq);
      array_push($case,'title LIKE "%'.$s.'%"');
    }
    $c_where = implode(' AND ', $c_where);
    
    array_push($c_order, 'WHEN '.implode(' AND ', $case)." THEN 2");
    array_push($c_order, 'WHEN '.implode(' OR ', $case)." THEN 3");
    array_push($c_order, 'WHEN description LIKE "%'.$_tag['s'].'%" THEN 4');
    array_push($c_order, 'ELSE 5');
    $c_order = '(CASE '.implode(' ', $c_order).' END), date_created DESC';
  }

  $news_rs_total = $wpdb->query(' SELECT * FROM `'.$fiu.'` WHERE '.$c_where);

  $limit = 10;
  $cur_page = !empty($_tag['paged'])?$_tag['paged']:1;
  $total_page = ceil($news_rs_total/$limit);
  $offset = $cur_page*$limit-$limit;
  
  $news_rs = $wpdb->get_results(' SELECT * FROM `'.$fiu.'` WHERE '.$c_where.' ORDER BY '.$c_order.'  LIMIT '.$offset.',10 ');

  if(!empty($news_rs)){
    $RSSFIRUL = new RSSFIRUL();
    $news_rs = $RSSFIRUL->getFeedItemsByUrl('all news',10,$cur_page,$news_rs);
  }
?>
<section id="search-container">
  <div class="container">
    <div class="left-content align-left">
      <div class="row">
          <div class="col-md-10 col-sm-10 col-xs-12">
            <h4><?=number_format($news_rs_total)?> result/s found for: "<?php printf( __( '%s', 'simply-loud' ), get_search_query()  ); ?>"</h4>
        <?php 
        if(!empty($news_rs)):
          foreach($news_rs as $news){
            $post_url = home_url('/news/'.$news['post-id'].'/'.$news['post-name']);
        ?>
            <div class="margin-bottom-20 col-md-12 col-sm-12 col-xs-12">
              <div class="col-md-3 col-sm-3 col-xs-12" >
                <a href="<?=$post_url?>">
                <div class="thumbnail">
                  <img class="img-responsive" src="<?=$news['post-thumbnail']?>" alt="" />
                </div>
                </a>
              </div>
              <div class="col-md-9 col-sm-9 col-xs-12 cont-episode-details">
                <a href="<?=$post_url?>" title="<?=$news['post-title']; ?>" class="size-17 post-title"><strong><?=$news['post-title']; ?></strong></a>
                <?php if(!empty($news['published-date'])){?>
                    <p class="margin-bottom-10">
                      <small>
                      <?php if(!empty($news['published-date'])){?>
                        <i class="fa fa-calendar fa-fw"></i>
                        <?php echo date('F d, Y',strtotime($news['published-date'])); 
                      }?>
                      </small>
                    </p>
                    <?php }?>
                <p class="margin-bottom-10"><?=trim_text(strip_tags($news['post-content']), 230)?></p>
                <a href="<?=$post_url?>"><button class="btn btn-red btn-sm pull-right">Read More</button></a>
              </div>
            </div>
        <?php
          }
        else:
          ?>
          <div class="col-md-12"><h3>No results found</h3></div>        
        <?php
        endif;
         ?>
          <div class="pagination"><?php 
            $pages = paginate_links(array(
              'base'               => '/page/%_%/?s='.$_tag['s'],
              'format'             => '%#%',
              'total'              => $total_page,
              'current'            => $cur_page,
              'show_all'           => false,
              'prev_next'          => true,
              'prev_text'     => '&larr; Prev',
                'next_text'     => 'Next &rarr;',
              'type'               => 'array',
              'add_args'           => false,
            ));     
            if (is_array($pages)) {
                  echo '<ul class="pagination">';
                  foreach ($pages as $i => $page) {
                      if ($cur_page == 1 && $i == 0) {
                          echo "<li class='active'>$page</li>";
                      } else {
                          if ($cur_page != 1 && $cur_page == $i) {
                              echo "<li class='active'>$page</li>";
                          } else {
                              echo "<li>$page</li>";
                          }
                      }
                  }
                  echo '</ul>';
              }
        ?></div>
        </div>
        <div class="col-md-2 col-sm-2 hidden-xs">
          <?php dynamic_sidebar('ads-home-left')?>
        </div>
      </div>
    </div>
    <br class="clear"/>
  </div>
</section>


<?php get_footer(); 

