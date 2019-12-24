<?php
header("Pragma: no-cache");

header("Cache-Control: no-cache");
header("Expires: 0");
  defined('BASEPATH') OR exit('No direct script access allowed');
  require_once(APPPATH."libraries/lib/config_paytm.php");
  require_once(APPPATH."libraries/lib/encdec_paytm.php");

  class Webservice extends CI_Controller 
  {
   /*user section*/
   const SPOON_SIGNUP                 = 101;
   const SPOON_LOGIN                  = 102;
   const SPOON_SOCIAL_LOGIN           = 103;
   const SPOON_CHANGEPASSWORD         = 104;
   const SPOON_FORGETPASSWORD         = 105;
   const SPOON_USER_DETAIL            = 106;
   const SPOON_EDIT_PROFILE           = 107;
   const SPOON_ADD_ADDRESS            = 108;
   const SPOON_EDIT_ADDRESS           = 109;
   const SPOON_DEL_ADDRESS            = 110;
   const USER_ORDER_LIST              = 111;
   const USER_ORDER_MENU_DETAIL       = 112;
   const RESTURANT_LISTING            = 113;
   const RESTURANT_DETAIL             = 114;
   const ADDRESS_LIST                 = 115;
   const REFFERAL_CODE                = 116;
   const BANNER                       = 117;
   const BOOK_TABLE_LIST              = 118;
   const GET_TABLE                    = 119;
   const SAVE_TABLE                   = 120;
   const ADD_TO_CART                  = 121;
   const CART_LIST                    = 122;
   const UPDATE_CART                  = 123;
   const DELETE_CART                  = 124;
   const EDIT_TABLE_LIST              = 125;
   const DELETE_TABLE_LIST            = 126;
   const USER_EDIT_PROFILE            = 127;
   const MAke_Favorite                = 128;
   const Favorite_res_list            = 129;
   const Apply_coupon                 = 130;
   const Apply_tax                    = 131;
   const Delivery_charge              = 132;
   const Order_palced                 = 133;
   const Wallet_blance                = 134;
   const App_version                  = 135;
   const Order_tracking               = 136;
   const restaurant_rating            = 137;
   const Last_Order                   = 138;
   const Checksum_generate            = 139;
   const Prime_membership_plan        = 140;
   const Prime_member_chksum          = 141;
   const Prime_member_payment_status  = 142;



   /*delivery boy Section*/

   const SPOON_DELIVIERY_LOGIN        = 201;
   const DELIVERY_BOY_ACTION          = 202;
   const DELIVERY_BOY_EDIT_PROFILE    = 203;
   const SHOW_PROFILE_DATA            = 204;
   const ASSIGN_NEW_ORDER_LIST        = 205;
   const SHOW_MENU_DETAIL             = 206;
   const DELIVERY_BOY_CHANGEPASSWORD  = 207;
   const ASSIGN_PROCESSING_ORDER_LIST = 208;
   const ASSIGN_DELIVERED_ORDER_LIST  = 209;
   const ACCEPT_TASK                  = 210;
   const DELIVERED_TASK               = 211;
   const SPOON_EDIT_PROFILE_FOR_IOS   = 212;
   const CREDIT_AMOUNT_TO_DELIVERY_BOY= 213;
   const ORDER_PAYMENT_LIST           = 214;
   const Get_AVILABILTY               = 215;
   const Current_lat_lng              = 216;
   const App_version_for_delivery_boy = 217;


   /*Vender Section*/

   const SPOON_VENDER_LOGIN          = 301;
   const VENDER_RESTURANT_LISTING    = 302;
   const INSERT_RESATURANT_PROFILE   = 303;
   const COUNTRY_LIST                = 304;
   const STATE_LIST                  = 305;
   const CITY_LIST                   = 306;
   const VENDER_BOOK_LIST            = 307;
   const VENDER_ORDER_LIST           = 308;
   const COUSINE_LIST                = 309;
   const ORDER_DETAIL                = 310;
   const RESATURANT_OFFER            = 311;
   const ADD_OFFER                   = 312;
   const DEL_OFFER                   = 313;
   const EDIT_OFFER                  = 314;
   const BOOKED_TABLE_IN_RES         = 315;
   const RES_MENU_LIST               = 316;
   const DEL_MENU_LIST               = 317;
   const MENU_LIST                   = 318;
   const CATEGORY_LIST               = 319;
   const SUB_CATEGORY_LIST           = 320;
   const ADD_RES_MENU                = 321;
   const UPDATE_RES_MENU             = 322;
   const MANAGE_BUDGET               = 323;
   const RES_TIME_LIST               = 324;
   const UPDATE_RESATURANT_PROFILE   = 325;
   const REVIEW_LIST                 = 326;
   const change_order_status         = 327;
   const RES_MENU_STATUS             = 328;
   const App_version_for_vender      = 329;





   public function __construct()
   {
    parent::__construct();
    $this->load->database();
    $this->load->model('General_model'); 
    //$this->load->model('Email_model');
    $this->load->library('email');
    $this->load->library('simpleimage');
    $this->load->library('pushnotification');
    $this->load->library('Pushnotification_for_vender');
    $this->load->library('Pushnotification_for_user');
    $this->load->library('cart');  
  }

  public function index()
  {
    $response = ''; 
    $request = $this->input->post('acid'); 
   //echo $request='102';
    switch ($request)
    {
      case self::SPOON_SIGNUP : $response                 = $this->signup(); break;
      case self::SPOON_LOGIN : $response                  = $this->login_post(); break;
      case self::SPOON_SOCIAL_LOGIN : $response           = $this->social_login(); break;
      case self::SPOON_CHANGEPASSWORD : $response         = $this->change_password(); break;
      case self::SPOON_FORGETPASSWORD : $response         = $this->forget_password(); break;
      case self::SPOON_USER_DETAIL    : $response         = $this->user_detail(); break;
      case self::SPOON_EDIT_PROFILE   : $response         = $this->edit_profile(); break;
      case self::SPOON_ADD_ADDRESS    : $response         = $this->add_address(); break;
      case self::SPOON_EDIT_ADDRESS   : $response         = $this->edit_address(); break;
      case self::SPOON_DEL_ADDRESS    : $response         = $this->del_address(); break;
      case self::USER_ORDER_LIST    : $response           = $this->user_order_list(); break;
      case self::USER_ORDER_MENU_DETAIL    : $response    = $this->user_order_menu(); break;
      case self::RESTURANT_LISTING    : $response         = $this->restaurant_listing(); break;
      case self::RESTURANT_DETAIL    : $response          = $this->restaurant_detailing(); break;
      case self::ADDRESS_LIST    : $response              = $this->address_list(); break;
      case self::REFFERAL_CODE    : $response             = $this->refferal_code(); break;
      case self::BANNER    : $response                    = $this->banner(); break;
      case self::BOOK_TABLE_LIST    : $response           = $this->user_book_table_list(); break;
      case self::GET_TABLE    : $response                 = $this->get_table(); break;
      case self::SAVE_TABLE    : $response                = $this->save_table(); break;
      case self::ADD_TO_CART    : $response               = $this->add_to_cart(); break;
      case self::CART_LIST     : $response                = $this->cart_list(); break;
      case self::UPDATE_CART: $response                   = $this->update_cart(); break;
      case self::DELETE_CART: $response                   = $this->delete_cart(); break;
      case self::EDIT_TABLE_LIST: $response               = $this->edit_table(); break;
      case self::DELETE_TABLE_LIST: $response             = $this->delete_table(); break;
      case self::DELETE_TABLE_LIST: $response             = $this->delete_table(); break;
      case self::USER_EDIT_PROFILE: $response             = $this->user_edit_profile(); break;
      case self::MAke_Favorite: $response                 = $this->make_favorite(); break;
      case self::Favorite_res_list: $response             = $this->favorite_res_list(); break;
      case self::Apply_coupon: $response                  = $this->Apply_coupon(); break;
      case self::Apply_tax: $response                     = $this->Apply_tax(); break;
      case self::Delivery_charge: $response               = $this->Delivery_charge(); break;
      case self::Order_palced: $response                  = $this->Order_palced(); break;
      case self::Wallet_blance: $response                 = $this->Wallet_blance(); break;
      case self::App_version: $response                   = $this->App_version(); break;
      case self::Order_tracking: $response                = $this->Order_tracking(); break;
        case self::restaurant_rating: $response             = $this->restaurant_rating(); break;
        case self::Last_Order: $response                    = $this->Last_Order(); break;
        case self::Checksum_generate: $response           = $this->Checksum_generate(); break;
      case self::Prime_membership_plan: $response         = $this->Prime_membership_plan(); break;
      case self::Prime_member_chksum: $response         = $this->Prime_member_chksum(); break;
      case self::Prime_member_payment_status: $response = $this->Prime_member_payment_status(); break;







      /*For Delivery Boy*/
      case self::SPOON_DELIVIERY_LOGIN: $response         = $this->delivery_boy_login(); break;
      case self::DELIVERY_BOY_ACTION  : $response         = $this->deliv_boy_action(); break;
      case self::DELIVERY_BOY_EDIT_PROFILE : $response    = $this->edit_delivery_boy_profile(); break;
      case self:: SHOW_PROFILE_DATA : $response           = $this->show_profile_data(); break;
      case self:: ASSIGN_NEW_ORDER_LIST : $response       = $this->assign_new_order_list(); break;
      case self:: SHOW_MENU_DETAIL : $response            = $this->show_menu_detail(); break;
      case self::DELIVERY_BOY_CHANGEPASSWORD : $response  = $this->delivery_boy_change_password(); break;
      case self::ASSIGN_PROCESSING_ORDER_LIST : $response = $this->assign_process_order_list(); break;
      case self::ASSIGN_DELIVERED_ORDER_LIST : $response  = $this->assign_delivered_order_list(); break;
      case self::ACCEPT_TASK : $response                  = $this->accept_task(); break;
      case self::DELIVERED_TASK : $response               = $this->delivered_task(); break;
      case self::SPOON_EDIT_PROFILE_FOR_IOS : $response   = $this->edit_delivery_boy_profile_for_ios(); break;
      case self::CREDIT_AMOUNT_TO_DELIVERY_BOY : $response   = $this->credit_amount_to_delivery_boy(); break;
      case self::ORDER_PAYMENT_LIST : $response           = $this->order_payment_list(); break;
      case self::Get_AVILABILTY : $response               = $this->get_avilability(); break;
      case self::Current_lat_lng : $response               = $this->Current_lat_lng(); break;
      case self::App_version_for_delivery_boy : $response               = $this->App_version_for_delivery_boy(); break;





      case self::SPOON_VENDER_LOGIN : $response             = $this->vender_login(); break;
      case self::VENDER_RESTURANT_LISTING : $response       = $this->vender_resaturants(); break;
      case self::INSERT_RESATURANT_PROFILE : $response      = $this->insert_resaturant_profile(); break;
      case self::COUNTRY_LIST : $response                   = $this->country_list(); break;
      case self::STATE_LIST : $response                     = $this->state_list(); break;
      case self::CITY_LIST : $response                      = $this->city_list(); break;
      case self::VENDER_BOOK_LIST : $response               = $this->vender_book_table_list(); break;
      case self::VENDER_ORDER_LIST : $response              = $this->vender_order_list(); break;
      case self::COUSINE_LIST :  $response                  = $this->cousine_list(); break;
      case self::ORDER_DETAIL :  $response                  = $this->order_detail(); break;
      case self::RESATURANT_OFFER :  $response              = $this->restaurant_offer(); break;
      case self::ADD_OFFER :  $response                     = $this->add_offer(); break;
      case self::DEL_OFFER :  $response                     = $this->del_offer(); break;
      case self::EDIT_OFFER :  $response                    = $this->update_offer(); break;
      case self::BOOKED_TABLE_IN_RES :  $response           = $this->book_table_list_in_res(); break;
      case self::RES_MENU_LIST :  $response                 = $this->res_menu_list(); break;
      case self::DEL_MENU_LIST :  $response                 = $this->del_res_menu(); break;
      case self::MENU_LIST :  $response                     = $this->menu_list(); break;
      case self::CATEGORY_LIST :  $response                 = $this->category_list(); break;
      case self::SUB_CATEGORY_LIST :  $response             = $this->sub_category_list(); break;
      case self::ADD_RES_MENU :  $response                  = $this->add_res_menu(); break;
      case self::UPDATE_RES_MENU :  $response               = $this->update_res_menu(); break;
      case self::MANAGE_BUDGET :  $response                 = $this->manage_res_budget(); break;
      case self::RES_TIME_LIST :  $response                 = $this->res_time_list(); break;
      case self::UPDATE_RESATURANT_PROFILE :  $response     = $this->update_resaturant_profile(); break;
      case self::REVIEW_LIST :  $response                   = $this->review_list(); break;
      case self::change_order_status :  $response           = $this->change_order_status(); break;
      case self::RES_MENU_STATUS :  $response               = $this->res_menu_status(); break;
      case self::App_version_for_vender : $response         = $this->App_version_for_vender(); break;
    } 
    echo json_encode($response);
  }


  public function droap_mail($from,$to,$subject,$msg)
  {

    $this->email->from($from,'SPOON');
    $this->email->to($to);
    $this->email->set_mailtype("html");
    $this->email->subject($subject);
    $this->email->message($msg);
    $this->email->send();
  }

  public function banner(){

   $response   =array();
   $result     =array();
   $data       = $this->input->post();
   if($data['acid']=='')
   {
    $response['status']=0;
    $response['message']="acid is required";
  }else
  {
    $inner_banner= $this->db->select('*')->from('inner_banner')->where('status',1)->get()->result_array();
    if(!empty($inner_banner))
    {
      foreach($inner_banner as $usr) { 

        $result['id']=$usr['id'];
        $result['title']=$usr['title'];
        $result['photo']=base_url().'upload_images/banner/'.$usr['photo'];
        $result['description']=$usr['description'];
        $result['target_url']=$usr['target_url'];
        $result['status']=$usr['status'];

        $a[]=$result;
      }

    }
    $response['status']=1;
    $response['message']='success';
    $response['inner-banner']=$a;
    return $response;
  }


}
    /*
       USER SIGNUP......
    */
       public function signup()
       {     

        $response = array();

        $user_data=array(
          'name' =>$this->input->post('name') ,
          'type' =>1,
          'username' =>$this->input->post('username') ,
          'email' =>$this->input->post('email') ,
          'mobile' =>$this->input->post('mobile') ,
          'password' =>$this->input->post('password') ,
          'status' =>1 ,
        );

        $user_data_signup = $user_data;
      //print_r($user_data_signup);die;
        $pswd = $user_data_signup['password'];
        $user_data_signup['password']=$pswd;
        $email_chk = $this->db->get_where('user',array('email'=>$user_data_signup['email']))->num_rows();


        if($user_data_signup['email']==''){
          $response['status'] = 0;
          $response['message'] = 'Invalid Data';
        }else if($email_chk>0){
          $response['status'] = 0;
          $response['message'] = 'This Email is already ragistered with us';
        }else{
          unset($user_data_signup['acid']);
          $status = $this->db->insert('user',$user_data_signup);
        // echo $this->db->last_query();die;
          unset($user_data_signup['password']);
          if($status==1)
          {   
            $user_id = $this->db->insert_id();
            $response['status']      =1;
            $response['user_id']     =$user_id;
            $response['user_detail'] =$user_data_signup;
            $response['message']     ='Your signup successfully';
          }
        }
        return $response;
      }


   /*
      function for user Login...
  */
      public function login_post()
      {
        $response           = array();
        $data               = array();
        $email              = $this->input->post('email');
        $password           = $this->input->post('password');
        $device_id          = $this->input->post('device_id');
        $device_type        = $this->input->post('device_type');

        if($email==''){
          $response['status'] = 0;
          $response['message'] = 'Email is Required';
        }else if($password==''){
          $response['status'] = 0;
          $response['message'] = 'Password is Required';
        }else if($device_id=='ass'){
          $response['status'] = 0;
          $response['message'] = 'Device Id is Required';
        }else if($device_type==''){
          $response['status'] = 0;
          $response['message'] = 'Device type is Required';
        }else{

          $token_id=array(
        'device_id'=>$device_id,
        'device_type'=>$device_type,
           );

          //$chk_login = $this->db->get_where('user',array('email'=>$email,'password'=>$password,'type'=>1))->num_rows();
          $chk_login = $this->db->select('
            *')
          ->from('user')
          ->where("(user.email = '$email' OR user.mobile = '$email')")
          ->where('password', $password)->get()->num_rows();
          if($chk_login>0)
          {   

            //$logger_details = $this->db->get_where('user',array('email'=>$email,'password'=>$password,'type'=>1))->result_array();
            $logger_details = $this->db->select('*')->from('user')->where("(user.email = '$email' OR user.mobile = '$email')")->where('password',$password)->get()->result_array();
	
            unset($logger_details[0]['password']);

            $this->db->where('user.email',$email);
            $this->db->update('user',$token_id);

            $response['status']      =1;
            $response['logger_details'] =$logger_details;
            $response['message']     ='logged in successfully';
          }else{
            $response['status'] = 0;
            $response['message'] = 'Please provide us valid creditial';
          }
        }
        return $response;
      }


     /*
      SOCIAL LOGIN & RAGISTRATION..
    */
      public function social_login()
      {
       $response = array();
       $social_details = $this->input->post();
       //print_r($social_details);die;

       if($social_details['acid']=='')
       {
         $response['status'] = 0;
         $response['message'] = 'acid id is required';
         
       }else if($social_details['appid']==''){
         $response['status'] = 0;
         $response['message'] = 'app id is required';
       }
       else if($social_details['name']==''){
         $response['status'] = 0;
         $response['message'] = 'name is required';
       }else if($social_details['email']==''){
         $response['status'] = 0;
         $response['message'] = 'email is required';
       }else{
         //print_r(array_keys($social_details));
         unset($social_details['acid']);
         $all_key = array_keys($social_details);
         if(in_array("facebook",$all_key))
         {
          if($social_details['facebook']==1)
          {
            unset($social_details['facebook']);
            $social_details['appname']="facebook";
          }
        }else{
         if($social_details['googleplus']==1)
         {
           unset($social_details['googleplus']);
           $social_details['appname']="googleplus";
         }
       }
         //SOCIAL LOGIN LOGIC......
       $email_chk = $this->db->get_where('user',array('email'=>$social_details['email']))->num_rows();
       if($email_chk>0)
       {
            //UPDATE...
        $userdata = $this->db->get_where('user',array('email'=>$social_details['email']))->result_array();
            //print_r($userdata);die;
        $this->db->update('user',$social_details, array('id' =>$userdata[0]['id']));
        $updated_record = $this->db->get_where('user',array('id'=>$userdata[0]['id']))->result_array();
        unset($updated_record[0]['gender'],$updated_record[0]['password'],$updated_record[0]['city'],$updated_record[0]['country'],$updated_record[0]['pin'],$updated_record[0]['ip']);

        $social_details['user_id']= $userdata[0]['id'];
        $response['success']      = 1;
        $response['login']        = $updated_record;
        $response['message']      = 'Login successfully';
      }else{
            //INSERT..

        $status_chk = $this->db->insert('user',$social_details);

            //echo $this->db->last_query();die;
        if($status_chk==1)
        {   

          $user_id = $this->db->insert_id();


          $social_details['user_id']= $user_id;
          $response['success']      = 1;
          $response['login']      = $social_details;
          $response['message']      = 'Login successfully';
        }
            //print_r($response);die;
      }

    }
    return $response;
  }
     /*
    function to change the password..
   */
    public function change_password()
    {  

      /*acid:104
      user_id:100001
      old_password:123
      new_password:123456 */
      $response      = array();
      $change_password = $this->input->post();
      if($change_password['acid']=='')
      {
        $response['status'] = 0;
        $response['message'] = 'acid id is required';
      }else if($change_password['old_password']=='')
      {
        $response['status'] = 0;
        $response['message'] = 'old password required';
      }else if($change_password['user_id']=='')
      {
        $response['status'] = 0;
        $response['message'] = 'user id required';
      }else if($change_password['new_password']=='')
      {
        $response['status'] = 0;
        $response['message'] = 'New password required';
      }else{
        unset($change_password['acid']);
        $user_info = $this->db->get_where('user',array('id'=>$change_password['user_id']))->result_array();
            //echo $this->db->last_query(); die;
        if($user_info[0]['password']==$change_password['old_password'])
        {  

          $data = array('password'=>$change_password['new_password']);
          $this->db->update('user',$data, array('id' =>$change_password['user_id']));

          $response['status'] = 1;
          $response['message'] = 'password updated successfully';
        }else{
         $response['status'] = 0;
         $response['message'] = 'Old password does not matched';
       }
            //print_r($user_info);die;
     }
     return $response;
   }


   public function user_edit_profile(){


    $response      = array();
      $data = $this->input->post();
      if($data['acid']=='')
      {
        $response['status'] = 0;
        $response['message'] = 'acid id is required';
      }else{
        unset($data['acid']);
        $chk_login = $this->db->get_where('user',array('id'=>$data['user_id']))->num_rows();
          if($chk_login>0)
          {   
            $id=$data['user_id'];
          unset($data['user_id']);


          $this->db->update('user',$data, array('id' =>$id));

          $response['status'] = 1;
          $response['message'] = 'record updated successfully';
        }else{
         $response['status'] = 0;
         $response['message'] = 'No Any user';
       }
            //print_r($user_info);die;
     }
     return $response;



   }

    /*
     FORGET PASSWORD...
    */
     public function forget_password()
     {

      $response      = array();
      $forget_password = $this->input->post();
      if($forget_password['acid']=='')
      {
        $response['status'] = 0;
        $response['message'] = 'acid id is required';
      }else if($forget_password['email']=='')
      {
        $response['status'] = 0;
        $response['message'] = 'email is required';
      }else{
        unset($forget_password['acid']);
        $result = $this->db->get_where('user',array('email'=>$forget_password['email']))->result_array();
        if(sizeof($result)>0)
        {

         $password = rand();
         $md_password = $password;
         $data = array('password'=>$md_password);
         $this->db->update('user', $data, array('email'=>$forget_password['email']));
         $from="manojpal@adarshinfosolutions.com";
         $to = $forget_password['email'];
         $subject="forget password";
         $new_password['password']=$password;
         $new_password['name']=$result[0]['name'];
         $msg = $this->load->view('forget_pswd_email_msg',$new_password,true);
         $this->droap_mail($from,$to,$subject,$msg);


         $response['status'] = 1;
         $response['message'] = 'Please check your mail for new password';

       }else{
         $response['status'] = 0;
         $response['message'] = 'Sorry this email id not ragistered with us';
       }
     }
     return $response;
   }

   public function user_detail()
   {

    $response   =array();
    $result     =array();
    $data       = $this->input->post();
    if($data['acid']=='')
    {
      $response['status']=0;
      $response['message']="acid is required";
    }
    else if($data['user_id']=='')
    {
      $response['status'] = 0;
      $response['message'] = 'User id is required';
    }
    else
    {

      //$user_details=$this->db->get_where('user', array('id'=>$data['user_id'],'status'=>'1'))->result_array();
      $id=$data['user_id'];
      $user_details=$this->db->query("SELECT tbl_restaurant.img, tbl_user.* from tbl_restaurant right JOIN tbl_user on tbl_restaurant.user_id=tbl_user.id where tbl_user.id='$id'")->result_array();
      if(!empty($user_details))
      {
        foreach($user_details as $usr) { 

          $result['user_id']=$usr['id'];
          $result['name']=$usr['name'];
          $result['email']=$usr['email'];
          $result['mobile']=$usr['mobile'];
          $result['area']=$usr['area'];
          $result['location']=$usr['location'];
          $result['lat']=$usr['lat'];
          $result['lng']=$usr['lng'];
          $result['img']=base_url()."upload_images/cuisine/".$usr['img'];
          
        }

      }
      $response['status']=1;
      $response['message']='success';
      $response['user-details']=$result;
      return $response;
    }
  }

  public function edit_profile()
  {

    $response   =array();
    $data       = $this->input->post();
        //print_r($data); die;
    if($data['acid']=='')
    {
      $response['status']=0;
      $responce['message']="acid is required";
    }
    else if($data['mobile']=='' AND $data['name']=='')
    {
      $response['status']=0;
      $response['message']='Name, Email and Phone are required';
    }
    else
    {
      $user_id=$data['user_id'];
      unset($data['acid']);
      unset($data['user_id']);
                // if(!empty($data['userFiles'])){
                //   $img = $this->base_64img_single();
                //   $data['profile_pic']=$img;
                //   unset($data['userFiles']);
                // }
      $this->db->set($data);
      $this->db->where('id',$user_id);
      $this->db->update('user',$data);
                //echo $this->db->last_query(); die;
      $response['status'] = 1;
      $response['message'] = 'Update successfully';

    }
    return $response;
  }

  public function address_list(){


    $response   =array();
    $data       = $this->input->post();
    if($data['acid']=='')
    {
      $response['status']=0;
      $responce['message']="acid is required";
    }
    else if($data['user_id']=='')
    {
      $response['status']=0;
      $response['message']='User id is required';
    }
    else
    {

      $rows=$this->db->select('*')->from('user_address')->where('user_id',$data['user_id'])->get()->num_rows();

      if($rows>0){
        $address=$this->db->select('*')->from('user_address')->where('user_id',$data['user_id'])->get()->result_array();
        $response['message'] = 'Address List';
        $response['address_list'] =$address;
        $response['status'] = 1;


      }else{

        $response['message'] = 'Address List empty';
        $response['status'] = 1;

      }
      


    }
    return $response;

  }

  public function add_address()
  {

    $response   =array();
    $data       = $this->input->post();
    if($data['acid']=='')
    {
      $response['status']=0;
      $responce['message']="acid is required";
    }
    else if($data['user_id']=='')
    {
      $response['status']=0;
      $response['message']='User id is required';
    }
    else if($data['area']=='' || $data['location']=='' || $data['address_type']=='' )
    {
      $response['status']=0;
      $response['message']='Area,Locaiton,Address Type are required';
    }
    else
    {
      unset($data['acid']);
      $data['location']=$data['location'].','.$data['flat'].','.$data['landmark'];
      unset($data['flat']);
      unset($data['landmark']);
      $status = $this->db->insert('user_address',$data);
      $data['id'] = $this->db->insert_id();
      $response['status'] = 1;
      $response['details'] = $data;
      $response['message'] = 'Address added successfully';

    }
    return $response;
  }

  public function edit_address()
  {

    $response   =array();
    $data       = $this->input->post();
    if($data['acid']=='')
    {
      $response['status']=0;
      $responce['message']="acid is required";
    }
    else if($data['id']=='')
    {
      $response['status']=0;
      $response['message']='Address id is required';
    }
    else if($data['area']=='' || $data['location']=='' || $data['address_type']=='' )
    {
      $response['status']=0;
      $response['message']='Area,Locaiton,Address Type are required';
    }
    else
    {
      unset($data['acid']);
      $id = $data['id'];
      unset($data['id']);
      $this->db->set($data);
      $this->db->where('id',$id);
      $this->db->update('user_address',$data);
      $response['status'] = 1;
      $response['message'] = 'Address updated successfully';

    }
    return $response;
  }

  public function del_address()
  {

    $response   =array();
    $data       = $this->input->post();
    if($data['acid']=='')
    {
      $response['status']=0;
      $responce['message']="acid is required";
    }
    else if($data['id']=='')
    {
      $response['status']=0;
      $response['message']='Address id is required';
    }

    else
    {
      $id = $data['id'];
      $this->db->where('id',$id);
      $this->db->delete('user_address');
                //echo $this->db->last_query();
      $response['status'] = 1;
      $response['message'] = 'Delete address successfully';

    }
    return $response;
  }


  public function user_order_list(){


    $response           = array();
    $data               = array();
    $user_id             = $this->input->post('user_id');
    if($user_id==''){
      $response['status'] = 0;
      $response['message'] = 'user_id is required';
    }else{
      $chk_login = $this->db->get_where('order_new',array('user_id'=>$user_id))->num_rows();
      if($chk_login>0)
      {  

        $result= $this->db->select('*')->from('order_new')->where('user_id',$user_id)->get()->result_array();
        foreach ($result as $key) {
         $order_data= $this->db->select('*')->from('order_new')->where('id',$key['id'])->get()->result_array();
         $user_data= $this->db->select('*')->from('user')->where('id',$order_data[0]['user_id'])->get()->result_array();
         $res_data= $this->db->select('*')->from('restaurant')->where('id',$order_data[0]['restaurant_id'])->get()->result_array();

         $response['status']      =1;
        // $response['logger_details'] =$logger_details;
         $delivery_data = array(
          'order_no' => $order_data[0]['order_no'] ,
          'restauran_name' => $res_data[0]['r_name'] ,
          'name' => $user_data[0]['name'] ,
          'phone' => $user_data[0]['mobile'] ,
          'delivery_address' =>$order_data[0]['delivery_address'] ,
          'address_type' => $order_data[0]['address_type'] ,
          'delivery_charges' => $order_data[0]['delivery_charges'] ,
          'discount_amount' => $order_data[0]['discount_amount'] ,
          'gst_amount' => $order_data[0]['gst_amount'] ,
          'total_amount' => $order_data[0]['total_amount'] ,
          'delivery_date' => $order_data[0]['delivery_date'] ,
          'order_status' => $order_data[0]['order_status'] ,
          'payment_method' => $order_data[0]['payment_method'],
          'payment_status' => $order_data[0]['payment_status']
        );
         $a[]=$delivery_data;
       }    

       $response['order_data']=$a;
       $response['message']     ='Success';
     }else{
      $response['status'] = 0;
      $response['message'] = 'No Data';
    }
  }
  return $response;



}

public function user_order_menu(){

  $response           = array();
  $data               = array();
  $order_id             = $this->input->post('order_id');
  if($order_id==''){
    $response['status'] = 0;
    $response['message'] = 'oder id is required';
  }else{
    $chk_login = $this->db->get_where('order_itmes',array('order_id'=>$order_id))->num_rows();
    if($chk_login>0)
    {  

      $result= $this->db->select('*')->from('order_itmes')->where('order_id',$order_id)->get()->result_array();
      $response['status']      =1;
      $response['Show items'] =$result;
      $response['message']     ='Success';
    }else{
      $response['status'] = 1;
      $response['message'] = 'No Menu item';
    }
  }
  return $response;


}
public function restaurant_listing(){

  $response           = array();
  $data               = array();
  $lat             = $this->input->post('lat');
  $lng             = $this->input->post('lng');
  $page             = $this->input->post('page_no');
  if($lat==''){
    $response['status'] = 0;
    $response['message'] = 'Latitude is required';
  }elseif ($lng=='') {
    $response['status'] = 0;
    $response['message'] = 'Lognitude is required';
  }/*elseif ($page=='') {
    $response['status'] = 0;
    $response['message'] = 'Page_no is required';
  }*/
  else{

   $date=date('y/m/d');

   $today_day=date('w') + 1;
  date_default_timezone_set('Asia/Calcutta');
  $current_time= date('H:i');
  $res_time= array();
  /*if($page){
    $page=$page*5;LIMIT 0 , $page
    }*/
    
   $sql = $this->db->query("SELECT
    a.id,a.r_name,a.r_phone,a.r_address,a.budget,a.r_website,a.min_order,a.delivery_time,a.offer,a.for_two,a.rating,a.user_id,a.lat,a.lang,a.img,b.end_package_date, (
    6371 * acos (
    cos ( radians($lat) )
  * cos( radians( a.lat ) )
  * cos( radians( a.lang ) - radians($lng) )
    + sin ( radians($lat) )
  * sin( radians( a.lat ) )
    )
    ) AS distance
    FROM tbl_restaurant as a join tbl_user as b on a.user_id=b.id where a.status=1  
    HAVING distance < 200
    ORDER BY distance ");
    

   $res=array();
   $data= $sql->result_array();
   foreach ($data as $key) {

    $res_time= $this->db->select('*')->from('restaurant_time')->where('day',$today_day)->where('r_id',$key['id'])->get()->result_array();

if(!empty($res_time[0]['open_time']) && !empty($res_time[0]['close_time'])){

    if( $current_time >= $res_time[0]['open_time']  &&  $current_time <= $res_time[0]['close_time']){
    
      $res['opening_status']='open';
      $res['open_time']=$res_time[0]['open_time'];
    $res['close_time']=$res_time[0]['close_time'];

    }else if($res_time[0]['close_time']<=$res_time[0]['open_time'] && $current_time>=$res_time[0]['open_time']){
    
      $res['opening_status']='open';
      $res['open_time']=$res_time[0]['open_time'];
    $res['close_time']=$res_time[0]['close_time'];

    }else{
      $res['opening_status']='close';
      $res['open_time']=$res_time[0]['open_time'];
    $res['close_time']=$res_time[0]['close_time'];
    }
}
    $res['id']=$key['id'];
    $res['r_name']=$key['r_name'];
    $res['r_phone']=$key['r_phone'];
    $res['r_address']=$key['r_address'];
    $res['budget']=$key['budget'];
    $res['r_website']=$key['r_website'];
    $res['min_order']=$key['min_order'];
    $res['delivery_time']=$key['delivery_time'];
    $res['offer']=$key['offer'];
    $res['for_two']=$key['for_two'];
    $res['rating']=$key['rating'];
    $res['user_id']=$key['user_id'];
    $res['lat']=$key['lat'];
    $res['lang']=$key['lang'];
    
    $res['img']=base_url()."upload_images/cuisine/".$key['img'];

    $a[]=$res;
  }

  
  if($data){  
    $response['status']      =1;
    $response['res_list'] =$a;
    $response['message']     ='Success';
  }else{
    $response['status'] = 0;
    $response['message'] = 'Restaurant not avilable';
  }

}

return $response;


}


public function restaurant_detailing(){


 $response           = array();
 $data                = array();
 $total_rating         = '';
 $r_id             = $this->input->post('res_id');
 if($r_id==''){
  $response['status'] = 0;
  $response['message'] = 'Restaurant id  is required';
}else{


  $menu=$sql = $this->db->select('*')->from('restaurant_item')->where('restaurant_id',$r_id)->where('status',1) ->get()->result_array();
  $restaurant=$sql = $this->db->select('*')->from('restaurant')->where('id',$r_id)->get()->result_array();


  $rating=$sql = $this->db->select('rating')->from('restaurant_rating')->where('res_id',$r_id)->get()->result_array();

  if($rating) {
    foreach ($rating as $key) {
      $total_rating=(float)$total_rating + (float)$key['rating'];
    }

    $overall_rating= round((float)$total_rating/count($rating));
  }else{

    $overall_rating=0;

  }


  foreach ($menu as $key) {

   $sql= $this->db->select('*')->from('menu')->where('id',$key['menu_name'])->where('status',1) ->get()->result_array();
// print_r($sql);
   $menu_data['id']             = $key['id'];
   $menu_data['restaurant_id']  = $key['restaurant_id'];
   $menu_data['menu_id']        = $key['menu_name'];
   $menu_data['menu_name']      =$sql[0]['menu_name'];
   $menu_data['qty']              =1;
   $menu_data['menu_price']     = $key['menu_price'];
   $menu_data['actual_price']   = $key['actual_price'];
   $menu_data['cuisine_id']     = $key['cuisine_id'];
   $menu_data['cat_id']         = $key['cat_id'];
   $menu_data['sub_cat_id']     = $key['sub_cat_id'];
   $menu_data['menu_type']      = $key['menu_type'];
   $menu_data['m_discription']  = $key['m_discription'];
   $menu_data['popular_dish']   = $key['popular_dish'];
   $menu_data['spicy_dish']     = $key['spicy_dish'];
   $menu_data['img']            = base_url()."upload_images/cuisine/".$key['img'];
   $b[]=$menu_data;

 }


 foreach ($restaurant as $key) {


  $res['id']=$key['id'];
  $res['r_name']=$key['r_name'];
  $res['r_phone']=$key['r_phone'];
  $res['r_address']=$key['r_address'];
  $res['budget']=$key['budget'];
  $res['r_website']=$key['r_website'];
  $res['min_order']=$key['min_order'];
  $res['delivery_time']=$key['delivery_time'];
  $res['offer']=$key['offer'];
  $res['for_two']=$key['for_two'];
  $res['rating']=$key['rating'];
  $res['user_id']=$key['user_id'];
  $res['lat']=$key['lat'];
  $res['lang']=$key['lang'];
  $res['img']=base_url()."upload_images/cuisine/".$key['img'];
  $a[]=$res;
  
}


$this->db->select('c.name,c.id');
$this->db->from('restaurant a'); 
$this->db->join('restaurant_cuisine b', 'b.res_id=a.id', 'right');
$this->db->join('cuisine c', 'c.id=b.cuisine_id', 'right');
$this->db->where('a.id=',$r_id);

$res_cuisine= $this->db->get()->result_array(); 

$this->db->select('a.menu_name,b.category,b.id');
$this->db->from('restaurant_item a'); 
$this->db->join('category b', 'b.id=a.cat_id', 'right');
$this->db->where('a.restaurant_id=',$r_id);
$this->db->group_by('b.id','desc');         
$res_category= $this->db->get()->result_array();

// print_r($res_category);

$menuarr= array();
foreach ($res_category as $key) {
  $catarr['cat_name']=$key['category'];
//   print_r($menu);
//   die;
  foreach ($menu as  $value) {
    if($value['cat_id']==$key['id']){
      $sql= $this->db->select('*')->from('menu')->where('id',$value['menu_name'])->where('status',1) ->get()->result_array();

      $menuarr['menu_id']=$sql[0]['id'];
      $menuarr['restaurant_id']=$value['restaurant_id'];
      $menuarr['menu_data']=$sql[0]['menu_name'];
      $menuarr['qty']=1;
      $menuarr['menu_price']=$value['menu_price'];
      $menuarr['cuisine_id']=$value['cuisine_id'];
      $menuarr['cat_id']=$value['cat_id'];
      $menuarr['sub_cat_id']=$value['sub_cat_id'];
      $menuarr['menu_type']=$value['menu_type'];
      $menuarr['m_discription']=$value['m_discription'];
      $menuarr['popular_dish']=$value['popular_dish'];
      $menuarr['spicy_dish']=$value['spicy_dish'];
      $menuarrb[]=$menuarr;
    }

  }

  $catarr['menu_name']=$menuarrb;
  $catarrb[]=$catarr;
} 

$this->db->select('b.sub_category,b.id,,a.cat_id');
$this->db->from('restaurant_item a'); 
$this->db->join('sub_category b', 'b.id=a.sub_cat_id', 'right');
$this->db->where('a.restaurant_id=',$r_id);
$this->db->group_by('b.id','desc');   
$res_sub_category= $this->db->get()->result_array(); 



if($menu){  
  $response['status']      =1;
  $response['res_data'] =$a;
  $response['menu_list'] =$b;
  // $response['res_category'] =$res_category;
  $response['res_category'] =$catarrb;
  $response['res_sub_category'] =$res_sub_category;
  $response['res_cuisine'] =$res_cuisine;
  $response['rating'] =$overall_rating;
  $response['message']     ='Success';
}else{
  $response['status'] = 0;
  $response['res_data'] =$a;
  $response['res_cuisine'] =$res_cuisine;
  $response['rating'] =$overall_rating;
  $response['message'] = 'Menu not avilable';
}

}

return $response;

}

public function refferal_code(){

  $response   =array();
  $result     =array();
  $data       = $this->input->post();
  if($data['acid']=='')
  {
    $response['status']=0;
    $response['message']="acid is required";
  }
  else if($data['user_id']=='')
  {
    $response['status'] = 0;
    $response['message'] = 'User id is required';
  }
  else
  {

    $refferal_code1=$this->db->select('*')->from('referral_code')->where('u_id',$data['user_id'])->get()->result_array();

    $refferal_code=$refferal_code1[0]['referral_code'];

    $response['status']=1;
    $response['message']='success';
    $response['refferal_code']=$refferal_code;
    return $response;
  }


}

public function user_book_table_list(){


  $response   =array();
  $result     =array();
  $data       = $this->input->post();
  if($data['acid']=='')
  {
    $response['status']=0;
    $response['message']="acid is required";
  }
  else if($data['user_id']=='')
  {
    $response['status'] = 0;
    $response['message'] = 'User id is required';
  }
  else
  {
    unset($data['acid']);
    $bokking_data = $this->db->select('*')->from('bookiing')->where('user_id',$data['user_id'])->get()->result_array();
    // print_r($bokking_data);
    if($bokking_data){
      foreach ($bokking_data as $key) {

        $res_data=$this->db->select('*')->from('restaurant')->where('id',$key['res_id'] )->where('status',1)->get()->result_array();

        $data['id']=$key['id'];
        $data['res_name']=$res_data[0]['r_name'];
        $data['no_of_table']=$key['no_of_tables'];
        $data['date']=$key['date'];
        $data['time']=$key['time'];
        $a[] =$data ;                                 
      }

        $response['status']=1;
    $response['message']='success';
    $response['Bokking_List']=$a;
    }else{
      $response['status']=0;
    $response['message']='No record';
    }

  
    return $response;
  }



}

public function get_table(){

 $response   =array();
 $result     =array();
 $data       = $this->input->post();
 if($data['acid']=='')
 {
  $response['status']=0;
  $response['message']="acid is required";
}
else if($data['res_id']=='')
{
  $response['status'] = 0;
  $response['message'] = 'Reataurant id is required';
}else if($data['date']=='')
{
  $response['status'] = 0;
  $response['message'] = 'Date is required';
}
else
{

  $total_no_of_table='';

  $r_data=$sql = $this->db->select('*')->from('restaurant')->where('id',$data['res_id'])->where('status',1)->get()->result_array();
  $table=$r_data[0]['no_of_table'];

  $bookiing_data= $this->db->select('*')->from('bookiing')->where('res_id',$this->input->post('res_id'))->where('date',$data['date'])->get()->result_array();
  foreach ($bookiing_data as $key) {
    $total_no_of_table=(float)$total_no_of_table+(float)$key['no_of_tables'];
  }
  $table=(float)$table-(float)$total_no_of_table;

  $response['status']=1;
  $response['message']='success';
  $response['avilable_table']=$table;
  return $response;
}




}
public function save_table(){

 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}
else if($data['user_id']=='')
{
  $response['status']=0;
  $response['message']='User id are required';
}else if($data['date']=='')
{
  $response['status']=0;
  $response['message']='Date name are required';
}else if($data['time']=='')
{
  $response['status']=0;
  $response['message']='Time are required';
}else if($data['res_id']=='')
{
  $response['status']=0;
  $response['message']='Restaurant  are required';
}

else if($data['no_of_tables']=='')
{
  $response['status']=0;
  $response['message']='Table are require  are required';
}

else
{
  unset($data['acid']);

  $data=$this->input->post();
  unset($data['acid']);

  $this->db->insert('bookiing',$data);


  $response['status'] = 1;
  $response['message'] = 'Insert successfully';

}
return $response;
}


public function add_to_cart(){

 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}else if($data['user_id']=='')
{
  $response['status']=0;
  $response['message']='User id are required';
}
else if($data['menu_id']=='')
{
  $response['status']=0;
  $response['message']='menu id are required';
}else if($data['r_id']=='')
{
  $response['status']=0;
  $response['message']='r_id  are required';
}else if($data['qty']=='')
{
  $response['status']=0;
  $response['message']='menu_qnt are required';
}else if($data['price']=='')
{
  $response['status']=0;
  $response['message']='menu_price  are required';
}
else
{

  unset($data['acid']);
  $data['status']=1;

  $rows=$this->db->select('')->from('temp_cart')->where('r_id',$data['r_id'])->where('menu_id',$data['menu_id'])->get()->num_rows();
  //print_r($rows);
    if($rows>0){

      $this->db->select('*');
     $this->db->from('temp_cart'); 
     $this->db->where('menu_id',$data['menu_id']);
     $this->db->where('user_id',$data['user_id']);
     $this->db->update('temp_cart',$data);
    $response['status'] = 1;
    $response['message'] = 'Update successfully';

    }else{
    $this->db->insert('temp_cart',$data);
    $response['status'] = 1;
    $response['message'] = 'Insert successfully';
      
    }


}

return $response;
}
public function cart_list(){

  $response   =array();
  $result     =array();
  $data       = $this->input->post();
  
  if($data['acid']=='')
  {
    $response['status']=0;
    $response['message']="acid is required";
  }
  else if($data['user_id']=='')
  {
    $response['status'] = 0;
    $response['message'] = 'User id is required';
  }
  else
  {
    unset($data['acid']);
    $rows = $this->db->select('*')->from('temp_cart')->where('user_id',$data['user_id'])->where('status',1)->where('qty!=',0)->get()->num_rows();

 if($rows>0){
    $cart_data = $this->db->select('*')->from('temp_cart')->where('user_id',$data['user_id'])->where('status',1)->where('qty!=',0)->get()->result_array();
    foreach ($cart_data as $key) {

      $menu_data=$this->db->select('*')->from('menu')->where('id',$key['menu_id'])->get()->result_array();
      //print_r($menu_data);
      $data['id']=$key['id'];
      $data['menu']=$menu_data[0]['menu_name'];
      $data['qty']=$key['qty'];
      $data['r_id']=$key['r_id'];
      $data['price']=$key['price'];
      $a[] =$data ;                                 
    }

    $response['status']=1;
    $response['message']='success';
    $response['Cart_List']=$a;
  }else{
    $response['status']=0;
    $response['message']='Empty List';
    
    }  



  }
    return $response;


}

public function update_cart(){
  $response   =array();
  $data       = $this->input->post();
        // print_r($data); die;
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }else if($data['id']=='')
  {
    $response['status']=0;
    $response['message']='Id are required';
  }else if($data['user_id']=='')
  {
    $response['status']=0;
    $response['message']='User Id are required';
  }
  else if($data['qty']=='')
  {
    $response['status']=0;
    $response['message']='menu_qnt are required';
  }
  else
  {
    unset($data['acid']);
    unset($data['status']);
    if($data['qty']==0){

      $this->db->select('*');
      $this->db->from('temp_cart'); 
      $this->db->where('id',$data['id']);
      $this->db->where('user_id',$data['user_id']);
      $this->db->delete('temp_cart'); 
    }else{
     $this->db->select('*');
     $this->db->from('temp_cart'); 
     $this->db->where('id',$data['id']);
     $this->db->where('user_id',$data['user_id']);
     $this->db->update('temp_cart',$data);
   }

   $response['status'] = 1;
   $response['message'] = 'Update successfully';
 }

 return $response;


}

