<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/lib/config_paytm.php");
require_once(APPPATH."libraries/lib/encdec_paytm.php");

class Add_cart_item extends Base
{

	public function __construct(){
		parent::__construct();
		$this->template->set('home', true);
		$this->template->set('title', 'Spoons11');
		$this->load->library('cart');
		$this->load->library('GetProcessingUserID');
		$this->load->library('Pushnotification');
		$this->load->library('Pushnotification_for_vender');
		$this->load->model('General_model');

	}	

	public function add_cart(){


		$data=$this->cart->contents();
		foreach ($data as $key) {

		}

		$data = array(
			"id"  => $this->input->post('menu_id'),
			"name"  => $this->input->post('r_id'),
			"qty"  => $this->input->post('menu_qnt'),
			"price"  => $this->input->post('menu_price'),
		);
		if (empty($this->cart->contents())) {
			$this->cart->insert($data);

		}elseif ($key['name']==$data['name']) {
			$this->cart->insert($data);

		}else{
			echo $p='<p style="color: red" align="center">You are not select menu on another Restaurant</p>';
		}



		$data['cart']=$this->cart->contents();

		$this->load->view('pages/restaurant/cart',$data);

	}
	public function update_cart(){


		$data = array(
			"qty"  => $this->input->post('menu_qnt'),
			"rowid"  => $this->input->post('rowid'),
		);
		$this->cart->update($data);
		$data['cart']=$this->cart->contents();
		$this->load->view('pages/restaurant/cart',$data);


	}
	public function customer_payment_checkout(){
		// echo "<pre>";
		// print_r($this->session->userdata('user_data'));
		// echo "</pre>";
		// exit();
		if (!empty($this->session->userdata('user_data'))) {
			$userdata=$this->session->userdata('user_data');
			$data['user_address']=$this->db->select('*')->from('user_address')->where('user_id',$userdata[0]['id'])->get()->result_array();

			$data['r_data']=$this->db->select('*')->from('restaurant')->where('id',$this->input->get('r_id'))->get()->result_array();
		// print_r($r_data);

		// exit();

			$data['cart']=$this->cart->contents();
			$this->template->render('pages/restaurant/payment_checkout',$data);
		}else{
			redirect(base_url());
		}
		

	}

