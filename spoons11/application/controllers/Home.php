<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Base
{


	public function __construct(){
		parent::__construct();
		// $this->template->set('home', true);
		$this->template->set('title', 'Spoons11');
		$this->load->model('General_model');

	}	
	public function login()
	{   
        $email=$this->input->post('login_email');
        $password=$this->input->post('login_password');
        $user_data= $this->db->select('*')->from('tbl_user')->where('email','$email')->get()->result_array();
        /*if($user_data[0]['email']=='$email'){
		$data= array( 'email'=>$email,
			'password'=>$password
		);
        }
        if($user_data[0]['mobile']=='$email'){
		$data= array( 'email'=>$email,
			'password'=>$password
		);
        }*/
        $data= array( 'email'=>$email,
			'password'=>$password
		);
		$this->General_model->login($data);
		
		$this->getTotalWallet();


	}
	public function logout(){
		$this->session->unset_userdata('user_data');
		redirect(base_url());
	}

	// public function restaurant_profile(){

	// 	$this->template->render('pages/restaurant-dashboard');

	// }

	public function profile(){

		// $this->template->render('pages/restaurant-dashboard');

		$this->template->render('pages/dashboard');

		$this->getTotalWallet();

	}

	public function user_profile(){
// echo "hello";
		$this->template->render('pages/user-dashboard');

	}

	public function fb_login(){
		echo "this section under construction";
	}
	

	public function check_username(){

		$username=$this->input->post('r_username');
		$this->General_model->check_user($username);
		
	}

	public function check_r_email(){

		$mail=$this->input->post('r_mail');
		$this->General_model->check_mail($mail);
		
	}

	
	public function user_register(){

		//echo "hello";
		$data= array(
			'type' =>1 , 
			'name' =>$this->input->post('register_name') , 
			'email' =>$this->input->post('register_email') , 
			'mobile' =>$this->input->post('register_phone') , 
			'password' =>$this->input->post('register_password') , 
			'refferal_by' =>$this->input->post('referral_code') , 
			'status' =>1 , 

		);

		// print_r($data);
		$this->General_model->user_register($data);
		
	}

	public function refferal_code(){

		$userdata=$this->session->userdata('user_data');

		$data['reff_data']=$sql = $this->db->select('*')->from('referral_code')->where('u_id',$userdata[0]['id'])->get()->result_array();
		print_r($reff_data);

		$this->template->render('pages/refferal_code',$data);


	}

	public function getTotalWallet(){
	$userdata=$this->session->userdata('user_data');
	$credit_amount= $this->db->select('credit_amount')->from('cashcredit')->where('user_id',$userdata[0]['id'])->where('type','Cr')->get()->result_array();
	foreach ($credit_amount as $key) {$total_credit=$total_credit+$key['credit_amount'];}
	$debit_amount= $this->db->select('credit_amount')->from('cashcredit')->where('user_id',$userdata[0]['id'])->where('type','Dr')->get()->result_array();
	foreach ($debit_amount as $key) {$total_debit=$total_debit+$key['credit_amount'];}
    $total_wallet=$total_credit - $total_debit;
    $this->session->set_userdata('total_wallet',$total_wallet);

	}


}