public function delete_cart(){

 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}else if($data['id']=='')
{
  $response['status']=0;
  $response['message']='Id are required';
}else if($data['user_id']=='')
{
  $response['status']=0;
  $response['message']='User Id are required';
}
else
{
  unset($data['acid']);
  unset($data['status']);
  $this->db->select('*');
  $this->db->from('temp_cart'); 
  $this->db->where('id',$data['id']);
  $this->db->where('user_id',$data['user_id']);

  $this->db->delete('temp_cart');
       // echo $this->db->last_query();

  $response['status'] = 1;
  $response['message'] = 'Deleted successfully';
}

return $response;



}

public function edit_table(){



 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}else if($data['id']=='')
{
  $response['status']=0;
  $response['message']='Id are required';
}
else if($data['user_id']=='')
{
  $response['status']=0;
  $response['message']='User id are required';
}else if($data['date']=='')
{
  $response['status']=0;
  $response['message']='Date name are required';
}else if($data['time']=='')
{
  $response['status']=0;
  $response['message']='Time are required';
}else if($data['res_id']=='')
{
  $response['status']=0;
  $response['message']='Restaurant  are required';
}
else if($data['no_of_tables']=='')
{
  $response['status']=0;
  $response['message']='Table are require  are required';
}

else
{

  $data=$this->input->post();
  unset($data['acid']);


  $this->db->select('*');
  $this->db->from('bookiing'); 
  $this->db->where('id',$data['id']);
  $this->db->where('user_id',$data['user_id']);
  $this->db->update('bookiing',$data);

  // $this->db->insert('bookiing',$data);


  $response['status'] = 1;
  $response['message'] = 'Update successfully';

}
return $response;


}

