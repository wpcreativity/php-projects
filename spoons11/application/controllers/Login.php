<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		require_once APPPATH.'third_party/src/Google_Client.php';
		require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
	}
	
	public function index()
	{
		$this->load->view('login');
	}
	
	public function google_login()
	{
		$clientId = '139647886751-56ksc7qeip5gcek1bfr3mklgfu1hbab2.apps.googleusercontent.com'; //Google client ID
		$clientSecret = 'moG2xKf6QjKb6XGJ6C4UzSGs'; //Google client secret
		$redirectURL = 'https://www.spoons11.com/g_login';
		
		//Call Google API
		$gClient = new Google_Client();
		$gClient->setApplicationName('Login');
		$gClient->setClientId($clientId);
		$gClient->setClientSecret($clientSecret);
		$gClient->setRedirectUri($redirectURL);
		$google_oauthV2 = new Google_Oauth2Service($gClient);
		
		if(isset($_GET['code']))
		{
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
		}

		if (isset($_SESSION['token'])) 
		{
			$gClient->setAccessToken($_SESSION['token']);
		}
		
		if ($gClient->getAccessToken()) {
			$userProfile = $google_oauthV2->userinfo->get();

			$this->load->model('General_model');
				$this->General_model->google_register($userProfile);
						} 
		else 
		{
			$url = $gClient->createAuthUrl();
			header("Location: $url");
			exit;
		}
	}	
}
