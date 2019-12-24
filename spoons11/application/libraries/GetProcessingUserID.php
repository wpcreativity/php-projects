<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GetProcessingUserID {



public function get_id($res_id){
echo $res_id;
// die();  
   $diffResult=array();
   $totalUser=array();
   $processUser=array();
   $Sql = $GLOBALS['obj']->query("select * from tbl_delivery_boy_profile where find_in_set($res_id,restaurant_id) and status=1",$debug=-1);
   $result = mysqli_num_rows($Sql);
   
    if ($result>0) {
         
      while($line = mysqli_fetch_assoc($Sql))
      {
         
         $totalUser[] = $line['id'];   

         $uid=$line['id'];
         $Sql1 = $GLOBALS['obj']->query("select * from tbl_order_process_user where user_id='$uid' and  
            DATE(cdate) = CURRENT_DATE ",$debug=-1); //die;
         $userResult = mysqli_fetch_assoc($Sql1);
         $processUser[] = $userResult['user_id'];  

      }
   //print_r($processUser); die;
         $diffResult ='';
         $diffResult=array_diff($totalUser,$processUser);

         if (!empty($diffResult)) {
               // Insert  user
               $uid= array_shift($diffResult);
               $GLOBALS['obj']->query("insert into tbl_order_process_user set user_id='$uid'",$debug=-1);
               return $uid;


         } else {
            
             $Sql1 = $GLOBALS['obj']->query("select user_id,total_order from tbl_order_process_user where DATE(cdate) = CURRENT_DATE order by total_order ASC",$debug=-1);
             $userResult1 = mysqli_fetch_assoc($Sql1);

             $uid=$userResult1["user_id"];
             $new_total_order=$userResult1['total_order']+1;   
             $GLOBALS['obj']->query("update tbl_order_process_user set total_order='$new_total_order' where user_id='".$userResult1["user_id"]."'",$debug=-1);

             return $uid;
            
            
         }


   } else {

      return 0;
      
   }

}
   
}