	public function apply_copon(){

		$coupon_code=$this->input->post('coupon');
		$restaurant_id=$this->input->post('restaurant_id');
		$user_id=$this->input->post('user_id');
		$total_amount=$this->input->post('total_amount');

		$date=date("Y-m-d");

		$coupon=$sql = $this->db->select('*')->from('coupon')->where('coupon_code',$coupon_code)->where('expire_date>=',$date)->where('status',1)->get()->num_rows();

		if ($coupon>0) {

			$coupon=$sql = $this->db->select('*')->from('coupon')->where('coupon_code',$coupon_code)->where('expire_date>=',$date)->where('status',1)->get()->result_array();



		}
		else{


			$coupon=$sql = $this->db->select('*')->from('restaurant_coupon')->where('coupon_code',$coupon_code)->where('r_id',$restaurant_id)->where('expire_date>=',$date)->where('status',1)->get()->result_array();
		}	



		if($coupon[0]['discount_type']=='Direct'){
			$msg="Coupon Applied";
			$discount=$coupon[0]['discount'];
			$this->session->set_userdata('discount_amount',$discount);
			$total_amount=$total_amount-$coupon[0]['discount'];
			$tr='<td>Discount amount:</td> <td>&#x20b9; <span id="discount_amount">'.$discount.'</span></td>';
		}
		elseif($coupon[0]['discount_type']=='Percent'){
			$msg="Coupon Applied";
			$discount=($total_amount/100)*$coupon[0]['discount'];
			$this->session->set_userdata('discount_amount',$discount);
			$total_amount=$total_amount-$discount;
			$tr='<td>Discount amount:</td> <td>&#x20b9; <span id="discount_amount">'.$discount.'</span></td>';
		}
		else{
			$msg="Invalid Coupon";

			$tr='<td><input type="text" placeholder="Promo Code" class="CoupeonCode"></td>
			<td><a href="" class="Apply-Copon">Apply Coupon ?</a></td>';
		}

		

		$arrayName = array('total_amount' =>$total_amount ,'message'=>$msg,'tr' => $tr);

		echo json_encode($arrayName);


	}
	public function payment_order(){


		$total_amount=$this->input->post('total_amount');


		$user_id=$this->input->post('user_id');
		$payment_method=$this->input->post('payment_method');
		$address_id=$this->input->post('address_id');
		$restaurant_id=$this->input->post('restaurant_id');
		$order_notes=$this->input->post('order_notes');
		$gst_amount=$this->input->post('gst');
		$delivery_charges=$this->input->post('delivery_charges');
		$discount_amount=$this->input->post('discount_amount');
		$distance=$this->session->userdata('total_distance');
		$this->session->set_userdata('total_amount',$total_amount);
		$cart_data=$this->cart->contents();

		// $this->db->select('*');
		// $this->db->from('tbl_order_new')->get();
		//  echo $last_id=$this->db->insert_id();

		$this->load->helper('string');
		$last_id=random_string('alnum',5);
		$order_id= "SP".date("Ymd").$last_id;
        $payment_status = 0;

		$delivery_address=$this->db->select('*')->from('user_address')->where('id',$address_id)->where('user_id',$user_id)->get()->result_array();
        if($payment_method == 'wallet'){
    		//Debit amount from users wallet
    		$wallet_amount = $this->General_model->get_wallet($user_id);
    		if($wallet_amount < $total_amount){
    			$response['status']=0;
    			$response['message']='Insufficient wallet balance';
    			return $response;
    		}else{
    			$debit_wallet = array(
    				'user_id' =>$user_id , 
    				'credit_amount' =>$total_amount, 
    				'type' =>'Dr', 
    				'status' =>1, 
    			);
    			$this->General_model->wallet_trans($debit_wallet);
    			$payment_status = 1;
    		}
    	}
        date_default_timezone_set('Asia/Kolkata');
		$order_data= array(
			'order_no' =>$order_id , 
			'user_id' =>$user_id , 
			'restaurant_id' =>$restaurant_id , 
			'delivery_address' =>$delivery_address[0]['location'] , 
			'address_type' =>$delivery_address[0]['address_type'] , 
			'total_amount' =>$total_amount , 
			'gst_amount' =>$gst_amount , 
			'discount_amount' =>$discount_amount , 
			'delivery_charges' =>$delivery_charges , 
			'delivery_date' =>date('Y-m-d H:i:s') , 
			'payment_method' =>$payment_method , 
			'total_distance' =>$distance , 
			'lat' =>$delivery_address[0]['lat'] , 
			'lng' =>$delivery_address[0]['lng'], 
			'payment_status' =>$payment_status , 
		);
		$this->session->set_userdata('order_data',$order_data);
		$this->session->set_userdata('cart_data',$cart_data);

		$this->General_model->insert_order($order_data);
		$this->General_model->insert_cart_item($cart_data,$user_id,$restaurant_id,$order_id);
		$this->session->set_userdata('order_id',$order_id);



	}
	public function wallet_blnc()
	{
        $total_credit=0;
        $total_debit=0;
		$userdata=$this->session->userdata('user_data');
		$credit_amount= $this->db->select('credit_amount')->from('cashcredit')->where('user_id',$userdata[0]['id'])->where('type','Cr')->get()->result_array();
		foreach ($credit_amount as $key) {$total_credit=$total_credit+$key['credit_amount'];}
		$debit_amount= $this->db->select('credit_amount')->from('cashcredit')->where('user_id',$userdata[0]['id'])->where('type','Dr')->get()->result_array();
		foreach ($debit_amount as $key) {$total_debit=$total_debit+$key['credit_amount'];}
		$total_wallet=$total_credit - $total_debit;
		if ($total_wallet>=$this->session->userdata('total_amount')) {
			
			$data=array(
				'user_id' =>$userdata[0]['id'] , 
				'credit_amount' =>$this->session->userdata('total_amount'), 
				'type' =>'Dr', 
				'status' =>1, 
			);
			$this->General_model->wallet_trans($data);
			echo "success";
		}
		else
		{
			echo "your wallet have not enough balance please choose another payment method";
		}



	}

	// public function paypal_form(){
	// 	$this->load->view('pages/paypal/paypal_form');
	// }