public function delete_table(){


 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}else if($data['id']=='')
{
  $response['status']=0;
  $response['message']='Id are required';
}
else if($data['user_id']=='')
{
  $response['status']=0;
  $response['message']='User id are required';
}
else
{

  $data=$this->input->post();
  unset($data['acid']);


  $this->db->select('*');
  $this->db->from('bookiing'); 
  $this->db->where('id',$data['id']);
  $this->db->where('user_id',$data['user_id']);
  $this->db->delete('bookiing');



  $response['status'] = 1;
  $response['message'] = 'Delete successfully';

}
return $response;



}

public function make_favorite(){

   $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}else if($data['user_id']=='')
{
  $response['status']=0;
  $response['message']='User id are required';
}else if($data['r_id']=='')
{
  $response['status']=0;
  $response['message']='r_id  are required';
}else if($data['status']=='')
{
  $response['status']=0;
  $response['message']='status are required';
}
else
{

  unset($data['acid']);

  $rows=$this->db->select('')->from('favorite')->where('r_id',$data['r_id'])->where('user_id',$data['user_id'])->get()->num_rows();

    if($rows>0){

      $this->db->select('*');
      $this->db->from('favorite'); 
      $this->db->where('user_id',$data['user_id']);
      $this->db->where('r_id',$data['r_id']);
      $this->db->update('favorite',$data);
    $response['status'] = 1;
     $response['like_status']=$data['status'];
    $response['message'] = 'Update successfully';

    }else{
    $this->db->insert('favorite',$data);
    $response['status'] = 1;
     $response['like_status']=$data['status'];
    $response['message'] = 'Insert successfully';
      
    }


}

