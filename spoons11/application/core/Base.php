<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller 
{
    
	public function __construct()
	{
		parent::__construct();

		error_reporting(0);
		//error_reporting(E_ALL);
		
		# Set Public Template
		
		 $this->template->set('template', 'master_template');
		
	
		 $this->template->set('banner', 'layout/slider');
		 $this->template->set('header', 'layout/header');
		 $this->template->set('footer', 'layout/footer');
		 $this->template->set('allmodal', 'layout/all_modal');
		
		
		
		
		# Google & Facebook Login
		
		$result['facebookAuthUrl'] = $this->init_facebook();
		
		$this->template->set('siteData', $result);
		
		
		# Set Admin Template
		if($this->uri->segment(1)=='admin')
		{		    
		    # Load user model
		    $this->load->model('user_model', 'user');
		    
		    $this->template->set('template', 'admin/master_template');
		    $this->template->set('sidebar', 'admin/layout/sidebar');
		    
		}
	}
	
	
	
	private function init_facebook()
	{
	    $this->load->library('facebook_engine');
	    return  $this->facebook_engine->login_url();
	}
	
}
