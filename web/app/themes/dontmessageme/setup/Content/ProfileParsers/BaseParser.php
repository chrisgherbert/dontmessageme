<?php

namespace Content\ProfileParsers;
use Curl\Curl;
use PHPHtmlParser\Dom;

abstract class BaseParser {

	public $url;
	protected $html;

	public function __construct($html, $url){
		$this->html = $html;
		$this->url = $url;
	}

	abstract public function get_name();

	// abstract public function get_location();

	// abstract public function get_photo_url();

	// abstract public function get_gender();

	/////////////
	// Factory //
	/////////////

	public static function get_from_url($url){

		$curl = new Curl;

		$curl->get($url);

		if ($curl->error){
			error_log('Error: ' . $curl->errorCode . ': ' . $curl->errorMessage);
		}
		else {

			$html = $curl->response;

			return new static($html, $url);

		}

	}

}