	public function case_on_delivery(){

		$session_userdata=$this->session->userdata('user_data');
		/*genrate mail order detail*/
		$to 	 = $session_userdata[0]['email'];
		$subject = "Restaurant Order";
		$message  = $this->load->view('pages/mail_templet/mail','',true);


		$this->General_model->mailfunction($to, $subject, $message);

		$this->cart->destroy();

		$this->session->set_userdata('item_ammount','');
		$this->session->set_userdata('gst_ammount','');
		$this->session->set_userdata('discount_amount','');
		

		$session_cartdata=$this->session->userdata('cart_data');
		$order_id=$this->session->userdata('order_id');
		foreach ($session_cartdata as $key) { }
			$res_id=$key['name']; 
		// echo $this->get_id($res_id);
		

		$data_id= array(
			'delivery_boy_id' =>$this->get_id($res_id));
// print_r($data_id);
// die;
		// $this->db->select('*');
		$this->db->from('order_new');
		$this->db->where('order_no',$order_id);
		$this->db->update('order_new',$data_id);
		
		/*delevery boy notification*/
		$notification=new Pushnotification();
		$profile=$this->db->from('tbl_delivery_boy_profile')->where('id',$data_id['delivery_boy_id'])->get()->result_array();
		$message='You Have New order';
		$registrationId=$profile[0]['device_id'];
		$registrationId= array($registrationId);
		if (!empty($registrationId)){
		if ($profile[0]['device_type']==1) 
		{
		$responseEEE = $notification->andriod_push($registrationId, $message);
		
		}elseif ($profile[0]['device_type']==2) {

		$responseEEE = $notification->ios_push($registrationId, $message);

		}
		}
		/*Vender notification*/

		$res_data=$this->db->select('*')->from('restaurant')->where('id',$res_id)->where('status',1)->get()->result_array();
		$user_profile=$this->db->from('user')->where('id',$res_data[0]['user_id'])->get()->result_array();
		// print_r($user_profile);

		$notification_vender=new Pushnotification_for_vender();
		// echo $notification_vender->hello();
		$message='You Have New order on'.$res_data[0]['r_name'];
		$registrationId=$user_profile[0]['device_id'];
		$registrationId= array($registrationId);
		// die;
		if (!empty($registrationId)){
			
			if ($user_profile[0]['device_type']==1) 
			{
			$responseEEE = $notification_vender->andriod_push($registrationId, $message);
			
			}elseif ($user_profile[0]['device_type']==2) {

			$responseEEE = $notification_vender->ios_push($registrationId, $message);

			}
		}
		

		// $this->template->render('pages/thank_page');


		redirect(base_url('get-delivery-boy-Location'));

	}
	public function ccavenue_Form(){

		$this->load->view('pages/ccavenue/ccavenue_form');


	}
	public function payumoney_Form(){

		$this->load->view('pages/payumoney/payumoney_form');


	}


