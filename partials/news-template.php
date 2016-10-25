<?php
get_header();


$latest_news = [];
$other_news = [];
if(!empty($_all_news)){
	foreach ($_all_news as $news) {

		if($news['post-id']!=$_news['post-id']){
			if(count($latest_news)<4){
				array_push($latest_news,$news);
			}else{
				array_push($other_news,$news);
			}
		}
	}
}
?>
<section id="news-container">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-12">
				<figure>
					<img id="post-thumbnail" src="<?=$_news['post-thumbnail']?>" class="img-responsive margin-bottom-10 wp-post-image" alt="<?=$_news['post-title']?>">
				</figure>
			</div>
			<div class="col-md-3 hidden-sm hidden-xs">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 link-black latest-news-container">
						<div class="heading-title margin-bottom-0">
							<h4 class="weight-500">LATEST NEWS</h4>
						</div>
						<div class="divider margin-top-10 margin-bottom-10 block" style="clear:both"><!-- divider --></div>
						<div class="size-14">
							<?php
								if(!empty($latest_news)){
									foreach ($latest_news as $news) {
										$post_url = home_url('/news/'.$news['post-id'].'/'.$news['post-name']);
							?>
									<div>
										<figure class="pull-right margin-bottom-10 margin-left-10" style="width:70px">
											<a href="<?=$post_url?>"><img width="150" height="99" src="<?=$news['post-thumbnail']?>" class="img-responsive wp-post-image" alt="<?=$news['post-title']?>"></a>
										</figure>												
										<a href="<?=$post_url?>" class="post-title" title="<?=$news['post-title']?>"><?=trim_text($news['post-title'],44)?></a>
										<div>
											<small>
												<i class="fa fa-clock-o"></i> 
												<span class="font-lato">
													<time class="entry-date" datetime="2016-10-10T22:06:05+00:00"><?=date('F d, Y',strtotime($news['published-date']))?></time>
												</span>
											</small>
										</div>
									</div>
									<div class="divider margin-top-10 margin-bottom-10  block" style="clear:both"><!-- divider --></div>
							<?php
									}
								}
							?>									
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <a href="#" class="text-gray bold size-10 uppercase letter-spacing-10"><?php //echo !empty(get_the_category($post->ID)[0]->name)?get_the_category($post->ID)[0]->name:'';?></a> -->
		<header class="text-left tiny-line title-container">
			<h2><?=$_news['post-title']?></h2>
			<ul class="blog-post-info list-inline margin-bottom-0" style="">
				<li>
					<i class="fa fa-clock-o"></i> 
					<span class="font-lato">
					<time class="entry-date" datetime="2016-10-10T22:06:05+00:00"><?=date('F d, Y',strtotime($_news['published-date']))?></time>
					</span>
				</li>
				<li class="font-lato">
					<i class="fa fa-folder-open-o"></i>
					<a><?=str_replace('Latest','',$_news['post-category'])?></a>			
				</li>
			</ul>
			<br/>
		</header>

		<div class="row">
			<div class="col-md-3 col-sm-3">
			</div>
			<div class="col-md-8 col-sm-9 text-justify ">
				<div class="post-content">
					<?=$_news['post-content']?>
				</div>
				<div class="divider divider-dotted"><!-- divider --></div>
				<p class="text-left">
					Read original article on <a class="orginal-link" href="<?=$_news['post-url']?>" target="_blank"><?=$_news['post-url']?></a>
				</p>
			</div>
		</div>
	</div>
	<div id="featured-news-container" class="margin-bottom-30">
		<?php $post_url = home_url('/news/'.$other_news[0]['post-id'].'/'.$other_news[0]['post-name']);?>
		<div class="container">
			<div class="row featured-news">
				<div class="col-md-7 col-sm-7 margin-bottom-20">
					<h3 class="margin-bottom-0"><a href="<?=$post_url?>"><?=$other_news[0]['post-title']?></a></h3>
					<ul class="blog-post-info list-inline margin-bottom-0">
						<li>
							<i class="fa fa-clock-o"></i> 
							<span class="font-lato">
							<time class="entry-date" datetime="2016-10-10T22:06:05+00:00"><?=date('F d, Y',strtotime($other_news[0]['published-date']))?></time>
							</span>
						</li>
						<li class="font-lato">
							<i class="fa fa-folder-open-o"></i>
							<a><?=str_replace('Latest','',$other_news[0]['post-category'])?></a>			
						</li>
					</ul>
					<div class="margin-top-20 post-content"><?=trim_text($other_news[0]['post-content'],200)?></div>
					<a href="<?=$post_url?>"><button class="btn btn-red btn-sm noradius margin-top-20"><strong>Read More</strong></button></a>
				</div>
				<div class="col-md-5 col-sm-5">
					<figure>
						<a href="<?=$post_url?>"><img src="<?=$other_news[0]['post-thumbnail']?>" class="img-responsive margin-bottom-10 wp-post-image" alt="<?=$other_news[0]['post-title']?>"></a>
					</figure>
				</div>
			</div>

		</div>
	</div>
	<div id="other-news-container">
		<div class="container">
			<div class="row other-featured-news">
				<?php
					$ctr = 1;
					while($ctr < 4){
						$post_url = home_url('/news/'.$other_news[$ctr]['post-id'].'/'.$other_news[$ctr]['post-name']);
				?>
					<div class="col-md-4 col-sm-4">
						<a href="<?=$post_url?>"><figure style="margin-bottom:10px;border-bottom: 3px solid #ce0505;background-image: url('<?=$other_news[$ctr]['post-thumbnail']?>');background-size: cover;background-repeat: no-repeat;background-position: center; height: 200px;"></figure></a>
						<!-- <figure>
							<a href="<?=$post_url?>"><img src="<?=$other_news[$ctr]['post-thumbnail']?>" class="img-responsive margin-bottom-10 wp-post-image" alt="<?=$other_news[$ctr]['post-title']?>"></a>
						</figure> -->
						<h4 class="margin-bottom-0"><a href="<?=$post_url?>"><?=trim_text($other_news[$ctr]['post-title'],100)?></a></h4>
						<small>
							<i class="fa fa-clock-o"></i> 
							<span class="font-lato">
								<time class="entry-date" datetime="2016-10-10T22:06:05+00:00"><?=date('F d, Y',strtotime($other_news[$ctr]['published-date']))?></time>
							</span>
						</small>
						<div class="margin-top-10"><?=trim_text($other_news[$ctr]['post-content'],100)?></div>
						<a href="<?=$post_url?>"><button class="btn btn-red btn-sm noradius margin-top-10"><strong>Read More</strong></button></a>
					</div>
				<?php
						$ctr++;
					}
				?>
			</div>
		</div>
	</div>
</section>
<?php
	get_footer();
?>