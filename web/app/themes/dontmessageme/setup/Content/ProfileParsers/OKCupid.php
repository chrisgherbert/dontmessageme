<?php

namespace Content\ProfileParsers;

class OKCupid extends BaseParser {

	public function get_name(){

		// Standard OKCupid profile URLs have the username as the last component
		$components = parse_url($this->url);

		$path = $components['path'];

		$path = trim($path, '/');

		$path_parts = explode('/', $path);

		return end($path_parts);

	}

	public function get_gender(){

		$data = $this->get_profile_data();

		return $data->userinfo->gender ?? false;

	}

	public function get_age(){

		$data = $this->get_profile_data();

		return $data->userinfo->age ?? false;

	}

	public function get_orientation(){

		$data = $this->get_profile_data();

		return $data->userinfo->orientation ?? false;

	}

	////////////////////
	// Location Stuff //
	////////////////////

	public function get_location(){

		$data = $this->get_profile_data();

		$parts = array();

		if ($this->get_neighborhood()){
			$parts[] = $this->get_neighborhood() . ',';
		}

		if ($this->get_city()){
			$parts[] = ' ' . $this->get_city();
		}

		if ($this->get_state()){
			$parts[] = ', ' . $this->get_state();
		}

		if ($this->get_country()){
			$parts[] = ' ' . $this->get_country();
		}

		return implode('', $parts);

	}

	public function get_state(){

		$data = $this->get_profile_data();

		return $data->location->state_code ?? false;

	}

	public function get_country(){

		$data = $this->get_profile_data();

		return $data->location->country_code ?? false;

	}

	public function get_city(){

		$data = $this->get_profile_data();

		$location_string = $data->location->formatted->short ?? false;

		if ($location_string){

			$country = $this->get_country();

			// Location string include the country but not the state (why?). 
			// So we need to remove the country to get the clean state name.
			$state = str_replace(", $country", '', $location_string);

			return $state;

		}

	}

	public function get_neighborhood(){

		$data = $this->get_profile_data();

		return $data->location->formatted->neighborhood ?? false;

	}

	///////////////
	// Protected //
	///////////////

	public function get_profile_data(){

		if (isset($this->profile_json_data)){
			return $this->profile_json_data;
		}

		// There's a JS object that contains pretty much all the profile data, 
		// called ProfilePromo.params. This is just going to look for 
		// anything between that string and the end of the variable 
		// declaration ('};')
		$text = self::get_string_between($this->html, 'ProfilePromo.params = ', '};');

		// Need to add back in the closing curly brace
		$json = $text . '}';

		$json_data = json_decode($json);

		$this->profile_json_data = $json_data->user ?? false;

		return $this->profile_json_data;

	}

	////////////
	// Static //
	////////////

	protected static function get_string_between($string, $start, $end){
		$string = " ".$string;
		$ini = strpos($string,$start);
		if ($ini == 0) return "";
		$ini += strlen($start);   
		$len = strpos($string,$end,$ini) - $ini;
		return substr($string,$ini,$len);
	}

}
