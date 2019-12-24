<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('vendor/autoload.php');

use Facebook\Facebook as FB;
use Facebook\Authentication\AccessToken;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Helpers\FacebookJavaScriptHelper;
use Facebook\Helpers\FacebookRedirectLoginHelper;

class Facebook_engine
{
    private $fb;
    private $helper;
       
    private $appId;
    private $appSecret;
    
    public function __construct()
    {
        # Load google configuration
        $this->load->config('facebook');
        // Load required libraries and helpers
        $this->load->library('session');
        $this->load->helper('url');
        
        # Check if google development mode is active
        
        if($this->config->item('facebook_development_mode'))
        {
            # This means development mode is active
            
            $this->appId = $this->config->item('facebook_test_app_id');
            $this->appSecret = $this->config->item('facebook_test_app_secret');
        }
        else
        {
            $this->appId = $this->config->item('facebook_live_app_id');
            $this->appSecret = $this->config->item('facebook_live_app_secret');
        }
        
        # Facebook Configuration
        if (!isset($this->fb)){
            $this->fb = new FB([
                    'app_id'                => $this->appId,
                    'app_secret'            => $this->appSecret,
                    'default_graph_version' => $this->config->item('facebook_graph_version')
            ]);
        }
        
        $this->helper = $this->fb->getRedirectLoginHelper();
        
    }
    
    public function login_url()
    {
        // Login type must be web, else return empty string
        if($this->config->item('facebook_login_type') != 'web'){
            return '';
        }
        // Get login url
        return $this->helper->getLoginUrl(base_url() . $this->config->item('facebook_login_redirect_url'), $this->config->item('facebook_permissions'));
    }
    
    public function __get($var){
        return get_instance()->$var;
    }
}