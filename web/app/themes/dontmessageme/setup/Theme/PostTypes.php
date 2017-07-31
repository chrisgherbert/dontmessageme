<?php
/**
 * This class creates our post types
 */

namespace Theme;

class PostTypes {

	protected $types = array(
		'person',
		'article',
	);

	public function __construct(){
		if ($this->types && !empty($this->types)){
			foreach ($this->types as $type) {
				$this->$type();
			}
		}
	}

	/**
	 * Sample "person" content type - often used as a more full-featured and
	 * flexible replacement for the standard WordPress author functionality.
	 */
	public function person(){

		register_via_cpt_core(
			array(
				'Person', // Singular Name
				'People', // Plural Name
				'person' // Post Type Slug
			),
			array(
				'menu_icon' => 'dashicons-businessman', // Dashicon icon (Reference: https://developer.wordpress.org/resource/dashicons/)
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
				'has_archive' => true
			)
		);

	}

	/**
	 * Sample "article" content type - used in place of the default "post" content type
	 * to allow a custom rewrite base.  This makes it easier to track blog/article traffic
	 * specifically in analytics software.  However, it also can complicate the development
	 * process.  Proceed with caution.
	 */
	public function article(){

		register_via_cpt_core(
			array(
				'Article', // Singular Name
				'Articles', // Plural Name
				'article' // Post Type Slug
			),
			array(
				'menu_icon' => 'dashicons-admin-page', // Dashicon icon (Reference: https://developer.wordpress.org/resource/dashicons/)
				'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
				'taxonomies' => array('category', 'post_tag'),
				'has_archive' => true
			)
		);

	}

}