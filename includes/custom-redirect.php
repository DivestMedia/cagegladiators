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
		  		$newrules['fighters/([^/]*)/media-gallery'] = 'index.php?_fn=$matches[1]'; 
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
		  			echo 'yehey';
		  			die();
		  		}else{
			  		return $template;
			  	}
		  	}
		}
	}