return $response;

}

public function favorite_res_list()
{

  $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}else if($data['user_id']=='')
{
  $response['status']=0;
  $response['message']='User id are required';
}
else
{

  unset($data['acid']);

  $rows=$this->db->select('')->from('favorite')->where('user_id',$data['user_id'])->where('status',1)->get()->num_rows();

    if($rows>0){

    $favorite=$this->db->select('')->from('favorite')->where('user_id',$data['user_id'])->where('status',1)->get()->result_array();

    foreach ($favorite as $key) {
    $res_data=$this->db->select('*')->from('restaurant')->where('id',$key['r_id'])->where('status',1)->get()->result_array();

   $res=array();


    $res['id']=$res_data[0]['id'];
    $res['r_name']=$res_data[0]['r_name'];
    $res['r_phone']=$res_data[0]['r_phone'];
    $res['r_address']=$res_data[0]['r_address'];
    $res['budget']=$res_data[0]['budget'];
    $res['r_website']=$res_data[0]['r_website'];
    $res['min_order']=$res_data[0]['min_order'];
    $res['delivery_time']=$res_data[0]['delivery_time'];
    $res['offer']=$res_data[0]['offer'];
    $res['for_two']=$res_data[0]['for_two'];
    $res['rating']=$res_data[0]['rating'];
    $res['user_id']=$res_data[0]['user_id'];
    $res['lat']=$res_data[0]['lat'];
    $res['lang']=$res_data[0]['lang'];
    $res['img']=base_url()."upload_images/cuisine/".$res_data[0]['img'];

    $a[]=$res;


    }

    $response['status'] = 1;
    $response['Restaurant_List']=$a;
    $response['message'] = 'Restaurant List';

    }else{
    $response['status'] = 0;
    $response['message'] = 'Empaty List';
      
    }


}

return $response;



}

public function Apply_coupon(){

  $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
 }else if($data['coupon']=='')
 {
  $response['status']=0;
  $response['message']='Coupon are required';
 }else if($data['restaurant_id']=='')
 {
  $response['status']=0;
  $response['message']='Restaurant Id are required';
 }else if($data['total_amount']=='')
 {
  $response['status']=0;
  $response['message']='Total amt are required';
 }
 else
{
    
    $date=date("Y-m-d");

    $total_amount1=$data['total_amount'];

    $coupon=$sql = $this->db->select('*')->from('coupon')->where('coupon_code',$data['coupon'])->where('expire_date>=',$date)->where('status',1)->get()->num_rows();

    if ($coupon>0) {

      $coupon=$sql = $this->db->select('*')->from('coupon')->where('coupon_code',$data['coupon'])->where('expire_date>=',$date)->where('status',1)->get()->result_array();



    }
    else{


      $coupon=$sql = $this->db->select('*')->from('restaurant_coupon')->where('coupon_code',$data['coupon'])->where('r_id',$data['restaurant_id'])->where('expire_date>=',$date)->where('status',1)->get()->result_array();
    } 

$total_amount='';
      if($coupon){
    if($coupon[0]['discount_type']=='Direct'){
      $msg="Coupon Applied";
      $discount=$coupon[0]['discount'];
      $total_amount=$total_amount1-$coupon[0]['discount'];
    }
    elseif($coupon[0]['discount_type']=='Percent'){
      $msg="Coupon Applied";
      $discount=($total_amount/100)*$coupon[0]['discount'];
      $total_amount=$total_amount1-$discount;
    }
     $response['status'] = 1;
    $response['Discount amt']=$discount;
    $response['Total amt']=$total_amount;
    $response['message'] = $msg;
  }
    else{
      $msg="Invalid Coupon";
      $response['status'] = 0;
      $response['Discount amt']=0;
      $response['Total amt']=0;
      $response['message'] = $msg;

    }

   
}
return $response;

}


public function Apply_tax(){

  $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
 }else if($data['total_amount']=='')
 {
  $response['status']=0;
  $response['message']='Total amt are required';
 }
 else
{
 
 $tbl_setting = $this->db->select('*')->from('setting')->get()->result_array();

 $tax=$tbl_setting[0]['tax'];
 $item_total=$data['total_amount'];
 $gst= ($item_total/100)*$tax;

    $response['status'] = 1;
    $response['GST amt']=$gst;
    $response['message'] = 'GST Amount';

}
return $response;



}

public function Delivery_charge(){


 $response   =array();
 $data       = $this->input->post();

 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
 }else if($data['address_id']=='')
 {
  $response['status']=0;
  $response['message']='Addres Id are required';
 }else if($data['restaurant_id']=='')
 {
  $response['status']=0;
  $response['message']='Restaurant Id are required';
  
 }
 else if($data['user_id']=='')
 {
  $response['status']=0;
  $response['message']='User Id are required';
  
 }else{
    $address_id=$data['address_id'];
    $restaurant_id=$data['restaurant_id'];
    
    $user_data = $this->db->select('*')->from('user')->where('id',$data['user_id'])->get()->result_array();
    $todayDate = date('Y-m-d');
	$todayDate = date('Y-m-d', strtotime($todayDate));
	
		


    $res_data = $this->db->select('*')->from('restaurant')->where('id',$restaurant_id)->get()->result_array();
    $address_data = $this->db->select('*')->from('user_address')->where('id',$address_id)->get()->result_array();
    // print_r($address_data);
    // exit;
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

    $distance = ($miles * 1.609344);

if($user_data[0]['prime_member_start'] <= $todayDate && $user_data[0]['prime_member_end'] >= $todayDate){
	        //prime member
	   	    $delivery_charges= 0;
		   //	$total_amount=$total_amount;
		   $response['prime_member']=true;
		} else {
		  	$delivery_charges= round($distance*$tbl_setting[0]['delivery_charge']); 
		  	//$total_amount=$total_amount+$delivery_charges;
		  	$response['prime_member']=false;
		}
		

     //$delivery_charges= round($distance *$tbl_setting[0]['delivery_charge']);

    $response['status'] = 1;
    $response['Delivery_charge']=$delivery_charges;
    
    $response['Total_distance']=round($distance);
    $response['message'] = 'Delivery_charge';


}
return $response;




}


public function Wallet_blance(){



 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
 }else if($data['user_id']=='')
 {
  $response['status']=0;
  $response['message']='User Id are required';
 }else{
    
$credit_amt=0;
$debit_amt=0;


    $credit_amount= $this->db->select('*')->from('cashcredit')->where('user_id',$data['user_id'])->get()->result_array();
    
if($credit_amount){
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
    

    $response['status'] = 1;
    $response['total_wallet']=number_format($total_wallet, 2, '.', '');;
    $response['message'] = 'Wallet blance';


}
return $response;

}


public function Order_palced(){


  $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
 }else if($data['user_id']=='')
 {
  $response['status']=0;
  $response['message']='User Id are required';
 }else if($data['total_amount']=='')
 {
  $response['status']=0;
  $response['message']='Total amount are required';
 }else if($data['payment_method']=='')
 {
  $response['status']=0;
  $response['message']='Pament method are required';
 }else if($data['address_id']=='')
 {
  $response['status']=0;
  $response['message']='Addres Id are required';
 }else if($data['restaurant_id']=='')
 {
  $response['status']=0;
  $response['message']='Resaturant Id are required';
 }else if($data['total_amount']=='')
 {
  $response['status']=0;
  $response['message']='Total amount are required';
 }else{

unset($data['acid']);

    $user_id=$data['user_id'];
    $total_amount=$data['total_amount'];
    $payment_method=$data['payment_method'];
    $address_id=$data['address_id'];
    $restaurant_id=$data['restaurant_id'];
    $order_notes=$data['order_notes'];
    $gst_amount=$data['gst'];
    $delivery_charges=$data['delivery_charges'];
    $discount_amount=$data['discount_amount'];
    $distance=$data['total_distance'];

   


    $this->load->helper('string');
    $last_id=random_string('alnum',5);
    $order_id= "SP".date("Ymd").$last_id;
	$payment_status = 0;

    $delivery_address=$this->db->select('*')->from('user_address')->where('id',$address_id)->where('user_id',$user_id)->get()->result_array();
	
	if($payment_method == 'wallet'){
		//Debit amount from users wallet
		$wallet_amount = $this->General_model->get_wallet($user_id);
		if ($wallet_amount>=$this->session->userdata('total_amount')) {
			
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
      'payment_status' =>$payment_status, 
      'txn_no' =>$data['txn'] , 
    );

    $this->General_model->insert_order($order_data);

$cart_data = $this->db->from('temp_cart')->where('user_id',$data['user_id'])->get()->result_array();

    foreach ($cart_data as $key) {
$menu_data=$this->db->select('*')->from('menu')->where('id',$key['menu_id'] )->where('status',1)->get()->result_array();
      $data1['order_id']=$order_id;
      $data1['user_id']=$user_id;
      $data1['restaurant_id']=$restaurant_id;
      $data1['menu_id']=$key['menu_id'];
      $data1['menu_name']=$menu_data[0]['menu_name'];
      $data1['qty']=$key['qty'];
      $data1['price']=$key['price'];
       $this->db->insert('order_itmes',$data1);

    }

    $delivery_boy_id= array(
      'delivery_boy_id' =>$this->get_id($restaurant_id));

    $this->db->from('order_new');
    $this->db->where('order_no',$order_id);
    $this->db->update('order_new',$delivery_boy_id);

    $profile=$this->db->from('tbl_delivery_boy_profile')->where('id',$delivery_boy_id['delivery_boy_id'])->get()->result_array();

   /*User notification*/
     $user_profile=$this->db->from('user')->where('id',$user_id)->get()->result_array();
    $notification_user=new Pushnotification_for_user();
    $message='You order successfully placed';
    $registrationId=$user_profile[0]['device_id'];
    $registrationId= array($registrationId);
    // die;
    if (!empty($registrationId)){
      
      if ($user_profile[0]['device_type']==1) 
      {
      $responseEEE = $notification_user->andriod_push($registrationId, $message);
      
      }elseif ($user_profile[0]['device_type']==2) {

      $responseEEE = $notification_user->ios_push($registrationId, $message);

      }
    }


		/*delevery boy notification*/
		$notification=new Pushnotification();
		$profile=$this->db->from('tbl_delivery_boy_profile')->where('id',$delivery_boy_id['delivery_boy_id'])->get()->result_array();
		
		if ($profile){
			$message='You Have New order';
			$registrationId=$profile[0]['device_id'];
			$registrationId= array($registrationId);
			if ($profile[0]['device_type']==1) 
			{
			$responseEEE = $notification->andriod_push($registrationId, $message);
			
			}elseif ($profile[0]['device_type']==2) {

			//$responseEEE = $notification->ios_push($registrationId, $message);

			}
		}


		/*Vender notification*/

		$res_data=$this->db->select('*')->from('restaurant')->where('id',$restaurant_id)->where('status',1)->get()->result_array();
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
		


    $this->db->delete('temp_cart', array('user_id'=>$data['user_id']));

    $response['status'] = 1;
    $response['Order_id']=$order_id;
    $response['message'] = 'Order Placed';


}
return $response;
	

   
}

public function Order_tracking(){

 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
 }else if($data['order_id']=='')
 {
  $response['status']=0;
  $response['message']='Order Id are required';
 }else{

 	$rows=$this->db->select('*')->from('order_new')->where('order_no',$data['order_id'])->get()->num_rows();
 	$this->db->last_query();
 	if($rows>0){
 	
 	$order_data=$this->db->select('*')->from('order_new')->where('order_no',$data['order_id'])->get()->result_array();
 	$user_profile=$this->db->from('user')->where('id',$order_data[0]['user_id'])->get()->result_array();
 	
 	$delivery_boy_profile=$this->db->from('tbl_delivery_boy_profile')->where('id',$order_data[0]['delivery_boy_id'])->get()->result_array();
 	
 	$resaturant_profile=$this->db->from('tbl_restaurant')->where('id',$order_data[0]['restaurant_id'])->get()->result_array();


      $order_menu= $this->db->select('*')->from('order_itmes')->where('order_id',$data['order_id'])->get()->result_array();

 	 $response['status'] = 1;
    $response['order_data']=$order_data;
    $response['order_menu']=$order_menu;
    $response['user_data']=$user_profile;
    $response['resaturant_data']=$resaturant_profile;
    $response['delivery_boy_data']=$delivery_boy_profile;
    $response['message'] = 'Order Detail';

 	}else{

    $response['status'] = 0;
    $response['message'] = 'No Result Found';
 	}

}

return $response;

}


public function App_version(){



 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
 }else{
   $version=$this->db->select('AppVersion,AppCode')->from('app_version')->where('status',1)->get()->result_array();

  $rowss=$this->db->select('AppVersion,AppCode')->from('app_version')->where('status',1)->get()->num_rows();

  if ($rowss > 0) {
    foreach ($version as $row) {
    
    $da = $row['AppCode'];
    $Vda = $row['AppVersion'];

    }
    $response["success"] = 1;
    $response["version"] = (string)$da;
    $response["versioncode"] = (string)$Vda;

  } else {
    $response["success"] = 0;
    $response["message"] = "No Data Found.";
  }
    

}
return $response;


}


public function App_version_for_delivery_boy(){



 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
 }else{
   $version=$this->db->select('AppVersion,AppCode')->from('app_version')->where('status',2)->get()->result_array();

  $rowss=$this->db->select('AppVersion,AppCode')->from('app_version')->where('status',2)->get()->num_rows();

  if ($rowss > 0) {
    foreach ($version as $row) {
    
    $da = $row['AppCode'];
    $Vda = $row['AppVersion'];

    }
    $response["success"] = 1;
    $response["version"] = (string)$da;
    $response["versioncode"] = (string)$Vda;

  } else {
    $response["success"] = 0;
    $response["message"] = "No Data Found.";
  }
    

}
return $response;


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

				$userResult1 = $this->db->select('user_id,total_order')->from('tbl_order_process_user')->where('DATE(cdate)',$date)->order_by('total_order','asc')->get()->result_array();

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





















/*Delivery boy module*/


public function delivery_boy_login()
{
  $response           = array();
  $data               = array();
  $email              = $this->input->post('email');
  $password           = $this->input->post('password');
  $device_id           = $this->input->post('device_id');
  $device_type           = $this->input->post('device_type');

  if($email==''){
    $response['status'] = 0;
    $response['message'] = 'Email is Required';
  }else if($password==''){
    $response['status'] = 0;
    $response['message'] = 'Password is Required';
  }else if($device_id=='ass'){
    $response['status'] = 0;
    $response['message'] = 'Device Id is Required';
  }else if($device_type==''){
    $response['status'] = 0;
    $response['message'] = 'Device type is Required';
  }else{
    $chk_login = $this->db->get_where('delivery_boy_profile',array('email'=>$email,'password'=>$password,'status'=>1))->num_rows();
    if($chk_login>0)
    {   
      $token_id=array(
        'device_id'=>$device_id,
        'device_type'=>$device_type,
      );
       // $this->db->select('*');
       // $this->db->from('delivery_boy_profile'); 
       // $this->db->where('email',$email);
       // $this->db->update('delivery_boy_profile',$token_id);


      $this->db->select('*');
      $this->db->from('delivery_boy_profile a'); 
      $this->db->join('delivery_boy_document_detail b', 'b.user_id=a.id', 'right');
      $this->db->join('delivery_account_detail c', 'c.user_id=a.id', 'right');
      $this->db->where('a.email',$email);
      $this->db->where('a.password',$password);
      $logger_details= $this->db->get()->result_array(); 
    // echo $this->db->last_query();
      // print_r($logger_details);
      // die;
      $this->db->where('delivery_boy_profile.email',$email);
      $this->db->update('delivery_boy_profile',$token_id);
      unset($logger_details[0]['password']);
      $response['status']      =1;
        // $response['logger_details'] =$logger_details;

      $response['user_data'] =$user_data = array(
        'id' => $logger_details[0]['user_id'] ,
        'name' => $logger_details[0]['name'] ,
        'age' => $logger_details[0]['age'] ,
        'phone' => $logger_details[0]['phone'] ,
        'img' =>base_url().'upload_images/adhar_card/'.$logger_details[0]['img'] ,
        'email' => $logger_details[0]['email'] ,
        'address_detail' => $logger_details[0]['address_detail'] ,
        'blood_group' => $logger_details[0]['blood_group'] ,
        'availability' => $logger_details[0]['availability'] );


      $response['document'] =$doc_data = array(
        'adhar_card' => base_url().'upload_images/adhar_card/'.$logger_details[0]['adhar_card'] ,
        'address_proof'=>  base_url().'upload_images/adhar_card/'.$logger_details[0]['address_proof'] ,
        'driving_licence'=>  base_url().'upload_images/adhar_card/'.$logger_details[0]['driving_licence'] );



      $response['account_detail'] =$account_detail = array(
        'account_no' => $logger_details[0]['account_no'] ,
        'bank_name' => $logger_details[0]['bank_name'] ,
        'branch_name' => $logger_details[0]['branch_name'] ,
        'ifsc_code' => $logger_details[0]['ifsc_code'] );
      $response['message']     ='logged in successfully';
    }else{
      $response['status'] = 0;
      $response['message'] = 'Please provide us valid creditial';
    }
  }
  return $response;
}


