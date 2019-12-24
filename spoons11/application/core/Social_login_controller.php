<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'libraries/instagram.class.php';

class Social_login_controller extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
    
	public function init_google()
	{
	    $this->load->library('google');
		return  $this->google->login_url();
	}
		
	public function init_facebook()
	{
	    $this->load->library('facebook_engine');
	    return  $this->facebook_engine->login_url();    
	}

	public function init_instagram()
	{
		$instagram = new Instagram(array(
		    'apiKey'      => 'c0b049fc6f07466caf5197728884e7f8',
		    'apiSecret'   => 'f1d07e78b90247709641a199de1d07ac',
		    'apiCallback' => 'http://localhost/mestar/instagramSuccess' // must point to success.php
		));

		return $instagram->getLoginUrl();
	}
	
	
}