	public function payu_success(){
        /*print_r($this->input->post());
        die;*/
		$orderData=$this->session->userdata('order_data');
		$order_id=$orderData['order_no'];
		$this->General_model->update_payment($order_id);
		$session_userdata=$this->session->userdata('user_data');
		$to 	 = $session_userdata[0]['email'];
		$subject = "Restaurant Order";
		$message  = $this->load->view('pages/mail_templet/mail','',true);
		$this->General_model->mailfunction($to, $subject, $message);

		$session_cartdata=$this->session->userdata('cart_data');
		$order_id=$this->session->userdata('order_id');
		foreach ($session_cartdata as $key) { }
			$res_id=$key['name']; 
		// echo $this->get_id($res_id);
		$data_id= array(
			'delivery_boy_id' =>$this->get_id($res_id) , );


		$this->db->from('order_new');
		$this->db->where('order_no',$order_id);
		$this->db->update('order_new',$data_id);
		$this->cart->destroy();

		/*delevery boy notification*/
		$notification=new Pushnotification();
		$profile=$this->db->from('tbl_delivery_boy_profile')->where('id',$data_id['delivery_boy_id'])->get()->result_array();
		$message='You Have New order';
		$registrationId=$profile[0]['device_id'];
		$registrationId= array($registrationId);
		if (!empty($registrationId)){
		if ($profile[0]['device_type']==1) 
		{
		$responseEEE = $notification->andriod_push($registrationId, $message);
		
		}elseif ($profile[0]['device_type']==2) {

		$responseEEE = $notification->ios_push($registrationId, $message);

		}
		}
		/*Vender notification*/

		$res_data=$this->db->select('*')->from('restaurant')->where('id',$res_id)->where('status',1)->get()->result_array();
		$user_profile=$this->db->from('user')->where('id',$res_data[0]['user_id'])->get()->result_array();
		$notification_vender=new Pushnotification_for_vender();
		$message='You Have New order on'.$res_data[0]['r_name'];
		$registrationId=$user_profile[0]['device_id'];
		$registrationId= array($registrationId);
		// die;
		if (!empty($registrationId)){
			
			if ($user_profile[0]['device_type']==1) 
			{
			$responseEEE = $notification_vender->andriod_push($registrationId, $message);
			
			}elseif ($user_profile[0]['device_type']==2) {

			$responseEEE = $notification_vender->ios_push($registrationId, $message);

			}
		}
		//$this->template->render('pages/thank_page');
	
	redirect(base_url('get-delivery-boy-Location'));
}

/*
*-----------------------------------------------------------------------------------------------------
*/

public function payment_prime_membership(){
    
        if(empty($this->session->userdata('user_data'))){
            exit('you are not logged in..');
        }
    
			  if(!empty($this->input->post('pmembership_type'))){
			      
			      
			   $res_plan = $this->db->select('*')->from('prime_membership_plan')->where('id', $this->input->post('pmembership_type'))->where('plan_status',1)->get()->result_array();
			 
			    $order_id = "SP". $session_userdata[0]['id'] .strtoupper(bin2hex(random_bytes(8)));
			    
			 	$session_userdata=$this->session->userdata('user_data');
        		$cust_id 	 = $session_userdata[0]['id'];
        		$total_price = $res_plan[0]['plan_price'];
        		
                $paramList["MID"] = PAYTM_MERCHANT_MID;
                $paramList["ORDER_ID"] = $order_id;        
                $paramList["CUST_ID"] = 'CUST00007'; 
                $paramList["INDUSTRY_TYPE_ID"] = 'Retail109';
                $paramList["CHANNEL_ID"] = 'WAP';
                $paramList["TXN_AMOUNT"] = $total_price;
                $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
              
                $paramList["CALLBACK_URL"] = base_url('prime-membership-payment-status');
        
                $checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
                
                ?>
              
                <form id="myFormPrime" action="<?php echo PAYTM_TXN_URL ?>" method="post">
                <?php
                 foreach ($paramList as $a => $b) {
                echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
               }
               ?>
                    <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
                </form>
                <script type="text/javascript">
                    document.getElementById('myFormPrime').submit();
                 </script>
            
                 <?php
			      
			  } else {
			      
			   redirect(base_url('')); 
			   
			  }
}


