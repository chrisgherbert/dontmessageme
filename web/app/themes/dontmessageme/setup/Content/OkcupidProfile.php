<?php

namespace Content;
use Content\ProfileParsers\OKCupid;

class OkcupidProfile extends Post {

	public function save_parsed_data(){

		if (!$this->meta('profile_url')){
			return false;
		}

		// Create a parser object
		$parser = OKCupid::get_from_url($this->meta('profile_url'));

		// Set up the data
		$name = $parser->get_name();
		$age = $parser->get_age();
		$gender = $parser->get_gender();
		$orientation = $parser->get_orientation();
		$location = $parser->get_location();

		if ($name){
			$this->update('profile_name', $name);
		}

		if ($age){
			$this->update('profile_age', $age);
		}

		if ($gender){
			$this->update('profile_gender', $gender);
		}

		if ($orientation){
			$this->update('profile_orientation', $orientation);
		}

		if ($location){
			$this->update('profile_location', $location);
		}

	}

}