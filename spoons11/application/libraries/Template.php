<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
	private $CI; // To Hold CodeIgniter Instance

	private $data = array();
	
	public function __construct()
	{
		$this->CI = &get_instance();
	}
	
	public function set($key, $value)
	{
		$this->data[$key] = $value;
	}
	
	public function get($key)
	{
		return $this->data[$key];
	}
	
	public function render($view, $data = array(), $default=true)
	{
		$this->data['view'] = $view;
		$this->data['data'] = $data;
				 
		# Adding additional scripts per page
// 		if(!empty($this->script)) { $params['additionalScript'] = $this->script; }
		
		# Adding additional css per page
// 		if(!empty($this->style)) { $params['additionalStyle'] = $this->style; }
// 				preformatted_data($this->data); 
		$this->CI->load->view($this->data['template'], $this->data);
	}
	
	public function js($file){return base_url('web/js/'.$file);}
		
	public function css($file){return base_url('web/css/'.$file);}
		
	public function image($file){return base_url('web/images/'.$file);}
	
	public function upload($image){return base_url('web/uploads/'.$image);}
	
	public function setAdditionalScript(array $script){$this->script = $script;}

	public function setAdditionalStyle(array $style){$this->style = $style;}
	
	public function debug()
	{
		
	}

}

