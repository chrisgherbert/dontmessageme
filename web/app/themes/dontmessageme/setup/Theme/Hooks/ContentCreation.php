<?php

namespace Theme\Hooks;

class ContentCreation {

	public function __construct(){

		add_action('updated_post_meta', array($this, 'get_profile_data'), 10, 4);
		add_action('added_post_meta', array($this, 'get_profile_data'), 10, 4);

	}

	public function get_profile_data($meta_id, $post_id, $meta_key, $meta_value){

		if ($meta_key == 'profile_url'){

			// Get post object
			$post = \Timber::get_post($post_id, \Content\Config::post_type_classes());

			$post->save_parsed_data();

		}

	}

}