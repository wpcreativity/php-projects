  <?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Vender_controler extends CI_Controller 
  {


   /*user section*/
   const SPOON_CHANGEPASSWORD         = 104;
   const SPOON_FORGETPASSWORD         = 105;
   const SPOON_USER_DETAIL            = 106;
 

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






   public function __construct()
   {
    parent::__construct();
    $this->load->database();
    $this->load->model('General_model'); 
    //$this->load->model('Email_model');
    $this->load->library('email');
    $this->load->library('simpleimage');
    $this->load->library('Pushnotification_for_vender');
    $this->load->library('cart');  
  }

  public function index()
  {
    $response = ''; 
    $request = $this->input->post('acid'); 
   //echo $request='102';
    switch ($request)
    {
      case self::SPOON_CHANGEPASSWORD : $response         = $this->change_password(); break;
      case self::SPOON_FORGETPASSWORD : $response         = $this->forget_password(); break;
      case self::SPOON_USER_DETAIL    : $response         = $this->user_detail(); break;
      





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

      $user_details=$this->db->get_where('user', array('id'=>$data['user_id'],'status'=>'1'))->result_array();
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
        }

      }
      $response['status']=1;
      $response['message']='success';
      $response['user-details']=$result;
      return $response;
    }
  }



public function vender_login(){

  $response           = array();
  $data               = array();
  $email              = $this->input->post('email');
  $password           = $this->input->post('password');

  if($email==''){
    $response['status'] = 0;
    $response['message'] = 'Email is Required';
  }else if($password==''){
    $response['status'] = 0;
    $response['message'] = 'Password is Required';
  }else{
    $chk_login = $this->db->get_where('user',array('email'=>$email,'password'=>$password,'type'=>2))->num_rows();
    if($chk_login>0)
    {   

      $logger_details = $this->db->get_where('user',array('email'=>$email,'password'=>$password,'type'=>2))->result_array();
      unset($logger_details[0]['password']);
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

        $result= $this->db->select('*')->from('order_new')->where('restaurant_id',$res_id)->get()->result_array();
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

      $rows=$this->db->select('')->from('restaurant_item')->where('restaurant_id',$data['res_id'])->where('status',1)->get()->num_rows();

      if($rows>0){

        $menu=$sql = $this->db->select('*')->from('restaurant_item')->where('restaurant_id',$data['res_id'])->where('status',1) ->get()->result_array();
        foreach ($menu as $key) {

         $sql= $this->db->select('*')->from('menu')->where('id',$key['menu_name'])->where('status',1) ->get()->result_array();
         $menu_data['id']             = $key['id'];
         $menu_data['restaurant_id']  = $key['restaurant_id'];
         $menu_data['menu_id']        = $key['menu_name'];
         $menu_data['menu_name']      =$sql[0]['menu_name'];
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


}
