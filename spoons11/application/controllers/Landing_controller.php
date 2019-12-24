<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
$today_day=date('w') + 1;
date_default_timezone_set('Asia/Calcutta');
$current_time= date('H:i');

	class Landing_controller extends Base
	{
		public function __construct(){
			parent::__construct();
			$this->template->set('home', true);
			$this->template->set('title', 'Spoons11');
			$this->load->library('simpleimage');
			$this->load->model('General_model');
			$this->load->model('Pagination_model');
			$this->load->library('cart');
			$this->load->library('pagination');
			

		}	
		public function index(){
			$data = array();
	# Set home as true

			$data['meta_tags']= $this->db->select('meta_tags')->from('content')->where('id',1)->where('status',1)->get()->result_array();
			// print_r($data);

			$data['banner']= $this->db->select('*')->from('banner')->where('status',1)->get()->result_array();


			$this->template->render('pages/home', $data);
		}


		public function slug($slug){
			$newurl=str_replace(" - "," ",$slug);
			$newurl=str_replace("&","",$newurl);
			$newurl=str_replace(","," ",$newurl);
			$myurl=str_replace("--","-",str_replace("%","",str_replace(" ","-",str_replace("-"," ",trim(str_replace("/"," ",str_replace(".","",$newurl)))))));
			return $myurl=strtolower($myurl);
		}
		public function restaurant_registration_request(){

			$this->session->sess_destroy();

			$data['meta_tags']= $this->db->select('meta_tags')->from('content')->where('id',5)->where('status',1)->get()->result_array();

			$data['country'] = $this->db->select('*')->from('country')->where('status',1)->get()->result_array();
			$data['cuisine'] = $this->db->select('*')->from('cuisine')->where('status',1)->get()->result_array();


			$this->template->render('pages/restaurant-registration-request',$data);

		}

		public function get_state(){
			$country_id = $this->input->post('country_id');
			$state_id = $this->input->post('state_id');
			$data['state']=$sql = $this->db->select('*')->from('state')->where('country_id',$country_id)->where('status',1)->get()->result_array();
			$state ='<select class="required form-control" id="state_id"  name="state">';
			$state.='<option>State</option>';
			foreach ($data['state'] as $cont) {	

				$res=($cont['id']==$state_id)?'selected':'';	


				$state.='<option value= " '.$cont['id'].'" '.$res.'  > '.$cont['state'].' </option>';	
			} 
			$state.='</select>';
			echo $state;
			exit();
		}
		
/*
*----------------------------------------------------------------------------------------------------
*/
		
		public function prime_membership_plan(){
		    
		    $data['prime_plan']= $sql1 = $this->db->select('*')->from('prime_membership_plan')->where('plan_status',1)->get()->result_array();
		    
		  //  if(!empty($data['prime_plan'])){
		  //   $minprice =  $data['prime_plan'][0]['plan_price']; 
		  //   $data['prime_price'] = '<li><a class="primeDelivery" href="'.base_url('prime-membership-plan') .'">Join Prime Delivery for ₹ '.$minprice.' / Month</a></li>';
		  //  } else {
		  //   $data['prime_price'] = '';   
		  //  }
		   //$data['prime_price'] = '<li><a class="primeDelivery" href="'.base_url('prime-membership-plan') .'">Join Prime Delivery for ₹ '.$minprice.' / Month</a></li>';
		    
		   //$data_heading = $data['prime_plan'][0]['plan_price'];
		    
		   	$this->template->render('pages/prime-membership-plan', $data);
		}
	
/*
*---------------------------------------------------------------------------------------------------
*/

		public function get_state2(){
			$country_id = $this->input->post('country_id');
			$state_id = $this->input->post('state_id');
			$data['state']=$sql = $this->db->select('*')->from('state')->where('country_id',$country_id)->where('status',1)->get()->result_array();
			$state ='<select class="required form-control state_val" id="state_id"  onchange="testt()" name="state">';
			$state.='<option>State</option>';
			foreach ($data['state'] as $cont) {	

				$res=($cont['id']==$state_id)?'selected':'';	


				$state.='<option value= " '.$cont['id'].'" '.$res.'  > '.$cont['state'].' </option>';	
			} 
			$state.='</select>';
			echo $state;
			exit();
		}

		public function get_city(){
			$state_id = $this->input->post('state_id');
			$city_id = $this->input->post('city_id');
			$data['city']=$sql = $this->db->select('*')->from('city')->where('state_id',$state_id)->where('status',1)->get()->result_array();
	        // print_r($data);
			$city ='<select class="required form-control"  name="city">';
			$city.='<option>City</option>';
			foreach ($data['city'] as $cont) {	

				$res=($cont['id']==$city_id)?'selected':'';

				$city.='<option value= " '.$cont['id'].'" '.$res.'> '.$cont['city'].' </option>';	
			} 
			$city.='</select>';
			echo $city;
			exit();
		}

	public function restaurant_registration_request_add(){
          /*echo'<pre>'; 
          print_r($_POST);
          
          exit();*/
       $this->load->library('form_validation'); 
   	   $this->load->helper('date'); 
       $this->form_validation->set_rules('r_name', 'Restaurant Name', 'required|trim');  
       $this->form_validation->set_rules('r_phone', 'Phone', 'required|trim');
       $this->form_validation->set_rules('manager_name', 'Manager Name', 'required|trim');  
       $this->form_validation->set_rules('manager_number', 'Manager Phone', 'required|trim'); 
       $this->form_validation->set_rules('r_email', 'Email Address', 'required|trim');
       $this->form_validation->set_rules('cuisine[]', 'Cuisine', 'required|trim');
       $this->form_validation->set_rules('r_location', 'Account Number', 'required|trim');
       $this->form_validation->set_rules('r_address', 'Location', 'required|trim');
       $this->form_validation->set_rules('r_lat', 'Coordinates', 'required|trim');
       $this->form_validation->set_rules('r_long', 'Coordinates', 'required|trim');
       $this->form_validation->set_rules('r_desc', 'Discription', 'required|trim');
       $this->form_validation->set_rules('open_time', 'Opening Time', 'required|trim');  
       $this->form_validation->set_rules('close_time', 'Closing Time', 'required|trim');
       $this->form_validation->set_rules('min_order', 'Minimum order', 'required|trim');  
       $this->form_validation->set_rules('delivery_time', 'Delivery Time', 'required|trim');
       $this->form_validation->set_rules('offer', 'Offer', 'required|trim');
       $this->form_validation->set_rules('for_two', 'For two', 'required|trim');
       $phone=$this->input->post('manager_number');
       $vender = $this->db->select('*')->from('tbl_user')->where('mobile',$phone)->where('type',2)->get()->result_array();
       //echo $this->db->last_query();die;
		//echo $vender[0]['mobile'];die;
       if($this->form_validation->run()){
           //echo "hii";die;
			$cuisine=implode(',', $this->input->post('cuisine[]'));
			$rname = $this->input->post('r_name');
			$slug = $this->slug($rname);
			$img=time().$_FILES['r_image']['name'];
			//$img=$_FILES['r_image']['name'];
			
			$data = array(
			    'user_id' => $vender[0]['id'],
				'r_name' =>$this->input->post('r_name') ,
				'slug' =>$slug, 
				'r_phone' =>$this->input->post('r_phone') , 
				'm_name' =>$this->input->post('manager_name') , 
				'm_contact' =>$this->input->post('manager_number') , 
				'owner_name' =>$this->input->post('owner_name') , 
				'owner_phone' =>$this->input->post('owner_number') , 
				'email' =>$this->input->post('r_email') ,
				'r_address' =>$this->input->post('r_address') ,
				'r_website' =>$this->input->post('web') , 
				'img' =>$img , 
				'pdesc' =>$this->input->post('r_desc') , 
				'book_table' =>$this->input->post('book_table') , 
				'no_of_table' =>$this->input->post('no_of_table') , 
				'min_order' =>$this->input->post('min_order') , 
				'delivery_time' =>$this->input->post('delivery_time') , 
				'offer' =>$this->input->post('offer') ,
				'for_two' =>$this->input->post('for_two') ,
				'lat' =>$this->input->post('r_lat') ,
				'lang' =>$this->input->post('r_long') ,
			);
			if(!empty($vender[0]['mobile'])){
			    //echo "success";die;
			    $this->db->insert('restaurant',$data);
			    //echo $this->db->last_query();
			    $r_id=$this->db->insert_id();
    			$this->session->set_userdata('restaurant_id',$r_id);	
    			$this->session->set_flashdata('sms',"Your Registration Successfully");
    			redirect(base_url('restaurant-registration-request'));	
			}
			else{
			    $this->session->set_flashdata('error',"You have to register your account first");
			    redirect(base_url('restaurant-registration-request'));
			}
			
			//echo'<pre>';
			//print_r($data);
            //exit('This Section is under maintenance..');
            
			$to 	 = $this->input->post('r_email');
			$subject = "Restaurant Registration Request";
			$message  = '<html><body>';
			$message .= '<h2 style="color:#000;font-size:14px;">Dear user</h2>';
			$message .= '<p style="color:#000;font-size:14px;">Your Request has Successfully Submited</p>';
			$message .= '<p style="color:#000;font-size:14px;">Please wait for confirmation  mail</p>';
			$message .= '<p style="color:#000000;font-size:14px;">Thanks and Regards</p>';
			$message .= '<p style="color:#000;font-size:14px; font-weight:400;">Spoon11</p>';
			$message .= '</body></html>';

			$this->General_model->mailfunction($to, $subject, $message);

			$getdata = $this->input->post();
// 			$this->General_model->restaurant_registration_request($data);
// 			$this->session->set_flashdata('msg',"Your Registration Successfully");
// 			redirect(base_url('restaurant-registration-request'));

} else {
    $this->session->set_flashdata('error', validation_errors());  
    redirect(base_url('restaurant-registration-request'));
}

		}

		public function check_r_name(){
			$r_name=$this->input->post('r_name');

			$this->General_model->check_r_name($r_name);
		}

		public function check_user(){
			$username=$this->input->post('username');

			$this->General_model->check_user($username);
		}
        
        public function check_mobile(){
			$mobile=$this->input->post('mobile');

			$this->General_model->check_mobile($mobile);
		}
        
		public function restaurant_registration()
		{
			$id=base64_decode($this->input->get('id'));

			if(!empty($id)){

				$data['user_data']=$sql = $this->db->select('*')->from('tbl_restaurant_add_request')->where('id',$id)->get()->result_array();
				$this->template->render('pages/register-restaurant',$data);
			}
			else{
				$this->session->set_flashdata('msg',"You must have be register first/ check your confirmation mail");
				redirect(base_url('restaurant-registration-request'));
			}

		}

		public function restaurant_registration_add(){

			$user_data=array(
				'type' =>2 ,
				'name' =>$this->input->post('m_name') ,
				'email' =>$this->input->post('email') ,
				'mobile' =>$this->input->post('m_contact') ,
				'username' =>$this->input->post('username') , 
				'password' =>$this->input->post('password') , 
				'status' =>0 , 
			);

			$this->session->set_userdata('vender_user',$user_data);
			$this->db->select();
			$this->db->from('user');
			$this->db->insert('user',$user_data);
			$last_id=$this->db->insert_id();
			$this->session->set_userdata('last_id',$last_id);
			$data = array(
				'user_id' =>$last_id , 
				'r_name' =>$this->input->post('r_name') , 
				'r_phone' =>$this->input->post('r_phone') , 
				'm_name	' =>$this->input->post('m_name') , 
				'm_contact' =>$this->input->post('m_contact') , 
				'email' =>$this->input->post('email') , 
				'r_address' =>$this->input->post('address') , 
				'lat' =>$this->input->post('lat') , 
				'lang' =>$this->input->post('lng') , 
				'status' =>0 , 
			);

			$this->session->set_userdata('vender_address',$data);


			$this->db->select();
			$this->db->from('restaurant');
			$this->db->insert('restaurant',$data);
			$r_id=$this->db->insert_id();
			$this->session->set_userdata('restaurant_id',$r_id);	
			$this->session->set_flashdata('msg',"Your Registration Successfully");
			redirect(base_url('register-restaurant-package'));	

		}


		public function register_restaurant_package()
		{

			if(!empty($this->session->userdata('last_id'))){

				$this->template->render('pages/register-restaurant-package');
			}
			else{
				$this->session->set_flashdata('msg',"You must have be register first/ check your confirmation mail");
				redirect(base_url('restaurant-registration-request'));
			}


		}

		public function register_restaurant_payment()
		{

			$this->template->render('pages/register-restaurant-payment');

		}

		public function checkout()
		{

			$id=$this->input->post('package');
			if(!empty($id)){
				$this->session->set_userdata('package_id',$id);
				$this->template->render('pages/checkout');

			}
			else{
				$this->session->set_flashdata('msg',"You must have be register first/ check your confirmation mail");
				redirect(base_url('restaurant-registration-request'));
			}
		}
		public function coupon_price(){

			$package=$sql = $this->db->select('*')->from('tbl_restaurant_membership')->where('status',1)->where('id',$this->session->userdata('package_id'))->get()->result_array();

			$tax=$sql = $this->db->select('*')->from('tbl_setting')->where('status',1)->get()->result_array();
			$tax[0]['tax'];
			$total_tax= ($package[0]['price']/100)*$tax[0]['tax'];
			$total=$total_tax+$package[0]['price'];

			$coupon_code=$this->input->post('couponcode');
			$coupon=$sql = $this->db->select('*')->from('tbl_coupon')->where('coupon_code',$coupon_code)->where('status',1)->get()->result_array();
			if($coupon[0]['discount_type']=='Direct'){
				$total=$total-$coupon[0]['discount'];
			}
			elseif($coupon[0]['discount_type']=='Percent'){
				$percent=($total/100)*$coupon[0]['discount'];
				$total=$total-$percent;
			}
			else{
				$msg="Invalid Coupon";
				$table='<span style="color:red">'.$msg.'</span>';
			}

			echo $table.='<table class="shop_table">
			<thead>
			<tr>
			<th class="product-name">Product</th>
			<th class="product-total">Total</th>
			</tr>
			</thead>
			<tbody>
			<tr class="cart_item">
			<th class="product-name">'.$package[0]['name'].'</th>
			<td class="product-total">$'.$package[0]['price'].'</td>
			</tr>
			</tbody>
			<tfoot>
			<tr class="cart-subtotal">
			<th class="product-name">Subtotal</th>
			<td class="product-total">$'.$package[0]['price'].'</td>
			</tr>
			<tr class="tax-rate tax-rate-gov-tax-1">
			<th class="product-name">Gov Tax</th>
			<td class="product-total">$'.$total_tax.'</td>
			</tr>
			<tr class="order-total">
			<th class="product-name">Total</th>
			<td class="product-total">$'.$total.'</td>
			</tr>
			</tfoot>
			</table>';

		}

		public function thanks_activation(){

			$data=array(
				'user_id' =>$this->input->post('user_id') , 
				'restaurant_id' =>$this->input->post('restaurant_id') , 
				'payment_mode' =>$this->input->post('payment_mode') , 
				'package_id' => $this->session->userdata('package_id'),
				'total' =>$this->input->post('total') , 
			);
			if (!empty($this->input->post('total'))) {
				$this->session->set_userdata('total_mebership_amount',$this->input->post('total'));
				$this->session->set_userdata('payment_data',$data);
			}
			$user= $this->db->select('*')->from('tbl_user')->where('id',$data['user_id'])->get()->result_array();
			if (!empty($data['user_id'])) {
				$this->General_model->final_register($data);
				}

				$to 	 = $user[0]['email'];
				$subject = "Restaurant Registration Done";
				$message  = '<html><body>';
				$message .= '<h2 style="color:#000;font-size:14px;">Dear  ' .$user[0]['name'].'</h2>';
				$message .= '<p style="color:#000;font-size:14px;">Your Registration Successfully Done</p>';
				$message .= '<p style="color:#000;font-size:14px;">Your Login Detail</p>';
				$message .= '<p style="color:#000;font-size:14px;"><b>Username:</b>  '.$user[0]['username'].'</p>';
				$message .= '<p style="color:#000;font-size:14px;"><b>Password:</b>  '.$user[0]['password'].'</p>';
				$message .= '<p style="color:#000000;font-size:14px;">Thanks and Regards</p>';
				$message .= '<p style="color:#000;font-size:14px; font-weight:400;">Spoon11</p>';
				$message .= '</body></html>';

				if($data['payment_mode']=='cod'){
					$this->General_model->mailfunction($to, $subject, $message);
					$this->template->render('pages/thanks-activation');
				}
				elseif($data['payment_mode']=='payumoney' || $data['payment_mode']==''){
					$data['total']=$data['total'];
					$this->General_model->mailfunction($to, $subject, $message);
					$this->load->view('pages/payumoney_form',$data);
				}


			}


			public function payu_res_success(){

				$this->template->render('pages/thanks-activation');
			}
			public function order_list(){

				$this->template->render('pages/restaurant_order_list');

			}

			public function restaurant_menu(){

				$this->template->render('pages/restaurant_menu_list');

			}
			public function restaurant_offer(){

				$this->template->render('pages/restaurant_offer_list');

			}





			public function dashboard(){
				$this->template->render('pages/dashboard');

			}
			public function user_order(){	
				$user=$this->session->userdata('user_data');
				$data['order']=$this->db->select('*')->from('order_new')->where('user_id',$user[0]['id'])->order_by('id',desc)->get()->result_array();


				$this->template->render('pages/user_order',$data);
			}
			public function saved_address(){

				$data1=$this->session->userdata('user_data');
	// echo $data[0]['id'];

				$data['user_address']=$this->db->select('*')->from('user_address')->where('user_id',$data1[0]['id'])->get()->result_array();

				$this->template->render('pages/user_saved_address',$data);

			}
			public function user_payment(){

				$this->template->render('pages/user_payment');

			}
			public function offers_and_coupon(){

				$data['coupon']=$sql = $this->db->select('*')->from('restaurant_coupon')->where('status',1)->get()->result_array();
	// print_r($data);

				$this->template->render('pages/offers_and_coupon',$data);

			}
			public function change_password(){

				$this->template->render('pages/change_password');

			}

			public function update_password(){
				$data=array(
					'password'=>$this->input->post('password'),
				);
				$this->db->select();
				$this->db->from('user');
				$this->db->where('id',$this->input->post('id'));
				$this->db->update('user',$data);	

				echo "Password Changed";
			}

			public function update_mobile(){
				$data=array(
					'mobile'=>$this->input->post('mobile'),
				);
				$this->db->select();
				$this->db->from('user');
				$this->db->where('id',$this->input->post('id'));
				$this->db->update('user',$data);	
				echo "Changed";
			}
			public function restaurant_menu_addf(){

				$data['menu']=$sql = $this->db->select('*')->from('menu')->where('status',1)->get()->result_array();
				$data['category']=$sql = $this->db->select('*')->from('category')->where('status',1)->get()->result_array();

				$data['cuisine']=$sql = $this->db->select('*')->from('cuisine')->where('status',1)->get()->result_array();

				if(!empty($this->input->get('id'))){
					$id=$this->input->get('id');

					$data['r_data']=$sql = $this->db->select('*')->from('restaurant_item')->where('id',$id)->where('status',1)->get()->result_array();

				}
				$this->template->render('pages/restaurant_menu_addf.php',$data);


			}
			public function add_menu_addf(){
				$i=$_FILES['image']['name'];
				$img=time().$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],"upload_images/cuisine/".$img);
				copy("upload_images/cuisine/".$img,"upload_images/cuisine/thumb/".$img);
				$this->simpleimage->load("upload_images/cuisine/thumb/".$img);
				$this->simpleimage->resize(274,274);
				$this->simpleimage->save("upload_images/cuisine/thumb/".$img);

				copy("upload_images/cuisine/".$img,"upload_images/cuisine/tiny/".$img);
				$this->simpleimage->load("upload_images/cuisine/tiny/".$img);
				$this->simpleimage->resize(500,300);
				$this->simpleimage->save("upload_images/cuisine/tiny/".$img);

				$r_data[0]['id']='';

				$session_data=$this->session->userdata('user_data');

				$r_data=$sql = $this->db->select('*')->from('restaurant')->where('user_id',$session_data[0]['id'])->get()->result_array();

				$id=$this->input->post('item_id');
				if (!empty($i)) {

					if(!empty($id)){

						$data= array(
							'restaurant_id' =>$this->input->post('id'),
							'menu_name' =>$this->input->post('menu_id') ,
							'menu_price' =>$this->input->post('mrp') ,
							'actual_price' =>$this->input->post('mrp2') ,
							'cuisine_id' =>$this->input->post('cuisine_id') ,
							'cat_id' =>$this->input->post('category_id') ,
							'sub_cat_id' =>$this->input->post('sub_cat_id') ,
							'menu_type' =>$this->input->post('type') ,
							'm_discription' =>$this->input->post('discription') ,
							'popular_dish' =>$this->input->post('dish') ,
							'spicy_dish' =>$this->input->post('spicy') ,
							'img'=>$img,
							'status' =>1 ,
						);

					}else{

						$data= array(
							'restaurant_id' =>$this->input->post('id'),
							'menu_name' =>$this->input->post('menu_id') ,
							'menu_price' =>$this->input->post('mrp') ,
							'actual_price' =>$this->input->post('mrp2') ,
							'cuisine_id' =>$this->input->post('cuisine_id') ,
							'cat_id' =>$this->input->post('category_id') ,
							'sub_cat_id' =>$this->input->post('sub_cat_id') ,
							'menu_type' =>$this->input->post('type') ,
							'm_discription' =>$this->input->post('discription') ,
							'popular_dish' =>$this->input->post('dish') ,
							'spicy_dish' =>$this->input->post('spicy') ,
							'img'=>$img,
							'status' =>1 ,
						);
					}
				}else{

					if(!empty($id)){

						$data= array(
							'restaurant_id' =>$this->input->post('id'),
							'menu_name' =>$this->input->post('menu_id') ,
							'menu_price' =>$this->input->post('mrp') ,
							'actual_price' =>$this->input->post('mrp2') ,
							'cuisine_id' =>$this->input->post('cuisine_id') ,
							'cat_id' =>$this->input->post('category_id') ,
							'sub_cat_id' =>$this->input->post('sub_cat_id') ,
							'menu_type' =>$this->input->post('type') ,
							'm_discription' =>$this->input->post('discription') ,
							'popular_dish' =>$this->input->post('dish') ,
							'spicy_dish' =>$this->input->post('spicy') ,
							'status' =>1 ,
						);

					}else{

						$data= array(
							'restaurant_id' =>$this->input->post('id'),
							'menu_name' =>$this->input->post('menu_id') ,
							'menu_price' =>$this->input->post('mrp') ,
							'actual_price' =>$this->input->post('mrp2') ,
							'cuisine_id' =>$this->input->post('cuisine_id') ,
							'cat_id' =>$this->input->post('category_id') ,
							'sub_cat_id' =>$this->input->post('sub_cat_id') ,
							'menu_type' =>$this->input->post('type') ,
							'm_discription' =>$this->input->post('discription') ,
							'popular_dish' =>$this->input->post('dish') ,
							'spicy_dish' =>$this->input->post('spicy') ,
							'status' =>1 ,
						);
					}

				}


				$this->General_model->add_menu($data,$id);
					redirect(base_url('restaurant-menu').'?r_id='.$this->input->post('id'));
			}
			public function restaurant_menu_del(){

				$id=$this->input->get('id');

				$this->General_model->del_menu($id);
						
				redirect(base_url('restaurant-menu').'?r_id='.$this->input->get('r_id'));

			}

			public function restaurant_order_del(){

				$id=$this->input->get('id');

				$this->General_model->del_order($id);

			}

			public function offer_add(){

				if(!empty($this->input->get('id'))){
					$id=$this->input->get('id');

					$data['offer_data']=$sql = $this->db->select('*')->from('restaurant_coupon')->where('id',$id)->where('status',1)->get()->result_array();


				}

				$this->template->render('pages/restaurant_offer_addf.php',$data);

			}

			public function restaurant_offer_del(){

				$id=$this->input->get('id');

				$this->General_model->del_offer($id);

				redirect(base_url('restaurant-offer').'?id='.$this->input->get('r_id'));
			}

			function generateCouponCode() {
				$chars = "ABCDEFGHJKLMNOPQRSRTUVWXYZ123456789";
				srand((double)microtime()*1000000);
				$i = 0;
				$randno = '' ;

				while ($i < 6) {
					$num = rand() % 33;
					$tmp = substr($chars, $num, 1);
					$randno = $randno . $tmp;
					$i++;
				}
				return strtoupper($randno);
			}

			public function restaurant_offer_add(){

				$id=$this->input->post('id');

	// exit();

				$date = new DateTime("now");

				$curr_date = $date->format('Y-m-d');

				$session_data=$this->session->userdata('user_data');

				$r_data=$sql = $this->db->select('*')->from('restaurant')->where('user_id',$session_data[0]['id'])->get()->result_array();

				$data= array(
					'r_id' =>$r_data[0]['id'],
					'valid_for' =>$this->input->post('valid_for') ,
					'discount_type' =>$this->input->post('discount_type') ,
					'discount' =>$this->input->post('discount') ,
					'minimum_purchase' =>$this->input->post('minimum_purchase') ,
					'expire_date' =>$this->input->post('expire_date') ,
					'coupon_code'=>$this->generateCouponCode(),	
					'generate_date'=>$curr_date ,		
					'status' =>1 ,
				);

				$this->General_model->add_offer($data,$id);

				redirect(base_url('restaurant-offer').'?id='.$r_data[0]['id']);
			}

			public function change_order_status(){
				$id=$this->input->post('id');
				$data=array(
					'order_status'=>$this->input->post('order_status'),
				);

				if ($data['order_status']==3) {
					$order=$this->db->select('*')->from('order_new')->where('id',$id)->where('payment_method !=','cod')->get()->result_array();
	// print_r($order);
					$add_money_wallet=array(
						'user_id' =>$order[0]['user_id'] , 
						'credit_amount' =>$order[0]['total_amount'], 
						'type' =>'Cr', 
						'status' =>1, 
					);

					$this->db->insert('cashcredit',$add_money_wallet);
				}
				$this->General_model->change_order_status($data,$id);

			}

			public function change_budget_status(){

				$id=$this->input->post('id');
				$data=array(
					'budget'=>$this->input->post('budget_status'),
				);

				$this->General_model->change_budget_status($data,$id);
			}



			public function forget_password(){

				$to= $this->input->post('reset_email');
				$sql = $this->db->select('*')->from('user')->where('email',$to)->get()->num_rows();

				if($sql>0){

					$user_data=$sql = $this->db->select('*')->from('user')->where('email',$to)->get()->result_array();
					$subject = "Password Reset";
					$message  = '<html><body>';
					$message .= '<h2 style="color:#000;font-size:14px;">Dear '.$user_data[0]['name'].'</h2>';
					$message .= '<p style="color:#000;font-size:14px;">Click on below link to reset  Password </p>';
					$message .= '<p style="color:#000000;font-size:14px;">'.base_url('reset-password').'?id='.base64_encode($user_data[0]['id']).'</p>';
					$message .= '<p style="color:#000;font-size:14px; font-weight:400;">Spoon11</p>';
					$message .= '</body></html>';

					$this->General_model->mailfunction($to, $subject, $message);
					echo "your password reset link sent on your mail ";

				} else{

					echo "Email not valid / Register";

				}



			}
			public function reset_password(){
				$id=base64_decode($this->input->get('id'));

				$user_data['data']=$sql = $this->db->select('*')->from('user')->where('id',$id)->get()->result_array();
				$this->template->render('pages/reset_password',$user_data);
			}

			public function about_us(){

				$data['meta_tags']= $this->db->select('meta_tags')->from('content')->where('id',2)->where('status',1)->get()->result_array();
				// print_r($data);

				$id = 2;
				$data['pagedata'] = $this->db->select('*')->from('tbl_content')->where(array('id' =>$id,'status'=>1))->get()->result_array();

				//print_r($data);

				$this->template->render('pages/about-us',$data);
			}

			public function our_team(){

				$data['meta_tags']= $this->db->select('meta_tags')->from('content')->where('id',3)->where('status',1)->get()->result_array();

				$id = 3;
				$data['page'] = $this->db->select('*')->from('tbl_content')->where('id',$id)->get()->result_array();
				$data['team'] = $this->db->select('*')->from('tbl_team')->where('status',1)->get()->result_array();

				$this->template->render('pages/our-team',$data);
			}

			public function careers(){


				$data['meta_tags']= $this->db->select('meta_tags')->from('content')->where('id',4)->where('status',1)->get()->result_array();

				$id = 4;
				$data['pagedata']= $this->db->select('*')->from('tbl_content')->where('id',$id)->get()->result_array();

				$this->template->render('pages/careers',$data);
			}

			public function help_and_support(){

				$data['meta_tags']= $this->db->select('meta_tags')->from('content')->where('id',6)->where('status',1)->get()->result_array();

				$id = 6;
				$data['pagedata']= $this->db->select('*')->from('tbl_content')->where('id',$id)->get()->result_array();

				$this->template->render('pages/help-support',$data);
			}

			public function refunds_policy(){


				$data['meta_tags']= $this->db->select('meta_tags')->from('content')->where('id',7)->where('status',1)->get()->result_array();

				$id = 7;
				$data['pagedata'] = $this->db->select('*')->from('tbl_content')->where('id',$id)->get()->result_array();

				$this->template->render('pages/refunds-policy',$data);
			}

			public function pricacy_policy(){

				$data['meta_tags']= $this->db->select('meta_tags')->from('content')->where('id',8)->where('status',1)->get()->result_array();

				$id = 8;
				$data['pagedata'] = $this->db->select('*')->from('tbl_content')->where('id',$id)->get()->result_array();

				$this->template->render('pages/privacy-policy',$data);
			}

			public function contact(){

				$data['meta_tags']= $this->db->select('meta_tags')->from('content')->where('id',8)->where('status',1)->get()->result_array();
				$this->template->render('pages/contact_us',$data);
			}



			public function contact_us(){

				$name=$this->input->post('uname');
				$email=$this->input->post('uemail');
				$mobile=$this->input->post('uphone');
				$subject=$this->input->post('subject');
				$msg=$this->input->post('message');

				if(!empty($name) && !empty($email) && !empty($mobile) && !empty($subject) && !empty($msg)){

					$to= ' sarfaraz@spoons11.com';
					$message  = '<html><body>';
					$message .= '<h2 style="color:#000;font-size:14px;">User Name :'.$name.'</h2>';
					$message .= '<h3 style="color:#000;font-size:14px;">Email :'.$email.'</h3>';
					$message .= '<h3 style="color:#000;font-size:14px;">Contact :'.$mobile.'</h3>';
					$message .= '<p style="color:#000;font-size:14px;">'.$msg.' </p>';

					$message .= '<p style="color:#000;font-size:14px; font-weight:400;">Spoon11</p>';
					$message .= '</body></html>';

					$this->General_model->mailfunction($to, $subject, $message);
					echo "Your Query Successfully Submitted ";
				}else{
					echo "Please fill all the field";
				}

			}

			public function search_res(){

//                print_r($this->input->post());die;
				$location=$this->input->post('location');
				$this->session->set_userdata('location',$location);
				$lat=$this->input->post('lat');
				$this->session->set_userdata('lat',$lat);
				$lng=$this->input->post('lang');
				$this->session->set_userdata('lng',$lng);
				$date=date('y/m/d');

				$sql = $this->db->query("SELECT
					a.*,a.id,b.end_package_date, (
					6371 * acos (
					cos ( radians($lat) )
					* cos( radians( a.lat ) )
					* cos( radians( a.lang ) - radians($lng) )
					+ sin ( radians($lat) )
					* sin( radians( a.lat ) )
					)
					) AS distance
					FROM tbl_restaurant as a join tbl_user as b on a.user_id=b.id where a.status=1 
					HAVING distance < 10
					ORDER BY distance
					LIMIT 0 , 100");
				// echo $this->db->last_query();		

				$data= $sql->result_array();

				$this->session->set_userdata('res_data',$data);
				echo "avilable";
			}

			public function restaurant_list(){
					$data['meta_title']= $this->db->select('meta_title')->from('city')->like('city',$city,'both')->where('status',1)->get()->result_array();
				$data['meta_description']= $this->db->select('meta_description')->from('city')->like('city',$city,'both')->where('status',1)->get()->result_array();
				$data['meta_tags']= $this->db->select('meta_tags')->from('city')->like('city',$city,'both')->where('status',1)->get()->result_array();
				
			
				/*$config = array();
                $config["base_url"] = base_url() . "landing_controller/restaurant_list/";
                $total_row= count($data['res_data1']);
    */           //echo $this->db->last_query();
                /*$config["total_rows"] = $total_row;
                $config["per_page"] = 10;
                $config['use_page_numbers'] = TRUE;
                $config['num_links'] = $total_row;
                $config['cur_tag_open'] = '&nbsp;<a class="current">';
                $config['cur_tag_close'] = '</a>';
                $config['next_link'] = 'Next';
                $config['prev_link'] = 'Previous';
            
                $this->pagination->initialize($config);
            
                if($this->uri->segment(3)){
                $page = ($this->uri->segment(3)) ;
                if($page == 1){
                    $page = 0;
                }
                else{
                    $page = ($page-1)*10;    
                }
                }
                else{
                $page = 0;
                }
                $data["results"] = $this->Pagination_model->fetch_data($config["per_page"], $page);
                *///echo $this->db->last_query();
              	$data['inner_banner']= $this->db->select('*')->from('inner_banner')->where('status',1)->get()->result_array();
					
				$data['cart']=$this->cart->contents();

				$this->template->render('pages/restaurant_list',$data);

			}
			
			public function fetch_data_res(){
			   
			 $city=$this->uri->segment(2);
			 $pagi_start  = $this->input->post('start');
			 $pagi_limit = $this->input->post('limit');
			 $pagi_filter = $this->input->post('filter'); 
			 
				
				
				
				$data['res_data1']=$this->session->userdata('res_data');
				//print_r($data['res_data1']);die;
				$lat=$data['res_data1'][0]['lat'];
				$lng=$data['res_data1'][0]['lang'];
			   
			    
			   //$str_links = $this->pagination->create_links();
                //$data["links"] = explode('&nbsp;',$str_links );
                $data['res_data'] = '';
                if(empty($pagi_filter)){
                $data['res_data']=$this->db->query("SELECT a.*,a.id,b.end_package_date, (6371 * acos (cos ( radians($lat) )* cos( radians( a.lat ) ) * cos( radians( a.lang ) - radians($lng) )+ sin ( radians($lat) ) * sin( radians( a.lat ) ))) AS distance FROM tbl_restaurant as a join tbl_user as b on a.user_id=b.id where a.status=1 HAVING distance < 10 ORDER BY distance LIMIT $pagi_start, $pagi_limit")->result_array();
               
                } else {
                
                    
              	$sql = $this->db->query("SELECT a.*, ( 6371 * acos (cos ( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lang ) - radians($lng) ) + sin ( radians($lat) ) * sin( radians( lat ) ))) AS distance 
						FROM tbl_restaurant as a join tbl_restaurant_cuisine as b ON a.id=b.res_id join tbl_restaurant_item as c ON a.id=c.restaurant_id join tbl_menu as d ON d.id=c.menu_name join tbl_cuisine as e ON e.id=c.cuisine_id  where d.menu_name like '%".$pagi_filter."' or  a.r_name like '%".$pagi_filter."' or  e.name like '%".$pagi_filter."' GROUP BY a.id LIMIT $pagi_start, $pagi_limit");

					$data['res_data']= $sql->result_array();
			
                }
	
		//echo $this->db->last_query();
		//print_r($data['res_data1']);
		//echo count($data['res_data1']);
        //die();
					foreach ($data['res_data'] as $value) {
					    $res_time= $this->db->select('*')->from('restaurant_time')->where('day',$today_day)->where('r_id',$value['id'])->get()->result_array();
					    
					    if( $current_time >= $res_time[0]['open_time']  &&  $current_time <= $res_time[0]['close_time']){
					        
					        ?>
					      
					       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="restaurantListCard">
                             
                              <a href="<?php echo base_url('restaurant-detail') ?>/<?php echo $value['slug']; ?>">
                                 
                                <div class="restaurantListImages">
                                    <p class="Opens">Open </p>
                                    <?php if($value['img']){ ?>
                                    <img src="<?php echo base_url() ?>/upload_images/cuisine/<?php echo $value['img']; ?>" class="img-responsive" style="height: 177px;width: 284px;">
                                    <?php }  else{?>

                                     <img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive" style="height: 177px;width: 284px;">

                                    <?php } ?>
                                </div>                            
                                <div class="restaurantListInfo">
                                    <div class="Closeing">
                                		<p><span>Closing Time</span> :<?php echo DATE("h:i a", STRTOTIME(str_replace(' : ',':',$res_time[0]['close_time']))) ?>  </p>
                                    </div>
                                    <div class="restaurantListTop">
                                        <h4><?php echo $value['r_name'] ?></h4>
                                        <h5><?php echo $value['r_address'] ?></h5>
                                    </div>                                    
                                    <div class="restaurantListBottom">
                                        <div class="restaurantListRate">
                                            <p><?php echo $value['budget'] ?></p>
                                        </div>     
                                        <?php $rating = $this->db->select('rating')->from('restaurant_rating')->where('res_id',$value['id'])->get()->result_array();
                                        $total_rating="";
                                        foreach ($rating as $key) { $total_rating=$total_rating+$key['rating']; }
                                        $overall_rating= round($total_rating/count($rating)); ?>                                   
                                        <div class="restaurantListRating"> 
                                            <p><i class="fa fa-star" aria-hidden="true"></i> <?php echo $overall_rating ?> </p>
                                        </div>                                        
                                        <div class="restaurantListMinutes">

                                            <p><span><?php echo $value['delivery_time'] ?></span> Mins</p>
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="discountBox">
                                    <?php if($value['offer']==0) { ?>
                                    <p>No Offer</p>
                                    <?php } else { ?>
                                    <p><?php echo $value['offer'] ?> % Off</p>
                                    <?php } ?>
                                </div>  
                                
                            </a>  
                         
                        </div>
                    </div>
                    <?php
					        
					    } else if(($res_time[0]['close_time']<=$res_time[0]['open_time']) && ($current_time>=$res_time[0]['open_time'])){ 
					        
					   
					       ?>
					       
					               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="restaurantListCard">
                             
                              <a href="<?php echo base_url('restaurant-detail') ?>/<?php echo $value['slug']; ?>">
                                 
                                <div class="restaurantListImages">
                                    <p class="Opens">Open </p>
                                    <?php if($value['img']){ ?>
                                    <img src="<?php echo base_url() ?>/upload_images/cuisine/<?php echo $value['img']; ?>" class="img-responsive" style="height: 177px;width: 284px;">
                                    <?php }  else{?>

                                     <img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive" style="height: 177px;width: 284px;">

                                    <?php } ?>
                                </div>                            
                                <div class="restaurantListInfo">
                                    <div class="Closeing">
                                		<p><span>Closing Time</span> :<?php echo DATE("h:i a", STRTOTIME(str_replace(' : ',':',$res_time[0]['close_time']))) ?>  </p>
                                    </div>
                                    <div class="restaurantListTop">
                                        <h4><?php echo $value['r_name'] ?></h4>
                                        <h5><?php echo $value['r_address'] ?></h5>
                                    </div>                                    
                                    <div class="restaurantListBottom">
                                        <div class="restaurantListRate">
                                            <p><?php echo $value['budget'] ?></p>
                                        </div>     
                                        <?php $rating = $this->db->select('rating')->from('restaurant_rating')->where('res_id',$value['id'])->get()->result_array();
                                        $total_rating="";
                                        foreach ($rating as $key) { $total_rating=$total_rating+$key['rating']; }
                                        $overall_rating= round($total_rating/count($rating)); ?>                                   
                                        <div class="restaurantListRating"> 
                                            <p><i class="fa fa-star" aria-hidden="true"></i> <?php echo $overall_rating ?> </p>
                                        </div>                                        
                                        <div class="restaurantListMinutes">

                                            <p><span><?php echo $value['delivery_time'] ?></span> Mins</p>
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="discountBox">
                                    <?php if($value['offer']==0) { ?>
                                    <p>No Offer</p>
                                    <?php } else { ?>
                                    <p><?php echo $value['offer'] ?> % Off</p>
                                    <?php } ?>
                                </div>  
                                
                            </a>  
                         
                        </div>
                    </div>
					       
					       <?php
					        
					    }  else {
					        
					     ?>
					            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <div class="restaurantListCard">
                             
                            
                                 
                                <div class="restaurantListImages"  style="">
                                    <p class="Opens">Close </p>
                                    <?php if($value['img']){ ?>
                                    <img src="<?php echo base_url() ?>/upload_images/cuisine/<?php echo $value['img']; ?>" class="img-responsive" style="height: 177px;width: 284px;opacity: 0.4">
                                    <?php }  else{?>

                                     <img src="<?php echo base_url() ?>assets/images/no_image.jpg" class="img-responsive" style="height: 177px;width: 284px;opacity: 0.2">

                                    <?php } ?>
                                </div>                            
                                <div class="restaurantListInfo">
                                    <div class="Closeing">
                                		<p><span>Open Time</span> :<?php echo DATE("h:i a", STRTOTIME(str_replace(' : ',':',$res_time[0]['open_time']))) ?> </p>
                                    </div>
                                    <div class="restaurantListTop">
                                        <h4><?php echo $value['r_name'] ?></h4>
                                        <h5><?php echo $value['r_address'] ?></h5>
                                    </div>                                    
                                    <div class="restaurantListBottom">
                                        <div class="restaurantListRate">
                                            <p><?php echo $value['budget'] ?></p>
                                        </div>     
                                        <?php $rating = $this->db->select('rating')->from('restaurant_rating')->where('res_id',$value['id'])->get()->result_array();
                                        $total_rating="";
                                        foreach ($rating as $key) { $total_rating=$total_rating+$key['rating']; }
                                        $overall_rating= round($total_rating/count($rating)); ?>                                   
                                        <div class="restaurantListRating"> 
                                            <p><i class="fa fa-star" aria-hidden="true"></i> <?php echo $overall_rating ?> </p>
                                        </div>                                        
                                        <div class="restaurantListMinutes">

                                            <p><span><?php echo $value['delivery_time'] ?></span> Mins</p>
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="discountBox">
                                    <?php if($value['offer']==0) { ?>
                                    <p>No Offer</p>
                                    <?php } else { ?>
                                    <p><?php echo $value['offer'] ?> % Off</p>
                                    <?php } ?>
                                </div>  
                                
                        
                         
                        </div>
                    </div>
                    <?php
					        
					     }
					    
					}
 
			}
			
			
			

			
			

			public function category_list(){

				$this->template->render('pages/restaurant_category_list');
			}


			public function saved_address_addf(){
				$id=$this->input->post('id');
				$data= array(
					'user_id' =>$this->input->post('id') ,
					'area' =>$this->input->post('area') ,
					'location' =>$this->input->post('location') ,
					'address_type' =>$this->input->post('address_type'), 	
					'lat' =>$this->input->post('lat'), 	
					'lng' =>$this->input->post('lng'), 	
				);

				$this->General_model->saved_address_addf($data,$id);
				echo("Address Saved");

			}

			public function delete_address(){

				$id=$this->input->post('id');
				$user_id=$this->input->post('user_id');

				$this->General_model->delete_address($user_id,$id);
				echo("Address Deleted");
			}
			public function vieworder_detail(){
				$this->template->render('pages/vieworder-detail');
			}
			public function update_profile(){

				$i=$_FILES['image']['name'];
				$img=time().$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],"upload_images/cuisine/".$img);
				copy("upload_images/cuisine/".$img,"upload_images/cuisine/thumb/".$img);
				$this->simpleimage->load("upload_images/cuisine/thumb/".$img);
				$this->simpleimage->resize(100,50);
				$this->simpleimage->save("upload_images/cuisine/thumb/".$img);
				copy("upload_images/cuisine/".$img,"upload_images/cuisine/tiny/".$img);
				$this->simpleimage->load("upload_images/cuisine/tiny/".$img);
				$this->simpleimage->resize(500,300);
				$this->simpleimage->save("upload_images/cuisine/tiny/".$img);
				$r_id=$this->input->post('r_id');
				$cuisines=$this->input->post('cuisine[]');
				$session_data=$this->session->userdata('user_data');
				
				$rname = $this->input->post('rname');
				$slug = $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->slug($rname))));
				if (!empty($i)) {
					if (!empty($r_id)) {
						$id=$this->input->post('id');
						$data= array(
							'r_name' =>$this->input->post('rname') ,
							'slug' =>$slug ,
							'r_phone' =>$this->input->post('phone') ,
							'm_name' =>$this->input->post('m_name') ,
							'm_contact' =>$this->input->post('m_phone') ,
							'email' =>$this->input->post('email'), 	
							'country_id' =>$this->input->post('country'), 	
							'state_id' =>$this->input->post('state'), 	
							'city_id' =>$this->input->post('city'), 	
							'r_website' =>$this->input->post('website'), 	
							'r_address' =>$this->input->post('address'), 	
							'lat' =>$this->input->post('lat'), 	
							'lang' =>$this->input->post('lng'), 	
							'pdesc' =>$this->input->post('discription'), 	
							'book_table' =>$this->input->post('booktable'), 	
							'meta_tilte' =>$this->input->post('title'), 	
							'min_order' =>$this->input->post('min_order'), 	
							'delivery_time' =>$this->input->post('delivery_time'), 	
							'offer' =>$this->input->post('offer'), 	
							'lat' =>$this->input->post('lat'), 	
							'lang' =>$this->input->post('lng'), 	
							'img' =>$img, 	
						);
						$this->General_model->update_profile($data,$id);
						$this->General_model->update_res_cuisine($cuisines,$id);
						$this->session->set_flashdata('msg',"Successfully updated");
					}
					else{
						$data= array(
							'user_id' =>$session_data[0]['id'],
							'r_name' =>$this->input->post('rname') ,
							'slug' =>$slug ,
							'r_phone' =>$this->input->post('phone') ,
							'm_name' =>$this->input->post('m_name') ,
							'm_contact' =>$this->input->post('m_phone') ,
							'email' =>$this->input->post('email'), 	
							'country_id' =>$this->input->post('country'), 	
							'state_id' =>$this->input->post('state'), 	
							'city_id' =>$this->input->post('city'), 	
							'r_website' =>$this->input->post('website'), 	
							'r_address' =>$this->input->post('address'), 	
							'lat' =>$this->input->post('lat'), 	
							'lang' =>$this->input->post('lng'), 	
							'pdesc' =>$this->input->post('discription'), 	
							'book_table' =>$this->input->post('booktable'), 	
							'meta_tilte' =>$this->input->post('title'), 
							'min_order' =>$this->input->post('min_order'), 	
							'delivery_time' =>$this->input->post('delivery_time'),
							'offer' =>$this->input->post('offer'), 	

							'lat' =>$this->input->post('lat'), 	
							'lang' =>$this->input->post('lng'),
							'img' =>$img,
						);
						$this->General_model->add_res_profile($data);
						$res_last_id=$this->db->insert_id();
						$this->General_model->add_res_time($res_last_id);
						$this->General_model->add_res_cuisine($cuisines,$res_last_id);
					}

				}else{

					if (!empty($r_id)) {
						echo $id=$this->input->post('id');
						$data= array(
							'r_name' =>$this->input->post('rname') ,
							'slug' =>$slug ,
							'r_phone' =>$this->input->post('phone') ,
							'm_name' =>$this->input->post('m_name') ,
							'm_contact' =>$this->input->post('m_phone') ,
							'email' =>$this->input->post('email'), 	
							'country_id' =>$this->input->post('country'), 	
							'state_id' =>$this->input->post('state'), 	
							'city_id' =>$this->input->post('city'), 	
							'r_website' =>$this->input->post('website'), 	
							'r_address' =>$this->input->post('address'), 	
							'lat' =>$this->input->post('lat'), 	
							'lang' =>$this->input->post('lng'), 	
							'pdesc' =>$this->input->post('discription'), 	
							'book_table' =>$this->input->post('booktable'), 	
							'meta_tilte' =>$this->input->post('title'),
							'min_order' =>$this->input->post('min_order'), 	
							'delivery_time' =>$this->input->post('delivery_time'), 	
							'offer' =>$this->input->post('offer'), 	
							'lat' =>$this->input->post('lat'), 	
							'lang' =>$this->input->post('lng'),
						);
						$this->General_model->update_profile($data,$id);
						$this->General_model->update_res_cuisine($cuisines,$id);
						$this->session->set_flashdata('msg',"Successfully updated");
					}
					else{
						$data= array(
							'user_id' =>$session_data[0]['id'],
							'r_name' =>$this->input->post('rname') ,
							'slug' =>$slug ,
							'r_phone' =>$this->input->post('phone') ,
							'm_name' =>$this->input->post('m_name') ,
							'm_contact' =>$this->input->post('m_phone') ,
							'email' =>$this->input->post('email'), 	
							'country_id' =>$this->input->post('country'), 	
							'state_id' =>$this->input->post('state'), 	
							'city_id' =>$this->input->post('city'), 	
							'r_website' =>$this->input->post('website'), 	
							'r_address' =>$this->input->post('address'), 	
							'lat' =>$this->input->post('lat'), 	
							'lang' =>$this->input->post('lng'), 	
							'pdesc' =>$this->input->post('discription'), 	
							'book_table' =>$this->input->post('booktable'), 	
							'meta_tilte' =>$this->input->post('title'), 
							'min_order' =>$this->input->post('min_order'), 	
							'delivery_time' =>$this->input->post('delivery_time'),	
							'offer' =>$this->input->post('offer'), 	
							'lat' =>$this->input->post('lat'), 	
							'lang' =>$this->input->post('lng'),
						);
						$this->General_model->add_res_profile($data);
						$res_last_id=$this->db->insert_id();
						$this->General_model->add_res_time($res_last_id);
						$this->General_model->add_res_cuisine($cuisines,$res_last_id);
					}

				}
				redirect(base_url('restaurant-vender-list'));
				$this->session->set_flashdata('msg',"Successfully Inserted");

			}

			public function restaurant_vender_list(){

				$this->template->render('pages/restaurant_vender_list');

			}

			public function restaurant_vender_addf(){


				$id=$this->input->get('id');
				$res_data['data']=$sql = $this->db->select('*')->from('restaurant')->where('id',$id)->get()->result_array();

				$this->template->render('pages/restaurant_vender_addf',$res_data);

			}
			public function restaurant_time_list(){
				$this->template->render('pages/restaurant_time_list');

			}
			public function restaurant_time_addf(){
				$this->template->render('pages/restaurant_time_addf');

			}
			public function update_time(){
				$id=$this->input->post('id');

				$data=array(
					'open_time' =>$this->input->post('open_time') ,
					'close_time' =>$this->input->post('close_time') ,
				);

				$this->General_model->update_time($data,$id);
				//redirect(base_url('restaurant-vender-list'));
				redirect($_SERVER['HTTP_REFERER']);

			}

			public function restaurant_review_list(){


				$this->template->render('pages/restaurant_review_list');

			}
			public function restaurant_booking_list(){
				$this->template->render('pages/restaurant_booking_list');

			}

			public function restaurant_detail(){

				// $this->cart->destroy();
				// $r_id=$this->input->get('r_id');
				$r_id=$this->uri->segment(2);
				// die;
				$res_data = $this->db->select('*')->from('restaurant')->where('slug',$r_id)->get()->result_array();

				$data['menu']=$sql = $this->db->select('*')->from('restaurant_item')->where('restaurant_id',$res_data[0]['id'])->where('status',1) ->get()->result_array();
				$data['res_data']=$sql = $this->db->select('*')->from('restaurant')->where('id',$res_data[0]['id'])->get()->result_array();
				$rating=$sql = $this->db->select('rating')->from('restaurant_rating')->where('res_id',$res_data[0]['id'])->get()->result_array();
                $total_rating="";
				foreach ($rating as $key) {
					$total_rating=$total_rating+$key['rating'];
				}

				$overall_rating= round($total_rating/count($rating));
				$data['rating']=$overall_rating;

				$this->db->select('c.name,c.id');
				$this->db->from('restaurant a'); 
				$this->db->join('restaurant_cuisine b', 'b.res_id=a.id', 'right');
				$this->db->join('cuisine c', 'c.id=b.cuisine_id', 'right');
	// $this->db->join('restaurant_item d', 'd.restaurant_id=a.id', 'right');
				$this->db->where('a.id=',$res_data[0]['id']);
	// $this->db->group_by('c.id','desc');         

				$res_cuisine= $this->db->get()->result_array(); 

				$this->db->select('b.category,b.id');
				$this->db->from('restaurant_item a'); 
				$this->db->join('category b', 'b.id=a.cat_id', 'right');
				$this->db->where('a.restaurant_id=',$res_data[0]['id']);
				$this->db->group_by('b.id','desc');         
				$res_category= $this->db->get()->result_array(); 
				$data['res_category']=$res_category;

				$data['res_cuisine']=$res_cuisine;

				$this->db->select('b.sub_category,b.id,,a.cat_id');
				$this->db->from('restaurant_item a'); 
				$this->db->join('sub_category b', 'b.id=a.sub_cat_id', 'right');
				$this->db->where('a.restaurant_id=',$res_data[0]['id']);
				$this->db->group_by('b.id','desc');   
				$res_sub_category= $this->db->get()->result_array(); 

				$data['res_sub_category']=$res_sub_category;

				foreach ($res_cuisine as $key) {
					$cus_n[]=$key['name'];
				}
				$data['cuss_n']=implode(',  ', $cus_n);

				$data['cart']=$this->cart->contents();


				$setting= $this->db->select('*')->from('setting')->get()->result_array();


				$this->session->set_userdata('tax',$setting[0]['tax']);

				$data['meta_title']= $this->db->select('meta_tilte')->from('restaurant')->
				where('id',$res_data[0]['id'])->get()->result_array();

				$this->template->render('pages/restaurant/restaurant_order_menu',$data);

			}
			public function filter_search(){

				$filter=$this->input->post('filter');

				$lat=$this->session->userdata('lat');
				$lng=$this->session->userdata('lng');
				$radius = 100; 
				$angle_radius = $radius / 111; 
				$max_lat = $lat + $angle_radius;
				$max_lng = $lng + $angle_radius;



				$data['res_data']=$sql = $this->db->select('*')->from('restaurant')->like('r_name',$filter,'both')->where('lat>=',$lat)->where('lang>=',$lng)->where('lat<=',$max_lat)->where('lang<=',$max_lng)->where('status',1)->get()->result_array();

				$data['cuisine']=$sql = $this->db->select('*')->from('cuisine')->like('name',$filter,'both')->where('status',1)->get()->result_array();

				$data['menu']=$sql = $this->db->select('*')->from('menu')->like('menu_name',$filter,'both')->where('status',1)->get()->result_array();



				$this->load->view('pages/restaurant/filter',$data);




			}

			public function filter_new_search(){

				$filter=$this->input->post('filter');

				$lat=$this->session->userdata('lat');
				$lng=$this->session->userdata('lng');
				$radius = 100; 
				$angle_radius = $radius / 111; 
				$max_lat = $lat + $angle_radius;
				$max_lng = $lng + $angle_radius;

				if ($filter=='relevance') {
					$sql = $this->db->query("SELECT
						*, (
						6371 * acos (
						cos ( radians($lat) )
						* cos( radians( lat ) )
						* cos( radians( lang ) - radians($lng) )
						+ sin ( radians($lat) )
						* sin( radians( lat ) )
						)
						) AS distance
						FROM tbl_restaurant
						HAVING distance < 10
						ORDER BY distance
						LIMIT 0 , 20");
					$data['res_data']= $sql->result_array();
				} elseif ($filter=='delivery_time') {


					$sql = $this->db->query("SELECT
						*, (
						6371 * acos (
						cos ( radians($lat) )
						* cos( radians( lat ) )
						* cos( radians( lang ) - radians($lng) )
						+ sin ( radians($lat) )
						* sin( radians( lat ) )
						)
						) AS distance
						FROM tbl_restaurant
						HAVING distance < 10
						ORDER BY delivery_time asc
						LIMIT 0 , 20");
					$data['res_data']= $sql->result_array();



				} elseif ($filter=='restaurant_rating') {



					$sql = $this->db->query("SELECT
						*, (
						6371 * acos (
						cos ( radians($lat) )
						* cos( radians( lat ) )
						* cos( radians( lang ) - radians($lng) )
						+ sin ( radians($lat) )
						* sin( radians( lat ) )
						)
						) AS distance
						FROM tbl_restaurant
						HAVING distance < 10
						ORDER BY rating DESC
						LIMIT 0 , 20");
					$data['res_data']= $sql->result_array();

				} elseif ($filter=='budget') {



					$sql = $this->db->query("SELECT
						*, (
						6371 * acos (
						cos ( radians($lat) )
						* cos( radians( lat ) )
						* cos( radians( lang ) - radians($lng) )
						+ sin ( radians($lat) )
						* sin( radians( lat ) )
						)
						) AS distance
						FROM tbl_restaurant
						HAVING distance < 10
						ORDER BY budget asc
						LIMIT 0 , 20");
					$data['res_data']= $sql->result_array();

				}



				$this->load->view('pages/restaurant/restaurant_filter_cuisine',$data);

			}

			public function filter_res_cuisine(){

				$data['cuisine']=$this->input->post('cuisine');
				$data['budget']=$this->input->post('budget');
				$data['offer']=$this->input->post('offer');
				$data['filter']=$this->input->post('filter');

				$lat=$this->session->userdata('lat');
				$lng=$this->session->userdata('lng');
				$radius = 100; 
				$angle_radius = $radius / 111; 
				$max_lat = $lat + $angle_radius;
				$max_lng = $lng + $angle_radius;




				if (!empty($data['offer'])) {


					$sql = $this->db->query("SELECT
						tbl_restaurant.*, (
						6371 * acos (
						cos ( radians($lat) )
						* cos( radians( lat ) )
						* cos( radians( lang ) - radians($lng) )
						+ sin ( radians($lat) )
						* sin( radians( lat ) )
						)
						) AS distance
						FROM tbl_restaurant 
						HAVING distance < 10
						ORDER BY offer desc
						LIMIT 0 , 20");

					$data['res_data']= $sql->result_array();
                    


				}elseif (!empty($data['filter'])) {


					$sql = $this->db->query("SELECT
  a.*, (
						6371 * acos (
						cos ( radians($lat) )
  * cos( radians( lat ) )
  * cos( radians( lang ) - radians($lng) )
						+ sin ( radians($lat) )
  * sin( radians( lat ) )
						)
						) AS distance
						FROM tbl_restaurant as a join tbl_restaurant_cuisine as b ON a.id=b.res_id join tbl_restaurant_item as c ON a.id=c.restaurant_id join tbl_menu as d ON d.id=c.menu_name join tbl_cuisine as e ON e.id=c.cuisine_id  where d.menu_name like '%".$data['filter']."' or  a.r_name like '%".$data['filter']."' or  e.name like '%".$data['filter']."' GROUP BY a.id ");

					$data['res_data1']= $sql->result_array();
					//echo $this->db->last_query();



				}elseif (!empty($data['cuisine'])){




					$sql = $this->db->query("SELECT 
						a.*, (
						6371 * acos (
						cos ( radians($lat) )
						* cos( radians( lat ) )
						* cos( radians( lang ) - radians($lng) )
						+ sin ( radians($lat) )
						* sin( radians( lat ) )
						)
						) AS distance
						FROM tbl_restaurant as a join tbl_restaurant_cuisine as b ON a.id=b.res_id
						HAVING distance < 10
						ORDER BY distance
						LIMIT 0 , 20");

					$data['res_data']= $sql->result_array();



				}


				else{


					$sql = $this->db->query("SELECT
						tbl_restaurant.*, (
						6371 * acos (
						cos ( radians($lat) )
						* cos( radians( lat ) )
						* cos( radians( lang ) - radians($lng) )
						+ sin ( radians($lat) )
						* sin( radians( lat ) )
						)
						) AS distance
						FROM tbl_restaurant
						HAVING distance < 10
						ORDER BY distance
						LIMIT 0 , 20");

					$data['res_data']= $sql->result_array();

				}
				
				
		
				$this->load->view('pages/restaurant/restaurant_filter_cuisine',$data);

			}

			public function membership_payu_success(){
				$data=$this->session->userdata('payment_data');

				$this->General_model->update_payment_mebership($data);
			// echo $this->db->last_query();

				$this->template->render('pages/thank_page');
			}

			public function user_table_booking_list(){

				$this->template->render('pages/user-table-booking-list.php');

			}

			public function book_table(){

				$res_data['r_data']=$sql = $this->db->select('*')->from('restaurant')->where('status',1)->get()->result_array();
				$userdata=$this->session->userdata('user_data');
				$res_data['user_id']=$userdata[0]['id'];
				$this->template->render('pages/book-table.php',$res_data);
			}
			public function get_table(){

				$r_data=$sql = $this->db->select('*')->from('restaurant')->where('id',$this->input->post('res_id'))->where('status',1)->get()->result_array();
				$table=$r_data[0]['no_of_table'];
				$bookiing_data= $this->db->select('*')->from('bookiing')->where('res_id',$this->input->post('res_id'))->where('date',$this->input->post('date'))->get()->result_array();
				foreach ($bookiing_data as $key) {
					$total_no_of_table=$total_no_of_table+$key['no_of_tables'];
				}
				$table=$table-$total_no_of_table;

				if($table>0){
					for ($i=1; $i <=$table; $i++) { 
						echo $data='<option value="'.$i.'">'.$i.'  Tables</option>';
					}
				}else{

					echo $data='<option >Table not available </option>';

				}

			}

			public function save_table(){

				$data=$this->input->post();
				if($this->input->post('id')){
					$this->db->select();
					$this->db->from('bookiing');
					$this->db->where('id',$this->input->post('id'));

					unset($data['id']);
					$this->db->update('bookiing',$data);

					$this->session->set_flashdata('msg','Table booking Update Successfully');
				}else{
					unset($data['id']);
					$this->db->insert('bookiing',$data);
					$this->session->set_flashdata('msg','Table booking Successfully');

				}


				redirect(base_url('user-table-booking-list'));
				// print_r($data);

			}
			public function cancel_booking(){
				echo $id=$this->input->get('id');
				$this->db->select();
				$this->db->from('bookiing');
				$this->db->where('id',$id);
				$this->db->delete('bookiing');
// echo $this->db->last_query();
				$this->session->set_flashdata('msg','Table booking Cancel Successfully');
				redirect(base_url('user-table-booking-list'));
				
			}
			public function vender_table_booking_list(){

				$this->template->render('pages/vender-table-booking-list.php');


			}
			public function boking_table(){
				$this->template->render('pages/booking_table.php');

			}
			
			
			public function process_facebook_login()
		{
			$this->load->library('facebook');
			
			
			
			if($this->facebook->is_authenticated())
			{
			# Get user facebook profile details
				$userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
			
			print_r($userProfile); die;
			// 	        preformatted_data($userProfile);
			# Now since we have the user details, let us proceed to input the details to the database
				
			# Load user model
				$this->load->model('user_model','user');
				
				if(!empty($userProfile['email']))
				{
					$lastId = $this->user->social_signup($userProfile['first_name'], $userProfile['last_name'], $userProfile['email'], 'facebook', $userProfile['id'], $userProfile['picture']['data']['url']);
					
					if($lastId)
					{
					# Get user profile by $lastId
						
						$result  = $this->user->get_user_profile($lastId);
						
						
						$sessionData = array(
							'email'=>$result->{User_model::_EMAIL},
							'userName'=>$result->{User_model::_F_NAME} .' ' . $result->{User_model::_L_NAME},
							'userGroup'=>$result->{User_model::_USER_GROUP},
							'userType'=>$result->{User_model::_USER_TYPE},
							'user_id' => $result->{User_model::_ID},
							'userLoggedIn' => true,
							'loginVia'=>'social',
							'social'=>true
							);
						
						print_r($sessionData);
						die;
						$this->session->set_userdata($sessionData);
						
					# Now every thing is set up, its time to reload to my profile page
						
						redirect(base_url('dashboard'));
					}
				}
				
			redirect(base_url());
				
				
			}
			
		    redirect(base_url());
		}

		}