public function show_profile_data()
{
  $response           = array();
  $data               = array();
  $user_id             = $this->input->post('user_id');

  if($user_id==''){
    $response['status'] = 0;
    $response['message'] = 'User Id is required';
  }else{
    $chk_login = $this->db->get_where('delivery_boy_profile',array('id'=>$user_id,'status'=>1))->num_rows();
    if($chk_login>0)
    {   


      $this->db->select('*');
      $this->db->from('delivery_boy_profile a'); 
      $this->db->join('delivery_boy_document_detail b', 'b.user_id=a.id', 'right');
      $this->db->join('delivery_account_detail c', 'c.user_id=a.id', 'right');
      $this->db->where('a.id',$user_id);
      $logger_details= $this->db->get()->result_array(); 
      unset($logger_details[0]['password']);

      $response['status']      =1;
        // $response['logger_details'] =$logger_details;
      $response['user_data'] =$user_data = array(
        'id' => $logger_details[0]['user_id'] ,
        'name' => $logger_details[0]['name'] ,
        'age' => $logger_details[0]['age'] ,
        'phone' => $logger_details[0]['phone'] ,
        'img' =>base_url().'upload_images/banner/thumb/'.$logger_details[0]['img'] ,
        'email' => $logger_details[0]['email'] ,
        'address_detail' => $logger_details[0]['address_detail'] ,
        'blood_group' => $logger_details[0]['blood_group'] ,
        'availability' => $logger_details[0]['availability'] );


      $response['document'] =$doc_data = array(
        'adhar_card' => base_url().'upload_images/adhar_card/'.$logger_details[0]['adhar_card'] ,
        'address_proof'=>  base_url().'upload_images/address_proof/'.$logger_details[0]['address_proof'] ,
        'driving_licence'=>  base_url().'upload_images/driving_licence/'.$logger_details[0]['driving_licence'] );



      $response['account_detail'] =$account_detail = array(
        'account_no' => $logger_details[0]['account_no'] ,
        'bank_name' => $logger_details[0]['bank_name'] ,
        'branch_name' => $logger_details[0]['branch_name'] ,
        'ifsc_code' => $logger_details[0]['ifsc_code'] );
      $response['message']     ='Success';
    }else{
      $response['status'] = 0;
      $response['message'] = 'Please provide us valid credential';
    }
  }
  return $response;
}


public function deliv_boy_action(){

  $response      = array();
  $data = $this->input->post();
  $user_id = $data['user_id'];
  $receiver_id = $data['availability'];

  if($data['acid']=='')
  {
    $response['status'] = 0;
    $response['message'] = 'acid id is required';
  }elseif($data['user_id']==''){
    $response['status'] = 0;
    $response['message'] = 'User id is required';
  }elseif($data['availability']==''){
    $response['status'] = 0;
    $response['message'] = 'Status is required';
  }else{
    unset($data['acid']);
    $status=array('availability' =>$receiver_id = $data['availability'], );
    $this->db->where('id',$data['user_id']);


    if($data['availability']=='1'){
      $response['status'] = 1;
      $this->db->update('delivery_boy_profile',$status);
    }else if($data['availability']=='2'){
      $response['status'] = 1;
      $this->db->update('delivery_boy_profile',$status);

    }else if($data['availability']>2 || $data['availability']<1 ){
      $response['status'] = 0;
    }
    $response['user_status'] =array('availability'=>$data['availability']);

  }
  return $response;
}

public function edit_delivery_boy_profile()
{

  $response   =array();
  $data       = $this->input->post();
        // print_r($data); die;
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }
  else if($data['name']=='' AND $data['age']=='' AND $data['phone']=='' AND $data['email'] AND $data['address_detail'] AND $data['blood_group'])
  {
    $response['status']=0;
    $response['message']='All Field are required';
  }
  else
  {
    $user_id=$data['user_id'];
    unset($data['acid']);
    unset($data['user_id']);
    if (!empty($_FILES['photo']['name'])) {
      if($_FILES['photo']['size']>0 && $_FILES['photo']['error']==''){
        $Image=new SimpleImage();
        $img=time().$_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'],"upload_images/banner/".$img);
        copy("upload_images/banner/".$img,"upload_images/banner/thumb/".$img);
        $Image->load("upload_images/banner/thumb/".$img);
        $Image->resize(160,50);
        $Image->save("upload_images/banner/thumb/".$img);

        copy("upload_images/banner/".$img,"upload_images/banner/big/".$img);
        $Image->load("upload_images/banner/big/".$img);
        $Image->resize(1070,290);
        $Image->save("upload_images/banner/big/".$img);

        $data['img']=$img;
      }  
    }

    $this->db->set($data);
    $this->db->where('id',$user_id);
    $this->db->update('delivery_boy_profile',$data);
    $response['status'] = 1;
    $response['message'] = 'Update successfully';

  }
  return $response;
}

 /*
     UPLOAD Single IMAGE USING BASE64...
    */
     public function base_64img_single()
     {


       $total_img_upload = $_REQUEST['photo'];
       $image = $total_img_upload;
       $imagefile =base64_decode($image);
            // print_r($image);
            // die;
       $create_image =imagecreatefromstring($imagefile);
       $imageName ="rest" . '_'.rand(5,9999). '-'.date("Y-m-d").'.'.'jpg'; 
       $localadd ="/development/dev2016/php/";
       $target_dir =$_SERVER["DOCUMENT_ROOT"].$localadd.'spoon11/upload_images/banner/thumb/'.$imageName;
       $success=file_put_contents($target_dir, $imagefile);
       return $imageName;
     }


     public function edit_delivery_boy_profile_for_ios()
     {

      $response   =array();
      $data       = $this->input->post();
        // print_r($data); die;
      if($data['acid']=='')
      {
        $response['status']=0;
        $responce['message']="acid is required";
      }
      else if($data['name']=='' AND $data['age']=='' AND $data['phone']=='' AND $data['email'] AND $data['address_detail'] AND $data['blood_group'])
      {
        $response['status']=0;
        $response['message']='All Field are required';
      }
      else
      {
        $user_id=$data['user_id'];
        unset($data['acid']);
        unset($data['user_id']);
        if(!empty($data['photo'])){
         $img = $this->base_64img_single();
         $data['img']=$img;
         unset($data['userFiles']);
       }
       $this->db->set($data);
       $this->db->where('id',$user_id);
       $this->db->update('delivery_boy_profile',$data);
       $response['status'] = 1;
       $response['message'] = 'Update successfully';

     }
     return $response;
   }

   public function assign_new_order_list(){
     $response           = array();
     $data               = array();
     $user_id             = $this->input->post('user_id');
     if($user_id==''){
      $response['status'] = 0;
      $response['message'] = 'user_id is required';
    }else{
      $chk_login = $this->db->get_where('order_new',array('delivery_boy_id'=>$user_id))->num_rows();
      if($chk_login>0)
      {  

        $result= $this->db->select('*')->from('order_new')->where('delivery_boy_id',$user_id)->where('order_status',1)->get()->result_array();
        foreach ($result as $key) {
         $order_data= $this->db->select('*')->from('order_new')->where('id',$key['id'])->get()->result_array();
         $user_data= $this->db->select('*')->from('user')->where('id',$order_data[0]['user_id'])->get()->result_array();
         $res_data= $this->db->select('*')->from('restaurant')->where('id',$order_data[0]['restaurant_id'])->get()->result_array();

         $response['status']      =1;
        // $response['logger_details'] =$logger_details;
         $delivery_data = array(
          'order_no' => $order_data[0]['order_no'] ,
          'restauran_name' => $res_data[0]['r_name'] ,
          'name' => $user_data[0]['name'] ,
          'phone' => $user_data[0]['mobile'] ,
          'delivery_address' =>$order_data[0]['delivery_address'] ,
          'address_type' => $order_data[0]['address_type'] ,
          'delivery_charges' => $order_data[0]['delivery_charges'] ,
          'discount_amount' => $order_data[0]['discount_amount'] ,
          'gst_amount' => $order_data[0]['gst_amount'] ,
          'total_amount' => $order_data[0]['total_amount'] ,
          'delivery_date' => $order_data[0]['delivery_date'] ,
          'order_status' => $order_data[0]['order_status'] ,
          'payment_method' => $order_data[0]['payment_method'],
          'payment_status' => $order_data[0]['payment_status']
        );

         $a[]=$delivery_data;
       }    
       if(!empty($a)){

         $response['order_data']=$a;
         $response['message']     ='Success';
       }else{
         $response['status'] = 0;
         $response['message']     ='Empty Data';
       }
     }else{
      $response['status'] = 0;
      $response['message'] = 'No Task Assign';
    }
  }
  return $response;



}

public function show_menu_detail(){

 $response           = array();
 $data               = array();
 $order_id             = $this->input->post('order_id');
 if($order_id==''){
  $response['status'] = 0;
  $response['message'] = 'oder id is required';
}else{
  $chk_login = $this->db->get_where('order_itmes',array('order_id'=>$order_id))->num_rows();
  if($chk_login>0)
  {  

    $result= $this->db->select('*')->from('order_itmes')->where('order_id',$order_id)->get()->result_array();
    $response['status']      =1;
    $response['Show items'] =$result;
    $response['message']     ='Success';
  }else{
    $response['status'] = 1;
    $response['message'] = 'No Menu item';
  }
}
return $response;

}
public function delivery_boy_change_password(){




  $response      = array();
  $change_password = $this->input->post();
  if($change_password['acid']=='')
  {
    $response['status'] = 0;
    $response['message'] = 'acid id is required';
  }else if($change_password['old_password']=='')
  {
    $response['status'] = 0;
    $response['message'] = 'old password required';
  }else if($change_password['user_id']=='')
  {
    $response['status'] = 0;
    $response['message'] = 'user id required';
  }else if($change_password['new_password']=='')
  {
    $response['status'] = 0;
    $response['message'] = 'New password required';
  }else{
    unset($change_password['acid']);
    $user_info = $this->db->get_where('delivery_boy_profile',array('id'=>$change_password['user_id']))->result_array();
            // echo $this->db->last_query(); die;
    if($user_info[0]['password']==$change_password['old_password'])
    {  

      $data = array('password'=>$change_password['new_password']);
      $this->db->update('delivery_boy_profile',$data, array('id' =>$change_password['user_id']));

      $response['status'] = 1;
      $response['message'] = 'password updated successfully';
    }else{
     $response['status'] = 0;
     $response['message'] = 'Old password does not matched';
   }
            //print_r($user_info);die;
 }
 return $response;


}

public function assign_process_order_list(){


 $response           = array();
 $data               = array();
 $user_id             = $this->input->post('user_id');
 if($user_id==''){
  $response['status'] = 0;
  $response['message'] = 'user_id is required';
}else{
  $chk_login = $this->db->get_where('order_new',array('delivery_boy_id'=>$user_id))->num_rows();
  if($chk_login>0)
  {  

    $result= $this->db->select('*')->from('order_new')->where('delivery_boy_id',$user_id)->where('order_status',2)->get()->result_array();
    foreach ($result as $key) {
     $order_data= $this->db->select('*')->from('order_new')->where('id',$key['id'])->get()->result_array();
     $user_data= $this->db->select('*')->from('user')->where('id',$order_data[0]['user_id'])->get()->result_array();
     $res_data= $this->db->select('*')->from('restaurant')->where('id',$order_data[0]['restaurant_id'])->get()->result_array();

     $response['status']      =1;
        // $response['logger_details'] =$logger_details;
     $delivery_data = array(
      'order_no' => $order_data[0]['order_no'] ,
      'restauran_name' => $res_data[0]['r_name'] ,
      'name' => $user_data[0]['name'] ,
      'phone' => $user_data[0]['mobile'] ,
      'delivery_address' =>$order_data[0]['delivery_address'] ,
      'address_type' => $order_data[0]['address_type'] ,
      'delivery_charges' => $order_data[0]['delivery_charges'] ,
      'discount_amount' => $order_data[0]['discount_amount'] ,
      'gst_amount' => $order_data[0]['gst_amount'] ,
      'total_amount' => $order_data[0]['total_amount'] ,
      'delivery_date' => $order_data[0]['delivery_date'] ,
      'order_status' => $order_data[0]['order_status'] ,
      'payment_method' => $order_data[0]['payment_method'],
      'payment_status' => $order_data[0]['payment_status'],
      'lat' => $order_data[0]['lat'],
      'lng' => $order_data[0]['lng'],
    );

     $a[]=$delivery_data;
   }  

   if (empty($result)) {
    $response['message'] ='No Record';
    $response['status'] = 0;


   }else{
     $response['order_data']=$a;
     $response['message']     ='Success';
      $response['status'] = 1;

   }
   
 }else{
  $response['status'] = 0;
  $response['message'] = 'No Task Assign';
}
}
return $response;


}

public function assign_delivered_order_list(){


 $response           = array();
 $data               = array();
 $user_id             = $this->input->post('user_id');
 if($user_id==''){
  $response['status'] = 0;
  $response['message'] = 'user_id is required';
}else{
  $chk_login = $this->db->get_where('order_new',array('delivery_boy_id'=>$user_id))->num_rows();
  if($chk_login>0)
  {  

    $result= $this->db->select('*')->from('order_new')->where('delivery_boy_id',$user_id)->where('order_status',4)->get()->result_array();
    foreach ($result as $key) {
     $order_data= $this->db->select('*')->from('order_new')->where('id',$key['id'])->get()->result_array();
     $user_data= $this->db->select('*')->from('user')->where('id',$order_data[0]['user_id'])->get()->result_array();
     $res_data= $this->db->select('*')->from('restaurant')->where('id',$order_data[0]['restaurant_id'])->get()->result_array();

     $response['status']      =1;
        // $response['logger_details'] =$logger_details;
     $delivery_data = array(
      'order_no' => $order_data[0]['order_no'] ,
      'restauran_name' => $res_data[0]['r_name'] ,
      'name' => $user_data[0]['name'] ,
      'phone' => $user_data[0]['mobile'] ,
      'delivery_address' =>$order_data[0]['delivery_address'] ,
      'address_type' => $order_data[0]['address_type'] ,
      'delivery_charges' => $order_data[0]['delivery_charges'] ,
      'discount_amount' => $order_data[0]['discount_amount'] ,
      'gst_amount' => $order_data[0]['gst_amount'] ,
      'total_amount' => $order_data[0]['total_amount'] ,
      'delivery_date' => $order_data[0]['delivery_date'] ,
      'order_status' => $order_data[0]['order_status'] ,
      'payment_method' => $order_data[0]['payment_method'],
      'payment_status' => $order_data[0]['payment_status']
    );

     $a[]=$delivery_data;
   }  

   if (empty($result)) {
    $response['message'] ='No Record';
    $response['status'] = 0;


   }else{
     $response['order_data']=$a;
     $response['message']     ='Success';
      $response['status'] = 1;

   }
   
 }else{
  $response['status'] = 0;
  $response['message'] = 'No Task Assign';
}
}
return $response;


}

public function accept_task(){

 $response      = array();
 $data = $this->input->post();
 $order_id = $data['order_id'];
 $order_status = $data['order_status'];

 if($data['acid']=='')
 {
  $response['status'] = 0;
  $response['message'] = 'acid id is required';
}elseif($data['order_id']==''){
  $response['status'] = 0;
  $response['message'] = 'Order id is required';
}elseif($data['order_status']==''){
  $response['status'] = 0;
  $response['message'] = 'Status is required';
}else{
  unset($data['acid']);
  $status=array('order_status' => $data['order_status'], );
  $this->db->where('order_no',$data['order_id']);
  $response['status'] = 1;
  $this->db->update('order_new',$status);






  $response['message']='Change order status';

}
return $response;


}
public function delivered_task(){

  $response   =array();
  $data       = $this->input->post();
        // print_r($data); die;
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }
  else if($data['order_id']=='' AND $data['rating']=='' AND $data['comment']=='' AND $data['mode_of_payment']=='')
  {
    $response['status']=0;
    $response['message']='All Field are required';
  }
  else
  {

   if($data['order_status']==4){
     $this->credit_amount_to_delivery_boy($data['order_id']) ;
   }
   $oder_id=$data['order_id'];
   
   unset($data['acid']);
   unset($data['order_id']);

   $this->db->set($data);
   $this->db->where('order_no',$oder_id);
   $this->db->update('order_new',$data);



   $response['status'] = 1;
   $response['message'] = 'Update successfully';


 }
 return $response;

}

