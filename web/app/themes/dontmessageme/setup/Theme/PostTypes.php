<?php
/**
 * This class creates our post types
 */

namespace Theme;

class PostTypes {

	protected $types = array(
		'okcupid_profile',
		'match_profile',
		'pof_profile',
	);

	public function __construct(){
		if ($this->types && !empty($this->types)){
			foreach ($this->types as $type) {
				$this->$type();
			}
		}
	}

	public function okcupid_profile(){

		register_via_cpt_core(
			array(
				'OKCupid Profile',
				'OKCupid Profiles',
				'okcupid-profile'
			),
			array(
				'supports' => false,
				'has_archive' => false,
				'public' => false
			)
		);

	}

	public function match_profile(){

		register_via_cpt_core(
			array(
				'Match.com Profile',
				'Match.com Profiles',
				'match-profile'
			),
			array(
				'supports' => false,
				'has_archive' => false,
				'public' => false
			)
		);

	}

	public function pof_profile(){

		register_via_cpt_core(
			array(
				'Plenty of Fish Profile',
				'Plenty of Fish Profiles',
				'pof-profile'
			),
			array(
				'supports' => false,
				'has_archive' => false,
				'public' => false
			)
		);

	}

}