		public function prime_membership_payment_status(){
		 $session_userdata=$this->session->userdata('user_data');   
		 $plan = $this->db->select('*')->from('prime_membership_plan')->where('plan_status',1)->get()->result_array();
		 if($plan[0]['plan_price']==1){
		     
		     $st_date = date('Y-m-d');
		     $end_date = date("Y-m-d", strtotime("+1 month"));
		     
		 } else if($plan[0]['plan_price']==2){
		      $st_date = date('Y-m-d');
		     $end_date = date("Y-m-d", strtotime("+6 month"));
		     
		 } else if($plan[0]['plan_price']==3){
		     $st_date = date('Y-m-d');
		     $end_date = date("Y-m-d", strtotime("+12 month"));
		     
		 }
		    
		 $orderData=$this->session->userdata('order_data');
		 
		$order_id=$orderData['order_no'];
		
        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";

        $paramList = $_POST;

   
      $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
      
        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); 
        if($isValidChecksum == "TRUE")
        {
            if ($_POST["STATUS"] == "TXN_SUCCESS"){ 
                
            $up_data = array(
			'prime_member_start' => $st_date,
			'prime_member_end' => $end_date
	        );
		
              $this->db->where("id", $session_userdata[0]['id']);
              $this->db->update("user", $up_data);
            //     if($this->db->affected_rows() > 0){
            //         echo 'fhvdhfvbfev success';
            //     }else{
            //       echo'false rhfrhb';
            //   }
            //  print_r($this->session->userdata('user_data'));
            //  exit();
    
            $data['order_status'] = '<div class="jumbotron text-center">
        	<h1>Thank You!</h1>
        	<p><strong>You are now our Prime member</strong></p>
        	<hr>
        	<p><a class="btn btn-primary btn-sm" href="'. base_url() .'" role="button">Continue to homepage</a></p>
        	<div class="container">
        	<div class="row">
        	<div class="col-md-4 col-md-offset-4">
        		<ul class="list-group">
        		<li class="list-group-item">Order Id : #'.$_POST["ORDERID"].' </li>
        		<li class="list-group-item">Total Amount : '. $_POST["TXNAMOUNT"] .'</li>
        		<li class="list-group-item">Transaction Id : '. $_POST["TXNID"] .'</li>
        		</ul>
        	</div></div>
        	</div></div>';	
               
               
            }
           else { 
    $data['order_status'] = '<div class="jumbotron text-center">
	<h1>Failed to get Payment!</h1>
	<hr>
	<p><a class="btn btn-primary btn-sm" href="'. base_url() .'" role="button">Continue to homepage</a></p>
	<div class="container">
	<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<ul class="list-group">
		<li class="list-group-item">Order Id : #'.$_POST["ORDERID"].' </li>
		<li class="list-group-item">Total Amount : '. $_POST["TXNAMOUNT"] .'</li>
		</ul>
	</div></div>
	</div></div>';

            }
      }else
       {
          echo " Somthing Went wrong";
        }
        
        
		   	$this->template->render('pages/prime-membership-payment-status', $data);
		}
		
		
