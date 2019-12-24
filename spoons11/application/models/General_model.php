<?php
Class General_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function restaurant_registration_request($data)
	{
		$this->db->select();
		$this->db->from('restaurant_add_request');
		$this->db->insert('restaurant_add_request',$data);	
	}

	public function restaurant_register($data)
	{
		
		$this->db->select();
		$this->db->from('restaurant');
		$this->db->insert('restaurant',$data);	
	}
	public function final_register($data){

		$this->db->insert('payment',$data);	

	}
	public function check_r_name($r_name){
		$sql = $this->db->select('*')->from('restaurant')->where('r_name',$r_name)->get()->num_rows();
		if($sql>0){
			echo "Restaurant already Avilable";
		}
		else{
			echo "OK";
		}

	}

	public function check_user($username){
		$sql = $this->db->select('*')->from('user')->where('username',$username)->get()->num_rows();
		if($sql>0){
			echo "User	 already Exist";
		}
		else{
		}

	}
	
	public function check_mobile($mobile){
		$sql = $this->db->select('*')->from('user')->where('mobile',$mobile)->where('type', 2)->get()->num_rows();
		if($sql>0){
			//echo "Mobile No already Exist";
		}
		else{
		    echo "Register Your account First";
		}

	}

	public function check_mail($mail){
		$sql = $this->db->select('*')->from('user')->where('email',$mail)->get()->num_rows();;
		if($sql>0){
			echo "Email already Exist";
		}
		else{
		}

	}
	
	public function mailfunction($to, $subject, $message){

		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'kailash@xantatech.com',
			'smtp_pass' => 'kailash@2016',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

        // Set to, from, message, etc.
		$this->email->initialize($config);

		$this->email->from('spoon11@gmail.com', 'Spoon11');
		$this->email->to($to);

		$this->email->subject($subject);
		$this->email->message($message);

		$result=$this->email->send();

		return $result;
	}
	public function login($data){
    $email=$data['email'];
        //$mobile=$data['mobile'];
		$sql = $this->db->select('
            *')
          ->from('user')
          ->where("(user.email = '$email' OR user.mobile = '$email')")
          ->where('password', $data['password'])->get()->num_rows();
		
		if($sql>0){

			$user_data=$sql = $this->db->select('*')->from('user')->where("(user.email = '$email' OR user.mobile = '$email')")->where('password',$data['password'])->get()->result_array();
			$this->session->set_userdata('user_data',$user_data);

			echo "1";
/*		$sql = $this->db->select('*')->from('user')->where('email',$data['email'])->where('password',$data['password'])->get()->num_rows();
		if($sql>0){

			$user_data=$sql = $this->db->select('*')->from('user')->where('email',$data['email'])->where('password',$data['password'])->get()->result_array();
			$this->session->set_userdata('user_data',$user_data);

			echo "1";*/
		}
		


	}

	public function user_register($data){
		$this->db->select();
		$this->db->from('user');
		$this->db->insert('user',$data);
		$last_id=$this->db->insert_id();

		$this->load->helper('string');
		$code=random_string('alnum',3);
		$referral_code= "SP".$code.$last_id;

		$referrel_data1=array(
			'u_id' =>$last_id ,
			'referral_code' =>$referral_code ,
			'u_type' =>1 ,
			'status' =>1 ,
		);

		$this->db->insert('referral_code',$referrel_data1);

			// echo $this->db->last_query();	
		echo "Register successfully";

	}

	public function google_register($userProfile){

		$sql = $this->db->select('*')->from('user')->where('email',$userProfile['email'])->where('name',$userProfile['name'])->get()->num_rows();

		if($sql>0){
			$user_data=$sql = $this->db->select('*')->from('user')->where('email',$userProfile['email'])->get()->result_array();
			$this->session->set_userdata('user_data',$user_data);

			redirect($_SERVER['HTTP_REFERER']);

		}
		else{
			$data= array(
				'type' =>1 , 
				'email' =>$userProfile['email'] , 
				'name' =>$userProfile['name'] , 
				'img_path' =>$userProfile['picture'] , 
			);

		
			$this->db->insert('user',$data);
				$user_data=$sql = $this->db->select('*')->from('user')->where('email',$userProfile['email'])->get()->result_array();
			$this->session->set_userdata('user_data',$user_data);
			
			redirect($_SERVER['HTTP_REFERER']);


		}
		
		echo "Register successfully";

	}

	public function twiter_register($access_token){

		$sql = $this->db->select('*')->from('user')->where('twiter_id',$access_token['user_id'])->get()->num_rows();

		if($sql>0){
			$user_data=$sql = $this->db->select('*')->from('user')->where('twiter_id',$access_token['user_id'])->get()->result_array();
			$this->session->set_userdata('user_data',$user_data);

			redirect($_SERVER['HTTP_REFERER']);

		}
		else{
			$data= array(
				'type' =>1 , 
				'twiter_id' =>$access_token['user_id'] , 
				'name' =>$access_token['screen_name'] , 
			);

			$this->db->insert('user',$data);	
			echo $this->db->last_query();

			$user_data=$sql = $this->db->select('*')->from('user')->where('twiter_id',$access_token['user_id'])->get()->result_array();
			$this->session->set_userdata('user_data',$user_data);

		redirect($_SERVER['HTTP_REFERER']);

		}
		
		echo "Register successfully";

	}

	public function update_password($data){

		$this->db->select();
		$this->db->from('user');
		$this->db->where('id',$data['id']);
		$this->db->update('user',$data['password']);	

	}
	public function add_menu($data,$id){

		$sql = $this->db->select('*')->from('restaurant_item')->where('id',$id)->get()->num_rows();
		if($sql>0){
			$this->db->select();
			$this->db->from('restaurant_item');
			$this->db->where('id',$id);
			$this->db->update('restaurant_item',$data);
			$this->session->set_flashdata('msg', 'Menu Update Successfully');

		}
		else{
			$this->db->select();
			$this->db->from('restaurant_item');
			$this->db->insert('restaurant_item',$data);
			$this->session->set_flashdata('msg', 'Menu added Successfully');
		}

	}

	public function del_menu($id){

		$this->db->select();
		$this->db->where('id',$id);
		$this->db->delete('restaurant_item');
		$this->session->set_flashdata('msg', 'Record Delete Successfully');
		
	}

	public function del_order($id){
		$this->db->select();
		$this->db->where('id',$id);
		$this->db->delete('order_new');
		$this->session->set_flashdata('msg', 'Record Delete Successfully');
		redirect(base_url('order-list'));
	}
	
	public function del_offer($id){
		$this->db->select();
		$this->db->where('id',$id);
		$this->db->delete('restaurant_coupon');
		$this->session->set_flashdata('msg', 'Record Delete Successfully');
		
	}

	public function add_offer($data,$id){

		if(!empty($id)){
			$this->db->select();
			$this->db->from('restaurant_coupon');
			$this->db->where('id',$id);
			$this->db->update('restaurant_coupon',$data);
			$this->session->set_flashdata('msg', 'Record Update Successfully');

		}
		else{

			$this->db->select();
			$this->db->from('restaurant_coupon');
			$this->db->insert('restaurant_coupon',$data);
			$this->session->set_flashdata('msg', 'Record Added Successfully');

		}
		
	}
	public function change_order_status($data,$id){

		
		$this->db->select();
		$this->db->from('order_new');
		$this->db->where('id',$id);
		$this->db->update('order_new',$data);


	}

	public function change_order_status_on_app($data,$order_id){

		
		$this->db->select();
		$this->db->from('order_new');
		$this->db->where('order_no',$order_id);
		$this->db->update('order_new',$data);


	}

	public function change_order_item_on_app($data,$order_id){

		
		$this->db->select();
		$this->db->from('order_new');
		$this->db->where('order_no',$order_id);
		$this->db->update('order_new',$data);


	}

	public function change_budget_status($data,$id){

		echo $id;
		$this->db->select();
		$this->db->from('restaurant');
		$this->db->where('id',$id);
		$this->db->update('restaurant',$data);
		print_r($data);

	}
	public function search_res(){
		
	}

	public function saved_address_addf($data,$id){

		$this->db->select();
		$this->db->from('user_address');
		// $this->db->where('id',$id);
		$this->db->insert('user_address',$data);

	}

	public function delete_address($user_id,$id){

		$this->db->select();
		$this->db->from('user_address');
		$this->db->where('id',$id);
		$this->db->where('user_id',$user_id);
		$this->db->delete('user_address');

	}

	public function update_profile($data,$id){

		$this->db->select();
		$this->db->from('restaurant');
		$this->db->where('id',$id);
		$this->db->update('restaurant',$data);

	}

	public function add_res_profile($data){
		$this->db->select();
		$this->db->from('restaurant');
		$this->db->insert('restaurant',$data);
		$this->session->set_flashdata('msg', 'Record Added Successfully');

		
	}

	public function add_res_cuisine($cuisines,$res_last_id){
		// print_r($cuisines);
		foreach ($cuisines as $key) {

			$data=array(
				'res_id'=>$res_last_id,
				'cuisine_id'=>$key,);

			$this->db->select();
			$this->db->from('restaurant_cuisine');
			$this->db->insert('restaurant_cuisine',$data);
		}
	}

	public function update_res_cuisine($cuisines,$id){
		
		$this->db->select();
		$this->db->from('restaurant_cuisine');
		$this->db->where('res_id',$id);
		$this->db->delete('restaurant_cuisine','');
		foreach ($cuisines as $key) {
			$data=array(
				'res_id'=>$id,
				'cuisine_id'=>$key,
			);
			
			$this->db->insert('restaurant_cuisine',$data);
			
		}

	}

	public function update_time($data,$id){
		$this->db->select();
		$this->db->from('restaurant_time');
		$this->db->where('id',$id);
		$this->db->update('restaurant_time',$data);


	}
	public function add_res_time($res_last_id){
		for ($i=1; $i <8 ; $i++) { 
			$data=array(
				'r_id'=>$res_last_id,
				'day'=>$i,
				'open_time'=>'10:00',
				'close_time'=>'22:00',
			);
			$this->db->select();
			$this->db->from('restaurant_time');
			$this->db->insert('restaurant_time',$data);

			
		}

	}

	public function insert_order($order_data){

		$this->db->select();
		$this->db->from('order_new');
		$this->db->insert('order_new',$order_data);

	}

	public function insert_cart_item($cart_data,$user_id,$restaurant_id,$order_id){

		foreach ($cart_data as $key){

			$condition="id='".$key['id']."' and  restaurant_id='$restaurant_id' and status=1";
			$this->db->select('id,menu_name');
			$this->db->from('restaurant_item');
			$this->db->where($condition);
			$result = $this->db->get()->result_array();
			$menu=$this->db->select('*')->from('menu')->where('id',$result[0]['menu_name'])->where('status',1)->get()->result_array();
			$data=array(
				'user_id' =>$user_id , 
				'order_id' =>$order_id , 
				'restaurant_id' =>$restaurant_id , 
				'menu_name' =>$menu[0]['menu_name'], 
				'price' =>$key['subtotal'], 
				'qty' =>$key['qty'], 
				'status' =>1,);
			$this->db->select();
			$this->db->from('order_itmes');
			$this->db->insert('order_itmes',$data);
		}


	}

	public function update_payment($order_id){
		$data= array('payment_status' =>1);

		$this->db->select('*');
		$this->db->from('order_new');
		$this->db->where('order_no',$order_id);
		$this->db->update('order_new',$data);





	}

	public function update_payment_mebership($data){

		$data1= array('payment_status' =>1 ,'status'=>1 );
		//$this->db->select();
		$this->db->from('payment');
		$this->db->where('restaurant_id',$data['restaurant_id']);
		$this->db->where('package_id',$data['package_id']);

		$this->db->update('payment',$data1);

		$package_detail=$sql = $this->db->select('*')->from('restaurant_membership')->where('id',$data['package_id'])->where('status',1) ->get()->result_array();
// print_r($package_detail);
		
		$user_package_data= array(
			'start_package_date' =>date('y/m/d') ,
			'end_package_date' => date('y/m/d', strtotime(' + 30 days')),
		);

		$this->db->from('user');
		$this->db->where('id',$data['user_id']);

		$this->db->update('user',$user_package_data);


	}

	public function wallet_trans($data){

		$this->db->insert('cashcredit',$data);

	}
	
	public function get_wallet($user_id){
		$credit_amount= $this->db->select('*')->from('cashcredit')->where('user_id',$user_id)->get()->result_array();
		if($credit_amount){
			$credit_amt=0;
			$debit_amt=0;
			foreach ($credit_amount as $key) {

				if($key['type']=='Cr'){ 

				  $credit_amt= $credit_amt + $key['credit_amount'];

				}else if($key['type']=='Dr'){

				  $debit_amt=$debit_amt+ $key['credit_amount'];

				}

			}
			$total_wallet=$credit_amt-$debit_amt;

		} else{
			$total_wallet=0;
		}
		
		return ($total_wallet <= 0)?0:$total_wallet;
		
	}




}