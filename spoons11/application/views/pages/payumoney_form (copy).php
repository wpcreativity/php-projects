<?php
$vender_data=$this->session->userdata('vender_user');
$vender_address=$this->session->userdata('vender_address');

$MERCHANT_KEY = "JBZaLc";
$SALT = "GQs7yium";
$PAYU_BASE_URL = "https://test.payu.in";

/*
Card Name: Test

Card Number: 5123 4567 8901 2346

CVV: 123

Expiry: 05/2020

*/

$action = '';

$posted = array(
'name'=>$vender_data['name'],
'amount'=>$total,
'email'=>$vender_data['email'],
'phone'=>$vender_data['mobile'],
'productinfo'=>'vender registration',
'address'=>$vender_address['r_address'],
);
// $posted=$vender_address;
if(!empty($_POST)) {
//print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 

  }
}

$formError = 0;

if(empty($posted['txnid'])) {
// Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  
  if(
    empty($posted['amount'])
    || empty($posted['name'])
    || empty($posted['email'])
    || empty($posted['phone'])
    || empty($posted['productinfo'])
    ) {
    $formError = 1;
} else {
//$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
  $hashVarsSeq = explode('|', $hashSequence);
  $hash_string = '';  
  foreach($hashVarsSeq as $hash_var) {
    $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
    $hash_string .= '|';
  }
  $hash_string .= $SALT;
  $hash = strtolower(hash('sha512', $hash_string));
  $action = $PAYU_BASE_URL . '/_payment';
}
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<!--User Details-->
<?php

$orderData=$this->session->userdata('order_data');
$userData=$this->session->userdata('user_data');
  $product[] = $this->session->userdata('cart_data') ;

     $oder_item= $this->db->select('*')->from('tbl_order_itmes')->where('order_id',$orderData['order_no'])->get()->result_array();

     foreach ($oder_item as $value) {
       $menu_name[]=$value['menu_name'];
     }

if(!empty($oder_item)){
 $product = implode(',',$menu_name); 
}
?>
 



<!DOCTYPE html>
<html lang="en">
<head>
  
</head>
<body>

  <form action="<?php echo $action; ?>" method="post" name="payuForm" id="payuForm">
    <input type="text" name="key" value="<?php echo $MERCHANT_KEY ?>" />
    <input type="text" name="hash" value="<?php echo $hash ?>"/>
    <input type="text" name="txnid" value="<?php echo $txnid ?>" />
    <input type="text" name="amount" value="<?php echo $total; ?>" />
    <input type="text" name="firstname" id="firstname" value="<?php echo $vender_data['name']; ?>" />
    <input type="text" name="email" id="email" value="<?php echo $vender_data['email'] ?>" />
    <input type="text" name="phone" value="<?php echo $vender_data['mobile'] ?>" />
    <input type="text" name="productinfo" value="<?php echo "for restaurant registration" ?>" />
    <input type="text" name="surl" value="<?php echo base_url('payu-res-success')?>" size="64" />
    <input type="text" name="furl" value="<?php echo base_url('payu-failure')?>" size="64" />
    <input type="text" name="service_provider" value="payu_paisa" size="64" />
    <input  type="text" name="lastname" id="lastname" value="<?php echo $vender_data['name'] ?>" />
    <input type="text" name="address1" value="<?php echo $vender_address['r_address']; ?>" />
    <input type="text" name="address2" value="<?php echo "restaurant";  ?>" />
    <input type="text" name="country" value="India" />
    <?php if(!$hash) { ?>
    <td colspan="4"><input type="submit" value="Submit" />
      <?php } ?>
<input type="submit" name="submit">

   </form>
  
</body>
</html>

<!-- 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

$('document').ready(function(){
       $("#payuForm").submit();
});

</script>  -->