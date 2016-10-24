<?php
	if(!class_exists('CustomRedirect')){
		class CustomRedirect{
			public function __construct(){
				self::custom_redirect_init();
			}

			public function custom_redirect_init(){
				add_filter( 'rewrite_rules_array',[$this,'rewriteRules'] );
				add_filter( 'template_include', [ $this, 'template_include' ],1,1 );
				add_filter( 'query_vars', [ $this, 'prefix_register_query_var' ] );
		    }

		    public function prefix_register_query_var($vars){
				$vars[] = '_fn';
				return $vars;
		    }

		    public function rewriteRules($rules){
		  		$newrules = self::rewrite();
		  		return $newrules + $rules;
		  	}

		  	public function rewrite(){
		  		$newrules = array();
		  		$newrules['fighter/([^/]*)/media-gallery'] = 'index.php?_fn=$matches[1]'; 
		  		return $newrules;
		  	}

		  	public function removeRules($rules){
		  		$newrules = self::rewrite();
		  		foreach ($newrules as $rule => $rewrite) {
		  	        unset($rules[$rule]);
		  	    }
		  		return $rules;
		  	}

		  	public function template_include($template){
		  		$_fn = get_query_var( '_fn' );
		  		if(!empty($_fn)){
		  			$args = array(
					  'name'        => $_fn,
					  'post_type'   => 'fighter',
					  'post_status' => 'publish',
					  'numberposts' => 1
					);
					$media_gallery = [];
					$fighter = get_posts($args);
					if(!empty($fighter[0])){
						$fighter = $fighter[0];
						$fighter_images = get_post_meta( $fighter->ID, '_uf_image', true );
					    if(!empty($fighter_images)){
					        $_t_images = explode(',', $fighter_images);
					        $media_gallery = array_slice($_t_images,3);
					    }
					}
					include_once(get_stylesheet_directory().'/partials/content-fighter-media.php');
		  			die();
		  		}else{
			  		return $template;
			  	}
		  	}
		}
	}