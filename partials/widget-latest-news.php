<?php
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL,site_url('/news'));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"action=getnews&page=1&cat=all-news");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$news = curl_exec ($ch);

	curl_close ($ch);
	if(!empty($news))
		$news = json_decode($news);

?>

<div id="widget-latest-news">
	<?php
		if(!empty($news)){
			foreach ($news as $n) {
				$post_url = home_url('/news/'.$n->{'post-id'}.'/'.$n->{'post-name'});
	?>
			<div class="row tab-post"><!-- post -->
				<div class="col-md-3">
					<a href="<?=$post_url?>">
						<img src="<?=$n->{'post-thumbnail'}?>" class="img-responsive">
					</a>
				</div>
				<div class="col-md-9">
					<a href="<?=$post_url?>" class="tab-post-link"><?=trim_text($n->{'post-title'},70)?></a>
					<small><?=$n->{'published-date'}?></small>
				</div>
			</div>
	<?php
			}
		}
	?>

</div>