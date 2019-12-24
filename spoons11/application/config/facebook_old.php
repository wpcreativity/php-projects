<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// $config['appID']	= '770903773110037';


// $config['appSecret']	= '1c0b935f8f8d812adc50b8d2e74a78fa';

$config['facebook_app_id']              = '770903773110037';
$config['facebook_app_secret']          = '1c0b935f8f8d812adc50b8d2e74a78fa';
$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  = 'welcome/web_login';
$config['facebook_logout_redirect_url'] = 'welcome/logout';
$config['facebook_permissions']         = array('public_profile', 'publish_actions', 'email');
$config['facebook_graph_version']       = 'v2.6';
$config['facebook_auth_on_load']        = TRUE;