public function credit_amount_to_delivery_boy()
{

 $response   =array();
 $data1       = $this->input->post();
        // print_r($data1); die;
 if($data1['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}
else if($data1['order_id']=='')
{
  $response['status']=0;
  $response['message']='All Field are required';
}
else
{
  unset($data1['acid']);
  unset($data1['rating']);
  unset($data1['accommentid']);
  unset($data1['mode_of_payment']);
  unset($data1['order_status']);
  unset($data1['payment_status']);
  unset($data1['comment']);
  $order_id=$data1['order_id'];
  $total_distance='';
  $total_distance2='';
  $total_amount2='';
  $insentive='';

  $order_data = $this->db->select('*')->from('order_new')->where('order_no',$order_id)->get()->result_array();
  $tbl_setting = $this->db->select('*')->from('setting')->get()->result_array();
  // print_r($tbl_setting);
  $time=$order_data[0]['delivery_date'];
  $time=explode(' ',$time);
  $inst=$tbl_setting[0]['insentive'];
  $data1['user_id']=$order_data[0]['delivery_boy_id'];
      // echo $time[1];
      // print_r($order_data);

  if (strtotime($time[1])<=strtotime('20:00:00')) {
   $total_distance=$order_data[0]['total_distance'];

 }else{
   $total_distance2=$order_data[0]['total_distance'];
 }

 if($total_distance){
  $total_amount=($total_distance/5)*$tbl_setting[0]['day_shift_payment'];
  $shift="Day";
}else{
 $total_amount=($total_distance2/5)*($tbl_setting[0]['night_shift_payment']+$inst);
 $shift="Night";
 $insentive=($total_distance2/5)*$inst;
 $total_distance=$total_distance2;
}
$data1['shift']=$shift;
$data1['distance']=$total_distance;
$data1['type']='Cr';
$data1['insentive']=$insentive;
$data1['credit_amount']=$total_amount;
$data1['status']=1;

$this->db->insert('tbl_delvery_boy_payment',$data1);

$response['status'] = 1;
$response['message'] = 'Inserted successfully';

}
return $response;

}

public function order_payment_list(){


 $response           = array();
 $data               = array();
 $user_id             = $this->input->post('user_id');
 if($user_id==''){
  $response['status'] = 0;
  $response['message'] = 'user_id is required';
}else{
  $chk_login = $this->db->get_where('tbl_delvery_boy_payment',array('user_id'=>$user_id))->num_rows();
  if($chk_login>0)
  {  

    $result= $this->db->select('*')->from('tbl_delvery_boy_payment')->where('user_id',$user_id)->get()->result_array();

    $response['status']      =1;
    $response['payment_status'] =$result;
    $response['message']     ='Success';
  }else{
    $response['status'] = 0;
    $response['message'] = 'No Task Assign';
  }
}
return $response;


}


public function get_avilability(){
  $response           = array();
  $data               = array();
  $user_id             = $this->input->post('user_id');

  if($user_id==''){
    $response['status'] = 0;
    $response['message'] = 'User Id is required';
  }else{
    $chk_login = $this->db->get_where('delivery_boy_profile',array('id'=>$user_id,'status'=>1))->num_rows();
    if($chk_login>0)
    {   


      $this->db->select('*');
      $this->db->from('delivery_boy_profile a'); 
      $this->db->join('delivery_boy_document_detail b', 'b.user_id=a.id', 'right');
      $this->db->join('delivery_account_detail c', 'c.user_id=a.id', 'right');
      $this->db->where('a.id',$user_id);
      $logger_details= $this->db->get()->result_array(); 
      unset($logger_details[0]['password']);

      $response['status']      =1;
        // $response['logger_details'] =$logger_details;
      $response['user_data'] =$user_data = array(
        'availability' => $logger_details[0]['availability'] );
      $response['message']     ='Success';
    }else{
      $response['status'] = 0;
      $response['message'] = 'Please provide us valid credential';
    }
  }
  return $response;
}

public function Current_lat_lng(){


 $response           = array();
 $data               = array();
 $data            = $this->input->post();
 if($data['user_id']==''){
  $response['status'] = 0;
  $response['message'] = 'user_id is required';
}else if($data['lat']==''){
  $response['status'] = 0;
  $response['message'] = 'Lattitude is required';
}else if($data['lng']==''){
  $response['status'] = 0;
  $response['message'] = 'lagnitude is required';
}
else{
  unset($data['acid']);
  $rows = $this->db->get_where('tbl_delvery_boy_current_location',array('user_id'=>$data['user_id']))->num_rows();
  if($rows>0)
  {  

    $this->db->select('*');
    $this->db->from('tbl_delvery_boy_current_location'); 
    $this->db->where('user_id',$data['user_id']);
    $this->db->update('tbl_delvery_boy_current_location',$data);

    $response['status']      =1;
    $response['message']     ='Success';
  }else{
     $this->db->insert('tbl_delvery_boy_current_location',$data);

    $response['status']      =1;
    $response['message']     ='Success';
  }
}
return $response;



}



























public function vender_login(){

  $response           = array();
  $data               = array();
  $email              = $this->input->post('email');
  $password           = $this->input->post('password');
  $device_id          = $this->input->post('device_id');
  $device_type        = $this->input->post('device_type');

  if($email==''){
    $response['status'] = 0;
    $response['message'] = 'Email is Required';
  }else if($password==''){
    $response['status'] = 0;
    $response['message'] = 'Password is Required';
  }else if($device_id=='ass'){
    $response['status'] = 0;
    $response['message'] = 'Device Id is Required';
  }else if($device_type==''){
    $response['status'] = 0;
    $response['message'] = 'Device type is Required';
  }else{
    $chk_login = $this->db->get_where('user',array('email'=>$email,'password'=>$password,'type'=>2))->num_rows();
    if($chk_login>0)
    {   
    	$token_id=array(
        'device_id'=>$device_id,
        'device_type'=>$device_type,
      );

      $logger_details = $this->db->get_where('user',array('email'=>$email,'password'=>$password,'type'=>2))->result_array();
      $res_data= $this->db->select('img')->from('restaurant')->where('user_id',$logger_details[0]['id'])->get()->result_array();    
      unset($logger_details[0]['password']);
        $this->db->where('user.email',$email);
      	$this->db->update('user',$token_id);
      $response['status']      =1;
      $response['logger_details'] =$logger_details;
      $response['res_data'] =$res_data;
      $response['message']     ='logged in successfully';
    }else{
      $response['status'] = 0;
      $response['message'] = 'Please provide us valid creditial';
    }
  }
  return $response;

}
public function vender_resaturants(){

  $response           = array();
  $data               = array();
  $user_id             = $this->input->post('user_id');
  if($user_id==''){
    $response['status'] = 0;
    $response['message'] = 'User id is required';
  }else{

   $date=date('y/m/d');

   $restaurant=$sql = $this->db->select('*')->from('restaurant')->where('user_id',$user_id)->get()->result_array();
      // print_r($restaurant);
   foreach ($restaurant as $key) {


    $res['r_id']=$key['id'];
    $res['r_name']=$key['r_name'];
    $res['r_phone']=$key['r_phone'];
    $res['r_address']=$key['r_address'];
    $res['budget']=$key['budget'];
    $res['r_website']=$key['r_website'];
    $res['min_order']=$key['min_order'];
    $res['delivery_time']=$key['delivery_time'];
    $res['offer']=$key['offer'];
    $res['for_two']=$key['for_two'];
    $res['rating']=$key['rating'];
    $res['user_id']=$key['user_id'];
    $res['lat']=$key['lat'];
    $res['lang']=$key['lang'];
    $res['img']=base_url()."upload_images/cuisine/".$key['img'];

    $a[]=$res;
  }

  
  if($restaurant){  
    $response['status']      =1;
    $response['res_list'] =$a;
    $response['message']     ='Success';
  }else{
    $response['status'] = 1;
    $response['message'] = 'Restaurant not avilable';
  }

}

return $response;


}

public function insert_resaturant_profile(){

  $response   =array();
  $data       = $this->input->post();
        // print_r($data); die;
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }
  else if($data['user_id']=='')
  {
    $response['status']=0;
    $response['message']='User id are required';
  }else if($data['r_name']=='')
  {
    $response['status']=0;
    $response['message']='Reastaurant name are required';
  }else if($data['phone']=='')
  {
    $response['status']=0;
    $response['message']='Phone no are required';
  }else if($data['m_name']=='')
  {
    $response['status']=0;
    $response['message']='Manager are required';
  }
  else if($data['m_phone']=='')
  {
    $response['status']=0;
    $response['message']='Manager phone are required';
  }else if($data['email']=='')
  {
    $response['status']=0;
    $response['message']='Email are required';
  }else if($data['country']=='')
  {
    $response['status']=0;
    $response['message']='country are required';
  }else if($data['state']=='')
  {
    $response['status']=0;
    $response['message']='state are required';
  }else if($data['city']=='')
  {
    $response['status']=0;
    $response['message']='City are required';
  }else if($data['website']=='')
  {
    $response['status']=0;
    $response['message']='Website are required';
  }else if($data['address']=='')
  {
    $response['status']=0;
    $response['message']='Address are required';
  }else if($data['lat']=='')
  {
    $response['status']=0;
    $response['message']='lattitude are required';
  }else if($data['lng']=='')
  {
    $response['status']=0;
    $response['message']='lognitude are required';
  }else if($data['discription']=='')
  {
    $response['status']=0;
    $response['message']='Discription are required';
  } if($data['booktable']=='')
  {
    $response['status']=0;
    $response['message']='Book Table are required';
  }else if($data['min_order']=='')
  {
    $response['status']=0;
    $response['message']='Min Order are required';
  }else if($data['delivery_time']=='')
  {
    $response['status']=0;
    $response['message']='Delivery Time are required';
  }else if($data['offer']=='')
  {
    $response['status']=0;
    $response['message']='Offer are required';
  }else if($data['cuisines']=='')
  {
    $response['status']=0;
    $response['message']='Cuisines are required';
  }else if(empty($_FILES['image']['name']))
  {
    $response['status']=0;
    $response['message']='Image are required';
  }


  else
  {
    unset($data['acid']);
    $user_id=$data['user_id'];
    $cus=$data['cuisines'];
    $cuisines=explode(',', $cus);

    if(!empty($_FILES['image']['name'])){
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
    }        
          $data= array(
        'user_id' =>$user_id,
        'r_name' =>$data['r_name'],
        'slug' =>$data['r_name'],
        'r_phone' =>$data['phone'] ,
        'm_name' =>$data['m_name'] ,
        'm_contact' =>$data['m_phone'] ,
        'email' =>$data['email'],  
        'country_id' =>$data['country'],   
        'state_id' =>$data['state'],   
        'city_id' =>$data['city'],   
        'r_website' =>$data['website'],  
        'r_address' =>$data['address'],  
        'lat' =>$data['lat'],  
        'lang' =>$data['lng'],   
        'pdesc' =>$data['discription'],  
        'book_table' =>$data['booktable'],
        'no_of_table' =>$data['no_of_table'],   
        'min_order' =>$data['min_order'],  
        'delivery_time' =>$data['delivery_time'],  
        'offer' =>$data['offer'],  
      );

     if (!empty($i)) {
      $data['img']=$img;
       }
      $this->General_model->add_res_profile($data);
      $res_last_id=$this->db->insert_id();
      $this->General_model->add_res_time($res_last_id);
      $this->General_model->add_res_cuisine($cuisines,$res_last_id);
    
    $response['status'] = 1;
    $response['message'] = 'Insert successfully';

  }
  return $response;



}

public function update_resaturant_profile(){


   $response   =array();
  $data       = $this->input->post();
        // print_r($data); die;
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }
  else if($data['res_id']=='')
  {
    $response['status']=0;
    $response['message']='Res id are required';
  }else if($data['r_name']=='')
  {
    $response['status']=0;
    $response['message']='Reastaurant name are required';
  }else if($data['phone']=='')
  {
    $response['status']=0;
    $response['message']='Phone no are required';
  }else if($data['m_name']=='')
  {
    $response['status']=0;
    $response['message']='Manager are required';
  }
  else if($data['m_phone']=='')
  {
    $response['status']=0;
    $response['message']='Manager phone are required';
  }else if($data['email']=='')
  {
    $response['status']=0;
    $response['message']='Email are required';
  }else if($data['country']=='')
  {
    $response['status']=0;
    $response['message']='country are required';
  }else if($data['state']=='')
  {
    $response['status']=0;
    $response['message']='state are required';
  }else if($data['city']=='')
  {
    $response['status']=0;
    $response['message']='City are required';
  }else if($data['website']=='')
  {
    $response['status']=0;
    $response['message']='Website are required';
  }else if($data['address']=='')
  {
    $response['status']=0;
    $response['message']='Address are required';
  }else if($data['lat']=='')
  {
    $response['status']=0;
    $response['message']='lattitude are required';
  }else if($data['lng']=='')
  {
    $response['status']=0;
    $response['message']='lognitude are required';
  }else if($data['discription']=='')
  {
    $response['status']=0;
    $response['message']='Discription are required';
  } if($data['booktable']=='')
  {
    $response['status']=0;
    $response['message']='Book Table are required';
  }else if($data['min_order']=='')
  {
    $response['status']=0;
    $response['message']='Min Order are required';
  }else if($data['delivery_time']=='')
  {
    $response['status']=0;
    $response['message']='Delivery Time are required';
  }else if($data['offer']=='')
  {
    $response['status']=0;
    $response['message']='Offer are required';
  }else if($data['cuisines']=='')
  {
    $response['status']=0;
    $response['message']='Cuisines are required';
  }else if(empty($_FILES['image']['name']))
  {
    $response['status']=0;
    $response['message']='Image are required';
  }


  else
  {
    unset($data['acid']);
    // $user_id=$data['user_id'];
    $cus=$data['cuisines'];
    $cuisines=explode(',', $cus);

    if(!empty($_FILES['image']['name'])){
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
    }        
          $data1= array(
        'r_name' =>$data['r_name'],
        'slug' =>$data['r_name'],
        'r_phone' =>$data['phone'] ,
        'm_name' =>$data['m_name'] ,
        'm_contact' =>$data['m_phone'] ,
        'email' =>$data['email'],  
        'country_id' =>$data['country'],   
        'state_id' =>$data['state'],   
        'city_id' =>$data['city'],   
        'r_website' =>$data['website'],  
        'r_address' =>$data['address'],  
        'lat' =>$data['lat'],  
        'lang' =>$data['lng'],   
        'pdesc' =>$data['discription'],  
        'book_table' =>$data['booktable'],
        'no_of_table' =>$data['no_of_table'],   
        'min_order' =>$data['min_order'],  
        'delivery_time' =>$data['delivery_time'],  
        'offer' =>$data['offer'],  
      );

     if (!empty($i)) {
      $dat1a['img']=$img;
       }
            $this->General_model->update_profile($data1,$data['res_id']);
            $this->General_model->update_res_cuisine($cuisines,$data['res_id']);
    
    $response['status'] = 1;
    $response['message'] = 'Update successfully';

  }
  return $response;


}
public function country_list(){

 $response           = array();
 $data               = array();
 $data=$this->input->post();
 if($data['acid']==''){
  $response['status'] = 0;
  $response['message'] = 'acid is required';
}else{

  $result= $this->db->select('*')->from('country')->where('status',1)->get()->result_array();

  $response['status']      =1;
  $response['country_list'] =$result;


  $response['message']     ='Success';

}
return $response;

}

public function state_list(){

 $response           = array();
 $data               = array();
 $data=$this->input->post();
 if($data['acid']==''){
  $response['status'] = 0;
  $response['message'] = 'acid is required';
}else if($data['country_id']=='')
{
  $response['status']=0;
  $response['message']='Country are required';
}else{

  $result= $this->db->select('*')->from('state')->where('country_id',$data['country_id'])->where('status',1)->get()->result_array();
  $response['status']      =1;
  $response['State_list'] =$result;


  $response['message']     ='Success';

}
return $response;

}

