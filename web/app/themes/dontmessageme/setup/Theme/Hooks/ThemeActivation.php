<?php

namespace Theme\Hooks;

class ThemeActivation {

	public function __construct(){
		add_action('after_switch_theme', array($this, 'create_custom_db_tables'));
	}

	/**
	 * Create table for the geocoded coords for profiles.  This is 
	 * probably needed in case we want to location profiles within a 
	 * certain radius.
	 */
	public function create_custom_db_tables(){

		global $wpdb;

		$table = $wpdb->prefix . 'geocoded_profiles';

		$query = "CREATE TABLE IF NOT EXISTS `$table` (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		  `profile_id` bigint(20) DEFAULT NULL,
		  `lat` varchar(255) DEFAULT '',
		  `lng` varchar(255) DEFAULT '',
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

		$wpdb->query($query);

	}

}
