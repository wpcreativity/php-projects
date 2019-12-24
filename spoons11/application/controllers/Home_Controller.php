<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#require_once APPPATH.'libraries/instagram.class.php';
#require_once APPPATH.'libraries/instagram.config.php';

class Home_Controller extends Social_login_controller {

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -
   *    http://example.com/index.php/welcome/index
   *  - or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see https://codeigniter.com/user_guide/general/urls.html
   */

     public function __construct()
     {
          parent::__construct();

          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->database();
          $this->load->library('form_validation');
          //load the login model
          // $this->load->model('Login_Model');
          // $this->load->model('User_Model');
          // $this->load->model('Public_Model');
          // $this->load->library(array('twconnect'));
          
     }

public function index(){

  $data['facebookAuthUrl'] = $this->init_facebook();
}
  
public function process_facebook_login()
  {
    $this->load->library('facebook');
    // echo "hello";
    
    if($this->facebook->is_authenticated())
    {
      # Get user facebook profile details
      $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
      //          preformatted_data($userProfile);
      # Now since we have the user details, let us proceed to input the details to the database
      
           
      if(!empty($userProfile['email']))
      {
        
        $usr_id = $this->Login_Model->get_user_details($userProfile['first_name'], $userProfile['last_name'], $userProfile['email'],$userProfile['gender'], 'facebook', $userProfile['id']);


        if($usr_id)
        {
          
          $sessionData = array(
              'userEmail'=>$userProfile['email'],
              'userName'=>$userProfile['first_name'] .' ' .$userProfile['last_name'],
              'user_id' => $usr_id,
              'user_pic' => $userProfile['picture']['data']['url'],
              'userLoggedIn' => true,
              'loginVia'=>'social'
          );
          
          $this->session->set_userdata($sessionData);
          
          # Now every thing is set up, its time to reload to my profile page
          
          redirect(base_url('dashboard'));
        }
      }
      
      redirect(base_url());
      
      
    }
    
    redirect(base_url());
  }

/* *************************** End Facebook Login ************************************* */





 

   
}