public function city_list(){

 $response           = array();
 $data               = array();
 $data=$this->input->post();
 if($data['acid']==''){
  $response['status'] = 0;
  $response['message'] = 'acid is required';
}else if($data['state_id']=='')
{
  $response['status']=0;
  $response['message']='State are required';
}else{

  $result= $this->db->select('id,city')->from('city')->where('state_id',$data['state_id'])->where('status',1)->get()->result_array();
  $response['status']      =1;
  $response['city_list'] =$result;


  $response['message']     ='Success';

}
return $response;

}
public function vender_book_table_list(){



  $response   =array();
  $result     =array();
  $data       = $this->input->post();
  if($data['acid']=='')
  {
    $response['status']=0;
    $response['message']="acid is required";
  }
  else if($data['user_id']=='')
  {
    $response['status'] = 0;
    $response['message'] = 'User id is required';
  }
  else
  {

    $this->db->select('*');
    $this->db->from('tbl_bookiing a'); 
    $this->db->join('restaurant b','b.id=a.res_id', 'left');
    $this->db->join('user c','c.id=a.user_id', 'inner');
    $this->db->where('b.user_id',$data['user_id']);
    $this->db->order_by('a.id');         
    $bokking_data = $this->db->get()->result_array();
    unset($data['acid']);
    unset($data['user_id']);
    // print_r($bokking_data);
    $i=1;
    foreach ($bokking_data as $key) {

      $res_data=$this->db->select('*')->from('restaurant')->where('id',$key['res_id'] )->where('status',1)->get()->result_array();

      $data['sno']=$i;
      $data['res_name']=$res_data[0]['r_name'];
      $data['no_of_table']=$key['no_of_tables'];
      $data['Customer_name']=$key['name'];
      $data['mobile']=$key['mobile'];
      $data['date']=$key['date'];
      $data['time']=$key['time'];
      $a[] =$data ;                                 
      $i++; }

      $response['status']=1;
      $response['message']='success';
      $response['Bokking_List']=$a;
      return $response;
    }




  }

  public function vender_order_list(){



    $response           = array();
    $data               = array();
    $res_id             = $this->input->post('res_id');
    if($res_id==''){
      $response['status'] = 0;
      $response['message'] = 'res_id is required';
    }else{
      $chk_login = $this->db->get_where('order_new',array('restaurant_id'=>$res_id))->num_rows();
      if($chk_login>0)
      {  

        $result= $this->db->select('*')->from('order_new')->where('restaurant_id',$res_id)->order_by('id','desc')->get()->result_array();
        foreach ($result as $key) {
         $order_data= $this->db->select('*')->from('order_new')->where('id',$key['id'])->get()->result_array();
         $user_data= $this->db->select('*')->from('user')->where('id',$order_data[0]['user_id'])->get()->result_array();
         $res_data= $this->db->select('*')->from('restaurant')->where('id',$order_data[0]['restaurant_id'])->get()->result_array();

         $response['status']      =1;
        // $response['logger_details'] =$logger_details;
         $delivery_data = array(
          'order_no' => $order_data[0]['order_no'] ,
          'restauran_name' => $res_data[0]['r_name'] ,
          'name' => $user_data[0]['name'] ,
          'phone' => $user_data[0]['mobile'] ,
          'delivery_address' =>$order_data[0]['delivery_address'] ,
          'address_type' => $order_data[0]['address_type'] ,
          'delivery_charges' => $order_data[0]['delivery_charges'] ,
          'discount_amount' => $order_data[0]['discount_amount'] ,
          'gst_amount' => $order_data[0]['gst_amount'] ,
          'total_amount' => $order_data[0]['total_amount'] ,
          'delivery_date' => $order_data[0]['delivery_date'] ,
          'order_status' => $order_data[0]['order_status'] ,
          'payment_method' => $order_data[0]['payment_method'],
          'payment_status' => $order_data[0]['payment_status']
        );

         $a[]=$delivery_data;
       }    

       $response['order_data']=$a;
       $response['message']     ='Success';
     }else{
      $response['status'] = 1;
      $response['message'] = 'No Task Assign';
    }
  }
  return $response;

}


public function cousine_list(){


 $response   =array();
 $data       = $this->input->post();
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}

else
{

  $rows=$this->db->select('*')->from('cuisine')->where('status',1)->get()->num_rows();

  if($rows>0){
    $cousine=$this->db->select('*')->from('cuisine
      ')->where('status',1)->get()->result_array();


    $response['message'] = 'cousine List';
    $response['address_list'] =$cousine;
    $response['status'] = 1;


  }else{

    $response['message'] = 'Address List empty';
    $response['status'] = 1;

  }

}
return $response;

}

public function order_detail(){


 $response           = array();
 $data               = array();
 $order_no             = $this->input->post('order_no');
 if($order_no==''){
  $response['status'] = 0;
  $response['message'] = 'order_no is required';
}else{
  $chk_login = $this->db->get_where('order_new',array('order_no'=>$order_no))->num_rows();
      // echo $this->db->last_query();

  if($chk_login>0)
  {  

    $result= $this->db->select('*')->from('order_new')->where('order_no',$order_no)->get()->result_array();
    $user_data= $this->db->select('*')->from('user')->where('id',$result[0]['user_id'])->get()->result_array();
    $res_data= $this->db->select('*')->from('restaurant')->where('id',$result[0]['restaurant_id'])->get()->result_array();

    $response['status']      =1;
        // $response['logger_details'] =$logger_details;
    $delivery_data = array(
      'order_no' => $result[0]['order_no'] ,
      'restauran_name' => $res_data[0]['r_name'] ,
      'name' => $user_data[0]['name'] ,
      'email' => $user_data[0]['email'] ,
      'phone' => $user_data[0]['mobile'] ,
      'delivery_address' =>$result[0]['delivery_address'] ,
      'address_type' => $result[0]['address_type'] ,
      'delivery_charges' => $result[0]['delivery_charges'] ,
      'discount_amount' => $result[0]['discount_amount'] ,
      'gst_amount' => $result[0]['gst_amount'] ,
      'total_amount' => $result[0]['total_amount'] ,
      'delivery_date' => $result[0]['delivery_date'] ,
      'order_status' => $result[0]['order_status'] ,
      'payment_method' => $result[0]['payment_method'],
      'payment_status' => $result[0]['payment_status']
    );
    $a['order_detail']=$delivery_data;

    $a['menu_detail']= $this->db->select('*')->from('order_itmes')->where('order_id',$order_no)->get()->result_array();

    if(!empty($a)){

     $response['order_data']=$a;
     $response['message']     ='Success';
   }else{
     $response['status'] = 0;
     $response['message']     ='Empty Data';
   }
 }else{
  $response['status'] = 0;
  $response['message'] = 'No Detail Found';
}
}
return $response;

}

public function restaurant_offer(){


  $response   =array();
  $data       = $this->input->post();
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }else if($data['res_id']=='')
  {
    $response['status'] = 0;
    $response['message'] = 'Restaturant id is required';
  }

  else
  {

    $rows=$this->db->select('')->from('restaurant_coupon')->where('r_id',$data['res_id'])->where('status',1)->get()->num_rows();

    if($rows>0){

      $this->db->select('c.*');
      $this->db->from('user a'); 
      $this->db->join('restaurant b', 'b.user_id=a.id', 'left');
      $this->db->join('restaurant_coupon c', 'c.r_id=b.id', 'left');
      $this->db->where('b.id',$data['res_id']);
      $this->db->where('c.status',1);
      $this->db->order_by('c.id','asc');         
      $query = $this->db->get()->result_array(); 



      $response['message'] = 'Offer List';
      $response['offer_list'] =$query;
      $response['status'] = 1;


    }else{

      $response['message'] = 'Address List empty';
      $response['status'] = 1;

    }

  }
  return $response;



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
public function add_offer(){


  $response   =array();
  $data       = $this->input->post();
        // print_r($data); die;
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }
  else if($data['r_id']=='')
  {
    $response['status']=0;
    $response['message']='Restaturant id are required';
  }else if($data['valid_for']=='')
  {
    $response['status']=0;
    $response['message']='Valid For  are required';
  }else if($data['discount_type']=='')
  {
    $response['status']=0;
    $response['message']='Discount_type are required';
  }else if($data['discount']=='')
  {
    $response['status']=0;
    $response['message']='Descount are required';
  }
  else if($data['expire_date']=='')
  {
    $response['status']=0;
    $response['message']='Expire date are required';
  }else if($data['minimum_purchase']=='')
  {
    $response['status']=0;
    $response['message']='minimum_purchase are required';
  }else
  {
    unset($data['acid']);

    $date = new DateTime("now");
    $curr_date = $date->format('Y-m-d');
    $data= array(
      'r_id' =>$data['r_id'],
      'valid_for' =>$this->input->post('valid_for') ,
      'discount_type' =>$this->input->post('discount_type') ,
      'discount' =>$this->input->post('discount') ,
      'minimum_purchase' =>$this->input->post('minimum_purchase') ,
      'expire_date' =>$this->input->post('expire_date') ,
      'coupon_code'=>$this->generateCouponCode(), 
      'generate_date'=>$curr_date ,   
      'status' =>1 ,
    );
    $this->db->insert('restaurant_coupon',$data);
    // echo $this->db->last_query();
    $response['status'] = 1;
    $response['message'] = 'Insert successfully';

  }
  return $response;



}

public function del_offer(){

 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}else if($data['offer_id']=='')
{
  $response['status']=0;
  $response['message']='Offer Id are required';
}
else
{
  unset($data['acid']);
  unset($data['status']);
  $this->db->select('*');
  $this->db->from('restaurant_coupon'); 
  $this->db->where('id',$data['offer_id']);

  $this->db->delete('restaurant_coupon');
       // echo $this->db->last_query();

  $response['status'] = 1;
  $response['message'] = 'Deleted successfully';
}

return $response;



}
public function update_offer(){



  $response   =array();
  $data       = $this->input->post();
        // print_r($data); die;
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }
  else if($data['offer_id']=='')
  {
    $response['status']=0;
    $response['message']='offer id are required';
  }
  else if($data['r_id']=='')
  {
    $response['status']=0;
    $response['message']='Restaturant id are required';
  }else if($data['valid_for']=='')
  {
    $response['status']=0;
    $response['message']='Valid For  are required';
  }else if($data['discount_type']=='')
  {
    $response['status']=0;
    $response['message']='Discount_type are required';
  }else if($data['discount']=='')
  {
    $response['status']=0;
    $response['message']='Descount are required';
  }
  else if($data['expire_date']=='')
  {
    $response['status']=0;
    $response['message']='Expire date are required';
  }else if($data['minimum_purchase']=='')
  {
    $response['status']=0;
    $response['message']='minimum_purchase are required';
  }else
  {
    unset($data['acid']);

    $date = new DateTime("now");
    $curr_date = $date->format('Y-m-d');
    $data1= array(
      'r_id' =>$data['r_id'],
      'valid_for' =>$this->input->post('valid_for') ,
      'discount_type' =>$this->input->post('discount_type') ,
      'discount' =>$this->input->post('discount') ,
      'minimum_purchase' =>$this->input->post('minimum_purchase') ,
      'expire_date' =>$this->input->post('expire_date') ,
      'generate_date'=>$curr_date ,   
      'status' =>1 ,
    );
    $this->db->select('*');
    $this->db->from('restaurant_coupon'); 
    $this->db->where('id',$data['offer_id']);
    $this->db->update('restaurant_coupon',$data1);
    $response['status'] = 1;
    $response['message'] = 'Update successfully';

  }
  return $response;



}

public function book_table_list_in_res(){



  $response   =array();
  $result     =array();
  $data       = $this->input->post();
  if($data['acid']=='')
  {
    $response['status']=0;
    $response['message']="acid is required";
  }
  else if($data['res_id']=='')
  {
    $response['status'] = 0;
    $response['message'] = 'Restaurant is required';
  }
  else
  {

    $this->db->select('*');
    $this->db->from('tbl_bookiing a'); 
    $this->db->join('restaurant b','b.id=a.res_id', 'left');
    $this->db->join('user c','c.id=a.user_id', 'inner');
    $this->db->where('b.id',$data['res_id']);
    $this->db->order_by('a.id');         
    $bokking_data = $this->db->get()->result_array();
    unset($data['acid']);
    unset($data['user_id']);
    // print_r($bokking_data);
    $i=1;
    foreach ($bokking_data as $key) {

      $res_data=$this->db->select('*')->from('restaurant')->where('id',$key['res_id'] )->where('status',1)->get()->result_array();

      $data['sno']=$i;
      $data['res_name']=$res_data[0]['r_name'];
      $data['no_of_table']=$key['no_of_tables'];
      $data['Customer_name']=$key['name'];
      $data['mobile']=$key['mobile'];
      $data['date']=$key['date'];
      $data['time']=$key['time'];
      $a[] =$data ;                                 
      $i++; }

      $response['status']=1;
      $response['message']='success';
      $response['res_Bokking_List']=$a;
      return $response;
    }

  }
  public function res_menu_list(){


    $response   =array();
    $data       = $this->input->post();
    if($data['acid']=='')
    {
      $response['status']=0;
      $responce['message']="acid is required";
    }else if($data['res_id']=='')
    {
      $response['status'] = 0;
      $response['message'] = 'Restaturant id is required';
    }
    else
    {

      $rows=$this->db->select('')->from('restaurant_item')->where('restaurant_id',$data['res_id'])->get()->num_rows();

      if($rows>0){

        $menu=$sql = $this->db->select('*')->from('restaurant_item')->where('restaurant_id',$data['res_id'])->get()->result_array();
        foreach ($menu as $key) {

         $sql= $this->db->select('*')->from('menu')->where('id',$key['menu_name'])->where('status',1) ->get()->result_array();
         $cousine= $this->db->select('*')->from('cuisine')->where('id',$key['cuisine_id'])->where('status',1) ->get()->result_array();
         $menu_data['id']             = $key['id'];
         $menu_data['restaurant_id']  = $key['restaurant_id'];
         $menu_data['menu_id']        = $key['menu_name'];
         $menu_data['menu_name']      =$sql[0]['menu_name'];
         $menu_data['menu_price']     = $key['menu_price'];
         $menu_data['actual_price']   = $key['actual_price'];
         $menu_data['cuisine_name']     = $cousine[0]['name'];
         $menu_data['cat_id']         = $key['cat_id'];
         $menu_data['sub_cat_id']     = $key['sub_cat_id'];
         $menu_data['menu_type']      = $key['menu_type'];
         $menu_data['m_discription']  = $key['m_discription'];
         $menu_data['popular_dish']   = $key['popular_dish'];
         $menu_data['spicy_dish']     = $key['spicy_dish'];
        
         $menu_data['img']            = base_url()."upload_images/cuisine/".$key['img'];
          $menu_data['status']         = $key['status']; 
         $b[]=$menu_data;

       }



       $response['message'] = 'Menu List';
       $response['menu_list'] =$b;
       $response['status'] = 1;


     }else{

      $response['message'] = 'Menu List empty';
      $response['status'] = 1;

    }

  }
  return $response;




}

public function del_res_menu(){

 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}else if($data['menu_id']=='')
{
  $response['status']=0;
  $response['message']='Menu Id are required';
}
else
{
  unset($data['acid']);
  unset($data['status']);
  $this->db->select('*');
  $this->db->from('restaurant_item'); 
  $this->db->where('id',$data['menu_id']);

  $this->db->delete('restaurant_item');
       // echo $this->db->last_query();

  $response['status'] = 1;
  $response['message'] = 'Deleted successfully';
}
return $response;
}

public function menu_list(){


 $response   =array();
 $data       = $this->input->post();
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}

else
{
  $rows=$this->db->select('*')->from('menu')->where('status',1)->get()->num_rows();
  if($rows>0){
    $menu=$this->db->select('*')->from('menu')->where('status',1)->get()->result_array();
    $response['message'] = 'menu List';
    $response['menu_list'] =$menu;
    $response['status'] = 1;
  }else{
    $response['message'] = 'menu List empty';
    $response['status'] = 1;
  }
}
return $response;


}
public function category_list(){


 $response   =array();
 $data       = $this->input->post();
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}

else
{
  $rows=$this->db->select('')->from('category')->where('status',1)->get()->num_rows();
  if($rows>0){
    $category=$this->db->select('id,category')->from('category')->where('status',1)->get()->result_array();
    $response['message'] = 'Category List';
    $response['category_list'] =$category;
    $response['status'] = 1;
  }else{
    $response['message'] = 'category List empty';
    $response['status'] = 1;
  }
}
return $response;



}

public function sub_category_list(){

  $response   =array();
  $data       = $this->input->post();
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }elseif($data['cat_id']==''){
    $response['status']=0;
    $responce['message']="Category ID is required";
  }

  else
  {
    $rows=$this->db->select('*')->from('sub_category')->where('cat_id',$data['cat_id'])->where('status',1)->get()->num_rows();
    if($rows>0){
      $sub_category=$this->db->select('*')->from('sub_category')->where('cat_id',$data['cat_id'])->where('status',1)->get()->result_array();
      $response['message'] = 'sub_category List';
      $response['category_list'] =$sub_category;
      $response['status'] = 1;
    }else{
      $response['message'] = 'sub_category List empty';
      $response['status'] = 1;
    }
  }
  return $response;

}
public function add_res_menu(){


 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}
