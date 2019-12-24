<?php

$vender_data=$this->session->userdata('vender_user');
$vender_address=$this->session->userdata('vender_address');
$amount=number_format($this->session->userdata('total_mebership_amount'),0);

// Merchant key here as provided by Payu
//$MERCHANT_KEY = "hDkYGPQe";
$MERCHANT_KEY = "KeyQLEwO4Vo";
 
// Merchant Salt as provided by Payu
//$SALT = "yIEkykqEH3";
$SALT = "SaltG4RvH5ryon";
 
// End point - change to https://secure.payu.in for LIVE mode
//$PAYU_BASE_URL = "https://test.payu.in";
$PAYU_BASE_URL = "https://secure.payu.in";
 
$action = '';
 
$posted = array();
if(!empty($_POST)) {
    /*print_r($_POST);

    die;*/
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
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
   || empty($posted['service_provider'])
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
  // $amount=number_format($this->session->userdata('total_mebership_amount'),0);
    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>

</head>
<body onload="submitPayuForm()">


      <section>
        <div class="container">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
                <div class="appointment">
                   
                        <form action="<?php echo $action; ?>" method="post" name="payuForm" id="payuForm">
                            <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
                            <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                            <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />

                            <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
                            <input type="hidden" name="firstname" value="<?php echo $vender_data['name']; ?>" />
                            <input type="hidden" name="productinfo" value="For restaurant membership" />
                            <input type="hidden" name="email" id="email" value="<?php echo $vender_data['email'] ?>" />
                            <input type="hidden" name="phone" id="phone" value="<?php echo $vender_data['mobile'] ?>" />
                            <input type="hidden" name="surl" value="<?php echo base_url('membership-payu-success')?>" />
                            <input type="hidden" name="furl" value="<?php echo base_url('payu-failure')?>" />
                            <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                            
                            <?php if(!$hash) { ?>
                                 <p> <input type="submit" class="btn-confirm" value="Submit" /></p>
                            <?php } ?>
                              
                          </form>

                    </div>

                </div>
            </div>
        </div>
    </section>




</body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

$('document').ready(function(){
       $("#payuForm").submit();
});

</script> 



