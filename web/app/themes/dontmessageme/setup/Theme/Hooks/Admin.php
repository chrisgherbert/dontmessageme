<?php

namespace Theme\Hooks;

class Admin {

	public function __construct(){

		add_action('admin_head-edit.php', array($this, 'edit_post_change_title_in_list'));

	}

	function edit_post_change_title_in_list() {
		add_filter('the_title', function($title, $id){
			if (get_post_type($id) == 'okcupid-profile') {
				return 'OkCupid Profile';
			}
		}, 100, 2);
	}

}