else if($data['restaurant_id']=='' && $data['menu_id'] && $data['menu_id'] && $data['menu_price'] && $data['actual_price'] && $data['cuisine_id'] && $data['cat_id'] && $data['sub_cat_id'] && $data['menu_type'] && $data['m_discription'] && $data['popular_dish'] && $data['spicy_dish'] )
{
  $response['status']=0;
  $response['message']='All Fields are required';
}else
{
  unset($data['acid']);
    // print_r($cuisines);

    // unset($data['user_id']);
  if(!empty($_FILES['image']['name'])){
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
  }        
  $data= array(
  'restaurant_id' =>$data['restaurant_id'],
  'menu_name' =>$data['menu_id'],
  'menu_price' =>$data['menu_price'],
  'actual_price' =>$data['actual_price'] ,
  'cuisine_id' =>$data['cuisine_id'] ,
  'cat_id' =>$data['cat_id'] ,
  'sub_cat_id' =>$data['sub_cat_id'],  
  'menu_type' =>$data['menu_type'],   
  'm_discription' =>$data['m_discription'],   
  'popular_dish' =>$data['popular_dish'],   
  'spicy_dish' =>$data['spicy_dish'],  
  'status' =>1,  
);

  if (!empty($i)) {
   $data['img']=$img;
    }
$this->db->insert('restaurant_item',$data);
$response['status'] = 1;
$response['message'] = 'Insert successfully';

}
return $response;


}

public function update_res_menu(){



 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}
else if($data['item_id']=='')
{
  $response['status']=0;
  $response['message']='Item ID are required';
}else
{
  unset($data['acid']);
    // print_r($cuisines);

    // unset($data['user_id']);
  if(!empty($_FILES['image']['name'])){
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
  }        
  $data1= array(
  'restaurant_id' =>$data['restaurant_id'],
  'menu_name' =>$data['menu_id'],
  'menu_price' =>$data['menu_price'],
  'actual_price' =>$data['actual_price'] ,
  'cuisine_id' =>$data['cuisine_id'] ,
  'cat_id' =>$data['cat_id'] ,
  'sub_cat_id' =>$data['sub_cat_id'],  
  'menu_type' =>$data['menu_type'],   
  'm_discription' =>$data['m_discription'],   
  'popular_dish' =>$data['popular_dish'],   
  'spicy_dish' =>$data['spicy_dish'],  
  'status' =>1,  
);

  if (!empty($i)) {
   $data1['img']=$img;
    }
    $this->db->select('*');
    $this->db->from('restaurant_item'); 
    $this->db->where('id',$data['item_id']);
    $this->db->update('restaurant_item',$data1);
$response['status'] = 1;
$response['message'] = 'update successfully';

}
return $response;

}


public function manage_res_budget(){



 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
}
else if($data['budget']=='')
{
  $response['status']=0;
  $response['message']='Budget are required';
}else if($data['res_id']=='')
{
  $response['status']=0;
  $response['message']='Res Id are required';
}else
{
  unset($data['acid']);
  
    $this->db->select('*');
    $this->db->from('restaurant'); 
    $this->db->where('id',$data['res_id']);
  unset($data['res_id']);
  // print_r($data);
    $this->db->update('restaurant',$data);
$response['status'] = 1;
$response['message'] = 'update successfully';

}
return $response;

}

public function res_time_list(){



  $response   =array();
  $data       = $this->input->post();
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }elseif($data['res_id']==''){
    $response['status']=0;
    $responce['message']="Restaurant ID is required";
  }

  else
  {
    $rows=$this->db->select('*')->from('restaurant_time')->where('r_id',$data['res_id'])->get()->num_rows();
    if($rows>0){
      $open_time=$this->db->select('*')->from('restaurant_time')->where('r_id',$data['res_id'])->get()->result_array();
      $response['message'] = 'Res open Close time';
      $response['res_time_list'] =$open_time;
      $response['status'] = 1;
    }else{
      $response['message'] = 'List are empty';
      $response['status'] = 1;
    }
  }
  return $response;

}

public function review_list(){

  $response   =array();
  $data       = $this->input->post();
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }elseif($data['res_id']==''){
    $response['status']=0;
    $responce['message']="Restaurant ID is required";
  }

  else
  {
    $rows=$this->db->select('*')->from('restaurant_rating')->where('res_id',$data['res_id'])->get()->num_rows();
    if($rows>0){
     $review=$sql = $this->db->select('*')->from('restaurant_rating')->where('res_id',$data['res_id'])->get()->result_array();

            $i=1;
            foreach ($review as $res_value) {

               $sql = $this->db->select('*')->from('user')->where('id',$res_value['user_id'])->get()->result_array();

               $data1['rev_id']=$res_value['id'];
               $data1['user_name']=$sql[0]['name'];
               $data1['rating']=$res_value['rating'];
               $a[]=$data1;

             }
      $response['message'] = 'Restaurant review List';
      $response['Review list'] =$a;
      $response['status'] = 1;
    }else{
      $response['message'] = 'List are empty';
      $response['status'] = 0;
    }
  }
  return $response;


}
public function change_order_status(){

  $response   =array();
  $data       = $this->input->post();
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }elseif($data['order_id']==''){
    $response['status']=0;
    $responce['message']="Oder ID is required";
  }elseif($data['order_status']==''){
    $response['status']=0;
    $responce['message']="Order Status is required";
  }

  else
  {

    $order_id=$data['order_id'];
    $data=array(
      'order_status'=>$data['order_status'],
      );

    if ($data['order_status']==3) {
      $order=$this->db->select('*')->from('order_new')->where('order_no',$order_id)->where('payment_method !=','cod')->get()->result_array();
      $add_money_wallet=array(
        'user_id' =>$order[0]['user_id'] , 
        'credit_amount' =>$order[0]['total_amount'], 
        'type' =>'Cr', 
        'status' =>1, 
        );

      $this->db->insert('cashcredit',$add_money_wallet);
    }
    $this->General_model->change_order_status_on_app($data,$order_id);
    $response['message'] = 'successfully updated';
    $response['status'] = 1;
  }
  
 return $response;

}



public function res_menu_status(){


  $response   =array();
  $data       = $this->input->post();
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }elseif($data['item_id']==''){
    $response['status']=0;
    $responce['message']="item ID is required";
  }elseif($data['status']==''){
    $response['status']=0;
    $responce['message']="Status is required";
  }

  else
  {

    $item_id=$data['item_id'];
    $data=array(
      'status'=>$data['status'],
      );
         
    $this->db->select();
    $this->db->from('tbl_restaurant_item');
    $this->db->where('id',$item_id);
    $this->db->update('tbl_restaurant_item',$data);
  
    $response['message'] = 'successfully updated';
    $response['status'] = 1;
  }
  
 return $response;




}


public function restaurant_rating(){



  $response   =array();
  $data       = $this->input->post();
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }elseif($data['res_id']==''){
    $response['status']=0;
    $responce['message']="Restaurant Id is required";
  }elseif($data['user_id']==''){
    $response['status']=0;
    $responce['message']="User Id is required";
  }elseif($data['rating']==''){
    $response['status']=0;
    $responce['message']="Rating is required";
  }

  else
  {
    unset($data['acid']);
     $rows=$this->db->select('*')->from('restaurant_rating')->where('user_id',$data['user_id'])->where('res_id',$data['res_id'])->get()->num_rows();
    if($rows>0){
    $response['message'] = 'Already Rated';
    $response['status'] = 0;
    
    }else{

    $this->db->insert('restaurant_rating',$data);

    $response['message'] = 'Your Rating successfully done';
    $response['status'] = 1;
    }
  }
  
 return $response;



}

public function App_version_for_vender(){



 $response   =array();
 $data       = $this->input->post();
        // print_r($data); die;
 if($data['acid']=='')
 {
  $response['status']=0;
  $responce['message']="acid is required";
 }else{
   $version=$this->db->select('AppVersion,AppCode')->from('app_version')->where('status',3)->get()->result_array();

  $rowss=$this->db->select('AppVersion,AppCode')->from('app_version')->where('status',3)->get()->num_rows();

  if ($rowss > 0) {
    foreach ($version as $row) {
    
    $da = $row['AppCode'];
    $Vda = $row['AppVersion'];

    }
    $response["success"] = 1;
    $response["version"] = (string)$da;
    $response["versioncode"] = (string)$Vda;

  } else {
    $response["success"] = 0;
    $response["message"] = "No Data Found.";
  }
    

}
return $response;


}


public function Last_Order(){


	$response   =array();
  $data       = $this->input->post();
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }elseif($data['user_id']==''){
    $response['status']=0;
    $responce['message']="User Id is required";
  }else
  {
    unset($data['acid']);
     $rows=$this->db->select('*')->from('order_new')->where('user_id',$data['user_id'])->get()->num_rows();
    if($rows>0){

    $last_order=$this->db->select('*')->from('order_new')->where('user_id',$data['user_id'])->order_by('id','desc')->get()->result_array();
    //print_r($last_order);
    $response['message'] = 'Last Order';
    $response['lat'] = $last_order[0]['lat'];
    $response['lang'] = $last_order[0]['lng'];
    $response['last_order_id'] = $last_order[0]['order_no'];
    $response['status'] = 1;
    
    }else{
    $response['message'] = 'No order Found';
    $response['status'] = 0;
    }
  }
  
 return $response;


}

public function Checksum_generate(){
    $response   =array();
  $data       = $this->input->post();
//     print_r($_POST);
//   die();
  if($data['acid']=='')
  {
    $response['status']=0;
    $responce['message']="acid is required";
  }elseif($data['user_id']==''){
    $response['status']=0;
    $responce['message']="User Id is required";
  }elseif($data['amount']==''){
    $response['status']=0;
    $responce['message']="Amount is required";
  }
  elseif($data['mobile']==''){
    $response['status']=0;
    $responce['message']="Mobile is required";
  }elseif($data['email']==''){
    $response['status']=0;
    $responce['message']="Email Id is required";
  }else
  {
    unset($data['acid']);

  
 

    $checkSum = "";
    $this->load->helper('string');
    $last_id=random_string('alnum',5);
    $order_id= "SP".date("Ymd").$last_id;
// below code snippet is mandatory, so that no one can use your checksumgeneration url for other purpose .
$paramList = array();
$paramList["MID"] = 'YiacoI96727606937941'; //Provided by Paytm
$paramList["ORDER_ID"] ='SP20180718BNAZv'; //unique OrderId for every request
$paramList["CUST_ID"] = 'CUST00007'; // unique customer identifier 
$paramList["INDUSTRY_TYPE_ID"] = 'Retail109'; //Provided by Paytm
$paramList["CHANNEL_ID"] = 'WAP'; //Provided by Paytm
$paramList["TXN_AMOUNT"] = '1.00'; // transaction amount
$paramList["WEBSITE"] = 'APPPROD';//Provided by Paytm
//$paramList["Merchant Key"] = 'BsxDkn10z6UON1M8';//Provided by Paytm
$paramList["CALLBACK_URL"] = 'https://securegw.paytm.in/theia/paytmCallback?ORDER_ID='.$order_id;

//$paramList["CALLBACK_URL"] = 'https://securegw.paytm.in/theia/paytmCallback?ORDER_ID=SP20180718BNAZv|WAP|CUST00007|Retail109|YiacoI69560725802557|SP20180718BNAZv|1.00|APPPROD|';
 

//$paramList["EMAIL"] = 'abc@gmail.com'; // customer email id
//$paramList["MOBILE_NO"] = '9999999999'; // customer 10 digit mobile no.

$checkSum = getChecksumFromArray($paramList,'BsxDkn10z6UON1M8');
$paramList["CHECKSUMHASH"] = $checkSum;
print_r($paramList);
//die();
    $response['status']=1;
    $response['checksum']=$checkSum;
    $response['order_id']=$paramList["ORDER_ID"];
       
} 
 return $response;
 }
 
 /*
 *---------------------------Prime membership----------------------------------------------
 */
 
 public function Prime_membership_plan(){
   $response   =array();
   $data       = $this->input->post();
   
  if($data['acid']==''){
    $response['status']=0;
    $responce['message']="acid is required";
  } else {
    unset($data['acid']);
   
    $dataprime = $this->db->select('*')->from('prime_membership_plan')->where('plan_status',1)->get()->result_array();
    
    foreach($dataprime as &$value){
    $value['plan_price'] = '₹ '.$value['plan_price'];   
    $value['plan_banner'] = base_url('upload_images/banner/'.$value['plan_banner']);
    
   }
   
    $response = ['success' => true, 'primeme_mbership_plan' => $dataprime ];
  }   
 return $response;    
     
 }
 
 public function Prime_member_chksum(){
   $response   =array();
   $data       = $this->input->post();
   
  
   
  if($data['acid']==''){
    $response['status']=0;
    $responce['message']="acid is required";
  } else if(empty($data['txn_amount'])){
     $response['status']=0;
    $responce['message']="Transaction amount is empty";  
  } else if(empty($data['user_id'])){
    $response['status']=0;
    $responce['message']="User Id is required";   
  }else if(empty($data['plan_id'])){
    $response['status']=0;
    $responce['message']="Plan Id is required";   
  } else {
    unset($data['acid']);
    
    $order_id = "SP". $data['user_id'] .strtoupper(bin2hex(random_bytes(8)));
    
    $paramList["MID"] = 'YiacoI69560725802557';
    $paramList["ORDER_ID"] =$order_id;
    $paramList["CUST_ID"] = 'CUST00007'; 
    $paramList["INDUSTRY_TYPE_ID"] = 'Retail109';
    $paramList["CHANNEL_ID"] = 'WAP'; 
    $paramList["TXN_AMOUNT"] = $data['txn_amount']; 
    $paramList["WEBSITE"] = 'APPPROD';
    $paramList["CALLBACK_URL"] = 'https://securegw.paytm.in/theia/paytmCallback?ORDER_ID='.$order_id;  
    // $paramList["PRIME_PLAN_ID"] = $data['plan_id'];
    // $paramList["USER_ID"] = $data['user_id'];
    //$paramList["MERC_UNQ_REF"] = $data['plan_id'] . '|' . $data['user_id'];
    $checkSum = getChecksumFromArray($paramList,'BsxDkn10z6UON1M8');
    
    
    return $response = ['success' => true,  'data' => ['chksum' => $checkSum, 'order_id' => $order_id, 'plan_id' => $data['plan_id'], 'user_id' => $data['user_id'] ] ];
  }
     
 }


public function Prime_member_payment_status(){
  $data       = $this->input->post(); 
  if($data['acid']==''){
    $response['status']=0;
    $responce['message']="acid is required";
  }  else if(empty($data['user_id'])){
    $response['status']=0;
    $responce['message']="User Id is required";   
  }else if(empty($data['plan_id'])){
    $response['status']=0;
    $responce['message']="Plan Id is required";   
  } else {

// $paytmChecksum = "";
// $paramList = array();
// $isValidChecksum = FALSE;

// $paramList = $_POST;
// $return_array = $_POST;
// $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
// $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum);        

//if ($isValidChecksum===TRUE){
 
//if ($_POST["STATUS"] == "TXN_SUCCESS"){ 

        //$session_userdata=$this->session->userdata('user_data');
         
         $user_id = $data["user_id"];
         $plan_id = $data["plan_id"];
		 //$plan = $this->db->select('*')->from('prime_membership_plan')->where('plan_status',1)->get()->result_array();
		 if( $plan_id==1){
		     
		     $st_date = date('Y-m-d');
		     $end_date = date("Y-m-d", strtotime("+1 month"));
		     
		 } else if( $plan_id==2){
		      $st_date = date('Y-m-d');
		     $end_date = date("Y-m-d", strtotime("+6 month"));
		     
		 } else if( $plan_id==3){
		     $st_date = date('Y-m-d');
		     $end_date = date("Y-m-d", strtotime("+12 month"));
		     
		 }
		 
		   $up_data = array(
			'prime_member_start' => $st_date,
			'prime_member_end' => $end_date
	        );
		
              $this->db->where("id", $user_id);
              $this->db->update("user", $up_data);
               if($this->db->affected_rows() > 0){
        return $response = ['success' => true,  'message' => 'You are now our Prime member'];
        }else{
          return $response = ['success' => false,  'message' => 'Fail to update data'];
        }   
 
    
     
// } else {
 
//  return $response = ['success' => false,  'message' => 'Transaction Fail'];
 
// }
    
// } else {
//  return $response = ['success' => false,  'message' => 'Payment Fail'];   
// }
   
  } 
}
 

/*
*-------------------------------------------------------------------------------------------------------------------------
*/
 
 
}