/*
*---------------------------------------------------------------------------------------------------
*/



	public function payu_failure(){

		$this->template->render('pages/failure_page');


	}
    
    public function PaytmGateway()
    {
        $orderData=$this->session->userdata('order_data');
		$order_id=$orderData['order_no'];
		$total_price=$orderData['total_amount'];
        $orderId = $order_id; /// must be unique
      $this->StartPayment($orderId);
    }
  
    public function StartPayment($orderId)
    {
		$session_userdata=$this->session->userdata('user_data');
		$cust_id 	 = $session_userdata[0]['id'];
        $orderData=$this->session->userdata('order_data');
		//$order_id=$orderData['order_no'];
		$total_price=$orderData['total_amount'];
        $paramList["MID"] = PAYTM_MERCHANT_MID;
        $paramList["ORDER_ID"] = $orderId;        
        $paramList["CUST_ID"] = $cust_id;   /// according to your logic
        $paramList["INDUSTRY_TYPE_ID"] = 'Retail109';
        $paramList["CHANNEL_ID"] = 'WEB';
        $paramList["TXN_AMOUNT"] = $total_price;
        $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
      
        $paramList["CALLBACK_URL"] = base_url('PaytmResponse');
        $paramList["MSISDN"] = '77777777'; //Mobile number of customer
        $paramList["EMAIL"] ='foo@gmail.com';
        $paramList["VERIFIED_BY"] = "EMAIL"; //
        $paramList["IS_USER_VERIFIED"] = "YES"; //
      //  print_r($paramList);
        $checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

        ?>

        <!--submit form to payment gateway OR in api environment you can pass this form data-->
      
        <form id="myForm" action="<?php echo PAYTM_TXN_URL ?>" method="post">
        <?php
         foreach ($paramList as $a => $b) {
        echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
       }
       ?>
            <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
        </form>
        <script type="text/javascript">
            document.getElementById('myForm').submit();
         </script>
    
<?php
    }
  
    /////////// response from paytm gateway////////////
    public function PaytmResponse()
    {
        $orderData=$this->session->userdata('order_data');
		$order_id=$orderData['order_no'];
        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";

        $paramList = $_POST;
        //echo "<pre>";
      //print_r($paramList);
      
      $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
//
        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
//
        if($isValidChecksum == "TRUE")
        {
            if ($_POST["STATUS"] == "TXN_SUCCESS")
            { 
                //echo "success";
                $this->General_model->update_payment($order_id);/// put your to save into the database // tansaction successfull
                //echo $this->db->last_query();
               //var_dump($paramList);
               $data['order_status'] = '<div class="jumbotron text-center">
        	<h1>Thank You!</h1>
        	<p><strong>Your order has been successfully placed</strong></p>
        	<hr>
        	<p><a class="btn btn-primary btn-sm" href="'. base_url() .'" role="button">Continue to homepage</a></p>
        	<div class="container">
        	<div class="row">
        	<div class="col-md-4 col-md-offset-4">
        		<ul class="list-group">
        		<li class="list-group-item">Order Id : #'.$_POST["ORDERID"].' </li>
        		<li class="list-group-item">Total Amount : '. $_POST["TXNAMOUNT"] .'</li>
        		<li class="list-group-item">Transaction Id : '. $_POST["TXNID"] .'</li>
        		</ul>
        	</div></div>
        	</div></div>';	
            }
           else { //echo "failed";
           $data['order_status'] = '<div class="jumbotron text-center">
        	<h1>Failed to get Payment!</h1>
        	<hr>
        	<p><a class="btn btn-primary btn-sm" href="'. base_url() .'" role="button">Continue to homepage</a></p>
        	<div class="container">
        	<div class="row">
        	<div class="col-md-4 col-md-offset-4">
        		<ul class="list-group">
        		<li class="list-group-item">Order Id : #'.$_POST["ORDERID"].' </li>
        		<li class="list-group-item">Total Amount : '. $_POST["TXNAMOUNT"] .'</li>
        		</ul>
        	</div></div>
        	</div></div>';
        
            
              //var_dump($paramList);
            }
      }else
       {//////////////suspicious
          echo " Somthing Went wrong";
//          
        }
        $this->template->render('pages/PaytmResponse', $data);
    }


	public function restaurant_rating(){

		$data=array(
			'user_id' =>$this->input->post('user_id') , 
			'res_id' =>$this->input->post('res_id') , 
			'rating' =>$this->input->post('rating') , 
		);

		$sql = $this->db->select('*')->from('restaurant_rating')->where('user_id',$data['user_id'])->where('res_id',$data['res_id'])->get()->num_rows();
		if($sql>0){
			echo "You have allready rated";
		}
		else{
			$this->db->insert('restaurant_rating',$data);

			echo "Your rating successfully done";
		}

		

	}
	public function calculate_distance(){
		$address_id=$this->input->post('address_id');
		$restaurant_id=$this->input->post('restaurant_id');
		$total_amount=$this->input->post('total_amount');
        
        $userdata=$this->session->userdata('user_data');
        
        $user_data = $this->db->select('*')->from('user')->where('id',$userdata[0]['id'])->get()->result_array();
        
        $todayDate = date('Y-m-d');
		$todayDate = date('Y-m-d', strtotime($todayDate));
		
		
		$res_data = $this->db->select('*')->from('restaurant')->where('id',$restaurant_id)->get()->result_array();
		$address_data = $this->db->select('*')->from('user_address')->where('id',$address_id)->get()->result_array();
		$tbl_setting = $this->db->select('*')->from('setting')->get()->result_array();
        //Calculate distance from latitude and longitude
		$latitudeFrom = $res_data[0]['lat'];
		$longitudeFrom = $res_data[0]['lang'];

		$latitudeTo = $address_data[0]['lat'];
		$longitudeTo = $address_data[0]['lng'];

		$theta = $longitudeFrom - $longitudeTo;
		$dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;

		$distance = ($miles * 1.609344).' km';
		$this->session->set_userdata('total_distance',$distance);
	

		if($user_data[0]['prime_member_start'] <= $todayDate && $user_data[0]['prime_member_end'] >= $todayDate){
		    //prime member
		   	$delivery_charges= '<b color="red">Prime Member</b>';
		   	$total_amount=$total_amount;
		} else {
		  	$delivery_charges= round($distance*$tbl_setting[0]['delivery_charge']); 
		  	$total_amount=$total_amount+$delivery_charges;
		}
		$this->session->set_userdata('delivery_charges',$delivery_charges);

		$arrayName = array('total_amount' =>$total_amount ,'delivery_charges'=>$delivery_charges);

		echo json_encode($arrayName);

	}


	public function get_total_distance($user_id=1){
		
		$order_data = $this->db->select('*')->from('order_new')->where('delivery_boy_id',$user_id)->where('order_status',4)->get()->result_array();
		$tbl_setting = $this->db->select('*')->from('setting')->get()->result_array();
		foreach ($order_data as $key) {
			$time=$key['delivery_date'];
			$time=explode(' ',$time);
			if (strtotime($time[1])<=strtotime('15:00:00')) {
				$total_distance=$total_distance+$key['total_distance'];

			}else{
				$total_distance2=$total_distance2+$key['total_distance'];
			}
		}
		echo "Day Shift Distance:  ".$total_distance;
		echo "<br>";
		echo "Total Amount Day Shift:  ".$total_amount=($total_distance/5)*$tbl_setting[0]['day_shift_payment'];
		echo "<br>";


		echo "Night Shift Distance:  ".$total_distance2;
		echo "<br>";
		echo "Total Amount Day Shift:  ".$total_amount2=($total_distance2/5)*($tbl_setting[0]['night_shift_payment']+$tbl_setting[0]['insentive']);

		echo "<br>";

		echo "Final Amount: ".$total_amount=$total_amount+$total_amount2;
		

		return(round($total_distance));
	}


	public function demo(){

		// echo $this->Pushnotification_for_vender->hello();

		// echo $this->Pushnotification->hello();
		$notification=new Pushnotification();
		echo $notification->hello();

		$notification_vender=new Pushnotification_for_vender();
		echo $notification_vender->hello();





		// $id=new GetProcessingUserID();
		// echo $res_id='44'; 
    	 // echo $id->get_id($res_id);
		// echo $this->get_id($res_id);
	}
	


	public function get_id($res_id){

		$date=date('y-m-d');
		$diffResult=array();
		$totalUser=array();
		$processUser=array();

		$result = $this->db->select('*')->from('tbl_delivery_boy_profile')->where("FIND_IN_SET('$res_id',restaurant_id) !=", 0)->where('availability',1)->get()->num_rows();


		if ($result>0) {

			$value = $this->db->select('*')->from('tbl_delivery_boy_profile')->where("FIND_IN_SET('$res_id',restaurant_id) !=", 0)->where('availability',1)->get()->result_array();
			foreach($value  as $line)
			{

				$totalUser[] = $line['id'];   
				$uid=$line['id'];

				$userResult = $this->db->select('*')->from('tbl_order_process_user')->where('user_id',$uid)->where('DATE(cdate)',$date)->get()->result_array();
				$processUser[] = $userResult[0]['user_id'];  
			}
			$diffResult ='';
			$diffResult=array_diff($totalUser,$processUser);

			if (!empty($diffResult)) {
				$uid= array_shift($diffResult);
				$data= array('user_id' =>$uid,);
				$this->db->insert('tbl_order_process_user',$data);
				return $uid;


			} else {

				$userResult1 = $this->db->select('user_id,total_order')->from('tbl_order_process_user')->where('DATE(cdate)',$date)->order_by('total_order',asc)->get()->result_array();

				$uid=$userResult1[0]["user_id"];

				$new_total_order=$userResult1[0]['total_order'] + 1;   

				$data2= array(
					'total_order' =>$new_total_order , 
				);

				$this->db->select();
				$this->db->from('tbl_order_process_user');
				$this->db->where('user_id',$userResult1[0]["user_id"]);
				$this->db->update('tbl_order_process_user',$data2);

				return $uid;


			}


		} else {

			return 0;

		}

	}

	public function get_delivery_boy_Location(){
		if($this->input->get('order_id')){
			$order_id=$this->input->get('order_id');
		}else{
		$order_id=$this->session->userdata('order_id');
		}
		$data['order_data'] = $this->db->select('*')->from('order_new')->where('order_no',$order_id)->get()->result_array();
		$data['del_status'] = $this->db->select('*')->from('delvery_boy_current_location')->where('user_id',$data['order_data'][0]['delivery_boy_id'])->get()->result_array();
		$this->template->render('pages/live-tracking',$data);



	}
public function get_delivery_boy_status(){

		$order_id=$this->input->post('order_id');
		$order_data = $this->db->select('*')->from('order_new')->where('order_no',$order_id)->get()->result_array();
		$delivery_boy_location = $this->db->select('*')->from('tbl_delvery_boy_current_location')->where('user_id',$order_data[0]['delivery_boy_id'])->get()->result_array();
		 echo json_encode($delivery_boy_location);
	}

}